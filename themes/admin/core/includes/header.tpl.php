<?php
function getNameWithIcon($name){
    $icons = [
            "Admin Tools" => "wrench",
            "Advanced Settings" => "cogs",
            "Navigation" => "map-signs",
            "Settings" => "gear",
            "Site Content" => "pencil-square-o",
    ];
    $icon = array_key_exists($name, $icons) ? '<i class="fa fa-'. $icons[$name] .'"></i>&nbsp;&nbsp;' : '';
    return $icon . $name;
}

/**
 * @param $currentLink      string
 * @param $children         ModuleMenuItem[]
 * @return bool
 *
 */
function childrenContainLink($currentLink, $children){
    foreach($children as $child){
        if($child->url == $currentLink) return true;
    }
    return false;
}
$modules = $obj->modules;
?>

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
				<a href="/"><img width="270px" src="/themes/site/assets/images/logo.png" onerror="this.src='/themes/site/assets/images/logo.png';this.onerror=null;" alt="<? print($site_title); ?>"  class="fluid-img"></a>
			</div>
			<!-- Nav Main -->
			<div>
				<nav id="nav-main">
					<ul>
						<?php
						$currentModule = Util::getCurrentCleanUrl();
						$moduleLink = str_replace("/admin/", "", $currentModule);
						/**
                         * @var string $name
                         */
                        foreach($modules as $name => $data){
							if(is_array($data)){
							    /** @var ModuleMenuItem[] $data */
								?>
								<li class="nav-menu <?php if(childrenContainLink($moduleLink, $data)) echo 'nav-active-sub '; ?>"><a href="#"><?php echo getNameWithIcon($name); ?>
                                        <span class="aycicon-down_arrow icons"></span>
                                        <span class="aycicon-up_arrow icons"></span>
                                    </a><ol>
								<?php
                                /**
                                 * @var string $subname
                                 * @var ModuleMenuItem $item
                                 */
                                foreach($data as $subname => $item){ ?>
									<li <?php if ($moduleLink == $item->url) echo ' class="current" ';?>>
										<a href="/admin/<?php echo $item->url; ?>" title="<?php echo $subname; ?>">
											<div>
                                                <i class="fa fa-<?php echo $item->icon; ?>" style="color: gray;"></i>&nbsp;&nbsp;
                                                <?php echo $subname; ?>
                                            </div>
										</a>
									</li>
								<?php }
								echo '</ol></li>';
							} else {
							    /** @var ModuleMenuItem $data */
								?>
								<li <?php if ($moduleLink == $data->url) echo ' class="current" ';?>>
									<a href="/admin/<?php echo $data->url; ?>" title="<?php echo $name; ?>"><span
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
