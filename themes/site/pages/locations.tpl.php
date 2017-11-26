<?php
	/////////////////////////
	// Page Meta / Classes
	/////////////////////////
	$obj-> body_class = array(
		"page" => "pg_locations",
		"site_section" => "sct_locations",
		"layout" => ""
	);
?>

<?php insertInclude("head",$obj); ?>
<?php insertInclude("header",$obj); ?>

<main id="content-main" class="main-content" role="main">

	<div class="page-header-small" style="background-image:url(<? insertImage('bg-subheader-locations.jpg') ?>)">
		<div class="page-header-text">
			<div class="small">Locations</div>
		</div>
	</div>

	<div id="gmap-multiple" class="gmap-locations"></div>

	<div class="page-content bg6 c1">
		<div class="wrap wrap-pad clearfix">


			<div class="col-space2 col-auto-sm clearfix">

				<?php // FRONTEND FOR EXAMPLE LOOP -- REPLACE
					for ($i=0; $i < 6; $i++) {
				?>

				<div class="col1-3 col center">
					<div class="locations-wrap eqheight">
						<div class="locations-img">
							<img src="http://placehold.it/350x350" class="fluid-img">
						</div>
						<div class="locations-cont-wrap">
							<div class="locations-cont-title">Loc Title</div>
							<div clas="locations-cont-address">
								<div class="locations-cont-address">555 Some St.</div>
								<div class="locations-cont-address2">Town, ST, 19000</div>
							</div>
							<div class="locations-cont-phone">555-255-1212</div>
							<div class="locations-cont-web"><a href="#site" target="_blank" class="btn small">visit site</a></div>
						</div>
					</div>
				</div>

				<?php // END FRONTEND FOR EXAMPLE LOOP -- REPLACE
					}
				?>

			</div>


		</div>
	</div>
</main>

<?php insertInclude("footer",$obj); ?>

<!-- GOOGLE MAPS API - -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?<?php /* key=INSERT_KEY */?>"></script>

<!-- Page Specific JS -->
<script>
	$(function(){

		// Init - gMapHelper (multiple)
		$('#gmap-multiple').gMapHelper({
			// address name, lat/lng, info window popup
			address: [
				{
					itemName: "Work",
					itemAddress: [40.075210, -75.288226],
					itemInfoWindow: '<div class="info-window">' +
							'<h2>Visit Work</h2>' +
							'<p>1100 Hector Street</p>' +
							'<p>Conshohocken, PA 19428</p>' +
						'</div>'
				},
				{
					itemName: "Home",
					itemAddress: [40.1211770, -75.4015760],
					itemInfoWindow: '<div class="info-window">' +
							'<h2>Visit Home</h2>' +
						'</div>'
				},
				{
					itemName: "Home Home",
					itemAddress: [39.817583, -76.981294],
					itemInfoWindow: '<div class="info-window">' +
							'<h2>Visit Home Home</h2>' +
						'</div>'
				}
			],
			//icon: gmapMarker(40, 40, 20), // custom marker (can remove for default)
			scrollwheel: false, // boolean. scroll to zoom or not
			zoom: 14, // 0 to 18
			mapType: "roadmap", // options: "roadmap", "satellite", "hybrid", terrain
			// Can be left blank for default styles. Styles Pulled from... https://snazzymaps.com/style/134/light-dream
			styles: [ { "featureType": "all", "elementType": "geometry.fill", "stylers": [ { "weight": "2.00" } ] }, { "featureType": "all", "elementType": "geometry.stroke", "stylers": [ { "color": "#9c9c9c" } ] }, { "featureType": "all", "elementType": "labels.text", "stylers": [ { "visibility": "on" } ] }, { "featureType": "landscape", "elementType": "all", "stylers": [ { "color": "#f2f2f2" } ] }, { "featureType": "landscape", "elementType": "geometry.fill", "stylers": [ { "color": "#ffffff" } ] }, { "featureType": "landscape.man_made", "elementType": "geometry.fill", "stylers": [ { "color": "#ffffff" } ] }, { "featureType": "poi", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road", "elementType": "all", "stylers": [ { "saturation": -100 }, { "lightness": 45 } ] }, { "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "color": "#eeeeee" } ] }, { "featureType": "road", "elementType": "labels.text.fill", "stylers": [ { "color": "#7b7b7b" } ] }, { "featureType": "road", "elementType": "labels.text.stroke", "stylers": [ { "color": "#ffffff" } ] }, { "featureType": "road.highway", "elementType": "all", "stylers": [ { "visibility": "simplified" } ] }, { "featureType": "road.arterial", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "transit", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "water", "elementType": "all", "stylers": [ { "color": "#46bcec" }, { "visibility": "on" } ] }, { "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "color": "#c8d7d4" } ] }, { "featureType": "water", "elementType": "labels.text.fill", "stylers": [ { "color": "#070707" } ] }, { "featureType": "water", "elementType": "labels.text.stroke", "stylers": [ { "color": "#ffffff" } ] } ]
		});
	});
</script>
<!-- /Page Specific JS -->

<?php insertInclude("footerclose"); ?>
