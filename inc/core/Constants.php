<?php

//TODO Evaluate need for this file?
// The directory where the CMS's core functionality lives.
define('CMS_SYSTEM_DIR', str_replace('/core', '', realpath(__DIR__)));

// The web file root for this CMS installation.
define('SYSTEM_DIR', str_replace('/inc', '', CMS_SYSTEM_DIR));

// Base directory
define('TEMPLATE_DIR', SYSTEM_DIR . '/themes');

// File extension for our template files/
define('TEMPLATE_EXT', ".tpl.php");

// Is this an AJAX request?
define('AJAX_REQUEST', strtolower(getenv('HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest');

// The current site path
define('CURRENT_PATH', parse_url(getenv('REQUEST_URI'), PHP_URL_PATH));

// The current TLD address, scheme, and port
define('DOMAIN', (strtolower(getenv('HTTPS')) == 'on' ? 'https' : 'http') . '://'
    . getenv('HTTP_HOST') . (($port = getenv('SERVER_PORT')) != 80 && $port != 443 ? ":$port" : ''));

// Session lifetime used by this application, set to 8 hours.
define('SESSION_LIFETIME', 8*60*60);

// Use stored procedures or their code redundancies?
define('USING_STORED_PROCEDURES', true);
