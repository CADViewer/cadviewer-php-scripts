<?php

header("Access-Control-Allow-Origin: *");
require 'CADViewer_config.php';


$http_origin = '';

if (isset($_SERVER['HTTP_ORIGIN'])) {
  $http_origin = $_SERVER['HTTP_ORIGIN'];
}
elseif (isset($_SERVER['HTTP_REFERER'])) {
  $http_origin = $_SERVER['HTTP_REFERER'];
}

// allow CORS or control it
if (true){
    header("Access-Control-Allow-Origin: $http_origin");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
}
else{

	$allowed_domains = array(
	  'http://localhost:8080',
	  'http://localhost:8081',
	  'http://localhost',
	);

	if (in_array($http_origin, $allowed_domains))
	{
		header("Access-Control-Allow-Origin: $http_origin");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
		header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
	}	
}






$fileTag 	= $_GET['fileTag'];
$Type 		= $_GET['Type'];

$remainOnServer = 0;

try{
	$remainOnServer = $_GET['remainOnServer'];
} catch (Exception $e) {
		// none
}

if ($Type == "svg" )
	header('Content-type: image/svg+xml');

if ($Type == "svgz" ){
	header('Content-type: image/svg+xml');
	header('Content-Encoding: gzip');
}

$returnFile = $fileLocation . $fileTag . '.' . $Type;

$file_content = file_get_contents($returnFile);

echo $file_content;

if (file_exists($returnFile)){
	if ($remainOnServer==0)
		unlink($returnFile);
}

?>
