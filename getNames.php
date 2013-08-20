<?php
$name=$_GET["name"];
$gender=$_GET["gender"];
include 'language.php';
include 'db.php';
$verbindung = connectDB();
showNames($name, $gender);
closeDB($verbindung);
?>