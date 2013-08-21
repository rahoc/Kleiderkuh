<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kleider Kuh</title>
<link rel="shortcut icon" href="http://www.kleiderkuh.de/favicon.ico?v=2" />
<link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700|Handlee' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Chela+One' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="jspdf/jspdf.js"></script>
<script type="text/javascript" src="jspdf/libs/Deflate/adler32cs.js"></script>
<script type="text/javascript" src="jspdf/libs/FileSaver.js/FileSaver.js"></script>
<script type="text/javascript" src="jspdf/libs/Blob.js/BlobBuilder.js"></script>
<script type="text/javascript" src="jspdf/jspdf.plugin.addimage.js"></script>
<script type="text/javascript" src="jspdf/jspdf.plugin.standard_fonts_metrics.js"></script>
<script type="text/javascript" src="jspdf/jspdf.plugin.split_text_to_size.js"></script>
<script type="text/javascript" src="jspdf/jspdf.plugin.from_html.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="script.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43204156-1', 'kleiderkuh.de');
  ga('send', 'pageview');

</script>
</head>
<body>
<?php
include 'clicktale/ct_top.php';
include 'language.php';
?>
  
    <div id="head">
    
    
        
        <div class="menubar">
        <?php
		
			$home = "";
			$sell = "";
			$transaction = "";
			$buy = "";
			
			switch($site) {
				case "home":
					$home = ", activenav";
					break;
				case "sell":
					$sell = ", activenav";
					break;
				case "transaction":
					$transaction = ", activenav";
					break;
				case "buy":
					$buy = ", activenav";
					break;
		
			}
			
            echo "<nav>
				<a class='menubar$home' href='home.php'>$head_link1</a>
              	<a class='menubar$sell' href='sell.php'>$head_link2</a>
				<a class='menubar$buy' href='#' id='opn_buy'>$head_link3</a>
              	<a class='menubar$transaction' href='goToTransaction.php'>$head_link4</a>
              	<a class='menubar$buy' href='#' onclick=\"openOverlay('HowItWorks.php')\">$head_link5</a>
			  
            	</nav>";
			
		?>

        </div>
        
        
        <div id="header">
			<a href="home.php">
           <img id='header_logo' src='images/<?php echo $langID; ?>/header.png' />
           </a>
        
        </div>
                
        <div class="line"></div>

        
       
        
    </div>
<div id="sidebar">
	<!--<a href="#" onclick="showFeedback()"><img src="images/sidebar.png" /></a>-->
    <!--onclick="showFeedback(); return false"-->
    <a href="#" id="opn_feedback"></a>
</div>

<div class="background" id="bkg_feedback" style="visibility: hidden;">
    <div class="modal" id="dlg_feedback" style="visibility: hidden;">
    	<div class="closebtn" title="Close" id="closebtn_feedback"></div>
      	<?php include 'feedback.php'; ?>
    </div>
  </div>
  
  <div class="background" id="bkg_buy" style="visibility: hidden;">
    <div class="modal" id="dlg_buy" style="visibility: hidden;">
    	<div class="closebtn" title="Close" id="closebtn_buy"></div>
      	<div id="dlg_buy_content"><?php include 'buy.php'; ?></div>
    </div>
  </div>
  
  
  
  <div class="background" id="bkg" style="visibility: hidden;">
    <div class="modal" id="dlg" style="visibility: hidden;">
    	<div class="closebtn" title="Close" id="closebtn"></div>
      	<div id="dlg_content"></div>
    </div>
  </div>

