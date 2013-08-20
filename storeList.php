

<?php

$pdf = base64_decode($_POST["pdf"]);
$id = $_POST["id"];

echo file_put_contents("pdf/checklist_".$id.".pdf",$pdf);


?>