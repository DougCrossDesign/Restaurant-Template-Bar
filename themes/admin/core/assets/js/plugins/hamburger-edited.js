
/*
	* Hamburger
	* Copyright (c) 2015 Andrew Erie & Brandon Miller
	* Dual licensed under the MIT and GPL licenses:
	* http://www.opensource.org/licenses/mit-license.php
	* http://www.gnu.org/licenses/gpl.html
*/

(function($){
	$.fn.hamburger = function(options) {
		return this.each(function() {

			//console.log('Hamburger Menu : Init');

	        var defaults = {
	            "navTarget"   : ".nav-wrap",
	            "isToggle"    : false, 
	            "btnToggle"	  : ".nav-open",
	            "toggleClass" : "nav-toggle-active",

	            "btnOpen"     : ".nav-open",
	            "btnClose"    : ".nav-close",
	            "doHide"      : true,

	            "activeClass" : "nav-active"
	        };

	        var settings = $.extend( {}, defaults, options );
	        
	        // Globals
			var allowScrolling = true,
				scrollTopPos;

			var plugin = {

				init : function(){				
					
					if(settings.isToggle){
						plugin.startToggle();
					} else {
						plugin.startNoToggle();
						if(settings.doHide){
							plugin.hideOpen();
						}
					}

				

				},

				startToggle : function() {
					// Nav Toggle
					//console.log('Hamburger Menu : Set Toggle');
					$(settings.btnToggle).on('click', function(e){
						e.preventDefault();
						console.log('Hamburger Menu : Click Toggle');
						if ($(settings.btnToggle).hasClass(settings.toggleClass)) {						
							$(settings.btnToggle).removeClass(settings.toggleClass);	
							plugin.hamClose();
						} else {
							$(settings.btnToggle).addClass(settings.toggleClass);	
							plugin.hamOpen();
						}
					});
				},

				startNoToggle : function(){
					//console.log('Hamburger Menu : Set No Toggle');
					$(settings.btnOpen).on('click', function(e){
						e.preventDefault();
						plugin.hamOpen();			
						//Hide
						if(settings.doHide){
							plugin.hideOpen();
						}
					});

					$(settings.btnClose).on('click', function(e){
						e.preventDefault();
						plugin.hamClose();
						//Hide
						if(settings.doHide){
							plugin.hideClose();
						}
					});
				},

				hideOpen : function(){
					$(settings.btnClose).show();
					$(settings.btnOpen).hide();
				},

				hideClose : function(){
					$(settings.btnClose).hide();
					$(settings.btnOpen).show();
				},

				hamOpen : function(){			
					//console.log('Hamburger Menu : Open');	
					allowScrolling = false;
					scrollTopPos = $(document).scrollTop();
					$(settings.navTarget).addClass(settings.activeClass);	
					$("#content-main").addClass("content-active");
				},

				hamClose : function(){	
					//console.log('Hamburger Menu : Close');				
					allowScrolling = true;
					$(settings.navTarget).removeClass(settings.activeClass);
					$("#content-main").removeClass("content-active");			
				},

			};

			plugin.init();

		});
	}
})(jQuery);
