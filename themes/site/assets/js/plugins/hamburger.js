
(function($){
	$.fn.hamburger = function(options) {
		// allows for chaining
		return this.each(function() {
			// Variables
			var $btn = $(this),
				$document = $(document),
				$dpdwn = $($btn.attr('data-toggle')),
				$navOverlay = $('.nav-overlay');
			var allowScrolling = true,
				scrollTopPos;
			// Defaults
			var defaults = {
				negativeSpace: 0, // insert element to subtract its height from page height. e.g. ".header"
				animation: "slideDown" // 
			};
			// Combine Defaults and Options into Settings
			var settings = $.extend({}, defaults, options);
			// Plugin Object
			var plugin = {};
			plugin.init = function(){
				plugin.animType();
				plugin.navOverflow();
				plugin.hamEvents();
			}
			// Animation Type
			plugin.animType = function(){
				switch (settings.animation) {
					case "slideDown":
						$dpdwn.addClass('slide-down');
						break;
					case "sideSlide":
						$dpdwn.addClass('side-slide');
						$dpdwn.outerHeight($(window).height());
						break;
					case "fadeIn":
						$dpdwn.addClass('fade-in');
						break;
					default:
						break;
				}
			}
			// Nav Overflow
			plugin.navOverflow = function(){
				// solve fixed height overflow issue
				var winH = $(window).height();
				var navH = (settings.negativeSpace != 0) ? $(settings.negativeSpace).outerHeight() : 0;
				var maxH = winH - navH;
				$dpdwn.css({ "max-height": maxH });
			}
			// Slide Toggle
			plugin.navSlideToggle = function(){
				if (settings.animation == "slideDown") $dpdwn.slideToggle('fast');
				if (settings.animation == "fadeIn") $dpdwn.fadeToggle('fast');
				$btn.toggleClass('active');
				$dpdwn.toggleClass('active');
			}
			// Slide Down
			plugin.navSlideDown = function(){
				if (settings.animation == "slideDown") $dpdwn.slideDown('fast');
				if (settings.animation == "fadeIn") $dpdwn.fadeIn('fast');
				$btn.addClass('active');
				$dpdwn.addClass('active');
			}
			// Slide Up
			plugin.navSlideUp = function(){
				if (settings.animation == "slideDown") $dpdwn.slideUp('fast');
				if (settings.animation == "fadeIn") $dpdwn.fadeOut('fast');
				$btn.removeClass('active');
				$dpdwn.removeClass('active');
			}
			// Events
			plugin.hamEvents = function(){
				// Button
				$btn.on('click', function(e){
					e.preventDefault();
					// use $btn for open & close
					plugin.navSlideToggle();
					$navOverlay.toggleClass('active');
					allowScrolling = !allowScrolling;
					scrollTopPos = $(document).scrollTop();
				});
				// Close
				$('.hamburger-close').on('click', function(e){
					e.preventDefault();
					plugin.navSlideUp();
					$navOverlay.removeClass('active');
					allowScrolling = true;
				});
				// No Scroll
				$document.scroll(function() {
					if(allowScrolling === false) {
						$document.scrollTop(scrollTopPos);
					}
				});
			}
			// START IT ALL
			plugin.init();

			// PUBLIC METHODS
			$.fn.hamburger.publicMethodName = function($newEl) {
				plugin.methodName($newEl);
			};
		});
	}
})(jQuery);