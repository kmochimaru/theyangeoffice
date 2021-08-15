<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-paperclip"></i>&nbsp;<?php echo 'แนบไฟล์ - เลขที่เอกสาร' . ' '; ?><span class="text-muted"><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></span>
                    <span style="float: right">
                        <a href="<?php echo base_url() . 'withoutlist'; ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-arrow-left"></i> กลับ</a>
                    </span>
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
                <hr>
                <div class=" col-md-12 text-right">
                    <a href="<?php echo base_url() . 'withoutlist/edit/' . $data->work_info_id_pri; ?>" class="btn btn-info" class="dropdown-item small"><i class="fa fa-edit"></i> แก้ไขเอกสาร</a>
                    <!-- <a href="javascript:void(0)" onclick="modal_regisnumber('<?php echo $data->work_info_id_pri; ?>');" class="btn <?php echo ($data->work_info_id != '' ? 'btn-success' : 'btn-primary'); ?>"><i class="fa fa-check-square-o"></i> ลงทะเบียนเอกสาร</a> -->
                    <a href="<?php echo base_url() . 'withoutlist/notupload_attach/' . $data->work_info_id_pri; ?>" class="btn btn-danger">
                        <i class="fa fa-ban"></i> ไม่ต้องการแนบไฟล์
                    </a>
                    <label for="upload_attach" class="btn btn-success" style="margin-top: 5px;">
                        <i class="fa fa-upload"></i> อัพโหลดไฟล์เอกสาร
                    </label>
                    <input type="hidden" name="work_info_id_pri" id="work_info_id_pri" value="<?php echo $work_info_id_pri; ?>">
                    <input style="opacity: 0;overflow: hidden;position: absolute;z-index: -1;" type="file" accept=".csv, .pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .txt, .zip, .rar, .jpg, .jpeg, .png, .gif" multiple id="upload_attach" name="upload_attach[]" onchange="check_amount_attach();" />
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
                <!-- <div class="row">
                    <div class="col-md-12 text-left">
                        <div class="form-group row">
                            <div class="col-sm-1 text-center"></div>
                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">เลขทะเบียน :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo ($data->work_info_id != '' ? $data->work_info_id : '-'); ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">เลขที่เอกสาร :</span>
                                    <span class="col-sm-7 col-form-span" style="font-weight: bold;font-size: 14px;"><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ลงวันที่ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->misc->date2thai($data->work_info_date, '%d %m %y', 1); ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">จาก :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->work_info_from_position . ' ' . $data->work_info_from; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ถึง :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo (($data->work_info_to_position != '') && ($data->work_info_to != '') ? $data->work_info_to_position . ' ' . $data->work_info_to : '-'); ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">เรื่อง :</span>
                                    <span class="col-sm-7 col-form-span" style="font-weight: bold;font-size: 14px;"><?php echo $data->work_info_subject; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">รายละเอียด :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->work_info_detail; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">วัตถุประสงค์ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->action_info_name; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ส่งจาก :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->dep_name; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">สถานะ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;">
                                        <?php if ($data->state_info_id == 5) { ?>
                                            <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo $data->state_info_name; ?></span>
                                        <?php } else if ($data->state_info_id == 6) { ?>
                                            <span class="badge badge-success"><i class="fa fa-power-off"></i> <?php echo $data->state_info_name; ?></span>
                                        <?php } else if ($data->state_info_id == 7) { ?>
                                            <span class="badge badge-warning"><i class="fa fa-reply-all"></i> <?php echo $data->state_info_name; ?></span>
                                        <?php } else if ($data->state_info_id == 8) { ?>
                                            <span class="badge badge-danger"><i class="fa fa-reply-all"></i> <?php echo $data->state_info_name; ?></span>
                                        <?php } else if ($data->state_info_id == 9) { ?>
                                            <span class="badge badge-danger"><i class="fa fa-times-circle"></i> <?php echo $data->state_info_name; ?></span>
                                        <?php } else { ?>
                                            <span class="badge badge-info"><i class="fa fa-clock-o"></i> <?php echo $data->state_info_name; ?></span>
                                        <?php } ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-1 text-center"></div>
                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ประเภทเอกสาร :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->work_type_name; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ชั้นความเร็ว :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->priority_info_name; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ชั้นความลับ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->secret_level_name; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">หมวดเอกสาร :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->book_group_name; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ต้นฉบับ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo ($data->attach_original == 0) ? 'ไม่ส่งต้นฉบับ' : 'ส่งต้นฉบับ'; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">หมายเหตุ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo ($data->work_info_comment != '') ? $data->work_info_comment : '-'; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">สร้างโดย :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->user_fullname; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">สร้างเมื่อ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->misc->date2thai($data->work_info_create, '%d %m %y %h:%i', 1); ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">อัพเดทเมื่อ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->misc->date2thai($data->work_info_update, '%d %m %y %h:%i', 1); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
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
<div id="modal_regisnumber_fail" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-info-circle"></i> เกิดข้อผิดพลาด</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body text-center">
                    <p class="text-center" style="font-weight: bold;">เอกสารนี้มีการลงทะเบียนเอกสารแล้ว</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="location.reload();">ปิด</button>
            </div>
        </div>
    </div>
</div>
<div id="modal_regisnumber_attach" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-info-circle"></i> เกิดข้อผิดพลาด</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body text-center">
                    <p class="text-center" style="font-weight: bold;">กรุณาแนบไฟล์เอกสารก่อนลงทะเบียน</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">ปิด</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#form-add').parsley();
        $('.mydatepicker').datepicker({
            language: 'th-th',
            format: 'dd/mm/yyyy',
            autoclose: true
        });
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
        url = service_base_url + 'withoutlist/upload_attach/' + $('#work_info_id_pri').val();
        $.ajax({
            url: url,
            type: 'POST',
            contentType: false,
            data: data,
            dataType: 'json',
            processData: false,
            cache: false
        }).done(function(response) {
            for (i = 0; i < response.status.length; i++) {
                if (response.status[i] === 1) {
                    notification('success', 'Success', 'อัพโหลดรูปเรียบร้อยเเล้ว');
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
            url: service_base_url + 'withoutlist/ajax_page',
            type: 'post',
            data: {
                work_info_id_pri: $('#work_info_id_pri').val(),
            },
            success: function(response) {
                $('#result_page').html(response);
            }
        });
    }

    function delete_file(id, name) {
        url = service_base_url + 'withoutlist/delete_file';
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                id: id,
                name: name
            }
        }).done(function() {
            notification('success', 'Success', 'ลบรูปเรียบร้อยเเล้ว');
            ajax_page();
            result_detail();
        });
    }

    // function modal_regisnumber(work_info_id_pri) {
    //     $.ajax({
    //         url: service_base_url + 'withoutlist/modal_regisnumber',
    //         type: 'POST',
    //         data: {
    //             work_info_id_pri: work_info_id_pri
    //         },
    //         success: function(response) {
    //             if (response != 0) {
    //                 if (response != 1) {
    //                     $('#modal_regisnumber_fail').modal('hide');
    //                     $('#result-modal #modal-content').html(response);
    //                     $('#result-modal').modal('show', {
    //                         backdrop: 'true'
    //                     });
    //                 } else {
    //                     $('#result-modal').modal('hide');
    //                     $('#modal_regisnumber_attach').modal('show', {
    //                         backdrop: 'true'
    //                     });
    //                 }
    //             } else {
    //                 $('#result-modal').modal('hide');
    //                 $('#modal_regisnumber_fail').modal('show', {
    //                     backdrop: 'true'
    //                 });
    //             }
    //         }
    //     });
    // }

    // function regisnumber(work_info_id_pri) {
    //     $('#btn_submit').prop('disabled', true);
    //     $('#btn-modal-submit-loading').show();
    //     $.ajax({
    //         url: service_base_url + 'withoutlist/regisnumber',
    //         type: 'POST',
    //         data: {
    //             work_info_id_pri: work_info_id_pri,
    //         },
    //         success: function(response) {
    //             $('#result-modal').modal('hide');
    //             if (response == 1) {
    //                 notification('success', 'สำเร็จ', 'ลงทะเบียนเอกสารสำเร็จ');
    //                 window.location.href = service_base_url + 'withoutlist';
    //             } else {
    //                 notification('error', 'ไม่สำเร็จ', 'ลงทะเบียนเอกสารไม่สำเร็จ!');
    //                 window.location.href = service_base_url + 'withoutlist/attach/' + work_info_id_pri;
    //             }
    //             //ajax_pagination();
    //         }
    //     })
    // }

    function result_detail() {
        $('#result_detail').html('');
        $('#result_detail').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'withoutlist/ajax_detail',
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