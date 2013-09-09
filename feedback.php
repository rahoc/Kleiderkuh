<?php
require_once("language.php");
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
<div class="headline popup"><?php echo $feedback_headline1; ?></div>
    
<div id="feedbackContent" class="margin_left_30">
 	<div class="subheader cyan"><?php echo $feedback_subheader1; ?></div>
    <!--<button onclick="closeFeedback()">x</button>    -->
    <div id="close"></div>
    <form id="myform" name="myform" action="javascript:get(document.getElementById('myform'));">
    
        <input type="radio" name="category" value="<?php echo $feedback_cat1; ?>")><?php echo $feedback_label1; ?> <br />
        <input type="radio" name="category" value="<?php echo $feedback_cat2; ?>")><?php echo $feedback_label2; ?> <br />
        <input type="radio" name="category" value="<?php echo $feedback_cat3; ?>"><?php echo $feedback_label3; ?> <br />
        <input type="radio" name="category" value="<?php echo $feedback_cat4; ?>"><?php echo $feedback_label4; ?> <br />
        <input type="radio" name="category" value="<?php echo $feedback_cat5; ?>"><?php echo $feedback_label5; ?> <br />
        <input type="radio" name="category" value="<?php echo $feedback_cat6; ?>"><?php echo $feedback_label6; ?> <br />
        <br />
        <label><?php echo $feedback_text1; ?></label><br />
        <textarea size="50" id="exact"></textarea>
        <br /><br />
        <p><?php echo $feedback_text2; ?></p>
        <table>
            <tr><td><?php echo $feedback_mail2; ?></td><td><input type="text" id="name"></td></tr>
            <tr><td><?php echo $feedback_mail3; ?></td><td><input type="text" id="email"></td></tr>
            <tr><td></td>
            	<td><input type="image" src="images/<?php echo $langID; ?>/buttons/send.png" value="Send" class="button" id="submitFeedback" onclick="javascript:getFeedback(this.parentNode);"/>
             	</td>
            </tr>
        </table>
	 </form>
		<div id="feedback_error_1" class="orange"><?php echo $feedback_error1; ?></div>
        <div id="feedback_error_2" class="orange"><?php echo $feedback_error2; ?></div>
</div>
<script>

$(document).ready(function(e) {
    $("#feedback_error_1").hide();
	$("#feedback_error_2").hide();
});
</script>

</body>

</html>