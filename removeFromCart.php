<?php
	session_start();
	include 'db.php';
	
	$transaction = $_SESSION['transaction'];
	
	$removeId=$_GET["remove"];
	

	$mysqli = connectDB();

	$delete = "DELETE FROM Transactions_Clothes
				WHERE Id=$removeId";
				
	$mysqli->query($delete);
				
	$mysqli->close();

	echo showCartByTransaction($transaction, "remove", null);
