<?php
require_once("../../../inc/cms.php");

try {
    // Setup AutoThumb and configure standard CMS settings.
    $autoThumb = new AutoThumb(__DIR__);

    $autoThumb->forceRefresh(true);

    $autoThumb->config('cms', 100, 100)
        ->cropType(AutoThumbConfig::CROP_MIN)
        ->scaleUp(true);

    $autoThumb->config('cms-lg', 200, 200)
        ->cropType(AutoThumbConfig::CROP_MIN)
        ->scaleUp(true);

    $autoThumb->config('preview', 500, 250)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);

    $autoThumb->config('full', 500, 400)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);
    
    // Process requested file
    $response = $autoThumb->process(Input::get("alias"), Input::get("file"));

    // Send output to browser
    $response->render();

} catch (Exception $e) {
    Error::exception($e);
}
