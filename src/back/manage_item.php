<?php include '../../config/app_connect.php'; ?>
<div class="panel panel-success">
    <div class="panel-heading">        
        <?php echo breadCrumbs('manage_item', 'จัดการ item', 'form_item', 'เพิ่ม item') ?>
    </div>
    <div class="panel-body">
        <table class="table table-bordered tablePagination">
            <thead>
                <tr>
                    <th style="width: 10%">รหัส</th>
                    <th>ชื่อ</th>
                    <th>กลุ่ม</th>
                    <th>ชนิด</th>
                    <th>ขนาด</th>
                    <th>จำนวน</th>
                    <th style="width: 30%;text-align: center;">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `item` i";
                $sql .= " JOIN `group` g ON g.gro_id = i.gro_id";
                $sql .= " JOIN `type` t ON t.typ_id = i.typ_id";
                $sql .= " JOIN `size` s ON s.siz_id = i.siz_id";
                // แสดง sql
                echo printSql($sql);

                $query = mysql_query($sql) or die(mysql_error());
                $record = mysql_num_rows($query);
                ?>
                <?php while ($row = mysql_fetch_array($query)) : ?>
                    <tr>
                        <td><?= $row['ite_id'] ?></td>
                        <td><?= $row['ite_name'] ?></td>
                        <td><?= $row['gro_name'] ?></td>
                        <td><?= $row['typ_name'] ?></td>
                        <td><?= $row['siz_name'] ?></td>
                        <td><?= $row['ite_no'] ?></td>
                        <td style="text-align: center;">
                            <div class="btn-group">
                                <a href="index.php?page=form_item&id=<?= $row['ite_id'] ?>" class="btn btn-info btn-sm">
                                    <i class="glyphicon glyphicon-edit"></i> EDIT
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="return deleteItem(<?= $row['ite_id'] ?>, 'db_item')">
                                    <i class="glyphicon glyphicon-trash"></i> DELETE    
                                </button>      
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".add_item<?= $row['ite_id'] ?>">
                                    <i class="glyphicon glyphicon-plus"></i> ADD ITEM
                                </button>
                            </div>

                            <!--modal-->
                            <div class="modal fade add_item<?= $row['ite_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <i class="glyphicon glyphicon-plus-sign"></i> เพิ่มจำนวน สิ่งของ : [<?= $row['ite_name'] ?>]
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" id="additem-form<?= $row['ite_id'] ?>">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label class="col-sm-4">จำนวนของ เพิ่ม</label>
                                                        <div class="col-sm-8">
                                                            <input type="hidden" name="id" value="<?= $row['ite_id'] ?>"/>
                                                            <input type="number" class="form-control" name="ite_no"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary btn-sm" onclick="return addNewItem(<?= $row['ite_id'] ?>)">
                                                <i class="glyphicon glyphicon-ok-circle"></i> OK
                                            </button>
                                            <button type="button" class="btn btn-warning btn-sm"  data-dismiss="modal">
                                                <i class="glyphicon glyphicon-remove-circle"></i> ปิด
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--modal-->

                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6"></th>
                    <th style="text-align: center;"><button type="button" class="btn btn-warning">รวม {  <?= $record ?>  }</button></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<script type="text/javascript">
                                    function addNewItem(id) {
                                        if (confirm('ยืนยัน การ เพิ่มจำนวน ของ รหัส สิ่งของ [ ' + id + ' ] ใช่ หรือ ไม่')) {
                                            $.ajax({
                                                url: 'db_item.php?method=addnewitem',
                                                data: $('#additem-form' + id).serialize(),
                                                type: 'post',
                                                success: function(data) {
                                                    if (data == 1) {
                                                        window.location.reload();
                                                    } else {
                                                        alert(' แก้ไข ไม่สำเร็จ : \n' + data);
                                                    }
                                                }
                                            });
                                            return true;
                                        }
                                        return false;
                                    }
</script>

