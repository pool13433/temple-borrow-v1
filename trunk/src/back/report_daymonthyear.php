<div class="panel panel-success">
    <div class="panel-heading">
        รายงานสรุปข้อมูลการยืมคืนประจำวัน /เดือน/ ปี
    </div>
    <div class="panel-body">
        <form class="form-horizontal" id="daymonthyear-form" method="get" action="./pdf_ddmmyyyy.php" target="_blank">
            <div class="form-group">
                <div class="col-md-3"> 
                    <div data-date-format="dd/mm/yyyy" data-date="12-02-2012" class="input-group date">     
                        <div class="input-group-addon ">
                            จาก
                        </div>  
                        <input type="text" size="16" class="form-control" name="startdate" >
                        <div class="input-group-addon ">
                            <i class="glyphicon glyphicon-calendar add-on"></i>
                        </div>                       
                    </div>
                </div>
                <div class="col-md-3">                        
                    <div data-date-format="dd/mm/yyyy" data-date="12-02-2012" class="input-group date">                        
                        <div class="input-group-addon ">
                            ถึง
                        </div>  
                        <input type="text" size="16" class="form-control" name="enddate">
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
    $(function (){
        var nowDate = new Date();
       $('form').find(':input').val(nowDate.getDate()+'/'+(nowDate.getMonth()+1)+'/'+nowDate.getYear()) 
    });
</script>
