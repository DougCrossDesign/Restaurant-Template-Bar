$('.images-slider-multi').slick({
	infinite: false,
	speed: 300,
	slidesToShow: 4,
	slidesToScroll: 4,
	arrows: false,
	dots: true,
	responsive:
	[
	    {
	    	breakpoint: 800, settings: {slidesToShow: 3, slidesToScroll: 3 }
	    },
	    {
	    	breakpoint: 600, settings: {slidesToShow: 2, slidesToScroll: 2 }
	    }
	]
});
