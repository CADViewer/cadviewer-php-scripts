<?php

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



$pdf_file = "";
$pdf_file_name = "";
$from_name = "";
$from_mail = "";
$cc_mail = "";
$replyto = "";
$to_mail = "";
$mail_title = "";
$mail_message = "";
$listtype = "";



if (!empty($_GET)) {
	$pdf_file = $_GET['pdf_file'] ?? '';
	$pdf_file_name = $_GET['pdf_file_name'] ?? '';
	$from_name = $_GET['from_name'] ?? '';
	$from_mail = $_GET['from_mail'] ?? '';
	$cc_mail = $_GET['cc_mail'] ?? '';
	$replyto = $_GET['replyto'] ?? '';
	$to_mail = $_GET['to_mail'] ?? '';
	$mail_title = $_GET['mail_title'] ?? '';
	$mail_message = $_GET['mail_message'] ?? '';
	$listtype = $_GET['listtype'] ?? '';
}
else{
	$pdf_file = $_POST['pdf_file'] ?? '';
	$pdf_file_name = $_POST['pdf_file_name'] ?? '';
	$from_name = $_POST['from_name'] ?? '';
	$from_mail = $_POST['from_mail'] ?? '';
	$cc_mail = $_POST['cc_mail'] ?? '';
	$replyto = $_POST['replyto'] ?? '';
	$to_mail = $_POST['to_mail'] ?? '';
	$mail_title = $_POST['mail_title'] ?? '';
	$mail_message = $_POST['mail_message'] ?? '';
	$listtype = $_POST['listtype'] ?? '';
}


$email  = $to_mail; 
$title   = $mail_title; 
$message = $mail_message; 
//echo $email;

// we user a server side path 
if ($listtype == "serverfolder"){
	$pdf_file = $home_dir . $pdf_file;
}


$file = $pdf_file;
// Same as load-file.php: with no parameters $file is empty and
// file_get_contents() raises "Path must not be empty" (ValueError since
// PHP 8) -> 500. A request without an attachment path or a recipient is
// malformed, so answer 400 instead of crashing.
if ($file === "" || $email === "") {
	http_response_code(400);
	header('Content-Type: text/plain; charset=UTF-8');
	echo "missing required parameters: pdf_file, to_mail";
	exit;
}

$content = file_get_contents( $file);
$content = chunk_split(base64_encode($content));
$uid = md5(uniqid(time()));
$name = basename($file);

$filename = $name;

// header
$header = "From: ".$from_name." <".$from_mail.">\r\n";
$header .= "Cc: ".$cc_mail." \r\n";
$header .= "Reply-To: ".$replyto."\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";

// message & attachment
$nmessage = "--".$uid."\r\n";
$nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
$nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$nmessage .= $message."\r\n\r\n";
$nmessage .= "--".$uid."\r\n";
$nmessage .= "Content-Type: application/octet-stream; name=\"".$pdf_file_name."\"\r\n";
$nmessage .= "Content-Transfer-Encoding: base64\r\n";
$nmessage .= "Content-Disposition: attachment; filename=\"".$pdf_file_name."\"\r\n\r\n";
$nmessage .= $content."\r\n\r\n";
$nmessage .= "--".$uid."--";

if (mail($email, $title, $nmessage, $header)) {
	echo "4: true: mail";
    return true; // Or do something here
} else {
	echo "3: false: mail";
  return false;
}

// exit command
//echo $contents;

exit;

?>