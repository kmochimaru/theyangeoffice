<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i>&nbsp;<?php echo $title . ' - เลขที่เอกสาร' . ' '; ?><span class="text-muted"><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></span>
                    <span style="float: right">
                        <a href="<?php echo base_url() . 'managerlist'; ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-arrow-left"></i> กลับ</a>
                    </span>
                </h4>
                <hr>
                <div class="row">
                    <div class=" col-md-12 text-left">
                        <div class="form-group row">
                            <div class="col-sm-1 text-center"></div>
                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ประเภทเอกสาร :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->managerlist_model->ref_work_type($data->work_type_id)->row()->work_type_name; ?></span>
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
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->managerlist_model->ref_priority_info($data->priority_info_id)->row()->priority_info_name; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ชั้นความลับ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->managerlist_model->ref_secret_level($data->secret_level_id)->row()->secret_level_name; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">หมวดเอกสาร :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->managerlist_model->ref_book_group($data->book_group_id)->row()->book_group_name; ?></span>
                                </div>

                            </div>
                        </div>
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
                    <i class="fa fa-send"></i>&nbsp;<?php echo 'ส่งถึงผู้ปฏิบัติงาน'; ?>
                </h4>
                <hr>
                <form id="from_add" class="form-horizontal" method="post" autocomplete="off">
                    <div class="row">
                        <div class=" col-md-12 text-left">
                            <input type="hidden" name="work_info_id_pri" id="work_info_id_pri" value="<?php echo $data->work_info_id_pri; ?>">
                            <input type="hidden" name="work_process_id_pri" id="work_process_id_pri" value="<?php echo $work_process_id_pri; ?>">
                            <select id="user_id" name="user_id_select[]" multiple="multiple">
                                <?php
                                $users = $this->managerlist_model->get_userdep($this->session->userdata('dep_id_pri'));
                                if ($users->num_rows() > 0) {
                                    foreach ($users->result() as $user) {
                                ?>
                                        <option value="<?php echo $user->user_id; ?>" data-index="1"><?php echo $user->user_fullname; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <hr />
                    <div id="modal_send" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"> ยืนยันการส่งหนังสือ</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="bootbox-body text-center">
                                        <p class="text-center" style="font-weight: bold;">ยืนยันการส่งหนังสือ เลขที่เอกสาร <?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?> ใช่หรือไม่</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="btn_update" class="btn btn-info"><span id="btn-modal-submit-loading" style="display: none;"><i class="fa fa-spinner fa-spin"></i> </span> ทำการส่ง</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="modal_send_0" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"> ยืนยันการส่งหนังสือ</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="bootbox-body text-center">
                                        <p class="text-center" style="font-weight: bold;">กรุณาเลือกหน่วยงานที่ต้องการส่ง</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-right">
                            <button type="button" class="btn btn-info" onclick="modal_send();"><i class="fa fa-send"></i>&nbsp;ส่ง</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="result-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
<div id="result-modal-lg" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
    </div>
</div>

<script>
    $("#user_id").treeMultiselect({
        allowBatchSelection: true,
        enableSelectAll: true,
        searchable: true,
        sortable: false,
        startCollapsed: true
    });

    function modal_send() {
        if ($("[name='user_id_select[]']").val().length > 0) {
            $('#modal_send').modal('show', {
                backdrop: 'true'
            });
            $('#modal_send_0').modal('hide');
        } else {
            $('#modal_send_0').modal('show', {
                backdrop: 'true'
            });
            $('#modal_send').modal('hide');
        }
    }

    $('#from_add').submit(function(e) {
        $('#btn_update').prop('disabled', true);
        $('#btn-modal-submit-loading').show();
        e.preventDefault()
        var postData = new FormData($(this)[0])
        $.ajax({
            url: '<?php echo base_url() . 'managerlist/sendtouser'; ?>',
            type: 'POST',
            data: postData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#modal_send').modal('hide');
                // console.log(response);
                if (response == 0) {
                    $('#btn_update').prop('disabled', false);
                    $('#btn-modal-submit-loading').hide();
                    notification('error', 'ไม่สำเร็จ', 'เพิ่มข้อมูลไม่สำเร็จ ลองใหม่อีกครั้ง');
                } else {
                    //notification('success', 'สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
                    window.location.href = '<?php echo base_url() . 'managerlist/detail/'; ?>' + $('#work_process_id_pri').val();
                }
            }
        })
    })
</script>