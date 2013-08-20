<?php
include 'db.php';

class Transaction {
	
	public $id;
	public $status;
	public $fname;
	public $lname;
	public $email;
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
	
	
	public function loadById($transactionId) {
		$connection = connectDB();
		$query = "SELECT * FROM Transactions WHERE id=$transactionId";
		$result = mysql_query($query);

		while ($row = mysql_fetch_object($result)) {
			$this->id = $row->id;
			$this->fname = $row->FirstName;
			$this->lname = $row->LastName;
			$this->email = $row->Email;
			$this->payment = $row->Payment;
			$this->finalToPay = $row->FinalToPay;
			$this->PaypalMail = $row->PaypalMail;
			$this->BankNr = $row->BankNr;
			$this->AccountNr = $row->AccountNr;
			$this->StatusDate = $row->StatusDate;
			$this->RejectOption = $row->RejectOption;
			$this->OrderDate = $row->OrderDate;
			$this->ReceptionDate = $row->ReceptionDate;
			$this->ProcessedDate = $row->ProcessedDate;
			$this->PaymentDate = $row->PaymentDate;
			$this->FinishedDate = $row->FinishedDate;
			break;
		}
		closeDB($connection);
	}
	
	
	public function save() {
		$connection = connectDB();
		$query = "UPDATE Transactions
				SET FirstName = '$this->fname',
				LastName = '$this->lname',
				Email = '$this->email',
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
				FinishedDate = '$this->FinishedDate'
				WHERE id=$this->id";
		echo $query;
		mysql_query($query);
		closeDB($connection);
	}
	
}

$myTrans = new Transaction;
$myTrans->loadById(8);

echo $myTrans->id;
echo $myTrans->fname;
echo $myTrans->lname;
echo $myTrans->email;
$myTrans->email = "testmail@ole.de";
$myTrans->save();

$myTrans->loadById(8);

echo $myTrans->id;
echo $myTrans->fname;
echo $myTrans->lname;
echo $myTrans->email;

?>