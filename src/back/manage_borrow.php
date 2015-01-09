<?php include '../../config/app_connect.php'; ?>
<?php $type = ""; ?>
<div class="panel panel-success">
    <div class="panel-heading">        
        <i class="glyphicon glyphicon-tower"></i> ประวัติการยืม
    </div>
    <div class="panel-body">
        <table class="table table-bordered tablePagination">
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th></th>
                    <th>ชื่อผู้ยืม</th>
                    <th>รหัสบัตร</th>
                    <th>วันที่ยืม</th>
                    <th>วันมารับของ</th>
                    <th>วันใช้งาน</th>
                    <th>วันคืนของ</th>
                    <th>จำนวนของ / รายการ</th>
                    <th>สถานะการยืม</th>
                    <th>สถานะการอนุมัติ</th>
                    <th style="width: 20%;">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT ";
                $sql .= " br.*";
                /* $sql .=" br.bor_id,br.bor_get ";
                  $sql .= " ,DATE_FORMAT(br.bor_get,'%m-%d-%Y')";
                  $sql .= " DATE_FORMAT(STR_TO_DATE(br.bor_get, '%D %M %Y'), '%Y-%m-%d')";
                  $sql .= " ,br.bor_start,br.bor_end,br.bor_status,br.bor_approve"; */
                $sql .=" ,ps.*";
                $sql .= " ,(SELECT count(*) FROM borrow_detail bd ,item i WHERE bd.ite_id = i.ite_id";
                $sql .= " AND i.ite_priority = 1"; // 1 = ปกติ
                $sql .= " AND bd.bor_id = br.bor_id ) as count_normal_item";
                $sql .= " ,(SELECT count(*) FROM borrow_detail bd ,item i WHERE bd.ite_id = i.ite_id";
                $sql .= " AND i.ite_priority = 2"; // 2 = พิเศษ
                $sql .= " AND bd.bor_id = br.bor_id) as count_special_item";
                $sql .= " FROM `borrow` br";
                $sql .= " JOIN person ps ON ps.per_id = br.per_id";
                //$sql .= " WHERE br.bor_status <> 6"; // ไม่เอาที่ยกเลิก ไปแล้ว 6 = ยกเลิกไปแล้ว
                $sql .= "";
                $sql .= " ORDER BY bor_createdate,bor_id DESC";

                // แสดง sql
                echo printSql($sql);

                $query = mysql_query($sql) or die(mysql_error());
                $record = mysql_num_rows($query);
                ?>
                <?php while ($row = mysql_fetch_array($query)) : ?>
                    <tr>
                        <td><?=$row['bor_id']?></td>
                        <td>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target=".zoom<?= $row['bor_id'] ?>">
                                <i class="glyphicon glyphicon-zoom-in"></i><?= $row['bor_id'] ?>
                            </button>

                            <!--modal-->
                            <div class="modal fade zoom<?= $row['bor_id'] ?>" 
                                 tabindex="-1" role="dialog" 
                                 aria-labelledby="myLargeModalLabel" 
                                 aria-hidden="true"
                                 data-backdrop="static">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header alert alert-info">
                                            <a class="close" data-dismiss="modal">&times;</a>
                                            <i class="glyphicon glyphicon-wrench"></i> รายการ สิ่งของที่ ยืม
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            $sql_zoom = "SELECT * FROM borrow_detail bd";
                                            $sql_zoom .=" JOIN item i ON i.ite_id = bd.ite_id";
                                            $sql_zoom .=" ";
                                            $sql_zoom .= " WHERE bd.bor_id = " . $row['bor_id'];
                                            $query_zoom = mysql_query($sql_zoom) or die(mysql_error());
                                            ?>
                                            <table class="table table-bordered tablePagination">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px;">รหัส สิ่งของ</th>
                                                        <th style="width: ">ชื่อ</th>
                                                        <th style="width: 10px;">ความสำคัญ</th>
                                                        <th style="width: 15px;">จำนวน ที่ยืม</th>
                                                    </tr>                                                        
                                                </thead>
                                                <tbody>
                                                    <?php while ($row_zoom = mysql_fetch_array($query_zoom)) : ?>
                                                        <tr>
                                                            <td><?= $row_zoom['bordet_id'] ?></td>
                                                            <td><?= $row_zoom['ite_name'] ?></td>
                                                            <td>
                                                                <?php if ($row_zoom['ite_priority'] == 1): ?>
                                                                    <h5><label class="label label-success"> ทรพย์สิน ธรรมดา</label></h5>
                                                                <?php else: ?>
                                                                    <h5><label class="label label-primary"> ทรพย์สิน พิเศษ</label></h5>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td><?= $row_zoom['bordet_no'] ?></td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>                                            
                                        </div>
                                        <div class="modal-footer">
                                            <a class="btn btn-danger btn-sm" data-dismiss="modal">
                                                <i class="glyphicon glyphicon-remove-sign"></i> ปิด
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--modal-->

                        </td>
                        <td><?= $row['per_fname']."  ".$row['per_lname'] ?></td>
                        <td><?= $row['per_idcard']?></td>
                        <td><?= convertDate($row['bor_createdate'], '/') ?></td>
                        <td><?= convertDate($row['bor_get'], '/') ?></td>
                        <td><?= convertDate($row['bor_start'], '/') ?></td>
                        <td><?= convertDate($row['bor_end'], '/') ?></td>                        
                        <td>
                            <h4>
                                <label class="label label-success">
                                    รายการธรรมดา <?= $row['count_normal_item'] ?> รายการ
                                </label>
                            </h4>
                            <h4>
                                <label class="label label-warning">
                                    รายการพิเศษ <?= $row['count_special_item'] ?> รายการ
                                </label>
                            </h4>
                        </td>
                        <td>
                            <?php if ($row['bor_status'] == 1): ?>
                                <label class="label label-warning">รอยืม</label>
                            <?php elseif ($row['bor_status'] == 2): ?>
                                <label class="label label-success">ยืม</label>
                                <?php $type = 'approve'; ?>
                            <?php elseif ($row['bor_status'] == 3): ?>
                                <label class="label label-info">คืน</label>
                                <?php $type = 'return'; ?>
                            <?php elseif ($row['bor_status'] == 4): ?>
                                <label class="label label-warning">มารับ ของ ล้าช้า</label>
                            <?php elseif ($row['bor_status'] == 5): ?>
                                <label class="label label-danger">ไม่มารับ ของ</label>
                            <?php elseif ($row['bor_status'] == 6): ?>
                                <label class="label label-default">ยกเลิก การจอง เรียบร้อย</label>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($row['bor_approve'] == 0): ?>
                                <label class="label label-warning">รอ อนุมัติ</label>
                            <?php elseif ($row['bor_approve'] == 1): ?>
                                <label class="label label-success">อนุมัติ เรียบร้อยแล้ว</label>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center;">
                            <?php if ($row['bor_status'] != 6): ?>
                                <ul class="list-group">
                                    <?php if ($_SESSION['person']['per_status'] == 1): ?>
                                        <?php if ($row['bor_status'] == 1 || $row['bor_status'] == 3): ?>
                                            <li class="list-group-item">
                                                <a href="index.php?page=manage_borrow_detail&id=<?= $row['bor_id'] ?>&type=<?= $type ?>" class="btn btn-success btn-sm">
                                                    <i class="glyphicon glyphicon-list-alt"></i>  จัดการ คืนของ
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <li class="list-group-item">
                                        <button type="button" class="btn btn-primary btn-sm borrow"   data-toggle="modal" data-target=".borrow<?= $row['bor_id'] ?>">
                                            <i class="glyphicon glyphicon-bell"></i> ปรับสถานะ    
                                        </button>
                                    </li>
                                </ul>
                            <?php endif; ?>

                            <!-- modal-->
                            <div class="modal fade borrow<?= $row['bor_id'] ?>" 
                                 tabindex="-1" role="dialog" 
                                 aria-labelledby="myLargeModalLabel" 
                                 aria-hidden="true"
                                 data-backdrop="static">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header alert alert-info">
                                            <a class="close" data-dismiss="modal">&times;</a>
                                            <i class="glyphicon glyphicon-wrench"></i> จัดการ ปรับเปลี่ยน การยืม
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" name="borrow-form" id="borrow-form<?= $row['bor_id'] ?>">
                                                <input type="hidden" name="id" value="<?= $row['bor_id'] ?>"/>
                                                <?php if ($_SESSION['person']['per_status'] == 1): // 1 = officer ?>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label class="col-sm-4">ปรับเปลี่ยนสถานะ การยืม</label>
                                                            <div class="col-sm-4">
                                                                <?php $arrayBorrowStatus = arrayBorrowStatus(); ?>
                                                                <select class="form-control" name="bor_status" id="bor_status">
                                                                    <?php foreach ($arrayBorrowStatus as $key => $value): ?>
                                                                        <?php if ($row['bor_status'] == $key): ?>
                                                                            <option value="<?= $key ?>" selected="true"><?= $value ?></option>
                                                                        <?php else: ?>
                                                                            <option value="<?= $key ?>"><?= $value ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <label class="label label-warning"> ปรับเปลี่ยน ตาม จริง</label>
                                                        </div>                                                
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($_SESSION['person']['per_status'] == 2 || $_SESSION['person']['per_status'] == 1):  // 2 = head officer   ?> 
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label class="col-sm-4">อนุมัติ การยืม</label>
                                                            <div class="col-sm-4">
                                                                <?php $arrayBorrowApprove = arrayBorrowApprove(); ?>
                                                                <select class="form-control" name="bor_approve" id="bor_approve">
                                                                    <?php foreach ($arrayBorrowApprove as $key => $value): ?>
                                                                        <?php if ($row['bor_approve'] == $key): ?>
                                                                            <option value="<?= $key ?>" selected="true"><?= $value ?></option>
                                                                        <?php else: ?>
                                                                            <option value="<?= $key ?>"><?= $value ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <label class="label label-warning"> ปรับเปลี่ยน ตาม จริง</label>
                                                        </div>                                                
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($_SESSION['person']['per_status'] == 1): // 1 = officer ?>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label class="col-sm-4">สถานะการคืน ของ</label>
                                                            <div class="col-sm-4">
                                                                <?php $arrayBorrowResult = arrayBorrowResult(); ?>
                                                                <select class="form-control" name="bor_result" id="bor_result">
                                                                    <?php foreach ($arrayBorrowResult as $key => $value): ?>
                                                                        <?php if ($row['bor_result'] == $key): ?>
                                                                            <option value="<?= $key ?>" selected="true"><?= $value ?></option>
                                                                        <?php else: ?>
                                                                            <option value="<?= $key ?>"><?= $value ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <label class="label label-warning"> ปรับเปลี่ยน ตาม จริง</label>
                                                        </div>                                                
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label class="col-sm-4">เหตุผล การ คืนไม่ครบ</label>
                                                            <div class="col-sm-8">
                                                                <textarea class="form-control" name="bor_remark" rows="4"><?= $row['bor_remark'] ?></textarea>
                                                            </div>
                                                        </div>                                                
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label class="label label-warning">
                                                                เหตุผลเงื่อนไขการชดใช้ กรณี คืนของ ไม่ครบ
                                                            </label>
                                                        </div>                                                
                                                    </div>
                                                <?php endif; ?>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <a class="btn btn-primary btn-sm" id="btn_save" onclick="return saveBorrow(<?= $row['bor_id'] ?>)">
                                                <i class="glyphicon glyphicon-ok-sign"></i> บันทึก
                                            </a>
                                            <a class="btn btn-danger btn-sm" data-dismiss="modal">
                                                <i class="glyphicon glyphicon-remove-sign"></i> ปิด
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal-->

                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="11"></th>
                    <th style="text-align: center;">
            <h3><label class="label label-info">รวม {  <?= $record ?>  }</label></h3>
            </th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>

<script type="text/javascript">
    function saveBorrow(id) {
        if (confirm(' ยืนยัน การปรับเปลี่ยน สถานะ รหัส [ ' + id + ' ] ใช่ หรือ ไม่')) {
            $.ajax({
                url: 'db_borrow.php?method=borrow_manage',
                data: $('#borrow-form' + id).serialize(),
                type: 'post',
                success: function(data) {
                    if (data == 1) {
                        window.location.reload();
                    } else {
                        alert(' แก้ไข ไม่สำเร็จ : \n' + data);
                    }
                }
            });
        }
        return false;
    }
</script>
