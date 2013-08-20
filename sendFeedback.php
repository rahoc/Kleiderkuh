<?php
	$name = urldecode($_POST['name']);
	$email = urldecode($_POST['email']);
	$category = urldecode($_POST['category']);
	$exact = urldecode($_POST['exact']);
	
	echo "<h1 class='cyan'>$feedback_mail1</h1>
    <table>
    	<tr><td>$feedback_mail2: </td><td>$name</td></tr>
        <tr><td>$feedback_mail3: </td><td>$email</td></tr>
        <tr><td>$feedback_mail4: </td><td>$category</td></tr>
        <tr><td>$feedback_mail5: </td><td>$exact</td></tr>
    </table>";
	
	
	$to = "feedback@kleiderkuh.de";
	$subject = "Kleider Kuh Feedback";
	$message = "Feedback Kleider Kuh\n
Feedback from: $name \n
Email: $email \n
Category: $category \n
Text: \n
$exact	";
	$from = "$name <$email>";
	// für HTML-E-Mails muss der 'Content-type'-Header gesetzt werden
$header  = 'MIME-Version: 1.0' . "\r\n";
$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// zusätzliche Header
$header .= 'To: Kleider Kuh Feedback <feedback@kleiderkuh.de>' . "\r\n";
//$header .= 'From: $from' . "\r\n";
//$header .= 'Cc: geburtstagsarchiv@example.com' . "\r\n";
//$header .= 'Bcc: geburtstagscheck@example.com' . "\r\n";
	$header = "From:" . $from;
	mail($to,$subject,$message,$header);
?>