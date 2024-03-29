<?php
// Don't display, but log all errors
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__).'/../error-log.txt');
error_reporting(-1);

// Set our default timezone and supress warning with @
@date_default_timezone_set(date_default_timezone_get());

// Set a stream context timeout for file reading
$context = stream_context_create(array('http'=>
	array(
		'timeout' => 60 // secs
	)
));

// Set our security related headers, none activated
// header("frame-options: SAMEORIGIN");
// header("XSS-Protection: 1; mode=block");

// Start a session if we haven't already
if(!isset($_SESSION)) {@session_start();}

// Logout if that's the action we're taking
if (isset($_GET['logout'])) {
	include(dirname(__FILE__)."/../processes/on-user-logout.php");
	$_SESSION['loggedIn']=false;
	$_SESSION['username']=false;
	session_destroy();
	header("Location: dirname(__FILE__)./?loggedOut");
}

// If magic quotes are still on (attempted to switch off in php.ini)
if (get_magic_quotes_gpc ()) {
	function stripslashes_deep($value) {
		$value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
		return $value;
	}
	$_POST = (isset($_POST) && !empty($_POST)) ? array_map('stripslashes_deep', $_POST) : array();
	$_GET = (isset($_GET) && !empty($_GET)) ? array_map('stripslashes_deep', $_GET) : array();
	$_COOKIE = (isset($_COOKIE) && !empty($_COOKIE)) ? array_map('stripslashes_deep', $_COOKIE) : array();
	$_REQUEST = (isset($_REQUEST) && !empty($_REQUEST)) ? array_map('stripslashes_deep', $_REQUEST) : array();
}

// Function to handle salted hashing
define('SALT_LENGTH',12);
function generateHash($plainText,$salt=null) {
	if ($salt === null) {
		$salt = substr(md5(uniqid(rand(), true)),0,SALT_LENGTH);
	} else {
		$salt = substr($salt,0,SALT_LENGTH);
	}
	return $salt.sha1($salt.$plainText);
}

// returns converted entities which have HTML entity equivalents
function strClean($var) {
	return htmlentities($var, ENT_QUOTES, "UTF-8");
}

// returns a number, whole or decimal or null
function numClean($var) {
	return is_numeric($var) ? floatval($var) : false;
}

// returns a UTF8 based string with any UFT8 BOM removed
function toUTF8noBOM($string,$message) {
	// Attempt to detect encoding
	if (function_exists('mb_detect_encoding')) {
		$encType = mb_detect_encoding($string);
		// Get rid of any UTF-8 BOM
		$string = preg_replace('/\x{EF}\x{BB}\x{BF}/','',$string);
		// Test for any bad characters
		$teststring = $string;
		$teststringBroken = utf8_decode($teststring);
		$teststringConverted = iconv("UTF-8", "UTF-8//IGNORE", $teststringBroken);
		// If we have a matching length, UTF8 encode it
		if ($encType != "ASCII" && $encType != "UTF-8" && strlen($teststringConverted) == strlen($teststringBroken)) {
			$string = utf8_encode($string);
			if ($message) {
				echo "top.ICEcoder.message('Your document doesn\'t appear to be in UTF-8 encoding so has been converted.');";
			}
		}
	}
	return $string;
}
?>