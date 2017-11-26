<?php
	/////////////////////////
	// Page Meta / Classes
	/////////////////////////
	$obj-> body_class = array(
		"page" => "pg_specials",
		"site_section" => "sct_specials",
		"layout" => ""
	);

?>

<?php insertInclude("head",$obj); ?>
<?php insertInclude("header",$obj); ?>

<main id="content-main" class="main-content" role="main">
	<div class="page-header" style="background-image:url(<? insertImage('stumble-inn/specials-header.jpg') ?>)">
		<div class="wrap-sm page-header-text clearfix">
			<h1 class="specials-header-title">Specials</h1>
			<p class="specials-header-desc center clearfix">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis, urna sit amet dapibus auctor, velit diam pharetra elit, vel finibus tortor quam sed nisl.
			</p>
		</div>
	</div>

	<div class="page-content center">
		<div class="wrap-sm wrap-pad-lg clearfix">
			<div class="clearfix">
				<div class="specials-content">
					<div class="entry-content">
						<p>
							Hero Body Content Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis, urna sit amet dapibus auctor, velit diam pharetra elit, vel finibus tortor quam sed nisl.
							Vivamus ac metus mauris.Hero Body Content Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis, urna sit amet dapibus auctor, velit diam pharetra elit.
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="wrap clearfix specials-days">
			<?php // FRONTEND FOR EXAMPLE LOOP -- REPLACE
				for ($i=0; $i < 5; $i++) {
			?>

			<div class="col-space3 col-pad-lg col-vsp-lg">
				<div class="col col2-3 eqheight specials-day-left">
					<h4 class="specials-left-title">Monday Basement Brunch</h4>
					<p class="specials-left-time">12pm - 5pm (doors open at 11:30am) - $25 per person</p>
					<p class="specials-left-content">Unlimited atomic wings, fries, onion rings, tater tots, breakfast baskets, mimosas and domestic draft beer. <br /> $4 domestic bottles &amp; cans, $4 "we call it"</p>
					<div class="specials-left-topbar">
						<p>Day Special</p>
					</div>
				</div>
				<div class="col col1-3 eqheight specials-day-right">
					<h4 class="specials-right-title">Happy Hour</h4>
					<h4 class="specials-right-time">8pm - close</h4>
					<p class="specials-right-content">
						$10 Pitchers of Bud, Bud light, &amp; Coors Light
					</p>
					<p class="specials-right-content">
						$14 Pitchers of Sam Adams, Blue Moon, &amp; Redhook $4 shots of fireball
					</p>
				</div>
			</div>
			<?php // FRONTEND FOR EXAMPLE LOOP -- END
			} ?>


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
