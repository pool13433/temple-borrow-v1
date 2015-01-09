<?php
include '../../config/app_connect.php';
switch ($_GET['method']) {
    case 'update_profile':
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
        $sql .= " WHERE per_id = " . $_SESSION['person']['per_id'];

        $query = mysql_query($sql) or die(mysql_error());
        if ($query):
            echo returnMessage(INFORMATION, 'แก้ไข ข้อมูลส่วนตัวสำเร็จ');
            echo redirectUrl('home');
        else:
            echo returnMessage(INFORMATION, 'ไม่สามารถแก้ไขข้อมูลได้ กรุณาติดต่อเจ้าหน้า');
        endif;
        break;

    default:
        break;
}
