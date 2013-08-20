<?php
	session_start();
	include 'db.php';
	
	$transaction = $_SESSION['transaction'];
	
	$gender=$_GET["gender"];
	$brand=$_GET["brand"];
	$type=$_GET["type"];
	$size=$_GET["size"];

	$verbindung = connectDB();
		
	$abfrage = "SELECT c.id, g.Name, b.Name, t.Name, s.Name, c.Price as price
				FROM Clothes c
				JOIN Gender g ON c.Gender=g.id
				JOIN Brand b ON c.Brand =b.id
				JOIN Type t ON c.Type =t.id
				JOIN Size s ON c.Size=s.id
				WHERE LEFT(b.Name,4) = '".substr($brand,0,4)."'
				AND LEFT(g.Name,1) = '".substr($gender,0,1)."'
				AND LEFT(t.Name,1) = '".substr($type,0,1)."'
				AND s.Name='$size'
				";
	$ergebnis = mysql_query($abfrage);
	while($row = mysql_fetch_object($ergebnis))
	{
		$price = $row->price;
		break;
	}

	closeDB($verbindung);
	
	
	
	echo  $price;
?>