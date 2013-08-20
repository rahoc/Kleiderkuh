<?php
$gender=$_GET["gender"];
$brand=$_GET["brand"];
$type=$_GET["type"];
include 'language.php';
include 'db.php';
$verbindung = connectDB();
showSizeNames($gender, $brand, $type);
closeDB($verbindung);
?>