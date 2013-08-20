<?php

require_once("DhlRetoure.php");
require_once("Transaction.php");

$surname = $_GET["fname"];
$familyname = $_GET["lname"];
$street = $_GET["street"];
$streetNumber = $_GET["streetNr"];
$zip = $_GET["plz"];
$city = $_GET["city"];
$id = $_GET["id"];

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
$pdf  = $dhlRetoure->getRetourePdf($surname, $familyname, $street, $streetNumber, $zip, $city, $id);
if($pdf){
	//$dhlRetoure->displayPdf($pdf);
	$dhlRetoure->displayBas64($pdf);
}

?>