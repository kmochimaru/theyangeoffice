<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-paperclip"></i>&nbsp;<?php echo 'แนบไฟล์ - เลขที่เอกสาร' . ' '; ?><span class="text-muted"><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></span>
                    <span style="float: right">
                        <label for="upload_attach" class="btn btn-sm btn-rounded btn-success">
                            <i class="fa fa-upload"></i> อัพโหลดไฟล์เอกสาร 
                        </label>
                    </span>
                    <input type="hidden" name="work_info_id_pri" id="work_info_id_pri" value="<?php echo $work_info_id_pri; ?>">
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
                        <a href="<?php echo base_url() . 'getwithinlist/detail/' . $data->work_info_code; ?>" id class="btn btn-warning"><i class="fa fa-check-circle-o"></i>&nbsp;อัพโหลดเสร็จสิ้น</a>
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
                        <a href="<?php echo base_url() . 'getwithinlist'; ?>" class="btn btn-secondary" ><i class="fa fa-arrow-left"></i>&nbsp;กลับ</a>
                        <a href="<?php echo base_url() . 'getwithinlist/detail/' . $data->work_info_code; ?>" class="btn btn-info" ><i class="fa fa-navicon"></i>&nbsp;รายละเอียด</a>                        
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
<div id="modal_regisnumber_attach" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> เกิดข้อผิดพลาด</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body text-center">
                    <p class="text-center" style="font-weight: bold;">กรุณาแนบไฟล์หนังสือ</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">ปิด</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#close_upload').hide();
        ajax_page();
        result_detail();
    });

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
        url = service_base_url + 'getwithinlist/upload_attach/' + $('#work_info_id_pri').val();
        $.ajax({
            url: url,
            type: 'POST',
            contentType: false,
            data: data,
            dataType: 'json',
            processData: false,
            cache: false
        }).done(function (response) {
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
            url: service_base_url + 'getwithinlist/ajax_page',
            type: 'post',
            data: {
                work_info_id_pri: $('#work_info_id_pri').val(),
            },
            success: function (response) {
                $('#result_page').html(response);
            }
        });
    }

    function delete_file(id, name) {
        url = service_base_url + 'getwithinlist/delete_file';
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
