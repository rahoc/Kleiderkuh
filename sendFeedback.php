<?php
	$name = $_POST['name'];
	$email = $_POST['email'];
	$category = $_POST['category'];
	$exact = $_POST['exact'];
	
	echo "<h3>Thanks for your Feedback!</h3>
    <div id=\"close\" onclick=\"closeFeedback()\"><button>x</button></div>
    <table>
    	<tr><td>Your name:</td><td>$name</td></tr>
        <tr><td>Email:</td><td>$email</td></tr>
        <tr><td>What you miss:</td><td>$category</td></tr>
        <tr><td>Exactly:</td><td>$exact</td></tr>
    </table>";
	
	
	$to = "Kleider Kuh@aal-web.de";
	$subject = "Kleider Kuh Feedback";
	$message = "Thanks for your Feedback!
	Your name: $name
	Email: $email
	Category: $category
	Exactly: $exact
	";
	$from = "$email";
	$headers = "From:" . $from;
	mail($to,$subject,$message,$headers);
?>