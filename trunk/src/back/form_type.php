<?php
include '../../config/app_connect.php';
// สร้าง ตัวแปร
$id = "";
$name = "";
// รับค่า id ไม่ว่าง  (empty = ว่าง ! empty = ไม่ว่าง)
if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM `type` WHERE typ_id = " . $_GET['id'];
    $query = mysql_query($sql) or die(mysql_error());
    $row = mysql_fetch_assoc($query);
    $id = $row['typ_id'];
    $name = $row['typ_name'];
}
?>

<form action="index.php?page=db_type&method=create" method="post" class="form-horizontal">
    <div class="panel panel-success">
        <div class="panel-heading">        
            <?php echo breadCrumbs('manage_type', 'จัดการ ประเภทสิ่งของวัด', 'form_type', 'เพิ่ม ประเภทสิ่งของวัด') ?>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="col-sm-6">
                    <label class="col-sm-4">ชื่อ</label>
                    <div class="col-sm-6" style="color: white">
                        <input type="hidden" class="form-control" name="id" value="<?= $id ?>"/>
                        <input type="text" class="form-control" name="name" value="<?= $name ?>" required/>
                    </div> 
                </div>   
            </div>
        </div>
        <div class="panel-footer" style="text-align: center;">
            <button type="submit" class="btn btn-primary" onclick="return confirm('บันทึก')">
                <i class="glyphicon glyphicon-ok-sign"></i> บันทึก
            </button>
            <a href="index.php?page=manage_type" class="btn btn-warning">
                <i class="glyphicon glyphicon-remove-sign"></i> ยกเลิก
            </a>
        </div>
    </div>
</form>

