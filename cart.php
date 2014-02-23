
<?php
	session_start();
	include 'db.php';
	
	$transaction = $_SESSION['transaction'];
	
	$gender=$_GET["gender"];
	$brand=$_GET["brand"];
	$type=$_GET["type"];
	$size=$_GET["size"];

	$mysqli = connectDB();
		
	$abfrage = "SELECT c.id, g.Name, b.Name, t.Name, s.Name, c.Brand, c.Size, c.Type, c.Gender, c.Price FROM Clothes c
                    JOIN Gender g ON c.Gender=g.id
                    JOIN Brand b ON c.Brand =b.id
                    JOIN Type t ON c.Type =t.id
                    JOIN Size s ON c.Size=s.id
                    WHERE LEFT(g.Name,1) = '".substr($gender,0,1)."'
                    AND LEFT(b.Name,4) = '".substr($brand,0,4)."'
                    AND LEFT(t.Name,1) = '".substr($type,0,1)."'
                    AND s.Name='$size'
                    ";
				
				//echo $abfrage;
	$ergebnis = $mysqli->query($abfrage);
	while($row = $ergebnis->fetch_object())
	{
		$clothId = $row->id;
                $brandId = $row->Brand;
                $sizeId = $row->Size;
                $typeId = $row->Type;
                $genderId = $row->Gender;
                $price = $row->Price;
		break;
	}
	
	
        // TODO: change here to insert prices/clothes along with to new table layout
	// INSERT
        
        
        
	$insert = "INSERT INTO Transactions_Clothes
				(fk_Transactions, fk_Clothes, Brand, Size, Type, Gender, Price)
				VALUE ($transaction, $clothId, $brandId, $sizeId, $typeId, $genderId, $price)";
				//echo $insert;
	$mysqli->query($insert);

	echo showCartByTransaction($transaction, "cart", $mysqli);
	
	
	$mysqli->close();