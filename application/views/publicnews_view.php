<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id="form-add"  class="form-horizontal" method="post" action="<?php echo base_url() . 'publicnews/add'; ?>" autocomplete="off">
                    <h4 class="card-title">
                        <div class="row">
                            <div class="col-sm-7">
                                <i class="<?php echo $icon; ?>"></i>&nbsp;<?php echo $title; ?>
                            </div>
                        </div>
                    </h4>
                    <hr>
                    <div class="form-group row">
                        <div class="col-sm-1 text-center"></div>
                        <div class="col-sm-5"> 
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">ประเภทเอกสาร :</label>
                                <div class="col-sm-7"> 
                                    <input type="hidden" name="work_type_id" value="4" class="form-control form-control-sm">
                                    <input type="text" name="work_type_name" value="<?php echo $this->publicnews_model->ref_work_type(4)->row()->work_type_name ?>" class="form-control form-control-sm" readonly="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">เลขที่เอกสาร :</label>
                                <div class="col-sm-7">   
                                    <div class="row">
                                        <div class="col-sm-6">    
                                            <?php $department = $this->publicnews_model->getDepartment($this->session->userdata('dep_id_pri'))->row(); ?>
                                            <input type="text" name="work_info_no"  value="<?php echo $department->dep_prefix_without; ?>" class="form-control form-control-sm" required="">
                                        </div>
                                        <div class="col-sm-6"> 
                                            <input type="text" name="work_info_no_2" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">จาก (ตำแหน่ง) :</label>
                                <div class="col-sm-7"> 
                                    <select name="work_info_from_position" class="form-control form-control-sm">
                                        <option value=""></option>
                                        <?php foreach ($this->publicnews_model->ref_position()->result() as $position_from) { ?>
                                            <option value="<?php echo $position_from->position_name; ?>"><?php echo $position_from->position_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">จาก (หน่วยงาน) :</label>
                                <div class="col-sm-7">                              
                                    <input type="text" name="work_info_from" id="work_info_from" class="form-control form-control-sm" value="<?php echo $department->dep_name; ?>" required="">
                                    <input type="hidden" name="dep_id_pri" id="dep_id_pri" class="form-control form-control-sm" value="<?php echo $department->dep_id_pri; ?>">
                                </div>
                                <div class="col-sm-1">                              
                                    <button type="button" class="btn btn-sm btn-outline-primary btn-rounded" onclick="modal_from();"><i class="fa fa-search-plus"></i></button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">เรื่อง :</label>
                                <div class="col-sm-7">                              
                                    <textarea type="text" name="work_info_subject" class="form-control form-control-sm" required=""></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">รายละเอียด :</label>
                                <div class="col-sm-7">                              
                                    <textarea type="text" name="work_info_detail" class="form-control form-control-sm" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1 text-center"></div>
                        <div class="col-sm-5"> 
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">ลงวันที่ :</label>
                                <div class="col-sm-7"> 
                                    <div class="input-group"> 
                                        <input type="text" name="work_info_date_input" id="work_info_date_input" value="<?php echo $this->misc->offsetyear(date('Y-m-d'), 543); ?>" onchange="date_convert('work_info_date_input', 'work_info_date')"  class="form-control form-control-sm mydatepicker" required=""/>
                                        <input type="hidden" id="work_info_date" name="work_info_date" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-sm" required="">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">ชั้นความเร็ว :</label>
                                <div class="col-sm-7">                              
                                    <select name="priority_info_id" class="form-control form-control-sm">
                                        <?php foreach ($this->publicnews_model->ref_priority_info()->result() as $priority_info) { ?>
                                            <option value="<?php echo $priority_info->priority_info_id; ?>"><?php echo $priority_info->priority_info_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">ชั้นความลับ :</label>
                                <div class="col-sm-7">                              
                                    <input type="hidden" name="secret_level_id" value="6" class="form-control form-control-sm">
                                    <input type="text" name="secret_level_name" value="<?php echo $this->publicnews_model->ref_secret_level(6)->row()->secret_level_name ?>" class="form-control form-control-sm" readonly="">                              
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">หมวดเอกสาร :</label>
                                <div class="col-sm-7">                              
                                    <select name="book_group_id" class="form-control form-control-sm">
                                        <?php foreach ($this->publicnews_model->ref_book_group()->result() as $book_group) { ?>
                                            <option value="<?php echo $book_group->book_group_id; ?>"><?php echo $book_group->book_group_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">วัตถุประสงค์ :</label>
                                <div class="col-sm-7">                              
                                    <select name="action_info_id" class="form-control form-control-sm">
                                        <?php foreach ($this->publicnews_model->ref_action_info()->result() as $action_info) { ?>
                                            <option value="<?php echo $action_info->action_info_id; ?>"><?php echo $action_info->action_info_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">หมายเหตุ :</label>
                                <div class="col-sm-7">                              
                                    <textarea type="text" name="work_info_comment" class="form-control form-control-sm" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>                     
                    <hr/>
                    <div id="confirm-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"> ยืนยันการบันทึกหนังสือประชาสัมพันธ์</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="bootbox-body text-center">
                                        <p class="text-center" style="font-weight: bold;">ยืนยันการบันทึกหนังสือประชาสัมพันธ์</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="btn_update" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-right">
                            <button type="button" onclick="modal_confirm();" class="btn btn-info"><i class="fa fa-save"></i>&nbsp;สร้าง</button>
                            <button type="reset" class="btn btn-danger "><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="result-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content"></div>
    </div>
</div>
<div id="result-modal-lg" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content"></div>
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

    function modal_from() {
        $('#modal-content').html('');
        $.ajax({
            url: service_base_url + 'within/from_modal',
            type: 'POST',
            success: function (response) {
                $('#result-modal-lg #modal-content').html(response);
                $('#result-modal-lg').modal('show', {backdrop: 'true'});
            }
        });
    }

    function modal_to() {
        $('#modal-content').html('');
        $.ajax({
            url: service_base_url + 'within/to_modal',
            type: 'POST',
            success: function (response) {
                $('#result-modal-lg #modal-content').html(response);
                $('#result-modal-lg').modal('show', {backdrop: 'true'});
            }
        });
    }

    function addfrom() {
        $('#work_info_from').val($('#dep_name_from').val());
        $('#result-modal-lg').modal('hide');
    }

    function addto() {
        $('#work_info_to').val($('#dep_name_to').val());
        $('#result-modal-lg').modal('hide');
    }

    $('#internal_action_id').on('change', function () {
        if (this.value == 1) {
            $('#internal_action_name').prop('required', false);
            $('#internal_action_name').prop('disabled', true);
        } else {
            $('#internal_action_name').prop('required', true);
            $('#internal_action_name').prop('disabled', false);
        }
    });

    function modal_confirm() {
        $('#confirm-modal').modal('show', {backdrop: 'true'});
    }
</script>
