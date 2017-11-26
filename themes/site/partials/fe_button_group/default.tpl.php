<?php
	$btnclass = "btn-inner";  //btn, btn2, btn small, btn2 small
	$btnalign = "auto"; // left, right, center, fill
	$bgwrap = "button-group button-group-".$btnalign." vert-pad-sm clearfix";
?>

<?php ### Select LEFT, RIGHT, CENTER, or FULL ### ?>

	<div class="<?php echo $bgwrap ?>">

		<?php for ($i=0; $i < 3; $i++) { ?>
			<?php ### Link, text, open new window ### ?>
			<div class="btn-outline">
				<div class="btn-outer">
					<a href="#link" target="_blank" class="<?php echo $btnclass ?>"><p>
						PDF Download
					</p></a>
				</div>
			</div>
		<?php } ?>

</div>
