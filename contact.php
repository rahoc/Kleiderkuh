<?php
include 'language.php';
?>
<div class="headline"><?php echo $contact_headline1; ?></div>
<div class="subheader cyan"><?php echo $contact_subheader1; ?></div>
<div><?php echo $contact_text1; ?></div>
<br />
<div class="subheader cyan"><?php echo $contact_subheader2; ?></div>

<div id="feedbackContent" class="margin_left_30">
 	<div class="subheader cyan"><?php echo $feedback_subheader1; ?></div>
    <!--<button onclick="closeFeedback()">x</button>-->
    <div id="close"></div>
    <form action="javascript:get(document.getElementById('myform'));" id="myform" name="myform">
    
        <input type="radio" name="category" value="idea")><?php echo $feedback_label1; ?> <br />
        <input type="radio" name="category" value="question")><?php echo $feedback_label2; ?> <br />
        <input type="radio" name="category" value="problem"><?php echo $feedback_label3; ?> <br />
        <input type="radio" name="category" value="like"><?php echo $feedback_label4; ?> <br />
        <input type="radio" name="category" value="missing"><?php echo $feedback_label5; ?> <br />
        <input type="radio" name="category" value="other"><?php echo $feedback_label6; ?> <br />
        <br />
        <label><?php echo $feedback_text1; ?></label><br />
        <textarea size="50" id="ta_exact"></textarea>
        <br /><br />
        <p><?php echo $feedback_text2; ?></p>
        <table>
            <tr><td>Your name:</td><td><input type="text" id="name"></td></tr>
            <tr><td>Email:</td><td><input type="text" id="email"></td></tr>
            <tr><td></td>
            	<td><input type="image" src="images/<?php echo $langID; ?>/buttons/send.png" value="Send" class="button" id="submitFeedback" onclick="javascript:getFeedback(this.parentNode);"/>
             	</td>
            </tr>
        </table>
	 </form>

</div>