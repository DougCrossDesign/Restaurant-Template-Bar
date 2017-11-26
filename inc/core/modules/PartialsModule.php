<?php
namespace Module;

use Model\User;
use ModuleInterface;

class PartialsModule implements ModuleInterface {

    /**
     * The name of the module as it will appears in menus.
     *
     * @return string
     */
    public static function Name() {
        return "Partials";
    }

    /**
     * The url of the module as it will appear in the backend.
     *
     * @return string
     */
    public static function Url() {
        return "partials";
    }

    /**
     * Returns true if this module will appear in the admin's main navigation.
     *
     * @return bool
     */
    public static function includeInMainNavigation() {
        return true;
    }

    public static function Parent(){
        return "Settings";
    }
    public static function getAllowedUserLevels(){
        return [User::TYPE_AYC_ADMIN, User::TYPE_AYC_USER];
    }
}