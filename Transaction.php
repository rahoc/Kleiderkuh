<?php
//require_once('db.php');
require_once('Cloth.php');

class Transaction {
	
	public $id;
	public $status;
	public $fname;
	public $lname;
	public $email;
	public $street;
	public $streetNr;
	public $plz;
	public $city;
	public $payment;
	public $finalToPay;
	public $PaypalMail;
	public $BankNr;
	public $AccountNr;
	public $StatusDate;
	public $RejectOption;
	public $OrderDate;
	public $ReceptionDate;
	public $ProcessedDate;
	public $PaymentDate;
	public $FinishedDate;
	public $clothes;
	public $statusNumber;
	public $acceptedItems;
	public $rejectedItems;
	public $missingItems;
	public $accountNrMasked;
	public $sumAccepted;
	public $loadResult;
	public $language;
	
	// GETTER
	public function getStatusDate() {
		if ($this->StatusDate == "0000-00-00") {
			return "";
		}
		else {
			$d = explode("-", $this->StatusDate);
			return $d[2] . "." . $d[1] . "." . $d[0] ;
		}
	}
	public function getOrderDate() {
		if ($this->OrderDate == "0000-00-00") {
			return "";
		}
		else {
			$d = explode("-", $this->OrderDate);
			return $d[2] . "." . $d[1] . "." . $d[0] ;
		}
	}
	public function getReceptionDate() {
		if ($this->ReceptionDate == "0000-00-00") {
			return "";
		}
		else {
			$d = explode("-", $this->ReceptionDate);
			return $d[2] . "." . $d[1] . "." . $d[0] ;
		}
	}
	public function getProcessedDate() {
		if ($this->ProcessedDate == "0000-00-00") {
			return "";
		}
		else {
			$d = explode("-", $this->ProcessedDate);
			return $d[2] . "." . $d[1] . "." . $d[0] ;
		}
	}
	public function getPaymentDate() {
		if ($this->PaymentDate == "0000-00-00") {
			return "";
		}
		else {
			$d = explode("-", $this->PaymentDate);
			return $d[2] . "." . $d[1] . "." . $d[0] ;
		}
	}
	public function getFinishedDate() {
		if ($this->FinishedDate == "0000-00-00") {
			return "";
		}
		else {
			$d = explode("-", $this->FinishedDate);
			return $d[2] . "." . $d[1] . "." . $d[0] ;
		}
	}
	
	public function getAccountNr() {
		if($this->AccountNr != "") {
			return "XXXXXX" . substr($this->AccountNr,strlen($this->AccountNr)-4);
		}
		else {
			return "No Account Nr";
		}
	}
	
	public function getSumAccepted() {
		$sum = 0;
		$clothes = $this->clothes;
		foreach ($clothes as $c => $value) {
			if ($clothes[$c]->accepted == 1) {
				$sum = $sum + $clothes[$c]->price;
			}
		}
		return $sum;
	}
	
	public function countAcceptedItems() {
		//echo "test";
		$count = 0;
		$clothes = $this->clothes;
		foreach ($clothes as $c => $value) {
			if ($clothes[$c]->accepted == 1) {
				$count = $count + 1;
			}
		}
		return $count;
	}
	
	public function countRejectedItems() {
		$count = 0;
		$clothes = $this->clothes;
		foreach ($clothes as $c => $value) {
			if ($clothes[$c]->rejected == 1) {
				$count = $count + 1;
			}
		}
		return $count;
	}
	
	public function countMissingItems() {
		$count = 0;
		$clothes = $this->clothes;
		foreach ($clothes as $c => $value) {
			if ($clothes[$c]->missing == 1) {
				$count = $count + 1;
			}
		}
		return $count;
	}
	
	
	
	public function loadById($transactionId) {
		//echo "tid= $transactionId";
		// CONNECT
		/*require_once('dblogin.php');
		
		$mysqli = new mysqli($db_server ,$db_user, $db_password, $db_name);
	//$mysqli = new mysqli($db_server,$db_user, $db_password, $db_name);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . 
				") " . $mysqli->connect_error;
	}
	
		// QUERY - Transaction
		$query = "SELECT * FROM Transactions WHERE Id=$transactionId";
		//echo $query;*/
		
		$db_server = "";
$db_name = "DB1401681";
$db_user = "kkdbuser1";
  $db_password = "22qmuh22";


		$mysqli = new mysqli($db_server ,$db_user, $db_password, $db_name);
		//$mysqli = new mysqli($db_server,$db_user, $db_password, $db_name);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . 
					") " . $mysqli->connect_error;
		}
	
		// QUERY - Transaction
		$query = "SELECT * FROM Transactions WHERE Id=$transactionId";
		$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
		
		//$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
		//echo "5 <br />";
		// GOING THROUGH THE DATA
		if($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$this->id = $transactionId;
				$this->status = $row['Status'];
				$this->StatusDate = $row['StatusDate'];
				$this->OrderDate = $row['OrderDate'];
				$this->ReceptionDate = $row['ReceptionDate'];
				$this->ProcessedDate = $row['ProcessedDate'];
				$this->PaymentDate = $row['PaymentDate'];
				$this->FinishedDate = $row['FinishedDate'];
				$this->fname = $row['FirstName'];
				$this->lname = $row['LastName'];
				$this->email = $row['Email'];
				$this->street = $row['street'];
				$this->streetNr = $row['streetNr'];
				$this->plz = $row['plz'];
				$this->city = $row['city'];
				$this->payment = $row['Payment'];
				$this->PaypalMail = $row['PaypalMail'];
				$this->BankNr = $row['BankNr'];
				$this->AccountNr = $row['AccountNr'];
				$this->finalToPay = $row['FinalToPay'];
				$this->RejectOption = $row['RejectOption'];
				$this->language = $row['language'];
				
				break;
			}
		}
		else {
			return $this->loadResult ="error";
		}		
		
		// QUERY - Related Clothes
		$query = "SELECT Id FROM Transactions_Clothes WHERE fk_Transactions=$transactionId";
		$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
		
		// GOING THROUGH THE DATA
		if($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$cloth = new Cloth;
				$cloth->loadById($row['Id']);
				$this->clothes[] = $cloth;
			}
		}
		else {
			//echo "No Clothes exist for this Transaction: $transactionId ! <br />";	
		}	
		
		
		// SET TRANSACTION STATUS NUMBER
		$stateNumber;
		switch(strtolower($this->status)) {
			case "confirmed": {
				$stateNumber = 1;
				break;
			}
			case "received": {
				$stateNumber = 2;
				break;
			}
			case "processed": {
				$stateNumber = 3;
				break;
			}
			case "waiting for customer": {
				$stateNumber = 3;
				break;
			}
			case "donate": {
				$stateNumber = 4;
				break;
			}
			case "return": {
				$stateNumber = 4;
				break;
			}
			case "waiting for payment"; {
				$stateNumber = 4;
				break;
			}
			case "payment": {
				$stateNumber = 4;
				break;
			}
			case "canceled": {
				$stateNumber = 5;
				break;
			}
			case "finished": {
				$stateNumber = 5;
				break;
			}
		}
		
		$this->statusNumber = $stateNumber;
		
		$this->acceptedItems = $this->countAcceptedItems();
		$this->rejectedItems = $this->countRejectedItems();
		$this->missingItems = $this->countMissingItems();
		$this->accountNrMasked = $this->getAccountNr();
		$this->sumAccepted = $this->getSumAccepted();
	}
	
	
	public function save() {
		$connection = connectDB();
		$abfrage1 = "USE DB1401681";
		mysql_query($abfrage1)  or die("USE DB" . mysql_error());;
		$query = "UPDATE Transactions
				SET Status = '$this->status',
				FirstName = '$this->fname',
				LastName = '$this->lname',
				Email = '$this->email',
				street = '$this->street',
				streetNr = $this->streetNr,
				plz = $this->plz,
				city = '$this->city',
				Payment = '$this->payment',
				FinalToPay = '$this->finalToPay',
				PaypalMail = '$this->PaypalMail',
				BankNr = '$this->BankNr',
				AccountNr = '$this->AccountNr',
				StatusDate = '$this->StatusDate',
				RejectOption = '$this->RejectOption',
				OrderDate = '$this->OrderDate',
				ReceptionDate = '$this->ReceptionDate',
				ProcessedDate = '$this->ProcessedDate',
				PaymentDate = '$this->PaymentDate',
				FinishedDate = '$this->FinishedDate',
				language = '$this->language'
				WHERE id=$this->id";
				//echo $query;
		mysql_query($query);
		closeDB($connection);
	}
	
}
/*
// TEST TEST TEST
$myTrans = new Transaction;
$myTrans->loadById(8);

echo $myTrans->id;
echo $myTrans->fname;
echo $myTrans->lname;
echo $myTrans->email;
$myTrans->email = "testmail@ole.de";
$myTrans->save();

$myTrans->loadById(34);

echo $myTrans->id;
echo $myTrans->fname;
echo $myTrans->lname;
echo $myTrans->email;
//for ($i = 0; $i < $myTrans->clothes->count(); $i++) {
//	echo $myTrans->clothes[$i]->toString();
//}

foreach ($myTrans->clothes as $i => $value) {
    echo $myTrans->clothes[$i]->toString();
}
*/
?>