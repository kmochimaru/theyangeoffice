<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo " " . $icon; ?>"></i> <?php echo " " . $title; ?>
                </h4>              
                <div class="row m-t-20">
                    <div class="col-sm-3">
                        <label class="control-label" style="font-weight: bold;">หน่วยงาน</label>
                        <select name="dep_id_pri" id="dep_id_pri" class="select2 form-control custom-select" style="width: 100%;" data-placeholder="หน่วยงานทั้งหมด" onchange="ajax_page()">
                            <option value=""></option>
                            <?php
                            foreach ($this->notify_model->get_department()->result() as $row) {
                                ?>
                                <option value="<?php echo $row->dep_id_pri; ?>"><?php echo $row->dep_name . ' ( ' . $row->dep_name_short . ' ) '; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label" style="font-weight: bold;">สิทธิ์</label>
                        <select id="role_id" class="form-control form-control-sm" data-placeholder="ทั้งหมด" onchange="ajax_page()">
                            <option value="0">ทั้งหมด</option>
                            <?php foreach ($this->notify_model->get_role()->result() as $role) { ?>
                                <option value="<?php echo $role->role_id; ?>"><?php echo $role->role_name; ?></option>
                            <?php } ?>
                        </select> 
                    </div>
                    <div class="col-lg-3">
                        <label class="control-label" style="font-weight: bold;">ค้นหา</label>
                        <div class="input-group">
                            <input type="text" id="searchtext" class="form-control form-control-sm" placeholder="คำค้นหา">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-sm btn-info" onclick="ajax_page()">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="form-horizontal" id="form_add" method="post" action="<?php echo base_url() . 'notify/add'; ?>" autocomplete="off" enctype="multipart/form-data">
                    <div class="row m-t-30">
                        <label class="col-sm-2 text-right control-label col-form-label" style="font-weight: bold;">ข้อความ : </label>
                        <div class="col-sm-6">
                            <textarea type="text" name="notify_message" id="notify_message" rows="8" class="form-control form-control-sm" required></textarea>  
                        </div>
                        <label class="col-sm-1 text-right control-label col-form-label" style="font-weight: bold;">รูปภาพ : </label>
                        <div class="col-sm-3">
                            <div class="row">
                                <div class="col-sm-12  text-center">
                                    <img id="img_preview" src="<?php echo base_url('assets/upload/line/none.png'); ?>" style="max-height: 150px; border-radius: 3px;">
                                    <input type="file" name="notify_image" id="notify_image" accept="image/png,image/jpeg,image/jpg" style="display: none;">
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-sm-12  text-center">
                                    <label for="notify_image" class="m-t-15 btn btn-info btn-xl btn-sm" style="margin-top: 12px; margin-bottom: 0px;">
                                        <i class="fa fa-image"></i> อัพโหลดรูปภาพ
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modal_send_line">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><i class="fa fa-check-circle-o"></i>&nbsp;ยืนยันการบันทึกประกาศแจ้งเตือน</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="bootbox-body text-center">
                                            <p class="text-center" style="font-weight: bold;">ยืนยันการบันทึกประกาศแจ้งเตือน LINE Notify</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="btn-modal-submit-line" class="btn btn-info" onclick="submit_form_line()"><span id="btn-modal-submit-loading-line" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>&nbsp;บันทึก</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 m-t-20 m-b-10 text-center">
                            <button type="button" class="btn btn-info" onclick="modal_send_line()"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                            <button type="reset" class="btn btn-default" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        </div>
                    </div>
                    <hr/>
                    <div id="result-page" class="m-t-20"></div>
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

    var service_base_url = $('#service_base_url').val();

    $(function () {
        ajax_page();
        $(".select2").select2();
    });

    $('#searchtext').keypress(function (e) {
        if (e.which == 13) {
            ajax_page();
        }
    });

    function ajax_page() {
        $('#result-page').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'notify/ajax_page',
            type: 'POST',
            data: {
                dep_id_pri: $('#dep_id_pri').val(),
                role_id: $('#role_id').val(),
                searchtext: $('#searchtext').val(),
            },
            success: function (response) {
                $('#result-page').html(response);
            }
        });
    }

    function modal_send_line() {
        if ($('#form_add').parsley().validate() === true) {
            $('#modal_send_line').modal('show', {backdrop: 'true'});
        }
    }

    function submit_form_line() {
        $('#btn-modal-submit-line').prop('disabled', true);
        $('#btn-modal-submit-loading-line').show();
        $('#form_add').submit();
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#notify_image').change(function () {
        readURL(this);
    });
</script>