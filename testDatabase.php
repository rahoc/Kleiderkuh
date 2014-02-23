<?php

include 'dblogin.php';

$mysqli = new mysqli($db_server,$db_user, $db_password) or die ("Error mysqli_connect: ".mysqli_error()); 

$mysqli->select_db($db_name); // or die ("Error select_db: ".mysqli_error());

$result = $mysqli->query("SELECT * FROM transactions");

while($row = $result->fetch_object())
{
    print_r($row);
}