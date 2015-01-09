<?php
@ob_start();
@session_start();
?>
<?php include '../../config/app_connect.php'; ?>
<div class="panel panel-success">
    <div class="panel-heading">        
        <i class="glyphicon glyphicon-shopping-cart"></i> รายการของที่จะยืม
    </div>
    <div class="panel-body" style="text-align: center;">
        <div class="row-offcanvas-left">
            <div class="col-md-1">
                <a href="index.php?page=main_item" class="btn btn-warning">
                    <i class="glyphicon glyphicon-arrow-left"></i> เลือก สิ่งของ เพิ่มเติม
                </a>
            </div>
            <div class="col-md-8"></div>
            <div class="col-md-3">
                <button type="button" class="btn btn-danger" onclick="return cancleItemAll()">
                    <i class="glyphicon glyphicon-trash"></i> ยกเลิกทั้งหมด
                </button>
                <a href="index.php?page=main_borrow&id=<?= $_GET['id'] ?>" class="btn btn-primary" id="go">
                    <i class="glyphicon glyphicon-arrow-right"></i> ต่อไป
                </a>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-bordered tablePagination">
            <thead>
                <tr>
                    <th style="width: 10%">รหัส</th>
                    <th>ชื่อ</th>
                    <th style="width: 10%;text-align: center;">จำนวนที่ยืม</th>
                    <th style="width: 10%;text-align: center;">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `borrow_detail` bd";
                $sql .= " LEFT JOIN item i ON i.ite_id = bd.ite_id";
                $sql .= " JOIN borrow br ON br.bor_id = bd.bor_id";
                $sql .= " WHERE 1=1 ";

                $sql .= " AND br.per_id = " . $_SESSION['person']['per_id'];
                if (!empty($_GET['id'])): // กรณีแก้ไข หลังจาก คอนเฟิร์มไปแล้ว
                    $bor_id = $_GET['id'];
                    $sql .= " AND bd.bor_id = " . $bor_id;
                    $sql .= " AND br.bor_status > 0";
                    $_SESSION['borrow_confirm_id'] = $bor_id;
                else: // กำลัง เพิ่มสินค้าเข้าตะกร้า
                    $sql .= " AND br.bor_status = 0";
                    $sql .= " AND date(bd.bordet_createdate) = date(NOW())";
                endif;
                $sql .= " ORDER BY bd.bordet_id DESC";
                // แสดง sql
                echo printSql($sql);

                $query = mysql_query($sql) or die(mysql_error());
                $record = mysql_num_rows($query);
                $no = 1;
                ?>
                <?php while ($row = mysql_fetch_array($query)) : ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $row['ite_name'] ?></td>
                        <td><?= $row['bordet_no'] ?></td>
                        <td style="text-align: center;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger btn-sm" onclick="return deleteItem(<?= $row['bordet_id'] ?>, 'db_borrow_detail')">
                                    <i class="glyphicon glyphicon-trash"></i> DELETE    
                                </button>   
                            </div>
                        </td>
                    </tr>
                    <?php $no++;
                endwhile;
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3"></th>
                    <th> <div class="row-offcanvas col-sm-12 radio-inline">               
                รวม<input type="text" class="form-control " id="total" value="<?= $record ?> " readonly="true"/>
            </div>
            </th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var count = $('#total').val();
        if (parseInt(count) > 0) {
            $('#go').attr('href', 'index.php?page=main_borrow&id=' + bor_id);
        } else {
            $('#go').attr('href', '#');
        }
    });

    function cancleItemAll() {
        var bor_id = $('#bor_id').val();
        if (confirm('ยกเลิกการ เลือกทรัพยากรที่เลือกไปทั้งหมด ใช่ หรือ ไม่')) {
            $.ajax({
                url: 'db_borrow_detail.php?method=deleteAll',
                success: function(data) {
                    if (data == true) {
                        window.location = 'index.php?page=main_item&id=' + bor_id;
                    }
                }
            });
            return true;
        }
        return false;
    }

</script>