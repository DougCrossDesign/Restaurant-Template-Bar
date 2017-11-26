<?php
	/////////////////////////
	// Page Meta / Classes
	/////////////////////////
	$obj-> body_class = array(
		"page" => "pg_findus",
		"site_section" => "sct_findus",
		"layout" => ""
	);
?>

<?php insertInclude("head",$obj); ?>
<?php insertInclude("header",$obj); ?>

<main id="content-main" class="main-content" role="main">
	<div class="page-header" style="background-image:url(<? insertImage('stumble-inn/find-us-header.jpg') ?>)">
		<div class="wrap-sm page-header-text">
			<h1 class="find-us-header-title">Find Us</h1>
			<p class="find-us-header-desc center clearfix">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis, urna sit amet dapibus auctor, velit diam pharetra elit, vel finibus tortor quam sed nisl.
			</p>
		</div>
	</div>
	<div class="page-content bg6 c1">
		<div class="wrap wrap-pad clearfix">

			<center class="wrap">

				<div class="parties-intro-text">
					<?php insertPartial("fe_html_text", "default", $obj); ?>
				</div>
			</center>
			<div class="col-space4">
				<div class="col col2-3">
				<form id="parties_form" class="form-default clearfix" action="#" method="post" NOVALIDATE>
					<ul>
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
							<label for="form_phone">Phone*</label>
							<input type="text" id="form_phone" name="form_phone" placeholder="Phone*" required>
						</li>

						<li class="lbl-hint lbl-mini col">
							<label for="form_comments">Comments</label>
							<textarea type="text" id="form_comments" name="form_comments" placeholder="Comments"></textarea>
						</li>

						<li class="col">
							<button type="submit" class="submit" id="form_submit" name="form_submit">Submit</button>
						</li>
					</ul>
				</form>

			</div>
				<div class="col col1-3 find-us-side center">
					<p>
						<span>Street Address <br />City, State ZIP</span>
					</p>
					<p>
						<span>Phone Number <br />Email Address</span>
					</p>
					<p>
						<span>Hours of Operation:</span><br />10am-2am<br />10am-2am<br />10am-2am<br />10am-2am
					</p>
				</div>
			</div>
			<div class="col-space4 find-us-bottom clearfix">
				<div class="col col2-3 map-container">
					<div id="gmap-single" class="gmap"></div>
					<form class="findus-directions" action="//maps.google.com/maps" method="get" target="new">
						<input type="hidden" name="daddr" value="1100 Hector St Conshohocken PA 19428">
						<input type="hidden" name="hl" value="en">
						<div class="directions-submit col-space0 clearfix">
							<div class="col col4-5 input">
								<input class="" type="text" name="saddr" id="saddr" aria-label="Enter Your Address" placeholder="Enter Your Address">
							</div>
							<div class="col col1-5 map-submit">
								<input class="" type="submit" value="GO" id="form_go" name="form_go">
							</div>

						</div>
					</form>

				</div>
				<div class="col col1-3 center find-us-subway clearfix">
					<p class="find-us-train-head clearfix">
						Train Options
					</p>
					<div class="col-space2 col-vsp-md">
						<div class="col col1-5 eqheight"><span class="subway-circle"><p>A</p></span></div><p class="col col4-5 subway-text eqheight">Text Here</p>

						<div class="col col1-5 eqheight"><span class="subway-circle"><p>B</p></span></div><p class="col col4-5 subway-text eqheight">Text Here</p>

						<div class="col col1-5 eqheight"><span class="subway-circle"><p>C</p></span></div><p class="col col4-5 subway-text eqheight">Text Here</p>
					</div>


				</div>

			</div>

		</div>
		<div class="google-view">
			<?php insertPartial("fe_google_viewer","default", $obj); ?>

		</div>
	</div>

</main>

<?php insertInclude("footer",$obj); ?>

<!-- GOOGLE MAPS API - -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?<?php /* key=INSERT_KEY */?>"></script>

<!-- Page Specific JS -->
<script>
	$(function(){
		// Custom Marker (if desired)
		function gmapMarker(width, height, anchor){
			return {
				url: 'googlemap/images/marker@2x.png', // image location
				size: new google.maps.Size(width, height), // size of image
				scaledSize: new google.maps.Size(width, height), // position of marker sprite
				anchor: new google.maps.Point(anchor, height) // portion of image to dock to location point (center, bottom)
			}
		}

		// Init - gMapHelper (single)
		$('#gmap-single').gMapHelper({
			address:"1100 Hector Street, Conshohocken, PA 19403", // plain text address
			//icon: gmapMarker(40, 40, 20), // custom marker (can remove for default)
			scrollwheel: false, // boolean. scroll to zoom or not
			zoom: 14, // 0 to 18
			mapType: "roadmap", // options: "roadmap", "satellite", "hybrid", terrain
			// Popup info when you click on marker
			addressInfoWindow: '<div class="info-window">' +
					'<h2>Visit Work</h2>' +
					'<p>1100 Hector Street</p>' +
					'<p>Conshohocken, PA 19428</p>' +
				'</div>',
			// Can be left blank for default styles. Styles Pulled from... https://snazzymaps.com/style/134/light-dream
			styles: [ { "featureType": "all", "elementType": "geometry.fill", "stylers": [ { "weight": "2.00" } ] }, { "featureType": "all", "elementType": "geometry.stroke", "stylers": [ { "color": "#9c9c9c" } ] }, { "featureType": "all", "elementType": "labels.text", "stylers": [ { "visibility": "on" } ] }, { "featureType": "landscape", "elementType": "all", "stylers": [ { "color": "#f2f2f2" } ] }, { "featureType": "landscape", "elementType": "geometry.fill", "stylers": [ { "color": "#ffffff" } ] }, { "featureType": "landscape.man_made", "elementType": "geometry.fill", "stylers": [ { "color": "#ffffff" } ] }, { "featureType": "poi", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road", "elementType": "all", "stylers": [ { "saturation": -100 }, { "lightness": 45 } ] }, { "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "color": "#eeeeee" } ] }, { "featureType": "road", "elementType": "labels.text.fill", "stylers": [ { "color": "#7b7b7b" } ] }, { "featureType": "road", "elementType": "labels.text.stroke", "stylers": [ { "color": "#ffffff" } ] }, { "featureType": "road.highway", "elementType": "all", "stylers": [ { "visibility": "simplified" } ] }, { "featureType": "road.arterial", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "transit", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "water", "elementType": "all", "stylers": [ { "color": "#46bcec" }, { "visibility": "on" } ] }, { "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "color": "#c8d7d4" } ] }, { "featureType": "water", "elementType": "labels.text.fill", "stylers": [ { "color": "#070707" } ] }, { "featureType": "water", "elementType": "labels.text.stroke", "stylers": [ { "color": "#ffffff" } ] } ]
		});
	});
</script>
<!-- /Page Specific JS -->

<?php insertInclude("footerclose"); ?>
