<?php

require_once("Transaction.php");		

//print_r($_POST);

// Read POST data
if (isset($_POST["id"])) {
	
	$id = $_POST["id"];
	
	// Create new Transaction and load it by ID
	$t = new Transaction;
	$result = $t->loadById($id);
	echo $result;
	if ($t->loadResult == "error") {
		echo "error";
		return;
	}
	
	$json = json_encode($t);
	echo $json;
	
}

else
{
	echo "post error";
}

?>