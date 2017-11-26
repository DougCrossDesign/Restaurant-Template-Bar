<?php


$obj-> hero_slick = array(
	array(
		"lg" => "/themes/site/assets/images/stumble-inn/about-header.jpg",
		"md" => "/themes/site/assets/images/stumble-inn/about-header.jpg",
		"sm" => "/themes/site/assets/images/stumble-inn/about-header.jpg",
		// "title" => "About",
		// "byline" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis, urna sit amet dapibus auctor, velit diam pharetra elit, vel finibus tortor quam sed nisl.",
		"description" => "",
		"btn_text" => "",
		"btn_link" => "",
		"buy_text" => "",
		"buy_link" => ""
	),
	array(
		"lg" => "/themes/site/assets/images/stumble-inn/news-header.jpg",
		"md" => "/themes/site/assets/images/stumble-inn/news-header.jpg",
		"sm" => "/themes/site/assets/images/stumble-inn/news-header.jpg",
		// "title" => "About",
		// "byline" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis, urna sit amet dapibus auctor, velit diam pharetra elit, vel finibus tortor quam sed nisl.",
		"description" => "",
		"btn_text" => "",
		"btn_link" => "",
		"buy_text" => "",
		"buy_link" => ""
	),
	array(
		"lg" => "/themes/site/assets/images/stumble-inn/menu-header.jpg",
		"md" => "/themes/site/assets/images/stumble-inn/menu-header.jpg",
		"sm" => "/themes/site/assets/images/stumble-inn/menu-header.jpg",
		// "title" => "About",
		// "byline" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis, urna sit amet dapibus auctor, velit diam pharetra elit, vel finibus tortor quam sed nisl.",
		"description" => "",
		"btn_text" => "",
		"btn_link" => "",
		"buy_text" => "",
		"buy_link" => ""
	),

);


// Hero Slider Images (desktop, tablet, mobile)
$hslider_lg = '';
$hslider_md = '';
$hslider_sm = '';

$num = 0;

foreach ($obj-> hero_slick as $num => $slide) {
	$num = $num + 1; // start at "2" now  (First Slide Is Static Logo)
	$hslider_lg .= "\n" . '.hero-interior .slide'. $num .'{background-image: url("'. $slide['lg'] .'");}';
	$hslider_md .= "\n" . '.hero-interior .slide'. $num .'{background-image: url("'. $slide['md'] .'");}';
	$hslider_sm .= "\n" . '.hero-interior .slide'. $num .'{background-image: url("'. $slide['sm'] .'");}';
}
echo '
	<!-- Hero Slider Images -->
	<style>
		@media screen and (min-width : 1401px) { '
			. $hslider_lg .
		'}
		@media screen and (max-width : 1400px) { '
			. $hslider_md .
		'}
		@media screen and (max-width : 960px) { '
			. $hslider_sm .
		'}
	</style>
	<!--[if lte IE 8]>
		<style>'
			. $hslider_lg .
		'</style>
	<![endif]-->
';
?>
<div class="">
	<div class="hero-interior slick-slider">

		<?php foreach ($obj-> hero_slick as $num => $slide) { ?>


		<div class="slick-slide slide<?php echo $num + 1; ?>" aria-label="Homepage Slider">

				<div class="wrap clearfix hero-container">
					<div class="hero-slick-content center">

							<?php ###  Simple Text Box - Hide Row If No Entry #### ?>
							<h1 class="interior-hdr upper">About</h1>

							<?php ###  Simple Text Box - Hide Row If No Entry#### ?>
							<div class="hero-byline">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis, urna sit amet dapibus auctor, velit diam pharetra elit, vel finibus tortor quam sed nisl.</div>

							<?php ###  Simple Area Text Box - Hide Row If No Entry#### ?>
							<p class="hero-text"><?php echo $slide['description'] ?></p>

							<?php ###  Href - Btn Text - Open New Window (y/n) - Hide Row If No Entry #### ?>
							<!-- <a href="<?php echo $slide['btn_link'] ?>" class="btn2 small hero-btn"><?php echo $slide['btn_text'] ?></a> -->


							<!-- <img src="<? insertImage('hero-logo.svg') ?>" onerror="this.src='<? insertImage("hero-logo.png") ?>';this.onerror=null;" alt="Site Title" class="fluid-img" > -->

					</div>
				</div>


		</div>
		<?php } ?>
	</div>
</div>
