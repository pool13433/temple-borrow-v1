
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
            $status = $_POST['status'];

            if (empty($id)) { // insert
                // กรณี เพิ่ม
                $msg = 'เพิ่มข้อมูล สำเร็จ';
                // สร้าง string sql
                $sql = "INSERT INTO person (per_fname,per_lname";
                $sql .= " ,per_age,per_birthday,per_idcard,per_address,district_id,province_id";
                $sql .= " ,amphure_id,per_zipcode,per_tel,per_email,per_createdate,per_status )VALUES(";
                $sql .= " '" . $fname . "','" . $lname . "'";
                $sql .= " ," . $age . ",'" . $birthday . "','" . $idcard . "','" . $address . "'," . $district . "," . $province;
                $sql .= " ," . $amphure . "," . $zipcode . ",'" . $tel . "','" . $email . "',NOW()," . $status;
                $sql .= ")";
            } else { // update
                // กรณี เพิ่ม
                $msg = 'แก้ไขข้อมูล สำเร็จ';
                // สร้าง string sql
                $sql = "UPDATE person SET ";
                $sql .= " per_fname = '" . $fname . "'";
                $sql .= " ,per_lname = '" . $lname . "'";
                $sql .= " ,per_age = " . $age;
                $sql .= " ,per_birthday = '" . $birthday . "'";
                $sql .= " ,per_idcard = '" . $idcard . "'";
                $sql .= " ,per_address = '" . $address . "'";
                $sql .= " ,district_id = " . $district;
                $sql .= " ,amphure_id = " . $amphure;
                $sql .= " ,province_id = " . $province;
                $sql .= " ,per_zipcode = '" . $zipcode . "'";
                $sql .= " ,per_tel = '" . $tel . "'";
                $sql .= " ,per_email = '" . $email . "'";
                $sql .= " ,per_status = " . $status;
                $sql .= " WHERE per_id = " . $id;
            }

            // ประมวลผลคำสั่ง
            $query = mysql_query($sql) or die(mysql_error());
            // ตรวจสอบ 
            if ($query) { // true
                // แสดงข้อความ
                echo returnMessage(INFORMATION, $msg);
                // ย้อนกลับไปหน้า แรก
                echo redirectUrl('manage_person');
            } else { //false
                echo returnMessage(ERROR, 'Error 500');
            }
        }
        break;
    case 'delete':
        $id = $_POST['id'];
        $sql = "DELETE FROM `person` WHERE per_id = " . $id;
        echo mysql_query($sql) or die(mysql_error());
        break;
    case 'permission': // กำหนดสิทธิ สมัครสมาชิก
        $id = $_POST['id'];
        $value = $_POST['value'];
        $sql = "UPDATE `person` SET ";
        $sql .= " per_active = " . $value;
        $sql .= " WHERE per_id = " . $id;
        echo mysql_query($sql) or die(mysql_error());
        break;
    case 'changepassword':
        $id = $_SESSION['person']['per_id'];
        $password = $_POST['repasswordnew'];

        $sql = "UPDATE person SET ";
        $sql .= " per_password = '" . $password . "'";
        $sql .= " WHERE per_id = " . $id;
        $query = mysql_query($sql) or die(mysql_error());
        // ตรวจสอบ 
        if ($query) { // true
            // แสดงข้อความ
            echo returnMessage(INFORMATION, 'แก้ไข password สำเร็จ');
            // ย้อนกลับไปหน้า แรก
            echo redirectUrl('home');
        } else { //false
            echo returnMessage(ERROR, 'Error 500');
        }
        break;
    case 'changeprofile':
        $id = $_SESSION['person']['per_id'];

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

        $sql = "UPDATE person SET ";
        $sql .= " per_fname = '" . $fname . "'";
        $sql .= " ,per_lname = '" . $lname . "'";
        $sql .= " ,per_age = " . $age;
        $sql .= " ,per_birthday = '" . $birthday . "'";
        $sql .= " ,per_idcard = '" . $idcard . "'";
        $sql .= " ,per_address = '" . $address . "'";
        $sql .= " ,district_id = " . $district;
        $sql .= " ,amphure_id = " . $amphure;
        $sql .= " ,province_id = " . $province;
        $sql .= " ,per_zipcode = '" . $zipcode . "'";
        $sql .= " ,per_tel = '" . $tel . "'";
        $sql .= " ,per_email = '" . $email . "'";
        $sql .= " WHERE per_id = " . $id;

        $query = mysql_query($sql) or die(mysql_error());
        // ตรวจสอบ 
        if ($query) { // true
            // แสดงข้อความ
            echo returnMessage(INFORMATION, 'แก้ไข ข้อมูลส่วนตัว สำเร็จ');
            // ย้อนกลับไปหน้า แรก
            echo redirectUrl('home');
        } else { //false
            echo returnMessage(ERROR, 'Error 500');
        }
        break;
    case 'checkoldpassword':
        $id = $_SESSION['person']['per_id'];
        $oldpassword = $_POST['passwordold'];
        $sql = "SELECT * FROM `person` WHERE per_id = " . $id . " AND per_password = '" . $oldpassword . "'";
        //echo 'sql : ' . $sql;
        $query = mysql_query($sql) or die(mysql_error());
        $record = mysql_num_rows($query);
        echo $record;
        break;

    default:
        echo ' NO Method';
        break;
}
?>

