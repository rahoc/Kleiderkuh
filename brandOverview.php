<?php
	include 'language.php';
?>
<div class="headline"><?php echo $brands_headline1; ?></div>
<div class="subheader cyan"><?php echo $brands_subheader1; ?></div>
<div id="brand_overview">
<?php
	require_once('db.php');

	$verbindung = connectDB();
	$count = 0;
	// Check if Brand exists?
	$query = "SELECT Name FROM Brand ORDER BY Name";
	$result = mysql_query($query);
	while($row = mysql_fetch_object($result))
	{
		if ($count % 4 == 0 && $count > 0) {
			echo '</div>';
		}
		if ($count % 4 == 0) {
			echo '<div class="selcolumn brandO_col_margin">';
		}

		$brandName = $row->Name;
		// echo "Brand: $brandName <br />";
		echo '<div class="select brandO_sel_margin">';
			echo '<div class="brandimage_wrapper">';
				echo '<img src="images/brands/'.substr($brandName, 0 , 4).'.png" class="brandimages">';
			echo '</div>';
    	echo '</div>';

		$count = $count + 1;
	}
?>

</div>

<div class="sell_now clear padding_top_30">
        <a href="sell.php" class="sell_now_button" class="center" onClick="trackOutboundLink(this, 'Interested to Sell', 'Brand overlay', 'jump to sell page'); return false;">
		<img src="images/<?php echo $langID; ?>/buttons/sellNow.png" class="button" />
        </a>
</div>