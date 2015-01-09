<?Php
include_once '../../config/app_connect.php';
require '../../MPDF57/mpdf.php';

if (!empty($_GET)):
    $group_name = "ทั้งหมด";
    $group = $_GET['group'];
    $status = $_GET['status'];
    $sql = "SELECT i.ite_name,i.ite_total_no,i.ite_balance_no";

    $sql .= "  ,(CASE ";
    $sql .= " WHEN ite_priority = 1 THEN 'ปกติ' ";
    $sql .= " WHEN ite_priority = 1 THEN 'พิเศษ' ";
    $sql .= " ELSE 'อื่น ๆ' ";
    $sql .= " END) AS ite_priority";

    $sql .= "  ,(CASE ";
    $sql .= " WHEN ite_status = 1 THEN 'ปกติ' ";
    $sql .= " WHEN ite_status = 2 THEN 'ยืม' ";
    $sql .= " WHEN ite_status = 3 THEN 'ชำรุด' ";
    $sql .= " ELSE ' ไม่ระบุ ' ";
    $sql .= " END) AS ite_status";

    $sql .= " ,g.*,t.*,s.*";
    $sql .= " ,(SELECT SUM(bordet_no) FROM borrow_detail bd,borrow br";
    $sql .= " WHERE bd.bor_id = br.bor_id";
    $sql .= " AND bd.ite_id = i.ite_id";
    //$sql .= " AND br.bor_status = 2";
    $sql .= " ) as count_borrow";
    $sql .= " FROM item i";
    $sql .= " LEFT JOIN `group` g ON g.gro_id = i.gro_id";
    $sql .= " LEFT JOIN type t ON t.typ_id = i.typ_id";
    $sql .= " LEFT JOIN size s ON s.siz_id = i.siz_id";
    if ($group != ''):
        $sql .= " WHERE i.gro_id = " . $group;

        // ################### group ###############
        $sql_group = "SELECT * FROM `group` WHERE gro_id =  " . $group;
        $query_group = mysql_query($sql_group) or die(mysql_error());
        $result = mysql_fetch_assoc($query_group);
        $group_name = $result['gro_name'];
        // ###################end group ############
    endif;
    $sql .= ' ORDER BY ite_name,gro_name,ite_total_no';
    
    $query = mysql_query($sql) or die(mysql_error());
    ob_start();
    ?>
    <link rel="stylesheet" href="../../css/report_style.css" type="text/css"/>
    <?php //echo 'sql : ' . $sql;  ?>
    <h3 style="text-align: center">รายงานสรุปข้อมูลการตรวจสอบสถานะของสิ่งของ</h3>
    <h4 style="text-align: center">กลุ่ม <?= $group_name ?></h4>
    <table>
        <thead>
            <tr>
                <th>ชื่อ</th>
                <th>กลุ่ม</th>
                <th>ชนิด</th>
                <th>ขนาด</th>
                <th>จำนวนทั้งหมด</th>
                <th>จำนวนคงเหลือ</th>
                <th>ความสำคัญ</th>
                <th>สถานะ</th>
                <th>จำนวนของถูกยืมไป</th>
            </tr>
        </thead>
        <tbody>            
            <?php while ($row = mysql_fetch_array($query)) : ?>
                <tr>
                    <td><?= $row['ite_name'] ?></td>
                    <td><?= $row['gro_name'] ?></td>
                    <td><?= $row['typ_name'] ?></td>
                    <td><?= $row['siz_name'] ?></td>
                    <td><?= $row['ite_total_no'] ?></td>
                    <td><?= $row['ite_balance_no'] ?></td>
                    <td><?= $row['ite_priority'] ?></td>
                    <td><?= $row['ite_status'] ?></td>
                    <td><?= $row['count_borrow'] ?></td>
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
