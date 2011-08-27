<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2010-08-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com s.r.l.
//               Via Della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

require_once('../config/lang/eng.php');
require_once('../tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// Set some content to print
$html = <<<EOD
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-1"> 
  <tr> 
    <td align="left" valign="top" style="padding-bottom: 10px;" width="600"><h3 style="font-weight: normal; font-family: 'Arial Narrow', 'Arial Black'; margin: 0; color: #000; padding: 0;"><strong>Recipients:</strong> </h3> 
      <p style="font-size: 12px; font-family: Arial, 'Arial Narrow', 'Arial Rounded MT Bold'; margin: 0; color: #656464; padding: 0;"> 
	  	 Sreeraj Vr
	 	  </p><br /> 
      <h3 style="font-weight: normal; font-family: 'Arial Narrow', 'Arial Black'; margin: 0; color: #000; padding: 0;"><strong>Expires On:</strong></h3> 
      <p style="font-size: 12px; font-family: Arial, 'Arial Narrow', 'Arial Rounded MT Bold'; margin: 0; color: #656464; padding: 0;"> 
	  08 Aug 2011 01:40 PM	  </p> 
      <p style="font-size: 12px; font-family: Arial, 'Arial Narrow', 'Arial Rounded MT Bold'; margin: 0; color: #656464; padding: 0;">&nbsp;</p> 
     
	  
	  </td> 
    <td align="left" valign="top" style="padding-bottom: 10px;"><h3 style="font-weight: normal; font-family: 'Arial Narrow', 'Arial Black'; margin: 0; color: #000; padding: 0;"><strong>Redeem at</strong>:</h3> 
      <p style="font-size: 12px; font-family: Arial, 'Arial Narrow', 'Arial Rounded MT Bold'; margin: 0; color: #656464; padding: 0;"> 
	  Big City Diner<br /> 
	    Multiple Locations<br />

        <br /> 
         (808) 738-8855</p> 
		</td> 
  </tr> 
 
 <tr> 
    <td align="left" valign="top" style="padding-bottom: 10px;" colspan="2"> 
	<table align="left" valign="top" width="100%"> 
		  <tr> 
			<td align="left" valign="top" style="padding-bottom: 10px;"><h3 style="font-weight: normal; font-family: 'Arial Narrow', 'Arial Black'; margin: 0; color: #000; padding: 0;"> 
			<strong>The Fine Print</strong></h3> 
			  <p style="font-size: 12px; font-family: Arial, 'Arial Narrow', 'Arial Rounded MT Bold'; margin: 0; color: #656464; padding: 0;"> 
			  Limit 1 voucher per table for up to 4 persons

Limit 2 vouchers per table for parties of 5 or more persons

<strong>THIS DEAL'S CERTIFICATE WILL ME MAILED TO YOU AFTER PURCHASE.  <br>Please allow 7-10 days for delivery.</strong> </p></td> 
			<td align="left" valign="top" style="padding-bottom: 10px;"> 
			<h3 style="font-weight: normal; font-family: 'Arial Narrow', 'Arial Black'; margin: 0; color: #000; padding: 0;"> 
			
			<img  alt="QR CODE" title="Coupon Code" src="https://chart.googleapis.com/chart?cht=qr&chd=t:60,40&chs=200x200&chl=7y3ugex"> 
			</h3></td> 
		  </tr> 
	</table> 
 </td> 
 </tr> 
<!--  <tr>
  <td style="padding-bottom: 10px;" >
  <h3 style="font-weight: normal; font-family: 'Arial Narrow', 'Arial Black'; margin: 0; color: #000; padding: 0;">
  <strong>Universal Fine Print:</strong>
  </h3>
  <p style="font-size: 12px; font-family: Arial, 'Arial Narrow', 'Arial Rounded MT Bold'; margin: 0; color: #656464; padding: 0;">
  GLB_UNIVERSAL_FINE_PRINT
  </p></td>
  <td></td>
  </tr>--> 
</table> 
</div> 
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-2"> 
  <tr> 
    <td align="left" valign="top" style="width: 50%; padding-bottom: 10px; margin-bottom: 15px;" > 
 
    <h2 style="margin-bottom: 10px; font-weight: normal; font-family: 'Arial Narrow', 'Arial Black'; color: #000;"> 
	How to use this
	</h2> 
    <div class="container" style="background-color: #fff; border: 1px solid #000; padding: 10px;"> 
	<p>

	1. Print Vote on Deals voucher.&nbsp; (click on the print icon on the top right corner)</p>

<p>

	2.&nbsp;Go to the address of the business shown above (Call ahead if an appointment is required).</p>

<p>

	3. Present Vote on Deals voucher upon arrival.</p>

<p>

	4. Enjoy!&nbsp; (please be sure to tip for the full orignal amount)</p>

 
      </div></td> 
    <td align="left" valign="middle" style="width: 50%; padding-bottom: 10px; margin-bottom: 15px;"> 
	
	<h2 style="margin-bottom: 10px; padding-left:20px; font-weight: normal; font-family: 'Arial Narrow', 'Arial Black'; color: #000;"> 
	Map: </h2> 
    <div class="map" style="background-color: #ccc6c6; border: 1px solid #757373; padding: 10px; margin-left: 15px;"> 
    
			  		<div id="google-map" style="width:360px; height: 215px"> 
		</div> 
				
		</div> 
    </td> 
    </tr> 
</table> 
 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-3"> 
    <tr> 
    <th scope="col" align="left" bgcolor="#FFF" style="border-bottom: 4px solid #000; font-size: 11px; padding: 5px 10px; background-color: #FFF; font-family: Arial, 'Arial Narrow', 'Arial Rounded MT Bold'; font-weight: normal;"> 
		Vote on Deals Support <p>

	(702) 799-9376 Monday-Friday 9am-5pm PST</p>

 
	</th> 
    <th scope="col" align="right" bgcolor="#FFF" style="border-bottom: 4px solid #000; font-size: 11px; padding: 5px 10px; background-color: #FFF; font-family: Arial, 'Arial Narrow', 'Arial Rounded MT Bold'; font-weight: normal;"> 
	 Voucher Email Support: support@voteondeals.com</th> 
  </tr> 
   <!-- <tr>
      <td align="left" valign="top" bgcolor="#FFF" style="width: 50%; padding: 5px 10px; margin-bottom: 15px; background-color: #FFF; border: 1px solid #000; font-size: 12px; font-family: Arial, 'Arial Narrow', 'Arial Rounded MT Bold';" colspan="2"><p style="font-size: 12px; font-family: Arial, 'Arial Narrow', 'Arial Rounded MT Bold'; margin: 0; color: #656464; padding: 0;"><strong><img class="float-left" src="http://www.voteondeals.com/images/printcamera.jpg" align="left" alt="Logo" style="margin: 0 10px 10px 0; border: 0; float: left;" />Send Us Your Pictures!</strong></p>
        Want to win $100? Email creative pictures (or videos!) of you redeeming your Vote on Deals to pictures@voteondeals.com. Each month we'll award
        $100 in Vote on Deals credit for our favorite photo! Keep in mind, by submitting a photo, you are giving us permission to use it on our Flickr
      stream, in our promotions, or on our website.</td>
    </tr>--> 
  </table> 

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
