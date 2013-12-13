<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Insert new Brand</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>

<body>

<form enctype="multipart/form-data" id="brandForm" action="insertNewBrand.php" method="post">
<?php
	require_once('../db.php');

	$verbindung = connectDB();
	
	echo "<h1>Insert a new Brand</h1>";
	echo "<table>";
	echo "<tr>";
	echo "<td>Brand Name (no special characters!)</td>";
	echo "<td><input class='required' type='text' name='brandName' /></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Key Words (no special characters! Splitted with a blank.)</td>";
	echo "<td><input class='required' type='text' name='brandKeywords' /></td>";
	echo "</tr>";
	echo "</table>";
		
		
?>

<p>Paste sheet here (No characters!, Decimal with "."):</p>
<textarea id="excel_data"></textarea>
<div id="excel_table"></div>
<script>
$('#excel_data').change(function() {

	var data = $('#excel_data').val();
	var rows = data.split("\n");
	
	var table = $('<table />');
	var count = 1;
	for(var y in rows) {
		var cells = rows[y].split("\t");
		for(var x in cells) {
			$("#input" + count).val(cells[x]);
			count++;
		} 
	}
	
	// Insert into DOM
	$('#excel_table').html(table);
});
</script>

<?php
	$abfrageG = "SELECT * FROM Gender";	
	$ergebnisG = mysql_query($abfrageG);
	$counti = 1;
	while($rowG = mysql_fetch_object($ergebnisG))
	{
		echo "<h2>$rowG->Name</h2>";
		echo "<table>";
		echo "<tr>";
		echo "<th>Name</th>";
		echo "<th>MaxAmount</th>";
		echo "<th>Price</th>";
		echo "</tr>";
		$abfrageT = "SELECT * FROM Type";	
		$ergebnisT = mysql_query($abfrageT);
		
		while($rowT = mysql_fetch_object($ergebnisT))
		{
			echo "<tr>";
			echo "<td>$rowT->Name</td>";
			echo "<td><input id='input$counti' class='required' type='text' name='maxAmount" . $rowG->Id . $rowT->Id . "' /></td>";
			$counti = $counti + 1;
			echo "<td><input id='input$counti' class='required' type='text' name='price" . $rowG->Id . $rowT->Id . "' /></td>";
			echo "</tr>";
			$counti = $counti + 1;
		}
		echo "</table>";
	}
	
	
	
?>

<!-- MAX_FILE_SIZE muss vor dem Dateiupload Input Feld stehen -->
<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
<!-- Der Name des Input Felds bestimmt den Namen im $_FILES Array -->
Upload brand image (.png, 80x40px): <input name="brandimage" type="file" />
<input type="submit" value="Submit" />

</form>

<script>

$("#brandForm").submit(function(){
    var isFormValid = true;

    $(".required").each(function(){
        if ($.trim($(this).val()).length == 0){
            isFormValid = false;
        }
    });

    if (!isFormValid) alert("Please fill in all the required fields");

    return isFormValid;
});

</script>

</body>
</html>
