<?php

include '../../config/app_connect.php';

switch ($_GET['method']) {
    case 'searchitem':
        $ampure_id = $_GET['ampure_id'];
        $sql = "SELECT * FROM districts WHERE ampure_id = " . $ampure_id;
        //echo 'sql ' . $sql_amphure;
        $query = mysql_query($sql) or die(mysql_error());
        $result = array();
        while ($row = mysql_fetch_array($query)) {
            $result[] = $row;
        }
        echo json_encode($result);

        mysql_close();
        break;

    default:
        break;
}
?>
