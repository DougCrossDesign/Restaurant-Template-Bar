/*
	* fileInput v0.1
	* Copyright (c) 2014 Brandon Miller
	* Dual licensed under the MIT and GPL licenses:
	* http://www.opensource.org/licenses/mit-license.php
	* http://www.gnu.org/licenses/gpl.html
**/
(function($){
	$.fn.fileInput = function(options) {
		return this.each(function() {
			// Variables
			var $input = $(this),
				isIE = window.navigator.appName == 'Microsoft Internet Explorer';
			var $wrap, $fileRemove, $filenameTxt, $fileInput;

			// Defaults
			var defaults = { 
				btnTxt: $input.attr("data-fi-btn") || "Select File",
				txtPlaceholder: $input.attr("data-fi-txtph") || ""
			};
			// Combine Defaults and Options into Settings
			var settings = $.extend({}, defaults, options);
					
			var plugin = {

				// Add Structure
				addStructure: function() {
					$input.after(function(){
						return '<div class="fileinput-wrap">' +
							'<div class="fileinput-btn">' +
								'<div class="fileinput-btnblock">' +
									'<span class="fileinput-btntxt">' + settings.btnTxt + '</span>' +
								'</div>' +
							'</div>' +
							'<div class="fileinput-remove">&nbsp; &times &nbsp;</div>' +
							'<div class="fileinput-txtfield">' +
								'<span class="fileinput-filename"><span class="fi-icon"></span>&nbsp;<span class="fi-txt">' + settings.txtPlaceholder + '</span></span>' +
							'</div>' +
						'</div>';
					});
					$input.appendTo($input.next().find(".fileinput-btnblock"));
					// Calls
					plugin.elementVars();
				},

				// Setup Vars for new elements
				elementVars: function() {
					$wrap = $input.closest(".fileinput-wrap");
					$fileRemove = $wrap.find(".fileinput-remove");
					$filenameTxt = $wrap.find(".fi-txt");
					$fileInput = $wrap.find(".fileinput");
					// Calls
					plugin.addFileName();
					plugin.removeFiles();
				},

				// Remove Files
				removeFiles: function() {
					$fileRemove.on("click", function(){
						var $this = $(this);
						$filenameTxt.html(settings.txtPlaceholder);
						//ie8+ doesn't support changing the value of input with type=file so clone instead
						if (isIE) { 
							var inputClone = $fileInput.clone(true);
							$fileInput.after(inputClone);
							$fileInput.remove();
							$fileInput = inputClone;
						} else {
							$fileInput.val("");
						}
						$this.css({"display": "none"});
					});
				},

				// Add File Name
				addFileName: function() {
					$input.on("change", function(){
						var $this = $(this),
							uploadedFile = $this.val().replace(/^.+\\/, '');
						$filenameTxt.html(uploadedFile);
						if ($this.val() !== "") {
							$fileRemove.css({"display": "table-cell"});
						}
					});
				},

				// Initialize Main Code
				init: function() {
					plugin.addStructure();
				}
				
			};
			// START IT ALL
			plugin.init();
		});
	}
})(jQuery);