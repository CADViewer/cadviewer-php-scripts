<?php
	require 'CADViewer_config.php';

	$returnpathname = "";
	
	try {
		if (isset($_POST['returnpathname'])){
			$returnpathname = $_POST['returnpathname'];
		}
	} catch (Exception $e) {
	}
	

	// return path as home dir , this is the default
	if ($returnpathname == "getServerLocationFromScript" || $returnpathname == "getServerLocationFromScript_00"){
		echo  $home_dir;
		exit;
	}


	// add in any custom path... 
	if ($returnpathname == "getServerLocationFromScript_01"){
		echo  $myCustomPath01;
		exit;
	}


	// Redlines 
	if ($returnpathname == "getServerLocationFromScript_02"){
		echo  $home_dir. "/content/redlines/api_650/";
		exit;
	}
	
	// Redlines 
	if ($returnpathname == "getServerLocationFromScript_06"){
		echo  "/content/redlines/api_650/";
		exit;
	}





	// FileFolder 
	if ($returnpathname == "getServerLocationFromScript_03"){
		echo  $home_dir. "/content/drawings/dwg/";
		exit;
	}

	
	// FileFolder 
	if ($returnpathname == "getServerLocationFromScript_04"){
		echo  $httpHost . "/content/drawings/dwg/";
		exit;
	}

	// FileFolder 
	if ($returnpathname == "getServerLocationFromScript_05"){
		echo  "/content/drawings/dwg/";
		exit;
	}




	echo "noPathSpecifiedOnServer";

exit;
?>
