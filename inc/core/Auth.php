<?php

use \Model\User;

class Auth {

    // use a 128-bit key for encryption
    const KEY_SIZE = 128;

    // use PHP's default algorithm for password hashes
    const ALGORITHM = PASSWORD_DEFAULT;

    // set this key for a greater level of encryption, at the cost of increased request time
    const ALGORITHM_COST = 10;

    /**
     * Our interface to AYC's central auth system in the intranet.
     * @var CAuthClient
     */
    private $centralAuth = null;

    /**
     * Currently logged in user's active record.
     * @var User
     */
    private $user = null;

    /**
     * constructor
     */
    public function __construct() {
        $this->centralAuth = new CAuthClient();
    }

    /**
     * Get the currently logged in user's database id, if applicable.
     *
     * @return int|null
     */
    public function getUserId() {
        if ($this->user !== null)
            return $this->user->id;

        return null;
    }

    /**
     * Get the currently logged in user's name, if applicable.
     *
     * @return string|null
     */
    public static function getUserName() {
        /** @var User $user */
        if($user = static::getUser()){
            if(strlen($user->fullname)){
                return $user->fullname . " ($user->username)";
            } else {
                return $user->username;
            }
        } else {
            return '';
        }
    }

    public static function getUser(){
        return isset($_SESSION['admin']) && isset($_SESSION['admin']['user']) ? $_SESSION['admin']['user'] : null;
    }

    public static function alwaysAllowedModules(){
        return ['login', 'logout', 'error', ''];
    }

    /**
     * Determine if a user is currently logged in. If so, store the user object.
     *
     * @return bool
     */
    public function isLoggedIn() {
        if ($this->parseSession()) {
            $expires = strtotime($this->user->token_expires);

            // if there's been no activity for over a specified period of time, automatically log out
            if ($expires < time()) {
                $this->logOutUser($this->user->id);
                $_SESSION['admin']['message'] = "You have been logged out due to inactivity. Please log in again.";
                return false;
            }

            // reset the expiration time for our current session
            $this->user->token_expires = Util::formatDate('+1 hour');
            $this->user->save();
            $_SESSION['admin']['user'] = $this->user;

            return true;
        }

        return false;
    }

    /**
     * Attempt to log in a user based on the username and password supplied.
     *
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function logInUser($username, $password) {
        /** @var User $user */
        $user = User::enabled()->where('username', $username)->first();

        /**
         * Do we have the username in the system locally?
         */
        if ($user !== null) {

            /**
             * If we are a central auth user, let the remote server do the
             * validation. Store the password hash locally with the rest
             * of the user record.
             */
            if ($user->central_auth) {
                if (!$this->remoteValidate($username, $password)) {
                    return false;
                }

                $this->user = $user;
                $this->user->password = $password;
                $this->setupUserSession(true);
                return true;

            } else {

                /**
                 * Verify entered password against our stored hash.
                 */
                if (password_verify($password, $user->password)) {
                    $this->user = $user;

                    /**
                     * Check to see if the current password hash implements the
                     * algorithm and options provided. If not, we need to
                     * rehash it.
                     */
                    if (password_needs_rehash($this->user->password, self::ALGORITHM, ['cost' => self::ALGORITHM_COST])) {
                        $this->user->password = $password;
                    }

                    $this->setupUserSession();
                    return true;
                }
            }

        /**
         * We do not have a matching user in the system. Query central auth to
         * see if we have one remotely. If we do, store a local record so we
         * can utilize the existing session framework.
         */
        } else if ($this->remoteValidate($username, $password)) {
            $user = new User();
            $user->username = $username;
            $user->password = $password;
            $user->enabled = true;
            $user->central_auth = true;
            $user->userlevel = User::TYPE_AYC_USER;
            $user->save();

            $this->user = $user;
            $this->setupUserSession(true);
            return true;
        }

        return false;
    }

    /**
     * Create our session object and set an expiry date on the login.
     *
     * @return bool
     */
    private function setupUserSession($cauth = false) {
        $token = base64_encode($this->token());
        $cookie = $this->user->id . ':' . $token;
        $mac = $this->hash($cookie);
        $cookie .= ':' . $mac;
        $_SESSION['admin']['auth'] = $cookie;
        $_SESSION['admin']['cauth'] = $cauth;
        $_SESSION['admin']['userlevel'] = $this->user->userlevel;
        $_SESSION['admin']['modules'] = $this->user->getModuleNames();
        $_SESSION['admin']['pages'] = $this->user->getPageIds();

        $this->user->token = $token;
        $this->user->token_expires = Util::formatDate('+1 hour');

        return $this->user->save();
    }

    /**
     * Log out the current logged in user.
     *
     * @return bool
     */
    public function logOutUser() {
        $_SESSION['admin']['auth'] = null;
        unset($_SESSION['admin']['auth']);
        $_SESSION['admin']['cauth'] = null;
        unset($_SESSION['admin']['cauth']);
        $_SESSION['admin']['superadmin'] = null;
        unset($_SESSION['admin']['superadmin']);
        $_SESSION['admin']['userlevel'] = null;
        unset($_SESSION['admin']['userlevel']);
        $_SESSION['admin']['modules'] = null;
        unset($_SESSION['admin']['modules']);
        $_SESSION['admin']['pages'] = null;
        unset($_SESSION['admin']['pages']);

        $this->user->token = null;
        $this->user->token_expires = null;

        return $this->user->save();
    }

    /**
     * Generate a new password hash. Publicly accessible and static so it can
     * be used by the user orm object.
     *
     * @param string $password
     * @return string
     *
     */
    public static function generateHash($password) {
        return password_hash($password, self::ALGORITHM, ['cost' => self::ALGORITHM_COST]);
    }

    /**
     * Checks for a login error message stored in the session.
     *
     * @return string|null
     */
    public function message() {
        if (isset($_SESSION['admin']) && isset($_SESSION['admin']['message'])) {
            $message = $_SESSION['admin']['message'];
            unset($_SESSION['admin']['message']);
            if (!empty($message))
                return $message;
        }

        return null;
    }


    /**
     * Returns whether this user is a admin or not
     * @return bool
     */
    public static function isAdmin(){
        return isset($_SESSION['admin']);
    }

    /**
     * Returns whether this user is a super admin (AYC ADMIN or AYC USER) or not
     * @return bool
     */
    public static function isSuperAdmin(){
        return isset($_SESSION['admin']) && isset($_SESSION['admin']['userlevel']) && $_SESSION['admin']['userlevel'] <= User::TYPE_AYC_USER ? true : false;
    }

    /**
     * @return int
     */
    public static function getUserLevel(){
        return isset($_SESSION['admin']) && isset($_SESSION['admin']['userlevel']) ? $_SESSION['admin']['userlevel'] : false;
    }

    /**
     * @return string
     */
    public static function getUserLevelName(){
        return User::getUserLevelName(static::getUserLevel());
    }

    /**
     * @return bool|array
     */
    public static function getAllowedModules(){
        return isset($_SESSION['admin']) && isset($_SESSION['admin']['modules']) ? $_SESSION['admin']['modules'] : false;
    }


    /**
     * @return bool|array
     */
    public static function getAllowedPages(){
        return isset($_SESSION['admin']) && isset($_SESSION['admin']['pages']) ? $_SESSION['admin']['pages'] : false;
    }

    /**
     * Checks whether the current user is part of a level or series of levels.
     *
     * @param $levels       int[]|int       Level Number or Array of Levels
     *
     * @return bool
     */
    public static function userIsInLevel($levels){
        if(!is_array($levels)) $levels = [$levels];

        return in_array(static::getUserLevel(), $levels);
    }

    /**
     * Generate a random token which we will use in authentication. Uses the openssl
     * extension, which falls back to urandom, which won't work on a windows host.
     *
     * @return string
     */
    private function token() {
        $result = null;

        $openssl = extension_loaded('openssl');

        if ($openssl) {
            $result = openssl_random_pseudo_bytes(self::KEY_SIZE);
        } else {
            $fp = @fopen('/dev/urandom', 'rb');

            if ($fp !== false) {
                $result .= @fread($fp, self::KEY_SIZE);
                @fclose($fp);
            } else {
                trigger_error('Can not open /dev/urandom.');
            }
        }

        return $result;
    }

    /**
     * @param string $cookie
     * @return string
     */
    private function hash($cookie) {
        return hash_hmac('sha256', $cookie, config()->very_secret_key);
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    private function remoteValidate($username, $password) {
        //die('start central authing');
        $result = $this->centralAuth->login($username, $password);
        if (isset($result['success']) && $result['success'] === true) {
            return true;
        }

        return false;
    }

    /**
     * Checks our session information to see if our token is valid, and not
     * being subjected to a timing attack. Set our internal user object if
     * everything looks good.
     *
     * @return bool true if the current session is valid and a user is logged in
     */
    private function parseSession() {
        $cookie = isset($_SESSION['admin']['auth']) ? $_SESSION['admin']['auth'] : null;

        if ($cookie !== null) {
            list ($user_id, $token, $mac) = explode(':', $cookie);
            $user_token = base64_decode($token);

            // Prevent someone from taking a valid token and changing the user id attached to it.
            if ($this->timingSafeCompare($this->hash($user_id . ':' . $user_token), $mac)) {
                return false;
            }

            /**
             * Fetch the user object, check it's token. If it looks good, keep
             * the user object for the life of this object.
             */
            if ($user = User::enabled()->where('id', $user_id)->first()) {
                $safe_token = base64_decode($user->token);
                if ($this->timingSafeCompare($safe_token, $user_token)) {
                    $this->user = $user;
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * A timing safe equals comparison
     *
     * To prevent leaking length information, it is important that user input
     * is always used as the second parameter.
     *
     * @param string $safe The internal (safe) value to be checked
     * @param string $user The user submitted (unsafe) value
     * @return boolean True if the two strings are identical.
     */
    private function timingSafeCompare($safe, $user) {
        /**
         * Prevent issues if string length is 0
         */
        $safe .= chr(0);
        $user .= chr(0);

        $safeLen = strlen($safe);
        $userLen = strlen($user);

        /**
         * Set the result to the difference between the lengths
         */
        $result = $safeLen - $userLen;

        /**
         * Note that we ALWAYS iterate over the user-supplied length. This is
         * to prevent leaking length information.
         */
        for ($i = 0; $i < $userLen; $i++) {
            /**
             * Using % here is a trick to prevent notices. It's safe, since if
             * the lengths are different; $result is already non-0.
             */
            $result |= (ord($safe[$i % $safeLen]) ^ ord($user[$i]));
        }

        /**
         * They are only identical strings if $result is exactly 0...
         */
        return $result === 0;
    }
}