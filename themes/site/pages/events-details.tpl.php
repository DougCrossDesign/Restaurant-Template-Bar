<?php
	/////////////////////////
	// Page Meta / Classes
	/////////////////////////
	$obj-> body_class = array(
		"page" => "pg_events_details",
		"site_section" => "sct_events",
		"layout" => ""
	);
?>

<?php insertInclude("head",$obj); ?>
<?php insertInclude("header",$obj); ?>

<main id="content-main" class="main-content" role="main">

	<div class="page-header-small" style="background-image:url(<? insertImage('bg-subheader-events.jpg') ?>)">
		<div class="page-header-text">
			<div>Events</div>
		</div>
	</div>

	<div class="page-content posr bg6 c1">
		<div class="wrap-sm wrap-pad clearfix">

			<!-- CONTENT -->
			<div class="events-details bg-accent1 posr">


				<div class="events-details-inner">

					<div class="center c1">
						<div class="events-details-title">Event Title</div>
						<div class="events-details-date">
							<span class="events-details-date-month">August</span>
							<span class="events-details-date-day">27th</span>
							<span class="events-details-date-year">2016</span>
						</div>
					</div>

					<!-- If no showtimes, then just show buy tickets button -->
					<div class="events-details-buy center btm-margin-lg">
						<a class="addthis_button btn">Social Share</a>
						<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-533967b6439f58fd" async></script>
					</div>


					<?php ###  HTML Enabled Text Box - HIDE BLOCK IF EMPTY #### ?>
					<div class="events-details-body entry-content">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus euismod, sapien vitae tincidunt semper, dui risus mattis sapien, at convallis odio sapien eu libero. In quam diam, tincidunt sed dolor in, semper blandit turpis. Etiam iaculis ipsum vitae tortor sollicitudin, eget feugiat augue accumsan. Praesent blandit dignissim feugiat. Quisque condimentum tristique pharetra. Nam sed nunc dui. Sed eget aliquet diam, quis hendrerit odio. Cras mauris nibh, pretium sed lectus posuere, aliquet venenatis magna. Donec consectetur sed erat nec posuere. Suspendisse pretium, libero id hendrerit volutpat, metus erat volutpat nisi, ut dapibus est odio eget dui.</p>
						<p>Pellentesque mi arcu, suscipit sit amet arcu eget, congue vulputate purus. Suspendisse potenti. Sed gravida vel nunc ac luctus. Vestibulum non elit porta, aliquam risus eu, vulputate nunc. Proin est enim, vestibulum vitae dapibus nec, auctor quis sapien. Pellentesque eu iaculis neque, eget varius sapien. Suspendisse tortor nibh, suscipit et nulla a, auctor egestas nisl. In nec convallis sem. Nullam ultrices urna enim, a rutrum quam mattis ut. Morbi molestie suscipit malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean sit amet urna vitae magna mattis lobortis.</p>
						<p>Praesent pulvinar lectus nunc, ut posuere enim bibendum eu. Integer in lacus mattis, accumsan nibh vel, facilisis turpis. Mauris nec suscipit nisi. Nullam et volutpat urna, sit amet molestie purus. Donec mi felis, molestie vel tempus sit amet, dapibus vel augue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur pharetra ut ligula et sodales. Integer lobortis tortor nec ante viverra porttitor. Nullam euismod risus ac metus convallis, non fringilla ligula efficitur. Pellentesque vestibulum tristique accumsan. Sed nec purus erat. Aliquam ut mauris quis diam volutpat malesuada sit amet in mauris. Sed ac mi in nulla placerat egestas nec quis diam. Sed dapibus nulla quis commodo mattis. Proin a purus ac tellus feugiat maximus. Nunc sit amet ipsum nec quam euismod mollis ac sit amet purus.</p>
					</div>

					<div class="events-details-buttons center">
						<a href="#link" class="btn">Link Name</a>
						<a href="#link" class="btn">Link Name</a>
						<a href="#link" class="btn">Link Name</a>
						<a href="#link" class="btn">Link Name</a>
					</div>

					<div class="events-details-vid-wrap clearfix">
						<iframe width="100%" height="400" src="https://www.youtube.com/embed/OF7MPPWug24" frameborder="0" allowfullscreen></iframe>
					</div>


				</div>

			</div>
			<!-- /CONTENT -->

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
