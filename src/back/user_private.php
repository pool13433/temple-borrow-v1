
<div class="panel panel-info">
    <div class="panel-heading">        
        <i class="glyphicon glyphicon-edit"></i> หน้าจัดการข้อมูลส่วนตัว
    </div>
    <div class="panel-body">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active">
                <a href="#password" data-toggle="tab">
                    <i class="glyphicon glyphicon-edit"></i> แก้ไข username , password
                </a>
            </li>
            <li>
                <a href="#profile" data-toggle="tab">
                    <i class="glyphicon glyphicon-user"></i>  แก้ไข ข้อมูลส่วนตัว
                </a>
            </li>
        </ul>
        <div id="my-tab-content" class="tab-content">
            <div class="tab-pane active" id="password">                
                <!--    form-->
                <?php include './form_editpassword.php'; ?>
                <!--    form-->
            </div>
            <div class="tab-pane" id="profile">
                <!--    form-->
                <?php include './form_editprofile.php'; ?>
                <!--    form-->
            </div>            
        </div>
    </div>
</div>
