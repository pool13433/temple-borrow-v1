<?php
include_once '../../config/app_connect.php';
require '../../MPDF57/mpdf.php';
if (!empty($_GET['id'])):
    $sql_header = "SELECT *";
    $sql_header .= " FROM borrow br ";
    $sql_header .= " JOIN person p ON p.per_id = br.per_id";
    $sql_header .= " JOIN amphures ap ON ap.amphur_id = p.amphure_id";
    $sql_header .= " JOIN districts dt ON dt.district_id = p.district_id";
    $sql_header .= " JOIN provinces pv ON pv.province_id = p.province_id";
    $sql_header .= " WHERE br.bor_id = " . $_GET['id'];
    $query_header = mysql_query($sql_header) or die(mysql_error());
    $result_header = mysql_fetch_assoc($query_header);
    $bor_id = $result_header['bor_id'];
    $bor_createdate = $result_header['bor_createdate'];
    $bor_start = $result_header['bor_start'];
    $bor_end = $result_header['bor_end'];
    $per_fname = $result_header['per_fname'];
    $per_lname = $result_header['per_lname'];
    $per_idcard = $result_header['per_idcard'];
    $address = $result_header['per_address'];
    $province = $result_header['province_name'];
    $amphur = $result_header['amphur_name'];
    $district = $result_header['district_name'];
    $tel = $result_header['per_tel'];
    $email = $result_header['per_email'];

    $sql_body = "SELECT * FROM borrow_detail bd";
    $sql_body .= " JOIN item i ON i.ite_id = bd.ite_id";
    $sql_body .= " WHERE bd.bor_id = " . $bor_id;
    $query_body = mysql_query($sql_body) or die(mysql_error());

    ob_start();
    ?>
    <link rel="stylesheet" type="text/css" href="../../css/report_style.css"/>
    <h2 align="center">ใบยืม ทรัพย์สินของวัดเหล่าอ้อย </h2>

    <h3>ข้อมูลผู้ยืม</h3>
    <table width="100%">
        <tr>
            <th scope="col">เลขที่เอกสาร</th>
            <th scope="col"><?= $bor_id ?></th>
            <th scope="col">วันที่ยืม</div></th>
            <th scope="col"><?= $bor_createdate ?></th>
        </tr>
        <tr>
            <th width="20%" scope="col"><div align="center">ชื่อ-สกุล</div></th>
    <th width="30%" scope="col"><?= $per_fname . " " . $per_lname ?></th>
    <th width="20%" scope="col"><div align="center">รหัสบัตร</div></th>
    <th width="30%" scope="col"><?= $idcard ?></th>
    </tr>
    <tr>
        <td width="20%"><div align="center">ที่อยู่</div></td>
        <td colspan="3"><?= $address ?></td>
    </tr>
    <tr>
        <td><div align="center">โทร</div></td>
        <td><?= $tel ?></td>
        <td><div align="center">อีเมลล์</div></td>
        <td><?= $email ?></td>
    </tr>
    <tr>
        <td width="20%"><div align="center">วันที่ ต้องการใช้งาน </div></td>
        <td width="30%"><?= $bor_start ?></td>
        <td width="20%"><div align="center">วันที่ต้องคืน</div></td>
        <td width="30%"><?= $bor_end ?></td>
    </tr>
    </table>
    <hr/>

    <h3>รายการของที่ยืม</h3>
    <table width="100%">
        <thead>
            <tr>
                <th width="10%" align="center" valign="middle" scope="col">ลำดับ</th>
                <th scope="col">ชื่อทรัพย์สิน</th>
                <th width="15%" align="center" valign="middle" scope="col">จำนวน</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php while ($row = mysql_fetch_array($query_body)): ?>
                <tr>
                    <td width="10%" align="center" valign="middle"><?= $no ?></td>
                    <td><?= $row['ite_name'] ?></td>
                    <td width="15%" align="center" valign="middle"><?= $row['bordet_no'] ?></td>
                </tr>
                <?php
                $no++;
            endwhile;
            ?>
        </tbody>
    </table>
    <hr/>
    <table width="100%">
        <tr>
            <th width="45%" scope="col"><div align="center">ชื่อ.....................................................................................</div></th>
    <th width="10%" scope="col">&nbsp;</th>
    <th width="45%" scope="col"><div align="center">ชื่อ.....................................................................................</div></th>
    </tr>
    <tr>
        <th width="45%"><div align="center">(........<?= $per_fname . " " . $per_lname ?>......)</div></th>
        <th width="10%">&nbsp;</th>
        <th width="45%"><div align="center">(..................................................................................)</div></th>
    </tr>
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
    