<div class="box_content">
    <div class="panel panel-info">
        <div class="panel-heading">
            หน้าจอเข้าสู่ระบบ
        </div>
        <div class="panel-body" style="margin: auto;text-align: center;">
            <form class="form-horizontal" name="login-form" id="login-form" method="post">
                <div class="form-group">
                    <label class="col-sm-2">USERNAME</label>
                    <div class="col-sm-6">
                        <div class="input-group">                            
                            <div class="input-group-addon ">
                                <i class="glyphicon glyphicon-user add-on"></i>
                            </div>
                            <input type="text" name="username" id="username" class="form-control"/>
                        </div>   
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2">PASSWORD</label>
                    <div class="col-sm-6">
                        <div class="input-group">                            
                            <div class="input-group-addon ">
                                <i class="glyphicon glyphicon-star add-on"></i>
                            </div>
                            <input type="password" name="password" id="password" class="form-control"/>
                        </div>                           
                    </div>
                </div>
                <div class="form-group" style="text-align: center;">
                    <a href="index.php?page=register"><i class="glyphicon glyphicon-registration-mark"></i>สมัครสมาชิก</a>||
                    <a href="index.php?page=forget_password"><I class="glyphicon glyphicon-question-sign"></i>ลืมพาสเวิร์ด</a>
                </div>
            </form>
        </div>
        <div class="panel-footer alert-" style="text-align: center;">
            <button type="button" class="btn btn-primary" id="btn_login">
                <i class="glyphicon glyphicon-ok-circle"></i> Login
            </button>
            <button type="button" class="btn btn-warning" id="btn_clear">
                <i class="glyphicon glyphicon-remove-circle"></i> Clear
            </button>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#btn_login').click(function() {
            var username = $('#username').val();
            var password = $('#password').val();
            if (username == '' || password == '') {
                alert(' กรุณา กรอก USERNAME ? และ PASSWORD ?');
                return false;
            } else {
                $.ajax({
                    url: 'db_person.php?method=login',
                    data: $('#login-form').serialize(),
                    dataType: 'html',
                    type: 'post',
                    success: function(data) {
                        //alert("date " + data);
                        if (data != '') {
                            alert('เข้าระบบสำเร็จ');
                            window.location = data;
                        } else {
                            alert('ไม่มีชื่อในระบบ');
                        }
                    },
                });
            }
        });
    })
</script>