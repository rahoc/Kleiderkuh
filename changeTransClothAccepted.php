<?php
		
	require_once("Cloth.php");		

	//print_r($_POST);

	// Read POST data
	if (isset($_POST["id"])) {
		
		$id = $_POST["id"];
		$changes = false;
	
		// Create new Transaction and load it by ID
		$cloth = new Cloth;
		$cloth->loadById($id);
	
		if (isset($_POST["accepted"])) {
			// Change status
			$accepted = $_POST["accepted"];
			$cloth->accepted = $accepted;
			if($accepted == 1) {
				$cloth->rejected = 0;
				$cloth->missing = 0;
			}
			
			$changes = true;
		}
	
		if (isset($_POST["rejected"])) {
			// Change status
			$rejected = $_POST["rejected"];
			$cloth->rejected= $rejected;
			if($rejected == 1) {
				$cloth->accepted = 0;
				$cloth->missing = 0;
			}
			$changes = true;
		}
		
		if (isset($_POST["missing"])) {
			// Change status
			$missing = $_POST["missing"];
			$cloth->missing = $missing;
			if($missing == 1) {
				$cloth->accepted = 0;
				$cloth->rejected = 0;
			}
			$changes = true;
		}
		
		if($changes) {
			// Store to DB
			$cloth->saveTransactionData();
			echo "successfully stored $id with a=$accepted r=$rejected m=$missing";
		}
		else
		{
			echo "error - no changes at id $id";
		}
	}
	else {
		echo "error no POST data";
	}
	
?>