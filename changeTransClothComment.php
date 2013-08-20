<?php
		
	require_once("Cloth.php");		

	//print_r($_POST);

	// Read POST data
	if (isset($_POST["id"]) && isset($_POST["comment"])) {
		
		$id = $_POST["id"];
		$comment = $_POST["comment"];
	
		// Create new Transaction and load it by ID
		$cloth = new Cloth;
		$cloth->loadById($id);
	
		// Change status
		$cloth->comment = $comment;
		
		// Store to DB
		$cloth->saveTransactionData();
		
		echo "successfully stored $id with new comment: $comment";

	}
	else {
		echo "error no POST data";
	}
	
?>