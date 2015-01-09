<?php

define('ERROR', 'red');
define('INFORMATION', 'green');

function alert_message($color = null, $msg = null) {
    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
    $colorCls = "alert alert-info";
    $messageContent = " No Content";
    if (!empty($color)) {
        $colorCls = "alert alert-" . $color;
    }
    if (!empty($msg)) {
        $messageContent = $msg;
    }
    $message = "<div class='" . $colorCls . "'>";
    $message .= "<label>" . $messageContent . " </label>";
    $message .= "</div>";
    return $message;
}

function breadCrumbs($urlMain, $nameMain, $urlForm = null, $nameForm = null) {
    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
    $breadcrumds = '<ol class = "breadcrumb">';
    $breadcrumds .= '<li><a href = "index.php?page=' . $urlMain . '">' . $nameMain . '</a></li>';
    if (!empty($urlForm)) {
        $breadcrumds .= '<li><a href = "index.php?page=' . $urlForm . '">' . $nameForm . '</a></li>';
    }
    $breadcrumds .= '</ol>';
    return $breadcrumds;
}

function returnMessage($color, $msg) {
    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
    $message = "<div style='background-color: yellowgreen;color: " . $color . ";padding: 20px;font-size: large;color: white;'>";
    $message .= $msg . "</div>";
    return $message;
}

function redirectUrl($page) {
    return "<META HTTP-EQUIV='refresh' CONTENT='1.5; URL=./index.php?page=" . $page . "'>";
}

function goLogin() {
    echo '<script type="text/javascript">';
//echo 'alert(" กรุณา login เข้าระบบ ก่อน เข้าใช้งาน"")';
    echo 'window.location = "../index.php?page=login"';
    echo '</script>';
}

function printSql($sql) {
    return "<pre> sql : " . $sql . "</pre>";
//return '';
}

function randomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return (string) $randomString;
}

function uploadFile($file, $path) {
    $img_temp = "";
    $upload = "";
    $img_new = "";
//$_FILES["file"][""];
    $temp = explode(".", $file["name"]);
    $img_temp = $file["tmp_name"];
    $img_type = $file["type"];
    $img_size = $file["size"];
    $img_name = $file["name"];
    if (!empty($img_temp)) {
        $img_random_name = randomString() . "." . $temp[1];
        $img_new = $path . $img_random_name;

        $upload = move_uploaded_file($img_temp, $img_new);
    }
    return $img_new;
}

function arrayAttribute() {
    return array(
        '' => '-- เลือก --',
        '1' => 'ต่อชิ้น',
        '2' => 'ต่อแพ็ค',
    );
}

function arrayUserStatus() {
    return array(
        '1' => 'OFFICER (เจ้าหน้าที่ทั่วไป)',
        '2' => 'HEAD OFFICER (หัวหน้า เจ้าหน้าที่)',
        '3' => 'MEMBER (ผู้ใช้งานทั่วไป)',
    );
}

function arrayPriority() {
    return array(
        '' => '-- เลือก --',
        '1' => 'ปกติ',
        '2' => 'พิเศษ',
    );
}

function arrayStatus() {
    return array(
        '' => '-- เลือก --',
        '0' => 'ปกติ',
        '1' => 'ถูกยืม',
        '2' => 'ชำรุด',
        '3' => 'สูญหาย',
    );
}

function arrayBorrowResult() {
    return array(
        '' => '-- เลือก --',
        '1' => 'คืนครบ',
        '2' => 'คืนไม่ครบ'
    );
}

function arrayBorrowApprove() {
    return array(
        '' => '-- เลือก --',
        '0' => 'รอ อนุมัต',
        '1' => 'อนุมัติ เรียบร้อยแล้ว'
    );
}

function arrayBorrowStatus() {
    return array(
        '' => '-- เลือก --',
        '0' => 'รอ',
        '1' => 'รอ ยืม',
        '2' => 'ยืม',
        '3' => 'คืน',
        '4' => 'มา รับของ ล่าช้า',
        '5' => 'ไม่มารับของ',
        '6' => 'ยกเลิก'
    );
}
function arrayReason(){
    return array(        
        '1' => 'งานแต่งงาน',
        '2' => 'งานบวช',
        '3' => 'งานศพ',
        '4' => 'งานขึ้นบ้านใหม่',        
        '0' => 'อื่น ๆ ระบุ',
    );
}

function convertDate($date, $spile = null, $format = null) {
    $newdate = '';
    $a = '-';
    if ($spile != null) {
        $a = $spile;
    }
    if (strtoupper($format) == 'YMD') {
        $newdate = date('Y' . $a . 'm' . $a . 'd', strtotime($date));
    } else if (strtoupper($format) == 'DMY') {
        $newdate = date('d' . $a . 'm' . $a . 'Y', strtotime($date));
    } else if (strtoupper($format) == 'MDY') {
        $newdate = date('m' . $a . 'd' . $a . 'Y', strtotime($date));
    } else {
        $newdate = date('d' . $a . 'm' . $a . 'Y', strtotime($date));
    }
    return $newdate;
}

function genarateReport($htmlContent) {
    $mpdf = new mPDF("UTF-8");
    $mpdf->SetAutoFont();
    $mpdf->WriteHTML($html);
    $mpdf->Output();
}

?>
