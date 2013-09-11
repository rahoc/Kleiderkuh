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
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="script.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
</head>

<body>
<?php
// LOGIN
if (isset($_POST['user']) && isset($_POST['pw'])) {
	if ($_POST['user'] == 'kleiderkuh' && $_POST['pw'] == '22qmuh22' ){
		$_SESSION['loggedIn'] = 'kleiderkuh';
	}
}
if (isset($_GET['logout'])) {
	if ($_GET['logout'] == 'true' ){
		$_SESSION['loggedIn'] = '';
	}
}
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 'kleiderkuh') {
	echo "logged in as kleiderkuh <a href='manageTransactions2.php?logout=true'>logout</a><br />";
}
else {
	die( "not logged in: username and/or password wrong or you just logged out<br />
		<a href='login.php'>login</a>" );
}
// END LOGIN
?>
<?php
 require_once('Transaction.php');
 require_once('Cloth.php');
 require_once('db.php');
?>   
<div id="result" class="orange" style="position:fixed;top:5px;background-color:#FFF;left:50%;">No Changes</div>
<div id="toolbar">
	<a href="getItemMetricCSV.php" target="_blank">Download item metric as CSV</a><br />
    <a href="manageClothes.php">Manage Clothes</a>
</div>
<div id="editContent">
    
        
    <?php
    
	
	$orderBy = "id";
	

	$db_server = "";
	$db_name = "DB1401681";
	$db_user = "kkdbuser1";
	$db_password = "22qmuh22";
	
	
	$mysqli = new mysqli($db_server ,$db_user, $db_password, $db_name);
	//$mysqli = new mysqli($db_server,$db_user, $db_password, $db_name);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . 
				") " . $mysqli->connect_error;
	}
	
		// QUERY - Transaction
		$query = "SELECT * FROM Transactions ORDER BY id DESC";
		$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
		
		//print_r($result);
		
		
	
	$transactions;
	// GOING THROUGH THE DATA
	if($result->num_rows > 0) {

		while ($row = $result->fetch_assoc()) {
			
			//print_r($row);
			$transaction = new Transaction;

			$transaction->loadById($row['id']);

			$transactions[] = $transaction;
		}
	}
	else {
		echo 'NO RESULTS - No Transactions at all';	
	}
	
    ?>
    
    <table id="fullTable">
	<tr>
        <th>Id</th>
        <th>Status</th>
        <th>StatusDate</th>
        <th>OrderDate</th>
        <th>Reception Date</th>
        <th>Processed Date</th>
        <th>Payment Date</th>
        <th>Finished Date</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Payment</th>
        <th>Paypal Mail</th>
        <th>Bank Number</th>
        <th>Account Number</th>
        <th>Final Amount to pay</th>
        <th>Reject Option</th>
        
    </tr>
    
    <?php
	foreach ($transactions as $i => $value) {
		
		// ############################
		// OUTPUT DATA
		$statusName = $transactions[$i]->status;
		$in = "";
		$co = "";
		$re = "";
		$pr = "";
		$wa = "";
		$do = "";
		$rt = "";
		$pa = "";
		$ca = "";
		$fi = "";
		switch($statusName) {
			case "InCart": $in = "selected='selected'"; break;
			case "Confirmed": $co = "selected='selected'"; break;
			case "Received": $re = "selected='selected'"; break;
			case "Processed": $pr = "selected='selected'"; break;
			case "Waiting for customer": $wa = "selected='selected'"; break;
			case "Waiting for payment": $wp = "selected='selected'"; break;
			case "Donate": $do = "selected='selected'"; break;
			case "Return": $rt = "selected='selected'"; break;
			case "Payment": $pa = "selected='selected'"; break;
			case "Cancelled": $ca = "selected='selected'"; break;
			case "Finished": $fi = "selected='selected'"; break;
		}
		
		$id = $transactions[$i]->id;
		
		echo "<tr id='row$id'>";
		echo "<td>" . $id . "<a href='#' id='opener_$id'>... show Clothes</a></td>";
		echo "<td><select name='status_$id' id='status_$id' class='status' size='1''>
				<option $in value='InCart'>In Cart</option>
				<option $co value='Confirmed'>Confirmed</option>
				<option $re value='Received'>Received</option>
				<option $pr value='Processed'>Processed</option>
				<option $wa value='Waiting for customer'>Waiting for customer</option>
				<option $wp value='Waiting for Payment'>Waiting for payment</option>
				<option $do value='Donate'>Donate</option>
				<option $rt value='Return'>Return</option>
				<option $pa value='Payment'>Payment</option>
				<option $ca value='Cancelled'>Cancelled</option>
				<option $fi value='Finished'>Finished</option>	
			  </select></td>";
		echo "<td>" . $transactions[$i]->getStatusDate() . "</td>";
		echo "<td>" . $transactions[$i]->getOrderDate() . "</td>";
		echo "<td>" . $transactions[$i]->getReceptionDate() . "</td>";
		echo "<td>" . $transactions[$i]->getProcessedDate() . "</td>";
		echo "<td>" . $transactions[$i]->getPaymentDate() . "</td>";
		echo "<td>" . $transactions[$i]->getFinishedDate() . "</td>";
		echo "<td>" . $transactions[$i]->fname . "</td>";
		echo "<td>" . $transactions[$i]->lname . "</td>";
		echo "<td>" . $transactions[$i]->email . "</td>";
		echo "<td>" . $transactions[$i]->payment . "</td>";
		echo "<td>" . $transactions[$i]->PaypalMail . "</td>";
		echo "<td>" . $transactions[$i]->BankNr . "</td>";
		echo "<td>" . $transactions[$i]->AccountNr . "</td>";
		echo "<td>" . $transactions[$i]->finalToPay . " €</td>";
		echo "<td>" . $transactions[$i]->RejectOption . "</td>";

		echo "</tr>";


		// MODAL DIALOG
		
		echo "<script>
			  $(function() {
				$( \"#dialog_$id\" ).dialog({
				  minWidth: 600,
				  autoOpen: false,
				  show: {
					effect: \"blind\",
					duration: 500
				  },
				  hide: {
					effect: \"blind\",
					duration: 500
				  }
				  
				});
			 
				$( \"#opener_$id\" ).click(function() {
				  $( \"#dialog_$id\" ).dialog( \"open\" );
				});
			  });
			  </script>";
	
		echo "<div id='dialog_$id' class='table' title='Clothes regarding transaction: $id'>";
				echo "<div class='tableRow'>";
				echo "<div class='tableHeader'>Id</div>";
				echo "<div class='tableHeader'>Gender</div>";
				echo "<div class='tableHeader'>Brand</div>";
				echo "<div class='tableHeader'>Type</div>";
				echo "<div class='tableHeader'>Size</div>";
				//echo "<div class='tableHeader'>Max Amount</div>";
				//echo "<div class='tableHeader'>Actual Amount</div>";
				echo "<div class='tableHeader'>Price</div>";
				//echo "<div class='tableHeader'>Active</div>";
				echo "<div class='tableHeader'>Accepted</div>";
				echo "<div class='tableHeader'>Rejected</div>";
				echo "<div class='tableHeader'>Missing</div>";
				echo "<div class='tableHeader'>Comment</div>";
				echo "</div>";
			$clothes = $transactions[$i]->clothes;
			
			foreach ($clothes as $j => $value) {
				

				// ############################
				// OUTPUT DATA
				
				echo "<div class='tableRow'>";
					echo "<div class='tableCell'>" . $clothes[$j]->id . "</div>";
					echo "<div class='tableCell'>" . $clothes[$j]->gender . "</div>";
					echo "<div class='tableCell'>" . $clothes[$j]->brand . "</div>";
					echo "<div class='tableCell'>" . $clothes[$j]->type . "</div>";
					echo "<div class='tableCell'>" . $clothes[$j]->size . "</div>";
					//echo "<div class='tableCell'>" . $clothes[$j]->maxAmount . "</div>";
					//echo "<div class='tableCell'>" . $clothes[$j]->actualAmount . "</div>";
					echo "<div class='tableCell'>" . $clothes[$j]->price . " €</div>";
					//echo "<div class='tableCell'>" . $clothes[$j]->active . "</div>";
					if( $clothes[$j]->accepted == 1 ) { $active_a = "checked='checked'"; }
					else { $active_a = ""; }
					echo "<div class='tableCell'>
						<input type='checkbox' class='accepted' 
						name='accepted_" . $clothes[$j]->id . "'
						id='accepted_" . $clothes[$j]->id . "' value='1' $active_a />
						</div>";
					if( $clothes[$j]->rejected == 1 ) { $active_r = "checked='checked'"; }
					else { $active_r = ""; }
					echo "<div class='tableCell'>
						<input type='checkbox' class='rejected' 
						name='rejected_" . $clothes[$j]->id . "' 
						id='rejected_" . $clothes[$j]->id . "' value='1' $active_r />
						</div>";
					if( $clothes[$j]->missing == 1 ) { $active_m = "checked='checked'"; }
					else { $active_m = ""; }
					echo "<div class='tableCell'>
						<input type='checkbox' class='missing' 
						name='missing_" . $clothes[$j]->id . "' 
						id='missing_" . $clothes[$j]->id . "' value='1' $active_m />
						</div>";
					echo "<div class='tableCell'>
						<textarea class='comment' name='comment_" . $clothes[$j]->id . "' 
						onkeyup='textAreaAdjust(this)' style='overflow:hidden'>" . $clothes[$j]->comment . "</textarea>
						</div>";
				echo "</div>";
				
			} // end foreach cloth
			echo "</form";
			
		echo "</div>";
		
	
	} // end foreach transaction
	
	
	?>
	</table>


</div>
<br />

<script>
function textAreaAdjust(o) {
    o.style.height = "1px";
    o.style.height = (25+o.scrollHeight)+"px";
}

$('.status').change(function() {
	var lang = "<?php echo $language; ?>";
	var dropdown = $(this);
	var id =  dropdown.attr( "name" ).valueOf().substring(7);
	var status =  dropdown.val();
	var doPost = false;
	
	
	// CHECK FOR MAIL NOTIFICATION
	if (status == "Processed" 
		|| status == "Received" 
		|| status == "Waiting for customer" 
		|| status == "Finished" 
		|| status == "Cancelled")
	{
		if (confirm('Are you sure you want to change the status to '
					+ status +
					'. This results in an email notification to the customer'))
		{
			doPost=true;
		}
		else {
			$.post("hgetTransactionStateByID.php", { id: id })
			.done(function(data) {
			 	//alert("Data Loaded" + data);
			 	dropdown.val(data) ;
			});
			doPost=false;
		}
	}
	else {
		doPost=true;
	}
	
	if (doPost) {
		//alert( "POST: " + status + " " + id );
		$.post("changeTransactionState.php", { id: id , status: status , language: lang})
		.done(function(data) {
		  //alert("Data Loaded: " + data);
		  $( "#result" ).empty().append( data );
		});
	}
	
	$("#editContent").focus();
});


$('.accepted').click(function() {
	var id = $(this).attr( "name" ).valueOf().substring(9);
	if ( $(this).is(':checked') ) {
		// uncheck the other
		$("#rejected_" + id).removeAttr("checked");
		$("#missing_" + id).removeAttr("checked");
		$.post("changeTransClothAccepted.php", { id: id , accepted: 1 })
		.done(function(data) {
		  //alert("Data Loaded: " + data);
		  $( "#result" ).empty().append( data );
		});
	}
	else {
		$.post("changeTransClothAccepted.php", { id: id , accepted: 0 })
		.done(function(data) {
		  //alert("Data Loaded: " + data);
		  $( "#result" ).empty().append( data );
		});
	}
});


$('.rejected').click(function() {
	var id = $(this).attr( "name" ).valueOf().substring(9);
	if ( $(this).is(':checked') ) {
		// uncheck the other
		$("#accepted_" + id).removeAttr("checked");
		$("#missing_" + id).removeAttr("checked");
		
		$.post("changeTransClothAccepted.php", { id: id , rejected: 1 })
		.done(function(data) {
		  //alert("Data Loaded: " + data);
		  $( "#result" ).empty().append( data );
		  if ($( "#result" ).text() == "error - not all clothes processed") {
			  alert ("error - not all clothes processed");
		  }
		});
	}
	else {
		$.post("changeTransClothAccepted.php", { id: id , rejected: 0 })
		.done(function(data) {
		  //alert("Data Loaded: " + data);
		  $( "#result" ).empty().append( data );
		});
	}
});


$('.missing').click(function() {
	var id = $(this).attr( "name" ).valueOf().substring(8);
	if ( $(this).is(':checked') ) {
		// uncheck the other
		$("#rejected_" + id).removeAttr("checked");
		$("#accepted_" + id).removeAttr("checked");
		$.post("changeTransClothAccepted.php", { id: id , missing: 1 })
		.done(function(data) {
		  //alert("Data Loaded: " + data);
		  $( "#result" ).empty().append( data );
		});
	}
	else {
		$.post("changeTransClothAccepted.php", { id: id , missing: 0 })
		.done(function(data) {
		  //alert("Data Loaded: " + data);
		  $( "#result" ).empty().append( data );
		});
	}
});


$('.comment').change(function() {
	var id =  $(this).attr( "name" ).valueOf().substring(8);
	var comment =  $(this).val();
	//alert( "POST: " + status + " " + id );
	$.post("changeTransClothComment.php", { id: id , comment: comment })
	.done(function(data) {
	 // alert("Data Loaded: " + data);
	 $( "#result" ).empty().append( data );
	});
});

</script>

</body>

</html>