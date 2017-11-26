<?php
require_once("../../../inc/cms.php");

try {
    // Setup AutoThumb and configure standard CMS settings.
    $autoThumb = new AutoThumb(__DIR__);

    $autoThumb->forceRefresh(true);

    $autoThumb->config('thumb', 372, 175)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);


    $autoThumb->config('listing', 300, 141)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);


    $autoThumb->config('details', 1155, 542)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);

    $autoThumb->config('interested', 300, 141)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);


    $autoThumb->config('listingthumb', 200, 138)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);

    $autoThumb->config('detailsthumb', 200, 94)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);

    $autoThumb->config('interestedthumb', 200, 138)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);



    $autoThumb->config('listingrollover', 288, 198)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);

    $autoThumb->config('detailsrollover', 400, 188)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);

    $autoThumb->config('interestedrollover', 288, 198)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);


    $autoThumb->config('full', 500, 400)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);

    $autoThumb->config('rollover', 358, 172)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);

    $autoThumb->config('preview', 500, 250)
        ->cropType(AutoThumbConfig::CROP_MAX)
        ->scaleUp(true);


    // Process requested file
    $response = $autoThumb->process(Input::get("alias"), Input::get("file"));

    // Send output to browser
    $response->render();

} catch (Exception $e) {
    Error::exception($e);
}
