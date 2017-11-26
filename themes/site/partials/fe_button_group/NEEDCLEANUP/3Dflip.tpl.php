<?php
	$btnclass = "btn small";  //btn, btn2, btn small, btn2 small
	$btnalign = "left"; // left, right, center, fill
	$bgwrap = "button-group button-group-".$btnalign." btm-margin-lg clearfix";
?>
<?php ### Optional Header ### ?>
<?php if(true){ ?>
	<h2 class="hdr3 c1 btm-margin-sm">Buttons Group</h2>
<?php } ?>

<?php ### Select LEFT, RIGHT, CENTER, or FULL ### ?>
<div class="<?php echo $btnalign ?>">
	<?php for ($i=0; $i < 3; $i++) { ?>
<div class="flipper-container">
<a href="#" >
  <div id="id" class="flipper">
    <div class="front-face"><p><span>Button</span>	</p></div>
    <div class="back-face"><p><span>Button</span>	</p></div>
  </div>
</a>
</div>
<?php } ?>
</div>
