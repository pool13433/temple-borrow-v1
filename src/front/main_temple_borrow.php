<?php include '../../config/app_connect.php'; ?>
<div class="panel panel-success">
    <div class="panel-heading">        
        <i class="glyphicon glyphicon-tower"></i> ประวัติการยืม
    </div>
    <div class="panel-body">
        <table class="table table-bordered tablePagination">
            <thead>
                <tr>
                    <th style="width: 10%">รหัส</th>
                    <th>วันมารับของ</th>
                    <th>วันใช้งาน</th>
                    <th>วันคืนของ</th>
                    <th>จำนวนของ / รายการ</th>
                    <th>สถานะการยืม</th>
                    <th>สถานะการอนุมัติ</th>
                    <th style="width: 15%;text-align: center;">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT br.*, ";
                $sql .= " (SELECT count(*) FROM borrow_detail bd WHERE bd.bor_id = br.bor_id) as count_item";
                $sql .= " FROM `borrow` br WHERE 1=1";
                //$sql .= " WHERE br.bor_status <> 6"; // ไม่เอาที่ยกเลิก ไปแล้ว 6 = ยกเลิกไปแล้ว
                $sql .= "";
                $sql .= " AND br.per_id = " . $_SESSION['person']['per_id'];
                $sql .= " ORDER BY bor_id";

                // แสดง sql
                echo printSql($sql);

                $query = mysql_query($sql) or die(mysql_error());
                $record = mysql_num_rows($query);
                ?>
                <?php while ($row = mysql_fetch_array($query)) : ?>
                    <tr>
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
                        <td><?= $row['bor_get'] ?></td>
                        <td><?= $row['bor_start'] ?></td>
                        <td><?= $row['bor_end'] ?></td>                        
                        <td>
                            <h4>
                                <label class="label label-success">
                                    <?= $row['count_item'] ?> รายการ
                                </label>
                            </h4>
                        </td>
                        <td>
                            <?php if ($row['bor_status'] == 1): ?>
                                <label class="label label-warning">รอ รับของ</label>
                            <?php elseif ($row['bor_status'] == 2): ?>
                                <label class="label label-succes">ยืม</label>
                            <?php elseif ($row['bor_status'] == 3): ?>
                                <label class="label label-info">คืน เรียบร้อยแล้ว</label>
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
                            <?php elseif ($row['bor_status'] == 1): ?>
                                <label class="label label-succes">อนุมัติ เรียบร้อยแล้ว</label>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center;">
                            <?php if ($row['bor_status'] != 6): ?>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning btn-sm" onclick="return updateBorrowStatus(<?= $row['bor_id'] ?>, 6)">
                                        <i class="glyphicon glyphicon-trash"></i> CANCLE    
                                    </button>  
                                </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="7"></th>
                    <th style="text-align: center;">
            <h3><label class="label label-info">รวม {  <?= $record ?>  }</label></h3>
            </th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
