<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kleider Kuh</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
 $site = "home";
 include 'head.php';
?>

<div id="home">


<div id="intro">
    <div id="schrank" >
        <img class="schrankimage" src='images/schrank.png' />
    </div>
	<div id="intro_text">
    	<table>
    	<tr>
			<td><img class='bulletpoint' src='images/bullet.png' /></td>
			<td><?php echo $home_text1; ?></td>
        </tr>
        <tr>
			<td><img class='bulletpoint' src='images/bullet.png' /></td>
			<td><?php echo $home_text2; ?></td>
        </tr>
        <tr>
			<td><img class='bulletpoint' src='images/bullet.png' /></td>
			<td><?php echo $home_text3; ?></td>
        </tr>
        </table>
    </div>

</div>



<div id="home_content">

	<div class="headline center"><?php echo $home_headline1; ?></div>

	<div id="steps">
    	<table class="center">
    	<tr>
			<td><a href="sell.php"><img class='step' src='images/Step1_v2b.png' /></a></td>
            <td><img class='step' src='images/Step2_v2b.png' /></td>
            <td class="last"><img class='step' src='images/Step3_v2b.png' /></td>
			
        </tr>
        <tr>
            <td><?php echo $home_text4; ?></td>
            <td><?php echo $home_text5; ?></td>
            <td class="last"><?php echo $home_text6; ?></td>
        </tr>
        </table>
    
    </div>
    
    <div>
        <a href="sell.php" id="sell_now_button" class="center">
		<img src="images/<?php echo $langID; ?>/buttons/sellNow.png" class="button" />
        </a>
    </div>
    
    <div id="home_details">
    	<div id="home_details_show">
        	<a href="#" onclick="openOverlay('HowItWorks.php')" class="cyan"><?php echo $home_link1; ?></a>
        </div>
    </div>
    
  <!--
  <div class="background" id="bkg_how" style="visibility: hidden;">
    <div class="modal" id="dlg_how" style="visibility: hidden;">
    	<div class="closebtn" title="Close" id="closebtn_how">x</div>
      	<?php// include 'HowItWorks.php'; ?>
    </div>
  </div>
-->


    	
	<div id="like">
	<table>
    	<tr>
        <td class="left">
        <div class="headline cyan inline"><?php echo $home_headline2; ?></div>
        <div class="bubble inline"><?php echo $home_bubble1; ?></div></td>
        <td class="right">
        <div class="headline orange inline"><?php echo $home_headline3; ?></div>
        <div class="bubble inline"><?php echo $home_bubble2; ?></div></td>
        </tr>
        <tr>
        <td class="left">
        <div class="subheader cyan"><?php echo $home_subheader1; ?></div>
            <div><?php echo $home_text7; ?>
            <a href="#" onclick="openOverlay('Requirements.php')" class="cyan"><?php echo $home_link2; ?></a>
            </div></td>
        <td class="right">
        <div class="subheader orange"><?php echo $home_subheader6; ?></div>
            <div><?php echo $home_text12; ?></div></td>
        </tr>
        <tr>
        <td class="left">
        <div class="subheader cyan"><?php echo $home_subheader2; ?></div>
            <div><?php echo $home_text8; ?></div></td>
        <td class="right">
        <div class="subheader orange"><?php echo $home_subheader7; ?></div>
            <div><?php echo $home_text13; ?></div></td>
        </tr>
        <tr>
        <td class="left">
        <div class="subheader cyan"><?php echo $home_subheader3; ?></div>
            <div><?php echo $home_text9; ?></div></td>
        <td class="right">
        <div class="subheader orange"><?php echo $home_subheader8; ?></div>
            <div><?php echo $home_text14; ?></div></td>
        </tr>
        <tr>
        <td class="left">
        <div class="subheader cyan"><?php echo $home_subheader4; ?></div>
            <div><?php echo $home_text10; ?></div></td>
        <td class="right">
        <div class="subheader orange"><?php echo $home_subheader9; ?></div>
            <div><?php echo $home_text15; ?></div></td>
        </tr>
        <tr>
        <td class="left">
        <div class="subheader cyan"><?php echo $home_subheader5; ?></div>
            <div><?php echo $home_text11; ?></div></td>
        <td class="right">
        <div class="subheader orange"><?php echo $home_subheader10; ?></div>
            <div><?php echo $home_text16; ?></div></td>
        </tr>
    </table>

    </div>
</div>

</div>
<!--
    <div id="content" class="centered">
    
        <h2>This is the Homepage - here we explain all</h2>
        <br />
        
        <div id="sellBox" class="gradientBox displayInline">
        <a href="sell.php">SELL</a>
        
        </div>
        
        <div id="buyBox" class="gradientBox displayInline">
        BUY
        </div>
    
    </div>
-->

<?php
 include 'foot.php';
?>
</body>
</html>