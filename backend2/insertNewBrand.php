<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Insert new Brand</title>
</head>

<body>
<?php

require_once('../db.php');
	echo '<pre>';
	$verbindung = connectDB();
	
	print_r($_POST);

	// Get POST data
	if (isset($_POST["brandName"]) && $_POST["brandName"] != "") {
		$brandName = $_POST["brandName"];
		$brandKeywords = $_POST["brandKeywords"];
		echo "<br />Posted Brand: $brandName <br />";
	}
	else {
		echo "Brand not set in POST data<br />";
		return;
	}

	// Check if Brand exists?
	$query = "SELECT * FROM Brand WHERE Name LIKE '$brandName'";
	$result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	if ($num_rows == 0) {
		// Insert new Brand
		$query = "INSERT INTO Brand (Name, Keywords) VALUES ('$brandName', '$brandKeywords')";
		echo "Brand does not exist, try to insert: $query <br />";
		$result = mysql_query($query);
		
	
		// Get Brand Id
		$query = "SELECT Id FROM Brand WHERE Name LIKE '$brandName'";	
		$result = mysql_query($query);
		$brandId = 0;
		while($row = mysql_fetch_object($result))
		{
			$brandId = $row->Id;
			echo "Brand id: $brandId <br />";
			break;
		}
		if ($brandId == 0) {
			echo "Brand was not inserted sucessfully into brand table!<br />";
			return;
		}
		
		// Insert Cloth Permutation
		// Gender
		$abfrageG = "SELECT id FROM Gender";	
		$ergebnisG = mysql_query($abfrageG);
		while($rowG = mysql_fetch_object($ergebnisG))
		{
			// Type
			$abfrageT = "SELECT id FROM Type";	
			$ergebnisT = mysql_query($abfrageT);
			while($rowT = mysql_fetch_object($ergebnisT))
			{
				// Size
				$abfrageS = "SELECT id FROM Size";	
				$ergebnisS = mysql_query($abfrageS);
				while($rowS = mysql_fetch_object($ergebnisS))
				{
					// Get POST data
					$ma = 'maxAmount' . $rowG->id . $rowT->id;
					$pr = 'price' . $rowG->id . $rowT->id;
					echo "read from post: $ma ,  $_POST[$ma]";
					$maxAmount = $_POST[$ma];
					$price = $_POST[$pr];
					// Insert
					$insert  = "INSERT INTO Clothes
								(Gender, Brand, Type, Size, ActualAmount, MaxAmount, Price)
								VALUES
								($rowG->id, $brandId, $rowT->id, $rowS->id, 0, $maxAmount, $price)";
					echo "Try to insert: $insert <br />";
					mysql_query($insert);
				}
			}
		}
	
	
		echo "Finished inserting new clothes! <br />";
		
		
		// UPLOAD IMAGE
		
		$uploaddir = $_SERVER['DOCUMENT_ROOT'] . "/images/brands/";
		$uploadfile = $uploaddir . substr($brandName, 0 ,4) . ".png";//basename($_FILES['brandimage']['name']);
		
		
		if (move_uploaded_file($_FILES['brandimage']['tmp_name'], $uploadfile)) {
			echo "Image sucessfully uploaded: $uploadfile.\n";
		} else {
			echo "ERROR ON IMAGE UPLOAD!\n $uploadfile.";
		}
		
		echo 'Weitere Debugging Informationen:';
		print_r($_FILES);
		
		
		
		
	} // If brand exists
	else {
		echo "Brand already exists, did nothing <br />";
	}
	print "</pre>";
	closeDB($verbindung);
	
?>
</body>
</html>