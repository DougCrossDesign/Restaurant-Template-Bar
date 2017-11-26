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

	<div class="page-header" style="background-image:url(<? insertImage('bg-subheader-lg.jpg') ?>)">
		<div class="page-header-text">
			<div>Join Our Team</div>
		</div>
	</div>

	<div class="page-content bg6 c1">
		<div class="wrap-sm wrap-pad clearfix">
			<form id="parties_form" class="col-space2 col-auto-sm form-default clearfix" action="#" method="post" NOVALIDATE>
				<ul>
					<li class="col lbl-hint lbl-mini">
						<label for="form_positions">Available Positions</label>
						<select class="chzn-select" id="form_positions" name="form_positions">
							<option value="">Available Positions</option>
							<option value="Position Name">Position Name</option>
							<option value="Position Name">Position Name</option>
							<option value="Position Name">Position Name</option>
							<option value="Position Name">Position Name</option>
							<option value="Position Name">Position Name</option>
							<option value="Position Name">Position Name</option>
						</select>
					</li>
					<li class="col lbl-hint lbl-mini col1-2">
						<label for="form_fname">First Name*</label>
						<input type="text" id="form_fname" name="form_fname" placeholder="First Name*">
					</li>
					<li class="col lbl-hint lbl-mini col1-2">
						<label for="form_lname">Last Name*</label>
						<input type="text" id="form_lname" name="form_lname" placeholder="Last Name*">
					</li>
					<li class="col lbl-hint lbl-mini">
						<label for="form_email">Email</label>
						<input type="email" id="form_email" name="form_email" placeholder="Email">
					</li>
					<li class="col lbl-hint lbl-mini">
						<label for="form_phone">Phone</label>
						<input type="text" id="form_phone" name="form_phone" placeholder="Phone">
					</li>

					<li class="col lbl-hint lbl-mini col1-3">
						<label for="form_city">City*</label>
						<input type="text" id="form_city" name="form_city" placeholder="City*">
					</li>

					<li class="col lbl-hint lbl-mini col1-3">
						<label for="form_state" class="">State</label>
						<select class="chzn-select" id="form_state" name="form_state">
							<option value="">State</option>
							<option value="AL">Alabama</option>
							<option value="AK">Alaska</option>
							<option value="AZ">Arizona</option>
							<option value="AR">Arkansas</option>
							<option value="CA">California</option>
							<option value="CO">Colorado</option>
							<option value="CT">Connecticut</option>
							<option value="DE">Delaware</option>
							<option value="DC">District Of Columbia</option>
							<option value="FL">Florida</option>
							<option value="GA">Georgia</option>
							<option value="HI">Hawaii</option>
							<option value="ID">Idaho</option>
							<option value="IL">Illinois</option>
							<option value="IN">Indiana</option>
							<option value="IA">Iowa</option>
							<option value="KS">Kansas</option>
							<option value="KY">Kentucky</option>
							<option value="LA">Louisiana</option>
							<option value="ME">Maine</option>
							<option value="MD">Maryland</option>
							<option value="MA">Massachusetts</option>
							<option value="MI">Michigan</option>
							<option value="MN">Minnesota</option>
							<option value="MS">Mississippi</option>
							<option value="MO">Missouri</option>
							<option value="MT">Montana</option>
							<option value="NE">Nebraska</option>
							<option value="NV">Nevada</option>
							<option value="NH">New Hampshire</option>
							<option value="NJ">New Jersey</option>
							<option value="NM">New Mexico</option>
							<option value="NY">New York</option>
							<option value="NC">North Carolina</option>
							<option value="ND">North Dakota</option>
							<option value="OH">Ohio</option>
							<option value="OK">Oklahoma</option>
							<option value="OR">Oregon</option>
							<option value="PA">Pennsylvania</option>
							<option value="RI">Rhode Island</option>
							<option value="SC">South Carolina</option>
							<option value="SD">South Dakota</option>
							<option value="TN">Tennessee</option>
							<option value="TX">Texas</option>
							<option value="UT">Utah</option>
							<option value="VT">Vermont</option>
							<option value="VA">Virginia</option>
							<option value="WA">Washington</option>
							<option value="WV">West Virginia</option>
							<option value="WI">Wisconsin</option>
							<option value="WY">Wyoming</option>
						</select>
					</li>

					<li class="col lbl-hint lbl-mini col1-3 btm-margin">
						<label for="form_zip">Zip*</label>
						<input type="text" id="form_zip" name="form_zip" placeholder="Zip*">
					</li>

					<li class="col1-2 col btm-margin">
						<label for="">Can you work full time?</label>
						<label class="custom-chbx-lbl" for="form_cstm_chbx1"><input class="custom-chbx" type="checkbox" id="form_cstm_chbx1" name="form_cstm_chbx1" data-chbx-ontxt="Yes" data-chbx-offtxt="No"> Yes / No</label>
					</li>


					<div class="form-actionblock btm-margin clearfix">
						<li class="col ">
							<label for="form_upload">Cover Letter</label>
							<input class="fileinput" type="file" id="form_upload" name="form_upload" data-fi-btn="Browse" data-fi-txtph="Upload PDF" />
						</li>

						<li class="col ">
							<label for="form_upload">Upload Resume</label>
							<input class="fileinput" type="file" id="form_upload" name="form_upload" data-fi-btn="Browse" data-fi-txtph="Upload PDF" />
						</li>
					</div>

					<li class="col lbl-hint lbl-mini">
						<label for="form_pasteresume">Paste Resume</label>
						<textarea type="text" id="form_pasteresume" name="form_pasteresume" placeholder="Paste Resume"></textarea>
					</li>

					<li class="col">
						<button type="submit" class="submit" id="form_submit" name="form_submit">Submit</button>
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
