<?php
include_once '../../config/app_connect.php';
require '../../MPDF57/mpdf.php';
//echo 'print';
if (!empty($_GET)):
    $startdate = $_GET['startdate'];
    $enddate = $_GET['enddate'];
    $sql = " SELECT p.* ";
    $sql .= " ,DATE_FORMAT(bor_get,'%d/%m/%Y') as bor_get";
    $sql .= " ,DATE_FORMAT(bor_start,'%d/%m/%Y') as bor_start";
    $sql .= " ,DATE_FORMAT(bor_end,'%d/%m/%Y') as bor_end";
    $sql .= " ,DATE_FORMAT(bor_createdate,'%d/%m/%Y') as bor_createdate";
    //$sql .= " ,bor_status";
    
    $sql .= " ,CASE ";
    $sql .= " WHEN bor_approve ='0' THEN 'รออนุมัติ'";
    $sql .= " WHEN bor_approve ='1' THEN 'อนุมัติ จ่ายของ'";
    //$sql .= " WHEN bor_approve ='2' THEN 'อนุมัติของพิเศษ'";
    $sql .= " ELSE 'อนุมัติของพิเศษ'";
    $sql .= " END as bor_approve";
    
    $sql .= " ,CASE ";
    $sql .= " WHEN bor_status ='0' THEN 'รอ'";
    $sql .= " WHEN bor_status ='1' THEN 'รอ รับของ'";
    $sql .= " WHEN bor_status ='2' THEN 'รับของแล้ว'";
    $sql .= " WHEN bor_status ='3' THEN 'คืน'";
    $sql .= " WHEN bor_status ='4' THEN 'ล่าช้า'";
    $sql .= " WHEN bor_status ='5' THEN 'ไม่มา'";
    $sql .= " WHEN bor_status ='6' THEN 'ยกเลิก'";
    $sql .= " ELSE '---'";
    $sql .= " END as bor_status";
    
    $sql .= " FROM borrow b";
    $sql .= " JOIN person p ON b.per_id = p.per_id";
    $sql .= " WHERE 1=1";
    $sql .= " AND (";
    $sql .= " DATE_FORMAT(bor_get,'%d/%m/%Y') between '" . $startdate . "' AND '" . $enddate . "'";
    $sql .= " OR DATE_FORMAT(bor_end,'%d/%Y/%d')  between '" .$startdate . "' AND '" . $enddate. "'";
    $sql .= " )";
    echo 'sql : ' . $sql;
    $query = mysql_query($sql) or die(mysql_error());
    ob_start();
    ?>
    <link rel="stylesheet" href="../../css/report_style.css" type="text/css"/>
    <?php //echo 'sql : ' . $sql; ?>
    <h3 style="text-align: center">รายงานสรุปผลการยืมคืน ประจำวันเดือนปี</h3>
    <h4 style="text-align: center">ตั้งแต่วันที่ <?= $startdate ?> ถึง <?= $enddate ?></h4>
    <table border="1">
        <thead>
            <tr>
                <th>ชื่อผู้ยืม</th>
                <th>วันที่ยืม</th>
                <th>วันมารับของ</th>
                <th>วันใช้งานของ</th>
                <th>วันคืนของ</th>
                <th>สถานะ</th>
                <th>สถานะอนุมัติ</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysql_fetch_array($query)): ?>
                <tr>
                    <td><?= $row['per_fname'] . " " . $row['per_lname'] ?></td>
                    <td><?= $row['bor_get'] ?></td>
                    <td><?= $row['bor_start'] ?></td>
                    <td><?= $row['bor_end'] ?></td>
                    <td><?= $row['bor_createdate'] ?></td>
                    <td><?= $row['bor_approve'] ?></td>
                    <td><?= $row['bor_status'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <?php
    $html = ob_get_contents();
    ob_clean();
    $mpdf = new mPDF("UTF-8");
    $mpdf->SetAutoFont();
    $mpdf->AddPage('L');
    $mpdf->Write($stylesheet, 1);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
endif;
