<?php use Model\GlobalPageInjection;
$bodyClasses = [GlobalPageInjection::getValueByName("Body Class")];
if(isset($obj->bodyclass)){
	$bodyClasses[] = $obj->bodyclass;
}
$bodyClasses = implode(' ', $bodyClasses);
if(!isset($obj->body_class)) $obj->body_class = [];
?>
<!DOCTYPE html>
<?php print($sitesplash) ?>
<html class="no-js" lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta charset="utf-8">
	<title>Stumble Inn</title>
	<meta name="keywords" content="<?php echo isset($obj->global->page_meta->keywords) ? $obj->global->page_meta->keywords : "" ?>">
	<meta name="description" content="<?php echo isset($obj->page_meta->global->description) ? $obj->global->page_meta->description : "" ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="http://www.aycmedia.com" />

	<link rel="icon" href="/assets/favicon/favicon.ico" />
	<link rel="apple-touch-icon" sizes="57x57" href="/assets/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/assets/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/assets/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/assets/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/assets/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/assets/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/assets/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/assets/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/assets/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/assets/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">

	<link rel="manifest" href="/assets/favicon/manifest.json">
	<script src="/<?php print($theme_dir.'/assets/head.js'); ?>"></script>
	<link rel="stylesheet" href="/<?php print($theme_dir.'/assets/style.css'); ?>">
	<!--[if lte IE 8]><script src="/<?php print($theme_dir.'/assets/js/respond.js'); ?>"></script><![endif]-->
	<?php echo isset($obj->global->headerinsert) ? $obj->global->headerinsert : "" ; ?>
	<?php echo isset($obj->headerinsert) ? $obj->headerinsert : "" ; ?>
</head>
<!--[if IE 7 ]><body class="ie ie7 lt-ie8 lt-ie9 lt-ie10 <?php print implode(" ", $obj-> body_class); ?> <?php echo $bodyClasses; ?>"><![endif]-->
<!--[if IE 8 ]><body class="ie ie8 lt-ie9 lt-ie10 <?php print implode(" ", $obj-> body_class); ?> <?php echo $bodyClasses; ?>"><![endif]-->
<!--[if IE 9 ]><body class="ie ie9 lt-ie10 <?php print implode(" ", $obj-> body_class); ?> <?php echo $bodyClasses; ?>"><![endif]-->
<!--[if gt IE 9]><!--> <body class="<?php print implode(" ", $obj-> body_class); ?> <?php echo $bodyClasses; ?>"> <!--<![endif]-->
	<!--[if lte IE 8]>
		<?php /*<p class="chromeframe center">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>*/ ?>
	<![endif]-->
