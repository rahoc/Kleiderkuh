<?php
error_reporting(E_ALL);

class GlobalStream {
    private $pos;
    private $stream;
    
    public function stream_open($path, $mode, $options, &$opened_path) {
        $url = parse_url($path);
        $this->stream = &$GLOBALS[$url["host"]];
        $this->pos = 0;
        if (!is_string($this->stream)) return false;
        return true;
    }
    
    public function stream_read($count) {
        $ret = substr($this->stream, $this->pos, $count);
        $this->pos += strlen($ret);
        return $ret;
    }
    
    public function stream_write($data){
        $l=strlen($data);
        $this->stream =
            substr($this->stream, 0, $this->pos) .
            $data .
            substr($this->stream, $this->pos += $l);
        return $l;
    }
    
    public function stream_tell() {
        return $this->pos;
    }
    
    public function stream_eof() {
        return $this->pos >= strlen($this->stream);
    }
    
    public function stream_seek($offset, $whence) {
        $l=strlen($this->stream);
        switch ($whence) {
            case SEEK_SET: $newPos = $offset; break;
            case SEEK_CUR: $newPos = $this->pos + $offset; break;
            case SEEK_END: $newPos = $l + $offset; break;
            default: return false;
        }
        $ret = ($newPos >=0 && $newPos <=$l);
        if ($ret) $this->pos=$newPos;
        return $ret;
    }

    public function url_stat ($path, $flags) {
        $url = parse_url($path);
        if (isset($GLOBALS[$url["host"]])) {
            $size = strlen($GLOBALS[$url["host"]]);
            return array(
                7 => $size,
                'size' => $size
            );
        } else {
            return false;
        }
    }

    public function stream_stat() {
        return array(
            'size' => strlen($this->_stream),
            7 => $size,
        );
    }
}

require_once("DhlRetoure.php");
require_once("Transaction.php");

$surname = $_POST["fname"];
$familyname = $_POST["lname"];
$street = $_POST["street"];
$streetNumber = $_POST["streetNr"];
$zip = $_POST["plz"];
$city = $_POST["city"];
$id = $_POST["id"];

// store information
if ($id > 0) {
$t = new Transaction;
$t->loadById($id);
$t->fname = $surname;
$t->lname = $familyname;
$t->street = $street;
$t->streetNr = $streetNumber;
$t->plz = $zip;
$t->city = $city;
$t->save();
}

$dhlRetoure = new DhlRetoure();
//$pdf  = $dhlRetoure->getBase64Pdf($surname, $familyname, $street, $streetNumber, $zip, $city, $id);
$pdf  = $dhlRetoure->getRetourePdf($surname, $familyname, $street, $streetNumber, $zip, $city, $id);
//if($pdf){
	//$dhlRetoure->displayPdf($pdf);$
//	echo $pdf;
//}

stream_wrapper_register('global', 'GlobalStream') or die('Failed to register protocol global://');

$GLOBALS['pdfDoc'] = $pdf;



require_once('FPDF/fpdf.php');

require_once('FPDI/fpdi.php');

// initiate FPDI
$fpdi = new FPDI();

// add a page
$fpdi->AddPage();
// set the sourcefile
echo "vor Fehler";
$fpdi->setSourceFile('global://pdfDoc'); 
echo "nach Fehler";
// import page 1
$tplIdx = $fpdi->importPage(1);
// use the imported page and place it at point 10,10 with a width of 100 mm
$fpdi->useTemplate($tplIdx, 10, 10, 100);

// now write some text above the imported page
$fpdi->SetFont('Arial');
$fpdi->SetTextColor(255,0,0);
$fpdi->SetXY(25, 25);
$fpdi->Write(0, "This is just a simple text");

$fpdi->Output('newpdf.pdf', 'D');

?>