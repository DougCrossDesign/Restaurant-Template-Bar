<?php
	///////////////////////////////////
	//Site General Functions
	///////////////////////////////////

	/** Inserts a Partial (Module) in to a page */
	function insertPartial($partialName, $layoutName = "default", $obj = null, $wrap = null){
		extract($GLOBALS);
		$partialName = strtolower($partialName);
		$file = TEMPLATE_DIR . '/' . config()->theme . "/partials/".$partialName."/".$layoutName.".tpl.php";
		if(isDebug()){
			print ("<div class='debug-file-partial'>".$file."</div>");
		}
		include($file);	
	}

	/** Inserts a Include (Page Parts) in to a page */
	function insertInclude($includeName, $obj = null){
		extract($GLOBALS);
		$includeName = strtolower($includeName);
		$file = TEMPLATE_DIR . '/' . config()->theme . "/includes/".$includeName.".tpl.php";
		if(isDebug()){
			print ("<div class='debug-file-include'>".$file."</div>");
		}
		include($file);	
	}

	/** Displays the Page */
	function insertPage($pageName, $obj = null){
		extract($GLOBALS);
		$pageName = strtolower($pageName);
		$file = TEMPLATE_DIR . '/' . config()->theme . "/pages/".$pageName.".tpl.php";
		if(isDebug()){
			print ("<div class='debug-file-page'>".$file."</div>");
		}
		include($file);
	}

	/** Echo's Image Filename w/ directory */
	function insertImage($fileName){
		extract($GLOBALS);
		echo '/themes/' . config()->theme . '/assets/images/' . $fileName;
	}

	function isDebug(){
		return(isset($_GET["debug"]));
	}

?>