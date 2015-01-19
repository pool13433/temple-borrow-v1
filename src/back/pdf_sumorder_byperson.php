<?php
include_once '../../config/app_connect.php';
include_once '../../config/app_function.php';
require '../../MPDF57/mpdf.php';

// ############## ประกาศตัวแปร ###############
// ############## ประกาศตัวแปร ###############
// ############## สร้าง query #################
$sql_order = "SELECT * FROM borrow br";
$sql_order .= " LEFT JOIN person ps ON ps.per_id = br.per_id";
$sql_order .= " WHERE 1=1 ";
if (!empty($_GET['hidden-person'])):
    $sql_order .= " AND  (";
    $array_person = array();
    $array_person = explode(',', $_GET['hidden-person']);
    for ($i = 0; $i < count($array_person); $i++):
        $sql_order .= "  br.per_id = " . $array_person[$i];
        if (count($array_person) > ($i + 1)):
            $sql_order .= " OR ";
        endif;
    endfor;
    $sql_order .= " )";
endif;
if (!empty($_GET['bor_getstart']) && !empty($_GET['bor_getend'])) {
    $sql_order .= " AND br.bor_createdate BETWEEN '" . change_dateDMY_TO_YMD($_GET['bor_getstart']) . "' ";
    $sql_order .= " AND '" . change_dateDMY_TO_YMD($_GET['bor_getend']) . "' ";
}

$query_order = mysql_query($sql_order) or die(mysql_error() . 'sql : ' . $sql_order);
// ############## สร้าง query #################
ob_start();
?>
<link rel="stylesheet" href="../../css/report_style.css" type="text/css"/>
<h2>สรุปรายการใบยืมทั้งหมด ตามชื่อผู้ยืม</h2>
<table>
    <thead>
        <tr>
            <th style="width: 15%">ชื่อ</th>
            <th style="width: 15%">รหัส</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1 ?>
        <?php while ($data = mysql_fetch_array($query_order)) : ?>
            <tr>
                <td style="text-align: left;vertical-align: top"><?= $data['per_id'] . ' ' . $data['per_fname'] ?></td>
                <td style="text-align: right><?= $data['bor_id'] ?></td>
                    <td style="width: 80%">
                    <table style="width: 800px;">
                        <thead>
                            <tr>
                                <th style="width: 70%">ชื่อสิ่งของยืม</th>
                                <th style="width: 30%">จำนวนยืม</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_detail = "SELECT * FROM borrow_detail bd";
                            $sql_detail .= " LEFT JOIN borrow br ON br.bor_id = bd.bor_id";
                            $sql_detail .= " LEFT JOIN item i ON i.ite_id = bd.ite_id";
                            $sql_detail .= " WHERE br.bor_id = " . $data['bor_id'];
                            $query_detail = mysql_query($sql_detail) or die(mysql_error());
                            while ($detail = mysql_fetch_array($query_detail)):
                                ?>
                                <tr>
                                    <td><?= $detail['ite_name'] ?></td>
                                    <td style="text-align: right;"><?= $detail['bordet_no'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    <!--<tfoot>
        <tr>
            <th colspan="2" style="text-align: center;">รวม</th>
            <th style="text-align: right"><?= $total_ite_total_no ?></th>
            <th style="text-align: right"><?= $total_ite_balance_no ?></th>
        </tr>
    </tfoot>-->
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
?>
