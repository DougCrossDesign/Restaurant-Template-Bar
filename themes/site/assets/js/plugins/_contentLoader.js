/*!
	* contentLoader v0.1
	* URL...
	* Copyright (c) 2016 Brandon Miller
	* Dual licensed under the MIT and GPL licenses:
	* http://www.opensource.org/licenses/mit-license.php
	* http://www.gnu.org/licenses/gpl.html
**/
(function($){
	$.fn.contentLoader = function(options) {
		// allows for chaining
		return this.each(function() {
			// Variables
			var $wrap = $(this),
				$clItems = $wrap.find('#cl-items');
			// Defaults
			var defaults = {
				callback: function(){} // description
			};
			// Combine Defaults and Options into Settings
			var settings = $.extend({}, defaults, options);
			// Plugin Object
			var plugin = {};

			// Start
			plugin.init = function() {
				plugin.selector();
				plugin.buttons();
			}

			// Preload Images
			plugin.preloadImages = function(arr, callback){
				var arr = (typeof arr != "object") ? [arr] : arr;
				var imagesArray = [], 
					len = arr.length,
					numLoaded = 0;
				function checkLoaded(){
					numLoaded++;
					if (numLoaded == len){
						callback(imagesArray);
					}
				}
				// Loop through given Images
				for (var i = 0; i < len; i++) {
					imagesArray[i] = new Image();
					imagesArray[i].onload = function(){
						checkLoaded();
					}
					imagesArray[i].onerror = function(){
						checkLoaded();
					}
					imagesArray[i].src = arr[i];
					// Add Class
					$(imagesArray[i]).addClass('loaded');
				}
			}

			// Content Loader
			plugin.loader = function(newGallery) {
				$.ajax({
					dataType: "html",
					url: newGallery,
					success: function(data) {
						var $data = $(data), 
							imgSrcs = [],
							$newGallery = $data.find('#cl-items'),
							grabbedHtml = $newGallery.html(),
							grabbedImages = $newGallery.find('img');
						grabbedImages.each(function(){
							imgSrcs.push(this.src);
						});
						// Preload
						if (imgSrcs.length > 0) {
							plugin.preloadImages(imgSrcs, function(a){
								// append content
								$clItems.html(grabbedHtml);
								$wrap.removeClass("loading");
								settings.callback(); // Re-init plugins, etc.
							});
						} else {
							$clItems.html(grabbedHtml);
							$wrap.removeClass("loading");
							settings.callback(); // Re-init plugins, etc.
						}
					},
					error: function() {
						$("#cl-items").prepend("<div class='entry-content'><p><em>Nothing was retrieved. Please select another Gallery.</em></p></div>");
						$wrap.removeClass("loading");
					}
				});
			}

			// Content Buttons
			plugin.buttons = function() {
				// Load Gallery via Ajax
				$(".gallery-nav a").on("click", function(e){
					e.preventDefault();
					$wrap.addClass("loading");
					// Load Content via Ajax
					plugin.loader($(this).attr('href'));
				});
			}

			// Content Selector
			plugin.selector = function() {
				// Load Gallery via Ajax
				$(".gallery-nav").on("change", function(){
					$wrap.addClass("loading");
					// Load Content via Ajax
					plugin.loader($(this).val());
				});
			}

			// START IT ALL
			plugin.init();

			// PUBLIC METHODS
			// $.fn.contentLoader.publicMethodName = function($newEl) {
			// 	plugin.methodName($newEl);
			// };
		});
	}
})(jQuery);