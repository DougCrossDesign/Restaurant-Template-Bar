<?php
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Bootstrap {

    /**
     * Ensure this class is only used to house static methods.
     */
    private function __construct() {}


    /**
     * Set up our database connections for this site.
     */
    public static function initEloquent() {
        $capsule = new DB();

        $config = config();

        foreach ($config->databases as $name => $database) {
            $capsule->addConnection($database);
            $connection = $capsule->getConnection($name);

            // keep track of the queries we dispatch during development
            if ($config->debug)
                $connection->enableQueryLog();
            else
                $connection->disableQueryLog();
        }

        $capsule->setEventDispatcher(new Dispatcher(new Container));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }


    /**
     * Set up the session handling for this site.
     */
    public static function initSessions() {
        $session_handler = new SessionDatabase();

        // Manually set session lifetime.
        ini_set("session.gc_maxlifetime", SESSION_LIFETIME);

        // Setup new session handler class.
        session_set_save_handler(
            array(&$session_handler, 'open'),
            array(&$session_handler, 'close'),
            array(&$session_handler, 'read'),
            array(&$session_handler, 'write'),
            array(&$session_handler, 'destroy'),
            array(&$session_handler, 'gc')
        );

        session_start();
    }


    /**
     * Convert the contents of the input super globals to UTF-8, remove invalid
     * bytes sequences, and control characters.
     */
    public static function filterGlobals() {
        $_GET = I18n::filter($_GET, false);
        $_POST = I18n::filter($_POST, false);
    }


    /**
     * PSR-4 compliant auto-loading for the CMS internals.
     *
     * @param string $class
     */
    public static function autoLoad($class) {
        $paths = array(
            "Model\\" => "@/models",
            "Module\\" => "@/modules",
            "Response\\" => "@/responses",
            "Provider\\" => "@/providers",
            "Controller\\" => '@/controllers',
            "AdminController\\" => '/../admin@',
            "" => "",
        );
        // order of precedence when looking for the correct file
        $dirs = array(
            "/site",
            "/core"
        );

        $len = 0;
        $current = null;

        foreach ($paths as $prefix => $path) {
            // does the class use the namespace prefix?
            $len = strlen($prefix);
            if (strncmp($prefix, $class, $len) === 0) {
                $current = "{$path}/";
                break;
            }
        }

        // wasn't found, move to the next autoloader
        if ($current === null){
            return;
        } else if($current === "/"){
            $relative_class = str_replace("\\", "/", substr($class, $len));
            foreach ($dirs as $dir) {
                $classPath = $current . $relative_class . '.php';
                $file = CMS_SYSTEM_DIR . $dir . $classPath;

                if (file_exists($file)) {
                    //echo ' success<br />';
                    require($file);
                    return;
                } else {
                    //echo ' fail<br />';
                }
            }
        } else {
            // get the relative class name
            $relative_class = str_replace("\\", "/", substr($class, $len));

            foreach ($dirs as $dir) {
                $classPath = $current . $relative_class . '.php';
                $partialPath = str_replace("@", $dir, $classPath);
                $file = CMS_SYSTEM_DIR . $partialPath;

                if (file_exists($file)) {
                    //echo ' success<br />';
                    require($file);
                    return;
                } else {
                    //echo ' fail<br />';
                }
            }
        }
    }
}