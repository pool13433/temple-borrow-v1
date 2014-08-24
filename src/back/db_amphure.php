<?php

include '../../config/app_connect.php';

switch ($_GET['method']) {
    case 'json':
        $id = $_GET['province_id'];
        if (!empty($_GET['province_id'])) {
            $sql_amphure = "SELECT * FROM amphures WHERE province_id = " . $id;
            //echo 'sql ' . $sql_amphure;
            $query = mysql_query($sql_amphure) or die(mysql_error());
            $result = array();
            while ($row = mysql_fetch_array($query)) {
                $result[] = $row;
            }
            echo json_encode($result);
            mysql_close();
        }

        break;

    default:
        break;
}
?>
