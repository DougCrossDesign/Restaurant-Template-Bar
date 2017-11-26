<?php
	/////////////////////////
	// Page Meta / Classes
	/////////////////////////
	$obj-> body_class = array(
		"page" => "pg_parties",
		"site_section" => "sct_parties",
		"layout" => ""
	);
?>

<?php insertInclude("head",$obj); ?>
<?php insertInclude("header",$obj); ?>

<main id="content-main" class="main-content" role="main">
	<div class="page-header" style="background-image:url(<? insertImage('stumble-inn/parties-header.jpg') ?>)">
		<div class="wrap-sm page-header-text clearfix">
			<h1 class="parties-header-title">Parties</h1>
			<p class="parties-header-desc center clearfix">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis, urna sit amet dapibus auctor, velit diam pharetra elit, vel finibus tortor quam sed nisl.
			</p>
		</div>
	</div>
	<div class="page-content bg6 c1">
		<div class="wrap wrap-pad clearfix">

			<center class="wrap">
				<?php insertPartial("fe_button_group", "default", $obj); ?>
				<div class="parties-intro-text">
					<?php insertPartial("fe_html_text", "default", $obj); ?>
				</div>
			</center>
			<div class="col-space4">
				<form id="parties_form" class="col col2-3 form-default clearfix" action="#" method="post" NOVALIDATE>
					<ul>
						<li class="lbl-hint lbl-mini col">
							<div class="dropdown">
								<button class="dropbtn">Party Type*<span class="aycicon-down_arrow icon floatr"></span></button>
								<div class="dropdown-content">
									<a href="#" title="link title">Type 1</a>
									<a href="#" title="link title">Type 2</a>
									<a href="#" title="link title">Type 3</a>
								</div>
							</div>
						</li>
						<li class="lbl-hint lbl-mini col">
							<label for="form_fname">First Name*</label>
							<input type="text" id="form_fname" name="form_fname" placeholder="First Name*" required>
						</li>
						<li class="lbl-hint lbl-mini col">
							<label for="form_lname">Last Name*</label>
							<input type="text" id="form_lname" name="form_lname" placeholder="Last Name*" required>
						</li>
						<li class="lbl-hint lbl-mini col">
							<label for="form_email">Email*</label>
							<input type="email" id="form_email" name="form_email" placeholder="Email*" required>
						</li>
						<li class="lbl-hint lbl-mini col">
							<label for="form_company">Company</label>
							<input type="tel" id="form_company" name="form_company" placeholder="Company">
						</li>
						<li class="lbl-hint lbl-mini col">
							<label for="form_phone">Phone*</label>
							<input type="text" id="form_phone" name="form_phone" placeholder="Phone*" required>
						</li>

						<li class="lbl-hint lbl-mini col">
							<label for="form_dateinterested">Date of Interest</label>
							<input type="text" class="date" id="form_dateinterested" name="form_dateinterested" placeholder="Date of Interest">
						</li>
						<li class="lbl-hint lbl-mini col">
							<label for="form_timeinterested">Time of Interest</label>
							<input type="text" class="time" id="form_timeinterested" name="form_timeinterested" placeholder="Time of Interest">
						</li>

						<li class="lbl-hint lbl-mini col">
							<label for="form_guests"># of Guests</label>
							<input type="text" id="form_guests" name="form_guests" placeholder="# of Guests">
						</li>

						<li class="lbl-hint lbl-mini col">
							<label for="form_comments">Comments</label>
							<textarea type="text" id="form_comments" name="form_comments" placeholder="Comments"></textarea>
						</li>
						<li class="lbl-hint lbl-mini col">
							<div class="dropdown">
								<button class="dropbtn">How did you hear about us?*<span class="aycicon-down_arrow icon floatr"></span></button>
								<div class="dropdown-content">
									<a href="#" title="link title">Option 1</a>
									<a href="#" title="link title">Option 2</a>
									<a href="#" title="link title">Option 3</a>
								</div>
							</div>
						</li>

						<li class="col">
							<button type="submit" class="submit solid-btn" id="form_submit" name="form_submit">Submit</button>
						</li>
					</ul>
				</form>
				<div class="col col1-3 parties-side center">
					<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit.
						Etiam lobortis, urna sit amet dapibus auctor, velit diam pharetra elit,
						vel finibus tortor quam sed nisl. Quisque a risus elit.
						Vivamus ac metus mauris elit. Vivamus ac metus mauris.elit.
					</p>
					<a href="#"><div class="parties-side-button solid-btn">
						View Rooms
					</div></a>
				</div>
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
