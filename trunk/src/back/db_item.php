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
            $type = $_POST['type'];
            $item_total_no = $_POST['item_total_no'];
            $item_balance_no = $_POST['item_balance_no'];
            $size = $_POST['size'];
            $attribute = $_POST['attribute'];
            $priority = $_POST['priority'];
            $status = $_POST['status'];
            $remark = $_POST['remark'];

            if (empty($id)) { // insert
                // กรณี เพิ่ม
                $msg = 'เพิ่มข้อมูลสำเร็จ';
                // สร้าง string sql
                $sql .= " INSERT INTO `item` (ite_name,gro_id,typ_id,ite_total_no,ite_balance_no,siz_id";
                $sql .= " ,ite_attribute,ite_priority,ite_status,ite_createdate,ite_remark)";
                $sql .= " VALUES (";
                $sql .= " '" . $name . "'," . $group . "," . $type . "," . $item_total_no . "," . $item_balance_no . "," . $size;
                $sql .= " ,'" . $attribute . "'," . $priority . "," . $status . ",NOW(),'" . $remark . "'";
                $sql .= " )";
            } else { // update
                // กรณี เพิ่ม
                $msg = 'แก้ไขข้อมูลสำเร็จ';
                // สร้าง string sql
                $sql .= " UPDATE `item` SET ";
                $sql .= "  ite_name = '" . $name . "'";
                $sql .= "  ,gro_id = " . $group;
                $sql .= "  ,typ_id = " . $type;
                $sql .= "  ,ite_total_no= " . $item_total_no;
                $sql .= "  ,ite_balance_no = " . $item_balance_no;
                $sql .= ", siz_id = " . $size;
                $sql .= ", ite_attribute = '" . $attribute . "'";
                $sql .= ", ite_priority = " . $priority;
                $sql .= ", ite_status = " . $status;
                $sql .= ", ite_remark = '" . $remark . "'";
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
    case 'manageitem':
        $ite_id = $_POST['id'];
        $value = $_POST['ite_no'];
        $type = $_POST['type'];
        // คืน จำนวน เข้า สต๊อก
        $total_no = getItemTotalNo($ite_id);
        $balance_no = getItemBalanceNo($ite_id);
        // update 
        $sql_item = "UPDATE item SET ";
        if ($type == 0): // แสดงว่ากำลัง ลบ ทรัพยากร
            // set ค่า columns ite_balance_no = จำนวน ของคงเหลือที่มี ล่าสุด - จำนวนของ = ของ คงเหลือ
            $sql_item .= " ite_balance_no = " . ($balance_no - $value);
            // set ค่า columns ite_total_no = จำนวนทั้งหมด ของที่มี ล่าสุด - จำนวนของ = ของ ทั้งหมด
            $sql_item .= " ,ite_total_no = " . ($total_no - $value);
        else:// แสดงว่ากำลัง เพิ่ม ทรัพยากร
            // set ค่า columns ite_balance_no = จำนวน ของคงเหลือที่มี ล่าสุด + จำนวนของ = ของ คงเหลือ
            $sql_item .= " ite_balance_no = " . ($balance_no + $value);
            // set ค่า columns ite_total_no = จำนวนทั้งหมด ของที่มี ล่าสุด + จำนวนของ = ของ ทั้งหมด
            $sql_item .= " ,ite_total_no = " . ($total_no + $value);
        endif;
        $sql_item .= " WHERE ite_id = " . $ite_id;
        echo mysql_query($sql_item) or die(mysql_error());
        break;
    default:
        break;
}

function getItemTotalNo($item_id) {
    $sql = "SELECT * FROM item WHERE ite_id = " . $item_id;
    //echo 'getItemNo => sql : ' . $sql;
    $query = mysql_query($sql) or die(mysql_error());
    if ($query) {
        $result = mysql_fetch_assoc($query);
        return $result['ite_total_no'];
    } else {
        exit();
    }
}

function getItemBalanceNo($item_id) {
    $sql = "SELECT * FROM item WHERE ite_id = " . $item_id;
    //echo 'getItemNo => sql : ' . $sql;
    $query = mysql_query($sql) or die(mysql_error());
    if ($query) {
        $result = mysql_fetch_assoc($query);
        return $result['ite_balance_no'];
    } else {
        exit();
    }
}

?>
