<?php
include_once '../../config/app_connect.php';
require '../../MPDF57/mpdf.php';

// ############## ประกาศตัวแปร ###############
$group_name = 'ทั้งหมด ทุกกลุ่ม';
$total_ite_total_no = 0;
$total_ite_balance_no = 0;
// ############## ประกาศตัวแปร ###############

if (!empty($_GET)):
    $sql = " SELECT * FROM item WHERE 1=1 ";
    if (!empty($_GET['group'])):
        $sql .= " AND gro_id = " . $_GET['group'];
    endif;
    if (!empty($_GET['opertion']) && !empty($_GET['number'])):
        $sql .= " AND ite_balance_no " . $_GET['opertion'] . "  " . $_GET['number'];
    endif;
    $sql .= " ORDER BY ite_id";
    echo 'sql : '.$sql;
    $query_item = mysql_query($sql) or die(mysql_error());
endif;
if (!empty($_GET['group'])):
//################ FINE GROUP ###############
    $sql_group = "SELECT * FROM `group` WHERE gro_id = " . $_GET['group'];
    $query_group = mysql_query($sql_group) or die(mysql_error());
    $result_group = mysql_fetch_assoc($query_group);
    $group_name = $result_group['gro_name'];
//################ FINE GROUP ###############
endif;
ob_start();
?>
<link rel="stylesheet" href="../../css/report_style.css" type="text/css"/>
<h2>กลุ่มสิ่งของวัด กลุ่ม : <?= $group_name ?></h2>
<table>
    <thead>
        <tr>
            <th style="width: 10%">ลำดับ</th>
            <th>ชื่อ</th>
            <th style="width: 15%">จำนวนทั้งหมด/ชิ้น</th>
            <th style="width: 15%">จำนวนคงเหลือ/ชิ้น</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1 ?>
        <?php while ($data = mysql_fetch_array($query_item)) : ?>
            <tr>
                <td style="text-align: center"><?= $i ?></td>
                <td style="text-align: left"><?= $data['ite_name'] ?></td>
                <td style="text-align: right"><?= $data['ite_total_no'] ?></td>
                <td style="text-align: right"><?= $data['ite_balance_no'] ?></td>
            </tr>
            <?php
            $total_ite_balance_no +=$data['ite_balance_no'];
            $total_ite_total_no += $data['ite_total_no'];
            $i++;
        endwhile;
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="2" style="text-align: center;">รวม</th>
            <th style="text-align: right"><?= $total_ite_total_no ?></th>
            <th style="text-align: right"><?= $total_ite_balance_no ?></th>
        </tr>
    </tfoot>
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

