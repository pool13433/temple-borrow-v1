<script type="text/javascript" src="../../js/service_script.js"></script>
<?php
@ob_start();
@session_start();

// include connection
include '../../config/app_connect.php';

// สร้างตัวแปร
$id = "";
$fname = "";
$lname = "";
$age = "";
$birthday = "";
$idcard = "";
$address = "";
$district = "";
$amphure = "";
$province = "";
$zipcode = "";
$tel = "";
$email = "";
$method = "'";
$status = "'";
// check method
if (!empty($_GET['method'])) {
    $method = 'changeprofile';
} else {
    $method = 'create';
}

// ตรวจสอบ session ก่อนว่า ว่างหรือเปล่า empty ว่าง  !empty = ไม่ว่าง
if (!empty($_GET['id'])) {
// สร้าง ตัวแปรเก็บ user id
    $id = $_GET['id'];
// สร้าง sql select ข้อมูลผู้เข้าใช้งาน
    $sql_per = "SELECT * FROM person WHERE per_id =" . $id;
    $query = mysql_query($sql_per) or die(mysql_error());
    $person = mysql_fetch_assoc($query);

// set ค่า
    $id = $person['per_id'];
    $fname = $person['per_fname'];
    $lname = $person['per_lname'];
    $age = $person['per_age'];
    $birthday = $person['per_birthday'];
    $idcard = $person['per_idcard'];
    $address = $person['per_address'];
    $district = $person['district_id'];
    $amphure = $person['amphure_id'];
    $province = $person['province_id'];
    $zipcode = $person['per_zipcode'];
    $tel = $person['per_tel'];
    $email = $person['per_email'];
    $status = $person['per_status'];
}
?>
<!--  form-->
<form action="index.php?page=db_person&method=<?= $method ?>" method="post" id="frm-person" name="register-form" class="form-horizontal">
    <div class="panel-group" id="accordion">                
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        <i class="glyphicon glyphicon-play"></i> ข้อมูลส่วนตัว
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse in">
                <div class="panel-body">
                    <!-- ข้อมูลส่วนตัว-->
                    <div class="alert alert-success">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="col-sm-4">ชื่อ </label>
                                <div class="col-sm-6">
                                    <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>"/>
                                    <input type="text" class="form-control" name="fname" value="<?= $fname ?>" 
                                           data-validation-engine="validate[required]"
                                           data-errormessage-value-missing="กรุณากรอก ชื่อ"/>
                                </div> 
                            </div>   
                            <div class="col-sm-6">
                                <label class="col-sm-4">นามสกุล </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="lname" value="<?= $lname ?>" 
                                           data-validation-engine="validate[required]"
                                           data-errormessage-value-missing="กรุณากรอก นามสกุล"/>
                                </div> 
                            </div>   
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="col-sm-4">วันเกิด</label>
                                <div class="col-sm-6">
                                    <div class="input-group">                                               
                                        <div data-date-format="yyyy/mm/dd" data-date="12-02-2012" class="input-group date">                        
                                            <input type="text" size="16" name="birthday" class="form-control" readonly value="<?= $birthday ?>"
                                                   data-validation-engine="validate[required]"
                                                   data-errormessage-value-missing="กรุณากรอก วันเกิด"/>
                                            <div class="input-group-addon ">
                                                <i class="glyphicon glyphicon-calendar add-on"></i>
                                            </div>
                                        </div>
                                    </div>                                            
                                </div> 
                            </div>   
                            <div class="col-sm-6">
                                <label class="col-sm-4">อายุ</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="age" maxlength="2"  value="<?= $age ?>"
                                               data-validation-engine="validate[required,custom[integer],maxSize[3]]"
                                               data-errormessage-value-missing="กรุณากรอก อายุ"
                                               data-errormessage-range-overflow="ท่านกรอก อายุ เกินหลัก"                                               
                                               data-errormessage-custom-error = "กรุณากรอก อายุ เป็นตัวเลขเท่านั้น"/>
                                        <div class="input-group-addon ">
                                            <i class="add-on"></i> ปี
                                        </div>
                                    </div>          
                                </div> 
                            </div>   
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="col-sm-4">รหัสบัตรประชาชน</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="idcard"  value="<?= $idcard ?>"
                                               data-validation-engine="validate[required,minSize[13],maxSize[13],custom[integer]]"
                                               data-errormessage-value-missing="กรุณากรอก รหัสบัตรประชาชน 13 หลัก"
                                               data-errormessage-range-overflow="กรุณากรอก รหัสบัตรประชาชน 13 หลัก เท่านั้น"
                                               data-errormessage-range-underflow ="กรุณากรอก รหัสบัตรประชาชน 13 หลัก เท่านั้น"
                                               data-errormessage-custom-error = "กรุณากรอก รหัสบัตรประชาชน 13 หลัก เป็นตัวเลขเท่านั้น"/>
                                        <div class="input-group-addon ">
                                            <i class="add-on"></i> 13 หลัก
                                        </div>
                                    </div>          
                                </div> 
                            </div>   
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="col-sm-2">ที่อยู่</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="address" rows="2"
                                              data-validation-engine="validate[required]"
                                              data-errormessage-value-missing="กรุณากรอก ที่อยู่"/><?= $address ?></textarea> 
                                </div> 
                            </div>
                        </div>
                        <div class="form-group">                                    
                            <div class="col-sm-6">
                                <label class="col-sm-4">จังหวัด</label>
                                <div class="col-sm-6">                                            
                                    <select class="form-control" name="province" id="province"  
                                            data-validation-engine="validate[required]"
                                            data-errormessage-value-missing="กรุณากรอก จังหวัด">
                                        <option value=""> -- เลือก --</option>
                                        <?php
                                        $sql_province = "SELECT * FROM provinces ORDER BY province_name asc";
                                        $query = mysql_query($sql_province) or die(mysql_error());
                                        while ($row = mysql_fetch_array($query)):
                                            if ($row['province_id'] == $province):
                                                ?>
                                                <option value="<?= $row['province_id'] ?>" selected="true"><?= $row['province_name'] ?></option>
                                            <?php else: ?>
                                                <option value="<?= $row['province_id'] ?>"><?= $row['province_name'] ?></option>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    </select>
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <label class="col-sm-4">อำเภอ</label>
                                <div class="col-sm-6">
                                    <input type="hidden" name="amp" id="amp" value="<?= $amphure ?>"/>
                                    <select class="form-control" name="amphure" id="amphure" 
                                            data-validation-engine="validate[required]"
                                            data-errormessage-value-missing="กรุณากรอก อำเภอ"/>
                                    </select>
                                </div> 
                            </div>
                        </div>
                        <div class="form-group">                                    
                            <div class="col-sm-6">
                                <label class="col-sm-4">ตำบล</label>
                                <div class="col-sm-6">
                                    <input type="hidden" name="dis" id="dis" value="<?= $district ?>"/>
                                    <select class="form-control" name="district" id="district" 
                                            data-validation-engine="validate[required]"
                                            data-errormessage-value-missing="กรุณากรอก ตำบล"/>

                                    </select>
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <label class="col-sm-4">รหัสไปรษณีย์</label>                                
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="zipcode" value="<?= $zipcode ?>" id="zipcode"/>
                                </div> 
                            </div>
                        </div>
                        <div class="form-group">                                    
                            <div class="col-sm-6">
                                <label class="col-sm-4">โทรศัพท์</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="tel" maxlength="10" value="<?= $tel ?>" 
                                           data-validation-engine="validate[required]"
                                           data-errormessage-value-missing="กรุณากรอก โทรศัพท์"/>
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <label class="col-sm-4">email</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="email" value="<?= $email ?>"/>
                                </div> 
                            </div>
                        </div>
                        <div class="form-group">                                                                   
                            <?php if (empty($_GET['method'])) : ?>
                                <div class="col-sm-6">
                                    <label class="col-sm-4">status</label>
                                    <div class="col-sm-8">
                                        <select name="status" class="form-control" required>
                                            <?php
                                            $arrAttribute = arrayUserStatus();
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
                            <?php endif; ?>
                        </div>
                    </div> 
                </div>
                <div class="panel-footer" style="text-align: center;">
                    <button type="submit" class="btn btn-primary">
                        <i class="glyphicon glyphicon-ok-sign"></i> แก้ไขข้อมูล
                    </button>
                    <a href="index.php?page=login" class="btn btn-warning">
                        <i class="glyphicon glyphicon-remove-sign"></i> ยกเลิก
                    </a>
                </div>
            </div>
        </div>                
    </div>
</form>
<!--  form-->

<script type="text/javascript">
    $(document).ready(function() {
        // ################### validate engine ########
        var valid = $('#frm-person').validationEngine('attach', {
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
        // ################### validate engine ########
        // on load
        var province = $('#province').val();
        var amp = $('#amp').val();
        if (province != '') {
            renderProvinceAmphure(province, null, amp);
        }
        var amphure = $('#amphure').val();
        var dis = $('#dis').val();
        if (amphure != '') {
            //alert('dis : ' + dis);
            //alert('amphure : '+amphure);
            renderAmphurDistrict(amphure, null, dis);
        }
        var district = $('#district').val();
        if (district != '') {
            renderDistrictZipcode(district);
        }
        $('#province').change(function() {
            var province_id = $('#province').val();
            renderProvinceAmphure(province_id);
        });
        $('#amphure').change(function() {
            var amphur_id = $('#amphure').val();
            renderAmphurDistrict(amphur_id);
        });
        $('#district').change(function() {
            var district_code = $('#district').val();
            renderDistrictZipcode(district_code);
        });
    });
</script>