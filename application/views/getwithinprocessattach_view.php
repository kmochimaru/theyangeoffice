<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-paperclip"></i>&nbsp;<?php echo 'เพิ่มไฟล์ - เลขที่เอกสาร' . ' '; ?><span class="text-muted"><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></span>
                    <span style="float: right">
                        <label for="upload_attach" class="btn btn-sm btn-rounded btn-success">
                            <i class="fa fa-upload"></i> อัพโหลดไฟล์เอกสาร 
                        </label>
                    </span>
                    <input type="hidden" name="work_info_id_pri" id="work_info_id_pri" value="<?php echo $work_info_id_pri; ?>">
                    <input type="hidden" name="work_process_id_pri" id="work_process_id_pri" value="<?php echo $work_process_id_pri; ?>">
                    <input style="opacity: 0;overflow: hidden;position: absolute;z-index: -1;" type="file" accept=".csv, .pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .txt, .zip, .rar, .jpg, .jpeg, .png, .gif" multiple id="upload_attach" name="upload_attach[]" onchange="check_amount_attach();" />
                </h4>
                <hr>
                <div id="result_page" style="min-height:10vh">
                </div>
                <hr>
                <div class="row">
                    <div class=" col-md-12 text-left">
                        <span style="color: #900; font-weight: bold;">** หมายเหตุ :</span><br>
                        <span style="color: #900;">- อัพโหลดไฟล์ได้ไม่เกิน 5 ไฟล์</span><br>
                        <span style="color: #900;">- อัพโหลดไฟล์นามสกุล .csv, .pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .txt, .zip, .rar, .jpg, .jpeg, .png, .gif ได้เท่านั้น</span><br>
                        <span style="color: #900;">- อัพโหลดขนาดไฟล์ได้ไม่เกิน 20 MB</span>
                    </div>
                </div>
                <div id="close_upload">
                    <hr>
                    <div class=" col-md-12 text-right">
                        <a href="<?php echo base_url() . 'getwithinprocess/detail/' . $work_process_id_pri; ?>" id class="btn btn-warning"><i class="fa fa-check-circle-o"></i>&nbsp;อัพโหลดเสร็จสิ้น</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i>&nbsp;<?php echo $title . ' - เลขที่เอกสาร' . ' '; ?><span class="text-muted"><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></span>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-md-12 text-left" id="result_detail">

                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="<?php echo base_url() . 'getwithinprocess'; ?>" class="btn btn-secondary" ><i class="fa fa-arrow-left"></i>&nbsp;กลับ</a>
                        <a href="<?php echo base_url() . 'getwithinprocess/detail/' . $work_process_id_pri; ?>" class="btn btn-info" ><i class="fa fa-navicon"></i>&nbsp;รายละเอียด</a>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="result-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content">

        </div>
    </div>
</div>
<script>
    $(function () {
        $('#form-add').parsley();
        $('.mydatepicker').datepicker({
            language: 'th-th',
            format: 'dd/mm/yyyy',
            autoclose: true
        });
        $('#close_upload').hide();
        ajax_page();
        result_detail();
    });

    function date_convert(input_id, output_id) {
        get_date = $('#' + input_id).val();
        if (get_date != '') {
            split_date = get_date.split('/');
            date = (parseInt(split_date[2]) - 543) + '-' + split_date[1] + '-' + split_date[0];
            $('#' + output_id).val(date);
        } else {
            $('#' + output_id).val('');
        }
        $('#' + output_id).change();
    }

    function check_amount_attach() {
        var myfiles = document.getElementById("upload_attach");
        var files = myfiles.files;
        var amount_upload_attach = $('#amount_upload_attach').val();
        if (files.length > amount_upload_attach) {
            if (amount_upload_attach == 0) {
                notification('error', 'เกิดข้อผิดพลาด', 'ไม่สามารถอัพโหลดไฟล์เอกสารได้อีก');
            } else {
                notification('error', 'เกิดข้อผิดพลาด', 'อัพโหลดไฟล์ได้อีก ' + amount_upload_attach + ' ไฟล์');
            }
        } else {
            upload_attach();
        }
    }

    function upload_attach() {
        var myfiles = document.getElementById("upload_attach");
        var files = myfiles.files;
        var data = new FormData();

        for (i = 0; i < files.length; i++) {
            data.append('file' + i, files[i]);
        }
        $('#result_page').html('');
        $('#result_page').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        url = service_base_url + 'getwithinprocess/upload_attach/' + $('#work_process_id_pri').val();
        $.ajax({
            url: url,
            type: 'POST',
            contentType: false,
            data: data,
            dataType: 'json',
            processData: false,
            cache: false
        }).done(function (response) {
            //console.log(response)
            for (i = 0; i < response.status.length; i++) {
                if (response.status[i] === 1) {
                    notification('success', 'Success', 'อัพโหลดรูปเรียบร้อยเเล้ว');
                    $('#close_upload').show();
                } else if (response.status[i] === 2) {
                    notification('error', 'เกิดข้อผิดพลาด', 'รูปแบบไฟล์ไม่ถูกต้องนามสกุลไฟล์ไม่ถูกต้อง');
                } else {
                    notification('error', 'เกิดข้อผิดพลาด', 'ไฟล์มีขนาดใหญ่เกิน 20 MB');
                }
            }
            ajax_page();
            result_detail();
        });
    }



    function ajax_page() {
        $('#result_page').html('');
        $('#result_page').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'getwithinprocess/ajax_page',
            type: 'post',
            data: {
                work_process_id_pri: $('#work_process_id_pri').val(),
            },
            success: function (response) {
                $('#result_page').html(response);
            }
        });
    }

    function delete_file(id, name) {
        url = service_base_url + 'getwithinprocess/delete_file';
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                id: id,
                name: name
            }
        }).done(function () {
            notification('success', 'Success', 'ลบรูปเรียบร้อยเเล้ว');
            $('#close_upload').show();
            ajax_page();
            result_detail();
        });
    }

    function result_detail() {
        $('#result_detail').html('');
        $('#result_detail').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'getwithin/ajax_detail',
            type: 'post',
            data: {
                work_info_id_pri: $('#work_info_id_pri').val(),
            },
            success: function(response) {
                $('#result_detail').html(response);
            }
        });
    }

</script>
