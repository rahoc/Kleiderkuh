<?php
	session_start();
	$transaction = $_SESSION['transaction'];
?>

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
    	<tr><td><?php echo $goToTrans_label1; ?></td><td><input id="cartTransaction" type="text" name="transaction"></td></tr>
        <tr><td><?php echo $goToTrans_label2; ?></td><td><input id="cartEmail" type="text" name="email"></td></tr>
        <tr><td></td><td><input id="submitCartForm" type='image' src='images/<?php echo $langID; ?>/buttons/login.png' alt='Submit Form' value=\"Go\" class='button_medium' /></td></tr>
    </table>
</form>

</div>
<div id="error_on_submit" class="orange center"></div>


<br />

<script>

$(document).ready(function(e) {
    checkCartForm();
});


$('#submitCartForm').click(function() {
	$("#error_on_submit").empty();
	if (!isEmail($("#cartEmail").val())) {
		//alert('Email not valid.');
		$("#error_on_submit").text("<?php echo $goToTrans_error2; ?>");
		return false;
	}
	
  	if(	$("#cartTransaction").val() == "" || $("#cartEmail").val() == ""){
		$("#error_on_submit").text("<?php echo $goToTrans_error3; ?>");
		return false;
	}
	
	if(	isNaN( $("#cartTransaction").val() ) ){
		$("#error_on_submit").text("<?php echo $goToTrans_error4; ?>");
		return false;
	}
	
});

</script>

<?php
 include 'foot.php';
?>
