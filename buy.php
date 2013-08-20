<div class="margin_left_30">
    <div class="headline"><?php echo $buy_headline1; ?></div>
    <div class="subheader cyan"><?php echo $buy_subheader1; ?></div>
    <div><?php echo $buy_text1; ?></div>
    <div>
    <form method="post" action="javascript:get(document.getElementById('myform'));" id="buyForm" name="buyForm">
        <label><?php echo $buy_label1; ?></label>
        <div class="float_left">
        <input type="text" id="buy_email" name="buy_email" value="" width="50"/>
        </div>
        <div class="float_left">
        <input type='image' src='images/<?php echo $langID; ?>/buttons/email.png'
            onclick="javascript:get_storeEmail(this.parentNode);" class='button_medium margin_left_10' />
        </div>
    </form>
    </div>
</div>