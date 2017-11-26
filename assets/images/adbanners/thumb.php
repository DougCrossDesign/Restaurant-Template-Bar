<?php
require_once("../../../inc/cms.php");

try {
    // Setup AutoThumb and configure standard CMS settings.
    $autoThumb = new AutoThumb(__DIR__);

    $autoThumb->forceRefresh(true);

    $autoThumb->config('medium', 300, 250)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);

    $autoThumb->config('small', 300, 100)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);

    $autoThumb->config('bottomwide', 454, 94)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);

    $autoThumb->config('bottomverywide', 728, 90)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);

    $autoThumb->config('footer', 970, 90)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);

    $autoThumb->config('thumb', 200, 200)
        ->cropType(AutoThumbConfig::CROP_MIN)
        ->scaleUp(true);


    $autoThumb->config('rollover', 400, 400)
        ->cropType(AutoThumbConfig::CROP_MIN)
        ->scaleUp(true);

    // Process requested file
    $response = $autoThumb->process(Input::get("alias"), Input::get("file"));

    // Send output to browser
    $response->render();

} catch (Exception $e) {
    Error::exception($e);
}
