<?php include '../../config/app_connect.php'; ?>
<div class="panel panel-success">
    <div class="panel-heading">        
        <i class="glyphicon glyphicon-shopping-cart"></i> รายการของที่จะยืม
    </div>
    <div class="panel-body">
        <table class="table table-bordered tablePagination" id="table_borrow">
            <thead>
                <tr>
                    <th style="width: 14%;text-align: center;">รหัส</th>
                    <th>ชื่อ</th>                    
                    <th style="width: 15%;text-align: center;">จำนวนที่ยืม</th>
                    <th style="width: 15%;text-align: center;">จำนวนที่คืน</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `borrow_detail` bd";
                $sql .= " LEFT JOIN item i ON i.ite_id = bd.ite_id";
                $sql .= " JOIN borrow br ON br.bor_id = bd.bor_id";
                $sql .= " WHERE 1= 1";
                //$sql .= " bd.bordet_createdate = date(NOW())";
                //$sql .= " AND br.bor_status = 0";
                $sql .= " AND bd.bor_id = " . $_GET['id'];
                $sql .= " ORDER BY bd.bordet_id ASC";
                // แสดง sql
                echo printSql($sql);

                $query = mysql_query($sql) or die(mysql_error());
                $record = mysql_num_rows($query);
                $i = 1;
                ?>
                <?php while ($row = mysql_fetch_array($query)) : ?>
                    <tr>
                        <td style="text-align: center;"><?= $i ?></td>
                        <td><?= $row['ite_name'] ?></td>
                        <td>
                            <input type="hidden" name="ite_id" value="<?= $row['ite_id'] ?>"/>
                            <input type="text" class="form-control" name="borrow" id="<?= $row['bordet_id'] ?>" value="<?= $row['bordet_no'] ?>" readonly="true"/>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="return" value="<?= $row['bordet_return_no'] ?>" onchange="return checkNumber(this)"/>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>
            <div class="row-offcanvas col-sm-12 radio-inline">               
                รวม<input type="text" class="form-control " id="total" value="<?= $record ?> " readonly="true"/>
            </div>
            </th>
            <th colspan="1"></th>
            <th >
            <div class="row-offcanvas col-sm-12 radio-inline">          
                <?php
                $sql_total = "SELECT SUM(bordet_no) as count_no,SUM(bordet_return_no) as count_return FROM borrow_detail WHERE bor_id = " . $_GET['id'];

                $query_total = mysql_query($sql_total) or die(mysql_error());
                $result = mysql_fetch_assoc($query_total);
                $count_total = $result['count_no'];
                $count_return = $result['count_return'];
                ?>
                รวม<input type="text" class="form-control " id="total" value="<?= $count_total ?> " readonly="true"/>
            </div>            
            </th>
            <th>
            <div class="row-offcanvas col-sm-12 radio-inline">               
                รวม<input type="text" class="form-control " id="total" value="<?= $count_return ?> " readonly="true"/>
            </div>
            </th>
            </tr>
            </tfoot>
        </table>
        <?php echo printSql($sql_total); ?>
    </div>
    <div class="panel-footer" style="text-align: center;">
        <button type="button" class="btn btn-primary" id="" onclick="saveBorrowCheck()">
            <i class="glyphicon glyphicon-ok-sign"></i> ตรวจสอบสำเร็จ
        </button>
        <a href="index.php?page=manage_borrow" class="btn btn-warning">
            <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
        </a>
    </div>
</div>
<script type="text/javascript">

                            function saveBorrowCheck() {
                                var row = $("#table_borrow").children('tbody').children('tr').length; // นับ row
                                if (row > 0) {
                                    if (confirm('ยืนยันการ ตรวจ จำนวนของ คืนเรียบร้อบแล้ว')) {
                                        var row_tr = $("#table_borrow").children('tbody').children('tr'); // loop table
                                        row_tr.each(function(index, tr) { // start loop
                                            var td = $(tr).children('td');
                                            var input_ite_id = td.find('input[name=ite_id]').val();
                                            var input_1 = td.find('input[name=borrow]').val();
                                            var id = td.find('input[name=borrow]').attr('id');
                                            var input_2 = td.find('input[name=return]').val();
                                            //alert(' index :' + index + ' input_1 : ' + input_1 + ' id : ' + id + '  input_2 : ' + input_2);
                                            if (input_1 != input_2) { // check number
                                                updateBorrow(id, input_2, input_ite_id);
                                            }
                                        });
                                        window.location = 'index.php?page=manage_borrow';
                                        return true;
                                    }
                                    return false;
                                }
                            }
                            function checkNumber(element) {
                                var value = element.value;
                                if (!parseInt(value)) {
                                    alert(' กรุณา กรอก ตัวเลขเท่านั้น');
                                    element.value = '';
                                    element.focus();
                                }
                            }
                            function updateBorrow(id, value, ite_id) {
                                $.ajax({
                                    url: 'db_borrow.php?method=checkupdateitem',
                                    data: {
                                        id: id,
                                        value: value,
                                        ite_id: ite_id
                                    },
                                    type: 'post',
                                    success: function(data) {
                                        if (data != 1) {
                                            alert(' เกิดข้อ ผิดพลาด : ' + data);
                                            stop();
                                        }
                                    }
                                });
                            }
</script>