<!-- Footer -->


<footer class="footer">
	<div class="clearfix">
		<div id="footer-info" class="col-pad-sm clearfix">
			<!-- <div class="col eqheight">Proud Partners of the</div> -->
			<img src="themes/site/assets/images/stumble-inn/NYCHA-logo.png" alt="NYCHA logo" />
		</div>
		<div class="col-space0 col-pad-xlg footer-location-info clearfix">
			<div class="col col1-2 eqheight footer-address">
				<div class="footer-address-outline">
					<p><span>1454 2<sup>ND</sup> Avenue,</span></br>New York, NY 10021</br>Corner of 76th Street</p>
				</div>

			</div>
			<div class="col col1-2 eqheight footer-contact">
				<p>212.650.0561</p>
				<p class="footer-contact-email">thestumbleinn@nycbestbars.com</p>
			</div>
		</div>
		<div class="footer-other-locations">
			<div class="wrap-sm">
				<div class="auto-4-2 col-space2 col-pad-md col-vsp-sm clearfix">
					<?php // FRONTEND FOR EXAMPLE LOOP -- REPLACE
						for ($i=0; $i < 8; $i++) {
					?>
						<div class="col1-4 col">
							<div><strong>Location Name</strong></div>
							<div>Street Address, State ZIP	</div>
							<div>Intersection Address</div>
						</div>
					<?php // FRONTEND FOR EXAMPLE LOOP -- END
					} ?>
				</div>
			</div>
		</div>
		<div class="footer-end">
			<div class="footer-logo"><img src="themes/site/assets/images/stumble-inn/stumbleinn-logo-vertical.png" alt="stumble inn logo" /></div>
				<div class="footer-creds-social col-space0 clearfix">
					<div class="footer-divider wrap clearfix">
						<div class="footer-creds-ayc col col1-2">
							<p>Design &amp; Developed by AYC Media</p>
						</div>
						<div class="col col1-2 footer-social">
							<?php insertPartial("fe_social_list", "default", $obj); ?>
						</div>
					</div>
				</div>
				<div class="footer-creds-nav col-space0 clearfix">
					<div class="wrap clearfix">
						<div class="footer-creds-copy col col1-2">
							<p>&copy; 2017 the stumble inn &nbsp; All rights reserved.</p>
						</div>
						<div class="footer-nav col col1-2">
							<ul>
								<li><a href="/" title="Home">Home </a></li>
								<li><a href="/about" title="About">About </a></li>
								<li><a href="/specials" title="Specials">Specials </a></li>
								<li><a href="/menu" title="Menu">Menus </a></li>
								<li><a href="/parties" title="Parties">Parties </a></li>
								<li><a href="/findus" title="Find Us">Find Us </a></li>
								<li><a href="/sports" title="Sport">Sports</a></li>
								<li><a href="#" title="Store">Store </a></li>
								<li><a href="/newsletter" title="Newsletter">Newsletter </a></li>
								<li><a href="/news" title="News">News </a></li>
								<li><a href="/ada-accessibility" title="ADA Accessibility">Accessibility</a></li>
								<li><a href="/termsconditions" title="Terms &amp; Conditions">Terms &amp; Conditions</a></li>
								<li><a href="/privacy" title="Privacy Policy">Privacy Policy</a></li>

								<!-- <li><a href="/jointeam" title="Join Our Team">Join Our Team </a></li> -->
							</ul>
						</div>
					</div>

				</div>

		</div>


	</div>
</footer>

<!-- Load Scripts -->
<script src="/<?php print($theme_dir.'/assets/scripts.js'); ?>"></script>
<?php echo isset($obj->global->trackinginsert) ? $obj->global->trackinginsert : "" ; ?>
<?php echo isset($obj->trackinginsert) ? $obj->trackinginsert : "" ; ?>
