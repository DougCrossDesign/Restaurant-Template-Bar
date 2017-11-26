<?php
require_once("../../../../inc/cms.php");

try {
	// Setup AutoThumb and configure standard CMS settings.
	$autoThumb = new AutoThumb( __DIR__);

	$autoThumb->forceRefresh(true);

	$autoThumb->config('cms', 150, 120)
		->cropType(AutoThumbConfig::CROP_MAX)
		->scaleUp(true);

	$autoThumb->config('wide', 1900, 420)
		->cropType(AutoThumbConfig::CROP_MIN)
		->scaleUp(false);

	$autoThumb->config('full', 1000, 1000)
		->cropType(AutoThumbConfig::CROP_MIN)
		->scaleUp(false);

	$autoThumb->config('story', 500, 250)
		->cropType(AutoThumbConfig::CROP_MAX)
		->scaleUp(false);

	$autoThumb->config('thumb', 700, 466)
		->cropType(AutoThumbConfig::CROP_MAX)
		->scaleUp(true);

	// Process requested file
	$response = $autoThumb->process(Input::get("alias"), Input::get("file"));

	// Send output to browser
	$response->render();
} catch (Exception $e) {
	Error::exception($e);
}
