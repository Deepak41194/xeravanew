<?php

$isStage = getenv("ENVIRONMENT");

// Redirect to HTTPS - NOTE: This only redirects if no www is present.
/*if ($isStage != true) {
  if (strpos($_SERVER['HTTP_HOST'], 'www') === false) { 
    $protocol = isset($_SERVER['HTTPS']) && filter_var($_SERVER['HTTPS'], FILTER_VALIDATE_BOOLEAN)
      ? 'https' 
      : 'https';
    header("Location: $protocol://www." . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], true, 301);
  } 
}  */


// Password protect staging
if ($isStage == "stage") {
	
	$valid_passwords = array ("USERNAME" => "PASSWORD");
	$valid_users = array_keys($valid_passwords);
	
	if (isset($_SERVER['PHP_AUTH_USER'])) {
		$user = $_SERVER['PHP_AUTH_USER'];
	} else {
		$user = "";
	}
	if (isset($_SERVER['PHP_AUTH_PW'])) {
		$pass = $_SERVER['PHP_AUTH_PW'];
	} else {
		$pass = "";
	}
	
	$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);
	
	if (!$validated) {
		header('WWW-Authenticate: Basic realm="Password Protected Area"');
		header('HTTP/1.0 401 Unauthorized');
		die ("Not authorized");
	}

}

// Removes the domain name from the URL
function getCurrentUri()	 {
	$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
	$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
	if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
	$uri = '/' . trim($uri, '/');
	return $uri;
}

$base_url = getCurrentUri();

// Set up routes array
$routes = array();
$routes = explode('/', $base_url);

// Get page to display

/* Old code for flat sites with no folders */
/*if ($routes[1] == "") {
	$pageName = "home.php";
} else {
	$pageName = $routes[1] . ".php";
}*/

/* New code for sites with a folder structure that is 1 deep */
/*
	BASIC ROUTING:
	domain.com will load pages/home.php
	domain.com/about will load pages/about/index.php
	domain.com/about/our-company will load pages/about/our-company.php
	
	ADDITIONAL INFO IN PATHS
	Anything past the third element can be passed as parameters and read on the page from the $routes variable.
	
	ex.
	domain.com/about/our-company/profile/ceo
	
	This will load /pages/about/our-company.php
	$routes[3] = "profile"
	$routes[4] = "ceo"
*/
$folderName = "";

if ($routes[1] == "") {
 $pageName = "home.php";
} else if ($routes[1] == "register.php") {
 //$folderName = "register";
  
  $pageName = "register.php";
 } 
    else if ($routes[1] == "broadcoverage.php") {
  $pageName = "broadcoverage.php";
 } 
 
   else if ($routes[1] == "diffrentiation.php") {
  $pageName = "diffrentiation.php";
 }
 
    else if ($routes[1] == "efficacy.php") {
  $pageName = "efficacy.php";
 }
 
    else if ($routes[1] == "safety.php") {
  $pageName = "efficacy.php";
 }
 
    else if ($routes[1] == "dosage.php") {
  $pageName = "dosage.php";
 }
    else if ($routes[1] == "patient.php") {
  $pageName = "patient.php";
 }
 else {
  $pageName = "index.php";
 }

$filePath =$pageName;


// Load page
if (file_exists("pages/".$filePath)) {
	include("pages/".$filePath);
} else {
	$code = 404;
	$protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
	header($protocol . ' ' . $code . ' ' . 'Not Found');
	$GLOBALS['http_response_code'] = $code;
	include("pages/404.php");
}


?>