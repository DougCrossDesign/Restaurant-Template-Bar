<?php
	/////////////////////////
	// Page Meta / Classes
	/////////////////////////
	$obj-> body_class = array(
		"page" => "pg_faqs",
		"site_section" => "sct_faqs",
		"layout" => ""
	);
?>

<?php insertInclude("head",$obj); ?>
<?php insertInclude("header",$obj); ?>

<main id="content-main" class="main-content" role="main">
	<div class="page-header-small" style="background-image:url(<? insertImage('bg-subheader-lg.jpg') ?>)">
		<div class="page-header-text">
			<div>FAQs</div>
		</div>
	</div>
	<div class="page-content bg6 c1">
		<div class="wrap-sm wrap-pad clearfix">
			<center>
				<?php insertPartial("fe_html_text", "default", $obj); ?>
			</center>
			<?php insertPartial("fe_accordion", "default", $obj); ?>
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
