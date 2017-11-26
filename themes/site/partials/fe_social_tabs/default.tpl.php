<!-- Tabs -->
<div class="social-tabs">
	<div id="social-tabs" class="tabs-area">

		<nav class="tabs-nav">
			<ul>
				<li><a href="#sct-tab1" title="Tab 1" aria-label="Facebook Post"><span class="aycicon-facebook icon"></span></a></li>

				<li><a href="#sct-tab2" title="Tab 2" aria-label="Twitter Post"><span class="aycicon-twitter icon"></span></a></li>
			</ul>
		</nav>

		<div class="tabs-content">

			<!-- Tab 2 -->
			<article id="sct-tab1" class="tab-sct">
				<div class="facebook-feed">
					<div><a href="#fb" class="facebook-account">@FacebookLink</a></div>
					<?php
					$aycsocurl = "http://www.socialassets.aycmedia.com/api/facebook.php?user=1&count=1";
					$aycsoccontent = file_get_contents($aycsocurl);
					$aycsoccontent = mb_convert_encoding($aycsoccontent, 'HTML-ENTITIES', "UTF-8");
					echo($aycsoccontent);
					?>
					<br>
				</div>
			</article>
			<!-- Tab 1 -->
			<article id="sct-tab2" class="tab-sct">
				<div class="twitter-feed">
					<div><a href="#twit" class="twitter-account">@TwitterAccount</a></div>
					<?php
					$aycsocurl = "http://www.socialassets.aycmedia.com/api/twitter.php?user=1&count=1";
					$aycsoccontent = file_get_contents($aycsocurl);
					$aycsoccontent = mb_convert_encoding($aycsoccontent, 'HTML-ENTITIES', "UTF-8");
					echo($aycsoccontent);
					?>
					<br>
				</div>
			</article>
		</div>

	</div><!-- END #tabs1 -->
</div>
