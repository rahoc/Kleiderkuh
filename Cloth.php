<?php

require_once('db.php');

class Cloth
{
	public 	$id,
			$fk_Clothes,
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
		
		$mysqli = connectDB();
                
                // CHANGED to make lossless pricechanges possible
		//$abfrage1 = "USE DB1401681";
		//mysql_query($abfrage1)  or die("USE DB" . mysql_error());;
		/*$query = "SELECT g.Name as Gender,
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
                 
                 */
                
                $query = "SELECT g.Name as Gender,
						b.Name as Brand,
						t.Name as Type,
						s.Name  as Size,
						tc.Price as Price,
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
				FROM Transactions_Clothes tc
				JOIN Gender g ON tc.Gender=g.id
				JOIN Brand b ON tc.Brand =b.id
				JOIN Type t ON tc.Type =t.id
				JOIN Size s ON tc.Size=s.id
				JOIN Clothes c ON c.id=tc.fk_Clothes 
				WHERE tc.Id=$transactionClothId";
				
		$result = $mysqli->query($query);

		while ($row = $result->fetch_object()) {
			$this->id = $row->tcID;
			$this->fk_Clothes = $row->ClothId;
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
		$mysqli->close();
	}
	
	public function saveTransactionData() {
		$mysqli = connectDB();
		//$abfrage1 = "USE DB1401681";
		//mysql_query($abfrage1)  or die("USE DB" . mysql_error());;
		$query = "UPDATE Transactions_Clothes
					SET Accepted = $this->accepted,
					Rejected = $this->rejected,
					Missing = $this->missing,
					Comment = '$this->comment'
					WHERE id=$this->id";
		//echo "$query";
		$mysqli->query($query);
		$mysqli->close();
	}

	public function saveClothData() {
		$mysqli = connectDB();
		$query = "UPDATE Clothes
					SET ActualAmount = $this->actualAmount
					WHERE id=$this->fk_Clothes";
		//echo "$query";
		$mysqli->query($query);
		$mysqli->close();
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


