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
                                <td>
                                    <?= $row_zoom['bordet_no'] ?>
                                    <button class="btn btn-primary" onclick="edit_item(this,<?= $row_zoom['bordet_id'] ?>)"><i class="glyphicon glyphicon-pencil"></i></button>
                                </td>
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
<script type="text/javascript">
    var ITEM_ID;
    function edit_item(element, id) {
        ITEM_ID = id;
        var td_edit = $(element).parent();
        var item_text = $(td_edit).text().trim();
        td_edit.text('');
        td_edit.append('<input class="form-control" type="text" value="' + item_text + '"/>');
        td_edit.append('<button class="btn btn-success" onclick="save_item(this)"><i class="glyphicon glyphicon-ok"></i></button>');
        td_edit.append('<button class="btn btn-danger" onclick="exit_item(this)"><i class="glyphicon glyphicon-remove"></i></button>');
        console.log('td_edit : ' + $(td_edit).text());
    }
    function save_item(element) {
        id = ITEM_ID;
        var td_edit = $(element).parent();
        var item_text = $(td_edit).find('input:text').val().trim();
        var conf = confirm(' ยืนยันการเปลี่ยนแปลง จำนวนสิ่งของ ใช่หรือไม่');
        $.ajax({
            url: '',
            data: {value: item_text, id: id},
            type: 'post',
            dataType: 'json',
            success: function(data) {
                if (data.status == 'success') {
                    exit_item(element, data.value);
                } else {

                }
            }
        });
    }
    function exit_item(element, new_value) {
        ITEM_ID = '';
        var td_edit = $(element).parent();
        var item_text = $(td_edit).find('input:text').val().trim();
        td_edit.text('');
        console.log('new_value : ' + new_value);
        if (new_value === undefined)
            td_edit.append(item_text);
        else
            td_edit.append(new_value);
        td_edit.append('<button class="btn btn-primary" onclick="edit_item(this,' + ITEM_ID + ')"><i class="glyphicon glyphicon-pencil"></i></button>');
        console.log('item_text : ' + item_text);
    }
</script>
<?php
// https://github.com/micc83/editTable

