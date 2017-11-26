<?php
	/////////////////////////
	// Page Meta / Classes
	/////////////////////////
	$obj-> body_class = array(
		"page" => "pg_menu",
		"site_section" => "sct_menu",
		"layout" => ""
	);
?>

<?php insertInclude("head",$obj); ?>
<?php insertInclude("header",$obj); ?>

<main id="content-main" class="main-content" role="main">
	<div class="page-header" style="background-image:url(<? insertImage('stumble-inn/menu-header.jpg') ?>)">
		<div class="wrap-sm page-header-text clearfix">
			<h1 class="menu-header-title">Menu</h1>
			<p class="menu-header-desc center clearfix">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis, urna sit amet dapibus auctor, velit diam pharetra elit, vel finibus tortor quam sed nisl.
			</p>
		</div>
	</div>

	<!-- Tabs -->
	<section id="menu-tabs" class="tabs-area">

		<div class="menu-sct-top">
			<div class="wrap-sm wrap-pad-lg clearfix">
				<div class="tabs-nav-toggle">Select Tab</div>
				<nav class="tabs-nav">
					<ul class="btn-outline">
						<li><a href="#sct-brunch" title="Menu Brunch"><p>Brunch</p></a></li>
						<li><a href="#sct-lunch" title="Menu lunch"><p>Lunch</p></a></li>
						<li><a href="#sct-dinner" title="Menu Dinner"><p>Dinner</p></a></li>
						<li><a href="#sct-lateNight" title="Menu Late Night"><p>Late Night</p></a></li>
						<li><a href="#sct-bar" title="Menu bar"><p>Bar</p></a></li>

					</ul>
				</nav>
			</div>
		</div>

		<div class="tabs-content">


			<!-- BRUNCH EXAMPLE -->
			<article id="sct-brunch" class="tab-sct">

				<div class="wrap-sm wrap-pad-xlg clearfix">
					<?php ###  HTML Enabled Text Box - HIDE BLOCK IF EMPTY #### ?>
					<div class="entry-content menu-sct-intro center">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis scelerisque imperdiet odio, vel placerat massa. Proin et erat sed dolor aliquet scelerisque. In sollicitudin ornare felis vel posuere. Vestibulum risus magna, egestas ac egestas ornare, accumsan quis lorem. Maecenas sed tellus ipsum. Donec ac consequat urna. Fusce ultricies sit amet ipsum eu congue. Nullam odio urna, consequat ac sapien tempor.</p>
					</div>
					<?php ### Optional Buttons - if none hide entire div #### ?>
					<div class="center menu-sct-btns btm-margin-xlg">
						<a href="#pdflink" target="_blank" class="solid-btn"><p>
							Download Menu
						</p></a>
					</div>
				</div>

				<?php for ($c=0; $c < 3; $c++) { ?>

				<div class="menu-sub-sct">

					<div class="wrap-sm wrap-pad clearfix">

						<div class="menu-sub-sct-top clearfix">
							<h2 class="menu-sub-sct-hdr">Section Name</h2>
						</div>

						<!-- Entries Loop Start -->
						<div class="menu-entries col-space5 col-auto-sm clearfix">

							<?php for ($i=0; $i < 6; $i++) { ?>
							<div class="menu-entry col1-2 col eqheight">
								<div class="menu-entry-title">
									<div class="menu-entry-name">Name of item</div>
									<div class="menu-entry-price">$10.99</div>
								</div>
								<div class="menu-entry-title">
									<div class="menu-entry-name">Name of item2</div>
									<div class="menu-entry-price">$10.99</div>
								</div>
								<div class="menu-entry-text">Duis egestas nulla quis lacus efficitur imperdiet. Morbi et ipsum a enim tincidunt lacinia in sed ante. Donec a bibendum tortor. Pellentesque eu purus orci.</div>
							</div>
							<?php } ?>

						</div>
						<!-- Entries Loop END -->
					</div>
				</div>
				<!-- Section Loop END -->

				<?php // FRONTEND FOR EXAMPLE LOOP -- END
				} ?>


				<?php ###  HTML Enabled Text Box - HIDE BLOCK IF EMPTY -- NOTE THIS CONTENT IS PER TAB  #### ?>
				<div class="menu-sub-sct">
					<div class="wrap-sm wrap-pad menu-sct-out clearfix">
						<div class="entry-content center">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis scelerisque imperdiet odio, vel placerat massa. Proin et erat sed dolor aliquet scelerisque. In sollicitudin ornare felis vel posuere. Vestibulum risus magna, egestas ac egestas ornare, accumsan quis lorem.</p>
						</div>
					</div>
				</div>


			</article>
			<!-- BRUNCH EXAMPLE -->


			<!-- Lunch EXAMPLE -->
			<article id="sct-lunch" class="tab-sct">

				<div class="wrap-sm wrap-pad clearfix">
					<?php ###  HTML Enabled Text Box - HIDE BLOCK IF EMPTY #### ?>
					<div class="entry-content menu-sct-intro center">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis scelerisque imperdiet odio, vel placerat massa. Proin et erat sed dolor aliquet scelerisque. In sollicitudin ornare felis vel posuere. Vestibulum risus magna, egestas ac egestas ornare, accumsan quis lorem. Maecenas sed tellus ipsum. Donec ac consequat urna. Fusce ultricies sit amet ipsum eu congue. Nullam odio urna, consequat ac sapien tempor.</p>
					</div>
					<?php ### Optional Buttons - if none hide entire div #### ?>
					<div class="center menu-sct-btns btm-margin-xlg">
						<a href="#pdflink" target="_blank" class="solid-btn" title="Download">Download Menu</a>
					</div>
				</div>

				<?php for ($c=0; $c < 3; $c++) { ?>

				<div class="menu-sub-sct">

					<div class="wrap-sm wrap-pad clearfix">

						<div class="menu-sub-sct-top clearfix">
							<h2 class="menu-sub-sct-hdr">Section Name</h2>
						</div>

						<!-- Entries Loop Start -->
						<div class="menu-entries col-space5 col-auto-sm clearfix">

							<?php // FRONTEND FOR EXAMPLE LOOP -- REPLACE
								for ($i=0; $i < 6; $i++) {
							?>
							<div class="menu-entry col1-2 col eqheight">
								<div class="menu-entry-title">
									<div class="menu-entry-name">Name of item</div>
									<div class="menu-entry-price">$10.99</div>
								</div>
								<div class="menu-entry-text">Duis egestas nulla quis lacus efficitur imperdiet. Morbi et ipsum a enim tincidunt lacinia in sed ante. Donec a bibendum tortor. Pellentesque eu purus orci.</div>
							</div>
							<?php // FRONTEND FOR EXAMPLE LOOP -- END
							} ?>

						</div>
						<!-- Entries Loop END -->
					</div>
				</div>
				<!-- Section Loop END -->

				<?php // FRONTEND FOR EXAMPLE LOOP -- END
				} ?>


				<?php ###  HTML Enabled Text Box - HIDE BLOCK IF EMPTY -- NOTE THIS CONTENT IS PER TAB  #### ?>
				<div class="menu-sub-sct">
					<div class="wrap-sm wrap-pad menu-sct-out clearfix">
						<div class="entry-content center">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis scelerisque imperdiet odio, vel placerat massa. Proin et erat sed dolor aliquet scelerisque. In sollicitudin ornare felis vel posuere. Vestibulum risus magna, egestas ac egestas ornare, accumsan quis lorem.</p>
						</div>
					</div>
				</div>


			</article>
			<!-- Lunch EXAMPLE -->
			<!-- Dinner -->
			<article id="sct-dinner" class="tab-sct">

				<div class="wrap-sm wrap-pad clearfix">
					<?php ###  HTML Enabled Text Box - HIDE BLOCK IF EMPTY #### ?>
					<div class="entry-content menu-sct-intro center">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis scelerisque imperdiet odio, vel placerat massa. Proin et erat sed dolor aliquet scelerisque. In sollicitudin ornare felis vel posuere. Vestibulum risus magna, egestas ac egestas ornare, accumsan quis lorem. Maecenas sed tellus ipsum. Donec ac consequat urna. Fusce ultricies sit amet ipsum eu congue. Nullam odio urna, consequat ac sapien tempor.</p>
					</div>
					<?php ### Optional Buttons - if none hide entire div #### ?>
					<div class="center menu-sct-btns btm-margin-xlg">
						<a href="#pdflink" target="_blank" class="solid-btn">Download Menu</a>
					</div>
				</div>

				<?php for ($c=0; $c < 3; $c++) { ?>

				<div class="menu-sub-sct">

					<div class="wrap-sm wrap-pad clearfix">

						<div class="menu-sub-sct-top clearfix">
							<h2 class="menu-sub-sct-hdr">Section Name</h2>
						</div>

						<!-- Entries Loop Start -->
						<div class="menu-entries col-space5 col-auto-sm clearfix">

							<?php for ($i=0; $i < 6; $i++) { ?>
							<div class="menu-entry col1-2 col eqheight">
								<div class="menu-entry-title">
									<div class="menu-entry-name">Name of item</div>
									<div class="menu-entry-price">$10.99</div>
								</div>
								<div class="menu-entry-title">
									<div class="menu-entry-name">Name of item2</div>
									<div class="menu-entry-price">$10.99</div>
								</div>
								<div class="menu-entry-text">Duis egestas nulla quis lacus efficitur imperdiet. Morbi et ipsum a enim tincidunt lacinia in sed ante. Donec a bibendum tortor. Pellentesque eu purus orci.</div>
							</div>
							<?php } ?>

						</div>
						<!-- Entries Loop END -->
					</div>
				</div>
				<!-- Section Loop END -->

				<?php // FRONTEND FOR EXAMPLE LOOP -- END
				} ?>


				<?php ###  HTML Enabled Text Box - HIDE BLOCK IF EMPTY -- NOTE THIS CONTENT IS PER TAB  #### ?>
				<div class="menu-sub-sct">
					<div class="wrap-sm wrap-pad menu-sct-out clearfix">
						<div class="entry-content center">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis scelerisque imperdiet odio, vel placerat massa. Proin et erat sed dolor aliquet scelerisque. In sollicitudin ornare felis vel posuere. Vestibulum risus magna, egestas ac egestas ornare, accumsan quis lorem.</p>
						</div>
					</div>
				</div>


			</article>

			<!-- Late night -->
			<article id="sct-lateNight" class="tab-sct">

				<div class="wrap-sm wrap-pad clearfix">
					<?php ###  HTML Enabled Text Box - HIDE BLOCK IF EMPTY #### ?>
					<div class="entry-content menu-sct-intro center">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis scelerisque imperdiet odio, vel placerat massa. Proin et erat sed dolor aliquet scelerisque. In sollicitudin ornare felis vel posuere. Vestibulum risus magna, egestas ac egestas ornare, accumsan quis lorem. Maecenas sed tellus ipsum. Donec ac consequat urna. Fusce ultricies sit amet ipsum eu congue. Nullam odio urna, consequat ac sapien tempor.</p>
					</div>
					<?php ### Optional Buttons - if none hide entire div #### ?>
					<div class="center menu-sct-btns btm-margin-xlg">
						<a href="#pdflink" target="_blank" class="solid-btn">Download Menu</a>
					</div>
				</div>

				<?php for ($c=0; $c < 3; $c++) { ?>

				<div class="menu-sub-sct">

					<div class="wrap-sm wrap-pad clearfix">

						<div class="menu-sub-sct-top clearfix">
							<h2 class="menu-sub-sct-hdr">Section Name</h2>
						</div>

						<!-- Entries Loop Start -->
						<div class="menu-entries col-space5 col-auto-sm clearfix">

							<?php for ($i=0; $i < 6; $i++) { ?>
							<div class="menu-entry col1-2 col eqheight">
								<div class="menu-entry-title">
									<div class="menu-entry-name">Name of item</div>
									<div class="menu-entry-price">$10.99</div>
								</div>
								<div class="menu-entry-title">
									<div class="menu-entry-name">Name of item2</div>
									<div class="menu-entry-price">$10.99</div>
								</div>
								<div class="menu-entry-text">Duis egestas nulla quis lacus efficitur imperdiet. Morbi et ipsum a enim tincidunt lacinia in sed ante. Donec a bibendum tortor. Pellentesque eu purus orci.</div>
							</div>
							<?php } ?>

						</div>
						<!-- Entries Loop END -->
					</div>
				</div>
				<!-- Section Loop END -->

				<?php // FRONTEND FOR EXAMPLE LOOP -- END
				} ?>


				<?php ###  HTML Enabled Text Box - HIDE BLOCK IF EMPTY -- NOTE THIS CONTENT IS PER TAB  #### ?>
				<div class="menu-sub-sct">
					<div class="wrap-sm wrap-pad menu-sct-out clearfix">
						<div class="entry-content center">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis scelerisque imperdiet odio, vel placerat massa. Proin et erat sed dolor aliquet scelerisque. In sollicitudin ornare felis vel posuere. Vestibulum risus magna, egestas ac egestas ornare, accumsan quis lorem.</p>
						</div>
					</div>
				</div>


			</article>

			<!-- Bar -->

			<article id="sct-bar" class="tab-sct">

				<div class="wrap-sm wrap-pad clearfix">
					<?php ###  HTML Enabled Text Box - HIDE BLOCK IF EMPTY #### ?>
					<div class="entry-content menu-sct-intro center">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis scelerisque imperdiet odio, vel placerat massa. Proin et erat sed dolor aliquet scelerisque. In sollicitudin ornare felis vel posuere. Vestibulum risus magna, egestas ac egestas ornare, accumsan quis lorem. Maecenas sed tellus ipsum. Donec ac consequat urna. Fusce ultricies sit amet ipsum eu congue. Nullam odio urna, consequat ac sapien tempor.</p>
					</div>
					<?php ### Optional Buttons - if none hide entire div #### ?>
					<div class="center menu-sct-btns btm-margin-xlg">
						<a href="#pdflink" target="_blank" class="solid-btn">Download Menu</a>
					</div>
				</div>

				<?php for ($c=0; $c < 3; $c++) { ?>

				<div class="menu-sub-sct">

					<div class="wrap-sm wrap-pad clearfix">

						<div class="menu-sub-sct-top clearfix">
							<h2 class="menu-sub-sct-hdr">Section Name</h2>
						</div>

						<!-- Entries Loop Start -->
						<div class="menu-entries col-space5 col-auto-sm clearfix">

							<?php for ($i=0; $i < 6; $i++) { ?>
							<div class="menu-entry col1-2 col eqheight">
								<div class="menu-entry-title">
									<div class="menu-entry-name">Name of item</div>
									<div class="menu-entry-price">$10.99</div>
								</div>
								<div class="menu-entry-title">
									<div class="menu-entry-name">Name of item2</div>
									<div class="menu-entry-price">$10.99</div>
								</div>
								<div class="menu-entry-text">Duis egestas nulla quis lacus efficitur imperdiet. Morbi et ipsum a enim tincidunt lacinia in sed ante. Donec a bibendum tortor. Pellentesque eu purus orci.</div>
							</div>
							<?php } ?>

						</div>
						<!-- Entries Loop END -->
					</div>
				</div>
				<!-- Section Loop END -->

				<?php // FRONTEND FOR EXAMPLE LOOP -- END
				} ?>


				<?php ###  HTML Enabled Text Box - HIDE BLOCK IF EMPTY -- NOTE THIS CONTENT IS PER TAB  #### ?>
				<div class="menu-sub-sct">
					<div class="wrap-sm wrap-pad menu-sct-out clearfix">
						<div class="entry-content center">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis scelerisque imperdiet odio, vel placerat massa. Proin et erat sed dolor aliquet scelerisque. In sollicitudin ornare felis vel posuere. Vestibulum risus magna, egestas ac egestas ornare, accumsan quis lorem.</p>
						</div>
					</div>
				</div>


			</article>


		</section><!-- END #tabs1 -->



	</div>



</main>

<?php insertInclude("footer",$obj); ?>

<!-- Page Specific JS -->
<script>
	$(function(){
		$(window).on('load', function(){
			$("#menu-tabs").myTabs();
		});
	});
</script>
<!-- /Page Specific JS -->

<?php insertInclude("footerclose"); ?>
