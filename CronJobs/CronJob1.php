<?php

$InCartAvailability = 7;
$ConfirmedAvailability = 30;


// STATUS INCART
// CONNECT
$mysqli = new mysqli("rdbms.strato.de","U1150290", "qwasyx01", "DB1150290");
if ($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . 
			") " . $mysqli->connect_error;
}

// QUERY - Transaction
$query = "DELETE 
			FROM Transactions
			WHERE DATEDIFF( StatusDate, NOW( ) ) < -$InCartAvailability
			AND  `Status` LIKE  'InCart'";
$mysqli->query($query) or die($mysqli->error.__LINE__);


// STATUS CONFIRMED
// QUERY - Transaction
$query = "UPDATE Transactions
			SET `Status` = 'Canceled' 
			WHERE DATEDIFF( StatusDate, NOW( ) ) < -$ConfirmedAvailability
			AND  `Status` LIKE  'Confirmed'";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	

?>