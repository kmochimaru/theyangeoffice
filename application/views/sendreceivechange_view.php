<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i>&nbsp;<?php echo $title . ' - เลขที่เอกสาร' . ' '; ?><span class="text-muted"><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></span>
                </h4>
                <hr>
                <div class="row">
                    <div class=" col-md-12 text-left">
                        <div class="form-group row">
                            <div class="col-sm-1 text-center"></div>
                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ประเภทเอกสาร :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->receivelist_model->ref_work_type($data->work_type_id)->row()->work_type_name; ?></span>
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
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->receivelist_model->ref_priority_info($data->priority_info_id)->row()->priority_info_name; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ชั้นความลับ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->receivelist_model->ref_secret_level($data->secret_level_id)->row()->secret_level_name; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">หมวดเอกสาร :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->receivelist_model->ref_book_group($data->book_group_id)->row()->book_group_name; ?></span>
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
                    <i class="fa fa-send"></i>&nbsp;<?php echo 'ส่งถึงหน่วยงาน'; ?>
                </h4>
                <hr>
                <form id="from_add" class="form-horizontal" method="post" autocomplete="off">
                    <div class="row">
                        <div class=" col-md-12 text-left">
                            <input type="hidden" name="work_info_id_pri" id="work_info_id_pri" value="<?php echo $data->work_info_id_pri; ?>">
                            <input type="hidden" name="work_process_id_pri" id="work_process_id_pri" value="<?php echo $work_process_id_pri; ?>">
                            <select id="def_id_pri" name="def_id_pri_select[]" multiple="multiple">
                                <?php
                                $orgs = $this->receivelist_model->getOrganization();
                                if ($orgs->num_rows() > 0) {
                                    foreach ($orgs->result() as $org) {
                                        $deps = $this->receivelist_model->getOrgDepartment($org->org_id_pri);
                                        if ($deps->num_rows() > 0) {
                                            foreach ($deps->result() as $dep) {
                                                $dep_offs = $this->receivelist_model->getdep_off($dep->dep_id_pri);
                                                if ($dep_offs->num_rows() > 0) {
                                                    foreach ($dep_offs->result() as $dep_off) {
                                                        if ($this->session->userdata('dep_off_id') != $dep_off->dep_off_id) {
                                ?>
                                                            <option value="<?php echo $dep_off->dep_off_id; ?>" data-section="<?php echo $dep->dep_name; ?>" data-index="1"><?php echo $dep_off->officer_name; ?></option>
                                <?php
                                                        }
                                                    }
                                                }
                                            }
                                        }
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
                                    <button type="submit" id="btn_update" class="btn btn-info"><span id="btn-modal-submit-loading" style="display: none;"><i class="fa fa-spinner fa-spin"></i> </span> ทำการส่งเปลี่ยนแปลงเส้นทาง</button>
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
                                        <p class="text-center" style="font-weight: bold;">กรุณาเลือกหน่วยงานที่ต้องการส่งเปลี่ยนแปลงเส้นทาง</p>
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
                            <button type="button" class="btn btn-outline-info" onclick="modal_send();"><i class="fa fa-send-o"></i>&nbsp;เปลี่ยนแปลงเส้นทาง</button>
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
    $("#def_id_pri").treeMultiselect({
        allowBatchSelection: true,
        enableSelectAll: true,
        searchable: true,
        sortable: true,
        startCollapsed: true
    });

    function modal_send() {
        if ($("[name='def_id_pri_select[]']").val().length > 0) {
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
            url: '<?php echo base_url() . 'receivelist/changesendto'; ?>',
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
                    window.location.href = '<?php echo base_url() . 'receivelist/detail/'; ?>' + $('#work_process_id_pri').val();
                }
            }
        })
    })
</script>