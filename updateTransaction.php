<?php

require_once("Transaction.php");		

	//print_r($_POST);

	// Read POST data
	if (isset($_POST["id"])) {
		
		$id = $_POST["id"];
	
		// Create new Transaction and load it by ID
		$t = new Transaction;
		$t->loadById($id);
		
		// #########################################
		// CHANGE REJECT OPTION
		// #########################################
		if (isset($_POST["reject_option"]) && !isset($_POST["rejection_submit"])) {
			$reject_option = $_POST["reject_option"];
			
			// RejectOption changed to donate
			if ($reject_option == "donate") {
				echo "Total amount for accepted items: " . $t->getSumAccepted() . " €";
			}

			// RejectOption changed to return	
			if ($reject_option == "return") {
				$new_sum_accepted = $t->getSumAccepted() - 5;
				echo "Total amount for accepted items: " . $new_sum_accepted . " € 
				(" . $t->getSumAccepted() . " € - 5 € shipping cost)";
			}

		} // end change reject option
		
		
		// #########################################
		// SUBMIT REJECT OPTION
		// #########################################
		//print_r($_POST);
		if (isset($_POST["reject_option"]) && isset($_POST["rejection_submit"])) {
			$reject_option = $_POST["reject_option"];
			$submit = $_POST["rejection_submit"];
			
			if ($submit == "true") {
				$sum;
				if ($reject_option == "return") {
					$sum = $t->getSumAccepted() - 5;
				}
				else {
					$sum = $t->getSumAccepted();
				}
				$t->finalToPay = $sum;
				$t->RejectOption = $reject_option;
				if(isset($_POST["fname"])) {
					$t->fname = $_POST["fname"];
				}
				if(isset($_POST["lname"])) {
					$t->lname = $_POST["lname"];
				}
				if(isset($_POST["street"])) {
					$t->street = $_POST["street"];
				}
				if(isset($_POST["streetNr"])) {
					$t->streetNr = $_POST["streetNr"];
				}
				if(isset($_POST["plz"])) {
					$t->plz = $_POST["plz"];
				}
				if(isset($_POST["city"])) {
					$t->city = $_POST["city"];
				}
				$t->save();
				echo "success";
				return;
			}
			echo "error";

		} // end submit reject option
		
	}

?>