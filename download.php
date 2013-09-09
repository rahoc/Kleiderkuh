<?php 
   header("Content-Type: application/octet-stream");
   header("Content-Disposition: attachment; filename=KleiderKuhDHL.pdf");
   readfile($_GET['path']);
?>