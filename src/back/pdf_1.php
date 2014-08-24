<?php
require_once '../../tcpdf/tcpdf.php';

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Eakkabin Jaikeawma');
$pdf->SetTitle('บทที่ 1 ดาวโหลดและติดตั้ง TCPDF Report');
$pdf->SetSubject('TCPDF Tutorial Learning');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$title = 'บทที่ 1 ดาวโหลดและติดตั้ง TCPDF Report';
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
$pdf->setHeaderFont(array('freeserif', '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array('freeserif', '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetFont('freeserif', '', 14, '', true);

$pdf->AddPage();

// Set some content to print
$html = <<<EOD
        <h1>ยินดีต้อนรับสู่บทเรียนเฉพาะกิจ
        <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;"> 
        <span style="color:black;">TC</span><span style="color:white;">PDF</span>
        <span style="color:black;"> REPORT</span> </a> !</h1>
        <i>นี่คือตัวอย่างแรกในการเรียกใช้งาน TCPDF library.</i>
        <p style="text-align:center;">ตัวอย่างนี้ เรียกใช้งาน Method <i>writeHTMLCell()</i>
        ซึ่งเป็น Method แสดงข้อความตามแบบ HTML</p>
        <p>ติดตาม บทเรียนเฉพาะกิจ "TCPDF REPORT" ได้ที่ <a href="http://DriveSoftcenter.Net">http://DriveSoftcenter.Net</a></p>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Close and output PDF document
$pdf->Output('example_001.pdf', 'I');
