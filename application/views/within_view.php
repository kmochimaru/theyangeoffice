<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id="form-add"  class="form-horizontal" method="post" action="<?php echo base_url() . 'within/add'; ?>" autocomplete="off">
                    <h4 class="card-title">
                        <div class="row">
                            <div class="col-sm-7">
                                <i class="<?php echo $icon; ?>"></i>&nbsp;<?php echo $title; ?>
                            </div>
                            <div class="col-sm-5 text-right">
                                <div class="row">
                                    <div class="col-sm-4"> </div>
                                    <div class="col-sm-7"> 
                                        <input type="number" min="1" name="booking" id="booking" class="form-control form-control-sm" placeholder="กรอกจำนวน จองเลขที่เอกสาร">
                                    </div>
                                </div>
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
                                    <input type="hidden" name="work_type_id" value="2" class="form-control form-control-sm">
                                    <input type="text" name="work_type_name" value="<?php echo $this->within_model->ref_work_type(2)->row()->work_type_name ?>" class="form-control form-control-sm" readonly="">
                                </div>
                            </div>
                            <!--                            <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">เลขที่เอกสาร :</label>
                                                            <div class="col-sm-7">   
                                                                <div class="row">
                                                                    <div class="col-sm-4" style="padding-right: 0px;">    
                            <?php //$department = $this->within_model->getDepartment($this->session->userdata('dep_id_pri'))->row();?>
                                                                        <input type="text" name="work_info_no"  value="<?php //echo $department->dep_prefix_within;?>" class="form-control form-control-sm" required="">
                                                                    </div>
                                                                    <div class="col-sm-1" style="padding-right: 0px; padding-left: 5px;">    
                                                                        <span style="font-size: 18px;">/</span>
                                                                    </div>
                                                                    <div class="col-sm-3" style="padding-right: 0px; padding-left: 0px;"> 
                                                                        <input type="text" name="work_info_no_2" class="form-control form-control-sm">
                                                                    </div>
                                                                    <div class="col-sm-4" style="padding-left: 5px;">
                            <?php //$dep_year = $this->within_model->getDepartmentyear($this->session->userdata('dep_id_pri'));?>
                                                                        <input type="number" name="work_info_no_3"  value="<?php //echo $dep_year->dep_year_number_last;?>" class="form-control form-control-sm" readonly="">
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>-->
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">เลขที่เอกสาร :</label>
                                <div class="col-sm-7">   
                                    <div class="row">
                                        <div class="col-sm-9" style="padding-right: 2px;">    
                                            <?php $department = $this->within_model->getDepartment($this->session->userdata('dep_id_pri'))->row(); ?>
                                            <input type="text" name="work_info_no"  value="<?php echo $department->dep_prefix_within; ?>" class="form-control form-control-sm">
                                        </div>
                                        <!-- <div class="col-sm-4" style="padding-right: 0px; padding-left: 2px;"> 
                                            <input type="text" name="work_info_no_2" class="form-control form-control-sm">
                                        </div> -->
                                        <div class="col-sm-3" style="padding-right: 0px; padding-left: 8px; padding-top: 4px;"> 
                                            <?php $dep_year = $this->within_model->getDepartmentyear($this->session->userdata('dep_id_pri')); ?>
                                            <span style="font-size: 15px;"><?php echo $dep_year->dep_year_number_last; ?></span>                                       
                                            <i style="font-weight: bold; font-size: 16px" class="fa fa-question-circle text-danger" data-toggle="tooltip" data-placement="bottom" title="เลขรันเพื่อไม่ให้เลขเอกสารซ้ำ"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--                            <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">อ้างถึง :</label>
                                                            <div class="col-sm-7">                              
                                                                <input type="text" name="work_info_refer" class="form-control form-control-sm">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">สิ่งที่ส่งมาด้วย :</label>
                                                            <div class="col-sm-7">                              
                                                                <input type="text" name="work_info_other_attach" class="form-control form-control-sm">
                                                            </div>
                                                        </div>-->
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">จาก (ตำแหน่ง) :</label>
                                <div class="col-sm-7"> 
                                    <select name="work_info_from_position" class="form-control form-control-sm">
                                        <option value=""></option>
                                        <?php foreach ($this->within_model->ref_position()->result() as $position_from) { ?>
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
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">ถึง (ตำแหน่ง) :</label>
                                <div class="col-sm-7"> 
                                    <select name="work_info_to_position" class="form-control form-control-sm">
                                        <option value=""></option>
                                        <?php foreach ($this->within_model->ref_position()->result() as $position_to) { ?>
                                            <option value="<?php echo $position_to->position_name; ?>"><?php echo $position_to->position_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">ถึง (หน่วยงาน) :</label>
                                <div class="col-sm-7">                              
                                    <input type="text" name="work_info_to" id="work_info_to" class="form-control form-control-sm">
                                </div>
                                <div class="col-sm-1">                              
                                    <button type="button" class="btn btn-sm btn-outline-success btn-rounded" onclick="modal_to();"><i class="fa fa-search-plus"></i></button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">เรื่อง :</label>
                                <div class="col-sm-7">                              
                                    <textarea type="text" name="work_info_subject" class="form-control form-control-sm"></textarea>
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
                                        <?php foreach ($this->within_model->ref_priority_info()->result() as $priority_info) { ?>
                                            <option value="<?php echo $priority_info->priority_info_id; ?>"><?php echo $priority_info->priority_info_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">ชั้นความลับ :</label>
                                <div class="col-sm-7">                              
                                    <select name="secret_level_id" class="form-control form-control-sm">
                                        <?php foreach ($this->within_model->ref_secret_level()->result() as $secret_level) { ?>
                                            <option value="<?php echo $secret_level->secret_level_id; ?>"><?php echo $secret_level->secret_level_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">หมวดเอกสาร :</label>
                                <div class="col-sm-7">                              
                                    <select name="book_group_id" class="form-control form-control-sm">
                                        <?php foreach ($this->within_model->ref_book_group()->result() as $book_group) { ?>
                                            <option value="<?php echo $book_group->book_group_id; ?>"><?php echo $book_group->book_group_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">วัตถุประสงค์ :</label>
                                <div class="col-sm-7">                              
                                    <select name="action_info_id" class="form-control form-control-sm">
                                        <?php foreach ($this->within_model->ref_action_info()->result() as $action_info) { ?>
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
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;"></label>
                                <div class="col-sm-7">                              
                                    <input name="work_info_follow" id="work_info_follow" type="checkbox" value="1" class="filled-in chk-col-orange">
                                    <label for="work_info_follow">&nbsp; ติดตามผลการทำงาน</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">ต้นฉบับ :</label>
                                <div class="col-sm-7">  
                                    <div class="m-b-10">
                                        <label class="custom-control custom-radio">
                                            <input name="attach_original" id="radio1" type="radio" value="0" checked="checked" class="custom-control-input" required="">
                                            <span class="custom-control-label">&nbsp; ไม่ส่งต้นฉบับ</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input name="attach_original" id="radio2" type="radio" value="1" class="custom-control-input" required="">
                                            <span class="custom-control-label">&nbsp; ส่งต้นฉบับ</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <!--                    <hr/>
                                        <div class="form-group row">
                                            <div class="col-sm-1 text-center"></div>
                                            <div class="col-sm-5"> 
                                                       <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">วิธีการรับ-ส่งเอกสาร :</label>
                                                            <div class="col-sm-7">                              
                                                                <select name="doc_type_id" class="form-control form-control-sm">
                    <?php //foreach ($this->within_model->ref_doc_type()->result() as $doc_type) {?>
                                                                            <option value="<?php //echo $doc_type->doc_type_id;?>"><?php //echo $doc_type->doc_type_name;?></option>
                    <?php //}?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">ที่เก็บเอกสาร :</label>
                                                    <div class="col-sm-7">                              
                                                        <input type="text" name="work_info_store" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">ผู้ลงนาม:</label>
                                                    <div class="col-sm-7"> 
                                                        <input type="text" name="internal_action_name" id="internal_action_name" class="form-control form-control-sm" disabled="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-1 text-center"></div>
                                            <div class="col-sm-5"> 
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">อายุเอกสาร :</label>
                                                    <div class="col-sm-7">                              
                                                        <div class="input-group">
                                                            <input type="text" name="work_info_expire_input" id="work_info_expire_input" onchange="date_convert('work_info_expire_input', 'work_info_expire')"  class="form-control form-control-sm mydatepicker">
                                                            <input type="hidden" id="work_info_expire" name="work_info_expire" class="form-control form-control-sm">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="fa fa-calendar-times-o"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;" style="font-weight: bold;font-size: 14px;">ดำเนินการแล้วเสร็จภายในวันที่ :</label>
                                                    <div class="col-sm-7">
                                                        <div class="input-group">
                                                            <input type="text" name="work_info_complete_input" id="work_info_complete_input" onchange="date_convert('work_info_complete_input', 'work_info_complete')"  class="form-control form-control-sm mydatepicker"/>
                                                            <input type="hidden" id="work_info_complete" name="work_info_complete"  class="form-control form-control-sm">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="fa fa-calendar-check-o"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">การลงนาม :</label>
                                                    <div class="col-sm-7">                              
                                                        <select name="internal_action_id" id="internal_action_id" class="form-control form-control-sm">
                    <?php //foreach ($this->within_model->ref_internal_action()->result() as $internal_action) {?>
                                                                <option value="<?php //echo $internal_action->internal_action_id;?>"><?php //echo $internal_action->internal_action_name;?></option>
                    <?php //}?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->

                    <hr/>
                    <div id="confirm-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"> ยืนยันการลงทะเบียนหนังสือส่งภายใน</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="bootbox-body text-center">
                                        <p class="text-center" style="font-weight: bold;">ยืนยันการลงทะเบียนหนังสือส่งภายใน</p>
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
                            <button type="button" onclick="modal_confirm();" class="btn btn-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
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
