<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    include 'db.php';
    
    $brandFilter = "";
    $typeFilter = "";
    $sizeFilter ="";
    $genderFilter = "";
    if (isset($_GET["gender"])) {
        $genderFilter = $_GET["gender"];
    }
    if (isset($_GET["brand"])) {
        $brandFilter = $_GET["brand"];
    }
    if (isset($_GET["type"])) {
        $typeFilter = $_GET["type"];
    }
    if (isset($_GET["size"])) {
        $sizeFilter = $_GET["size"];
    }

$mysqli = connectDB();
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
				";
				
	$ergebnis = $mysqli->query($abfrage);
	
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
	while($row = $ergebnis->fetch_object())
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
                //ob_flush();
	}
	echo "</tbody>
			
			</table>";

	
	$mysqli->close();