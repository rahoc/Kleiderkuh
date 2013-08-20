<?php

require_once("DhlRetoure.php");
require_once("Transaction.php");

$surname = $_POST["fname"];
$familyname = $_POST["lname"];
$street = $_POST["street"];
$streetNumber = $_POST["streetNr"];
$zip = $_POST["plz"];
$city = $_POST["city"];
$id = $_POST["id"];

// store information
if ($id > 0) {
$t = new Transaction;
$t->loadById($id);
$t->fname = $surname;
$t->lname = $familyname;
$t->street = $street;
$t->streetNr = $streetNumber;
$t->plz = $zip;
$t->city = $city;
$t->save();
}

$dhlRetoure = new DhlRetoure();
$pdf  = $dhlRetoure->getBase64Pdf($surname, $familyname, $street, $streetNumber, $zip, $city, $id);
if($pdf){
	//$dhlRetoure->displayPdf($pdf);$
	echo $pdf;
}

?>