<?php
session_start();
require_once("Transaction.php");

if (isset($_GET["id"])) {
	$id = $_GET["id"];
}
else if (isset($_POST["id"])) {
	$id = $_POST["id"];
}
else {
	echo "no id";
	return;
}
// Transaction
$t = new Transaction;
$t->loadById($id);

// Language
$_SESSION["language"] = $t->language;
require_once("language.php");

// Testing
$sendMail = false;
if (isset($_GET["mailTo"])) {
	$receiver = $_GET["mailTo"];
	$sendMail = true;
}

// General path
$webPath = 'http://kleiderkuh.de';

// Receiver
$receiver = $t->email;

// Betreff
$subject = "";
$content ="";

switch($t->status) {
	case "Confirmed": {
		$subject = $email_c_subject;
		$content = getConfirmed($t, $webPath);
		$sendMail = true;
		break;
	}
	case "Cancelled": {
		$subject = $email_ca_subject;
		$content = getCancelled($t, $webPath);
		$sendMail = true;
		break;
	}
	case "Received": {
		$subject = $email_r_subject;
		$content = getReceived($t, $webPath);
		$sendMail = true;
		break;
	}
	case "Waiting for customer": {
		$subject = $email_w_subject;
		$content = getWaitingForCustomer($t, $webPath);	
		$sendMail = true;
		break;
	}
	case "Waiting for payment": {
		$subject = $email_wp_subject;
		$content = getWaitingForPayment($t, $webPath);
		$sendMail = true;
		break;
	}
	case "Finished": {
		$subject = $email_f_subject;
		$content = getFinished($t, $webPath);
		$sendMail = true;
		break;
	}
	default: {
		$sendMail = false;
	}
}

// Nachricht
$message= '
<html>
<head>
  <title>Kleider Kuh</title>
</head>
<body style="background-color:#EEE;	
	font-family:"Noto sans", sans-serif;
	font-size:12pt;>
	
<div id="mail" style="background-color:#FFF;
	width:600px;
	margin-left:auto;
	margin-right:auto;	
	padding:10px;">
  <div id="head" style="height:128px;border-bottom:2px solid #028E9B;">
  	<a href="'.$webPath.'/home.php" style="color:#028E9B;">
		<img src="'.$webPath.'/images/impressum_logo.png" id="head_img"  style="height:128px;" />
	</a>
  </div>
  <div id="order" style="height:auto;padding:10px;">
  	<a href="'.$webPath.'/transactionState.php?transaction=' . 
	 $t->id .'&email=' . 
	 $t->email .'" style="color:#028E9B;">' . 
	 $email_text1 . $t->id.'</a>
  </div>
  <div id="content" style="height:auto;
	padding:10px;">
  	' . $content . '
  </div>
  <div id="foot" style="border-top:2px solid #028E9B;height:50px;">
  	<div id="f_left" style="padding-top:10px;float:left;width:150px;">
	<a href="'.$webPath.'/impressum.php" style="color:#028E9B; text-decoration:none";>Impressum</a>
	</div>
	<div id="f_center" style="padding-top:10px;float:left;text-align:center;">&copy; Copyright 2013 Kleider Kuh</div>
	<div id="f_right" style="float:right;">
		<a href="'.$webPath.'/home.php"">
			<img src="'.$webPath.'/images/impressum_logo_50.png" id="imp_img" style="height:50px;" />
		</a>
	</div>
  </div>
</div>
</body>
</html>
';

// für HTML-E-Mails muss der 'Content-type'-Header gesetzt werden
$header  = 'MIME-Version: 1.0' . "\r\n";
$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// zusätzliche Header
//$header .= 'To: Simone <simone@example.com>, Andreas <andreas@example.com>' . "\r\n";
$header .= 'From: Kleider Kuh <info@kleiderkuh.de>' . "\r\n";
//$header .= 'Cc: geburtstagsarchiv@example.com' . "\r\n";
//$header .= 'Bcc: geburtstagscheck@example.com' . "\r\n";



echo $message;
// send E-Mail
if ($sendMail) {
	mail($receiver, $subject, $message, $header);
	echo "email sent to " . $receiver;
}




function getConfirmed($t, $webPath) {
	include('language.php');
	return $email_c_text1 . 
		' <a href="'.$webPath.'/transactionState.php?transaction=' . 
	 	$t->id .
		'&email=' . 
	 	$t->email .
		'" style="color:#028E9B;">' . 
	 	$email_c_link1 . $t->id . 
		$email_c_text2;
}

function getCancelled($t, $webPath) {
	include('language.php');
	return $email_ca_text1;
}

function getReceived($t, $webPath) {
	include('language.php');
	return $email_r_text1 . 
	 	$t->getReceptionDate() . 
		$email_r_text2;
}

function getWaitingForCustomer($t, $webPath) {
	include('language.php');
	return $email_w_text1 . 
		' <a href="'.$webPath.'/transactionState.php?transaction=' . 
	 	$t->id .
		'&email=' . 
	 	$t->email .
		'" style="color:#028E9B;">' . 
	 	$email_w_link1 . $t->id . 
		$email_w_text2;
}

function getWaitingForPayment($t, $webPath) {
	
	
	include('language.php');
	return $email_wp_text1 . 
		$t->finalToPay .
		$email_wp_text2 .
		' <a href="'.$webPath.'/transactionState.php?transaction=' . 
	 	$t->id .
		'&email=' . 
	 	$t->email .
		'" style="color:#028E9B;">' . 
	 	$email_wp_link1 . $t->id . "</a>" .
		$email_wp_text3 . 
		' <a href="'.$webPath.'/transactionState.php?transaction=' . 
	 	$t->id .
		'&email=' . 
	 	$t->email .
		'" style="color:#028E9B;">' . 
	 	$email_wp_link1 . $t->id . "</a>" .
		$email_wp_text4;



}

function getFinished($t, $webPath) {
	include('language.php');
	
	if ($t->payment == "paypal") {
		$payment = $email_f_paypal;
		$account = $email_f_ppmail . $t->PaypalMail;
	}
	else {
		$payment = $email_f_uebwerweisung;
		$account = $email_f_accountNr . $t->getAccountNr();
	}
	$amount = $email_f_amount . $t->finalToPay . " Euro";
	
	if ($t->rejectedItems > 0) {
		if ($t->RejectOption == "donate") {
			$reject = "<li>" .
				$t->rejectedItems .
				$email_f_donate .
				"</li>";
		}
		else {
			$reject = "<li>" .
				$t->rejectedItems .
				$email_f_return .
				"</li>";
		}
	}
	else {
		$reject = "";
	}
	
	
	return $email_f_text1 . 
		$t->getFinishedDate() .
		"<ul>
		<li>" .
			$payment .
		"</li>
		<li>" .
			$account .
		"</li>
		<li>" .
			$amount .
		"</li>
		</ul>
		</li>" .
		$reject .
		$email_f_text2;
}

?>