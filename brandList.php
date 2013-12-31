<?php
	include 'language.php';
?>
<div class="headline"><?php echo $brands_headline1; ?></div>
<div class="subheader cyan"><?php echo $brands_subheader1; ?></div>

<div class="brandListLinks">
<a href='#' onclick='showBrandList("all"); return false;'><?php echo $brandList3; ?></a>
<?php
	for($i=65;$i<91;$i++) {
		$char = chr($i);
		echo "<a href='#' onclick='showBrandList(\"$char\"); return false;'>" . $char . "</a>   ";
	}
?>
<a href='#' onclick='showBrandList("misc"); return false;'><?php echo $brandList2; ?></a>
</div>
    <div id="brandList">
    <?php
        require_once('db.php');
    
        $verbindung = connectDB();
        $count = 0;
		
		$letterColumns;
		
        // Check if Brand exists?
        $query = "SELECT Name FROM Brand WHERE LEFT(Name,1) REGEXP '^[A-z]' ORDER BY Name";
        $result = mysql_query($query);

		$LastCapitalLetter = "_";
		$count = 0;
		$newLetter = -1;
        while($row = mysql_fetch_object($result))
        {
			$ActualCapitalLetter = strtoupper(substr($row->Name,0,1));
			
			
			if($LastCapitalLetter != $ActualCapitalLetter) {
				$count = 0;
				$newLetter++;
			}
			
			while (chr(65+$newLetter) != $ActualCapitalLetter) {
				$newLetter++;
			}
			
			$LastCapitalLetter = $ActualCapitalLetter;
			
			$letterColumns[$newLetter][$count] = $row->Name;
			$count++;
        } // end while query
    
	
		$query = "SELECT Name FROM Brand WHERE LEFT(Name,1) NOT REGEXP '^[A-z]' ORDER BY Name";
        $result = mysql_query($query);
		$specialLetters;
		while($row = mysql_fetch_object($result))
        {
			$specialLetters[] = $row->Name;
		}
		

		$columnOffset = 0;
		$row = 0;
	?>
    
    <table>
    
    <?php for($columnOffset=0; $columnOffset <= 24 ; $columnOffset = $columnOffset + 4) { ?>
    <tr>
    	<td><strong><?php echo chr(65+$columnOffset); ?></strong></td>
        <td><strong><?php echo chr(65+$columnOffset+1); ?></strong></td>
        <?php
		if ($columnOffset > 20) {?>
			<td><?php echo "<strong>" . $brandList2 . "</strong>"; ?></td>
        	<td></td>
		<?php }
		else { ?>
            <td><strong><?php echo chr(65+$columnOffset+2); ?></strong></td>
        	<td><strong><?php echo chr(65+$columnOffset+3); ?></strong></td>
        <?php } ?>
    </tr>
    <tr>
    	<td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 0][$row]; ?></p></td>
        <td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 1][$row]; ?></p></td>
        <?php
		if ($columnOffset > 20) {?>
			<td><p class='brandList_selectBrand'><?php echo $specialLetters[$row]; ?></p></td>
        	<td></td>
		<?php }
		else { ?>
            <td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 2][$row]; ?></p></td>
            <td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 3][$row]; ?></p></td>
        <?php } ?>
    </tr>
    <?php $row++; ?>
    <tr>
    	<td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 0][$row]; ?></p></td>
        <td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 1][$row]; ?></p></td>
        <?php
		if ($columnOffset > 20) {?>
			<td><p class='brandList_selectBrand'><?php echo $specialLetters[$row]; ?></td>
        	<td></td>
		<?php }
		else { ?>
            <td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 2][$row]; ?></p></td>
            <td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 3][$row]; ?></p></td>
        <?php } ?>
    </tr>
    <?php $row++; ?>
    <tr>
    	<td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 0][$row]; ?></p></td>
        <td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 1][$row]; ?></p></td>
        <?php
		if ($columnOffset > 20) {?>
			<td><p class='brandList_selectBrand'><?php echo $specialLetters[$row]; ?></p></td>
        	<td></td>
		<?php }
		else { ?>
            <td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 2][$row]; ?></p></td>
            <td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 3][$row]; ?></p></td>
        <?php } ?>
    </tr>
    <?php $row++; ?>
    <tr>
    	<td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 0][$row]; ?></p></td>
        <td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 1][$row]; ?></p></td>
        <?php
		if ($columnOffset > 20) {?>
			<td><p class='brandList_selectBrand'><?php echo $specialLetters[$row]; ?></p></td>
        	<td></td>
		<?php }
		else { ?>
            <td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 2][$row]; ?></p></td>
            <td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 3][$row]; ?></p></td>
        <?php } ?>
    </tr>
    <?php $row++; ?>
    <tr>
    	<td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 0][$row]; ?></p></td>
        <td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 1][$row]; ?></p></td>
        <?php
		if ($columnOffset > 20) {?>
			<td><p class='brandList_selectBrand'><?php echo $specialLetters[$row]; ?></p></td>
        	<td></td>
		<?php }
		else { ?>
            <td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 2][$row]; ?></p></td>
            <td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 3][$row]; ?></p></td>
        <?php } ?>
    </tr>
    <?php $row++; ?>
    <tr>
    	<td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 0][$row]; ?></p></td>
        <td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 1][$row]; ?></p></td>
        <?php
		if ($columnOffset > 20) {?>
			<td><p class='brandList_selectBrand'><?php echo $specialLetters[$row]; ?></p></td>
        	<td></td>
		<?php }
		else { ?>
            <td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 2][$row]; ?></p></td>
            <td><p class='brandList_selectBrand'><?php echo $letterColumns[$columnOffset + 3][$row]; ?></p></td>
        <?php } ?>
    </tr>
    <?php $row++; ?>
    <tr>
    	<td><?php
        	if(count( $letterColumns[$columnOffset + 0]) > 5 ) {
				$char = chr(65+$columnOffset);
				echo "<a href='#' onclick='showBrandList(\"$char\"); return false;'>" . $brandList1 . $char . "...</a>";
            } ?>
		</td>
        <td><?php
        	if(count( $letterColumns[$columnOffset + 1]) > 5 ) {
				$char = chr(65+$columnOffset+1);
				echo "<a href='#' onclick='showBrandList(\"$char\"); return false;'>" . $brandList1 . $char . "...</a>";
            } ?>
        </td>
        <td><?php
        	if(count( $letterColumns[$columnOffset + 2]) > 5 ) {
				$char = chr(65+$columnOffset+2);
				echo "<a href='#' onclick='showBrandList(\"$char\"); return false;'>" . $brandList1 . $char . "...</a>";
            } ?>
        </td>
        <td><?php
        	if(count( $letterColumns[$columnOffset + 3]) > 5 ) {
				$char = chr(65+$columnOffset+3);
				echo "<a href='#' onclick='showBrandList(\"$char\"); return false;'>" . $brandList1 . $char . "...</a>";
            } ?>
        </td>
    </tr>
    <?php
    	$row=0; 
	} // end for
	?>
    </table>
    
    
    
    </div>
    
    <?php
	
	// Detailseiten
	for($i=65;$i<91;$i++) {
		$char = chr($i);
		echo "<div id=" . $char . " class='brandListDetail'><table>";
		echo "<tr><th>" . $char . "</th></tr>";
		$query = "SELECT Name FROM Brand WHERE LEFT(Name,1) REGEXP '^[". $char . strtolower($char) ."]' ORDER BY Name";
        $result = mysql_query($query);
		while($row = mysql_fetch_object($result))
        {
			echo "<tr><td><p class='brandList_selectBrand'>" . $row->Name . "</p></td></tr>";
		}
		echo "</table></div>";
    }
	// Sonstige
	echo "<div id='misc' class='brandListDetail'><table>";
	echo "<tr><th>" . $brandList2 . "</th></tr>";
	$query = "SELECT Name FROM Brand WHERE LEFT(Name,1) NOT REGEXP '^[A-z]' ORDER BY Name";
	$result = mysql_query($query);
	while($row = mysql_fetch_object($result))
	{
		echo "<tr><td><p class='brandList_selectBrand'>" . $row->Name . "</p></td></tr>";
	}
	echo "</table></div>";
	?>
    <div>
    	<br /><br />
        <a href='#' onclick='closeBrandList(); showFeedback();'><?php echo $sell_text4; ?></a>
    </div>
    
</div>

<script>
function closeBrandList() {
	$("#dlg_brandList").hide('800', "swing", function () { $("#bkg_brandList").fadeOut("500"); });
		$.get('brandList.php', function(data) {
		  $('#dlg_brandList_content').html(data);
		});
		brandListOpen = false;
}

$(document).ready(function(e) {
	
    $(".brandList_selectBrand").click(function() {
	//$('div#brandList').on('click', 'p', function() { 
		$("#brandSearch").val($(this).text());
		
		$("#dlg_brandList").hide('800', "swing", function () { $("#bkg_brandList").fadeOut("500"); });
		$.get('brandList.php', function(data) {
		  $('#dlg_brandList_content').html(data);
		});
		brandListOpen = false;
		
		showByCategory($(this).text(), 'Brand', 'undefined');
		
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
			
		//filterBrands(null, true);
		$(".select").hide();
		$(".selectActive").show();
		window.scroll(0, 300);
	});
	
});
</script>

