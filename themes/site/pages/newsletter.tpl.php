<?php
	/////////////////////////
	// Page Meta / Classes
	/////////////////////////
	$obj-> body_class = array(
		"page" => "pg_newsletter",
		"site_section" => "sct_newsletter",
		"layout" => ""
	);
?>

<?php insertInclude("head",$obj); ?>
<?php insertInclude("header",$obj); ?>

<main id="content-main" class="main-content" role="main">
	<div class="page-header" style="background-image:url(<? insertImage('stumble-inn/newsletter-header.jpg') ?>)">
		<div class="wrap-sm page-header-text">
			<h1 class="newsletter-header-title">Newsletter</h1>
			<p class="newsletter-header-desc center clearfix">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis, urna sit amet dapibus auctor, velit diam pharetra elit, vel finibus tortor quam sed nisl.
			</p>
		</div>
	</div>
	<div class="page-content bg6 c1">
		<div class="wrap wrap-pad clearfix">

			<center class="wrap vert-pad">

				<div class="parties-intro-text">
					<?php insertPartial("fe_html_text", "default", $obj); ?>
				</div>
			</center>
			<div class="wrap-sm">
				<form id="newsletter_form" class="form-default clearfix" action="#" method="post" NOVALIDATE>
					<ul>
						<li class="lbl-hint lbl-mini col">
							<label for="form_fname">First Name*</label>
							<input type="text" id="form_fname" name="form_fname" placeholder="First Name*">
						</li>
						<li class="lbl-hint lbl-mini col">
							<label for="form_lname">Last Name*</label>
							<input type="text" id="form_lname" name="form_lname" placeholder="Last Name*">
						</li>
						<li class="lbl-hint lbl-mini col">
							<label for="form_email">Email*</label>
							<input type="email" id="form_email" name="form_email" placeholder="Email*">
						</li>
						<li class="date lbl-hint lbl-mini col">
							<label for="form_birthday">Birthday</label>
							<input type="date" id="form_birthday" name="form_birthday" placeholder="Birthday">
						</li>
						<li class="col">
							<button type="submit" class="submit solid-btn" id="form_submit" name="form_submit">Submit</button>
						</li>
					</ul>
				</form>
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
