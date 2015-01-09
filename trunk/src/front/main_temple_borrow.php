<?php include '../../config/app_connect.php'; ?>
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
                    <th>วันมารับของ</th>
                    <th>วันใช้งาน</th>
                    <th>วันคืนของ</th>
                    <th>จำนวนของ / รายการ</th>
                    <th>สถานะการยืม</th>
                    <th>สถานะการอนุมัติ</th>
                    <th style="width: 12%;text-align: center;">ACTION</th>
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
                $sql .= " ORDER BY br.bor_id desc"; // date(br.bor_createdate),
                // แสดง sql
                echo printSql($sql);

                $query = mysql_query($sql) or die(mysql_error());
                $record = mysql_num_rows($query);
                ?>
                <?php while ($row = mysql_fetch_array($query)) : ?>
                    <tr>         
                        <td><?= $row['bor_id'] ?></td>
                        <td>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target=".zoom<?= $row['bor_id'] ?>">
                                        <i class="glyphicon glyphicon-zoom-in"></i>
                                    </button>
                                </li>
                                <li class="list-group-item">
                                    <a href="index.php?page=main_cart&id=<?= $row['bor_id'] ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> แก้ไขของยืม</a>
                                </li>
                            </ul>
                            <?php include './view_item.php'; ?>
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
                                <ul class="list-group">
                                    <?php if ($row['bor_status'] == 1): ?>
                                        <li class="list-group-item">
                                            <a href="index.php?page=main_borrow&id=<?= $row['bor_id'] ?>" class="btn btn-info btn-sm">
                                                <i class="glyphicon glyphicon-pencil"></i> แก้ไขใบยืม    
                                            </a>  
                                        </li>
                                    <?php endif; ?>
                                    <li class="list-group-item">
                                        <button type="button" class="btn btn-danger btn-sm" onclick="return updateBorrowStatus(<?= $row['bor_id'] ?>, 6)">
                                            <i class="glyphicon glyphicon-trash"></i> ยกเลิก    
                                        </button>  
                                    </li>
                                    <li class="list-group-item">
                                        <a href="pdf_borrow.php?id=<?= $row['bor_id'] ?>" target="_blank" class="btn btn-success btn-sm">
                                            <i class="glyphicon glyphicon-print"></i> ปริ้น    
                                        </a>  
                                    </li>
                                </ul>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="8"></th>
                    <th style="text-align: center;">
            <h3><label class="label label-info">รวม {  <?= $record ?>  }</label></h3>
            </th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
