<?php

// Configuration file for CADViewer Community and CADViewer Enterprise version and standard settings
require 'CADViewer_config.php';

$http_origin = '';

if (isset($_SERVER['HTTP_ORIGIN'])) {
  $http_origin = $_SERVER['HTTP_ORIGIN'];
}
elseif (isset($_SERVER['HTTP_REFERER'])) {
  $http_origin = $_SERVER['HTTP_REFERER'];
}

$allowed_domains = array(
  'http://localhost:8080',
  'http://localhost',
);

if (in_array($http_origin, $allowed_domains))
{
    header("Access-Control-Allow-Origin: $http_origin");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
}

$fullPath = "";
$loadtype = "";

if (!empty($_GET)) {
	if (isset($_GET['file'])) {
		$fullPath = $_GET['file'];
	}
}
else{
    // no data passed by get
	if (isset($_POST['file'])) {
		$fullPath = $_POST['file'];
	}
}


if (!empty($_GET)) {
	if (isset($_GET['loadtype'])) {
		$loadtype = $_GET['loadtype'];
	}
}
else{
    // no data passed by get
	if (isset($_POST['loadtype'])) {
		$loadtype = $_POST['loadtype'];
	}
}

// echo "XX" . $loadtype ."    languagefile";

// load languages app dir
if ( $loadtype == "languagefile"){
	$fullPath = $home_dir_app . $fullPath;
}

// menu file app dir
if ( $loadtype == "menufile"){
	$fullPath = $home_dir_app . $fullPath;
}

// home dir . for server location
if ( $loadtype == "serverfilelist"){
	$fullPath = $home_dir . $fullPath;
}


//echo $fullPath;

$contents = '';

$fp = "";

if ($fd = fopen ($fullPath, "rb")) {
    while(!feof($fd)) {
//        $buffer = fread($fd, 2048);
//        echo $buffer;
    	$contents .= fread($fd, 8192);
    }
	fclose ($fd);

}
else{
	echo "cannot open the file " . $fullPath;
}

echo $contents;

exit;

?>