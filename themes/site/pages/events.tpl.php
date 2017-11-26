<?php
	/////////////////////////
	// Page Meta / Classes
	/////////////////////////
	$obj-> body_class = array(
		"page" => "pg_events",
		"site_section" => "sct_events",
		"layout" => ""
	);
?>

<?php insertInclude("head",$obj); ?>
<?php insertInclude("header",$obj); ?>

<main id="content-main" class="main-content" role="main">
	<div class="page-header" style="background-image:url(<? insertImage('bg-subheader-events.jpg') ?>)">
		<div class="page-header-text">
			<div>Events</div>
		</div>
	</div>
	<div class="page-content posr bg6 c1">
		<div class="wrap wrap-pad clearfix">

			<div class="events-dropdown center clearfix">
				<div class="wrap-xsm">
					<div class="col-space1 col-auto-xsm btm-margin clearfix">
						<div class="col2-3 col">
							<div class="dropdown">
								<button class="dropbtn">Select Month<span class="aycicon-down_arrow icon floatr"></span></button>
								<div class="dropdown-content">
									<a href="#" title="link title">Link 1</a>
									<a href="#" title="link title">Link 2</a>
									<a href="#" title="link title">Link 3</a>
								</div>
							</div>
						</div>
						<div class="col1-3 col">
							<a href="#viewall" class="btn2 fill" title="View All Events">View All</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-space5 col-auto-sm clearfix">

				<?php // FRONTEND FOR EXAMPLE LOOP -- REPLACE
					for ($i=0; $i < 9; $i++) {
				?>

				<div class="col1-3 col">
					<div class="events-list-wrap eqheight">
						<div class="events-list-title">Event Title</div>
						<div class="events-list-date">
							<span class="events-list-date-month">August </span>
							<span class="events-list-date-day">27th </span>
							<span class="events-list-date-year">2016</span>
						</div>
						<div class="events-list-abridged">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra .</div>
						<a class="btn small" href="/events-details">Apply</a>
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
