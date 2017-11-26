<?php
	/////////////////////////
	// Page Meta / Classes
	/////////////////////////
	$obj-> body_class = array(
		"page" => "pg_home",
		"site_section" => "sct_home",
		"layout" => ""
	);
?>

<?php insertInclude("head",$obj); ?>
<?php insertInclude("header",$obj); ?>

<main id="content-main" class="main-content" role="main">
	<?php insertPartial("fe_hero_wide", "default", $obj); ?>

	<div class="home-sec1 c1">
		<div class="wrap clearfix vert-pad">
			<?php insertPartial('weekday_specials_tabs', 'default'); ?>
		</div>
	</div>

	<div class="home-sec2" style="background-image:url(<? insertImage('stumble-inn/SI-come-celebrate-bg.jpg') ?>)">
		<div class="home-sec2-overlay">
			<div class="wrap celebrate-container">
				<div class="col-space3 col-pad-lg clearfix">
					<div class="col col1-2 eqheight celebrate-left-container clearfix">
						<div class="col col4-5 celebrate-left">
							<h2 class="celebrate-left-head">Come Celebrate &amp; Host your Event with Us</h2>
							<p class="celebrate-left-content">Want to show that you and your friends got down at one of NYC Best Bar's eight legendary
								 locations? Well, then you're definitely going to want to pick up some of NYC Best Bars'
								 classic merchandise as a bona fide badge of honor!</p>

								<a href="/parties" class="solid-btn">
									<div>
										<p>More Info</p>
									</div>
								</a>
						</div>
					</div>
					<div class="col col1-2 eqheight celebrate-right clearfix">
						<div class="celebrate-right-img">
							<img src="themes/site/assets/images/stumble-inn/stumble3.jpg" alt="stumble inn interior" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="home-sec3 col-space0 col-pad-lg clearfix">
		<div class="clearfix">
			<div class="col col1-2 eqheight home-social">
				<div class="col col4-5 clearfix home-social-container">
					<div class="home-social-content">
						<?php insertPartial("fe_social_tabs", "default", $obj); ?>
					</div>
				</div>
			</div>
			<div class="col col1-2 eqheight home-store center">
				<div class="col col4-5 home-store-container">
					<div class="home-img-container clearfix">
						<div class="home-store-img" style="background-image: url('themes/site/assets/images/stumble-inn/t-shirt-male.jpg')"></div>
						<div class="home-store-img" style="background-image: url('themes/site/assets/images/stumble-inn/female-shirt.jpg')"></div>
					</div>
						<div class="home-store-info clearfix">
							<div class="home-store-info-inner">
								<h4 class="home-store-title">Need some New Threads?</h4>
								<p class="home-store-content">Want to show that you and your friends got down at one of NYC Best Bar's eight legendary
									locations? Well, then you're definitely going to want to pick up some of NYC Best Bars'
									classic merchandise as a bona fide badge of honor!</p>
								<a href="#">
									<h5 class="home-store-link">Visit Our Store</h5>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="instagram-wrap">
			<ul>
			<?php
			$aycsocurl = "http://www.socialassets.aycmedia.com/api/instagram.php?user=35&count=15&resolution=low_resolution";
			$aycsoccontent = file_get_contents($aycsocurl);
			$aycsoccontent = mb_convert_encoding($aycsoccontent, 'HTML-ENTITIES', "UTF-8");
			echo($aycsoccontent);
			?>
			</ul>
		</div>
</main>

<?php insertInclude("footer",$obj); ?>

<!-- GOOGLE MAPS API - (include in footer of specific page) -->

<!-- Page Specific JS -->
<script>
	$(function(){

	});
</script>
<!-- /Page Specific JS -->

<?php insertInclude("footerclose"); ?>
