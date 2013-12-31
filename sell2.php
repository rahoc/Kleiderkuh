<link rel="stylesheet" type="text/css" href="dialogs.css">
<script src="watermark.js"></script>
<?php
session_start();
 
 
 
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
  //Debug
 // echo getTransactionId();
 //echo $_SESSION['transaction'];
 if(isset($_SESSION['transaction'])){
	 //$_SESSION['transaction'] = getTransactionId();
	 //echo "tid was set";
 }
 else {
 	//$_SESSION['transaction'] = getTransactionId();
	
	$verbindung = connectDB();
	
	$newTransactionId = 1;
	$abfrage = "SELECT * FROM Transactions
				WHERE id= (SELECT MAX(id) FROM Transactions)";
	$ergebnis = mysql_query($abfrage);
	while($row = mysql_fetch_object($ergebnis))
	{
		$newTransactionId = $row->id + 1;
	}
	
	$abfrage2 = "INSERT INTO Transactions (id, Status) VALUES (".$newTransactionId.", 'InCart')";
	mysql_query($abfrage2);
	
	closeDB($verbindung);
	$_SESSION['transaction'] = $newTransactionId;
	//echo $newTransactionId;
	
	//echo "tid new";
 }
 
?>

<?php
/*##########################################
#	Browsercheck
##########################################*/
if(preg_match('/(?i)msie [1-9][^0-9]/',$_SERVER['HTTP_USER_AGENT']))
{
	echo "<div id='browser_check' class='center'><p>Du verwendest Microsoft Internet Explorer in einer alten Version (<10). Es kann darum sein, dass du Probleme bei der Verwendung von Kleider Kuh hast. Bitte verwende einen alternativen Browser oder aktualisiere deinen.</p></div>";
}
/*##########################################
#	End Browsercheck
##########################################*/
?>

	<div class="headline center noBottomMargin"><?php echo $sell_headline1; ?></div>
    
	<div id="condition_text" class="center" onclick="openOverlay('Requirements.php')">
    	<a href="#" class="cyan"><?php echo $sell_link1; ?></a>
    </div>
    
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
    
    

<div id="content">

    
    
	<script>
		// Initial show Brand selection (changed from Gender 18.11.2013)
		showTable('Brand');
    </script>

    <div id="selector">
    
        <div id="selectorColumns">
            <div id="Brand" class="selcolumn">
            </div>
            <div id="Gender" class="selcolumn"></div>
            <div id="Type" class="selcolumn">
            </div>
            <div id="Size" class="selcolumn">
            </div>
        </div>
        <style>
			.first {
				left:calc(38% - 150px);
			}
			.second {
				left:calc(38% - 300px);
			}
			.third {
				left:calc(38% - 450px);
			}
		</style>
<script>
	$(document).ready(function(e) {
		$("#Gender").hide(1);
		$("#Type").hide(1);
		$("#Size").hide(1);
	});
	$("#Brand").click(function(event) {

		if(event.target.id=="brandSearch") {
			resetAkkordean();
			return;
		}
		if(event.target.className=="select" || event.target.className=="selectActive" || event.target.className=="brandimage_wrapper" || event.target.className=="brandimages") {

			if($("#Brand").hasClass("second") || $("#Brand").hasClass("third")) {
				$("#Brand").removeClass("third");
				$("#Brand").removeClass("second");
				$("#Gender").removeClass("second");	
				$("#Gender").removeClass("first");	
				$("#Type").removeClass("first");
				$("#Type").hide(1);
				$("#Size").hide(1);	
			}
			$("#Brand").addClass("first");	
			$("#Gender").show(100);	
		}
	});
	$("#Gender").click(function(event) {
		if(event.target.className=="select" || event.target.className=="selectActive" || event.target.className=="brandimage_wrapper" || event.target.className=="genderimages") {
			if($("#Gender").hasClass("second") ) {
				$("#Brand").removeClass("third");
				$("#Brand").addClass("second");
				$("#Gender").removeClass("second");	
				$("#Type").removeClass("first");
				$("#Size").hide(1);	
			}
			$("#Brand").removeClass("first");	
			$("#Brand").addClass("second");	
			$("#Gender").addClass("first");	
			$("#Type").show(100);		
		}
	});
	$("#Type").click(function(event) {
		if(event.target.className=="select" || event.target.className=="selectActive" || event.target.className=="brandimage_wrapper" || event.target.className=="brandimages" || event.target.className=="typeimages") {
			$("#Brand").removeClass("second");	
			$("#Brand").addClass("third");
			$("#Gender").removeClass("first");		
			$("#Gender").addClass("second");
			$("#Type").addClass("first");		
			$("#Size").show(100);
		}
	});
	
</script>


        <div id="result" class="selcolumnResult" style="visibility:hidden;"> 
            <?php echo $sell_text6; ?>
            <br />
            <br />
            
            <?php echo $sell_text8; ?>
            <div id="selectedBrand" class="resultBoxes"></div>
            <?php echo $sell_text7; ?>
            <div id="selectedGender" class="resultBoxes"></div>
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
        
        <div id="cart" class="selcolumnCart">
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

	<div class="background" id="bkg_brandList" style="visibility: hidden;">
        <div class="modalCentered" id="dlg_brandList" style="visibility: hidden;">
            <div class="closebtn" title="Close" id="closebtn_brandList"></div>
            <div id="dlg_brandList_content"><?php include 'brandList.php'; ?></div>
        </div>
	</div>


<?php
 include 'foot.php';

?>
