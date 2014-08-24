<?php include '../../config/app_connect.php'; ?>
<div class="panel panel-success">
    <div class="panel-heading">        
        <?php echo breadCrumbs('manage_szie', 'จัดการ size', 'form_size', 'เพิ่ม sze') ?>
    </div>
    <div class="panel-body">
        <table class="table table-bordered tablePagination">
            <thead>
                <tr>
                    <th style="width: 10%">รหัส</th>
                    <th>ชื่อ</th>
                    <th>กลุ่ม</th>
                    <th style="width: 25%;text-align: center;">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `size` s";
                $sql .= " JOIN `group` g ON s.gro_id = g.gro_id";
                $sql .= " ORDER BY siz_id";
                // แสดง sql
                echo printSql($sql);

                $query = mysql_query($sql) or die(mysql_error());
                $record = mysql_num_rows($query);
                ?>
                <?php while ($row = mysql_fetch_array($query)) : ?>
                    <tr>
                        <td><?= $row['siz_id'] ?></td>
                        <td><?= $row['siz_name'] ?></td>
                        <td><?= $row['gro_name'] ?></td>
                        <td style="text-align: center;">
                            <div class="btn-group">
                                <a href="index.php?page=form_size&id=<?= $row['siz_id'] ?>" class="btn btn-info btn-sm">
                                    <i class="glyphicon glyphicon-edit"></i> EDIT
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="return deleteItem(<?= $row['siz_id'] ?>, 'db_size')">
                                    <i class="glyphicon glyphicon-trash"></i> DELETE    
                                </button>   
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3"></th>
                    <th><button type="button" class="btn btn-warning">รวม {  <?= $record ?>  }</button></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


