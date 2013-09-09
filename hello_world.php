<?php

require_once dirname(__FILE__) . 'File_PDF-0.3.3/PDF.php';

// Set up the pdf object.
$pdf = &File_PDF::factory(array('orientation' => 'P', 'format' => 'A4'));
// Start the document.
$pdf->open();
// Activate compression.
$pdf->setCompression(true);
// Start a page.
$pdf->addPage();
// Set font to Courier 8 pt.
$pdf->setFont('Courier', '', 8);
// Text at x=100 and y=100.
$pdf->text(100, 100, 'First page');
// Set font size to 20 pt.
$pdf->setFontSize(20);
// Text at x=100 and y=200.
$pdf->text(100, 200, 'HELLO WORLD!');
// Add a new page.
$pdf->addPage();
// Set font to Arial bold italic 12 pt.
$pdf->setFont('Arial', 'BI', 12);
// Text at x=100 and y=200.
$pdf->text(100, 100, 'Second page');
// Print the generated file.
echo $pdf->getOutput();

// Set up the pdf object.
$pdf = &File_PDF::factory(array('orientation' => 'P', 'format' => 'A4'));
// Start the document.
$pdf->open();
// Deactivate compression.
$pdf->setCompression(false);
// Start a page.
$pdf->addPage();
// Set font to Courier 8 pt.
$pdf->setFont('Courier', '', 8);
// Text at x=100 and y=100.
$pdf->text(100, 100, 'First page');
// Set font size to 20 pt.
$pdf->setFontSize(20);
// Text at x=100 and y=200.
$pdf->text(100, 200, 'HELLO WORLD!');
// Add a new page.
$pdf->addPage();
// Flush page.
echo $pdf->flush();
// Set font to Arial bold italic 12 pt.
$pdf->setFont('Arial', 'BI', 12);
// Text at x=100 and y=200.
$pdf->text(100, 100, 'Second page');
// Print the generated file.
echo $pdf->getOutput();

?>
