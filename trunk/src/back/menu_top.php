<?php session_start(); ?>
<nav role="navigation" class="navbar navbar-default navbar-static navbar-fixed-top" id="navbar-example">
    <div class="container-fluid">
        <!--<div class="navbar-header">
            <button data-target=".bs-example-js-navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">ระบบบริหารจัดการของวัด</a>
        </div>-->
        <div class="collapse navbar-collapse bs-example-js-navbar-collapse">
            <ul class="nav navbar-nav">
                <?php if ($_SESSION['person']['per_status'] == 1): ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="glyphicon glyphicon-gift"></i> จัดการสิ่งของวัด <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="index.php?page=manage_group">กลุ่ม</a></li>
                            <li><a href="index.php?page=manage_type">ประเภท</a></li>            
                            <li><a href="index.php?page=manage_size">ขนาด</a></li>                            
                            <li class="divider"></li>
                            <li><a href="index.php?page=manage_item">สิ่งของ</a></li>
                        </ul>
                    </li>
                    <li><a href="index.php?page=manage_person"><i class="glyphicon glyphicon-cog"></i> จัดการผู้ใช้งาน</a></li> 
                    <!--<li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="glyphicon glyphicon-cog"></i> ตั้งค่า ผู้ใช้งาน <span class="caret"></span> 
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="index.php?page=manage_person">ผู้ใช้งาน</a></li>                     
                        </ul>
                    </li>-->
                <?php endif; ?>
                <li><a href="index.php?page=manage_borrow"><i class="glyphicon glyphicon-list-alt"></i> จัดการยืมคืน</a></li> 
                <!--<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="glyphicon glyphicon-list-alt"></i> เกี่ยวกับ ใบ ยืม<span class="caret"></span> 
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="index.php?page=manage_borrow">ใบยืม</a></li>                                             
                    </ul>
                </li>-->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="glyphicon glyphicon-download"></i> รายงาน<span class="caret"></span> 
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="index.php?page=report_daymonthyear">รายงานสรุปข้อมูลการยืมคืนประจำวัน /เดือน/ ปี</a></li>                     
                        <li><a href="index.php?page=report_check_asset">รายงานสรุปข้อมูลการตรวจสอบสิ่งของที่สูญหาย</a></li>
                        <li><a href="index.php?page=report_sumorder_byperson">รายงานสรุปใบยืมของวัดตามผู้ใช้งาน</a></li>
                        <li><a href="index.php?page=report_balance_product">รายงานสรุปสิ่งของวัดคงเหลือ</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="alert-warning" href="index.php?page=user_private&id=<?= $_SESSION['person']['per_id'] ?>&method=create">แก้ไขข้อมูลสว่นตัว</a></li>
                <li> <a href="#" class="alert-danger" onclick="return logout()"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>        
            </ul>
        </div><!-- /.nav-collapse -->
    </div><!-- /.container-fluid -->
</nav>