<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-paperclip"></i>&nbsp;<?php echo 'ลงนาม - เลขที่เอกสาร' . ' '; ?><span class="text-muted"><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?> </span>
                    <span style="float: right">
                        <label for="upload_attach_sign" class="btn btn-sm btn-rounded btn-success">
                            <i class="fa fa-upload"></i> อัพโหลดลายเซ็น ลงนาม
                        </label>
                    </span>
                    <input type="hidden" name="work_info_id_pri" id="work_info_id_pri" value="<?php echo $work_info_id_pri; ?>">
                    <input style="opacity: 0;overflow: hidden;position: absolute;z-index: -1;" type="file" accept=".jpg, .jpeg, .png" id="upload_attach_sign" name="upload_attach_sign" onchange="upload_attach_sign();" />
                </h4>
                <hr>
                <div id="result_page_sign">

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
                    <div class="col-md-12 text-left">
                        <div class="form-group row">
                            <div class="col-sm-1 text-center"></div>
                            <div class="col-sm-5"> 
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ประเภทเอกสาร :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->withinwaiting_model->ref_work_type($data->work_type_id)->row()->work_type_name; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">เลขที่เอกสาร :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">จาก :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->work_info_from_position . '' . $data->work_info_from; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ถึง :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->work_info_to_position . '' . $data->work_info_to; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">เรื่อง :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->work_info_subject; ?></span>
                                </div>
                            </div>
                            <div class="col-sm-1 text-center"></div>
                            <div class="col-sm-5"> 
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ลงวันที่ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->misc->offsetyear($data->work_info_date, 543); ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ชั้นความเร็ว :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->withinwaiting_model->ref_priority_info($data->priority_info_id)->row()->priority_info_name; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ชั้นความลับ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->withinwaiting_model->ref_secret_level($data->secret_level_id)->row()->secret_level_name; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">หมวดเอกสาร :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->withinwaiting_model->ref_book_group($data->book_group_id)->row()->book_group_name; ?></span>
                                </div>
                                
                            </div>
                        </div>  
                    </div>
                </div>             
            </div>
        </div>
    </div>
</div>
<div id="modal_signature" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> ยืนยันการลงนาม</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body text-center">
                    <p class="text-center" style="font-weight: bold;">ลงนาม เลขที่เอกสาร <?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></p>
                </div>
            </div>
            <div class="modal-footer">
                <a href="<?php echo base_url() . 'withinwaiting/signature/' . $work_info_id_pri ?>" class="btn btn-info">ยืนยัน</a>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        ajax_page_sign();
    });


    function ajax_page_sign() {
        $('#result_page_sign').html('');
        $('#result_page_sign').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'withinwaiting/ajax_page_sign',
            type: 'post',
            data: {
                work_info_id_pri: $('#work_info_id_pri').val(),
            },
            success: function (response) {
                $('#result_page_sign').html(response);
            }
        });
    }

    function modal_signature() {
        $('#modal_signature').modal('show', {backdrop: 'true'});
    }

    function upload_attach_sign() {
        var myfiles_sign = document.getElementById("upload_attach_sign");
        var files_sign = myfiles_sign.files;
        var data_sign = new FormData();

        for (i = 0; i < files_sign.length; i++) {
            data_sign.append('file' + i, files_sign[i]);
        }
        $('#result_page_sign').html('');
        $('#result_page_sign').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        url = service_base_url + 'withinwaiting/upload_attach_sign/' + $('#work_info_id_pri').val();
        $.ajax({
            url: url,
            type: 'POST',
            contentType: false,
            data: data_sign,
            dataType: 'json',
            processData: false,
            cache: false
        }).done(function (response) {
            //console.log(response);
            if (response === 1) {
                notification('success', 'Success', 'อัพโหลดรูปเรียบร้อยเเล้ว');
            }
            else if (response === 2) {
                notification('error', 'เกิดข้อผิดพลาด', 'รูปแบบไฟล์ไม่ถูกต้องนามสกุลไฟล์ไม่ถูกต้อง');
            }
            else {
                notification('error', 'เกิดข้อผิดพลาด', 'ไฟล์มีขนาดใหญ่เกิน 20 MB');
            }
            ajax_page_sign();
        });
    }

    function signature() {
        $.ajax({
            url: service_base_url + 'withinwaiting/signature',
            type: 'POST',
            data: {
                work_info_id_pri: $("#work_info_id_pri").val(),
            },
            success: function (response) {
                $('#modal_signature').modal('hide');
            }
        });
    }

</script>
