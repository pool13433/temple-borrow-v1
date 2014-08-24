<?php
include '../../config/app_connect.php';
// สร้าง ตัวแปร
$id = "";
$name = "";
$group = "";
// รับค่า id ไม่ว่าง  (empty = ว่าง ! empty = ไม่ว่าง)
if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM `size` s";
    $sql .= " JOIN `group` g ON s.gro_id = g.gro_id";
    $sql .= " WHERE s.siz_id = " . $_GET['id'];
    echo printSql($sql);
    $query = mysql_query($sql) or die(mysql_error());
    $row = mysql_fetch_assoc($query);
    $id = $row['siz_id'];
    $name = $row['siz_name'];
    $group = $row['gro_id'];
}
?>

<form action="db_size.php?method=create" method="post" class="form-horizontal">
    <div class="panel panel-success">
        <div class="panel-heading">        
            <?php echo breadCrumbs('manage_size', 'จัดการ size', 'form_size', 'เพิ่ม size') ?>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="col-sm-6">
                    <label class="col-sm-4">ชื่อ</label>
                    <div class="col-sm-8" style="color: white">
                        <input type="hidden" class="form-control" name="id" value="<?= $id ?>"/>
                        <input type="text" class="form-control" name="name" value="<?= $name ?>" required/>
                    </div> 
                </div>   
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label class="col-sm-4">กลุ่ม</label>
                    <div class="col-sm-6" style="color: white">
                        <select name="group" class="form-control" required>
                            <option value="" > -- เลือก --</option>
                            <?php
                            $sql_group = "SELECT * FROM `group` ORDER BY gro_name";
                            $query = mysql_query($sql_group) or die(mysql_error());
                            while ($row1 = mysql_fetch_array($query)) :
                                if ($group == $row1['gro_id']):
                                    ?>
                                    <option value="<?= $row1['gro_id'] ?>" selected><?= $row1['gro_name'] ?></option>
                                <?php else: ?>
                                    <option value="<?= $row1['gro_id'] ?>"><?= $row1['gro_name'] ?></option>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </select>
                    </div> 
                </div>   
            </div>
        </div>
        <div class="panel-footer" style="text-align: center;">
            <button type="submit" class="btn btn-primary" onclick="return confirm('บันทึก')">
                <i class="glyphicon glyphicon-ok-sign"></i> บันทึก
            </button>
            <a href="index.php?page=manage_size" class="btn btn-warning">
                <i class="glyphicon glyphicon-remove-sign"></i> ยกเลิก
            </a>
        </div>
    </div>
</form>

