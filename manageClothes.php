<?php
	session_start();
	$transaction = $_SESSION['transaction'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	$transaction = $_SESSION['transaction'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kleider Kuh</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="script.js"></script>

</head>
<body>
<?php
 //include 'head.php';
 
    
?>
<form action='manageClothes.php' method='post'>

<div id="editToolbar">
	<h2>Manage Clothes</h2>
   
<?php

	$genderFilter =	$_POST["genderFilter"];
	$brandFilter =	$_POST["brandFilter"];
	$typeFilter =	$_POST["typeFilter"];
	$sizeFilter =	$_POST["sizeFilter"];
	
    echo "<label>Filter Gender:</label>
    <input type='text' name='genderFilter' value='$genderFilter' size='10' />
    <label>Filter Brand:</label>
    <input type='text' name='brandFilter' value='$brandFilter' size='10' />
    <label>Filter Type:</label>
    <input type='text' name='typeFilter' value='$typeFilter' size='10' />
    <label>Filter Size:</label>
    <input type='text' name='sizeFilter' value='$sizeFilter' size='10' />";
    
?>
   
    <input type='submit' value='Filter!' />
	
    </form>
    
    <form>
    <label>Actual Amount:</label>
    <input type='text' id='multiEditAct' value='' size='10' />
    <label>Max Amount:</label>
    <input type='text' id='multiEditMax' value='' size='10' />
    <label>Price:</label>
    <input type='text' id='multiEditPrice' value='' size='10' />

    <input type='button' onclick='doMultiEdit()' value='Set values for all checked Rows!' />
    </form>
    
 <br />
	<form action='manageClothes.php' method='post'>
    <input type='submit' value='Save!' />
</div>


<div id="editContent">
    
        
    <?php
    include 'db.php';
	
    
	if(isset($_POST['orderBy'])) {
	$orderBy = $_POST['orderBy'];
	} else {
		$orderBy = "gender, brand, type, size";
	}
	
//	if(isset($_GET['where'])) {
//	$where = $_GET['where'];
//	} else {
//		$where = "WHERE Brand LIKE Benetton";
//	}

	
	
	
	$verbindung = connectDB();
	
	// UPDATE IF NEEDED
	
	$countUpdates = 0;
	
	$abfrageIds = "SELECT id FROM Clothes";
	$ergebnisIds = mysql_query($abfrageIds);
	while($row = mysql_fetch_object($ergebnisIds))
	{
		$changed = $_POST["changed$row->id"];
		if($changed==1) {
		
			$actA =	$_POST["actualAmount$row->id"];
			$maxA =	$_POST["maxAmount$row->id"];
			$pric =	$_POST["price$row->id"];
			$acti =	$_POST["active$row->id"];
			
			
			if($acti!=1) $acti=0;
			/*echo "UPDATE Clothes
						SET ActualAmount=$actA,
							MaxAmount=$maxA,
							Price=$pric,
							Active=$acti
						WHERE id=$row->id
						 <br />";*/
			$update = "	UPDATE Clothes
						SET ActualAmount=$actA,
							MaxAmount=$maxA,
							Price=$pric,
							Active=$acti
						WHERE id=$row->id
						
						";
						
			mysql_query($update);
			$countUpdates = $countUpdates + 1;
		} //end if($changed==1)
	} // end while
	
	
	
	
	//#####################################################################
	// OUTPUT DATA
	if($countUpdates > 0) {
		echo "You updated " . $countUpdates . " Clothes."; 
	}
	
	$abfrage = "SELECT g.Name as gender,
						b.Name as brand,
						t.Name as type,
						s.Name  as size,
						ActualAmount,
						MaxAmount,
						Price,
						Active,
						c.id as id
				FROM Clothes c
				JOIN Gender g ON c.Gender=g.id
				JOIN Brand b ON c.Brand =b.id
				JOIN Type t ON c.Type =t.id
				JOIN Size s ON c.Size=s.id
				WHERE g.Name LIKE '$genderFilter%'
				AND b. Name LIKE '$brandFilter%'
				AND t.Name LIKE '$typeFilter%'
				AND s.Name LIKE '$sizeFilter%'
				ORDER BY $orderBy
				";
				
	$ergebnis = mysql_query($abfrage);
	
	echo "<table id='editTable'>";
	echo "<thead>";
	echo "<tr>
			<th>
				<input type='checkbox' id='selectAll'
				name='selectAll' onclick='toggleAll()'/>
			</th>
			<th>
				<a href='#' onclick='changeOrderBy(\"gender\")'>Gender</a>
				<br>
			</th>
			<th>
				<a href='#' onclick='changeOrderBy(\"brand\")'>Brand</a>
			</th>
			<th>
				<a href='#' onclick='changeOrderBy(\"type\")'>Type</a>
			</th>
			<th>
				<a href='#' onclick='changeOrderBy(\"size\")'>Size</a>
			</th>
			<th>ActualAmount</th>
			<th>MaxAmount</th>
			<th>Price</th>
			<th>Active</th>
		  </tr>";
		echo "</thead><tbody>";	  
	while($row = mysql_fetch_object($ergebnis))
	{
		if($row->Active==1) {
			$active = "checked='checked'";
		} else{
			$active = "";
		}
		
		echo "<tr>
				<td>
					<input type='checkbox' id='$row->id' name='selectRow' 
					 onclick='toggleMe($row->id)'/>
				</td>
				
				<td>$row->gender</td>
				<td>$row->brand</td>
				<td>$row->type</td>
				<td>$row->size</td>
				
				<td>Act: <input type='text' id='actualAmount$row->id'
				name='actualAmount$row->id' value='$row->ActualAmount'
				onchange='inputValueChanged($row->id)' size='5' /></td>
				
				<td>Max: <input type='text' id='maxAmount$row->id'
				name='maxAmount$row->id' value='$row->MaxAmount' 
				onchange='inputValueChanged($row->id)' size='5' /></td>
				
				<td><input type='text' id='price$row->id'
				name='price$row->id' value='$row->Price' 
				onchange='inputValueChanged($row->id)' size='5' title='Active?'/> €</td>
				
				<td><input type='checkbox' id='active$row->id' 
				name='active$row->id' value='1' $active 
				onchange='inputValueChanged($row->id)' /></td>
				
				<input type='hidden' id='changed$row->id' 
				name='changed$row->id' value='0' />
			  </tr>";
	}
	echo "</tbody>
			<input type='hidden' id='orderBy' name='orderBy'
			value='$orderBy' />
			</table>";

	
	closeDB($verbindung);
	
	
    
    ?>



</form>
</div>
<br />
<?php
 //include 'foot.php';
?>
</body>

</html>