<?php
@ob_start();
@session_start();
?>
<ul class="nav nav-pills nav-stacked">
    <li class="dropdown">
        <a class="dropdown-toggle alert-info" data-toggle="dropdown" href="#">
            <span class="caret"></span> ข้อมูลส่วนตัว
        </a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="index.php?page=user_private&id=<?= $_SESSION['person']['per_id'] ?>&method=create">แก้ไขข้อมูลสว่นตัว</a></li>                     
            <li class="divider"></li>
            <li>
                <a href="#" class="alert-danger" onclick="return logout()">
                    <i class="glyphicon glyphicon-log-out"></i> Logout
                </a>
            </li>            
        </ul>
    </li>
    <?php if ($_SESSION['person']['per_status'] == 1): ?>
        <li class="dropdown">
            <a class="dropdown-toggle alert-warning" data-toggle="dropdown" href="#">
                <span class="caret"></span> วัสดุ / อุปกรณ์ 
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="index.php?page=manage_group">กลุ่ม</a></li>
                <li><a href="index.php?page=manage_type">ประเภท</a></li>            
                <li class="divider"></li>
                <li><a href="index.php?page=manage_item">Item</a></li>
                <li class="divider"></li>  
                <li><a href="index.php?page=manage_size">ขนาด</a></li>
                <li class="divider"></li>  
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle alert-success" data-toggle="dropdown" href="#">
                <span class="caret"></span> ตั้งค่า ระบบ 
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="index.php?page=manage_person">ผู้ใช้งาน</a></li>                     
                <li class="divider"></li>            
            </ul>
        </li>
    <?php endif; ?>
    <li class="dropdown">
        <a class="dropdown-toggle alert-warning" data-toggle="dropdown" href="#">
            <span class="caret"></span> เกี่ยวกับ ใบ ยืม
        </a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="index.php?page=manage_borrow">ใบยืม</a></li>                     
            <li class="divider"></li>            
        </ul>
    </li>
    <li class="dropdown">
        <a class="dropdown-toggle alert-danger" data-toggle="dropdown" href="#">
            <span class="caret"></span> รายงาน
        </a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="index.php?page=report_daymonthyear">รายงานสรุปข้อมูลการยืมคืนประจำวัน /เดือน/ ปี</a></li>                     
            <li><a href="index.php?page=report_check_asset">รายงานสรุปข้อมูลการตรวจสอบสิ่งของที่สูญหาย</a></li>
            <li class="divider"></li>  
        </ul>
    </li>
</ul>