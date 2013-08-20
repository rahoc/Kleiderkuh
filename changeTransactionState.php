<?php
		
	require_once("Transaction.php");		

	//print_r($_POST);

	// Read POST data
	if (isset($_POST["id"]) && isset($_POST["status"])) {
		
		$id = $_POST["id"];
		$statusName = $_POST["status"];
	
		// Create new Transaction and load it by ID
		$transaction = new Transaction;
		$transaction->loadById($id);
	
		// Check valid change?
		if ($transaction->statusNumber >= 1 && $statusName == "Confirmed") {
			echo "allready confirmed or later status";
			return;
		}
	
		// Change status
		$transaction->status = $statusName;
		$transaction->StatusDate = date("Y-m-d H:i:s");
		switch($statusName) {
			case "InCart": {
				break;
			}
			case "Confirmed": {
				$transaction->OrderDate = date("Y-m-d H:i:s");
				break;
			}
			case "Received": {
				$transaction->ReceptionDate = date("Y-m-d H:i:s");
				break;
			}
			case "Processed": {
				$transaction->ProcessedDate = date("Y-m-d H:i:s");
				if ($transaction->rejectedItems + 
					$transaction->missingItems +
					$transaction->acceptedItems != count($transaction->clothes)) {
					echo "error - not all clothes processed";
					return;
				}
				if ($transaction->rejectedItems <= 0 && $transaction->missingItems <= 0) {
					$transaction->status = "Payment";
					$transaction->PaymentDate = date("Y-m-d H:i:s");
					$transaction->finalToPay = $transaction->getSumAccepted();
				}
				else {
					$transaction->status = "Waiting for customer";
					$transaction->finalToPay = $transaction->getSumAccepted();
				}
				break;
			}
			case "Waiting for customer": {
				//$transaction->PaymentDate = date("Y-m-d H:i:s");
				break;
			}
			case "Payment": {
				$transaction->PaymentDate = date("Y-m-d H:i:s");
				break;
			}
			case "Finished": {
				$transaction->FinishedDate = date("Y-m-d H:i:s");
				break;
			}
		}
		
		// Store to DB
		$transaction->save();
		
		echo "successfully stored $id with new status $statusName";

	}
	else {
		echo "error no POST data";
	}
	
	

?>