<?php
	include 'db.php';

	$verbindung = connectDB();
		
	$abfrageG = "SELECT id FROM Gender";	
	$ergebnisG = mysql_query($abfrageG);
	while($rowG = mysql_fetch_object($ergebnisG))
	{
		$abfrageB = "SELECT id FROM Brand";	
		$ergebnisB = mysql_query($abfrageB);
		while($rowB = mysql_fetch_object($ergebnisB))
		{
			$abfrageT = "SELECT id FROM Type";	
			$ergebnisT = mysql_query($abfrageT);
			while($rowT = mysql_fetch_object($ergebnisT))
			{
				$abfrageS = "SELECT id FROM Size";	
				$ergebnisS = mysql_query($abfrageS);
				while($rowS = mysql_fetch_object($ergebnisS))
				{
					echo "$rowG->id $rowB->id $rowT->id $rowS->id <br />";
					/*
					// COMMENT THIS IN TO INSERT ALL CLOTH PERMUTATIONS
					$insert  = "INSERT INTO Clothes
						(Gender, Brand, Type, Size)
						VALUES
						($rowG->id, $rowB->id, $rowT->id, $rowS->id)";
					mysql_query($insert);
					*/
				}
			}
		}
	}

	$abfrage = "SELECT * FROM Clothes";	
	$ergebnis = mysql_query($abfrage);
	
	
	echo "<html><body><table>";
	while($row = mysql_fetch_object($ergebnis))
	{
		echo "<tr>
				<td>$row->Gender</td>
				<td>$row->Brand</td>
				<td>$row->Type</td>
				<td>$row->Size</td>
			  <tr>";	
	}
	echo "</table></body></html>";
	closeDB($verbindung);

?>