<?php

/**
 * A simple holder class that holds the Controller/Method/args... style of data
 */
class Route
{
    public $controller;
    public $method;
    public $arguments = [];

    /**
     * Creates and returns a Route object by parsing a route string
     * Or null if the input string isn't quite right.
     *
     * @param $string
     *
     * @return null|Route
     */
    public static function fromString($string){
        if(!strlen($string)) return null;

        $parts = explode("/", $string);
        $rawParts = array_filter($parts);
        $parts = [];
        foreach($rawParts as $part){
            $parts[] = $part;
        }

        if(!count($parts)) return null;

        $route = new Route();

        $props = [
            0 => "controller",
            1 => "method"
        ];
        foreach($props as $index => $name){
            if(array_key_exists($index, $parts)){
                $route->{$name} = $parts[$index];
            }
        }
        $i = 2;
        while(array_key_exists($i, $parts)){
            $route->arguments[] = $parts[$i];
            $i++;
        }

        return $route;
    }
}