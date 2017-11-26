<?php
require_once("../../../inc/cms.php");

try {
    // Setup AutoThumb and configure standard CMS settings.
    $autoThumb = new AutoThumb(__DIR__);

    $autoThumb->forceRefresh(true);

    $autoThumb->config('medium', 320, 200)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);

    $autoThumb->config('thumb', 100, 100)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);

    // Process requested file
    $response = $autoThumb->process(Input::get("alias"), Input::get("file"));

    // Send output to browser
    $response->render();

} catch (Exception $e) {
    Error::exception($e);
}
