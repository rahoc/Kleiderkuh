<?php

//###############################
// Database Credentials
//###############################

require_once('Transaction.php');

$db_server = "";
$db_name = "DB1401681";
$db_user = "kkdbuser1";
  $db_password = "22qmuh22";


$mysqli = new mysqli($db_server ,$db_user, $db_password, $db_name);
	//$mysqli = new mysqli($db_server,$db_user, $db_password, $db_name);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . 
				") " . $mysqli->connect_error;
	}
	
		// QUERY - Transaction
		$query = "SELECT * FROM Transactions";
		$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
		
		print_r($result);
		

		$transactions;
		// GOING THROUGH THE DATA
		if($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				print_r($row);
				$transaction = new Transaction;
				$transaction->loadById($row['id']);
				$transactions[] = $transaction;
			}
		}
?>