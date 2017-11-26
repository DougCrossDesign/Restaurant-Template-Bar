$('.contacts-list-slider').slick({
	infinite: false,
	speed: 300,
	slidesToShow: 4,
	slidesToScroll: 4,
	arrows: true,
	dots: false,
	nextArrow: '<i class="aycicon-right_arrow slick-next"></i>',
 	prevArrow: '<i class="aycicon-left_arrow slick-prev"></i>',
	responsive:
	[
	    {
	    	breakpoint: 1100, settings: {slidesToShow: 3, slidesToScroll: 3 }
	    },
		{
		   breakpoint: 800, settings: {slidesToShow: 2, slidesToScroll: 2 }
	   },
	    {
	    	breakpoint: 600, settings: {slidesToShow: 1, slidesToScroll: 1 }
	    }
	]
});
