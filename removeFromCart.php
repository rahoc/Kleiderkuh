<?php
	session_start();
	include 'db.php';
	
	$transaction = $_SESSION['transaction'];
	
	$removeId=$_GET["remove"];
	

	$verbindung = connectDB();

	$delete = "DELETE FROM Transactions_Clothes
				WHERE Id=$removeId";
				
	mysql_query($delete);
				
	closeDB($verbindung);

	echo showCartByTransaction($transaction, "remove");
?>
