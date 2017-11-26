<?php
	/////////////////////////
	// Page Meta / Classes
	/////////////////////////
	$obj-> body_class = array(
		"page" => "pg_thankyou",
		"site_section" => "sct_thankyou",
		"layout" => ""
	);

?>

<?php insertInclude("head",$obj); ?>
<?php insertInclude("header",$obj); ?>

<main id="content-main" class="main-content" role="main">
	<div class="page-header-small" style="background-image:url(<? insertImage('stumble-inn/thank-you-header.jpg') ?>)">
		<div class="wrap-sm page-header-text clearfix">
			<h1 class="parties-header-title">Thank You</h1>
		</div>
	</div>
	<div class="page-content bg6 c1">
		<div class="wrap-sm clearfix">

			<center class="wrap thank-you-content">
				<p>
					Lorem ipsum dolor sit amet, officia est orci et, ultrices convallis risus tempus, leo nec risus etiam. Sollicitudin quisque suspendisse phasellus, vel praesent vitae quam arcu, feugiat lorem neque odio. Eget ipsum vestibulum etiam magna, class vestibulum nascetur sed nisl, dis consectetuer eu est maecenas. Eros eleifend feugiat morbi, ipsum hendrerit velit quisque facilis, feugiat quisque parturient pharetra. In nulla in facilisis ullamcorper, faucibus tortor ut consequat libero, ut fermentum aenean ultrices pretium, parturient nonummy duis neque.
				</p>
				<p>
					Lorem ipsum dolor sit amet, officia est orci et, ultrices convallis risus tempus, leo nec risus etiam. Sollicitudin quisque suspendisse phasellus, vel praesent vitae quam arcu, feugiat lorem neque odio. Eget ipsum vestibulum etiam magna, class vestibulum nascetur sed nisl, dis consectetuer eu est maecenas.
				</p>
			</center>
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
