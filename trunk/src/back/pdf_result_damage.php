<?php
include '../../config/app_connect.php';
include '../../MPDF57/mpdf.php';

$group_name = "ทั้งหมด";
$approve_no = 0;
$return_no = 0;
$damage = 0;

if (!empty($_GET)) {
    $group = $_GET['group'];
    $sql_item = " SELECT ";
    $sql_item .= " CONCAT(i.ite_id,' - ',i.ite_name) as ite_name";
    $sql_item .= " ,bd.bor_id";
    $sql_item .= " ,bd.bordet_approve_no";
    $sql_item .= " ,bd.bordet_return_no";
    $sql_item .= " ,(bd.bordet_approve_no - bd.bordet_return_no) as damage";
    //$sql_item .= " (SELECT SUM(bordet_approve_no) FROM borrow_detail WHERE )";
    $sql_item .= " FROM `item` i";
    $sql_item .= " JOIN borrow_detail bd ON bd.ite_id = i.ite_id ";
    if (!empty($_GET['group'])):
        $sql_item .= " WHERE i.gro_id = " . $group;

        // #################### group ###################
        $sql_group = "SELECT gro_name FROM `group` WHERE gro_id = " . $group;
        $query_group = mysql_query($sql_group) or die(mysql_error());
        $result_group = mysql_fetch_assoc($query_group);
        $group_name = $result_group['gro_name'];
    // #################### group ###################
    endif;
    $sql_item .= " group by i.ite_id";
    $sql_item .= " order by ite_name";


    $query_item = mysql_query($sql_item) or die(mysql_error());
    ob_start();
    //echo 'sql : ' . $sql_item . '<br/>';
    ?>
    <link rel="stylesheet" type="text/css" href="../../css/report_style.css"/>
    <h2 style="text-align: center;">รายงานสรุปผลการตรวจสอบสิ่งของสูญหาย</h2>
    <h3 style="text-align: center;">กลุ่ม <?= $group_name ?></h3>
    <table>
        <thead>
            <tr>
                <th>ชื่อทรัพยากร</th>
                <th>เลขที่เอกสาร</th>
                <th>จำนวนที่ยืม</th>
                <th>จำนวนคืน</th>
                <th>สิ่งของศูนย์หาย</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysql_fetch_array($query_item)) : ?>
                <tr>
                    <td><?= $row['ite_name'] . "-" . $row['ite_id'] ?></td>
                    <td><?= $row['bor_id'] ?></td>
                    <td><?= $row['bordet_approve_no'] ?></td>
                    <td><?= $row['bordet_return_no'] ?></td>
                    <td><?= $row['damage'] ?></td>
                </tr>
                <?php 
                    $approve_no = $approve_no+$row['bordet_approve_no'] ;
                    $return_no = $return_no+$row['bordet_return_no'];
                    $damage = $damage+$row['damage'] ;
                ?>
            <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" style="text-align: right;">รวม</th>
                <th><?= $approve_no ?></th>
                <th><?= $return_no ?></th>
                <th><?= $damage ?></th>
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
}
?>

