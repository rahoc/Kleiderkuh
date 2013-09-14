<?php
showFeedback();

function showFeedback() {
	$db_server = "";
	$db_name = "DB1401681";
	$db_user = "kkdbuser1";
	$db_password = "22qmuh22";
	
	
	$mysqli = new mysqli($db_server ,$db_user, $db_password, $db_name);
	//$mysqli = new mysqli($db_server,$db_user, $db_password, $db_name);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . 
				") " . $mysqli->connect_error;
	}
	
	// QUERY - Transaction
	$query = "SELECT * FROM Feedback";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	
	//$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	//echo "5 <br />";
	// GOING THROUGH THE DATA
	echo "<table>";
	if($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			//print_r($row);
			echo "<tr>";
			echo "<td>" . $row['Id'] . "</td>";
			echo "<td>" . $row['Email'] . "</td>";
			echo "<td>" . $row['Reason'] . "</td>";
			echo "<td>" . $row['Text'] . "</td>";
			echo "<td>";
		}
	}
	echo "</table>";
}
	
?>