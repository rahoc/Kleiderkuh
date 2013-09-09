<?php


//Chrome Browser brauch das um das Script zu erlauben
//header('Access-Control-Allow-Origin: http://kleiderkuh.de');
//header('Access-Control-Allow-Origin: https://kleiderkuh.de');


//Variables
$base64dir = "base64/";  //temp folder for bas64 encoded files
$pdfdir = "pdf/"; //temp folder for pdf files
$file_pdf_1="pdf/file1_" . substr(md5(microtime()),rand(0,26),20) . ".pdf";
$file_pdf_2="pdf/file2_" . substr(md5(microtime()),rand(0,26),20) . ".pdf";
$finalpdf = $pdfdir . "printpdf_" . substr(md5(microtime()),rand(0,26),20) . ".pdf";
$file_base64_1="base64/file1" . substr(md5(microtime()),rand(0,26),20) . ".base64";
$file_base64_2="base64/file2" . substr(md5(microtime()),rand(0,26),20) . ".base64";
//Base64 Dateien zum testen
//$file_base64_1="dan/base64/test1.base64";
//$file_base64_2="dan/base64/test2.base64";

//Functions
function writepoststreamtofile($file_base64, $file_content_base64) {
        if (!$file_handler_base64 = fopen ($file_base64, 'w')) {
	 		echo "Kann die Datei $file_base64 nicht öffnen";
			print_r(error_get_last());
			exit;
		}
        if (!fwrite($file_handler_base64, $file_content_base64)) {
			echo "Kann in die Datei $file_base64 nicht schreiben";
			print_r(error_get_last());
       	 exit;
		}
        fclose ($file_handler_base64);
}


function convertbase64topdf($file_base64, $file_pdf) {
        $file_handler_base64 = fopen ($file_base64, 'r');
        $file_content_base64 = fread ($file_handler_base64, filesize($file_base64));
        fclose ($file_handler_base64);
        $file_content_base64 = str_replace("data:application/pdf;base64,","", $file_content_base64);
        $pdf_data = base64_decode ($file_content_base64);
        $file_handler_pdf = fopen ($file_pdf, 'w');
        fwrite ($file_handler_pdf, $pdf_data);
        fclose ($file_handler_pdf);
}

function mergepdf($file_pdf_1, $file_pdf_2, $finalpdf) {
        $command = "pdftk ". $file_pdf_1 . " " . $file_pdf_2 . " output " . $finalpdf;
		//echo $command;
        passthru($command); //pdftk auf der shell ausfueren
}

//Postdateien abrufen
//aus mir nicht erkennbaren Gruenden funktioniert move_uploaded_file nicht..
//(move_uploaded_file($_FILES['url1']['tmp_name'],$file_base64_1));
//daher dieser Workaround
if (isset($_POST)) {
		//echo $file_base64_1. $_POST['url1'];
        writepoststreamtofile($file_base64_1, $_POST['url1']);
        writepoststreamtofile($file_base64_2, $_POST['url2']);

        //Konvertieren & Mergen
        convertbase64topdf($file_base64_1, $file_pdf_1);
        convertbase64topdf($file_base64_2, $file_pdf_2);
        mergepdf($file_pdf_1, $file_pdf_2, $finalpdf);
        //	header(sprintf('Location: %s', $finalpdf)); //open the merged pdf file in the browser
		header("Content-Type: application/pdf");
		header("Content-Disposition: attachment; filename=\"shipping.pdf\"");
        echo $finalpdf;

        //clean up! Nicht $finalpdf sonnst kann es nicht angezeigt werden!
        $command = "rm -rf " . $file_pdf_1 . " " . $file_pdf_2 . " " . $file_base64_1 . " " . $file_base64_2;
        passthru($command);
}


//debuggen der POST Variable
//file_put_contents('test.txt', file_get_contents('php://input'));


?>