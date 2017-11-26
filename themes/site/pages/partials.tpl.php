<?php
	/////////////////////////
	// Page Meta / Classes
	/////////////////////////
	$obj-> body_class = array(
		"page" => "pg_partials",
		"site_section" => "sct_partials",
		"layout" => ""
	);
?>

<?php insertInclude("head",$obj); ?>
<?php insertInclude("header",$obj); ?>

<main id="content-main" class="main-content" role="main">
	<div class="page-header" style="background-image:url(<? insertImage('bg-subheader-lg.jpg') ?>)">
		<div class="page-header-text">
			<div>Partials</div>
		</div>
	</div>
	<div class="page-content bg6 c1">
		<div class="wrap wrap-pad clearfix">
			<?php insertPartial("fe_accordion", "default", $obj); ?>
			<?php insertPartial("fe_button_group", "default", $obj); ?>
			<?php insertPartial("fe_html_text", "default", $obj); ?>
			<?php insertPartial("fe_images_row", "default", $obj); ?>
		</div>
	</div>
</main>

<?php insertInclude("footer",$obj); ?>

<!-- Page Specific JS -->
<script>
	$(function(){

	});
</script>
<!-- /Page Specific JS -->

<?php insertInclude("footerclose"); ?>
