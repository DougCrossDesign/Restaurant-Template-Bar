<?php

use Model\BrokenLink;
use Model\FriendlyUrl;
use Model\Redirect;
/**
 * Class used for Routing the program to the correct page from the database or infers the
 * Route to a Controller/Method
 * Or renders a generic 404
 */
class Router
{

    /**
     * Routes the program following these steps:
     *
     * 0. Checked for physical file
     * 1. Check for Redirects
     * 2. Check for Friendly URL
     * 3. Infer and send to Controller/Method
     *
     * @param $folder   The folder if exists (e.g. 'admin' should route to the /admin folder)
     */
    public static function route($folder = null){
        // first check through static routes
        static::checkStaticRoutes();

        $url = explode("?", $_SERVER['REQUEST_URI']);
        $getVars = count($url) > 1 ? $url[1] : null;
        $urlParts = array_filter(explode("/", $url[0]));

        // check for a redirect
        static::checkForRedirect();

        // holders for controller and method
        $controllerName = '';
        $methodName = '';
        $args = [];

        // call controller method
        static::infer($urlParts, $controllerName, $methodName, $args, $folder);
        static::callControllerMethod($controllerName, $methodName, $args, $getVars, $folder);

        // check for friendly url
        $route = static::checkForFriendlyURL();
        if($route){
            $controllerName = $route->controller;
            $methodName = $route->method;
            $args = $route->arguments;
        }
        static::callControllerMethod($controllerName, $methodName, $args, $getVars, $folder);

        // nothing found; log & show 404
        static::log404();
        (new \Response\Redirect("/error"))->render();
    }

    public static function log404(){
        BrokenLink::createIfIPAddressNotFound();
    }
    protected static function checkStaticRoutes(){
        $thisUrl = $_SERVER['REQUEST_URI'];
        $staticRoutes = [
            "shared/event_detail.aspx" => "/events"
        ];

        foreach($staticRoutes as $url => $dest){
            if(strpos($thisUrl, $url) !== false){
                die((new \Response\Redirect($dest))->render());
            }
        }
    }

    /**
     * Calls a Controller method based on the passed in params
     * On fail renders a generic 404 page.
     *
     * @param $controllerName
     * @param $methodName
     * @param $args
     * @param $getVars
     */
    protected static function callControllerMethod($controllerName, $methodName, $args, $getVars, $folder){
        $controllerBaseName = strlen($folder) ? ucfirst(strtolower($folder)) : '';
        $controllerName = static::clean($controllerName);
        $controllerName = $controllerBaseName . 'Controller\\' . ucfirst($controllerName);
        if (class_exists($controllerName)) {
            // controller found; create
            /** @var \Controller\BaseController $controller */
            $controller = new $controllerName();
            if(method_exists($controller, $methodName)) {
                foreach(explode("&", $getVars) as $getVarPart){
                    $getVarParts = explode("=", $getVarPart);
                    $_GET[$getVarParts[0]] = (count($getVarParts) > 1) ? $getVarParts[1] : null;
                }

                $result = $controller->run($methodName, $args);
            } else {
                // method not found; 404

            }
        } else {

        }
    }

    /**
     * Attempts to infer the route from the current URL
     * And sets the values by reference for use in the main Route function
     *
     * @param $urlParts
     * @param $controllerName
     * @param $methodName
     * @param $args
     * @param $folder
     */
    public static function infer($urlParts, &$controllerName, &$methodName, &$args, $folder){
        if (count($urlParts)) {
            $parts = array();
            foreach ($urlParts as $part) {
                if (strlen($part)) {
                    $parts[] = $part;
                }
            }

            /** @var The Controller position in the url array $c. Using $c instead of something more descriptive so it looks like an iterator  */
            $c = strlen($folder) ? 1 : 0;

            $controllerName = static::clean(ucfirst(strtolower($parts[$c])));
            $methodName = static::clean(ucfirst(count($parts) > ($c+1) ? $parts[($c+1)] : "index"));
            if(count($urlParts) > ($c+2)){
                for($i = ($c+2); $i < count($parts); $i++){
                    $args[] = $parts[$i];
                }
            }
        }
    }

    public static function clean($string){
        $string = str_replace("-", "", $string);
        return $string;
    }

    /**
     * Looks for a Friendly URL using the REQUEST_URI
     * With Active = 1
     * And returns the Route or NULL
     *
     * @return null|Route
     */
    public static function checkForFriendlyURL(){
        $route = null;
        // active first
        $friendlyUrl = FriendlyUrl::getActiveFromURL();
        if($friendlyUrl){
            $route = Route::fromString($friendlyUrl->route);
        } else {
            // inactive + redirect next
            $friendlyUrl = FriendlyUrl::getRedirectFromURL();
            if($friendlyUrl){
                //$route = Route::fromString(strlen($friendlyUrl->redirect) ? $friendlyUrl->redirect : $friendlyUrl->route);
                $response = new \Response\Redirect($friendlyUrl->redirect, false);
                $response->render();
                die();
            }
        }
        return $route ?: null;
    }

    /**
     * Looks for a Redirect using the REQUEST_URI
     * And fires the Redirect
     */
    public static function checkForRedirect(){
        // check for request with ?get var still attached
        /** @var Redirect $redirect */
        $redirect = Redirect::getByUrl(null, false);
        if($redirect){
            $response = new \Response\Redirect($redirect->destination, $redirect->permanent);
            $response->render();
            die();
        }

        $redirect = null;

        // check for request with ?get var chopped off
        /** @var Redirect $redirect */
        $redirect = Redirect::getByUrl();
        if($redirect){
            $response = new \Response\Redirect($redirect->destination, $redirect->permanent);
            $response->render();
            die();
        }
    }
}