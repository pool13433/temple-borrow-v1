<?php

@ob_start();
@session_start();
include '../../config/app_connect.php';

switch ($_GET['method']) {
    case 'delete':
        $id = $_POST['id'];
        $sql = "DELETE FROM borrow_detail WHERE bordet_id = " . $id;
        echo mysql_query($sql) or die(mysql_error());
        break;
    case 'additem':
        $borrow_id = createNewCart();
        $id = $_POST['id'];
        $value = $_POST['value'];
        $sql = " INSERT INTO borrow_detail (bor_id,ite_id,bordet_no,bordet_return_no,bordet_createdate)";
        $sql .= " VALUES (";
        $sql .= $borrow_id . "," . $id . "," . $value . "," . $value . ",NOW()";
        $sql .= " )";
        //echo 'sql : ' . $sql;
        echo mysql_query($sql) or die(mysql_error());
        break;

    default:
        break;
}

function createNewCart() {
    $borrow_id = "";
    if (empty($_SESSION['borrow_id'])) {
        $sql = "INSERT INTO borrow";
        $sql .= " (per_id,bor_createdate)VALUES(";
        $sql .= $_SESSION['person']['per_id'] . ",NOW())";
        mysql_query($sql) or die(mysql_error());
        $borrow_id = mysql_insert_id();
        $_SESSION['borrow_id'] = $borrow_id;
    } else {
        $borrow_id = $_SESSION['borrow_id'];
    }
    return $borrow_id;
}

?>
