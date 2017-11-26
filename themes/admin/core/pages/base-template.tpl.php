<?	
	//$obj = new stdClass();
	
	/////////////////////////
	// Meta Data
	/////////////////////////

	/////////////////////////
	// Body Class
	/////////////////////////
use Model\User;

$obj-> body_class = array(
		"page" => "pg_",
		"site_section" => "sct_",
		"layout" => ""
	);

?>

<?php insertInclude("head",$obj); ?>
<?php insertInclude("header",$obj); ?>


	<!-- Main -->
	<main id="content-main" class="content-active clearfix">
		
		<div class="top-bar">
			<div class="top-icons">
				<span class="aycicon-gear icons"></span>			
			</div>
			<span><img src="<? insertImage('top-bar-arrow.png') ?>" ></span>
			<div class="top-desc">
				<?php if ($obj->breadcrumbs) {
					$breadcrumbs = $obj->breadcrumbs;
					foreach ($breadcrumbs as $breadcrumb) {
						if ($breadcrumb->current) { ?>
							<?php echo $breadcrumb->label; ?>
						<?php } else { ?>
							<a href="<?php echo $breadcrumb->link; ?>"><?php echo $breadcrumb->label; ?></a> &raquo;
						<? } } } ?>
			</div>
			<div class="floatr" style="margin: 11px 15px 0px 0px;font-size: 13px;"><span title="<?php echo Auth::getUserLevelName(); ?>"><?php echo Auth::getUserName(); ?></span></div>
		</div>


		<div class="section-gradient btm-margin-lg">
			<div class="content-wrap">
				<?php printDashboardNews($obj, ['site'], []); ?>
				<h1 class="hdr1 btm-margin"><?php echo ucwords($obj->page_title); ?></h1>
				<p>
					<?php if(isset($obj->modelTopText)) echo $obj->modelTopText; ?>
				</p>
			</div>
		</div>

		<div class="content-wrap clearfix" style="margin-bottom: 200px;">
			<!-- START CONTENT -->
			<?php printDashboardNews($obj, [], ['site']); ?>
			<?php echo $obj->page; ?>
			<!-- END CONTENT -->
		</div>

		<div class="side-shadow3"></div>
	</main>
	<!-- /Main -->

<?php insertInclude("footer",$obj); ?>

<!-- Page Specific JS -->
<script>
	$(function(){

		//Label Hints
		$('.lbl-hint').labelHint();
		tinyMCE.init({
			selector: '.tinymce',
			theme: 'modern',
			skin: 'lightgray',
			plugins: [
			    'advlist autolink lists link image charmap print preview anchor',
			    'searchreplace visualblocks code fullscreen',
			    'insertdatetime media jbimages table contextmenu paste code'
			  ],
			relative_urls: false,
  			toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages',
		});

	
	});
</script>
<script type="text/javascript" src="/themes/admin/core/assets/admin_plugins/tinymce/tinymce.min.js"></script>
<!-- /Page Specific JS -->

<?php insertInclude("footerclose"); ?>