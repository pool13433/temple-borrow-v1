<?php include '../../config/app_connect.php'; ?>
<?php
@ob_start();
@session_start();
$bor_id = "";
$bor_start = "";
$bor_createdate = "";
$bor_end = "";
$bor_get = "";
$bor_detail = "";
$bor_reason = "";
if (!empty($_GET['id'])) {
    $bor_id = $_GET['id'];
    $sql = "SELECT bor_id";
    $sql .=" ,DATE_FORMAT(bor_get,'%Y/%m/%d') as bor_get";
    $sql.=" ,DATE_FORMAT(bor_start,'%Y/%m/%d') as bor_start";
    $sql.=" ,DATE_FORMAT(bor_end,'%Y/%m/%d') as bor_end";
    $sql.=" ,DATE_FORMAT(bor_createdate,'%Y/%m/%d') as bor_createdate";
    $sql.=" ,bor_detail";
    $sql.=" ,bor_reason";
    $sql .=" FROM borrow WHERE bor_id = $bor_id";

    echo printSql($sql);

    $query = mysql_query($sql) or die(mysql_error());
    $result = mysql_fetch_assoc($query);

    $bor_id = $result['bor_id'];
    $bor_start = $result['bor_start'];
    $bor_createdate = $result['bor_createdate'];
    $bor_end = $result['bor_end'];
    $bor_get = $result['bor_get'];
    $bor_detail = $result['bor_detail'];
    $bor_reason = $result['bor_reason'];
} else {
    $bor_id = $_SESSION['borrow_id'];
    $bor_createdate = date('Y-m-d');
}
?>
<form action="db_borrow.php?method=create" name="borrow-form" method="post" class="form-horizontal">
    <div class="panel panel-success">
        <div class="panel-heading">        
            <i class="glyphicon glyphicon-shopping-cart"></i> กรอกข้อมูลการ ยืม
        </div>
        <div class="panel-body" style="text-align: left;">
            <div class="row-offcanvas-left">
                <?php if (!empty($_GET['id'])): ?>
                    <a href="index.php?page=main_cart&id=<?= $bor_id ?>" class="btn btn-primary">
                        <i class="glyphicon glyphicon-arrow-left"></i> กลับ
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="col-md-5">
                    <label class="col-sm-6">เลขที่เอกสาร</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="bor_id" value="<?= $bor_id ?>" readonly="true"> 
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5">
                    <label class="col-sm-6">วันที่ สร้างเอกสารการยืม</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="bor_get" value="<?= $bor_createdate ?>" readonly="true">
                    </div>
                </div>
                <div class="col-md-7">
                    <label class="col-sm-3">วันที่ มารับของ</label>
                    <div class="col-sm-4">
                        <div data-date-format="yyyy/mm/dd" data-date="12-02-2012" class="input-group date">                        
                            <input type="text" size="16" class="form-control" name="bor_get" required="true" value="<?= $bor_get ?>">
                            <div class="input-group-addon ">
                                <i class="glyphicon glyphicon-calendar add-on"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5">
                    <label class="col-sm-6">วันที่ เริ่มใช้งาน</label>
                    <div class="col-sm-6">
                        <div data-date-format="yyyy/mm/dd" data-date="12-02-2012" class="input-group date">                        
                            <input type="text" size="16" class="form-control" name="bor_start" required="true" value="<?= $bor_start ?>">
                            <div class="input-group-addon ">
                                <i class="glyphicon glyphicon-calendar add-on"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <label class="col-sm-3">วันที่ นำของมาคืน</label>
                    <div class="col-sm-4">
                        <div data-date-format="yyyy/mm/dd" data-date="12-02-2012" class="input-group date">                        
                            <input type="text" size="16" class="form-control" name="bor_end" required="true" value="<?= $bor_end ?>">
                            <div class="input-group-addon ">
                                <i class="glyphicon glyphicon-calendar add-on"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5">
                    <label class="col-sm-6">เหตุผลการยืม</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="bor_reason" id="reason" onchange="changReason(this)">
                            <?php $arrResaon = arrayReason(); ?>
                            <?php foreach ($arrResaon as $key => $value): ?>
                                <?php if ($key == $bor_reason): ?>
                                    <option value="<?= $key ?>" selected="true"><?= $value ?></option>
                                <?php else: ?>
                                    <option value="<?= $key ?>"><?= $value ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-7">
                    <label class="col-sm-3">อื่น ๆ โปรดระบุ</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="bor_detail"  rows="3" required="true" disabled="true"><?= $bor_detail ?></textarea>
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
<script type="text/javascript">
    $(function() {
        var reason_value = $('select[name=bor_reason]').val();
        changReason(reason_value);
        $('select[name=bor_reason]').on('change', function() {
            var value = this.value;
            changReason(value);
        });
    });
    function changReason(value) {
        //alert(id);
        if (value == 0) {
            $('textarea[name=bor_detail]').attr('disabled', false);
        } else {
            $('textarea[name=bor_detail]').attr('disabled', true);
        }
    }
</script>