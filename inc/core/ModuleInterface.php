<?php
interface ModuleInterface {

    /**
     * The name of the module as it will appears in menus.
     *
     * @return string
     */
    public static function Name();

    /**
     * The url of the module as it will appear in the backend.
     *
     * @return string
     */
    public static function Url();

    /**
     * Returns true if this module will appear in the admin's main navigation.
     *
     * @return bool
     */
    public static function includeInMainNavigation();

    public static function Parent();

    public static function getAllowedUserLevels();
}