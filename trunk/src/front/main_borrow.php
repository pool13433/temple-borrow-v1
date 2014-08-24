<?php include '../../config/app_connect.php'; ?>
<form action="db_borrow.php?method=create" name="borrow-form" method="post" class="form-horizontal">
    <div class="panel panel-success">
        <div class="panel-heading">        
            <i class="glyphicon glyphicon-shopping-cart"></i> กรอกข้อมูลการ ยืม
        </div>
        <div class="panel-body" style="text-align: left;">
            <div class="row-offcanvas-left">
                <a href="index.php?page=main_cart" class="btn btn-primary">
                    <i class="glyphicon glyphicon-arrow-left"></i> กลับ
                </a>
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="col-md-5">
                    <label class="col-sm-5">วันที่ จะมารับของ</label>
                    <div class="col-sm-6">
                        <div data-date-format="yyyy/mm/dd" data-date="12-02-2012" class="input-group date">                        
                            <input type="text" size="16" class="form-control" name="bor_get" required="true">
                            <div class="input-group-addon ">
                                <i class="glyphicon glyphicon-calendar add-on"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5">
                    <label class="col-sm-5">วันที่ เริ่มใช้งาน</label>
                    <div class="col-sm-6">
                        <div data-date-format="yyyy/mm/dd" data-date="12-02-2012" class="input-group date">                        
                            <input type="text" size="16" class="form-control" name="bor_start" required="true">
                            <div class="input-group-addon ">
                                <i class="glyphicon glyphicon-calendar add-on"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <label class="col-sm-4">วันที่ สิ้นสุดใช้งาน (คืนของ)</label>
                    <div class="col-sm-4">
                        <div data-date-format="yyyy/mm/dd" data-date="12-02-2012" class="input-group date">                        
                            <input type="text" size="16" class="form-control" name="bor_end" required="true">
                            <div class="input-group-addon ">
                                <i class="glyphicon glyphicon-calendar add-on"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="col-sm-2">เหตุผลการยืม</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="bor_detail" rows="3" required="true" placeholder="เหตุผล สั้นๆ..."></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer" style="text-align: center;">
            <button type="submit" class="btn btn-primary" onclick=" return confirm(' ยืนยันการยืม ของวัด')">
                <i class="glyphicon glyphicon-ok-circle"></i> OK
            </button>
            <button type="button" class="btn btn-warning">
                <i class="glyphicon glyphicon-remove-circle"></i> CANCLE
            </button>
        </div>
    </div>
</form>