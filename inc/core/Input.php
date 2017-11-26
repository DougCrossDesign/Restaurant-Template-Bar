<?php
class Input {

    /**
     * Safely fetch a $_POST value by key name
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    public static function post($key = null) {
        if ($key === null)
            return static::purifyArray($_POST);

        $purifier = HTMLPurifier::instance();
        if(isset($_POST[$key])){
            $val = $_POST[$key];
            if(is_array($val)){
                return static::purifyArray($val);
            } else {
                return $purifier->purify($val);
            }
        } else {
            return '';
        }
    }
    protected static function purifyArray($array){
        $purifier = HTMLPurifier::instance();

        $output = [];
        if(is_array($array)){
            foreach($array as $key => $val){
                if(is_array($val)){
                    $output[$key] = static::purifyArray($val);
                } else {
                    $output[$key] = $purifier->purify($val);
                }
            }
            return $output;
        } else {
            return $purifier->purify($array);
        }
    }

    /**
     * Safely fetch a $_GET value by key name
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key = null) {
        if ($key === null)
            return static::purifyArray($_GET);

        $purifier = HTMLPurifier::instance();
        if(isset($_GET[$key])){
            $val = $_GET[$key];
            if(is_array($val)){
                return static::purifyArray($val);
            } else {
                return $purifier->purify($val);
            }
        } else {
            return '';
        }
    }

    /**
     * Safely fetch a $_COOKIE value by key name
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function cookie($key, $default = null) {
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : $default;
    }

    /**
     * Safely fetch a $_SESSION value by key name
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function session($key, $default = null) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }
}