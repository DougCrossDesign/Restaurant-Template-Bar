<?php
use Controller\AdminController;
use Controller\BaseController;
use Model\User;

class Module {

    /** @var string */
    public $name;

    /** @var string */
    public $url;

    /** @var string */
    public $providerName;

    /** @var bool */
    public $inSidebar;

    static $modules;

    /**
     * @param string $name
     * @param string $url
     * @param string $providerName
     * @param bool $inSidebar
     */
    public function __construct($name, $url, $providerName, $inSidebar = false) {
        $this->name = $name;
        $this->url = $url;
        $this->providerName = $providerName;
        $this->inSidebar = $inSidebar;
    }

    /**
     * @return object
     */
    public function provider() {
        static $provider = null;
        if ($provider === null)
            $provider = new $this->providerName();
        return $provider;
    }

    public static function exists($moduleName){
        // loop through each file in modules folders
        if(!static::$modules){
            $modules = static::getModuleNames(CMS_SYSTEM_DIR . '/core/modules' . "/*.[pP][hH][pP]") + static::getModuleNames(CMS_SYSTEM_DIR . '/site/modules' . "/*.[pP][hH][pP]");
            static::$modules = $modules;
        }
        return in_array($moduleName, static::$modules);
    }

    /**
     * Find the all the modules in the specified directory and gather their information.
     *
     * @param string $pattern
     * @return array
     */
    public static function getModuleNames($pattern) {
        $modules = [];

        foreach (glob($pattern) as $file) {
            $file_parts = pathinfo($file);
            $module = "Module\\" . $file_parts['filename'];

            if (call_user_func(array($module, 'includeInMainNavigation'))) {
                $module_name = call_user_func(array($module, 'Name'));
                $module_url = call_user_func(array($module, 'Url'));
                $module_parent = call_user_func(array($module, 'Parent'));
                $module_allowed_levels = call_user_func(array($module, 'getAllowedUserLevels'));

                $modules[] = $module_url;
            }
        }

        return $modules;
    }

    public static function getUserAcccessibleModules($pattern, $userid = null) {
        if($userid){
            $user = User::getById($userid);
            $levels = [$user->userlevel];
        } else {
            $levels = [User::TYPE_ALL, User::TYPE_CLIENT_USER, User::TYPE_CLIENT_ADMIN];
        }


        $modules = [];

        foreach (glob($pattern) as $file) {
            $file_parts = pathinfo($file);
            $module = "Module\\" . $file_parts['filename'];

            if (call_user_func(array($module, 'includeInMainNavigation'))) {
                $module_name = call_user_func(array($module, 'Name'));
                $module_url = call_user_func(array($module, 'Url'));
                $module_parent = call_user_func(array($module, 'Parent'));
                $module_allowed_levels = call_user_func(array($module, 'getAllowedUserLevels'));

                if(strlen($module_parent)){
                    if(!empty(array_intersect($levels, $module_allowed_levels))){
                        if(!array_key_exists($module_parent, $modules)) $modules[$module_parent] = [];
                        $modules[$module_parent][$module_name] = $module_url;
                    }
                } else {
                    if(!empty(array_intersect($levels, $module_allowed_levels))) {
                        $modules[$module_name] = $module_url;
                    }
                }
            }
        }

        return $modules;
    }
    public static function getAllUserAccessibleModules(){
        // loop through and return all modules that have TYPE_ALL or TYPE_CLIENT_USER in their allowed user types array

        $mods = static::getUserAcccessibleModules(CORE_MODULES_DIR . "/*.[pP][hH][pP]");
        $sitemods = static::getUserAcccessibleModules(SITE_MODULES_DIR . "/*.[pP][hH][pP]");
        foreach($sitemods as $section => $data){
            if(is_array($data)){
                if(array_key_exists($section, $mods)){
                    $mods[$section] = array_merge($mods[$section], $data);
                }
            } else {
                $mods[$section] = $data;
            }
        }

        ksort($mods);
        foreach($mods as $section => &$data){
            if(is_array($data)) ksort($data);
        }

        $allModules = $mods;
        return $allModules;
    }
}