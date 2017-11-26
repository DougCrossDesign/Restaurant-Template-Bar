<?php
	/////////////////////////
	// Page Meta / Classes
	/////////////////////////
	$obj-> body_class = array(
		"page" => "pg_gallery",
		"site_section" => "sct_gallery",
		"layout" => ""
	);
?>

<?php insertInclude("head",$obj); ?>
<?php insertInclude("header",$obj); ?>

<main id="content-main" class="main-content" role="main">
	<div class="page-header" style="background-image:url(<? insertImage('bg-subheader-gallery.jpg') ?>)">
		<div class="page-header-text">
			<div>Gallery</div>
		</div>
	</div>
	<div class="page-content bg6 c1">
		<div class="wrap wrap-pad clearfix">

			<div>

				<?php
				// Album ID
				if (isset($_GET['album_id'])) {
					$album_id = $_GET['album_id'];
				} else {
					$album_id = 1;
				}
				?>
				<!-- Content Loader -->
				<div class="cl-area posr">
					<div class="loading-overlay"><span class="icon"></span></div>

					<div class="wrap-sm btm-margin-lg clearfix">
						<center>
						<?php insertPartial("fe_html_text", "default", $obj); ?>
						</center>
					</div>

					<!-- Dropdown -->
					<div class="btm-margin">
						<select class="gallery-nav chosen-select" id="form_month" name="form_month">
							<!-- NOTE: change value to gallery URL on your site... e.g. /gallery.php?album_id=1 -->
							<option value="/gallery?album_id=1">Restaurant Photos</option>
							<option value="/gallery?album_id=2">St. Paddy's Day</option>
							<option value="/gallery?album_id=3">Octoberfest</option>
						</select>
					</div>
					<!-- Items to Load -->
					<div id="cl-items">
						<?php
						switch ($album_id) {
							case 1:
								$count = 8;
								$album_title = 'Restaurant Photos';
								break;
							case 2:
								$count = 2;
								$album_title = 'St. Paddy\'s Day';
								break;
							case 3:
								$count = 1;
								$album_title = 'Octoberfest';
								break;
							default:
								$count = 8;
								$album_title = 'Restaurant Photos';
								break;
						} ?>
						<div class="col-space2 col-auto-sm clearfix">
							<?php
							for ($i=0; $i < $count; $i++) {
							?>
							<div class="col1-3 col center btm-margin">
								<a class="modal-img cbox_group1" href="<? insertImage('popup.png') ?>" title="Insert_your_caption"><img alt="Insert_your_caption" class="fluid-img" src="https://unsplash.it/350/350?image=0" alt="Product" width="400" height="400"></a>
							</div>
							<?php } ?>
						</div>
					</div>
				</div><!-- END .cl-area -->

			</div>

		</div>
	</div>
</main>

<?php insertInclude("footer",$obj); ?>

<!-- Page Specific JS -->
<script>
	$(function(){

		// Init - Content Loader
		$('.cl-area').contentLoader({
			callback: function(){
				$('#cl-items').find('.cbox_group1').colorbox({rel:'cbox_group1', maxWidth:'95%', maxHeight:'95%'});
			}
		});
	});
</script>
<!-- /Page Specific JS -->

<?php insertInclude("footerclose"); ?>
