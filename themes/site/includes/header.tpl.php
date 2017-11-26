<?php
use Model\GlobalPageInjection;

$headers = [GlobalPageInjection::getValueByName("Header")];
if(isset($obj->header)){
	$headers[] = $obj->header;
}
$headers = implode(' ', $headers);

?>
<!--[if lte IE 9 ]>
	<p class="chromeframe center">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<!-- Header -->
<header class="header" id="header">
	<div class="wrap clearfix">
		<div class="posr">

			<!-- Branding -->
			<div id="logo">
				<a href="/"><img src="themes/site/assets/images/stumble-inn/thestumbleinn_logo.png" alt="stumble inn logo" /></a>
			</div>

			<!-- Additional Content Area -->
			<div class="nav-info no-mobile">
				<div class="nav-address">
					<li class="nav-info-location"><a href="/newsletter"><div>Subscribe</div></a></li>
				</div>
				<div class="nav-social"><?php insertPartial("fe_social_list", "default", $obj); ?></div>
			</div>

			<!-- Hamburger Button -->
			<a class="hamburger" href="/sitemap.php" title="View Navigation" data-toggle=".navmain-wrap" aria-label="Site Navigation">
				<span class="line line1"></span><span class="line line2"></span><span class="line line3"></span>
			</a>

		</div>
	</div>
</header>


<!-- Nav Wrap -->
<div class="navmain-wrap">

	<!-- Close Hamburger Button -->
	<div class="wrap-lg wrap-pad clearfix">
		<div class="posr">
			<a class="ham-close hamburger-close" href="/sitemap.php" title="View Navigation" data-toggle=".navmain-wrap" aria-label="Close site Navigation">
				<span class="line line1"></span><span class="line line2"></span><span class="line line3"></span>
			</a>
		</div>
	</div>

	<!-- primary nav -->
	<nav id="nav-main" class="vcenter2">

		<ul>
			<li><a href="/specials" title="Specials">Specials</a></li>
			<li><a href="/menu" title="Menu">Menu</a></li>
			<li><a href="/parties" title="Parties">Parties</a></li>
			<!-- <li><a href="/about" title="About">About</a></li> -->
			<li><a href="#" title="Store">Store</a></li>
			<!-- <li><a href="/gallery" title="Gallery">Gallery</a></li>
			<li><a href="/locations" title="Locations">Locations</a></li> -->
			<!-- <li><a href="/news" title="News">News</a></li> -->
			<!-- <li><a href="/newsletter" title="Newsletter Signup">Newsletter Signup</a></li> -->
			<!-- <li><a href="/faqs" title="FAQs">FAQs</a></li> -->
			<li><a href="/findus" title="Find Us">Find Us</a></li>
			<!-- <li><a href="/jointeam" title="Join Our Team">Join Our Team</a></li> -->
		</ul>

		<!-- <div class="center nav-addtl-info">
			<span>11 OCEAN AVE, BOCO RATON, FLORIDA 88421</span> <span>732-812-3654</span>
		</div>

		<div class="center nav-addtl-social">
			<?php insertPartial("fe_social_list", "default", $obj); ?>
		</div> -->


	</nav>

</div>
