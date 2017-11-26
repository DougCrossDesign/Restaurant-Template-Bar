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
		<?php ### Link, text, open new window ### ?>
<a href="#link" target="_blank" >
	<div class="Xcard effect__hover">
	   <div class="Xcard__front">
		 <a><span class="Xcard__text">button</span></a>
	   </div>
	   <div class="Xcard__back">
	   <a><span class="Xcard__text">button</span></a>
   </div>
   </div>
   <?php } ?>
   </a>
</div>
