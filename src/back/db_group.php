<?php

@ob_start();
@session_start();
include '../../config/app_connect.php';

// 
switch ($_GET['method']) {
    case 'create':
        if (!empty($_POST)) {

            $msg = "";
            $sql = "";

            $id = $_POST['id'];
            $name = $_POST['name'];

            if (empty($id)) { // insert
                // กรณี เพิ่ม
                $msg = 'เพิ่มข้อมูลเข้าระบบ สำเร็จ';
                // สร้าง string sql
                $sql .= " INSERT INTO `group` (gro_name,gro_createdate)";
                $sql .= " VALUES (";
                $sql .= " '" . $name . "',NOW()";
                $sql .= " )";
            } else { // update
                // กรณี เพิ่ม
                $msg = 'แก้ไขข้อมูล สำเร็จ';
                // สร้าง string sql
                $sql .= " UPDATE `group` SET ";
                $sql .= "  gro_name = '" . $name . "'";
                $sql .= " WHERE gro_id = " . $id;
            }

            // ประมวลผลคำสั่ง
            $query = mysql_query($sql) or die(mysql_error());
            // ตรวจสอบ 
            if ($query) { // true
                // แสดงข้อความ
                echo returnMessage(INFORMATION, $msg);
                // ย้อนกลับไปหน้า แรก
                echo redirectUrl('manage_group');
            } else { //false
                echo returnMessage(ERROR, 'Error 500');
            }
        }
        break;
    case 'delete':
        $id = $_POST['id'];
        $sql = "DELETE FROM `group` WHERE gro_id = " . $id;
        echo mysql_query($sql) or die(mysql_error());
        break;
    default:
        break;
}
?>
