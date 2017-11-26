/*
	* Acordion
	* Copyright (c) 2015 Andrew Erie
	* Dual licensed under the MIT and GPL licenses:
	* http://www.opensource.org/licenses/mit-license.php
	* http://www.gnu.org/licenses/gpl.html
*/

(function($){
	$.fn.accordion = function(options) {
		return this.each(function() {	 
	        var target = this;               	         
			var plugin = {
				init : function(){						
					$(target).find('.accordion-toggle').click(function(){							
					    $(this).next().slideToggle('slow', function(){
					    	 $('html, body').animate({
						        scrollTop: ($(this).offset().top - 250)
						    }, 500);
					    });
					    if ($(this).find(".accordion-icon").hasClass( "active" ) ) {
					    	$(this).find(".accordion-icon").removeClass("active");		
					    } else {
					    	$(target).find(".accordion-icon").removeClass("active");			    
					   		$(this).find(".accordion-icon").addClass("active");				
					    }  	   
					    $(".accordion-content").not($(this).next()).slideUp('slow');
				    });
				},	
			};
			plugin.init();
		});
	}
})(jQuery);
