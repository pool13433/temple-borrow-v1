<?php

include '../../config/app_connect.php';

switch ($_GET['method']) {
    case 'json':
        $district_id = $_GET['district_id'];
        $sql = " SELECT zc.* FROM zipcodes zc ";
        $sql .= " JOIN districts dt ON zc.district_code = dt.district_code";
        $sql .= " WHERE dt.district_id = " . $district_id;
        //echo 'sql ' . $sql_amphure;
        $query = mysql_query($sql) or die(mysql_error());
        //$result = array();
//        while ($row = mysql_fetch_array($query)) {
//            $result[] = $row;
//        }
        $result = mysql_fetch_assoc($query);
        echo json_encode($result);
        break;

    default:
        break;
}
?>
