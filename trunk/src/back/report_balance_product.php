<?php include '../../config/app_connect.php'; ?>
<div class="panel panel-success">
    <div class="panel-heading">
        รายงานสรุปสิ่งของวัดคงเหลือ
    </div>
    <div class="panel-body">
        <form class="form-horizontal" id="asset-form" method="get" action="pdf_result_damage.php" target="_blank">
            <div class="form-group">
                <label class="col-md-1">วันที่ค้นหา</label>
                <div class="col-md-2"> 
                    <?php $sql = "SELECT * FROM `group`"; ?>
                    <?php $query = mysql_query($sql) or die(mysql_error()) ?>
                    <select class="form-control" name="group">
                        <option value="">ทั้งหมด</option>
                        <?php while ($row = mysql_fetch_array($query)) : ?>
                            <option value="<?= $row['gro_id'] ?>"><?= $row['gro_name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <label class="col-md-2" style="text-align: right">จำนวนคงเหลือ</label>
                <div class="col-md-2"> 
                    <?php $arrayoperation = arrayOperation() ?>
                    <select class="form-control" name="opertion">
                        <?php foreach ($arrayoperation as $key => $data): ?>
                            <option value="<?= $key ?>"><?= $data ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2"> 
                    <input type="text" class="form-control" name="number"/>
                </div>
            </div>                
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