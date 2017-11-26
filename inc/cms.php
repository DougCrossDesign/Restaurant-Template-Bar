<?php

/**
 * Begin capturing stats the moment we're included
 */
define('START_TIME', microtime(true));
define('START_MEMORY_USAGE', memory_get_usage());



/**
 * Bring in all constants and global functions.
 */
require("core/Constants.php");
require("core/Globals.php");
require("site/Globals.php");
timerStart();
timerRecordInterval('loading cms');
require("core/Bootstrap.php");



/**
 * Set timezone
 */
date_default_timezone_set("America/New_York");

/**
 * Register auto-loading for the CMS internals.
 */
spl_autoload_register("Bootstrap::autoLoad");

/**
 * Enable global error handling.
 */
set_error_handler(array('Error', 'handler'));
register_shutdown_function(array('Error', 'fatal'));

/**
 * Bring in our third party dependencies.
 */
require(SYSTEM_DIR . "/vendor/autoload.php");

/**
 * Initialize all our global systems.
 */
Bootstrap::initEloquent();
Bootstrap::initSessions();

/**
 * Perform any initialization necessary.
 */
Bootstrap::filterGlobals();

/**
 * The main theme our site is going to be using.
 */
Response\PageTemplate::$theme = config()->theme;

/**
 * Configure error handling.
 */
if(config()->debug){
    error_reporting(E_ALL);
    ini_set("display_errors", "on");
}
//TODO look into this as we do not want to trump what we added.

/**
 * Bring in any site specific global functionality.
 */
require("site/include.php");


require(SYSTEM_DIR . "/inc/config/sitevars.php");
require(SYSTEM_DIR . "/inc/config/functions.php");



