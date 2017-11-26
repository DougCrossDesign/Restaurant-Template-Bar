<?php

class SiteLocationAccordionInjector implements PartialInjector {
    const GOOGLE_API_KEY = "AIzaSyAGfL_IRAbvsObMamHlc2lbeTU7yGX4tu4"; // todo: update google key with info for this site?!
    public static $address = '';

    public static function preUpdate($model){}
    public static function preSave($model){}
    public static function postSave($model){}
    public static function preRender($model) {}
    public static function postRender($model) {}

    public static function preUpdateMeta($model) {}
    public static function preSaveMeta($model){

        $address = $model->address_street . " " .$model->address_city . " " .$model->address_state . " " .$model->address_zip;

        // here we look for google api lat + long
        $requesturl  = "https://maps.googleapis.com/maps/api/geocode/xml?";
        $requesturl .= "&address=" . urlencode($address);
        $requesturl .= "&key=" . static::GOOGLE_API_KEY;
        $xml = simplexml_load_file($requesturl);
        $status = $xml->status;
        if ($status == "OK") {
            // Successful geocode
            $model->lat = (float)$xml->result->geometry->location->lat;
            $model->lng = (float)$xml->result->geometry->location->lng;
        } else {
            die($xml);
        }
    }
    public static function postSaveMeta($model){}
}