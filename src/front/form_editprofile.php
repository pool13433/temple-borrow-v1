<script type="text/javascript" src="../../js/service_script.js"></script>
<?php
include '../../config/app_connect.php';
if (!empty($_SESSION['person'])):
    $sql = "SELECT * FROM person WHERE per_id = " . $_SESSION['person']['per_id'];
    $query = mysql_query($sql) or die(mysql_error());
    $data = mysql_fetch_assoc($query);
endif;
?>
<form action="index.php?page=db_person&method=update_profile" method="post" name="profile-form" class="form-horizontal">
    <div class="panel panel-info">
        <div class="panel-heading">        
            แก้ไขข้อมูลส่วนตัว
        </div>
        <div class="panel-body">            
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                <i class="glyphicon glyphicon-play"></i>  ข้อมูลเข้าใช้งาน
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <!--username password-->
                            <div class="alert alert-success">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">USERNAME</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">                            
                                                <div class="input-group-addon ">
                                                    <i class="glyphicon glyphicon-user add-on"></i>
                                                </div>
                                                <input type="text" class="form-control" name="username" value="<?= $data['per_username'] ?>" required/>
                                            </div>                                               
                                        </div> 
                                    </div>   
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">PASSWORD</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">                            
                                                <div class="input-group-addon ">
                                                    <i class="glyphicon glyphicon-star add-on"></i>
                                                </div>
                                                <input type="password" class="form-control" name="password" value="<?= $data['per_password'] ?>"  required/>
                                            </div>
                                        </div> 
                                    </div>   
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">RE PASSWORD </label>
                                        <div class="col-sm-6">
                                            <div class="input-group">                            
                                                <div class="input-group-addon ">
                                                    <i class="glyphicon glyphicon-star add-on"></i>
                                                </div>
                                                <input type="password" class="form-control" name="repassword" value="<?= $data['per_password'] ?>" required/>
                                            </div>
                                        </div> 
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                            <input type="text" class="form-control" name="fname" value="<?= $data['per_fname'] ?>" required/>
                                        </div> 
                                    </div>   
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">นามสกุล </label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="lname" value="<?= $data['per_lname'] ?>" required/>
                                        </div> 
                                    </div>   
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">วันเกิด</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">                                               
                                                <div data-date-format="yyyy/mm/dd" data-date="12-02-2012" class="input-group date">                        
                                                    <input type="text" size="16" name="birthday" class="form-control" value="<?= $data['per_birthday'] ?>" readonly required>
                                                    <div class="input-group-addon ">
                                                        <i class="glyphicon glyphicon-calendar add-on"></i>
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div> 
                                    </div>   
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">อายุ</label>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="age" maxlength="2" value="<?= $data['per_age'] ?>" required/>
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
                                                <input type="text" class="form-control" name="idcard" value="<?= $data['per_idcard'] ?>"  required maxlength="13"/>
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
                                            <textarea class="form-control" name="address" rows="2"><?= $data['per_address'] ?></textarea> 
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">                                    
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">ตำบล</label>
                                        <div class="col-sm-6">
                                            <?php $sql_distrint = "SELECT * FROM districts WHERE district_id = 1745"; ?>
                                            <?php $query_distrint = mysql_query($sql_distrint) or die(mysql_error()) ?>
                                            <select class="form-control" name="district" id="district" readonly="true">
                                                <?php while ($row2 = mysql_fetch_array($query_distrint)): ?>
                                                    <option value="<?= $row2['district_id'] ?>" selected="true"><?= $row2['district_name'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>                                         
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">อำเภอ</label>
                                        <div class="col-sm-6">
                                            <?php $sql_amphur = "SELECT * FROM amphures WHERE amphur_id = 211"; ?>
                                            <?php $query_anphue = mysql_query($sql_amphur) or die(mysql_error()) ?>
                                            <select class="form-control" name="amphure" id="amphure" readonly="true">
                                                <?php while ($row1 = mysql_fetch_array($query_anphue)) : ?>
                                                    <option value="<?= $row1['amphur_id'] ?>" selected="true"><?= $row1['amphur_name'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">                                    
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">จังหวัด</label>
                                        <div class="col-sm-6">                                            
                                            <select class="form-control" name="province" id="province" readonly="true"  required>
                                                <option value=""> -- เลือก --</option>
                                                <?php
                                                $sql_province = "SELECT * FROM provinces WHERE province_id = 18 ORDER BY province_name asc";
                                                $query_province = mysql_query($sql_province) or die(mysql_error());
                                                while ($row = mysql_fetch_array($query_province)):
                                                    ?>
                                                    <option value="<?= $row['province_id'] ?>" selected="true"><?= $row['province_name'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">รหัสไปรษณีย์</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="zipcode" id="zipcode"  readonly="true" value="27120"/>
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">                                    
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">โทรศัพท์</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="tel" maxlength="10" value="<?= $data['per_tel'] ?>" required/>
                                        </div> 
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">email</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" value="<?= $data['per_email'] ?>" name="email"/>
                                        </div> 
                                    </div>
                                </div>                                
                            </div> 
                        </div>
                    </div>
                </div>                
            </div>
        </div>
        <div class="panel-footer" style="text-align: center;">
            <button type="submit" class="btn btn-primary" onclick="return confirm('ยืนยัน การแก้ไขข้อมูลส่วนตัว')">
                <i class="glyphicon glyphicon-ok-sign"></i> บันทึก
            </button>
            <a href="index.php?page=login" class="btn btn-warning">
                <i class="glyphicon glyphicon-remove-sign"></i> ยกเลิก
            </a>
        </div>
    </div>
</form>
<script type="text/javascript">
    function checkFormRegister() {
        var msg = '';
        var username = $('input[name=username]').val();
        var password = $('input[name=password]').val();
        var fname = $('input[name=fname]').val();
        var lname = $('input[name=lname]').val();
        var age = $('input[name=age]').val();
        var birthday = $('input[name=birthday]').val();
        var idcard = $('input[name=idcard]').val();
        var address = $('input[name=address]').val();
        var district = $('input[name=district]').val();
        var province = $('input[name=province]').val();
        var amphure = $('input[name=amphure]').val();
        var zipcode = $('input[name=zipcode]').val();

        if (username == '') {
            msg += ' กรุณากรอกข้อมูล username \n';
        }
        if (password == '') {
            msg += ' กรุณากรอกข้อมูล password \n';
        }
        if (fname == '') {
            msg += ' กรุณากรอกข้อมูล fname \n';
        }
        if (lname == '') {
            msg += ' กรุณากรอกข้อมูล lname \n';
        }
        if (msg == '') {
            return true
        } else {
            alert(msg);
            return false;
        }
    }
</script>