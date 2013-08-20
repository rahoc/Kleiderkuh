<?php

require_once('db.php');

class Cloth
{
	public 	$id,
			$gender,
			$brand,
			$type,
			$size,
			$maxAmount,
			$actualAmount,
			$price,
			$active,
			$accepted,
			$rejected,
			$missing,
			$comment;
		
		
	public function loadById($transactionClothId) {
		
		$this->id = $transactionClothId;
		
		$connection = connectDB();
		$query = "SELECT g.Name as Gender,
						b.Name as Brand,
						t.Name as Type,
						s.Name  as Size,
						c.Price as Price,
						c.Active as Active,
						c.ActualAmount as ActualAmount,
						c.MaxAmount as MaxAmount,
						tc.Id as tcID,
						tc.Accepted as Accepted,
						tc.Rejected as Rejected,
						tc.Missing as Missing,
						tc.Comment as Comment,
						tc.fk_Clothes as ClothId,
						tc.Id as transactionClothId
				FROM Clothes c
				JOIN Gender g ON c.Gender=g.id
				JOIN Brand b ON c.Brand =b.id
				JOIN Type t ON c.Type =t.id
				JOIN Size s ON c.Size=s.id
				JOIN Transactions_Clothes tc ON c.id=tc.fk_Clothes 
				WHERE tc.Id=$transactionClothId";
				
		$result = mysql_query($query);

		while ($row = mysql_fetch_object($result)) {
			$this->id = $row->tcID;
			$this->gender = $row->Gender;
			$this->brand = $row->Brand;
			$this->type = $row->Type;
			$this->size = $row->Size;
			$this->maxAmount = $row->MaxAmount;
			$this->actualAmount = $row->ActualAmount;
			$this->price = $row->Price;
			$this->active = $row->Active;
			$this->accepted = $row->Accepted;
			$this->rejected = $row->Rejected;
			$this->missing = $row->Missing;
			$this->comment = $row->Comment;
			break;
		}
		//closeDB($connection);
		mysql_close($connection);
	}
	
	public function saveTransactionData() {
		$connection = connectDB();
		$query = "UPDATE Transactions_Clothes
					SET Accepted = $this->accepted,
					Rejected = $this->rejected,
					Missing = $this->missing,
					Comment = '$this->comment'
					WHERE id=$this->id";
		//echo "$query";
		mysql_query($query);
		closeDB($connection);
	}

	
		
	function toString()
	{
		return $this->gender . ", " .
				$this->brand . ", " .
				$this->type . ", " .
				$this->size . ", " .
				$this->maxAmount . ", " .
				$this->actualAmount . ", " .
				$this->price . ", " .
				$this->active . ", " .
				$this->accepted . ", " .
				$this->rejected . ", " .
				$this->missing . ", " .
				$this->comment . "<br />";
	}

	
}




?>