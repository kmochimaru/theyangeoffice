<form id="form-modal" method="post" action="<?php echo base_url('userdep/add_userdep'); ?>" enctype="multipart/form-data" autocomplete="off">
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
                <input type="text" id="dep_id_name" name="dep_id_name" value="<?php echo $this->userdep_model->get_department($this->session->userdata('dep_id_pri'))->row()->dep_name ?>" class="form-control form-control-sm" readonly="">
                <label class="control-label m-t-15">ตำแหน่งหลัก <span class="text-danger">*</span></label>
                <select name="officer_id" id="officer_id" class="form-control form-control-sm" required="">
                    <?php foreach ($this->userdep_model->getdep_off($this->session->userdata('dep_id_pri'))->result() as $officer) { ?>
                        <option value="<?php echo $officer->officer_id; ?>"><?php echo $officer->officer_name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">Username <span class="text-danger">*</span></label>
                <input type="text" id="username" name="username" class="form-control form-control-sm" onblur="check_username()" required="">
            </div>
            <div class="col-lg-6">
                <label class="control-label">Password <span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control form-control-sm" autocomplete="new-password" required="">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">สิทธิ์ผู้ใช้งานระบบ <span class="text-danger">*</span></label>
                <select name="role_id" class="form-control form-control-sm">
                    <?php foreach ($this->userdep_model->get_role()->result() as $row) { ?>
                        <option value="<?php echo $row->role_id; ?>"><?php echo $row->role_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-lg-6">
                <label class="control-label">ชื่อผู้ใช้งาน <span class="text-danger">*</span></label>
                <input type="text" name="user_fullname" class="form-control form-control-sm" required="">
            </div>
        </div>
        <div class="row form-group">

            <div class="col-lg-6">
                <label class="control-label">อีเมล <span class="text-danger">*</span></label>
                <input type="email" name="user_email" class="form-control form-control-sm" required="">
            </div>
            <div class="col-lg-6">
                <label class="control-label">เบอร์โทร </label>
                <input type="text" id="user_tel" name="user_tel" class="form-control form-control-sm">
            </div>
        </div>        
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">ที่อยู่</label>
                <textarea name="user_address" class="form-control form-control-sm" rows="2"></textarea>
            </div>
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
    });

    function check_username() {
        if ($('#username').val() != '') {
            $.ajax({
                url: service_base_url + 'userdep/check_username',
                method: 'POST',
                data: {
                    username: $('#username').val()
                },
                success: function (response) {
                    if (response == 1) {
                        $('#btn-add-submit').prop('disabled', true);
                        notification('error', 'เกิดข้อผิดพลาด', 'ไม่สามารถใช้ Username/เบอร์โทร นี้ได้', 5000);
                    } else {
                        $('#btn-add-submit').prop('disabled', false);
                        notification('success', 'ทำรายการเรียบร้อย', 'สามารถใช้ Username/เบอร์โทร นี้ได้', 5000);
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
</script>