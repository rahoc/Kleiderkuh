<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kleider Kuh</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>-->

    <div id="foot">
    
        <div class="center">
        	<a href="home.php">
            <img id="impressum_logo" src="images/impressum_logo.png"  />
            </a>
        </div>
        <div class="center">
        	<!--<div class="footer">
            <a href=""><?php echo $foot_text1; ?></a>
            </div>
            <div class="hline ">|</div>-->
            <div class="footer">
            <a href="#" onclick="openOverlay('contact.php')">
			<?php echo $foot_text2; ?></a>
            </div>
            <div class="hline ">|</div>
            <div class="footer">
            <a href="about.php"><?php echo $foot_text3; ?></a>
            </div>
            <div class="hline ">|</div>
            <div class="footer">
            <a href="#" onclick="openOverlay('AGB.php')">
			<?php echo $foot_text4; ?></a>
            </div>
            <div class="hline ">|</div>
            <div class="footer">
            <a href="#" onclick="openOverlay('privacy.php')">
			<?php echo $foot_text5; ?></a>
            </div>
            <div class="hline ">|</div>
            <div class="footer">
            <a href="#" onclick="openOverlay('impressum.php')">
			<?php echo $foot_text6; ?></a>
            </div>
            <div class="hline ">|</div>
            <div class="footer">
            <a href="http://www.facebook.de"  onClick="trackOutboundLink(this, 'Understanding KK', 'External Link', 'Facebook'); return false;"><img class="footimage" src="images/fb.png" /></a>
            </div>
            <div class="hline ">|</div>
            <div class="footer">
            <a href="#" id="lang"><img class="footimage" src="images/English-German_128.png" /></a>
            </div>
        </div>
        <div class="lastfooter center">
        	<?php echo $foot_text7; ?>
        </div>
    </div>


<script>

$("#lang").click(function() {
	var l = "<?php echo $langID; ?>";
	if (l=="en") {
		l = "de";
	}
	else {
		l = "en";
	}
		//alert (l);
	$.post("http://kleiderkuh.de/setLanguage.php", {language: l })
	.done(function(data) {
		//alert (data);
	  location.reload();
	});
});

</script>
<?php
include 'clicktale/ct_bottom.php';
?>
</body>
</html>