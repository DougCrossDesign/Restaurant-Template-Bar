	<header class="header">
		<div class="side-bar">
			<div class="nav-hamburger">
				<a class="nav-open"><span class="aycicon-hamburger icons"></span></a>
				<a class="nav-close"><span class="aycicon-close icons"></span></a>
			</div>
		</div>
		<div class="nav-wrap nav-active">
			<div class="side-shadow"></div>
			<!-- Brand -->
			<div id="logo">	
				<a href="/"><img width="270px" src="<?php insertImage('logo.png') ?>" onerror="this.src='<? insertImage("logo.png") ?>';this.onerror=null;" alt="<? print($site_title); ?>"  class="fluid-img"></a>
			</div>
			<!-- Nav Main -->
			<div>
				<nav id="nav-main">
					<ul>
						<?php
						$currentModule = Util::getCurrentCleanUrl();
						$moduleLink = str_replace("/admin/", "", $currentModule);
						foreach($obj->modules as $name => $data){
							if(is_array($data)){
								?>
								<li class="nav-menu <?php if(in_array($moduleLink, $data)) echo 'nav-active-sub '; ?>"><a href="#"><span class="aycicon-down_arrow icons"></span><?php echo $name; ?></a><ol>
								<?php
								foreach($data as $subname => $link){ ?>
									<li <?php if ($moduleLink == $link) echo ' class="current" ';?>>
										<a href="/admin/<?php echo $link; ?>" title="<?php echo $subname; ?>"><span
												class="aycicon-edit_circ icons"></span>
											<div><?php echo $subname; ?></div>
										</a>
									</li>
								<?php }
								echo '</ol></li>';
							} else {
								$link = $data;
								?>
								<li <?php if ($moduleLink == $link) echo ' class="current" ';?>>
									<a href="/admin/<?php echo $link; ?>" title="<?php echo $name; ?>"><span
											class="aycicon-enter icons"></span>
										<div><?php echo $name; ?></div>
									</a>
								</li>
								<?php }
							} ?>
						<li><a href="/admin/login/logout"><span class="aycicon-gear icons"></span>Log Out</a> </li>					
					</ul>
				</nav>
			</div>
			<div class="side-shadow2"></div>
		</div>
	</header>
