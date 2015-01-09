<form action="index.php?page=db_person&method=changepassword" method="post" name="changpassword-form" class="form-horizontal">
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
                            <div class="col-sm-12">
                                <label class="col-sm-3">รหัสผ่าน เก่า</label>
                                <div class="col-sm-4">
                                    <div class="input-group">                            
                                        <div class="input-group-addon ">
                                            <i class="glyphicon glyphicon-star add-on"></i>
                                        </div>
                                        <input type="password" class="form-control" name="passwordold"  required placeholder="********"
                                               onchange="checkOldPassword(this.value)"/>
                                    </div>
                                </div> 
                                <label class="label label-danger">กรอก password เก่า</label>
                            </div>  
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="col-sm-3">รหัสผ่าน ใหม่</label>
                                <div class="col-sm-4">
                                    <div class="input-group">                            
                                        <div class="input-group-addon ">
                                            <i class="glyphicon glyphicon-star add-on"></i>
                                        </div>
                                        <input type="password" class="form-control" name="passwordnew" id="passwordnew"  required placeholder="********" disabled="true"/>
                                    </div>
                                </div> 
                                <label class="label label-danger">กรอก password ใหม่</label>
                            </div>  
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="col-sm-3">รหัสผ่านใหม่ อีกครั้ง</label>
                                <div class="col-sm-4">
                                    <div class="input-group">                            
                                        <div class="input-group-addon ">
                                            <i class="glyphicon glyphicon-star add-on"></i>
                                        </div>
                                        <input type="password" class="form-control" name="repasswordnew" id="repasswordnew" required placeholder="********" disabled="true"/>
                                    </div>
                                </div> 
                                <label class="label label-danger">กรอก password ใหม่ เก่า อีกครั้ง</label>
                            </div>   
                        </div>
                    </div>
                </div>
                <div class="panel-footer" style="text-align: center;">
                    <button type="submit" class="btn btn-primary" onclick="return checkChangePassword()">
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
<script type="text/javascript">
                                                   function checkChangePassword() {
                                                       var msg = '';
                                                       var newpassword = $('#passwordnew').val();
                                                       var renewpassword = $('#repasswordnew').val();
                                                       if (newpassword.length >= 8) {
                                                           if (newpassword != renewpassword) {
                                                               msg = 'กรุณา กรอก password ใหม่ ให้ตรงกัน';
                                                           } else {
                                                               if (confirm('ยืนยัน แก้ไขข้อมูล')) {
                                                                   return true;
                                                               } else {
                                                                   return false;
                                                               }
                                                           }
                                                       } else {
                                                           msg = 'กรุณากรอก password 8 ตัวอักษร ขึ้นไป';
                                                       }
                                                       alert(msg);
                                                       return false;
                                                   }
                                                   function checkOldPassword(value) {
                                                       $.ajax({
                                                           url: 'db_person.php?method=checkoldpassword',
                                                           data: {passwordold: value},
                                                           //dataType: 'html',
                                                           type: 'post',
                                                           success: function(data) {
                                                               console.log(data);
                                                               if (data == 1) {
                                                                   alert(' รหัสผ่านเก่า ถูกต้อง');
                                                                   $('#passwordnew').attr('disabled', false);
                                                                   $('#repasswordnew').attr('disabled', false);
                                                               } else {
                                                                   alert(' รหัสผ่านเก่า ไม่ถูกต้อง กรุณากรอกไหม่');
                                                                   $('#passwordnew').attr('disabled', true);
                                                                   $('#repasswordnew').attr('disabled', true);
                                                               }
                                                           }
                                                       });
                                                   }
</script>