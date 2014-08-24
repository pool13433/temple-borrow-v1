<?php
require_once '../../tcpdf/tcpdf.php';

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('TempleAsset');
$pdf->SetTitle('รายงาน ทรัพย์สิน');
$pdf->SetSubject('TCPDF Tutorial Learning');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$title = 'รายงาน ทรัพย์สิน';
$pdf->SetHeaderData("", "", $title, "", array(0, 64, 255), array(0, 64, 128));
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
// ####################### SQL ###########################
include '../../config/app_connect.php';
    $sql = "SELECT * FROM `item` i";
    $sql .= " JOIN `group` g ON g.gro_id = i.gro_id";
    $sql .= " JOIN `type` t ON t.typ_id = i.typ_id";
    $sql .= " JOIN `size` s ON s.siz_id = i.siz_id";
$query = mysql_query($sql) or die(mysql_error());
// ####################### END SQL ########################

// Set some content to print
$html = <<<EOD
<style type="text/css">
     table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table.gridtable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}
</style>
       <table class="gridtable">
            <thead>
                <tr>
                    <th style="width: 10%">รหัส</th>
                    <th>ชื่อ</th>
                    <th>กลุ่ม</th>
                    <th>ชนิด</th>
                    <th>ขนาด</th>
                    <th>ขนาด</th>
                </tr>
            </thead>
            <tbody>
EOD;
while ($row = mysql_fetch_array($query)) :
    $html .= <<<EOD
                <tr>
                    <td>{$row['ite_id']}</td>
                    <td>{$row['ite_name']}</td>
                    <td>{$row['gro_name']}</td>
                    <td>{$row['typ_name']}</td>
                    <td>{$row['siz_name']}</td>
                    <td>{$row['siz_name']}</td>
                 </tr>
EOD;
endwhile;
$html .= <<<EOD
            </tbody>
        </table>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Close and output PDF document
$pdf->Output('example_001.pdf', 'I');
