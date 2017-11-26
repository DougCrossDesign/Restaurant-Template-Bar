<?php
    $config = array();

    /**
     * Domains
     */
    $config['domains'] = array(
        'aycdev.com' => Config::DEVELOPMENT,
        'aycdemo.com' => Config::STAGING
    );

    /**
     * These array keys are turned into @uses \Config object properties on initialization
     * (fetched via magic method)
     */

    /**
     * The main theme this site will use.
     */
    $config['theme'] = "site";

    /**
     * We use this in authentication and encryption, this should be different from site to site!!
     */
    $config['very_secret_key'] = "MDRhNjFkYjU0";

    return $config;