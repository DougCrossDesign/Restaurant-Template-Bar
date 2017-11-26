$(function(){


	//////////////////////////////
	// Site Inits
	//////////////////////////////
	// Init - Tabs
	$(window).on('load', function(){
		$("#weekdaySpecialsTabs").myTabs();
	});

	// Accordion & Complex Accordion
	$('.accordion').accordion();

	// Colorbox
	$(".cbox_group1").colorbox({rel:'cbox_group1', maxWidth:'95%', maxHeight:'95%'});
	$(".cbox").colorbox({maxWidth:'95%', maxHeight:'95%'});

	// Equal Heights Plugin
	$('.eqheight').matchHeight();

	// Hamburger
	$('.hamburger').hamburger({
		negativeSpace: 0, // optional. e.g. ".header". insert element to subtract its height from page height.
		animation: "fadeIn" // choose "slideDown", or "sideSlide"
	});

	// Pickaday
	$('.date').pikaday({
		firstDay: 1,
		minDate: new Date(),
		format: 'MM/DD/YYYY'
	});

	// Pick a time
	$('.time').timepicker({
		'appendTo': function(e) {
			return e.parent();
		},
		'timeFormat': 'g:ia'
	});


	//////////////////////////////
	// Core Inits
	//////////////////////////////

	// Init - Label Hint
	$('.lbl-hint').labelHint();

	// Init - Chosen Plugin
	$(".chosen-select").chosen();

	// Init - Custom Checkbox
	$('.custom-chbx').customChbx();

	// Init - File Input
	$('.fileinput').fileInput();


	//////////////////////////////
	// Other
	//////////////////////////////

	// Fix Startup CSS animations
	$(window).load(function() {
	  $("body").removeClass("preload");
	});

	//If scrolled past logo section fix nav to top
	$(window).scroll(function(){
	    if($(window).scrollTop() > 1){
	        $("body").addClass("header-fixed");
	    }
	    else{
			$("body").removeClass("header-fixed");
	    }
	});


});
