<?php
//============================================================+
// File name   : example_027.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 027 for TCPDF class
//               1D Barcodes
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: 1D Barcodes.
 * @author Nicola Asuni
 * @since 2008-03-04
 */

$input_starting = $_POST['input_starting']; 
$input_prefix = $_POST['input_prefix'];
$input_digits = $_POST['input_digits'];
$input_count = $_POST['input_count'];

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new TCPDF('L', 'mm', array(86,54), true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Andy Melien');
$pdf->SetTitle('TCPDF 128A Gift Card Barcode Generator');
$pdf->SetSubject('TCPDF 128A Gift Card Barcode Generator');
$pdf->SetKeywords('TCPDF, PDF, gift card, barcode, 128A');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(0,0,0,0);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(false);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

//$malloryBold = $pdf->addTTFfont('fonts/Mallory-Bold.ttf', 'TrueTypeUnicode', '', 32);
//$malloryLight = $pdf->addTTFfont('fonts/Mallory-Light.ttf', 'TrueTypeUnicode', '', 32);

$malloryBold = TCPDF_FONTS::addTTFfont('fonts/Mallory-Bold.ttf', 'TrueTypeUnicode', '', 96);
$malloryLight = TCPDF_FONTS::addTTFfont('fonts/Mallory-Light.ttf', 'TrueTypeUnicode', '', 96);

//$pdf->SetFont('helvetica', '', 10);
$pdf->SetFont($malloryLight, '', 7, '', false);

// define barcode style
$style = array(
	'position' => '',
	'align' => 'C',
	'stretch' => true,
	'fitwidth' => true,
	'cellfitalign' => 'C',
	'border' => false,
	'hpadding' => 20,
	'vpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
//	'font' => 'helvetica',
	'fontsize' => 7,
	'stretchtext' => 4
);

for ($x = 0; $x < intval($input_count); $x++) {
    
    // add a page ----------
    $pdf->AddPage();
    
    $num = $input_starting + $x;
    $text = $input_prefix . str_pad($num,$input_digits,"0",STR_PAD_LEFT);

    // CODE 128 A
    // $pdf->Cell(0, 0, 'CODE 128 A', 0, 1);
    
    #write1DBarcode($code, $type, $x='', $y='', $w='', $h='', $xres='', $style='', $align='')
    $pdf->write1DBarcode($text, 'C128A', '', 33, '', 15, 0.4, $style, 'B');
    
    $pdf->Ln();
}

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('giftcards.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
