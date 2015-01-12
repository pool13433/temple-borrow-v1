$(function() {
// date picker one input (.date)
    $('.date').datepicker({
        
    });
    // date picker between (.datefrom,.dateto)
    datePickerBeTween();

    // datatable
    var oTable = tableGridPagination(10);
    //oTable.fnSort([[0, 'asc']]); //, [1, 'desc']
});
function tableGridPagination(sizePage) {
//$(document).ready(function() {
    var oTable = $('.tablePagination').dataTable({
        "bSort": true, // Disable sorting
        //"order": [[columnSortDesc, "desc" ]],
        "iDisplayLength": sizePage, //records per page
        //"sDom": "t<'row'<'col-md-6'i><'col-md-6'p>>",
        //"bJQueryUI": true, // color header yellow
        //"sPaginationType": "full_numbers",
        "sDom": "<'row'<'col-xs-9'l><'col-xs-3'f>r>t<'row'<'col-xs-8'i><'col-xs-4'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ รายการต่อหน้า",
            "sSearch": ""
        }
    });
    //oTable.fnSort( [ [columnSortDesc,'desc']] );
    $('.dataTables_filter input').addClass('form-control').attr('placeholder', 'ค้นหาข้อมูล...');
    $('.dataTables_length select').addClass('form-control');
    return oTable;
    //});
}
function datePickerBeTween() {
    var total_date = $("#from").parent();
    //total_date.append('<input type="text" name="total_date" id="total" />');
    $("#from").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd",
        onClose: function(selectedDate) {
            $("#to").datepicker("option", "minDate", selectedDate);
            /*
             var arrDate = $("#to").val().split('-');
             alert(arrDate[1]);
             $('#total').val(arrDate[2]);*/
        }
    });
    $("#to").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd",
        onClose: function(selectedDate) {
            $("#from").datepicker("option", "maxDate", selectedDate);
        }
    });
}
function datePicker1Day() {
    $('#day').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
    });
}
function deleteItem(id, url) {
    if (confirm('ยืนยันการลบ รหัส: ' + id + " ใช่หรือไม่")) {
        $.ajax({
            url: url,
            data: {id: id},
            type: 'POST',
            success: function(data) {
// alert(data);
                if (data) {
                    window.location.reload();
                } else {
                    alert('ลบไม่สำเร็จ เกิดข้อผิดพลาด');
                }
            }
        });
    }
}



function CheckExtension(file) {
    var validFilesTypes = ["bmp", "gif", "png", "jpg", "jpeg",
        "doc", "docx", "xls", "xlsx", "rar", "zip", "txt", "pdf"];
    /*global document: false */
    var filePath = file.value;
    var ext = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
    var isValidFile = false;
    for (var i = 0; i < validFilesTypes.length; i++) {
        if (ext == validFilesTypes[i]) {
            isValidFile = true;
            break;
        }
    }

    if (!isValidFile) {
        file.value = null;
        alert("Invalid File. Valid extensions are:\n\n" + validFilesTypes.join(", "));
    }

    return isValidFile;
}
function CheckFileSize(file) {
    var validFileSize = 15 * 1024 * 1024;
    /*global document: false */
    var fileSize = file.files[0].size;
    var isValidFile = false;
    if (fileSize !== 0 && fileSize <= validFileSize) {
        isValidFile = true;
    }
    else {
        file.value = null;
        alert("File Size Should be Greater than 0 and less than 15 MB.");
    }
    return isValidFile;
}
function CheckFile(file) {
    var isValidFile = CheckExtension(file);
    if (isValidFile)
        isValidFile = CheckFileSize(file);
    return isValidFile;
}
function comboChild(object) {
    return new Option(object.pac_name, object.pac_id);
    //return '<option value="' + object.pac_id + '">' + object.pac_name + '</option>';
}
function validate() {
    var refex = "[0-9]{2}";
    var tel = $('#tel').val();
    var idcart = $('#idcart').val();
    if (refex.test(tel) || refex.test(idcart)) {
        return false;
    } else {
        return true;
    }
}

function deleteItem(id, url) {
    if (confirm('ยืนยันการลบ ข้อมูล รหัส [ ' + id + ' ] ใช่ หรือ ไม่')) {
        $.ajax({
            url: url + '.php?method=delete',
            data: {id: id},
            type: 'post',
            success: function(data) {
                if (data == 1) {
                    // alert('ลบข้อมูล สำเร็จ');
                    window.location.reload();
                } else {
                    alert(' DElete Fail : \n' + data);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                var msg = '';
                msg = xhr.status + '\n';
                msg = thrownError + '\n';
                alert('เกิดข้อผิดพลาด ไม่สามารถลบข้อมูลได้ : ' + msg);
            }
        });
    }
    return false;
}
function logout() {
    if (confirm(' ยืนยันการออกจากระบบ ใช่ หรือ ไม่')) {
        $.ajax({
            url: '../db_person.php?method=logout',
            success: function() {
                window.location = '../index.php?page=login';
            }
        });
        return true;
    }
    return false;
}
function tooltip(id, title, content, position) {
    var contentHtml = [
        '<div>',
        '<button class="btn btn-link cancel">Cancel</button>',
        '<button class="btn btn-primary save">Save</button>',
        '</div>'].join('\n');

    $("#" + id + "").popover({
        placement: position,
        html: 'true',
        title: '<span class="text-info"><strong>' + title + '</strong></span>' +
                '<button type="button" id="close" class="close" onclick="$(&quot;#example&quot;).popover(&quot;hide&quot;);">&times;</button>',
        content: contentHtml,
    });
}
function searchItem() {
    $.ajax({
        url: 'main_item.php',
        data: $('#search-form').serialize(),
        type: 'post',
        dataType: 'html',
        success: function(data) {
            $('#content').html(data);
        }
    })
}
function updateBorrowStatus(id, value) {
    if (confirm('ยืนยันการ ยกเลิก การยืม รหัสใบยืมที่ [ ' + id + ' ] จากวัด ใช่ หรือ ไม่')) {
        $.ajax({
            url: 'db_borrow.php?method=update',
            data: {
                id: id,
                value: value
            },
            type: 'post',
            success: function(data) {
                if (data == 1) {
                    window.location.reload();
                } else {
                    alert('update status error : ' + data);
                }
            }
        });
    }
    return false;
}