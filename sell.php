<?php
session_start();
 
 
 //Debug
 //echo getTransactionId();
?>
<!--
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kleider Kuh</title>
<link rel="stylesheet" type="text/css" href="style.css">
<!--<script src="script.js"></script>

</head>

</html>
<body>-->
<?php
 $site = "sell";
 include 'head.php';
 include 'db.php';
  
 
 $_SESSION['transaction'] = getTransactionId();
?>

<div class="headline center"><?php echo $sell_headline1; ?></div>

	<div id="steps">
    	<table class="center">
    	<tr>
			<td><img class='step' src='images/Step1_v2b.png' /></td>
            <td><img class='step' src='images/Step2_v2.png' /></td>
            <td class="last"><img class='step' src='images/Step3_v2.png' /></td>
			
        </tr>
        <tr>
            <td><?php echo $sell_text1; ?></td>
            <td><?php echo $sell_text2; ?></td>
            <td class="last"><?php echo $sell_text3; ?></td>
        </tr>
        </table>
    
    </div>
    
    <div id="condition_text" class="center" onclick="openOverlay('Requirements.php')"><?php echo $sell_text5; ?>
    	<a href="#" class="cyan"><?php echo $sell_link1; ?></a>
    </div>

<div id="content">
	
	<script>
	// Initial show Gender selection
    showTable('Gender');
    </script>
    <div class="headline"><?php echo $sell_headline2; ?></div>

    <div id="selector">
    
        <div id="Gender" class="selcolumn"></div>
        <div id="Brand" class="selcolumn">
        </div>
        <div id="Type" class="selcolumn">
        </div>
        <div id="Size" class="selcolumn">
        </div>
        
        <div id="result" class="selcolumnResult" style="visibility:hidden;"> 
            <?php echo $sell_text6; ?>
            <br />
            <br />
            <?php echo $sell_text7; ?>
            <div id="selectedGender" class="resultBoxes"></div>
            <?php echo $sell_text8; ?>
            <div id="selectedBrand" class="resultBoxes"></div>
            <?php echo $sell_text9; ?>
            <div id="selectedType" class="resultBoxes"></div>
            <?php echo $sell_text10; ?>
            <div id="selectedSize" class="resultBoxes"></div>
            <br />
            <?php echo $sell_text11; ?>
            <div id="price" class="resultBoxes"></div>
            <br />
           <!-- <button id="addToCart" type="button"
            onclick="addClothToCart()">Add to cart</button>-->
            <a href="#" id="addToCart" class="center" onclick="addClothToCart(); return false">
				<img src="images/<?php echo $langID; ?>/buttons/inTheCart.png" class="button" />
            </a>
        </div> 
        
        <div id="cart" class="selcolumn">
        	<div class="subheader cyan">
            	<?php echo $sell_subheader1; ?>
            	<img src="images/sellcart.png" id="cartHeaderImg" />
            </div>
            <div id="cartList">
                <?php
                    $transaction = $_SESSION['transaction'];
                    //echo $transaction;
					//echo "<br />";
                    showCartByTransaction($transaction, "sell");
                ?>
            </div>
        </div>
        
    </div>
   
    
   	
    
    
</div>

<br />
<?php
 include 'foot.php';

?>
