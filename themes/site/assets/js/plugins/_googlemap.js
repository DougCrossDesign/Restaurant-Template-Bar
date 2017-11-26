/*!
	* gMapHelper Advanced v2.6
	* https://github.com/bMil21/ui-site/tree/master/components/googlemap
	* Copyright (c) 2013 Brandon Miller
	* Dual licensed under the MIT and GPL licenses:
	* http://www.opensource.org/licenses/mit-license.php
	* http://www.gnu.org/licenses/gpl.html
**/
(function($){
	$.fn.gMapHelper = function(options) {
		// If no Map don't start
		if( $(this).length < 1 ) return;
		// Variables
		var mapEl = $(this)[0], //returns a HTML DOM Object (instead of jQuery Object)
			directionsService = new google.maps.DirectionsService(), 
			directionsDisplay = new google.maps.DirectionsRenderer(), 
			geocoder, myMapType, map, marker, map_options, infowindow;
		// Defaults
		var defaults = {
			icon: "",
			scrollwheel: false,
			zoom: 14, 
			address: false,
			mapType: "roadmap",
			styles: false,
			addressInfoWindow: '' // Single Address
		};
		// Combine Defaults and Options into Settings
		var settings = $.extend({}, defaults, options);
		
		var plugin = {
			
			// Geocoder (convert SINGLE address into Lat/Lng)
			myGeocoder: function() {
				//var coordinates = new google.maps.LatLng(41.895648, -87.676000);
				// new Geocoder Object
				geocoder = new google.maps.Geocoder();
				geocoder.geocode( { 'address': settings.address}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
					  settings.address = results[0].geometry.location;
					  // Start Build if address located
					  plugin.buildMap();
					} else {
					  alert('Geocode was not successful for the following reason: ' + status);
					}
				});
			}, 
			
			// Determine Map Type
			mapType: function() {
				switch(settings.mapType){
					case "roadmap":
						myMapType = google.maps.MapTypeId.ROADMAP;
						break;
					case "satellite":
						myMapType = google.maps.MapTypeId.SATELLITE;
						break;
					case "hybrid":
						myMapType = google.maps.MapTypeId.HYBRID;
						break;
					case "terrain":
						myMapType = google.maps.MapTypeId.TERRAIN;
						break;
				}
				return myMapType;
			}, 
			
			// Build Map with Settings (ONLY FOR A SINGLE ADDRESS)
			buildMap: function() {
				// Set Map Options
				var map_options = {
				  center: settings.address,
				  zoom: settings.zoom,
				  scrollwheel: settings.scrollwheel,
				  mapTypeId: plugin.mapType()
				}
				// New Map Object.. w/ element and options
				map = new google.maps.Map(mapEl, map_options);
				// Info Window
				infowindow = new google.maps.InfoWindow({
					content: "Loading..."
				});
				// New Marker Object
				marker = new google.maps.Marker({
					position: settings.address,
					map: map,
					title: 'Location Name',
					icon: settings.icon
				});
				// Click event for Marker, Info Window
				google.maps.event.addListener(marker, 'click', function(settings) {
					return function() {
						infowindow.setContent(settings.addressInfoWindow);
						infowindow.open(map, this);
					}
				}(settings));
				// Display Directions on Map
				directionsDisplay.setMap(map);
				// Display Directions List
				directionsDisplay.setPanel(document.getElementById('dir-panel'));
				// Add Custom Styles
				plugin.addStyles();
			}, 
			
			// Build Map with Settings (ONLY FOR MULTIPLE LOCATIONS)
			buildMapMulti: function() {
				var firstAddress = settings.address[0];
				// Set Map Options
				var map_options = {
				  center: new google.maps.LatLng( firstAddress.itemAddress[0], firstAddress.itemAddress[1]), // Lat, Lng of 1st Address
				  zoom: settings.zoom,
				  scrollwheel: settings.scrollwheel,
				  mapTypeId: plugin.mapType()
				}
				//create empty LatLngBounds object
				var bounds = new google.maps.LatLngBounds();
				// New Map Object.. w/ element and options
				map = new google.maps.Map(mapEl, map_options);
				// Info Window
				infowindow = new google.maps.InfoWindow({
					content: "Loading..."
				});
				// New Marker Object
				var i;
				for (i = 0; i < settings.address.length; i++) {
					var myLocation = settings.address[i].itemAddress,
						myLatLng = new google.maps.LatLng(myLocation[0], myLocation[1]);
					marker = new google.maps.Marker({
						position: myLatLng,
						map: map,
						title: settings.address[i].itemName,
						icon: settings.icon
					});
					//extend the bounds to include each marker's position
					bounds.extend(marker.position);
					// Click event for Marker, Info Window
					google.maps.event.addListener(marker, 'click', function(settings, i) {
						return function() {
							var curInfoWindow = settings.address[i].itemInfoWindow;
							infowindow.setContent(curInfoWindow);
							infowindow.open(map, this);
						}
					}(settings, i));
				}
				if (settings.address.length > 1) {
					map.fitBounds(bounds);
				}
				// Add Custom Styles
				plugin.addStyles();
			}, 

			// Add Custom Styles
			addStyles: function() {
				var myStyleOptions = {
					name: 'My Map'
				};
				var myMapStyles = new google.maps.StyledMapType( settings.styles, myStyleOptions );
				map.mapTypes.set('mymap', myMapStyles);
				map.setMapTypeId('mymap');
			},
			
			// Door-to-Door (Single Address Only)
			calcRoute: function(){
				var start = document.getElementById('saddr').value, 
					end = settings.address;
				var request = {
					origin: start,
					destination: end,
					travelMode: google.maps.TravelMode.DRIVING
				};
				directionsService.route(request, function(response, status) {
					if (status == google.maps.DirectionsStatus.OK) {
						directionsDisplay.setDirections(response);
					}
				});
				// Remove initial custom icon, rebuild
				settings.icon = null;
				plugin.buildMap();
			}, 
			
			// Start it all
			init: function() {
				if (typeof settings.address === "string") {
					// Address given as String
					plugin.myGeocoder();
				} else if (typeof settings.address === "object") {
					// Address given as String
					plugin.buildMapMulti();
				} else {
					// Address not given (try to import JSON)
					$.getJSON("gmap.json", function(data){
						var jsonAddress = data.address;
						settings.address = jsonAddress;
						plugin.buildMapMulti();
					}).fail(function(jqxhr, textStatus, error) {
						alert("Please use a suitable address. Developers: check console for errors.")
						var err = textStatus + ", " + error;
						console.log( "JSON Fail. Request Failed: " + err );
					});
				}
				// Call Door-to-Door
				$("#get-dir").on("click", function() {
					plugin.calcRoute();
				});
			}
		
		}
		
		// Initialize Plugin when everything is Loaded
		$(document).ready(function(){
			plugin.init();
		});
	}
})(jQuery);