<?php
include '../../config/app_connect.php';
// สร้าง ตัวแปร
$id = "";
$name = "";
$group = "";
$type = "";
$no_total = "";
$no_balance = "";
$size = "";
$attribute = "";
$priority = "";
$status = "";
$remark = "";

// รับค่า id ไม่ว่าง  (empty = ว่าง ! empty = ไม่ว่าง)
if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM `item` i";
    $sql .= " JOIN `group` g ON g.gro_id = i.gro_id";
    $sql .= " JOIN `type` t ON t.typ_id = i.typ_id";
    $sql .= " JOIN `size` s ON s.siz_id = i.siz_id";
    $sql .= " ";
    $sql .= " WHERE ite_id = " . $_GET['id'];

    $query = mysql_query($sql) or die(mysql_error());

    $row = mysql_fetch_assoc($query);
    $id = $row['ite_id'];
    $name = $row['ite_name'];
    $group = $row['gro_id'];
    $type = $row['typ_id'];
    $no_total = $row['ite_total_no'];
    $no_balance = $row['ite_balance_no'];
    $size = $row['siz_id'];
    $attribute = $row['ite_attribute'];
    $priority = $row['ite_priority'];
    $status = $row['ite_status'];
    $remark = $row['ite_remark'];
}
?>

<form action="index.php?page=db_item&method=create" method="post" id="frm-item" class="form-horizontal">
    <div class="panel panel-success">
        <div class="panel-heading">        
            <?php echo breadCrumbs('manage_item', 'จัดการ สิ่งของวัด', 'form_item', 'เพิ่ม สิ่งของวัด') ?>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="col-sm-6">
                    <label class="col-sm-4">ชื่อ</label>
                    <div class="col-sm-8" style="color: white">
                        <input type="hidden" class="form-control" name="id" value="<?= $id ?>"/>
                        <input type="text" class="form-control" name="name" value="<?= $name ?>" 
                               data-validation-engine="validate[required]"
                               data-errormessage-value-missing="กรุณากรอก ชื่อสิ่งของวัด"/>
                    </div> 
                </div>      
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label class="col-sm-4">กลุ่ม</label>
                    <div class="col-sm-4" style="color: white">
                        <select name="group" class="form-control" 
                                data-validation-engine="validate[required]"
                                data-errormessage-value-missing="กรุณาเลือก กลุ่มสิ่งของ">
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
                <div class="col-sm-6">
                    <label class="col-sm-4">ประเภท</label>
                    <div class="col-sm-3" style="color: white">
                        <select name="type" class="form-control" 
                                data-validation-engine="validate[required]"
                                data-errormessage-value-missing="กรุณาเลือก ประเภท">
                            <option value="" > -- เลือก --</option>
                            <?php
                            $sql_type = "SELECT * FROM `type` ORDER BY typ_name";
                            $query_type = mysql_query($sql_type) or die(mysql_error());
                            while ($row1 = mysql_fetch_array($query_type)) :
                                if ($type == $row1['typ_id']):
                                    ?>
                                    <option value="<?= $row1['typ_id'] ?>" selected><?= $row1['typ_name'] ?></option>
                                <?php else: ?>
                                    <option value="<?= $row1['typ_id'] ?>"><?= $row1['typ_name'] ?></option>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </select>
                    </div> 
                </div> 
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label class="col-sm-4">จำนวน ทั้งหมด</label>
                    <div class="col-sm-4" style="color: white">
                        <input type="number" class="form-control" name="item_total_no" value="<?= $no_total ?>" 
                               data-validation-engine="validate[required]"
                               data-errormessage-value-missing="กรุณากรอก จำนวนทั้งหมด"/>
                    </div> 
                    <div class="col-sm-3" style="color: white">
                        <select name="attribute" class="form-control" 
                                data-validation-engine="validate[required]"
                                data-errormessage-value-missing="กรุณาเลือก ลักษณะ">
                                    <?php
                                    $arrAttribute = arrayAttribute();
                                    foreach ($arrAttribute as $key => $value):
                                        if ($key == $attribute):
                                            ?>
                                    <option value="<?= $key ?>" selected><?= $value ?></option>           
                                    <?php
                                else:
                                    ?>
                                    <option value="<?= $key ?>" ><?= $value ?></option>         
                                    ?>
                                <?php
                                endif;
                            endforeach;
                            ?>      
                        </select>
                    </div> 
                </div> 
                <div class="col-sm-6">
                    <label class="col-sm-4">ขนาด</label>
                    <div class="col-sm-3" style="color: white">
                        <select name="size" class="form-control" 
                                data-validation-engine="validate[required]"
                                data-errormessage-value-missing="กรุณาเลือก ขนาด">
                            <option value="" > -- เลือก --</option>
                            <?php
                            $sql_size = "SELECT * FROM `size` ORDER BY siz_name";
                            $query_size = mysql_query($sql_size) or die(mysql_error());
                            while ($row1 = mysql_fetch_array($query_size)) :
                                if ($size == $row1['siz_id']):
                                    ?>
                                    <option value="<?= $row1['siz_id'] ?>" selected><?= $row1['siz_name'] ?></option>
                                <?php else: ?>
                                    <option value="<?= $row1['siz_id'] ?>"><?= $row1['siz_name'] ?></option>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </select>
                    </div> 
                </div> 
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label class="col-sm-4">จำนวคงเหลือ</label>
                    <div class="col-sm-4" style="color: white">
                        <input type="number" name="item_balance_no" class="form-control" value="<?= $no_balance ?>"
                               data-validation-engine="validate[required]"
                               data-errormessage-value-missing="กรุณากรอก จำนวนคงเหลือ"/>
                    </div> 
                </div> 
                <div class="col-sm-6">
                    <label class="col-sm-4">ความสำคัญ</label>
                    <div class="col-sm-3" style="color: white">
                        <select name="priority" class="form-control" 
                                data-validation-engine="validate[required]"
                                data-errormessage-value-missing="กรุณาเลือกความสำคัญ">
                                    <?php
                                    $arrPriority = arrayPriority();
                                    foreach ($arrPriority as $key => $value):
                                        if ($key == $priority):
                                            ?>
                                    <option value="<?= $key ?>" selected><?= $value ?></option>           
                                    <?php
                                else:
                                    ?>
                                    <option value="<?= $key ?>" ><?= $value ?></option>         
                                    ?>
                                <?php
                                endif;
                            endforeach;
                            ?>       
                        </select>
                    </div> 
                </div> 
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <label class="col-sm-4">สถานะ</label>
                    <div class="col-sm-4" style="color: white">
                        <select name="status" class="form-control" 
                                data-validation-engine="validate[required]"
                                data-errormessage-value-missing="กรุณาเลือก สถานะ">
                                    <?php
                                    $arrStatus = arrayStatus();
                                    foreach ($arrStatus as $key => $value):
                                        if ($key == $status):
                                            ?>
                                    <option value="<?= $key ?>" selected><?= $value ?></option>           
                                    <?php
                                else:
                                    ?>
                                    <option value="<?= $key ?>" ><?= $value ?></option>         
                                    ?>
                                <?php
                                endif;
                            endforeach;
                            ?>       
                        </select>
                    </div> 
                </div>                 
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label class="col-sm-2">หมายเหตุ</label>
                    <div class="col-sm-6" style="color: white">
                        <textarea class="form-control" name="remark" rows="3"><?= $remark ?></textarea>
                    </div> 
                </div>                 
            </div>
        </div>
        <div class="panel-footer" style="text-align: center;">
            <button type="submit" class="btn btn-primary">
                <i class="glyphicon glyphicon-ok-sign"></i> บันทึก
            </button>
            <a href="index.php?page=manage_item" class="btn btn-warning">
                <i class="glyphicon glyphicon-remove-sign"></i> ยกเลิก
            </a>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        var valid = $('#frm-item').validationEngine('attach', {
            promptPosition: "centerRight",
            scroll: false,
            onValidationComplete: function(form, status) {
                return status;
            }
        });
        valid.css({
            'box-shadow': '2px 2px 2px 2px #888888',
            'padding': '20px',
        });
    });
</script>
