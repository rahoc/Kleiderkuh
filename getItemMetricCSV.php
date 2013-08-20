<?php

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

// Go through transactions
foreach ($transactions as $i => $value) {

	$clothes = $transactions[$i]->clothes;
	
	// Go through clothes
	foreach ($clothes as $j => $value) {
		
		$transactions[$i]->id . ";" .
		$clothes[$j]->id . ";" .
		$clothes[$j]->gender . ";" .
		$clothes[$j]->brand . ";" .
		$clothes[$j]->type . ";" .
		$clothes[$j]->size . ";" .
		$clothes[$j]->price . "\n";
		
			
	}
	
}

echo $content;
// Write the contents back to the file
//file_put_contents($file, $content);


?>