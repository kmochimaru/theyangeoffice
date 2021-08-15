<form id="form-modal" method="post" action="<?php echo base_url('user/add_user'); ?>" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มผู้ใช้ระบบ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row form-group">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <img id="user_image_preview" src="<?php echo base_url('assets/upload/user/none.png'); ?>" style="max-height: 170px; border-radius: 3px;">
                        <input type="file" name="user_image" id="user_image" style="display: none;">
                        <br>
                        <label for="user_image" class="m-t-15 btn btn-info btn-xl btn-sm">
                            <i class="fa fa-image"></i> อัพโหลดรูป
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <label class="control-label">หน่วยงานหลัก <span class="text-danger">*</span></label>
                <select name="dep_id_pri" id="dep_id_pri" class="form-control form-control-sm" onchange="selected();">
                    <?php foreach ($this->user_model->get_department()->result() as $dep) { ?>
                        <option value="<?php echo $dep->dep_id_pri; ?>"><?php echo $dep->dep_name; ?></option>
                    <?php } ?>
                </select>
                <label class="control-label m-t-15">ตำแหน่งหลัก <span class="text-danger">*</span></label>
                <select name="officer_id" id="officer_id" class="form-control form-control-sm">

                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">Username <span class="text-danger">*</span></label>
                <input type="text" id="username" name="username" class="form-control form-control-sm" onblur="check_username()" placeholder="Username" required="">
            </div>
            <div class="col-lg-6">
                <label class="control-label">รหัสผ่าน <span class="text-danger">*</span></label>
                <input type="text" name="password" class="form-control form-control-sm" autocomplete="new-password" placeholder="รหัสผ่าน 8 ตัวอักษร ขึ้นไป" required="">
            </div>
        </div>
        <div class="row form-group">            
            <div class="col-lg-6">
                <label class="control-label">ชื่อผู้ใช้งาน <span class="text-danger">*</span></label>
                <input type="text" name="user_fullname" class="form-control form-control-sm" required="">
            </div>
            <div class="col-lg-6">
                <label class="control-label">Email <span class="text-danger">*</span></label>
                <input type="email" name="user_email" class="form-control form-control-sm" placeholder="name@mail.com" required="">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">สิทธิ์ผู้ใช้งานระบบ <span class="text-danger">*</span></label>
                <select name="role_id" class="form-control form-control-sm">
                    <?php foreach ($this->user_model->get_role()->result() as $row) { ?>
                        <option value="<?php echo $row->role_id; ?>"><?php echo $row->role_name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row form-group">           
            <div class="col-lg-6">
                <label class="control-label">เบอร์โทร </label>
                <input type="text" id="user_tel" name="user_tel" class="form-control form-control-sm">
                                
            </div>
            <div class="col-lg-6">
                <label class="control-label">ที่อยู่</label>
                <textarea name="user_address" class="form-control form-control-sm" rows="2"></textarea>
            </div>
        </div>
        <div class="row form-group">           
            <div class="col-lg-6">       
                <label class="control-label">กำหนดวันที่หมดอายุ</label>
                <input type="text" name="user_expire_input" id="user_expire_input" value="" onchange="date_convert('user_expire_input', 'user_expire')" class="form-control form-control-sm mydatepicker" />
                <input type="hidden" name="user_expire" id="user_expire" value="" class="form-control form-control-sm">
            </div>
            <div class="col-lg-6"></div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-add-submit" class="btn btn-info" disabled=""><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>

<script>

    $(function () {
        selected();
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
    
    function check_username() {
        if ($('#username').val() != '') {
            $.ajax({
                url: service_base_url + 'user/check_username',
                method: 'POST',
                data: {
                    username: $('#username').val()
                },
                success: function (response) {
                    if (response == 1) {
                        $('#btn-add-submit').prop('disabled', true);
                        notification('error', 'เกิดข้อผิดพลาด', 'ไม่สามารถใช้ Username นี้ได้', 5000);
                    } else {
                        $('#btn-add-submit').prop('disabled', false);
                        notification('success', 'ทำรายการเรียบร้อย', 'สามารถใช้ Username นี้ได้', 5000);
                    }
                }
            });
        } else {
            $('#btn-add-submit').prop('disabled', true);
        }
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#user_image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#user_image').change(function () {
        readURL(this);
    });


    function selected() {
        dep_id_pri = $('#dep_id_pri').val();
        officer_tag = $('#officer_id');
        officer_tag.find('option').remove();
        $.ajax({
            url: service_base_url + 'user/selected_officer',
            type: 'POST',
            dataType: 'json',
            data: {
                dep_id_pri: dep_id_pri
            },
            success: function (response) {
                count_row = response.officer_id.length;
                for (i = 0; i < count_row; i++) {
                    officer_id = response.officer_id[i];
                    officer_name = response.officer_name[i];
                    officer_tag.append($("<option></option>").attr("value", officer_id).text(officer_name));
                }
            }
        });
    }
</script>