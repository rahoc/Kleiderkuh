<?php
session_start();

if (isset($_GET["language"])) {
	$_SESSION["language"] = $_GET["language"];
}
$language = $_SESSION["language"];

if ( $language == "en" ) {
	include 'language_en.php';
}
else {
	include 'language_de.php';
}


?>