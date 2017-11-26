
/*!
	* Custom Checkbox v0.1
	* Copyright (c) 2014 Brandon Miller
	* Dual licensed under the MIT and GPL licenses:
	* http://www.opensource.org/licenses/mit-license.php
	* http://www.gnu.org/licenses/gpl.html
**/
(function($){
	$.fn.customChbx = function(options) {
		return this.each(function() {
			// Variables
			var $input = $(this),
				inputType = $input.attr('type');

			// Defaults
			var defaults = {
				offTxt: $input.attr("data-chbx-offtxt") || "",
				onTxt: $input.attr("data-chbx-ontxt") || ""
			};
			// Combine Defaults and Options into Settings
			var settings = $.extend({}, defaults, options);

			var plugin = {

				// Add Structure
				addStructure: function() {
					$input.after(function(){
						return '<div class="chbx-wrap">' +
							'<div class="chbx-btn">' +
								'<span class="chbx-icon"></span><span class="chbx-txt">' + settings.offTxt + '</span>' +
							'</div>' +
						'</div>';
					});
					$input.appendTo($input.next());
					// Calls
					plugin.startingState();
					if (inputType == 'checkbox') {
						plugin.chbxChangeState();
					} else if (inputType == 'radio') {
						plugin.radioChangeState();
					} else {
						alert("Please use chbx.js for checkboxes and radio buttons only.");
					}
				},

				// Starting State
				startingState: function() {
					if ($input.prop('checked')) {
						$input.parent().addClass("on").find(".chbx-txt").html(settings.onTxt);
					}
				},

				// Checkbox Change State
				chbxChangeState: function() {
					$input.on("change", function(){
						var $this = $(this);
						if ($this.prop('checked')) { // if checked already
							$this.parent().addClass("on").find(".chbx-txt").html(settings.onTxt);
						} else { // if not checked
							$this.parent().removeClass("on").find(".chbx-txt").html(settings.offTxt);
						}
					});
				},

				// Radio Change State
				radioChangeState: function() {
					$input.on("change", function(){
						var $this = $(this),
							$parent = $this.parent(),
							inputName = $this.attr('name');
						if ($this.prop('checked')) {
							var inputNames = document.getElementsByName(inputName),
								inputNamesLen = inputNames.length;
							var i;
							for (i = 0; i < inputNamesLen; i++) {
								if (inputNames[i].type == "radio") {
									$(inputNames[i]).parent().removeClass("on").find(".chbx-txt").html(settings.offTxt)
								}
							}
							$this.parent().addClass("on").find(".chbx-txt").html(settings.onTxt);
						} else {
							return; // do nothing if "on"
						}
					});
				},

				// Initialize Main Code
				init: function() {
					if (settings.offTxt != '' || settings.onTxt != '') {
						$input.parent().addClass("chbx-hastext");
					}
					plugin.addStructure();
				}

			};
			// START IT ALL
			plugin.init();
		});
	}
})(jQuery);