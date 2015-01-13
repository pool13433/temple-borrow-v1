<?php include '../../config/app_connect.php'; ?>
<div class="panel panel-success">
    <div class="panel-heading">
        รายงานสรุปสิ่งของวัดคงเหลือ
    </div>
    <div class="panel-body">
        <form class="form-horizontal" id="frm-sumorder_byperson" method="get" action="pdf_sumorder_byperson.php" target="_blank">
            <div class="form-group">
                <label class="col-md-1">ชื่อคนยืม</label>
                <div class="col-md-4"> 
                    <?php
                    $sql_person = "SELECT * FROM `borrow` br";
                    $sql_person .= " LEFT JOIN person ps ON ps.per_id = br.per_id";
                    $sql_person .= " GROUP BY ps.per_fname";
                    $sql_person .= " ORDER BY ps.per_fname DESC";
                    $query_person = mysql_query($sql_person) or die(mysql_error());
                    ?>
                    <select  name="person" class="mutiselect validate[required]" id="combo-person" multiple>                        
                        <?php while ($row = mysql_fetch_array($query_person)) : ?>
                            <option value="<?= $row['per_id'] ?>"><?= $row['per_fname'] ?></option>
                        <?php endwhile; ?>
                    </select>
                    <input type="hidden" name="hidden-person" id="hidden-person"/>
                </div>
                <label class="col-md-1" style="text-align: right">วันที่ยืม</label>
                <div class="col-md-2"> 
                    <div data-date-format="dd/mm/yyyy" data-date="12-02-2012" class="input-group date">                        
                        <input type="text" size="16" class="form-control datepicker" name="bor_getstart"
                               readonly/>
                        <div class="input-group-addon ">
                            <i class="glyphicon glyphicon-calendar add-on"></i>
                        </div>
                    </div>
                </div>
                <label class="col-md-1" style="text-align: right">ถึง</label>
                <div class="col-md-2"> 
                    <div data-date-format="dd/mm/yyyy" data-date="12-02-2012" class="input-group date">                        
                        <input type="text" size="16" class="form-control datepicker" name="bor_getend"
                               readonly/>
                        <div class="input-group-addon ">
                            <i class="glyphicon glyphicon-calendar add-on"></i>
                        </div>
                    </div>
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
<script type="text/javascript">
    $(document).ready(function() {
        
        $('#combo-person').select2({
            width: '70%',
        }).on("change", function(e) {
            //alert('value ' + select2.select2('val'));
            $('#hidden-person').val(e.val);
        });
    });
</script>