<?php

@ob_start();
@session_start();
include '../../config/app_connect.php';
include '../../config/app_function.php';

switch ($_GET['method']) {
    case 'create':

        $msg = 'เพิ่มข้อมูลเข้าระบบ สำเร็จ';

        $borrow_id = $_SESSION['borrow_id'];
        if (!empty($_SESSION['borrow_confirm_id'])) {
            $borrow_id = $_SESSION['borrow_confirm_id'];
        }
        $bor_get = change_dateDMY_TO_YMD($_POST['bor_get']);
        $bor_start = change_dateDMY_TO_YMD($_POST['bor_start']);
        $bor_end = change_dateDMY_TO_YMD($_POST['bor_end']);
        $bor_reason = $_POST['bor_reason'];


        $sql = "UPDATE borrow SET ";
        $sql .= " bor_get = '" . $bor_get . "'";
        $sql .= " ,bor_start = '" . $bor_start . "'";
        $sql .= " ,bor_end = '" . $bor_end . "'";
        $sql .= " ,bor_reason = " . $bor_reason;
        if (!empty($_POST['bor_detail'])) {
            $bor_detail = $_POST['bor_detail'];
            $sql .= " ,bor_detail = '" . $bor_detail . "'";
        }
        $sql .= " ,bor_status = 1";  // รอ การมายืม = 1
        $sql .= " WHERE bor_id = " . $borrow_id;
        //echo '$sql : ' + $sql;
        //exit();
        $query = mysql_query($sql) or die(mysql_error());

        // ตรวจสอบ 
        if ($query) { // true
            // แสดงข้อความ
            $_SESSION['borrow_id'] = null;
            echo returnMessage(INFORMATION, $msg);
            // ย้อนกลับไปหน้า แรก
            echo redirectUrl('main_temple_borrow');
        } else { //false
            echo returnMessage(ERROR, 'Error 500');
        }

        break;
    case 'update':
        $id = $_POST['id'];
        $value = $_POST['value'];
        $sql = "UPDATE borrow SET ";
        $sql .= " bor_status = " . $value;
        $sql .= " WHERE bor_id = " . $id;
        echo mysql_query($sql) or die(mysql_error());
        break;
    case 'newcart':
        unset($_SESSION['borrow_id']);
        unset($_SESSION['borrow_confirm_id']);
        echo 'เริ่ม เลือกของตะกร้าใหม่ได้';
        break;
    default:
        break;
}
