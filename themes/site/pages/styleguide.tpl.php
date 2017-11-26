<?php
	/////////////////////////
	// Page Meta / Classes
	/////////////////////////
	$obj-> body_class = array(
		"page" => "pg_styleguide",
		"site_section" => "sct_styleguide",
		"layout" => ""
	);

?>

<?php insertInclude("head",$obj); ?>
<?php insertInclude("header",$obj); ?>

<main id="content-main" class="main-content" role="main">

<div class="content">
	<div class="wrap-lg wrap-pad wrap-vpad style-guide bg-white comp-sdw">

		<!-- Colors -->
		<div class="btm-margin-lg clearfix">
			<h2 class="hdr">Color Swatches and default text colors -> vars.scss</h2>
			<div class="swatch bg1">c1</div>
			<div class="swatch bg2">c2</div>
			<div class="swatch bg3">c3</div>
			<div class="swatch bg4">c4</div>
			<div class="swatch bg5">c5</div>
			<div class="swatch bg6">c6</div>
		</div>

		<!-- Headers -->
		<div class="btm-margin-lg">
			<h2 class="hdr">Headers -> typography.scss</h2>
			<h2 class="hdr1 btm-margin">Header .hdr1</h2>
			<h2 class="hdr2 btm-margin">Header .hdr2</h2>
			<h2 class="hdr3 btm-margin">Header .hdr3</h2>
			<h2 class="hdr4 btm-margin">Header .hdr4</h2>
			<h2 class="hdr5 btm-margin">Header .hdr5</h2>
		</div>

		<!-- Typography -->
		<div class="btm-margin-lg">
			<h2 class="hdr">User Entered Content (TinyMCE) -> typography.scss </h2>
			<div class="entry-content">

				<h1>Entry Content H1</h1>

				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fermentum sed sem quis vulputate. Nulla facilisi. Phasellus metus justo, facilisis vestibulum nibh luctus, venenatis pulvinar ipsum. Vivamus aliquam elit leo, eu mollis sem ultrices sed. Donec tincidunt tellus turpis, id sollicitudin tortor viverra eu. In ornare metus nec dignissim laoreet. Nunc non diam commodo, pulvinar lorem in, commodo nibh. Sed bibendum augue nec lobortis sodales. Praesent in nisi quam. Pellentesque sem ante, semper vitae nulla sit amet, porttitor iaculis dui.</p>

				<p>Mauris ac arcu non ipsum fermentum vestibulum. Vivamus sit amet vehicula leo. Morbi condimentum tellus velit, vitae posuere sem maximus a. Nam vel diam porta tellus finibus condimentum et vel dui. Mauris vitae egestas odio. Vivamus sed felis felis. Proin at ex sit amet arcu posuere condimentum eu at risus.</p>

				<h2>Entry Content H2</h2>
				<p>Mauris ac arcu non ipsum fermentum vestibulum. Vivamus sit amet vehicula leo. Morbi condimentum tellus velit, vitae posuere sem maximus a. Nam vel diam porta tellus finibus condimentum et vel dui. Mauris vitae egestas odio. Vivamus sed felis felis. Proin at ex sit amet arcu posuere condimentum eu at risus.</p>
				<ul>
					<?php for ($i=0; $i < 4; $i++) { ?>
					<li>List Example <?php echo $i ?></li>
					<?php } ?>
				</ul>

				<h3>Entry Content H3</h3>
				<p>Mauris ac arcu non ipsum fermentum vestibulum. Vivamus sit amet vehicula leo. Morbi condimentum tellus velit, vitae posuere sem maximus a. Nam vel diam porta tellus finibus condimentum et vel dui. Mauris vitae egestas odio. Vivamus sed felis felis. Proin at ex sit amet arcu posuere condimentum eu at risus.</p>

			</div>
		</div>

		<!-- Buttons -->
		<div class="btm-margin-lg">
			<h2 class="hdr">Buttons -> typography.scss</h2>
			<a href="#" class="btn">Button Style 1</a>
			<a href="#" class="btn2">Button Style 2</a>
			<a href="#" class="btn small">Button Style 1 Small</a>
			<a href="#" class="btn2 small">Button Style 2 Small</a>
		</div>

		<!-- Standard Color Blocks -->
		<div class="btm-margin-lg">
			<h2 class="hdr">Standard Information Blocks -> vars.scss -> core:layouts</h2>
			<div class="alert-box bg-muted"><span class="alert-type">muted</span><span class="bgtxt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </span></div>
			<div class="alert-box bg-primary"><span class="alert-type">primary</span><span class="bgtxt">Lorem ipsum sit amet, consectetur elit. </span></div>
			<div class="alert-box bg-success"><span class="alert-type">success</span><span class="bgtxt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </span></div>
			<div class="alert-box bg-info"><span class="alert-type">info</span><span class="bgtxt">Lorem ipsum dolor sit amet,  adipiscing elit. </span></div>
			<div class="alert-box bg-warning"><span class="alert-type">warning</span><span class="bgtxt">Lorem ipsum dolor sit , consectetur adipiscing elit. </span></div>
			<div class="alert-box bg-error"><span class="alert-type">error</span><span class="bgtxt">Lorem ipsum dolor amet, consectetur adipiscing elit. </span></div>
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
