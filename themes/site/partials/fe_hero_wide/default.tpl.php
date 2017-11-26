<?php


$obj-> hero_slick = array(
	array(
		"lg" => "/themes/site/assets/images/stumble-inn/Home-Slider.jpg",
		"md" => "/themes/site/assets/images/stumble-inn/Home-Slider.jpg",
		"sm" => "/themes/site/assets/images/stumble-inn/Home-Slider.jpg",
		"title" => "Eat. <br/> Drink. <br/> <span class='stumble'>Stumble.</span>",
		"byline" => "",
		"description" => "",
		"btn_text" => "",
		"btn_link" => "",
		"buy_text" => "",
		"buy_link" => ""
	),
	array(
		"lg" => "/themes/site/assets/images/stumble-inn/Home-Slider.jpg",
		"md" => "/themes/site/assets/images/stumble-inn/Home-Slider.jpg",
		"sm" => "/themes/site/assets/images/stumble-inn/Home-Slider.jpg",
		"title" => "Headline Here",
		"byline" => "Subheadline goes here or description, Event or special information",
		"description" => "",
		"btn_text" => "",
		"btn_link" => "",
		"buy_text" => "",
		"buy_link" => ""
	),
	array(
		"lg" => "/themes/site/assets/images/stumble-inn/Home-Slider.jpg",
		"md" => "/themes/site/assets/images/stumble-inn/Home-Slider.jpg",
		"sm" => "/themes/site/assets/images/stumble-inn/Home-Slider.jpg",
		"title" => "Eat. <br/> Drink. <br/> <span class='stumble'>Stumble.</span>",
		"byline" => "",
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
	$hslider_lg .= "\n" . '.hero-wide .slide'. $num .'{background-image: url("'. $slide['lg'] .'");}';
	$hslider_md .= "\n" . '.hero-wide .slide'. $num .'{background-image: url("'. $slide['md'] .'");}';
	$hslider_sm .= "\n" . '.hero-wide .slide'. $num .'{background-image: url("'. $slide['sm'] .'");}';
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
	<div class="hero-wide slick-slider">

		<?php foreach ($obj-> hero_slick as $num => $slide) { ?>


		<div class="slick-slide slide<?php echo $num + 1; ?>" aria-label="Homepage Slider">

				<div class="wrap clearfix hero-container">
					<div class="hero-slick-content float">

							<?php ###  Simple Text Box - Hide Row If No Entry #### ?>
							<h1 class="hero-hdr upper"><?php echo $slide['title'] ?></h1>

							<?php ###  Simple Text Box - Hide Row If No Entry#### ?>
							<div class="hero-byline"><?php echo $slide['byline'] ?></div>

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
