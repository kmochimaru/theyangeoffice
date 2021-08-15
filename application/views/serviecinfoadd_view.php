<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i>&nbsp;<?php echo $title; ?>
                </h4>
                <hr>
                <form id="form-add" class="form-horizontal" method="post" action="<?php echo base_url() . 'serviecinfo/add'; ?>" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-group row">
                        <div class="col-sm-1 text-center"></div>
                        <div class="col-sm-5"> 
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">งานแก้ไขและบริการ :</label>
                                <div class="col-sm-7"> 
                                    <input type="hidden" name="service_id" value="<?php echo $data->service_id; ?>" class="form-control form-control-sm">
                                    <input type="text" name="service_name" value="<?php echo $data->service_name; ?>" class="form-control form-control-sm" readonly="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">ชื่อผู้แจ้งปัญหา :</label>
                                <div class="col-sm-7"> 
                                    <?php $user = $this->serviecinfo_model->get_uesr()->row(); ?>
                                    <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>" class="form-control form-control-sm">
                                    <input type="text" name="service_name" value="<?php echo $user->user_fullname; ?>" class="form-control form-control-sm" readonly="">
                                </div>
                            </div>       
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">หน่วยงานที่สังกัด :</label>
                                <div class="col-sm-7"> 
                                    <?php $dep = $this->serviecinfo_model->getUserDepOff($this->session->userdata('dep_id_pri'))->row(); ?>
                                    <input type="hidden" name="dep_id_pri" value="<?php echo $dep->dep_id_pri; ?>" class="form-control form-control-sm">
                                    <input type="text" name="dep_name" value="<?php echo $dep->dep_name; ?>" class="form-control form-control-sm" readonly="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">สถานที่ซ่อม / ติดต่อกลับได้ที่ :</label>
                                <div class="col-sm-7">                              
                                    <textarea type="text" name="service_info_contacts" class="form-control form-control-sm" rows="3" required=""></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">หมายเลขครุภัณฑ์ / TeamViewer (ถ้ามี) :</label>
                                <div class="col-sm-7">                              
                                    <textarea type="text" name="service_info_comment" class="form-control form-control-sm" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px; margin-bottom: -10px;">ไฟล์ประกอบ :</label>
                                <div class="col-sm-7">
                                    <label for="upload-image-1" class="btn btn-sm btn-inverse">
                                        <i class="fa fa-file"></i> เลือกไฟล์
                                        <input type="file" accept=".pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .txt, .zip, .rar, .jpg, .jpeg, .png, .gif" name="service_info_file_1" onchange="$('#text-image-1').html($('#upload-image-1').val());" id="upload-image-1" style="display: none">
                                        <label id="text-image-1"></label>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;"></label>
                                <div class="col-sm-7">
                                    <label for="upload-image-2" class="btn btn-sm btn-inverse">
                                        <i class="fa fa-file"></i> เลือกไฟล์
                                        <input type="file" accept=".pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .txt, .zip, .rar, .jpg, .jpeg, .png, .gif" name="service_info_file_2" onchange="$('#text-image-2').html($('#upload-image-2').val());" id="upload-image-2" style="display: none">
                                        <label id="text-image-2"></label>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;"></label>
                                <div class="col-sm-7">
                                    <label for="upload-image-3" class="btn btn-sm btn-inverse">
                                        <i class="fa fa-file"></i> เลือกไฟล์
                                        <input type="file" accept=".pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .txt, .zip, .rar, .jpg, .jpeg, .png, .gif" name="service_info_file_3" onchange="$('#text-image-3').html($('#upload-image-3').val());" id="upload-image-3" style="display: none">
                                        <label id="text-image-3"></label>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;"></label>
                                <div class="col-sm-7">
                                    <label for="upload-image-4" class="btn btn-sm btn-inverse">
                                        <i class="fa fa-file"></i> เลือกไฟล์
                                        <input type="file" accept=".pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .txt, .zip, .rar, .jpg, .jpeg, .png, .gif" name="service_info_file_4" onchange="$('#text-image-4').html($('#upload-image-4').val());" id="upload-image-4" style="display: none">
                                        <label id="text-image-4"></label>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;"></label>
                                <div class="col-sm-7">
                                    <label for="upload-image-5" class="btn btn-sm btn-inverse">
                                        <i class="fa fa-file"></i> เลือกไฟล์
                                        <input type="file" accept=".pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .txt, .zip, .rar, .jpg, .jpeg, .png, .gif" name="service_info_file_5" onchange="$('#text-image-5').html($('#upload-image-5').val());" id="upload-image-5" style="display: none">
                                        <label id="text-image-5"></label>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1 text-center"></div>
                        <div class="col-sm-5"> 
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">ลงวันที่ :</label>
                                <div class="col-sm-7"> 
                                    <div class="input-group"> 
                                        <input type="text" name="work_info_date_input" id="work_info_date_input" value="<?php echo $this->misc->offsetyear(date('Y-m-d'), 543); ?>" readonly="" onchange="date_convert('work_info_date_input', 'work_info_date')"  class="form-control form-control-sm mydatepicker" required=""/>
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
                                        <?php foreach ($this->serviecinfo_model->ref_priority_info()->result() as $priority_info) { ?>
                                            <option value="<?php echo $priority_info->priority_info_id; ?>"><?php echo $priority_info->priority_info_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">ปัญหาที่พบ :</label>
                                <div class="col-sm-7"> 
                                    <input type="text" name="service_info_suject" class="form-control form-control-sm" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="font-weight: bold;font-size: 14px;">รายละเอียด :</label>
                                <div class="col-sm-7">                              
                                    <textarea type="text" name="service_info_detail" class="form-control form-control-sm" rows="6"></textarea>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <div class="col-sm-1 text-center"></div>
                        <div class="col-sm-10">
                            <div id="result_page">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-md-12 text-left">
                            <span style="color: #900; font-weight: bold;">** หมายเหตุ :</span><br>
                            <span style="color: #900;">- อัพโหลดไฟล์นามสกุล .pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .txt, .zip, .rar, .jpg, .jpeg, .png, .gif ได้เท่านั้น</span><br>
                            <span style="color: #900;">- อัพโหลดขนาดไฟล์ได้ไม่เกิน 20 MB</span>
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group row">
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-info"><i class="fa fa-save"></i>&nbsp;แจ้งปัญหา</button>
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
        <div class="modal-content"></div>
    </div>
</div>
<div id="result-modal-lg" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
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
</script>
