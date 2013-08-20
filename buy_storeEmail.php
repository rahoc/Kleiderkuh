<div class="headline"><?php echo $buy_headline1; ?></div>
<div>
<?php

	include 'db.php';
	include 'language.php';
	
	$email=$_POST['buy_email'];
	
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	
	$verbindung = connectDB();
		
	$abfrage = "SELECT Email
				FROM Feedback
				WHERE Email LIKE '$email'
				AND Reason LIKE 'Buy'
				";
	$ergebnis = mysql_query($abfrage);
	
	if (mysql_num_rows($ergebnis) > 0) {
		// The Email is allready in the Buy feedback
		echo $buy_text2;
	}
	else {
		// store the mail adress
		$insert = "INSERT INTO Feedback (Email, Reason)
					VALUES ('$email', 'Buy')";
		mysql_query($insert);
		echo $buy_text3;
		echo "<br />Email: $email";
	}
	

	closeDB($verbindung);
	
	}
	else {
		include 'buy.php';
		echo "<div>$buy_error1</div>";
	}
?>
</div>