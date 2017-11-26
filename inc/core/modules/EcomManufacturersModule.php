<?php
namespace Module;

use Model\User;
use ModuleInterface;

class EcomManufacturersModule implements ModuleInterface {

    /**
     * The name of the module as it will appears in menus.
     *
     * @return string
     */
    public static function Name() {
        return "Manufacturers";
    }

    /**
     * The url of the module as it will appear in the backend.
     *
     * @return string
     */
    public static function Url() {
        return "manufacturers";
    }

    /**
     * Returns true if this module will appear in the admin's main navigation.
     *
     * @return bool
     */
    public static function includeInMainNavigation() {
        return false;
    }

    public static function Parent(){
        return "E-Commerce";
    }
    public static function getAllowedUserLevels(){
        return [User::TYPE_ALL];
    }
}