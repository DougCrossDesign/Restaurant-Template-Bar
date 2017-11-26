
/*
	* Limit Input 1.0
	* Copyright (c) 2015 Andrew Erie & Anthony Meyer
	* Dual licensed under the MIT and GPL licenses:
	* http://www.opensource.org/licenses/mit-license.php
	* http://www.gnu.org/licenses/gpl.html
*/

(function($){
	$.fn.limitinput = function(options) {
		return this.each(function() {		

			var target = this;	        
			var curLimit = 0;
			var removeLimit = false;
			var curVal = $(this).val();
			var curLength = curVal.length;
			var classes = $(this).attr('class').split(/\s+/);			

			var plugin = {

				init : function(){					
					$("<div class='input-limit'></div>").insertAfter($(target)); 
					plugin.runThrough();
				},

				runThrough: function(){
					curVal = $(target).val();
					curLength = curVal.length;
					plugin.setLimit();
					plugin.toTheLimit();					
				},

				setLimit : function(){
					$.each(classes,function(index,item){
						if(item.substr(0,10) == "charLimit_"){
							curLimit = item.substr(10);										
						}
						if(item == "removeLimit"){
							removeLimit = true;
						}
					});
				},

				toTheLimit : function(){
					if(curLength >= curLimit){
						target.value = target.value.substring(0, curLimit);
						curLength = curLimit;			
					}

					if(curLimit > 0) {
						if(removeLimit == true && curLength > curLimit){
							$(this).val(curVal.substr(0, curLimit));
							curLength = curLimit;
						}
						//console.log("curlimit:" + curLimit);
						//console.log("curlength:" + curLength);
						$(target).parent().find(".input-limit").html((curLimit-curLength) + " of " + curLimit + " characters remaining.");
					}
						
				},

			};

			plugin.init();

			$(this).bind('input', function(event) {	 				
				plugin.runThrough();
			});

			$(this).bind('paste', function(event) {	 
				setTimeout( function() {
		          plugin.runThrough();		           
		        }, 100);
		    });

		});
	}
})(jQuery);
