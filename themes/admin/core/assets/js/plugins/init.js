


$(function(){

	$('.LimitChar').limitinput();

	$('#nav-main').hamburger();

	$('.timepicker').pickatime();


	 // Init - Pickaday
	$('.datepicker')
		.pikaday({
			firstDay: 1,
			format: 'MM/DD/YYYY',
			onOpen: function(e) {
				console.log(e);
			}
		})
		.on('focus blur', function() {
			$(this).keyup();
		});

	$(".disabled :input").attr("disabled", true)




	function escapeRegExp(str) {
		return str.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
	}

	//Nav Menu click through
	var allPanels = $('#nav-main li:not(.nav-active-sub) ol').hide();
	$('.nav-menu > a').click(function(event){
		//console.log("test");
		if($(this).parent().has('ol').length > 0){
			event.preventDefault();
			if($(this).parent().hasClass("nav-active-sub")){
				$(this).parent().parent().find('.nav-menu').removeClass("nav-active-sub");
				$(this).parent().parent().find('.nav-menu').find('ol').slideUp();
			} else {
				var d = 0;
				if($("#nav-main").has(".nav-active-sub").length > 0){d = 300;} else {d = 0;}
				$(this).parent().parent().find('.nav-menu').removeClass("nav-active-sub");
				$(this).parent().parent().find('.nav-menu').find('ol').slideUp();
				$(this).parent().find('ol').delay(d).slideDown();
				$(this).parent().delay(d).addClass("nav-active-sub");
			}
		} else {
			//just uses the HREF
		}
	});

	/**
	 * DEPRECATED  - event title auto generate friendly url
	 * This should be replaced with our standard .generateurl method
	 */
	$("form.event.new #title").change(function(){
		console.log('changed title');
		var raw = $("form.new #title").val().trim();
		var toDashes = [' ', '/', '\\', '-', '=', '+'];

		var parsed = raw.trim();

		for(var i = 0; i < toDashes.length; i++){
			var char = toDashes[i];
			parsed = parsed.split(char).join(' ');
		}

		parsed = parsed.trim();

		parsed = parsed.split(" ").join("-");

		parsed = parsed.replace(/[^0-9a-z \-]/gi, '');

		$("form.new #friendlyurl").val("/events/" + parsed.toLowerCase());
	});

	$("form.news.new #title").change(function(){
		var raw = $("form.new #title").val().trim();
		var parsed = parseStringForUrl(raw);
		$("form.new #friendlyurl").val("/news/" + parsed);
	});

	/**
	 * Util function that takes a title or name and parses it for use as a friendly url
	 * @param raw
	 * @returns {string}
	 */
	function parseStringForUrl(raw){
		var toDashes = [' ', '/', '\\', '-', '=', '+'];

		var parsed = raw.trim();

		for(var i = 0; i < toDashes.length; i++){
			var char = toDashes[i];
			parsed = parsed.split(char).join(' ');
		}

		parsed = parsed.replace(/[^0-9a-z \-]/gi, '');

		parsed = parsed.split(" ").join("-");

		return parsed.toLowerCase();
	}

	/**
	 * START - Siteinfo ajax editing system
	 */
	$("#saveall").click(function(e){
		e.preventDefault();
		$("tr.editing a.save").click();
		$(this).parents('form').focus().submit();
	});
	$(".tabs-nav").click(function() {
		var tabname = $(this).attr('data-tab');
		$(".tabs-nav").each(function(){
			if($(this).attr('data-tab') == tabname){
				$(this).addClass('active');
			} else {
				$(this).removeClass('active');
			}
		});
		$("table").each(function(){
			if($(this).attr('data-tab') == tabname){
				$(this).show();
			} else {
				$(this).hide();
			}
		});
	});
	$(".button.edit").click(function(e){
		e.preventDefault();
		var $tr = $(this).parents('tr');
		$tr.find('.options-editing').show();
		$tr.find('.options-not-editing').hide();
		$tr.find('.cancel').click(cancelEditing);
		$tr.find('.save').click(saveEditing);
		$tr.addClass('editing');
		$tr.find('td.editable').each(function(){
			$(this).find('.text').hide();
			var val = $(this).find('.text').text();
			var type = $(this).attr('data-val');
			var	inputHtml = '<input type="text" name="'+ type +'[]" value="'+ val +'" />';
			$(this).find('.input').html(inputHtml);
		});
		// now add groups dropdown
		if( !$tr.find('select.group_id').length ) {
			var activeId = $("span.tabs-nav.active").attr('data-tabid');
			var dropdown = '<select name="group_id[]" class="group_id">';
			$("span.tabs-nav").each(function () {
				var thisid = $(this).attr('data-tabid');
				dropdown += '<option ' + (thisid == activeId ? ' selected="selected" ' : '') + ' value="' + thisid + '">' + $(this).attr('data-tab') + '</option>';
			});
			dropdown += '</select>';
			$tr.find('.options-editing').prepend(dropdown);
		} else {
			$tr.find('select.group_id').show();
		}
		// now add client permission dropdown
		$tr.find('td.permissionsblock').each(function() {
			$(this).find(".permissions-select").show();
			$(this).find(".permissions-text").hide();
		});

	});
	$(".button.delete").click(function(e){
		// e.preventDefault();
	});
	function saveEditing(){
		console.log('save');
		var $tr = $(this).parents('tr');
		$tr.addClass('pending');
		$tr.removeClass('editing');
		$tr.find('.options-editing').hide();
		$tr.find('select.group_id').hide();
		$tr.find('.options-not-editing').show();

		var i = 0;
		var id = $tr.attr('data-id');
		$tr.find('td.permissionsblock').each(function() {
			var newpermval = $(this).find(".permissions-select").find("select[name='permissionselect'] option:selected").val();
			var newpermtext = $(this).find(".permissions-select").find("select[name='permissionselect'] option:selected").text();

			$tr.find('.permissions-text').html(newpermtext);
			$(this).find(".permissions-select").hide();
			$(this).find(".permissions-text").show();

			var	inputHtml = '<input type="hidden" name="permission[]" value="'+ newpermval +'" />';
			$(this).find(".input").html(inputHtml);
		});

		i = 0;
		$tr.find('td.editable').each(function(){
			var newval = $(this).find('input').val();
			$(this).find('.text').text(newval);
			$(this).find('.text').show();
			$(this).find('input').attr('type', "hidden");
			if(i == 0 && !$(this).find('.input').find('input.id_holder').length) {
				$(this).find('.input').append('<input type="hidden" class="id_holder" name="id[]" value="' + id + '" />');
			}
			i++;
		});
	}
	function cancelEditing(){
		console.log('cancel');
		var $tr = $(this).parents('tr');
		$tr.removeClass('editing');
		$tr.find('.options-editing').hide();
		$tr.find('select.group_id').remove();
		$tr.find('.options-not-editing').show();
		$tr.find('.permissions-text').show();
		$tr.find('.permissions-select').hide();
		$tr.find('td.editable').each(function(){
			$(this).find('.text').show();
			$(this).find('.input').html('');
		});
	}
	/**
	 * END - Siteinfo ajax editing system
	 */

	// chosen
	$(window).ready(function(){
		$(".chosen").chosen({width: "100%"});
	});

	// tooltip
	$(document).tooltip({
		items : ".admin-image-rollover",
		content : function(){
			var element = $(this);
			var url = '<img src="'+ $(this).attr('data-rollover') +'" />';
			return url;
		},
		track : true
	});

	/**
	 * Dropzone for gallery page (this might need to be reworked later)
	 * @type {{init: Dropzone.options.dropzone.init}}
	 */
	Dropzone.options.dropzone = {
		init: function(){
			this.on("complete", function(file){
				console.log(file.xhr.response);
				var data = file.xhr.response.split(",");
				var filename = data[0];
				var order = data[1];

				var html = '<li class="admin-section-t2"><ul>';
				html += '<input type="hidden" name="image_displayorder[]" value="'+ order +'" >';
				html += '<li class="lbl-hint col  btm-margin"><label for="image_title[]" class="show">Title</label>';
				html += '<input name="image_title[]" id="image_title[]" type="text" placeholder="Title" value="">';
				html += '</li><li class="col"><label for="image_image[]">Image</label><br><div class="admin-image-show">';
				html += '<img class="admin-image-rollover" data-rollover="/assets/images/galleries/rollover/'+ filename +'"';
				html += 'src="/assets/images/galleries/cms/'+ filename +'"></div><input name="image_image[]" id="image_image[]" type="file"></li>';
				html += '<input type="hidden" name="image_imagefile[]" value="'+ filename +'">';
				html += '<select name="image_delete[]"><option value="0" selected="selected">Active</option><option value="1">Delete</option></select></ul></li>';

				$("#meta").append(html);

				$("input[name=cancel]").remove();
			});
		}
	}

	/**
	 * This function is used to auto generate friendly urls from input titles on edit pages
	 */
	$(".generate-url").each(function(){
		$li = $(this);
		$friendlyUrlInput = $li.find("input");
		var deriveFrom = $li.attr("data-derive-from");
		var prefix = $li.attr('data-prefix');
		$("#" + deriveFrom).change(function(){
			$stringInput = $(this);
			var parsed = parseStringForUrl($stringInput.val());
			if (prefix.length) {
				$friendlyUrlInput.val('/' + prefix + '/' + parsed);
			} else {
				$friendlyUrlInput.val('/' + parsed);
			}

			if ($(".generate-admin-key")[0]) {
				console.log(".generate-admin-key");
				$(".generate-admin-key").each(function() {
					$li = $(this);
					$adminKeyInput = $li.find("input");
					var prefix = $li.attr('data-prefix');
					var locked = $li.attr('data-locked');
					if (locked != 1) {
						if (prefix.length) {
							$adminKeyInput.val(prefix + '-' + parsed);
						} else {
							$adminKeyInput.val(parsed);
						}
					}
				});
			}
		});
	});

	/**
	 * This function is used to auto generate admin keys from input titles on edit pages
	 */
	$(".generate-admin-key").each(function(){
		$li = $(this);
		$adminKeyInput = $li.find("input");
		var deriveFrom = $li.attr("data-derive-from");
		var prefix = $li.attr('data-prefix');
		var locked = $li.attr('data-locked');
		if (locked != 1) {
			$("#" + deriveFrom).change(function () {
				$stringInput = $(this);
				var parsed = parseStringForUrl($stringInput.val());
				if (prefix.length) {
					$adminKeyInput.val(prefix + '-' + parsed);
				} else {
					$adminKeyInput.val(parsed);
				}
			});
		}
	});

	/**
	 * Simple tab system for back end
	 */
	$("div.tabheader > a").click(function(){
		var tabgroup = $(this).parent().attr('data-tabgroup');
		var tabName = $(this).attr("data-tab");
		$("div[data-tabgroup=" + tabgroup + "] > a").each(function(){
			$(this).removeClass("active");
		});
		$(this).addClass("active");

		$("div.tabcontents[data-tabgroup=" + tabgroup + "] > div").each(function(){
			if($(this).attr("data-tab") == tabName){
				$(this).addClass("active");
			} else {
				$(this).removeClass("active");
			}
		});
	});

	/**
	 * Sortable rows
	 * To enable auto saving of sortable rows do the following:
	 * 1. Add the "saveSortable" class on the parent of the list of children (e.g. the <ul> element)
	 * 2. Add the attribute "data-save-url" with the url to send save order requests on the parent (the <ul> element)
	 * 3. Add the class "sortableRow" and attribute "data-id" with the row id on each of the immediate children of the parent (e.g. the <li> elements)
	 * 4. Add the attribute "data-delete-url" with the deletion url to save deletion requests on the parent (the <ul> element)
	 * 5. Add an "onclick=deleteSortable(this)" on the delete button of each element to fire the deletion function
	 *
	 * To make editable on the fly:
	 * 1. Add "data-edit-url" with the url we want to send edit changes to
	 * 2. Add class "editSortable" and "data-edit-name" with the name of the model column (e.g. "title") on the holder of the item to be edited (e.g. the <li> element)
	 * 3. Add class "editSortableButton" and "onclick=editSortable(this)" on the edit button (using this since we are swapping it to say "save" later)
	 *
	 * Summary:
	 * 		- Parent: <ul class="saveSortable" data-save-url="/products/save/43" data-delete-url="/products/deleteItem" data-edit-url="/products/editItem">
	 * 		- Child: <li class="sortableRow" data-id="4">
	 * 		 			<div class="editSortable" data-edit-name="title">Item</div>
	 * 					<a onclick="editSortable(this)" class="editSortableButton">	Edit	</a></li>
	 *					<a onclick="deleteSortable(this)">							Delete	</a></li>
	 *				</li>
	 *			</ul>
	 *
	 * keywords: sortable, draggable, jquery ui, keith
	 */
	$(".saveSortable").sortable({
		stop : function(){
			var $el = $(this);
			var url = $el.attr('data-save-url');

			console.log(url);
			var orders = [];
			$el.children().each(function(){
				orders.push($(this).attr('data-id'));
			});
			console.log(orders);

			$.get(url, {orders : orders}, function(){
				console.log('saved');
			});
		}
	});
	document.deleteSortable = function(element){
		if(confirm("Are you sure you want to delete this item?")) {
			// get url
			var $parent = $(element).closest(".saveSortable");
			var url = $parent.attr("data-delete-url");
			// get id
			var $row = $(element).closest(".sortableRow");
			var id = $row.attr('data-id');

			$.get(url, {id: id}, function () {
				$row.remove();
			});
		}
	}
	document.editSortable = function(element){
		var $this = $(element);
		var $row = $this.closest(".sortableRow");
		var $editable = $row.find(".editSortable");
		var fieldName = $editable.attr("data-edit-name");
		var val = $editable.text();

		var editHtml = '<input type="text" value="'+ val +'" />';
		$editable.html(editHtml);

		// change edit button to save button
		var $editButton = $row.find(".editSortableButton");
		$editButton.text("Save");
		$editButton.attr("onclick", "saveEditSortable(this)");
	}
	document.saveEditSortable = function(element){
		var $this = $(element);
		var $parent = $this.closest(".saveSortable");
		var $row = $this.closest(".sortableRow");
		var $editable = $row.find(".editSortable");
		var $input = $row.find("input[type=text]");
		var val = $input.val();
		var url = $parent.attr("data-edit-url");

		var data = {id : $row.attr('data-id')};
		data[$editable.attr("data-edit-name")] = val;
		$.get(url,data, function(){
			// saved.. now make the edit button an edit button again
			var $editButton = $row.find(".editSortableButton");
			$editButton.attr("onclick", "editSortable(this)");
			$editButton.text("Edit");

			$editable.empty();
			$editable.text(val);
			console.log(val);
		});
	}

});    