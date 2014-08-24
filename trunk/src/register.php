<script type="text/javascript" src="../js/service_script.js"></script>
<?php
include '../config/app_connect.php';
?>
<form action="db_person.php?method=register" method="post" name="register-form" class="form-horizontal">
    <div class="panel panel-info">
        <div class="panel-heading">        
            สมัครสมาชิก
        </div>
        <div class="panel-body">
            <div class="alert alert-warning fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <strong>การสมัครสมาชิก !</strong> การสมัครสมาชิก เพื่อการเข้าใช้งานระบบ การยืมสิ่งของวัน เหล่าอ้อย
            </div>
            <div class="alert alert-danger fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <strong>หมายเหตุ !</strong> ต้องมีที่อยู่ ภายใน อำเภอ ...?... ตำบล ...?... เท่านั้น
            </div>

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
                                                <input type="text" class="form-control" name="username" required/>
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
                                                <input type="password" class="form-control" name="password"  required/>
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
                                                <input type="password" class="form-control" name="repassword" required/>
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
                                            <input type="text" class="form-control" name="fname" required/>
                                        </div> 
                                    </div>   
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">นามสกุล </label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="lname" required/>
                                        </div> 
                                    </div>   
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">วันเกิด</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">                                               
                                                <div data-date-format="yyyy/mm/dd" data-date="12-02-2012" class="input-group date">                        
                                                    <input type="text" size="16" name="birthday" class="form-control" readonly required>
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
                                                <input type="text" class="form-control" name="age" maxlength="2" required/>
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
                                                <input type="text" class="form-control" name="idcard"  required maxlength="13"/>
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
                                            <textarea class="form-control" name="address" rows="2"></textarea> 
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">                                    
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">จังหวัด</label>
                                        <div class="col-sm-6">                                            
                                            <select class="form-control" name="province" id="province"  required>
                                                <option value=""> -- เลือก --</option>
                                                <?php
                                                $sql_province = "SELECT * FROM provinces ORDER BY province_name asc";
                                                $query = mysql_query($sql_province) or die(mysql_error());
                                                while ($row = mysql_fetch_array($query)):
                                                    ?>
                                                    <option value="<?= $row['province_id'] ?>"><?= $row['province_name'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">อำเภอ</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="amphure" id="amphure" required>

                                            </select>
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">                                    
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">ตำบล</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="district" id="district" required>

                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">รหัสไปรษณีย์</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="zipcode" id="zipcode"/>
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">                                    
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">โทรศัพท์</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="tel" maxlength="10" required/>
                                        </div> 
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">email</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="email"/>
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">                                    
                                    <div class="col-sm-6">
                                        <label class="col-sm-4">สำเนาบัตร</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" name="file" />
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
            <button type="submit" class="btn btn-primary" onclick="return confirm('ยืนยัน การลงทะเบียน')">
                <i class="glyphicon glyphicon-ok-sign"></i> สมัครสมาชิก
            </button>
            <a href="index.php?page=login" class="btn btn-warning">
                <i class="glyphicon glyphicon-remove-sign"></i> ยกเลิก
            </a>
        </div>
    </div>
</form>
<script type="text/javascript">
                $(document).ready(function() {
                    $('#province').change(function() {
                        var province_id = $('#province').val();
                        renderProvinceAmphure(province_id, 'back');
                    });
                    $('#amphure').change(function() {
                        var amphur_id = $('#amphure').val();
                        renderAmphurDistrict(amphur_id, 'back');
                    });
                    $('#district').change(function() {
                        var district_code = $('#district').val();
                        renderDistrictZipcode(district_code, 'back');
                    });
                });
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