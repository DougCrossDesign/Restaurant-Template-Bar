<?php

/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 4/11/2016
 * Time: 3:26 PM
 */

//TODO evaluete the need for this in it's own file or into a utilities file.
class Date
{
    public static function format($timestamp, $format = 'M. jS, Y - g:ia'){
        return date($format, $timestamp);
    }
}