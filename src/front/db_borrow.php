<?php

@ob_start();
@session_start();
include '../../config/app_connect.php';
include '../../config/app_function.php';

switch ($_GET['method']) {
    case 'create':

        $msg = 'INSERT Complete';

        $borrow_id = $_SESSION['borrow_id'];
        $bor_get = $_POST['bor_get'];
        $bor_start = $_POST['bor_start'];
        $bor_end = $_POST['bor_end'];
        $bor_detail = $_POST['bor_detail'];

        $sql = "UPDATE borrow SET ";
        $sql .= " bor_get = '" . $bor_get . "'";
        $sql .= " ,bor_start = '" . $bor_start . "'";
        $sql .= " ,bor_end = '" . $bor_end . "'";
        $sql .= " ,bor_detail = '" . $bor_detail . "'";
        $sql .= " ,bor_status = 1";  // รอ การมายืม = 1
        $sql .= " WHERE bor_id = " . $borrow_id;

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
    default:
        break;
}
