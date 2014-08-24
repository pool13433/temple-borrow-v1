function renderProvinceAmphure(province_id, back, amphure_id) {
    var url = 'db_amphure.php?method=json';
    if (back != null) {
        url = './back/db_amphure.php?method=json'
    }
    $.ajax({
        url: url,
        data: {province_id: province_id},
        dataType: 'json',
        type: 'get',
        success: function(data) {
            //alert(data.amphur_id);
            $('#amphure').children().remove();
            $.each(data, function(key, value) {
                if (amphure_id == value.amphur_id) {
                    $('#amphure')
                            .append($("<option></option>")
                            .attr("value", value.amphur_id)
                            .attr("selected", true)
                            .text(value.amphur_name));
                } else {
                    $('#amphure')
                            .append($("<option></option>")
                            .attr("value", value.amphur_id)
                            .text(value.amphur_name));
                }

            });
        },
        error: function(date) {
            $('#amphure').children().remove();
        }
    });
}

function renderAmphurDistrict(amphur_id, back, district_id) {
    var url = './db_district.php?method=json'
    if (back != null) {
        url = './back/db_district.php?method=json'
    }
    $.ajax({
        url: url,
        data: {ampure_id: amphur_id},
        dataType: 'json',
        type: 'get',
        success: function(data) {
            //alert(data.amphur_id);
            $('#district').children().remove();
            $.each(data, function(key, value) {

                if (district_id == value.district_id) {
                    $('#district')
                            .append($("<option></option>")
                            .attr("value", value.district_id)
                            .attr("selected", true)
                            .text(value.district_name));
                    alert('append seelct');
                } else {
                    $('#district')
                            .append($("<option></option>")
                            .attr("value", value.district_id)
                            .text(value.district_name));
                }

            });
        },
        error: function(xhr, ajaxOptions, thrownError) {
            var msg = '';
            msg = xhr.status + '\n';
            msg = thrownError + '\n';
            alert('เกิดข้อผิดพลาด  : \n' + msg);
            $('#district').children().remove();
        },
    });
}

function renderDistrictZipcode(district_id, back) {
    var url = './db_zipcode.php?method=json'
    if (back != null) {
        url = './back/db_zipcode.php?method=json'
    }
    $.ajax({
        url: url,
        data: {district_id: district_id},
        dataType: 'json',
        type: 'get',
        success: function(data) {
            $('#zipcode').val(data.zipcode);
        },
        error: function(date) {
            $('#zipcode').val('');
        }
    });
}
