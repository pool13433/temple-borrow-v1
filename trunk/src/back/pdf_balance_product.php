<?php

include_once '../../config/app_connect.php';
require '../../MPDF57/mpdf.php';
if (!empty($_GET)):
    $sql = " SELECT * FROM item WHERE 1=1 ";
    if (!empty($_GET['group'])):
        $sql .= " AND gro_id = " . $_GET['gro_id'];
    endif;
    if (empty($_GET['opertion'])):
        $sql .= " AND ite_balance_no " . $_GET['opertion'] . "  " . $_GET['number'];
    endif;
    $sql .= " ORDER BY ite_id DESC";
endif;

