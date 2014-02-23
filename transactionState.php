<?php
session_start();
$site = "transaction";
if(isset($_SESSION['transaction'])){
    $transactionId = $_SESSION['transaction'];
}
if(isset($_GET['transaction'])){
	$transactionId = $_GET['transaction'];
}
if(isset($_GET['email'])){
	$email = $_GET['email'];
}



require_once('head.php');
require_once('language.php');
?>




<div id="tab_view" class="center" style="display:none">
	<div id="transactionInfo">
        <div class="transactionLabel"><?php echo $trans_text1; ?></div>
        <div class="transactionValue" id="tinfo_id"></div>
        <div class="clear"></div> 
        <div class="transactionLabel"><?php echo $trans_text2; ?></div>
        <div class="transactionValue" id="tinfo_email"></div>
        <div class="clear"></div> 
        <div class="transactionLabel"><?php echo $trans_text3; ?></div>
        <div class="transactionValue" id="tinfo_status"></div>
        <div class="clear"></div>
    </div>

    <div id="tab_1" class="tab float_left">
    	<div class="tab_content">
    		<div class="tab_header center"><?php echo $trans_state_confirmed; ?></div>
            <div class="tab_image"></div>
            <div class="tab_date center">--</div>
            <div class="tab_arrow"></div>
        </div>
    </div>
	<div id="tab_2" class="tab float_left">
    	<div class="tab_content">
    		<div class="tab_header center"><?php echo $trans_state_received; ?></div>
            <div class="tab_image"></div>
            <div class="tab_date center">--</div>
            <div class="tab_arrow"></div>
        </div>
    </div>
    <div id="tab_3" class="tab float_left">
    	<div class="tab_content">
    		<div class="tab_header center"><?php echo $trans_state_processed; ?></div>
            <div class="tab_image"></div>
            <div class="tab_date center">--</div>
            <div class="tab_arrow"></div>
        </div>
    </div>
    <div id="tab_4" class="tab float_left">
    	<div class="tab_content">
    		<div class="tab_header center"><?php echo $trans_state_payment; ?></div>
            <div class="tab_image"></div>
            <div class="tab_date center">--</div>
            <div class="tab_arrow"></div>
        </div>
    </div>
    <div id="tab_5" class="tab float_left">
    	<div class="tab_content">
    		<div class="tab_header center"><?php echo $trans_state_finished; ?></div>
            <div class="tab_image"></div>
            <div class="tab_date center">--</div>
            <div class="tab_arrow"></div>
        </div>
    </div>

    <div id="tab_main">
    	<!-- CONFIRMED -->
        <div id="t_stat_1" class="hide align_left">
           	<p><?php echo $trans_text4; ?><span id="t_orderDate"></span></p>
            <p><?php echo $trans_text5; ?><span id="t_email"></span></p>
            <p><?php echo $trans_text6; ?></p>
            <img id="dhl_logo" src="images/dhl.png" />
            <p><?php echo $trans_text35; ?><span class="question quest_dhl"></span></p>
            <div id="dhl_form">
                <fieldset>
                <div class="tableRow"><div class="tableCell">
                    <label><?php echo $trans_label1; ?></label>
                </div><div class="tableCell">
                    <input type="text" id="fName" />
                </div></div>
                <div class="tableRow"><div class="tableCell">
                    <label><?php echo $trans_label2; ?></label>
                </div><div class="tableCell">
                    <input type="text" id="lName" />
                </div></div>
                <div class="tableRow"><div class="tableCell">
                    <label><?php echo $trans_label3; ?></label>
                </div><div class="tableCell">
                    <input type="text" id="street" />
                </div></div>
                <div class="tableRow"><div class="tableCell">
                    <label><?php echo $trans_label4; ?></label>
                </div><div class="tableCell">
                    <input type="text" id="streetNr" />
                </div></div>
                <div class="tableRow"><div class="tableCell">
                    <label><?php echo $trans_label5; ?></label>
                </div><div class="tableCell">
                    <input type="text" id="plz" />
                </div></div>
                <div class="tableRow"><div class="tableCell">
                    <label><?php echo $trans_label6; ?></label>
                </div><div class="tableCell">
                    <input type="text" id="city" />
                </div></div>
                <div class="tableRow"><div class="tableCell"> 
                </div><div class="tableCell">
                    
                    <input type='image' src='images/<?php echo $langID; ?>/buttons/versand.png'
                    class='button_medium' id='print_shipping' />
                    <div id="print_error" class="orange"></div>
                    <span id="quest_error_plz" class='question quest_dhl' style="display:none"></span>
					<br />
					
					
                </div></div>
                </fieldset>
                
            </div>
            <div id="dhl_info">
            	<?php echo $trans_text36; ?>
            </div>
            <div class="clear"></div>
            <p id="popups" class="orange" hidden="hidden"><?php echo $trans_text37; ?></p>
            <p id="download" class="cyan" hidden="hidden"><?php echo $trans_text38; ?></p>
        </div>
		<p id="testOutput"></p>
        <!-- RECEIVED -->
         <div id="t_stat_2" class="hide align_left">
           	<p><?php echo $trans_text8; ?><span id="t_receptionDate"></span></p>
            <p class="stateNr_2"><?php echo $trans_text9; ?></p>
         </div>
         <!-- PROCESSED -->
         <div id="t_stat_3" class="hide align_left">
           	<p><?php echo $trans_text21; ?><span id="t_processedDate"></span></p>
            <p><?php echo $trans_text22; ?></p>
            <div id="processed_cart">
            	<div class='tableRow'>
                    <div class='tableHeader'><?php echo $trans_th1; ?></div>
                    <div class='tableHeader'><?php echo $trans_th2; ?></div>
                    <div class='tableHeader'><?php echo $trans_th3; ?></div>
                    <div class='tableHeader'><?php echo $trans_th4; ?></div>
                    <div class='tableHeader'><?php echo $trans_th5; ?></div>
                    <div class='tableHeader'><?php echo $trans_th6; ?></div>
                    <div class='tableHeader'><?php echo $trans_th7; ?></div>
            	</div>
				<!-- auto generated table content -->
            </div>
            <p><?php echo $trans_text23; ?><span class="t_finalAmount"></span> €
            	<span id="t_returnFeeDeducted" class="return">
                	(<span id="t_sumAccepted"></span> € <?php echo $trans_text23b; ?>
                </span></p>
            <p class="rejected_items"><?php echo $trans_text24; ?></p>
            
            <p class="rejected_items"><?php echo $trans_text25; ?></p>
            <fieldset class="rejected_items">
            <input id='reject_donate' type="radio" name="rejectOptions" value="donate"  disabled="disabled" />
                        <?php echo $trans_label7; ?><br />
            <input id='reject_return' type="radio" name="rejectOptions" value="return"  disabled="disabled" />
                        <?php echo $trans_label8; ?>					
                        
              
              <div id='adress_box'  class="return">
                <div class="tableRow"><div class="tableCell">
            	<label><?php echo $trans_label1; ?></label>
            	</div><div class="tableCell">
                <input type="text" id="fName_reject" />
                </div></div>
                <div class="tableRow"><div class="tableCell">
                    <label><?php echo $trans_label2; ?></label>
                </div><div class="tableCell">
                    <input type="text" id="lName_reject" />
                </div></div>
                <div class="tableRow"><div class="tableCell">
                    <label><?php echo $trans_label3; ?></label>
                </div><div class="tableCell">
                    <input type="text" id="street_reject" />
                </div></div>
                <div class="tableRow"><div class="tableCell">
                    <label><?php echo $trans_label4; ?></label>
                </div><div class="tableCell">
                    <input type="text" id="streetNr_reject" />
                </div></div>
                <div class="tableRow"><div class="tableCell">
                    <label><?php echo $trans_label5; ?></label>
                </div><div class="tableCell">
                    <input type="text" id="plz_reject" />
                </div></div>
                <div class="tableRow"><div class="tableCell">
                    <label><?php echo $trans_label6; ?></label>
                </div><div class="tableCell">
                    <input type="text" id="city_reject" />
                </div></div>
                <div class="tableRow"><div class="tableCell"> 
                </div><div class="tableCell">
                    
                </div></div>
              </div>
              <div id="notifyProcessingRejection" class="cyan"><br />	<?php echo $trans_text39; ?></div>
              <div id="error_on_submit" class="orange"></div>
                    <input type='image' src='images/<?php echo $langID; ?>/buttons/submit.png' 
                    class='button_medium' id='submit_rejectOption' disabled="disabled"/>
            </fieldset>
            
         </div>
         <!-- PAYMENT -->
         <div id="t_stat_4" class="hide align_left">
             <div class="nagativeAmount">
                <p><?php echo $trans_text26; ?><span id="t_rejectOption"></span></p>
                <p class="return"><?php echo $trans_text29; ?><span class="t_finalAmount"></span> €</p>
                <p class="return"><?php echo $trans_text30a; ?><span id="t_finalAmountAbs"></span>
                    <?php echo $trans_text30b; ?><span id="t_id"></span>
                    <br /><?php echo $trans_text31; ?></p>
             </div>
             <div class="positiveAmount">
                <p><?php echo $trans_text10; ?><span id="t_finalToPay"></span> €</p>
                <p><?php echo $trans_text11; ?><span id="t_paymentMethod"></span></p>
                <p><?php echo $trans_text12; ?><span id="t_paymentDate"></span></p>
                <p><?php echo $trans_text13; ?></p>
            </div>
         </div>
         <!-- FINISHED -->
         <div id="t_stat_5" class="hide align_left">
           	<p><?php echo $trans_text16; ?><span id="t_finishedDate"></span></p>
            <p><?php echo $trans_text17; ?><span id="t_finalToPayFin"></span> €</p>
            <p class="open_tab_3"><?php echo $trans_text18; ?><span id="t_acceptedItems"></span></p>
            <p id="t_rejectedItems_label" class="open_tab_3"><?php echo $trans_text19; ?>
       	   <span id="t_rejectedItems"></span></p>
            <p id="t_missingItems_label" class="open_tab_3"><?php echo $trans_text20; ?>
       	   <span id="t_missingItems"></span></p>
         </div>
         
         
    </div>


</div>
<iframe id="downloadframe" style="display:none"></iframe>
<div id="tt_dhl" class="tooltip" style="display:none"><?php echo $trans_tooltip1; ?></div>
<script>

var transaction;
var new_sum = 0;
var language;

function getDateGerman(d) {
	var ndate = new Date(d);
	return ndate.getDate() + "." + (ndate.getMonth()+1) + "." + ndate.getFullYear();
}

$(document).ready(function() {
	<?php
		if (isset($transactionId)) {
			$tid = $transactionId;
		}
		else {
			$tid = 0;
		}
		$confirmed = 0;
		if (isset($_GET["confirm"])) {
			if ($_GET["confirm"]==true) {
				$confirmed = 1;
				session_destroy();
			}
		}
		
	?>
	var id = <?php  echo $tid; ?>;

	$(".tab_arrow").hide();
	$(".hide").hide();
	
	
	var confirmed = <?php echo $confirmed; ?>;
	var email = "<?php echo $email; ?>";
	language = "<?php echo $langID; ?>";

	// CHECK CONFIRM
	if (confirmed == 1) {

	var c = "Confirmed";
	$.post('changeTransactionState.php', { id: id , status: c, language: language })
	.done(function(data) {
		//alert("transactionState.php?email=" + email + "&id=" + id + "");
		 window.location.replace("transactionState.php?email=" + email + "&transaction=" + id + "" + "&language=" + language + "");
	}); } // END CONFIRMED TRUE 
	//alert(id);
	
	// LOAD TRANSACTION
	$.post("getTransaction.php", { id: id })
		.done(function(json) {
			//alert( json );
			if (json.substr(0,5) == "error") {
				window.location.replace("goToTransaction.php?error=true");
				return;
			}
			
			transaction = JSON.parse(json);
			//alert(transaction.email  + " <?php  echo $email; ?>");
			var emailadresslogin = "<?php  echo $email; ?>";
			if (transaction.email.toLowerCase() != emailadresslogin.toLowerCase()) {
				window.location.replace("goToTransaction.php?error=true");
				return;
			}
			
			// Dates:
			var orderDate = new Date(transaction.OrderDate);
			
			$("#tab_view").show();
			var status_id = transaction.statusNumber;
			if (status_id >= 1) {
				$("#tab_1").addClass("tab_active");
				$("#tab_1").children().children(".tab_date").text(getDateGerman(transaction.OrderDate));
				
				// FILL CONTENT
				
				$("#t_orderDate").text(getDateGerman(transaction.OrderDate));
				$("#t_email").text(transaction.email);
				$("#fName").val(transaction.fname);
				$("#lName").val(transaction.lname);
				$("#street").val(transaction.street);
				$("#streetNr").val(transaction.streetNr);
				if (transaction.plz > 0) {
					$("#plz").val(transaction.plz);
				}
				$("#city").val(transaction.city);
						$("#fName_reject").val(transaction.fname);
						$("#lName_reject").val(transaction.lname);
						$("#street_reject").val(transaction.street);
						$("#streetNr_reject").val(transaction.streetNr);
						if (transaction.plz > 0) {
							$("#plz_reject").val(transaction.plz);
						}
						$("#city_reject").val(transaction.city);
			}
			if (status_id >= 2) {
				$("#tab_2").addClass("tab_active");
				$("#tab_2").children().children(".tab_date").text(getDateGerman(transaction.ReceptionDate));
				
				// FILL CONTENT
				$("#t_receptionDate").text(getDateGerman(transaction.ReceptionDate));
			}
			if (status_id >= 3) {
				$("#tab_3").addClass("tab_active");
				$("#tab_3").children().children(".tab_date").text(getDateGerman(transaction.ProcessedDate));
				$(".stateNr_2").hide();
				
				// FILL CONTENT
				var sumAcc = 0;
				if (transaction.sumAccepted > 0) {
					sumAcc = transaction.sumAccepted;
				}
				$("#t_processedDate").text(getDateGerman(transaction.ProcessedDate));
				if(status_id==3 && transaction.RejectOption == "undefined") {
					$(".t_finalAmount").text(parseFloat(sumAcc).toFixed(2));
				}
				else {
					$(".t_finalAmount").text(parseFloat(transaction.finalToPay).toFixed(2));
				}
				
				// show cart
				var clothes =transaction.clothes;
				
				$.each( clothes, function( key, value ) {
					var processResult= "not processed";
					var colorizeOrange = "";
					if (value.accepted==1) {
						 processResult = "<?php echo $trans_text32; ?>";
					}
					else if (value.rejected==1) {
						processResult = "<?php echo $trans_text33; ?>";
						colorizeOrange = " orange_background";
					}
					else if (value.missing==1) {
						processResult =  "<?php echo $trans_text34; ?>";
						colorizeOrange = " orange_background";
					}
					var tableRow = "<div class='tableRow"+colorizeOrange+"' >" + 
									"<div class='tableCell tableFormat'>" +
									value.gender +
									"</div><div class='tableCell tableFormat'>" +
									value.brand +
									"</div><div class='tableCell tableFormat'>" +
									value.type +
									"</div><div class='tableCell tableFormat'>" +
									value.size +
									"</div><div class='tableCell tableFormat'>" +
									parseFloat(value.price).toFixed(2) + " €" +
									"</div><div class='tableCell tableFormat'>" +
									processResult +
									"</div><div class='tableCell tableFormat'>" +
									value.comment +
									"</div></div>";
					$("#processed_cart").append(tableRow);
					
				});
				
				if(transaction.RejectOption == "return") {
					$("#t_sumAccepted").text(parseFloat(transaction.sumAccepted).toFixed(2));
					$("#t_rejectOption").text("<?php echo $trans_text27; ?>");
						
					$(".return").show();
					$("#reject_return").attr("checked", "checked");
					//$("#adress_box").hide();
					$("#submit_rejectOption").hide();
					$("#notifyProcessingRejection").show();
				}
				else if (transaction.RejectOption == "donate") {
					$("#t_rejectOption").text("<?php echo $trans_text28; ?>");
					$(".return").hide();
					$("#reject_donate").attr("checked", "checked");
					$("#adress_box").hide();
					$("#submit_rejectOption").hide();
					$("#notifyProcessingRejection").show();
				}
				else {
					$(".return").hide();
					$(".rejectOption").hide();
					$("#reject_donate").removeAttr("disabled");
					$("#reject_return").removeAttr("disabled");
					$("#submit_rejectOption").removeAttr("disabled");
					$("#notifyProcessingRejection").hide();
				}
				$("#t_id").text(transaction.id);
				$("#t_finalAmountAbs").text(Math.abs(parseFloat(transaction.finalToPay).toFixed(2)));
				
				var rejectedItems = transaction.rejectedItems; // Removed: + transaction.missingItems; as it should if no rejected items behave like accepted
				if (rejectedItems <=0) {
					$(".rejected_items").hide();
				}

			}
			if (status_id >= 4) {
				$("#tab_4").addClass("tab_active");
				
				$("#notifyProcessingRejection").hide();
				// FILL CONTENT
				$("#t_finalToPay").text(parseFloat(transaction.finalToPay).toFixed(2));
				if (transaction.payment == "ueberweisung") {
					$("#t_paymentMethod").text("<?php echo $trans_text14; ?> (" +
					transaction.accountNrMasked + ")");
				}
				if (transaction.payment == "paypal") {
					$("#t_paymentMethod").text("<?php echo $trans_text15; ?> (" +
					transaction.PaypalMail + ")");
				}
				$("#t_paymentDate").text(getDateGerman(transaction.PaymentDate));
				
				if(transaction.finalToPay>=0) {
					$(".positiveAmount").show();
					$(".nagativeAmount").hide();
				}
				else {
					$(".positiveAmount").hide();
					$(".nagativeAmount").show();
				}
			}
			if (status_id >= 5) {
				$("#tab_5").addClass("tab_active");
				$("#tab_4").children().children(".tab_date").text(getDateGerman(transaction.PaymentDate));
				$("#tab_5").children().children(".tab_date").text(getDateGerman(transaction.FinishedDate));
				
				// FILL CONTENT
				$("#t_finishedDate").text(getDateGerman(transaction.FinishedDate));
				$("#t_finalToPayFin").text(parseFloat(transaction.finalToPay).toFixed(2));
				$("#t_acceptedItems").text(transaction.acceptedItems);
				if (transaction.rejectedItems > 0) {
					$("#t_rejectedItems").text(transaction.rejectedItems);
				}
				else {
					$("#t_rejectedItems").hide();
					$("#t_rejectedItems_label").hide();
				}
				if (transaction.missingItems > 0) {
					$("#t_missingItems").text(transaction.missingItems);
				}
				else {
					$("#t_missingItems").hide();
					$("#t_missingItems_label").hide();
				}
				
			}
			
			$("#tab_" + status_id).children().children(".tab_arrow").show();
			$("#tab_" + status_id).addClass("tab_selected");
			$("#t_stat_" + status_id).show();
			
			// FILL INFO
			$("#tinfo_id").text(transaction.id);
			$("#tinfo_email").text(transaction.email);
			
			// STATUS
			var statusname = "";
			if (language != "en") {
				if(transaction.status.toLowerCase() == "confirmed") {
					statusname = "Verschicken";
				}
				else if(transaction.status.toLowerCase() == "received") {
					statusname = "Sendung Empfangen";
				}
				else if(transaction.status.toLowerCase() == "processed") {
					statusname = "Bearbeitet";
				}
				else if(transaction.status.toLowerCase() == "waiting for customer") {
					statusname = "Warten auf Kunde";
				}
				else if(transaction.status.toLowerCase() == "donate") {
					statusname = "Spenden";
				}
				else if(transaction.status.toLowerCase() == "return") {
					statusname = "Rücksendung";
				}
				else if(transaction.status.toLowerCase() == "waiting for payment") {
					statusname = "Warten auf Zahlung";
				}
				else if(transaction.status.toLowerCase() == "payment") {
					statusname = "Bezahlung";
				}
				else if(transaction.status.toLowerCase() == "canceled") {
					statusname = "Storniert";
				}
				else if(transaction.status.toLowerCase() == "finished") {
					statusname = "Abgeschlossen";
				}
				$("#tinfo_status").text(statusname);
			}
			else {
				$("#tinfo_status").text(transaction.status);
			}
			
			
			
		}); // END LOAD JSON
		

	
}); // document.ready

$("#tab_1").click(function() {
	if($(this).hasClass("tab_active")) {
		$(".hide").hide();
		$(".tab").removeClass("tab_selected");
		$("#tab_1").addClass("tab_selected");
		$("#t_stat_1").show();
	}
});
$("#tab_2").click(function() {
	if($(this).hasClass("tab_active")) {
		$(".hide").hide();
		$(".tab").removeClass("tab_selected");
		$("#tab_2").addClass("tab_selected");
		$("#t_stat_2").show();
	}
});
$("#tab_3").click(function() {
	if($(this).hasClass("tab_active")) {
		$(".hide").hide();
		$(".tab").removeClass("tab_selected");
		$("#tab_3").addClass("tab_selected");
		$("#t_stat_3").show();
	}
});
$(".open_tab_3").click(function() {
	if($("#tab_3").hasClass("tab_active")) {
		$(".hide").hide();
		$(".tab").removeClass("tab_selected");
		$("#tab_3").addClass("tab_selected");
		$("#t_stat_3").show();
	}
});
$("#tab_4").click(function() {
	if($(this).hasClass("tab_active")) {
		$(".hide").hide();
		$(".tab").removeClass("tab_selected");
		$("#tab_4").addClass("tab_selected");
		$("#t_stat_4").show();
	}
});
$("#tab_5").click(function() {
	if($(this).hasClass("tab_active")) {
		$(".hide").hide();
		$(".tab").removeClass("tab_selected");
		$("#tab_5").addClass("tab_selected");
		$("#t_stat_5").show();
	}
});

// SHIPPING
$("#print_checklist").click(function() {
	
});

$("#print_shipping").click(function() {
	$("#print_error").empty();
	$("#quest_error_plz").hide();
	$("#download").attr("hidden", "hidden");
	
	var fname = $("#fName").val();
	var lname = $("#lName").val();
	var street = $("#street").val();
	var streetNr = $("#streetNr").val();
	var plz = $("#plz").val();
	var city = $("#city").val();

	if (fname == "" || 
		lname == "" || 
		street == "" || 
		streetNr == "" || 
		plz == "" || 
		city == "" ) {
			$("#print_error").text("<?php echo $trans_error1; ?>");
			return;
	}
	if (isNaN(plz)) {
		$("#print_error").text("<?php echo $trans_error2; ?>");
		$("#quest_error_plz").show();
		return;
	}
	
	if (!(plz.toString().length==5)) {
		$("#print_error").text("<?php echo $trans_error2; ?>");
		$("#quest_error_plz").show();
		return;
	}
	
	// Steingasse 6a should be allowed
	/*if (isNaN(streetNr)) {
		$("#print_error").text("<?php echo $trans_error3; ?>");
		return;
	}*/
	
	if (!(streetNr.toString().length<=5)) {
		$("#print_error").text("<?php echo $trans_error3; ?>");
		return;
	}
	
	var url2 = createShippingPDF(transaction);
	//window.open(url2, '', '_blank');
	//openPopUp(url2);
	var url = "getShippingLabel.php?" + 
	"fname=" +	fname + 
	"&lname=" + lname +
	"&street=" + street +
	"&streetNr=" + streetNr +
	"&plz=" + plz +
	"&city=" + city +
	"&id=" + transaction.id;
	//window.open(url, '', '_blank');
	//openPopUp(url);
	
	//alert (url);
	//alert (url2);
	
	/*$.post("http://kleiderkuh.de/storeList.php", {
				id: transaction.id , 
				pdf: url2
			})
		.done(function(data) {
			alert("stored checklist " + data);	
		});*/
	
	
	$.get(url, function(data) {
	  /*var mergeUrl = "http://goessinger.eu/merge.php?url1="+ data +"&url2="+ url2
	  $("#testOutput").text(mergeUrl);
	  alert(mergeUrl);
	  window.open(mergeUrl, '', '_blank');*/
	  
	  /*$("#testOutput").text("send to http://goessinger.eu/merge.php url1: " +data + " url2:" + url2);
	  $.post("http://goessinger.eu/merge.php", {
				url1: data,
				url2: url2
			})
		.done(function(data) {
			$("#testOutput").text(data + " " + url2);
			alert("post received " + data);	
			window.open(data, '', '_blank');
		});*/
		
	
	  //$.post("getPDFFromMerge.php", {
		$.post("merge.php", {
				url1: data,
				url2: url2
			})
		.done(function(data) {
			//$("#testOutput").text(data);
			//window.open(data, '', '_blank');
			var ifrm = document.getElementById('downloadframe');
    		ifrm.src = "download.php?path=" +  data;
			$("#download").removeAttr("hidden");
			$("#print_shipping").attr("src", "images/"+language+"/buttons/versand.png");
			$("#popups").attr("hidden", "hidden");
			//window.location.href = "http://goessinger.eu/" + data;
			//window.location = "http://goessinger.eu/" + data;
			
		});
	});

	
	
	
	
	//var mergeUrl = "http://goessinger.eu/merge.php?url1="+ url +"&url2="+ url2
	
	$("#print_shipping").attr("src", "images/load_button.gif");
	$("#popups").removeAttr("hidden");
});

//PROCESSED
$("#reject_donate").click(function() {
	var sumAcc = 0;
	if (transaction.sumAccepted > 0) {
		sumAcc = transaction.sumAccepted;
	}
	new_sum =sumAcc;
	$(".t_finalAmount").text(parseFloat(new_sum).toFixed(2));
	$(".return").hide();
});
$("#reject_return").click(function() {
	var sumAcc = 0;
	if (transaction.sumAccepted > 0) {
		sumAcc = transaction.sumAccepted;
	}
	new_sum = Math.round((Math.round(sumAcc*100)/100-5)*100)/100;
	$("#t_sumAccepted").text(sumAcc);
	$(".t_finalAmount").text(new_sum);
	$(".return").show();
});
$("#submit_rejectOption").click(function() {
	$("#error_on_submit").empty();
	
	var id = transaction.id;
	var reject_option = $("input[name='rejectOptions']:checked").val();
	
	var fname = $("#fName_reject").val();
	var lname = $("#lName_reject").val();
	var street = $("#street_reject").val();
	var streetNr = $("#streetNr_reject").val();
	var plz = $("#plz_reject").val();
	var city = $("#city_reject").val();
	var isFormCheck = false;
	
	if (reject_option != "donate") {
		isFormCheck = true;
	}

	if (isFormCheck) {
		
		if (fname == "" || 
			lname == "" || 
			street == "" || 
			streetNr == "" || 
			plz == "" || 
			city == "" ) {
				$("#error_on_submit").text("<?php echo $trans_error1; ?>");
				return;
			}
		if (isNaN(plz)) {
			$("#error_on_submit").text("<?php echo $trans_error2; ?>");
			return;
		}
		
		if (!(plz.toString().length==5)) {
			$("#error_on_submit").text("<?php echo $trans_error2; ?>");
			return;
		}
		
	}
	
	$.post("updateTransaction.php", {
				id: id , 
				reject_option: reject_option,
				rejection_submit: "true",
				fname: fname,
				lname: lname,
				street: street,
				streetNr: streetNr,
				plz: plz,
				city: city
			})
	.done(function(data) {
		
		  if ( data == "success" ) {
			  $("#reject_return").attr("disabled", "disabled");
			  $("#reject_donate").attr("disabled", "disabled");
			  $("#rejection_submit").attr("disabled", "disabled");
			  $("#submit_rejectOption").hide();
			  $("#notifyProcessingRejection").show();
		  }
		  else {
			  $("#error_on_submit").text("No success returned!");
		  }
		  
		  
		 var status;
		 
		 //alert (new_sum[5]);
		 // Set STATUS
		 if (reject_option == "return") {
			 new_sum = transaction.sumAccepted-5;
		 }
		 else {
			new_sum = transaction.sumAccepted; 
		 }
		 
		 if (new_sum < 0 ) {
			 status = "Waiting for payment";
		 }
		 else {			 
			 if (reject_option == "donate") {
				 status = "Donate";
			 }
			 else if (reject_option == "return") {
				 status = "Return";
			 }
			 else {
				status = "Payment";
			 }
		 }
		 
		 //alert(status);
		$.post("changeTransactionState.php", { id: id , status: status })
		.done(function(data) {
		  //alert("Data Loaded: " + data);
		  location.reload();
		  //$( "#result" ).empty().append( data );
		});
	});
});


// Mouseover on questionmark
$(".quest_dhl").mouseenter(function(e) {
	$("#tt_dhl").css({top: e.pageY-160, bottom: e.pageY-2, left: e.pageX+2});
	$("#tt_dhl").show();
	
});
$(".quest_dhl").mouseleave(function() {
	$("#tt_dhl").hide();
});

</script>
<?php require_once('foot.php'); ?>


