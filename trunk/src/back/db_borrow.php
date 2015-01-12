<?php

@ob_start();
@session_start();
include '../../config/app_connect.php';
include '../../config/app_function.php';

// 
switch ($_GET['method']) {
    case 'borrow_manage':
        $id = $_POST['id'];

        $sql = " UPDATE borrow SET ";

        if ($_SESSION['person']['per_status'] == 1) {
            $bor_status = $_POST['bor_status'];

            $bor_result = $_POST['bor_result'];
            $bor_remark = $_POST['bor_remark'];

            if (!empty($bor_status) && !empty($bor_result)) {
                if (!empty($bor_status)) {
                    $sql .= " bor_status = " . $bor_status;
                }

                if (!empty($bor_result)) {
                    $sql .= " ,bor_result = " . $bor_result;
                    $sql .= " ,bor_remark = '" . $bor_remark . "'";
                }
            } else {
                if (!empty($bor_status)) {
                    $sql .= " bor_status = " . $bor_status;
                }

                if (!empty($bor_result)) {
                    $sql .= " bor_result = " . $bor_result;
                    $sql .= " ,bor_remark = '" . $bor_remark . "'";
                }

                $bor_approve = $_POST['bor_approve'];

                if (!empty($_POST)) {
                    $sql .= " ,bor_approve = " . $bor_approve;
                }
            }

            // ############# ตัด สต๊อก #################
            if ($bor_status == 2) { // 2 = ยืม
                cutStockAsset($id);
            }
            // ############# จบ สต๊อก #################
        } else {
            $bor_approve = $_POST['bor_approve'];

            if (!empty($_POST)) {
                $sql .= " bor_approve = " . $bor_approve;
            }
        }
        $sql .= " WHERE bor_id = " . $id;
        echo mysql_query($sql) or die(mysql_error() . ' :: ' . $sql);
        break;
    case 'checkupdateitem':
        // ######### รับค่า จาก form ########
        $id = $_POST['id'];
        $value = $_POST['value'];
        $ite_id = $_POST['ite_id'];
        // ######### end รับค่า จาก form#####

        $sql = " UPDATE borrow_detail SET ";
        $sql .= " bordet_return_no = " . $value;
        $sql .= " WHERE bordet_id = " . $id;

        // ##################  restore item ###############
        // คืน จำนวน เข้า สต๊อก
        $total_no = getItemNo($ite_id);
        // update 
        $sql_item = "UPDATE item SET ";
        // set ค่า columns ite_balance_no = จำนวน ของที่มี ล่าสุด + จำนวนของ ที่คืน = ของ คงเหลือ
        $sql_item .= " ite_balance_no = " . ($total_no + $value);
        $sql_item .= " WHERE ite_id = " . $ite_id;
        $query = mysql_query($sql_item) or die(mysql_error());

        // ตรวจสอบ ถ้า เกิดข้อผิดพลาด ให้ หยุดการทำงาน
        if (!$query) {
            echo ' cut stock fail';
            exit();
        }
        // ################## end restore item ############

        echo mysql_query($sql) or die(mysql_error());
        break;
    case 'approveitemnumber':
        // จ่าย จำนวนของที่มี ใน คลัง
        // ######### รับค่า จาก form ########
        $id = $_POST['id'];
        $value = $_POST['value'];
        $ite_id = $_POST['ite_id'];
        // ######### end รับค่า จาก form#####

        $sql = " UPDATE borrow_detail SET ";
        $sql .= " bordet_approve_no = " . $value;
        $sql .= " WHERE bordet_id = " . $id;

        // ##################  restore item ###############
        // คืน จำนวน เข้า สต๊อก
        $total_no = getItemNo($ite_id);
        // update 
        $sql_item = "UPDATE item SET ";
        // set ค่า columns ite_balance_no = จำนวน ของที่มี ล่าสุด - จำนวนของ ที่คืน = ของ คงเหลือ
        $sql_item .= " ite_balance_no = " . ($total_no - $value);
        $sql_item .= " WHERE ite_id = " . $ite_id;
        $query = mysql_query($sql_item) or die(mysql_error());

        // ตรวจสอบ ถ้า เกิดข้อผิดพลาด ให้ หยุดการทำงาน
        if (!$query) {
            echo ' approve stock fail';
            exit();
        }
        // ################## end restore item ############

        echo mysql_query($sql) or die(mysql_error());
        break;
    default:
        echo ' no method';
        break;
}

function cutStockAsset($bor_id) {
    // query item ที่ เลือก ยืม มาทั้งหมด โดย where bor_id
    $sql_borrow_detail = "SELECT * FROM borrow_detail WHERE bor_id = " . $bor_id;
    $query_borrow_detail = mysql_query($sql_borrow_detail) or die(mysql_error());

    // loop while
    while ($row = mysql_fetch_array($query_borrow_detail)) {
        // ############### cut stock ####################
        // ไป query จำนวนของ item ล่าสุดมาก่อน โดย function [ getItemNo ] ส่ง item _id เข้า ไป where
        $total_no = getItemNo($row['ite_id']);

        // update 
        $sql_item = "UPDATE item SET ";
        // set ค่า columns ite_balance_no = จำนวน ของที่มี ล่าสุด - จำนวนของ ที่ยืม = ของ คงเหลือ
        $sql_item .= " ite_balance_no = " . ($total_no - $row['bordet_no']);
        $sql_item .= " WHERE ite_id = " . $row['ite_id'];
        $query = mysql_query($sql_item) or die(mysql_error());

        // ตรวจสอบ ถ้า เกิดข้อผิดพลาด ให้ หยุดการทำงาน
        if (!$query) {
            echo ' cut stock fail';
            exit();
        }
        // ############### end  cut stock ################
    }
}

function getItemNo($item_id) {
    $sql = "SELECT * FROM item WHERE ite_id =" . $item_id;
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
