<?php

@ob_start();
@session_start();
include_once '../config/app_connect.php';
include_once '../config/app_function.php';

switch ($_GET['method']) {
    case 'register':
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $birthday = $_POST['birthday'];
        /* echo $_POST['birthday'];
          $birthday_format = explode('/', $_POST['birthday']);
          $birthday = $birthday_format[2] . "/" . $birthday_format[1] . "/" . $birthday_format[0]; */
        $idcard = $_POST['idcard'];
        $address = $_POST['address'];
        $district = $_POST['district'];
        $province = $_POST['province'];
        $amphure = $_POST['amphure'];
        $zipcode = $_POST['zipcode'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];

        $sql_register = "INSERT INTO person (per_username,per_password,per_fname,per_lname";
        $sql_register .= " ,per_age,per_birthday,per_idcard,per_address,district_id,province_id";
        $sql_register .= " ,amphure_id,per_zipcode,per_tel,per_email,per_createdate,per_status )VALUES(";
        $sql_register .= " '" . $username . "','" . $password . "','" . $fname . "','" . $lname . "'";
        $sql_register .= " ," . $age . ",'" . $birthday . "','" . $idcard . "','" . $address . "'," . $district . "," . $province;
        $sql_register .= " ," . $amphure . "," . $zipcode . ",'" . $tel . "','" . $email . "',NOW(),3";
        $sql_register .= ")";
        //exit();
        $result = mysql_query($sql_register) or die(mysql_error());
        if ($result) {
            echo returnMessage(INFORMATION, 'Register Complete');
            echo redirectUrl('login');
        } else {
            echo returnMessage(ERROR, 'Register Complete');
        }
        break;
    case 'login':
        // สร้าง ตัวแปร มารับค่า 
        $username = $_POST['username'];
        $password = $_POST['password'];

        // เขียนคำสั่ง ค้นหา ข้อมูล username ,password
        $sql_login = "SELECT * FROM person ";
        $sql_login .= " WHERE per_username = '" . $username . "'";
        $sql_login .= " AND per_password = '" . $password . "'";
        $sql_login .= " AND per_active = 1"; // active เรียบร้อยแล้ว

        // ประมวลผล คำสั่ง         
        $result = mysql_query($sql_login) or die(mysql_error() . $sql_login);

        // คำสั่ง นับ แถว
        $row = mysql_num_rows($result) or die(mysql_error());

        // สร้างตัวแปร รับค่า เพื่อคืนค่าไป แบบ json
        $message = "";

        // ตรวจสอบ แถว  1 => มี ชื่อในระบบ 0 => ไม่มีชื่อในระบบ
        if ($row == 1) {
            $url = "";
            // รับค่าใส่ตัวแปร
            $person = mysql_fetch_assoc($result);

            //สร้าง session เก็บค่า 
            $_SESSION['person'] = $person; // เวลาใช้งาน $_SESSION['person']['per_username'] จะแสดง username

            switch ($person['per_status']) {
                case '1': // officer
                    $url = 'back/index.php?page=home';
                    break;
                case '2': // head officer
                    $url = 'back/index.php?page=home';
                    break;
                case '3': // member
                    $url = 'front/index.php?page=home';
                    break;
                default:
                    break;
            }
            echo $url;
        } else {
            echo '';
        }
        break;
    case 'logout':
        if (!empty($_SESSION)) {
            $_SESSION['person'] = null;
        }
        break;
    default:
        echo alert_message('danger', 'no method');
        break;
}
?>
