<?php
// only PHP >= 5.4, actual server just supports 5.3
//if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();


if (isset($_GET["language"])) {
	$_SESSION["language"] = $_GET["language"];
}
if (isset($_SESSION["language"])) {
    $language = $_SESSION["language"];
}
else {
    $language = "de";
}

if ( $language == "en" ) {
	include 'language_en.php';
}
else {
	include 'language_de.php';
}


?>