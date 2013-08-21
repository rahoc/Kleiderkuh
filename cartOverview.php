<?php
	session_start();
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
 <div class="headline"><?php echo $cartOverview_headline1; ?></div>
    <div id="cartOverview">
       <div class="subheader cyan"><?php echo $cartOverview_subheader1 . $transaction; ?></div>
    	<br />
        <br />
        <?php
		$transaction = $_SESSION['transaction'];
		//print_r($_SESSION);
		if(isset($transaction)) {
            //echo "Transaction number:" . $transaction;
            include 'db.php';
			
            echo "<div id='cartList'>";
			showCartByTransaction($transaction, "overview");
        	echo "</div>";
			
			$verbindung = connectDB();
	
			$abfrage = "INSERT INTO Transactions (id, Status)
						VALUES ($transaction, 'InCart')";
			 mysql_query($abfrage);
			 
			// Set predefined Values if existing
			$abfrage = "SELECT * FROM Transactions
						WHERE id=$transaction";
			$ergebnis = mysql_query($abfrage);
			while($row = mysql_fetch_object($ergebnis))
			{
				$firstName = $row->FirstName;
				$lastName = $row->LastName;
				$email = $row->Email;
			}
			
			
			closeDB($verbindung);
		}
		else {
			echo "transaction number not set!";
		}
        ?>
       
    </div>
	<br />
	<div id="customerForm">
   
	
    <form id="#cart_form" method="post" action="confirm.php">
    
    <table>
    	<tr><td><?php echo $cartOverview_label1; ?></td><td><input type="text" name="fname"
        		value="<?php echo $firstName?>" onkeyup="checkCartForm()"></td></tr>
        <tr><td><?php echo $cartOverview_label2; ?></td><td><input type="text" name="lname"
        		value="<?php echo $lastName?>" onkeyup="checkCartForm()"></td></tr>
        <tr><td><?php echo $cartOverview_label3; ?></td><td><input type="text" id="cart_email" name="email"
        		value="<?php echo $email?>" onkeyup="checkCartForm()"></td></tr>
        <tr><td><?php echo $cartOverview_label4; ?></td><td>
        <input id="payment_paypal" type="radio" name="payment" value="paypal"
        	onclick="setUeberweisungVisible(false)"><?php echo $cartOverview_label5; ?><br />
        <input id="payment_ueberweisung" type="radio" name="payment" value="ueberweisung"
        	onclick="setUeberweisungVisible(true)"><?php echo $cartOverview_label6; ?></td></tr>
   
        <tr>
        	<td><?php echo $cartOverview_label7; ?></td>
        	<td><input type="text" id="blz" name="blz" disabled="disabled" onkeyup="checkCartForm()"></td>
        </tr>
        <tr>
        	<td><?php echo $cartOverview_label8; ?></td>
            <td><input type="text" id="kto" name="kto" disabled="disabled" onkeyup="checkCartForm()"></td>
        </tr>

       
        <tr><td><?php echo $cartOverview_label9; ?></td><td>
        <input type="radio" id="paypalMail1"  name="paypalMail" value="same"
        	onclick="setDiffPaypalVisible(false)" disabled="disabled">
            <?php echo $cartOverview_label10; ?><br />
        <input type="radio" id="paypalMail2" name="paypalMail" value="different"
        	onclick="setDiffPaypalVisible(true)" disabled="disabled">
            <?php echo $cartOverview_label11; ?></td></tr>
 		 <tr><td><?php echo $cartOverview_label12; ?></td><td>
         <input type="text" id="paypalMailadress" name="paypalMailadress" disabled="disabled"  onkeyup="checkCartForm()">
         </td></tr>
    </table>
    <div id="error_on_submit" class="orange"></div>
    <input type="image" src="images/<?php echo $langID; ?>/buttons/submit.png" alt="Submit Form" value="Sell this!" class="button" id="submitCartForm" style="visibility:hidden" />
	</form>
	</div>
</div>

<br />

<script>

$('#submitCartForm').click(function() {
  $("#error_on_submit").empty();
  if (!isEmail($("#cart_email").val())) {
	  //alert('Email not valid.');
	  $("#error_on_submit").text("<?php echo $cartOverview_error1; ?>");
	  return false;
  }
  var pp = $("input[name='paypalMail']:checked").val();
  if (pp == "different" && !isEmail($("#paypalMailadress").val())) {
	  //alert('PP not valid.');
	  $("#error_on_submit").text("<?php echo $cartOverview_error2; ?>");
	  return false;
  }

});

</script>


<?php
 include 'foot.php';
?>
</body>

</html>