<?php
	session_start();
	$transaction = $_SESSION['transaction'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	$transaction = $_SESSION['transaction'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kleider Kuh</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="script.js"></script>

</head>
<body>
<?php
 $site = "transaction";
 include 'head.php';
?>


<div class="headline center"><?php echo $goToTrans_headline1; ?></h2></div>
<div class="center" style="width:350px;">
<?php
// Outoput error
if(isset($_GET['error'])){
	if( $_GET['error'] == 'true' ) {
		echo "<div class='transaction_not_found orange'>$goToTrans_error1</div>";
	}
}
?>
<form method="get" action="transactionState.php">
    <table class="align_left">
    	<tr><td><?php echo $goToTrans_label1; ?></td><td><input type="text" name="transaction"></td></tr>
        <tr><td><?php echo $goToTrans_label2; ?></td><td><input type="text" name="email"></td></tr>
        <tr><td></td><td><input type='image' src='images/<?php echo $langID; ?>/buttons/login.png' alt='Submit Form' value=\"Go\" class='button_medium' /></td></tr>
    </table>
</form>

</div>


<br />
<?php
 include 'foot.php';
?>
</body>

</html>