<?php
namespace Module;

use Model\User;
use ModuleInterface;

class FriendlyUrlsModule implements ModuleInterface {

    /**
     * The name of the module as it will appears in menus.
     *
     * @return string
     */
    public static function Name() {
        return "Friendly URLs";
    }

    /**
     * The url of the module as it will appear in the backend.
     *
     * @return string
     */
    public static function Url() {
        return "friendlyurls";
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
        return "Admin Tools";
    }
    public static function getAllowedUserLevels(){
        return [User::TYPE_AYC_ADMIN];
    }
}