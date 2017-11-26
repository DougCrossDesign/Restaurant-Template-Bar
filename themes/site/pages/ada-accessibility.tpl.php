<?php
	/////////////////////////
	// Page Meta / Classes
	/////////////////////////
	$obj-> body_class = array(
		"page" => "pg_ada",
		"site_section" => "sct_ada",
		"layout" => ""
	);

?>

<?php insertInclude("head",$obj); ?>
<?php insertInclude("header",$obj); ?>

<main id="content-main" class="main-content" role="main">
	<div class="page-header-small" style="background-image:url(<? insertImage('stumble-inn/thank-you-header.jpg') ?>)">
		<div class="wrap-sm page-header-text clearfix">
			<h1 class="ada-header-title">ADA Accessibility</h1>
		</div>
	</div>
	<div class="page-content bg6 c1">
		<div class="wrap-sm clearfix">

			<center class="wrap ada-content">
				<h2 class="hdr2">Website Accessibility Policy</h2>
					<p>To make its websites accessible to users who have disabilities, Client Name has undertaken initiatives to expand access and to assist content providers, many of whom have independent obligations under accessibility laws, with providing content in accessible formats. To meet this goal, Monarch is implementing the following initiatives:</p>
					<ul class="clearfix">
						<li>Appointing a website accessibility coordinator who is responsible for developing accessibility practices and ensuring accessibility compliance.</li>
						<li>Evaluating our websites for compliance with Web Content Accessibility Guidelines 2.0 AA (“WCAG”), published by the World Wide Web Consortium. (“W3C”)</li>
						<li>Modifying the content in our websites to comply with WCAG where practical.</li>
						<li>Ensuring that our websites do not interfere with the posting of content in formats that conform to WCAG.</li>
						<li>Communicating this policy to company content providers and website content/technical support personnel.</li>
						<li>Linking to this policy from the www.url.com homepage to provide a method to contact the company’s website accessibility coordinator to submit requests and feedback.</li>
						<li>Modifying policies to prioritize accessibility bug fixes to ensure they are remedied with the same level of priority as any other equivalent loss of function for individuals without disabilities.</li>
						<li>Retaining website accessibility consultants responsible for conducting annual website accessibility evaluations of our websites.</li>
						<li>Providing training to company website content and technical support personnel on ensuring our websites conform to WCAG.</li>
					</ul>
					<p>Please direct questions or suggestions to: info@test.com.</p>
				</p>
			</center>
		</div>
	</div>
</main>

<?php insertInclude("footer",$obj); ?>

<!-- Page Specific JS -->
<script>
	$(function(){

	});
</script>
<!-- /Page Specific JS -->

<?php insertInclude("footerclose"); ?>
