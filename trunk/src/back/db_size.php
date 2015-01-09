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
            $group = $_POST['group'];

            if (empty($id)) { // insert
                // กรณี เพิ่ม
                $msg = 'เพิ่มข้อมูลสำเร็จ';
                // สร้าง string sql
                $sql .= " INSERT INTO `size` (siz_name,gro_id,siz_createdate)";
                $sql .= " VALUES (";
                $sql .= " '" . $name . "'," . $group . ",NOW()";
                $sql .= " )";
            } else { // update
                // กรณี เพิ่ม
                $msg = 'แก้ไขข้อมูลสำเร็จ';
                // สร้าง string sql
                $sql .= " UPDATE `size` SET ";
                $sql .= "  siz_name = '" . $name . "'";
                $sql .= "  ,gro_id = " . $group;
                $sql .= " WHERE siz_id = " . $id;
            }

            // ประมวลผลคำสั่ง
            $query = mysql_query($sql) or die(mysql_error());
            // ตรวจสอบ 
            if ($query) { // true
                // แสดงข้อความ
                echo returnMessage(INFORMATION, $msg);
                // ย้อนกลับไปหน้า แรก
                echo redirectUrl('manage_size');
            } else { //false
                echo returnMessage(ERROR, 'Error 500');
            }
        }
        break;
    case 'delete':
        $id = $_POST['id'];
        $sql = "DELETE FROM `size` WHERE siz_id = " . $id;
        echo mysql_query($sql) or die(mysql_error());        
        break;
    default:
        break;
}
?>
