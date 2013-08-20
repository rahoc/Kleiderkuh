<?php
		
	require_once("Transaction.php");		

	// Read POST data
	if (isset($_POST["id"]) && isset($_POST["status"])) {
		
		$id = $_POST["id"];
		$statusName = $_POST["status"];
	
		// Create new Transaction and load it by ID
		$transaction = new Transaction;
		$transaction->loadById($id);
	
		// Change status
		$transaction->status = $statusName;
		$transaction->StatusDate = date("Y-m-d H:i:s");
		switch($statusName) {
			case "InCart": break;
			case "Confirmed": $t->OrderDate = date("Y-m-d H:i:s"); break;
			case "Received": $t->ReceptionDate = date("Y-m-d H:i:s"); break;
			case "Processed": $t->ProcessedDate = date("Y-m-d H:i:s"); break;
			case "WaitingForDecission": $t->PaymentDate = date("Y-m-d H:i:s"); break;
			case "Payment": $t->PaymentDate = date("Y-m-d H:i:s"); break;
			case "Finished": $t->FinishedDate = date("Y-m-d H:i:s"); break;
		}
		
		// Store to DB
		$transaction->save();
		
		echo "successfully stored $id with new status $statusName";

	}
	else {
		echo "error no POST data";
	}
	
?>