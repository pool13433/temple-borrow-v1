<?php include '../../config/app_connect.php'; ?>
<div class="panel panel-success">
    <div class="panel-heading">
        รายงานสรุปข้อมูลการตรวจสอบสถานะของสิ่งของ
    </div>
    <div class="panel-body">
        <form class="form-horizontal" id="asset-form" method="get" action="pdf_result_damage.php" target="_blank">
            <div class="form-group">
                <label class="col-md-1">วันที่ค้นหา</label>
                <div class="col-md-3"> 
                    <?php $sql = "SELECT * FROM `group`"; ?>
                    <?php $query = mysql_query($sql) or die(mysql_error()) ?>
                    <select class="form-control" name="group">
                        <option value="">ทั้งหมด</option>
                        <?php while ($row = mysql_fetch_array($query)) : ?>
                            <option value="<?= $row['gro_id'] ?>"><?= $row['gro_name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>    
            <!--<div class="form-group">
                <div class="col-md-3">
                    <label class="control-label">สถานะของ</label>
                    <div class="controls">
                        <label class="radio inline">
                            <input type="radio" name="status" value="1"/>
                            ของยังอยู่
                        </label>
                        <label class="radio inline">
                            <input type="radio" name="status" value="2"/>
                            ของหาย
                        </label>
                    </div>
                </div>                                 
            </div>-->
            <div class="form-group">
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_search">
                        <i class="glyphicon glyphicon-search"></i> ค้นหารายงาน
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
