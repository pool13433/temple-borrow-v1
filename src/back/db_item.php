<?php

@ob_start();
@session_start();
include '../../config/app_connect.php';
include '../../config/app_function.php';

// 
switch ($_GET['method']) {
    case 'create':
        if (!empty($_POST)) {

            $msg = "";
            $sql = "";

            $id = $_POST['id'];
            $name = $_POST['name'];
            $group = $_POST['group'];
            $type = $_POST['type'];
            $item_no = $_POST['item_no'];
            $size = $_POST['size'];
            $attribute = $_POST['attribute'];
            $priority = $_POST['priority'];
            $status = $_POST['status'];
            $remark = $_POST['remark'];

            if (empty($id)) { // insert
                // กรณี เพิ่ม
                $msg = 'INSERT Complete';
                // สร้าง string sql
                $sql .= " INSERT INTO `item` (ite_name,gro_id,typ_id,ite_no,siz_id";
                $sql .= " ,ite_attribute,ite_priority,ite_status,ite_createdate,ite_remark)";
                $sql .= " VALUES (";
                $sql .= " '" . $name . "'," . $group . "," . $type . "," . $item_no . "," . $size;
                $sql .= " ,'" . $attribute . "'," . $priority . "," . $status . ",NOW(),'" . $remark . "'";
                $sql .= " )";
            } else { // update
                // กรณี เพิ่ม
                $msg = 'UPDATE Complete';
                // สร้าง string sql
                $sql .= " UPDATE `item` SET ";
                $sql .= "  ite_name = '" . $name . "'";
                $sql .= "  ,gro_id = " . $group;
                $sql .= "  ,typ_id = " . $type;
                $sql .= "  ,ite_no = " . $item_no;
                $sql .= "  ,siz_id = " . $size;
                $sql .= "  ,ite_attribute = '" . $attribute . "'";
                $sql .= "  ,ite_priority = " . $priority;
                $sql .= "  ,ite_status = " . $status;
                $sql .= "  ,ite_remark = '" . $remark . "'";
                $sql .= " WHERE ite_id = " . $id;
            }

            // ประมวลผลคำสั่ง
            $query = mysql_query($sql) or die(mysql_error());
            // ตรวจสอบ 
            if ($query) { // true
                // แสดงข้อความ
                echo returnMessage(INFORMATION, $msg);
                // ย้อนกลับไปหน้า แรก
                echo redirectUrl('manage_item');
            } else { //false
                echo returnMessage(ERROR, 'Error 500');
            }
        }
        break;
    case 'delete':
        $id = $_POST['id'];
        $sql = "DELETE FROM `item` WHERE ite_id = " . $id;
        echo mysql_query($sql) or die(mysql_error());
        break;
    case 'addnewitem':
        $ite_id = $_POST['id'];
        $value = $_POST['ite_no'];
        // คืน จำนวน เข้า สต๊อก
        $total_no = getItemNo($ite_id);
        // update 
        $sql_item = "UPDATE item SET ";
        // set ค่า columns ite_no = จำนวน ของที่มี ล่าสุด + จำนวนของ ที่คืน = ของ คงเหลือ
        $sql_item .= " ite_no = " . ($total_no + $value);
        $sql_item .= " WHERE ite_id = " . $ite_id;
        echo mysql_query($sql_item) or die(mysql_error());        
        break;
    default:
        break;
}

function getItemNo($item_id) {
    $sql = "SELECT * FROM item WHERE ite_id =" . $item_id;
    //echo 'getItemNo => sql : ' . $sql;
    $query = mysql_query($sql) or die(mysql_error());
    if ($query) {
        $result = mysql_fetch_assoc($query);
        return $result['ite_no'];
    } else {
        exit();
    }
}

?>
