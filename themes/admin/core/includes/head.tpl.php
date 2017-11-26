<!DOCTYPE html>
<? print($sitesplash) ?>
<html class="no-js">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta charset="utf-8">
	<title><?php echo empty($obj-> page_meta) ? "The AYC Center Admin" : $obj-> page_meta["title"] . " | " . $site_title ?></title>
	<meta name="keywords" content="<?php echo isset($obj-> page_meta["keywords"]) ? $obj-> page_meta["keywords"] : "" ?>">
	<meta name="description" content="<?php echo isset($obj-> page_meta["description"]) ? $obj-> page_meta["description"] : "" ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="http://www.aycmedia.com" />
	<link rel="icon" href="/assets/images/favicon.png" />
	<script src="/<?php print('themes/' . config()->theme . '/core/assets/js/head.js'); ?>" async></script>
	<link rel="stylesheet" href="/<?php print('themes/' . config()->theme.'/core/assets/dropzone.css'); ?>">
	<link rel="stylesheet" href="/<?php print('themes/' . config()->theme.'/core/assets/style.css'); ?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<!--[if lte IE 8]><script src="/<?php print($theme_dir.'/assets/js/respond.js'); ?>"></script><![endif]-->
</head>
<!--[if IE 6 ]><body class="ie ie6 lt-ie7 lt-ie8 lt-ie9 lt-ie10 "><![endif]-->
<!--[if IE 7 ]><body class="ie ie7 lt-ie8 lt-ie9 lt-ie10 "><![endif]-->
<!--[if IE 8 ]><body class="ie ie8 lt-ie9 lt-ie10 "><![endif]-->
<!--[if IE 9 ]><body class="ie ie9 lt-ie10 "><![endif]-->
<!--[if gt IE 9]><!--> <body class=""> <!--<![endif]-->
	<!--[if lte IE 8]>
		<p class="chromeframe center">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->