<?php

require_once("Transaction.php");		

if(isset($_POST["id"])) {
	
	$id = $_POST["id"];
	$t = new Transaction;
	$t->loadById($id);
	echo $t->status;

}
else {
	echo "No post data (getTransactionStateByID)";
}

?>