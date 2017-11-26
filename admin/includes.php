<?php
require("../inc/cms.php");


// The web file root for this CMS installation.
define('ADMIN_SYSTEM_DIR', SYSTEM_DIR . '/admin');

// The location of the modules folder relative to the web root.
define('CORE_MODULES_DIR', CMS_SYSTEM_DIR . '/core/modules');
define('SITE_MODULES_DIR', CMS_SYSTEM_DIR . '/site/modules');

// The location of the modules folder relative to the web root.
define('CORE_WIDGETS_DIR', CMS_SYSTEM_DIR . '/core/widgets');
define('SITE_WIDGETS_DIR', CMS_SYSTEM_DIR . '/site/widgets');

// set theme to admin
config()->theme = "admin";

/**
 * PSR-4 compliant auto-loading for the CMS internals.
 *
 * @param string $class
 */
function admin_autoload_psr4($class) {
    // our namespace prefixes and relative paths set for the namespaces we care about
    $paths = array(
        "Controller\\" => "/controllers",
        "AdminController\\" => '',
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
    if ($current === null) return;

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = str_replace('\\', '/', ADMIN_SYSTEM_DIR . $current . $relative_class . '.php');
    //echo 'looking for file: ' . $file . ' ...';
    if (file_exists($file)) {
        //echo ' success <br />';
        require($file);
        return;
    } else {
        echo 'couldnt find file:' . $file;
    }
}

function trace($output){
    $output = date("m/d/Y @ h:i:s A", time()) . ": " . $output . PHP_EOL;
    file_put_contents('notifyLog.txt', $output, FILE_APPEND);
}

/**
 * Register auto-loading for the CMS admin section.
 */
spl_autoload_register("admin_autoload_psr4");

/**
 * Set the admin theme.
 */
Response\PageTemplate::$theme = "admin";