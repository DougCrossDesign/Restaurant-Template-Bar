<?php
require_once("../../../inc/cms.php");

try {
    // Setup AutoThumb and configure standard CMS settings.
    $autoThumb = new AutoThumb(__DIR__);

    $autoThumb->forceRefresh(true);

    $autoThumb->config('full', 800, 800)
        ->cropType(AutoThumbConfig::CROP_MIN)
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
