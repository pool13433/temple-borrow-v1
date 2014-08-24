<?php include '../../config/app_connect.php'; ?>
<div class="panel panel-success">
    <div class="panel-heading">        
        <?php echo breadCrumbs('manage_person', 'จัดการ Person', 'form_person', 'เพิ่ม Person') ?>
    </div>
    <div class="panel-body">
        <table class="table table-bordered tablePagination">
            <thead>
                <tr>
                    <th style="width: 10%">รหัส</th>
                    <th>ชื่อ-สกุล</th>
                    <th>รหัสบัตร</th>
                    <th style="width: 30%">ที่อยู่</th>
                    <th>สถานะ</th>
                    <th style="width: 15%;text-align: center;">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `person` p";
                $sql .= " LEFT JOIN `districts` d ON d.district_id = p.district_id";
                $sql .= " LEFT JOIN `amphures` a ON a.amphur_id = p.amphure_id";
                $sql .= " LEFT JOIN `provinces` pv ON pv.province_id = p.province_id";
                // แสดง sql
                echo printSql($sql);

                $query = mysql_query($sql) or die(mysql_error());
                $record = mysql_num_rows($query);
                ?>
                <?php while ($row = mysql_fetch_array($query)) : ?>
                    <tr>
                        <td data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">
                            <?= $row['per_id'] ?>
                        </td>
                        <td><?= $row['per_fname'] . "-" . $row['per_lname'] ?></td>
                        <td><?= $row['per_idcard'] ?></td>                        
                        <td>
                            <textarea class="form-control" rows="5"><?=
                                " ที่อยู่  " . $row['per_address'] . " ตำบล " . $row['district_name'] .
                                " อำเภอ " . $row['amphur_name'] . " จังหวัด " . $row['province_name'] .
                                " รหัสไปรษณีย์ " . $row['per_zipcode'] . " โทร " . $row['per_tel'] .
                                " อีเมลล์ " . $row['per_email']
                                ?></textarea>
                        </td>
                        <td>
                            <?php
                            if ($row['per_active'] == 0):
                                ?>
                                <label class="label label-danger">รอ อนุมัต</label>
                            <?php else: ?>
                                <label class="label label-success">อนุมัต</label>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center;vertical-align: middle;">
                            <div class="btn-group">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <a href="index.php?page=form_person&id=<?= $row['per_id'] ?>" class="btn btn-info btn-sm">
                                            <i class="glyphicon glyphicon-edit"></i> EDIT
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <button type="button" class="btn btn-danger btn-sm" onclick="return deleteItem(<?= $row['per_id'] ?>, 'db_person')">
                                            <i class="glyphicon glyphicon-trash"></i> DELETE    
                                        </button> 
                                    </li>
                                    <li class="list-group-item">
                                        <button type="button" class="btn btn-primary btn-sm permission"   data-toggle="modal" data-target=".permission<?= $row['per_id'] ?>">
                                            <i class="glyphicon glyphicon-compressed"></i> ACTIVE    
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <div class="modal fade permission<?= $row['per_id'] ?>" 
                                 tabindex="-1" role="dialog" 
                                 aria-labelledby="myLargeModalLabel" 
                                 aria-hidden="true"
                                 data-backdrop="static">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header alert alert-info">
                                            <a class="close" data-dismiss="modal">&times;</a>
                                            <i class="glyphicon glyphicon-wrench"></i> อนุมัติ สิทธิเข้าใช้ระบบ
                                        </div>
                                        <div class="modal-body">
                                            <select class="form-control" name="permission" id="permission<?= $row['per_id'] ?>">
                                                <option value="0">รอ อนุมัต</option>
                                                <option value="1">อนุมัต</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <a class="btn btn-primary btn-sm" id="btn_save" onclick="savePermission(<?= $row['per_id'] ?>)">
                                                <i class="glyphicon glyphicon-ok-sign"></i> บันทึก
                                            </a>
                                            <a class="btn btn-danger btn-sm" data-dismiss="modal">
                                                <i class="glyphicon glyphicon-remove-sign"></i> ปิด
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5"></th>
                    <th><button type="button" class="btn btn-warning">รวม {  <?= $record ?>  }</button></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<script type="text/javascript">
                                            function savePermission(id) {
                                                var value = $('#permission' + id).val();
                                                $.ajax({
                                                    url: 'db_person.php?method=permission',
                                                    data: {
                                                        id: id,
                                                        value: value
                                                    },
                                                    type: 'post',
                                                    success: function(data) {
                                                        if (data == 1) {
                                                            window.location.reload();
                                                        } else {
                                                            alert(' แก้ไข ไม่สำเร็จ');
                                                        }
                                                    }
                                                });
                                            }
</script>

