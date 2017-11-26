<?php
class Util {

    // Format string for mysql datetime fields
    const DATETIME_FORMAT = "Y-m-d H:i:s";

    public static $STATES = ['AL' => 'Alabama','AK' => 'Alaska','AZ' => 'Arizona','AR' => 'Arkansas','CA' => 'California','CO' => 'Colorado','CT' => 'Connecticut','DE' => 'Delaware','DC' => 'District Of Columbia','FL' => 'Florida','GA' => 'Georgia','HI' => 'Hawaii','ID' => 'Idaho','IL' => 'Illinois','IN' => 'Indiana','IA' => 'Iowa','KS' => 'Kansas','KY' => 'Kentucky','LA' => 'Louisiana','ME' => 'Maine','MD' => 'Maryland','MA' => 'Massachusetts','MI' => 'Michigan','MN' => 'Minnesota','MS' => 'Mississippi','MO' => 'Missouri','MT' => 'Montana','NE' => 'Nebraska','NV' => 'Nevada','NH' => 'New Hampshire','NJ' => 'New Jersey','NM' => 'New Mexico','NY' => 'New York','NC' => 'North Carolina','ND' => 'North Dakota','OH' => 'Ohio','OK' => 'Oklahoma','OR' => 'Oregon','PA' => 'Pennsylvania','RI' => 'Rhode Island','SC' => 'South Carolina','SD' => 'South Dakota','TN' => 'Tennessee','TX' => 'Texas','UT' => 'Utah','VT' => 'Vermont','VA' => 'Virginia','WA' => 'Washington','WV' => 'West Virginia','WI' => 'Wisconsin','WY' => 'Wyoming'];

    public static function getParsedYoutubeId($string){
        $match = [];
        $video_id = $string;
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $string, $match)) {
            $video_id = $match[1];
        }
        return $video_id;
    }

    public static function addTrailingSlash($dir){
        if(substr($dir, strlen($dir) - 1,1) != "/"){
            return $dir . "/";
        } else {
            return $dir;
        }
    }

    /** Returns a lower case URL with all special characters removed */
    public static function getCleanUrl($string){
        return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
    }
    public static function getSlug($string){
        return static::getCleanUrl($string);
    }
    public static function slug($string){
        return static::getCleanUrl($string);
    }

    /**
     * Ensure this class is only used to house static methods.
     */
    private function __construct() {}

    public static function chopUrl($url, $limit){
        if(strlen($url) <= $limit) return $url;
        return substr($url, 0 , $limit) . "...";
    }

    /**
     * Returns the current URL without any GETVARs
     *
     * @return string   The clean URL
     */
    public static function getCurrentCleanUrl(){
        $url = $_SERVER['REQUEST_URI'];
        // chop everything after the ?
        if($questionPosition = strpos($url, "?")){
            $url = substr($url, 0, $questionPosition);
        }
        return $url;
    }

    /**
     * A simple check if a certain field has been used or not for the honeypot.
     * By default, if you set a form input field with id "email_address",
     * it will be hidden using JS so only bots fill it out.
     *
     * @param string $field
     *
     * @return bool
     */
    public static function honeypotUsed($field = "email_address"){
        if(strlen(Input::post($field))){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Append the correct slash to the end of the specified path.
     *
     * @param string $path
     * @return string
     */
    public static function formatPath($path) {
        return rtrim($path, " \t\n\r\0\x0B\\/") . DIRECTORY_SEPARATOR;
    }

    /**
     * @param string $format
     * @param int|null $timestamp
     * @return bool|string
     */
    public static function formatDate($format, $timestamp = null) {
        if ($timestamp === null)
            $timestamp = time();

        return date(self::DATETIME_FORMAT, strtotime($format, $timestamp));
    }

    /**
     * Ensures $value is always within $min and $max range. If lower, $min is
     * returned. If higher, $max is returned.
     *
     * @param int|float $value
     * @param int|float $min
     * @param int|float $max
     * @return int|float
     */
    public static function clamp($value, $min, $max) {
        if ($value < $min) {
            return $min;
        }

        if ($value > $max) {
            return $max;
        }

        return $value;
    }

    /**
     * Searches the path specified for files with the specified name, and deletes them.
     *
     * @param string $file_name Name of the file to delete
     * @param string $path The starting path where to look for a file with that name
     * @return int The number of files found and deleted
     */
    public static function deleteFileInPath($file_name, $path) {
        $count = 0;

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        /** @var \SplFileInfo $info */
        foreach ($files as $info) {
            if ($info->getBasename() === $file_name) {
                unlink($info->getRealPath());
                $count++;
            }
        }

        return $count;
    }

    /**
     * Plucks values from array number two and put them in number one. This is
     * a more intuitive way (to me) of merging arrays than PHP provides.
     *
     * @param array $one
     * @param array $two
     * @return array
     */
    public static function arrayCombine(array $one, array $two) {
        foreach ($two as $key => $value) {
            if (isset($two[$key])) {
                if (is_array($two[$key])) {
                    if (!isset($one[$key])) $one[$key] = [];
                    $one[$key] = self::arrayCombine($one[$key], $two[$key]);
                } elseif (!is_null($two[$key])) {
                    if (!isset($one[$key])) $one[$key] = null;
                    $one[$key] = $two[$key];
                }
            }
        }

        return $one;
    }

    /** Checks that the url starts with http:// or a leading slash */
    public static function isValidUrl($url){
        $prefixes = ['/', 'http://', 'https://'];
        foreach($prefixes as $prefix){
            if(strpos($url, $prefix) === 0) return true;
        }
        return false;
    }

    /**
     * Generates a summary of a long string of text, appending a "..." if necessary.
     *
     * @param $string   string  
     * @param $length   int
     *
     * @return string
     */
    public static function generateSummary($string, $length){
        if(strlen($string) <= $length) return $string;

        $substr = substr($string, 0, $length);
        $parts = explode(" ", $substr);
        array_pop($parts);
        return implode(" ", $parts) . "...";
    }
}