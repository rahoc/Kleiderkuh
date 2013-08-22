<?php
		
	require_once("Cloth.php");		

	print_r($_POST);

	// Read POST data
	if (isset($_POST["id"]) && isset($_POST["accepted"])) {
		
		$id = $_POST["id"];
		$accepted = $_POST["accepted"];
	
		// Create new Transaction and load it by ID
		$cloth = new Cloth;
		$cloth->loadById($id);
	
		// Change status
		$cloth->accepted = $accepted;
		
		// Store to DB
		$cloth->save();
		
		echo "successfully stored $id with new accepted: $accepted";

	}
	else {
		echo "error no POST data";
	}
	
?>