<?php
namespace Controller;

use Model\Metadata;
use Model\User;
use Response;
use Input;
use Template;
use Auth;
use Response\Redirect;

abstract class BaseController {

    /** @var Response */
    protected $response = null;

    /** @var bool */
    protected $requiresLogin = false;

    /** @var bool */
    protected $isLoggedIn = false;

    /** @var Auth */
    protected $auth;

    /**
     * Initialize default handling for all constructors. Every leaf class
     * must reference this constructor if it implements one.
     */
    public function __construct() {
        $this->auth = new Auth();

        if ($user_id = $this->auth->isLoggedIn()) {
            $this->isLoggedIn = true;
        }

        if ($this->requiresLogin == true && $this->isLoggedIn == false) {
            $redirect = new Redirect('/admin/login');
            $redirect->render();
            exit();
        }

        // check if this user can access this module
        if(Auth::getUserLevel() == User::TYPE_CLIENT_USER){
            $moduleName = explode("/", str_replace("/admin/", "", \Util::getCurrentCleanUrl()))[0];
            if(!in_array($moduleName, Auth::alwaysAllowedModules())){
                if(!Auth::getAllowedModules() || !in_array($moduleName, Auth::getAllowedModules())){
                    $redirect = new Redirect('/admin/login');
                    $redirect->render();
                    exit();
                }
            }
        }
    }

    /**
     * Every controller must implement an index method, even if it has no other methods.
     *
     * This method will be displayed by default if the Controller is called without a method
     *
     * @return mixed
     */
    abstract public function index();

    /**
     * Runs the controller method specified for the current action.
     *
     * @param string $action
     */
    public function run($action, $args = []) {
        // if no action is specified, assume the index method
        if ($action === null)
            $action = "index";

        // if we don't have the method, issue a 404
        if (!method_exists($this, $action)) {
            $this->show404();
        }

        // try to match the method's parameters from the get variables
        $has_everything = true;
        $reflection = new \ReflectionMethod($this, $action);
        $i = 0;
        foreach ($reflection->getParameters() as $param) {
            $required = !$param->isOptional();
            if($required && !isset($args[$i])){
                $has_everything = false;
                break;
            }
            $i++;
        }

        // if we're missing a required parameter, issue a 404
        if (!$has_everything) {
            $this->show404();
        }

        // invoke the controller method, pass in whatever variables we have
        if (count($args) > 0)
            call_user_func_array(array($this, $action), $args);
        else
            $this->$action();

        return $this->response;
    }

    protected function getAllModules(){
        $mods = $this->getModules(CORE_MODULES_DIR . "/*.[pP][hH][pP]");
        $sitemods = $this->getModules(SITE_MODULES_DIR . "/*.[pP][hH][pP]");
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

        $modules = [
            'Dashboard' => ''
        ];

        $allModules = $modules + $mods;
        return $allModules;
    }

    /**
     * Find the all the modules in the specified directory and gather their information.
     *
     * @param string $pattern
     * @return array
     */
    private function getModules($pattern) {
        $modules = [];

        foreach (glob($pattern) as $file) {
            $file_parts = pathinfo($file);
            $module = "Module\\" . $file_parts['filename'];

            if (call_user_func(array($module, 'includeInMainNavigation'))) {
                $module_name = call_user_func(array($module, 'Name'));
                $module_url = call_user_func(array($module, 'Url'));
                $module_parent = call_user_func(array($module, 'Parent'));
                $module_allowed_levels = call_user_func(array($module, 'getAllowedUserLevels'));

                $moduleAllowed = false;
                if(Auth::getUserLevel() == User::TYPE_AYC_ADMIN){
                    $moduleAllowed = true;
                } else {
                    $levelsToCheckAgainst = Auth::getUserLevel() == User::TYPE_CLIENT_USER ? Auth::getAllowedModules() : [Auth::getUserLevel(), User::TYPE_ALL];
                    $moduleAllowed = Auth::getUserLevel() == User::TYPE_CLIENT_USER ? in_array($module_url, $levelsToCheckAgainst) : !empty(array_intersect($levelsToCheckAgainst, $module_allowed_levels));
                }


                if(strlen($module_parent)){
                    if($moduleAllowed){
                        if(!array_key_exists($module_parent, $modules)) $modules[$module_parent] = [];
                        $modules[$module_parent][$module_name] = $module_url;
                    }
                } else {
                    if(!empty(array_intersect($levelsToCheckAgainst, $module_allowed_levels))) {
                        $modules[$module_name] = $module_url;
                    }
                }
            }
        }

        return $modules;
    }


    /**
     * Use to post a template within the base-template template
     *
     * @param $templates
     * @param array $vars
     */
    protected function showPart($templates, $vars = []){
        if(!is_array($templates)) $templates = [$templates];

        /*
        if(!array_key_exists('metadata',$templates)){
            $templates['metadata'] = Metadata::getTemplateByUrl();
        }*/

        $response = new \Response\PageTemplate($templates);
        $response->renderPart($vars);
        die();
    }

    /**
     * Shows the current templates by passing them to a \Response\PageTemplate object and rendering it
     *
     * @param $templates Template[]|Template
     */
    protected function show($templates){
        if(!is_array($templates)) $templates = [$templates];

        /*
        if(!array_key_exists('metadata',$templates)){
            $templates['metadata'] = Metadata::getTemplateByUrl();
        }*/

        $response = new Response\PageTemplate($templates);

        $response->render();
        die();
    }

    /**
     * Shows a generic 404 page
     *
     * Renders a generic 404 Response
     */
    protected function show404(){
        Response::createGeneric404()->render();
        die();
    }

    /**
     * Redirects to a URL
     *
     * Renders a Redirect Response to the $url sent in.
     * Should be in this format 'admin/users' etc.
     *
     * @param string $url   The URL to redirect to in 'controller/method/param/param' format
     */
    protected function redirect($url){
        (new Response\Redirect($url))->render();
        die();
    }
}