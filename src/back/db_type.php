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
                $msg = 'INSERT Complete';
                // สร้าง string sql
                $sql .= " INSERT INTO `type` (typ_name,typ_createdate)";
                $sql .= " VALUES (";
                $sql .= " '" . $name . "',NOW()";
                $sql .= " )";
            } else { // update
                // กรณี เพิ่ม
                $msg = 'UPDATE Complete';
                // สร้าง string sql
                $sql .= " UPDATE `type` SET ";
                $sql .= "  typ_name = '" . $name . "'";
                $sql .= " WHERE typ_id = " . $id;
            }

            // ประมวลผลคำสั่ง
            $query = mysql_query($sql) or die(mysql_error());
            // ตรวจสอบ 
            if ($query) { // true
                // แสดงข้อความ
                echo returnMessage(INFORMATION, $msg);
                // ย้อนกลับไปหน้า แรก
                echo redirectUrl('manage_type');
            } else { //false
                echo returnMessage(ERROR, 'Error 500');
            }
        }
        break;
    case 'delete':
        $id = $_POST['id'];
        $sql = "DELETE FROM `type` WHERE typ_id = " . $id;
        echo mysql_query($sql) or die(mysql_error());
        break;
    default:
        break;
}
?>
