<?php
include 'dblogin.php';

$mysqli;

function connectDB() {

    include 'dblogin.php';
    
    if(!isset($mysqli)) {
        $mysqli = new mysqli($db_server,$db_user, $db_password) or die ("Error mysqli_connect: ".mysqli_error()); 
        $mysqli->select_db($db_name); // or die ("Error select_db: ".mysqli_error());
    }
    return $mysqli;
}

function closeDB($verbindung) {
	mysqli_close($verbindung);
}

function showNames($tableName, $gender) {
	if($tableName=="Brand") {
		$abfrage = "SELECT Id, Name, NameEn, Keywords FROM $tableName ORDER BY Name";
	}
	else {
		$abfrage = "SELECT Id, Name FROM $tableName ORDER BY Name";
	}
        $mysqli = connectDB();
	$result = $mysqli->query($abfrage);
        if (!$result) {
            printf("Error: %s\n", $mysqli->error);
        }
//        if ($ergebnis == false) {
//            die ("Keine Daten in der Datenbank");
//        }
	include 'language.php';
	// Column description
	if($tableName=="Brand") {
		echo "<div class='selectDescription'>
				<div id='selectDescription$tableName' class='bubble right'>
				$sell_bubble2</div>
			</div>";
	}
	else {
		echo "<div class='selectDescription'>
				<div id='selectDescription$tableName' class='bubble right'>
				$sell_bubble1</div>
			</div>";
	}
	
	// Column name
	if($tableName=="Gender") {
		echo "<div class=\"selectHeader\">$sell_text7</div>";
	}
	else if($tableName=="Brand") {
		
		echo "<div class=\"selectHeader\">$sell_text8</div>";
		echo "<div><input type='text' id='brandSearch' onkeyup='filterBrands()' onclick='resetAkkordean()' class='filterBox' />
			</div>
			<div id='noSearchResults' class='center orange'>$sell_text12</div>
			<div id='openBrandListTxt' onclick='openBrandListOverlay()'>$sell_link2</div>";
	}
	else if($tableName=="Type") {
		echo "<div class=\"selectHeader\">$sell_text9</div>";
	}
	// Column data
	while($row = $result->fetch_object())
	{
		if($tableName=="Gender") {
			$genderimage  = substr($row->Name, 0,1);
			echo "
			<a id=\"$row->Name\" class=\"select\" 
			href=\"#\" onclick=\"showByCategory('$row->Name', '$tableName', '$gender'); return false\">
			<img src=\"images/gender/$genderimage.png\" class=\"genderimages\" />
			<br />$row->Name
			</a>
			";	
		}
		else if ($tableName=="Brand") {
			$brandimage  = substr($row->Name, 0,4);
		echo "
			<a id=\"$row->Name\" class=\"select\" name='brand$row->Id' title='$row->Name' 
			href=\"#\" onclick=\"showByCategory('$row->Name', '$tableName', '$gender'); return false\">
			<div class='brandimage_wrapper'><img src=\"images/brands/$brandimage.png\" class=\"brandimages\" /></div>
			<input type='hidden' name='brand" . $row->Id . "keywords' value='$row->Keywords $row->NameEn' />
			</a>
			";
		}
		else {
			$typeimage  = substr($row->Name, 0,4);
			if (substr($gender,0,1) == "J" && (substr($row->Name, 0,1) == "K" || substr($row->Name, 0,1) == "R")) {
				continue;
			}
			echo "
			<a id=\"$row->Name\" class=\"select\" 
			href=\"#\" onclick=\"showByCategory('$row->Name', '$tableName', '$gender'); return false\">
			<img src=\"images/type/$typeimage.png\" class=\"typeimages\" />
			<br />$row->Name
			</a>
			";
		}
	}
	// Dots
	if ($tableName=="Brand") {
		echo "<div id='dots' onclick='showAllBrands()' class='cyan center'>$sell_text13</div>";
	
	}
	// Feedback
	if($tableName != "Gender") {
		echo "<a href='#' onclick=\"showFeedback()\" class='selectFeedback'>$sell_text4</a>";
	}

}

function showSizeNames($gender, $brand, $type) {
	$tableName = "Size";
	$abfrage = "SELECT Name, Age FROM $tableName";
        $mysqli = connectDB();
	$ergebnis = $mysqli->query($abfrage);
include 'language.php';
	// Column description

	echo "<div class='selectDescription'>
			<div id='selectDescription$tableName' class='bubble right'>
			$sell_bubble1</div>
		</div>";
	
	
	// Column name
	echo "<div class=\"selectHeader\">$sell_text10</div>";
	
	// Column data
	while($row = $ergebnis->fetch_object())
	{
		$abfrage2 = "SELECT Active, ActualAmount, MaxAmount FROM Clothes c
					JOIN Gender g ON c.gender = g.id
					JOIN Brand b ON c.brand = b.id
					JOIN Type t ON c.type = t.id
					JOIN Size s ON c.size = s.id
					WHERE LEFT(b.Name,4) = '".substr($brand,0,4)."'
					AND LEFT(g.Name,1) = '".substr($gender,0,1)."'
					AND LEFT(t.Name,1) = '".substr($type,0,1)."'
					AND s.Name = '$row->Name'
					";
					//echo $abfrage2;
					$ergebnis2 = $mysqli->query($abfrage2);
					while($row2 = $ergebnis2->fetch_object())
					{
						//echo  $row2->Active;
						$active = $row2->Active;
						$actAmount = $row2->ActualAmount;
						$maxAmount = $row2->MaxAmount;
						break;
					}
					//echo $active;
		if($active == 1 && $actAmount < $maxAmount) {
		echo "<a id=\"$row->Name\" class=\"select\" href=\"#\"
			  onclick=\"showByCategory('$row->Name', '$tableName'); return false\">
				<span class='sizeName'>$row->Name</span>
				<br />
				ca. $row->Age
			  </a>
			 ";
		}
		else {
		echo "<p id=\"$row->Name\" class=\"select, selectInactiveCategory\">
				<span class='sizeName'>$row->Name</span>
				<br />
				ca. $row->Age
			  </p>
			 ";
		}
	}

	//Feedback
		echo "<a href='#' onclick=\"showFeedback()\" class='selectFeedback'>$sell_text4</a>";
	$mysqli->close();
}

function getTransactionId() {
	$mysqli = connectDB();
	
		$newTransactionId = 1;
	$abfrage = "SELECT * FROM Transactions
				WHERE id= (SELECT MAX(id) FROM Transactions)";
	$result = $mysqli->query($abfrage);
	while($row = $result->fetch_object())
	{
		$newTransactionId = $row->id + 1;
	}
	
	//	$abfrage = "INSERT INTO Transactions (id) VALUES (".$newTransactionId.")";
	// mysqli_query($abfrage);
	
	$mysqli->close();
	
	return $newTransactionId;
}


function showCartByTransaction($transaction, $site, $verbindung) {
	
	
	include 'language.php';
	
	if ($langID == "") {
		$langID = "en";
	}
	
	
	//$verbindung = connectDB();
	$mysqli = connectDB();
	//$mysqli->query($abfrage1)  or die("USE DB" . mysqli_error());;
	$abfrage = "SELECT g.Name as gender,
						b.Name as brand,
						t.Name as type,
						s.Name  as size,
						tc.Price as price,
						tc.fk_Clothes as ClothId,
						tc.Id as transactionClothId
				FROM Clothes c
				JOIN Gender g ON c.Gender=g.id
				JOIN Brand b ON c.Brand =b.id
				JOIN Type t ON c.Type =t.id
				JOIN Size s ON c.Size=s.id
				JOIN Transactions_Clothes tc ON c.id=tc.fk_Clothes 
				WHERE tc.fk_Transactions=$transaction
				ORDER BY transactionClothId";
	//echo $abfrage;
	$ergebnis = $mysqli->query($abfrage) or die(mysqli_error());
	$num_rows = $ergebnis->num_rows;

	if (!$ergebnis) {
		die('Ungültige Anfrage: ' . mysqli_error());
	}
	//echo "$num_rows Zeilen\n";
	//print_r($ergebnis);
	echo "<table id=\"cartTable\">";
	echo "<tr>
				<th>$cart_text3</th>
				<th>$cart_text4</th>
				<th>$cart_text5</th>
				<th>$cart_text6</th>
				<th>$cart_text7</th>";
	if($site!='email' && $site!='confirm' ) {
		echo	"<th></th>";
	}
	echo  "</tr>";
	
	while($row = $ergebnis->fetch_object())
	{
		echo "<tr>
				<td>$row->gender</td>
				<td>$row->brand</td>
				<td>$row->type</td>
				<td>$row->size</td>
				<td>".number_format($row->price,2)." €</td>";
				if($site!='email' && $site!='confirm' ) {
					echo "<td><a href='#' onclick='removeFromCart($row->transactionClothId); return false' class='trash'>
						x</a></td>";
				}
			  echo"</tr>";
	}
	echo "</table>";
	
	// OUTPUT SUM
	$abfrage = "SELECT SUM(Price) as summe
				FROM Transactions_Clothes tc 
				WHERE tc.fk_Transactions=$transaction";
	$ergebnis = $mysqli->query($abfrage);
        if(!$ergebnis) {
            $sum = 0;
        }
        else {
            while($row = $ergebnis->fetch_object())
            {
                    $sum = round($row->summe,2);
                    break;
            }
        }
	
		
	if($site == "overview" || $site=='confirm') {
			echo "<br />$cart_text1 ".number_format($sum,2)." €<br /><span id='cartsum' style='display:none'>$sum</span>";
			
		}
		else {
			// check if sum higher than 15 Euro
			if($sum >=15) {
				echo "<br />$cart_text1 ".number_format($sum,2)." €<br /><span id='cartsum' style='display:none'>$sum</span>
					<form method=\"post\" action=\"cartOverview.php\">
					
					<input type='image' src='images/$langID/buttons/sellNow.png' alt='Submit Form' value=\"Sell this!\" class='button' />
					</form>";
			}
			else {
				echo "<br />$cart_text1 ".number_format($sum,2)." €<br /><span id='cartsum' style='display:none'>$sum</span>
						$cart_text2";
			}
		}
		
	
	//closeDB($verbindung);
		
}


function showTransaction($t, $e) {
	$mysqli = connectDB();
		
	$abfrage = "SELECT * FROM Transactions
				WHERE id=$t AND email LIKE '$e'";
	$ergebnis = $mysqli->query($abfrage);
	echo "<table>";
	while($row = $ergebnis->fetch_object())
	{
		echo "<tr>
				<td>$row->FirstName</td>
				<td>$row->LastName</td>
				<td>$row->Email</td>
				<td>$row->Payment</td>
				
			  </tr>";
	}
	echo "</table>";
	
	closeDB($verbindung);
	
	return $newTransactionId;
}


function showClothState($transaction, $email, $stateNumber, $rejectOption, $FinalToPay) {
	
	include 'language.php';
	
	$mysqli = connectDB();
	
	$abfrage = "SELECT g.Name as gender,
						b.Name as brand,
						t.Name as type,
						s.Name  as size,
						c.price as price,
						tc.Accepted as accepted,
						tc.Rejected as rejected,
						tc.Missing as missing,
						tc.Comment as comment
				FROM Clothes c
				JOIN Gender g ON c.Gender=g.id
				JOIN Brand b ON c.Brand =b.id
				JOIN Type t ON c.Type =t.id
				JOIN Size s ON c.Size=s.id
				JOIN Transactions_Clothes tc ON c.id=tc.fk_Clothes 
				WHERE tc.fk_Transactions=$transaction";
				//echo $abfrage;
	$ergebnis = $mysqli->query($abfrage);
	echo "<div class='gradientBox'><table id='cartTable'>";
	$rejectedItems = 0;
	echo "<tr>
				<th>Gender</th>
				<th>Brand</th>
				<th>Type</th>
				<th>Size</th>
				<th>Price €</th>
				<th>Acceptance</th>
				<th>Comment</th>
			  </tr>";
	while($row = $ergebnis->fetch_object())
	{
		if($row->accepted==1){
			$acceptance = "Accepted";
			$acceptedPrice = $row->price;
		}
		else if($row->rejected==1){
			$acceptance = "Rejected";
			$rejectedItems++;
		}
		else if($row->missing==1){
			$acceptance = "Missing";
			$rejectedItems++;
		}
		else {
			$acceptance = "No result";
			$rejectedItems++;
		}
		echo "<tr>
				<td>$row->gender</td>
				<td>$row->brand</td>
				<td>$row->type</td>
				<td>$row->size</td>
				<td>$acceptedPrice</td>
				<td>$acceptance</td>
				<td>$row->comment</td>
			  </tr>";
	}
	
	
	// OUTPUT SUM
	$abfrage = "SELECT SUM(Price) as summe
				FROM Clothes c
				JOIN Transactions_Clothes tc ON c.id=tc.fk_Clothes 
				WHERE tc.fk_Transactions=$transaction AND tc.Accepted=1";
	$ergebnis = $mysqli->query($abfrage);
	while($row = $ergebnis->fetch_object())
	{
		$sum = $row->summe;
		break;
	}
	
	if($sum == "") {
		$sum = 0;
	}
	
	if ($stateNumber>=3) {
		$sum = $FinalToPay;
	}
	
	echo "</table>
			<br /><div id='sumDiv'><p>Total accepted: <div id='transactionSum'>$sum</div> €<br /></div>
				<div id='newSumDiv' hidden='hidden'><p>New total accepted: <div id='transactionSumNew'></div> €<br /></div>
				<div id='negativeSum' hidden='hidden'>
					<br />
					You have a negative sum!, this means you have to transfer money to us:<br />
					Paypal: ourpaypal@adress.de<br />
					Ueberweisung: OurBank 123123 Account 654321<br />
					Or choose the free option to give it to chartiy
				</div>
				<form method=\"post\" action=\"transactionState.php\">
				<input type='hidden' id='finalToPay' name='finalToPay' value='$sum' />";
	echo "</p></div>";
	
	// Show form as disabled
	if($stateNumber>=3) {
		$disable = " disabled=\"disabled\"";
		if($rejectOption=="donate") {
			$selectCharity = " checked=\"checked\"";
		}
		else {
			$selectCharity = "";
		}
		
		if ($rejectOption=="return") {
			$selectSendBack = " checked=\"checked\"";
		}
		else {
			$selectSendBack = "";
		}
	}
	else {
		$disable = "";
	}
	
	if($rejectedItems>=1){
		echo "<br />
		
		<table>
			<input type=\"text\" name=\"pemail\" value=\"$email\" hidden=\"hidden\"$disable>
			<input type=\"text\" name=\"ptransaction\" value=\"$transaction\" hidden=\"hidden\"$disable>
			<tr><td>What do you want us to do with the rejected items?</td><td>
			
        	<input id='reject_sendBack' type=\"radio\" name=\"rejectOptions\" value=\"return\"
				$disable$selectSendBack onclick='checkRejectionForm()'>
					Send it back to me! This option costs 5 Euro.<br />
        	<input id='reject_charity' type=\"radio\" name=\"rejectOptions\" value=\"donate\"
				$disable$selectCharity onclick='checkRejectionForm()'>
					Give it to charity. This option is free.</td></tr>
			<tr><td>
			</td><td>
			<input type='image'
				src='images/$langID/buttons/submit.png' 
				alt='Submit Form' value=\"Submit\" class='button_medium' 
				id='rejectionSubmit' disabled=\"disabled\"/>
			</td></tr>
        </table>
		</form>
				";
				//<input id='rejectionSubmit' type=\"submit\" value=\"Submit\" disabled=\"disabled\">
	} else {
		echo "Proceeded to Payment.";
	}
	
	$mysqli->close();
		
}

function getReceptionDate($transaction, $email) {
	$mysqli = connectDB();
		
	$abfrage = "SELECT ReceptionDate FROM Transactions
				WHERE id=$transaction AND email LIKE '$email'";
	$ergebnis = $mysqli->query($abfrage);
	
	while($row = $ergebnis->fetch_object())
	{
		echo "$row->ReceptionDate";
		break;
	}
	
	$mysqli->close();
}
