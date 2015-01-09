<?php include '../../config/app_connect.php'; ?>
<div class="panel panel-success">
    <div class="panel-heading">        
        <?php echo breadCrumbs('manage_group', 'จัดการ กลุ่มสิ่งของวัด', 'form_group', 'เพิ่ม กลุ่มสิ่งของวัด') ?>
    </div>
    <div class="panel-body">
        <table class="table table-bordered tablePagination">
            <thead>
                <tr>
                    <th style="width: 10%">รหัส</th>
                    <th>ชื่อ</th>
                    <th style="width: 15%;text-align: center;">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `group` ORDER BY gro_id";

                // แสดง sql
                echo printSql($sql);

                $query = mysql_query($sql) or die(mysql_error());
                $record = mysql_num_rows($query);
                ?>
                <?php while ($row = mysql_fetch_array($query)) : ?>
                    <tr>
                        <td><?= $row['gro_id'] ?></td>
                        <td><?= $row['gro_name'] ?></td>
                        <td style="text-align: center;">
                            <div class="btn-group">
                                <a href="index.php?page=form_group&id=<?= $row['gro_id'] ?>" class="btn btn-info btn-sm">
                                    <i class="glyphicon glyphicon-edit"></i> EDIT
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="return deleteItem(<?= $row['gro_id'] ?>, 'db_group')">
                                    <i class="glyphicon glyphicon-trash"></i> DELETE    
                                </button>                            
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2"></th>
                    <th><button type="button" class="btn btn-warning">รวม {  <?= $record ?>  }</button></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


