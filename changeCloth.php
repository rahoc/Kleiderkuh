<?php

include 'db.php';

$mysqli = connectDB();

$id = "";
$actA = "";
$maxA = "";
$pric = "";
$acti = "";

if(isset($_POST["id"])) $id =               $_POST["id"];
if(isset($_POST["actualAmount"])) $actA =   $_POST["actualAmount"];
if(isset($_POST["maxAmount"])) $maxA =      $_POST["maxAmount"];
if(isset($_POST["price"])) $pric =          $_POST["price"];
if(isset($_POST["active"])) $acti =         $_POST["active"];

if($acti!=1) $acti=0;

echo "UPDATE Clothes
        SET ActualAmount=$actA,
                MaxAmount=$maxA,
                Price=$pric,
                Active=$acti
        WHERE id=$id
        ";
$update = "UPDATE Clothes
            SET ActualAmount=$actA,
                MaxAmount=$maxA,
                Price=$pric,
                Active=$acti
            WHERE id=$id
            ";

$mysqli->query($update);

$mysqli->close();

	
	