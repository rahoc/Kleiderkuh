<?php
include 'language.php';
?>
<div class="headline"><?php echo $contact_headline1; ?></div>
<div class="subheader cyan"><?php echo $contact_subheader1; ?></div>
<div><?php echo $contact_text1; ?></div>
<br />
<div class="subheader cyan"><?php echo $contact_subheader3; ?></div>
<a href="http://www.facebook.com/kleiderkuh" onClick="trackOutboundLinkNewWindow(this, 'Understanding KK', 'External Link Contact', 'Facebook'); return false;"><img class="footimage" src="images/fb.png" /></a>
<div class="subheader cyan"><?php echo $contact_subheader2; ?></div>

<div id="feedbackContentC" class="margin_left_30">
 	<div class="subheader cyan"><?php echo $feedback_subheader1; ?></div>
    <!--<button onclick="closeFeedback()">x</button>-->
    <div id="close"></div>
    <form action="javascript:get(document.getElementById('myformC'));" id="myformC" name="myformC">
    
        <input type="radio" name="category" value="idea")><?php echo $feedback_label1; ?> <br />
        <input type="radio" name="category" value="question")><?php echo $feedback_label2; ?> <br />
        <input type="radio" name="category" value="problem"><?php echo $feedback_label3; ?> <br />
        <input type="radio" name="category" value="like"><?php echo $feedback_label4; ?> <br />
        <input type="radio" name="category" value="missing"><?php echo $feedback_label5; ?> <br />
        <input type="radio" name="category" value="other"><?php echo $feedback_label6; ?> <br />
        <br />
        <label><?php echo $feedback_text1; ?></label><br />
        <textarea size="50" id="exactC"></textarea>
        <br /><br />
        <p><?php echo $feedback_text2; ?></p>
        <table>
            <tr><td><?php echo $feedback_mail2; ?></td><td><input type="text" id="nameC"></td></tr>
            <tr><td><?php echo $feedback_mail3; ?></td><td><input type="text" id="emailC"></td></tr>
            <tr><td></td>
            	<td><input type="image" src="images/<?php echo $langID; ?>/buttons/send.png" value="Send" class="button" id="submitFeedbackC" onclick="javascript:getFeedbackC(this.parentNode); ga_feedback();"/>
             	</td>
            </tr>
        </table>
	 </form>
	<div id="feedbackC_error_1" class="orange" style="display: none;"><?php echo $feedback_error1; ?></div>
        <div id="feedbackC_error_2" class="orange" style="display: none;"><?php echo $feedback_error2; ?></div>
</div>
