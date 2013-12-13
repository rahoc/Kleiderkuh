<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CopyAndPaste</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<p>Paste sheet here:</p>
<textarea id="excel_data"></textarea>
<div id="excel_table"></div>
<script>
$('#excel_data').change(function() {

	var data = $('#excel_data').val();
	var rows = data.split("\n");
	
	var table = $('<table />');
	
	for(var y in rows) {
		var cells = rows[y].split("\t");
		var row = $('<tr />');
		for(var x in cells) {
			row.append('<td>'+cells[x]+'</td>');
		}
		table.append(row);
	}
	
	// Insert into DOM
	$('#excel_table').html(table);
});
</script>
<body>
</body>
</html>