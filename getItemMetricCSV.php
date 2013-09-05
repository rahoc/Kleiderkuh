<?php

require_once('Transaction.php');

$file = 'item_metric.csv';

// CONNECT
$db_server = "";
$db_name = "DB1401681";
$db_user = "kkdbuser1";
  $db_password = "22qmuh22";
$mysqli = new mysqli($db_server,$db_user, $db_password, $db_name);
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . 
			") " . $mysqli->connect_error;
}


// QUERY - Related Clothes
$query = "SELECT Id FROM Transactions ORDER BY Id DESC";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$transactions;
// LOAD DATA
if($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$transaction = new Transaction;
		$transaction->loadById($row['Id']);
		$transactions[] = $transaction;
	}
}
else {
	echo 'NO RESULTS - No Transactions at all';	
}

$headers = "transaction;id;gender;brand;type;size;price\n";
$content   = "";
// Go through transactions
foreach ($transactions as $i => $value) {

	$clothes = $transactions[$i]->clothes;
	
	// Go through clothes
	foreach ($clothes as $j => $value) {
		
		// Get just accepted items
		if ($clothes[$j]->accepted == true) {
		
			$content = $content . $transactions[$i]->id . ";" .
			$clothes[$j]->id . ";" .
			$clothes[$j]->gender . ";" .
			$clothes[$j]->brand . ";" .
			$clothes[$j]->type . ";" .
			$clothes[$j]->size . ";" .
			$clothes[$j]->price . "\n";
		
		}
	}
	
}

$content = str_replace(array('&auml;','&Auml;','&ouml;','&Ouml;','&uuml;','&Uuml;'), array('ä','Ä','ö','Ö','ü','Ü'), $content);

$content = $headers . $content;
$now = gmdate("D, d M Y H:i:s");

// disable caching
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
header("Last-Modified: {$now} GMT");

// force download  
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");

header("Content-type:application/csv");
header("Content-Disposition:attachment;filename='item-metric.csv'");
header("Content-Transfer-Encoding: binary");

echo $content;
// Write the contents back to the file
//file_put_contents($file, $content);

die();
?>