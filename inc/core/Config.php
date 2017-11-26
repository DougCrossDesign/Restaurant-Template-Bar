<?php

use Illuminate\Database\Capsule\Manager as DB;
/**
 * Class Config
 *
 * Global Config properties
 * @property array  domains                 Array of (url => Config::CONST) domain settings
 * @property string theme                   Main theme this site will use
 * @property string very_secret_key         Key used for crypt functions
 * @property bool cli                       Whether this is being run from command-line interface or not
 *
 * Environment properties
 * @property bool   debug                                       Whether this environment is in debug mode or not
 * @property int    error_level_min                             The minimum threshhold for an error to throw (e.g. E_NOTICE)
 * @property int    error_level_max                             The maximum threshhold for an error to throw (e.g. E_ERROR)
 * @property bool error_emails_enabled                          Whether error emails should be sent
 * @property int error_email_threshhold                         The threshhold where emails should start being sent
 * @property bool error_log_to_file                             Whether to log errors to an error log file or not
 * @property bool error_display                                 Whether to display errors
 * @property bool error_display_error_page                      Whether to display errors on a friendly error page
 * @property string error_email_address                         The email address to send errors to
 * @property bool error_display_error_page_friendly_message     Whether to display the friendly error summary to the user
 * @property bool error_display_error_page_backtrace            Whether to display the backtrace on the friendly error page
 */

class Config {
    const DEVELOPMENT = "development";
    const STAGING = "staging";
    const PRODUCTION = "production";

    /**
     * Name of the current environment we're using
     *
     * @var string
     */
    private $env;

    /**
     * Storage for the configuration settings
     *
     * @var array
     */
    private $vars = [];

    /**
     * Storage for our module definition objects
     *
     * @var array
     */
    private $modules = [];

    /**
     * Constructor
     */
    public function __construct() {
        /**
         * Populate our default settings.
         */
        $this->setDefaults();

        /**
         * Get the hostname, which you determine differently in the command line.
         */
        if (PHP_SAPI !== 'cli') {
            $hostname = $_SERVER['SERVER_NAME'];
            $this->vars['cli'] = false;
        } else {
            $hostname = php_uname('n');
            $this->vars['cli'] = true;
        }

        /**
         * Standard settings which are not dependant on server configuration.
         */
        $standard = require(CMS_SYSTEM_DIR . "/config/global.php");
        foreach ($standard as $key => $value) {
            $this->vars[$key] = $value;
        }

        /**
         * From the current hostname, determine which settings to import.
         */
        if (isset($this->vars['domains'])) {
            foreach ($this->vars['domains'] as $domain => $type) {
                if (strpos($hostname, $domain) !== false) {
                    $this->env = $type;
                    $this->vars['local'] = ($type == self::DEVELOPMENT);
                    break;
                }
            }
        }

        /**
         * Configuration dependant settings.
         */
        $specific = require(CMS_SYSTEM_DIR . "/config/config.{$this->env}.php");
        foreach ($specific as $key => $value) {
            $this->vars[$key] = $value;
        }

        /**
         * Set up our database connection settings if we have any.
         */
        if (isset($this->vars['databases'])) {
            foreach ($this->vars['databases'] as $name => $settings) {
                $defaults = array(
                    'driver'    => 'mysql',
                    'host'      => 'localhost',
                    'database'  => '',
                    'username'  => '',
                    'password'  => '',
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => ''
                );

                $this->vars['databases'][$name] = array_merge(
                    $defaults,
                    $this->vars['databases'][$name]
                );
            }
        }
    }

    /**
     * Get property value
     *
     * @param string $name
     * @return mixed|null
     */
    public function __get($name) {
        if (isset($this->vars[$name]))
            return $this->vars[$name];
        return null;
    }

    public function __set($name, $value){
        if (isset($this->vars[$name]))
            $this->vars[$name] = $value;
    }

    /**
     * Does the property exist in our storage
     *
     * @param string $name
     * @return bool
     */
    public function __isset($name) {
        return isset($this->vars[$name]);
    }

    /**
     * Add a module to the current stack
     *
     * @param Module $module
     */
    public function addModule(Module $module) {
        $this->modules[] = $module;
    }

    /**
     * Populate our configuration defaults, most if not all should
     * be overridden by the CMS configuration
     */
    private function setDefaults() {
        /**
         * Default to live unless we can prove otherwise.
         */
        $this->env = self::PRODUCTION;

        /**
         * Domains to configuration type mapping.
         */
        $this->vars['domains'] = array(
            'aycdev.com' => Config::DEVELOPMENT,
            'aycdemo.com' => Config::STAGING
        );

        /**
         * Database connections for this site.
         */
        $this->vars['databases'] = array();
    }

    /**
     * @return \Illuminate\Database\Connection|null
     */
    public function getConnection(){
        foreach($this->databases as $name => $val){
            return DB::connection($name);
        }
        return null;
    }
}