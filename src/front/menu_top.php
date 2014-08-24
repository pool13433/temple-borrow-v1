<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">                   
            <a class="navbar-brand" href="#">Temple Asset 2014</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php?page=main_temple_borrow">ประวัติการยืม</a></li>
                <li><a href="index.php?page=main_item">สิ่งของ</a></li>
                <li><a href="index.php?page=main_cart">ยืม</a></li>                        
            </ul>
            <form class="nav navbar-form navbar-left" role="search" id="search-form">
                <div class="form-group">
                    <input type="text" class="form-control" name="search" onchange="searchItem()" placeholder="Search">
                </div>
                <button type="button" class="btn btn-primary" onclick=" searchItem()">
                    <i class="glyphicon glyphicon-search"></i> ค้นหา
                </button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <button type="button" class="btn btn-default btn-lg"  data-toggle="modal" data-target=".editprofile">
                        <label class="label label-succes alert alert-success">
                            ชื่อ <?= $_SESSION['person']['per_fname'] . " " . $_SESSION['person']['per_lname'] ?>
                            <i class="glyphicon glyphicon-edit lg"></i> แก้ไขข้อมูล
                        </label>
                    </button>
                </li>
                <li>                            
                    <a href="#" onclick="return logout()">
                        <label class="label label-warning alert alert-warning">
                            <i class="glyphicon glyphicon-log-out"></i> LOGOUT
                        </label>
                    </a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<!--modal-->
<div class="modal fade editprofile" 
     tabindex="-1" role="dialog" 
     aria-labelledby="myLargeModalLabel" 
     aria-hidden="true"
     data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header alert alert-info">
                <a class="close" data-dismiss="modal">&times;</a>
                <i class="glyphicon glyphicon-shopping-cart"></i> แก้ไขข้อมูลสส่วนตัว
            </div>
            <div class="modal-body">
                edit profile
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary btn-sm" id="btn_save" >
                    <i class="glyphicon glyphicon-ok-sign"></i> แก้ไข
                </a>
                <a class="btn btn-danger btn-sm" data-dismiss="modal">
                    <i class="glyphicon glyphicon-remove-sign"></i> ปิด
                </a>
            </div>
        </div>
    </div>
</div>
<!--modal-->


