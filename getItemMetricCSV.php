<?php

require_once('Transaction.php');

$file = 'item_metric.txt';

// CONNECT
$mysqli = new mysqli("rdbms.strato.de","U1401681", "22qmuh22", "DB1401681");
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
header("Content-type:application/txt");
header("Content-Disposition:attachment;filename='item-metric.csv'");
echo $content;
// Write the contents back to the file
file_put_contents($file, $content);


?>