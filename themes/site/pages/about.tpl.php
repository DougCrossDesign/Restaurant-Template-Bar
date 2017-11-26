<?php
	/////////////////////////
	// Page Meta / Classes
	/////////////////////////
	$obj-> body_class = array(
		"page" => "pg_about",
		"site_section" => "sct_about",
		"layout" => ""
	);

?>

<?php insertInclude("head",$obj); ?>
<?php insertInclude("header",$obj); ?>

<main id="content-main" class="main-content" role="main">
	<?php insertPartial("fe_hero_wide", "interior", $obj); ?>
	<!-- <div class="page-header" style="background-image:url(<? insertImage('stumble-inn/about-header.jpg') ?>)">
		<div class="wrap-sm page-header-text clearfix">
			<h1 class="hdr1 about-header-title">About</h1>
			<p class="about-header-desc center clearfix">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis, urna sit amet dapibus auctor, velit diam pharetra elit, vel finibus tortor quam sed nisl.
			</p>
		</div>
	</div> -->

	<div class="page-content center">
		<div class="wrap wrap-pad clearfix">
			<div class="clearfix">
				<div class="about-content">
					<h4 class="hdr4 about-content-title">
						Sub title Goes Here
					</h4>
					<div class="entry-content">
						<p>
							Hero Body Content Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis, urna sit amet dapibus auctor, velit diam pharetra elit, vel finibus tortor quam sed nisl. Quisque a risus elit. Vivamus ac metus mauris elit. Vivamus ac metus mauris.elit. Vivamus ac metus mauris.Hero Body Content Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis, urna sit amet dapibus auctor, velit diam pharetra elit.
						</p>
					</div>
				</div>

				<div class="auto-2-1 col-space1 about-img-row clearfix">
					<div class="col">
						<img src="themes/site/assets/images/stumble-inn/about-image-left.jpg"  alt="Photo" />
					</div>
					<div class="col">
						<img src="themes/site/assets/images/stumble-inn/about-image-right.jpg"  alt="Photo" />
					</div>
				</div>

				<div class="about-content clearfix">
					<div class="entry-content">
						<p>
							Hero Body Content Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis, urna sit amet dapibus auctor, velit diam pharetra elit, vel finibus tortor quam sed nisl. Quisque a risus elit. Vivamus ac metus mauris elit. Vivamus ac metus mauris.elit. Vivamus ac metus mauris.Hero Body Content Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis, urna sit amet dapibus auctor, velit diam pharetra elit. Quisque a risus elit. Vivamus ac metus mauris elit. Vivamus ac metus mauris.elit.
						</p>
					</div>
				</div>
			</div>

		</div>
	</div>

	<div class="about-sec2">
		<?php insertPartial("fe_google_viewer","default", $obj); ?>
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
