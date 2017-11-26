<?php

/**
 * These array keys are turned into @uses \Config object properties on initialization
 * (fetched via magic method)
 */

use Model\User;

$config = array();

/**
 * Database connections for this site.
 */
$config['databases'] = array(
    'default' => array(
        'host' => 'db.aycmedia.com',
        'database' => 'miamidem_main',
        'username' => 'miamidem_user',
        'password' => 'qgR-d&)hB;mr'
    )
);

/**
 * These array keys are turned into @uses \Config object properties on initialization
 * (fetched via magic method)
 * These properties are all documented in the \Config class
 */
$config['debug'] = true;
$config['enableanalytics'] = false;
$config['error_level_min'] = E_ERROR;
$config['error_level_max'] = E_ERROR;
$config['error_emails_enabled'] = true;
$config['error_email_threshhold'] = E_WARNING;
$config['error_log_to_file'] = true;
$config['error_display'] = true;
$config['error_display_error_page'] = true;
$config['error_display_error_page_friendly_message'] = true;
$config['error_display_error_page_backtrace'] = true;
$config['error_email_address'] = 'tech@aycmedia.com';

$config['globalinjectorpermissions'] = [
    'header' => [User::TYPE_AYC_ADMIN, User::TYPE_AYC_USER],
    'footer' => [User::TYPE_AYC_ADMIN, User::TYPE_AYC_USER],
    'bodyclass' => [User::TYPE_AYC_ADMIN, User::TYPE_AYC_USER],
    'trackingscripts' => [User::TYPE_AYC_ADMIN, User::TYPE_AYC_USER, User::TYPE_CLIENT_ADMIN, User::TYPE_CLIENT_USER]
];

return $config;