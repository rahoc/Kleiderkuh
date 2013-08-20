<?php
	session_start();
	$transaction = $_SESSION['transaction'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kleider Kuh</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="script.js"></script>
</head>
<body>
<?php
 include 'head.php';
 $transaction = $_SESSION['transaction'];
?>

<div id="content">
    <div class="headline"><?php echo $confirm_headline1; ?></div>
    <br />
    <div id="cartOverview">
       <div class="subheader cyan"><?php echo $confirm_subheader1 . $transaction; ?></div>
    
        
        <?php
		$transaction = $_SESSION['transaction'];
            //echo $transaction;
            include 'db.php';
            
            showCartByTransaction($transaction, "overview");
        ?>
       
    </div>

	<div id="customerForm">

	
    <?php
	//print_r($_POST);
	$fn=$_POST['fname'];
	$ln=$_POST['lname'];
	$email=$_POST['email'];
	$payment=$_POST['payment'];
	$blz=$_POST['blz'];
	$kto=$_POST['kto'];
	$ppMail=$_POST['paypalMail'];
	$ppMailadress=$_POST['paypalMailadress'];
	
	if($ppMail=="different") {
		$paypalEmail = $ppMailadress;
	}
	else {
		$paypalEmail = $email;
	}
	require_once("Transaction.php");
	$t = new Transaction;
	$t->loadById($transaction);
	
	//print_r($t);
	
	$t->fname=$fn;
	$t->lname=$ln;
	$t->email=$email;
	$t->payment=$payment;
	$t->BankNr=$blz;
	$t->AccountNr=$kto;
	$t->PaypalMail=$paypalEmail;
	
	$t->save();
	

	echo "<table>";
	echo "	<tr><td>$confirm_label1</td><td>" . $t->fname . "</td></tr>
		  	<tr><td>$confirm_label2</td><td>" . $t->lname . "</td></tr>
			<tr><td>$confirm_label3</td><td>" . $t->email . "</td></tr>
			<tr><td>$confirm_label4</td><td>" . $t->payment . "</td></tr>";
			
	if (strtolower($t->payment) == "paypal") {
		echo "	<tr><td>$confirm_label5</td><td>" . $t->PaypalMail . "</td></tr>";
	}
	else {
		echo "	<tr><td>$confirm_label6</td><td>" . $t->BankNr . "</td></tr>
			  	<tr><td>$confirm_label7</td><td>" . $t->getAccountNr() . "</td></tr>";
	}

	echo "</table>";
	?>
    
    <div id="error_on_submit" class="orange"></div>
	<input	type="checkbox" id="agb" /><label><a href="#" onclick="openOverlay('AGB.php')"><?php echo $confirm_checkbox1; ?></a></label>
    <br />
    
    
    <?php
	// Submit Buttons
    //echo "<input value=\"$confirm_button1\" type=\"button\" onclick=\"window.open('cartOverview.php', '_self')\" />
	echo "<input type='image' src='images/$langID/buttons/back.png' onclick=\"window.open('cartOverview.php', '_self')\" class='button' />";
    //echo "<input value=\"$confirm_button2\" type=\"button\" onclick=\"window.open('transactionState.php?email=$email&confirm=true', '_self')\" />";
	echo "<input type='image' src='images/$langID/buttons/confirm.png' alt='Submit Form'  id='submit_form' class='button' />";
	
	
	?>
    
    
    
	</div>
</div>
</div>
<br />
<?php
 include 'foot.php';
?>


<script>

$("#submit_form").click(function() {
//	alert('AGB');
  $("#error_on_submit").empty();
  if ($('#agb').is(':checked')) {
	  //alert('AGB not checked.');
	  window.open('transactionState.php?email=<?php echo $email; ?>&confirm=true', '_self')
  }
  else {
	  $("#error_on_submit").text("<?php echo $confirm_error1; ?>");  
  }
});

</script>
</body>

</html>