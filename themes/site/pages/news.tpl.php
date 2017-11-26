<?php
	/////////////////////////
	// Page Meta / Classes
	/////////////////////////
	$obj-> body_class = array(
		"page" => "pg_news",
		"site_section" => "sct_news",
		"layout" => ""
	);
?>

<?php insertInclude("head",$obj); ?>
<?php insertInclude("header",$obj); ?>

<main id="content-main" class="main-content" role="main">
	<div class="page-header" style="background-image:url(<? insertImage('stumble-inn/news-header.jpg') ?>)">
		<div class="wrap-sm page-header-text">
			<h1 class="hdr1">News</h1>
			<p class="news-header-desc center clearfix">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis, urna sit amet dapibus auctor, velit diam pharetra elit, vel finibus tortor quam sed nisl.
			</p>
		</div>
	</div>
	<div class="page-content posr bg6 c1">
		<div class="wrap wrap-pad-xlg clearfix">

			<div class="news-dropdown center clearfix">
				<div class="wrap-sm">
					<div class="col-space0 col-pad-sm btm-margin clearfix">
						<div class="col4-5 col news-dropdown">
							<div class="dropdown">
								<button class="dropbtn">Choose a Month<span class="aycicon-down_arrow icon floatr"></span></button>
								<div class="dropdown-content">
									<a href="#" title="link title">Link 1</a>
									<a href="#" title="link title">Link 2</a>
									<a href="#" title="link title">Link 3</a>
								</div>
							</div>
						</div>
						<div class="col1-5 col news-btn">
							<a href="#viewall" class="btn2 fill" title="View All Events">View All</a>
						</div>
					</div>
				</div>
			</div>

			<div class="auto-3-2-1 col-space3 col-pad-lg clearfix">

				<?php // FRONTEND FOR EXAMPLE LOOP -- REPLACE
					for ($i=0; $i < 9; $i++) {
				?>

				<div class="col1-3 col clearfix">
					<div class="news-list-wrap eqheight">
						<div class="news-list-title">News Title</div>
						<div class="news-list-date">
							<span class="news-list-date-month">August </span>
							<span class="news-list-date-day">27th </span>
							<span class="news-list-date-year">2016</span>
						</div>
						<div class="news-list-abridged">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra .</div>
						<a class="solid-btn" href="/news-details">More</a>
					</div>
				</div>

				<?php // FRONTEND FOR EXAMPLE LOOP -- END
				} ?>


			</div>

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
