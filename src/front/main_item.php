<div class="panel panel-success">
    <div class="panel-heading">        
        ผลการค้นหา
    </div>
    <div class="panel-body" id="content">
        <?php
        include '../../config/app_connect.php';

        $sql = "SELECT * FROM `item` i";
        $sql .= " JOIN `group` g ON g.gro_id = i.gro_id";
        $sql .= " JOIN `type` t ON t.typ_id = i.typ_id";
        $sql .= " JOIN `size` s ON s.siz_id = i.siz_id";
        $sql .= " WHERE 1=1";
        if (!empty($_POST)) {

            $search = $_POST['search'];

            $sql .= " AND (";
            $sql .= " gro_name LIKE '%" . $search . "%'";
            $sql .= " OR gro_name LIKE '%" . $search . "%'";
            $sql .= " OR typ_name LIKE '%" . $search . "%'";
            $sql .= " OR siz_name LIKE  '%" . $search . "%'";
            $sql .= " OR ite_no LIKE  '%" . $search . "%'";
            $sql .= " )";
        }
        // แสดง sql
        //echo $sql;

        $query = mysql_query($sql) or die(mysql_error());
        $record = mysql_num_rows($query);
        if ($record > 0):
            ?>
            <table class="table table-bordered tablePagination">
                <thead>
                    <tr>
                        <th style="width: 10%">รหัส</th>
                        <th>ชื่อ</th>
                        <th style="width: 15%;text-align: center;">กลุ่ม</th>
                        <th style="width: 10%;text-align: center;">ความสำคัญ</th>
                        <th style="width: 10%;text-align: center;">ขนาด</th>
                        <th style="width: 10%;text-align: center;">จำนวนที่มี</th>
                        <th style="width: 10%;text-align: center;">ACTION</th>
                    </tr>
                </thead>
                <tbody>        
                    <?php while ($row = mysql_fetch_array($query)) : ?>
                        <tr>
                            <td><?= $row['ite_id'] ?></td>
                            <td><?= $row['ite_name'] ?></td>
                            <td><?= $row['gro_name'] ?></td>
                            <td>
                                <?php
                                if ($row['ite_priority'] == 1):
                                    ?>
                                    <button type="button" class="btn btn-sm btn-success popover-dismiss" 
                                            data-toggle="popover" 
                                            title="อธิบาย" 
                                            data-content="ความสำคัญ ธรรมดา ไม่ต้องผ่าน การอนุมัตจากเจ้าอาวาส">
                                        ธรรมดา
                                    </button>
                                    <?php
                                else:
                                    ?>
                                    <button type="button" class="btn btn-sm btn-primary popover-dismiss" 
                                            data-toggle="popover" 
                                            title="อธิบาย" 
                                            data-content="ความสำคัญ พิเศษ ต้องผ่าน การอนุมัตจากเจ้าอาวาส">
                                        พิเศษ
                                    </button>
                                <?php
                                endif;
                                ?>
                            </td>                          
                            <td><?= $row['siz_name'] ?></td>
                            <td>
                                <h4><label class="label label-warning"><?= $row['ite_no'] . " " . $row['typ_name'] ?></label></h4>
                            </td>
                            <td style="text-align: center;">
                                <div class="btn-group">
                                    <button  class="btn btn-info btn-sm popover-dismiss"  
                                             data-toggle="modal" data-target=".item<?= $row['ite_id'] ?>"
                                             data-placement="left" data-container="body" title="อธิบาย" 
                                             data-content="Click เพื่อ ใส่ จำนวนที่ต้องการยืม">
                                        <i class="glyphicon glyphicon-edit"></i> ยืม
                                    </button>
                                </div>
                                <!--modal-->
                                <div class="modal fade item<?= $row['ite_id'] ?>" 
                                     tabindex="-1" role="dialog" 
                                     aria-labelledby="myLargeModalLabel" 
                                     aria-hidden="true"
                                     data-backdrop="static">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header alert alert-info">
                                                <a class="close" data-dismiss="modal">&times;</a>
                                                <i class="glyphicon glyphicon-shopping-cart"></i> ใส่จำนวนที่ต้องการ
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label class="col-md-4">ใส่จำนวน</label>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="ite_no" id="item<?= $row['ite_id'] ?>"/>
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-primary btn-sm" id="btn_save" onclick="return saveCart(<?= $row['ite_id'] ?>)">
                                                    <i class="glyphicon glyphicon-ok-sign"></i> ใส่ ตะกร้า
                                                </a>
                                                <a class="btn btn-danger btn-sm" data-dismiss="modal">
                                                    <i class="glyphicon glyphicon-remove-sign"></i> ปิด
                                                </a>
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
                        <th><button type="button" class="btn btn-warning">รวม {  <?= $record ?>  }</button></th>
                    </tr>
                </tfoot>
            </table>
        <?php endif; ?>
    </div>
</div>

<script type="text/javascript">
                                                    function saveCart(id) {
                                                        var value = $('#item' + id).val();
                                                        if (parseInt(value)) {
                                                            $.ajax({
                                                                url: 'db_borrow_detail.php?method=additem',
                                                                data: {
                                                                    id: id,
                                                                    value: value
                                                                },
                                                                type: 'post',
                                                                success: function(data) {
                                                                    if (data == 1) {
                                                                        window.location = 'index.php?page=main_cart';
                                                                    } else {
                                                                        alert(' เพิ่ม ไม่สำเร็จ');
                                                                    }
                                                                }
                                                            });
                                                        } else {
                                                            alert(' กรุณากรอก ตัวเลขเท่านั้น');
                                                            return false;
                                                        }

                                                    }
                                                    $('.popover-dismiss').popover({
                                                        trigger: 'hover'
                                                    })
</script>
