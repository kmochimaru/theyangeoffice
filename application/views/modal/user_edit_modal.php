<form id="form-modal" method="post" action="<?php echo base_url('user/edit_user'); ?>" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="user_id" value="<?php echo $data->user_id; ?>">
    <input type="hidden" name="user_image_current" value="<?php echo $data->user_image; ?>">
    <input type="hidden" name="user_signature_path_current" value="<?php // echo $data->user_signature_path;   ?>">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-edit"></i> แก้ไขผู้ใช้ระบบ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row form-group">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <img id="user_image_preview" src="<?php echo base_url('assets/upload/user/' . $data->user_image); ?>" style="max-height: 170px; border-radius: 3px;">
                        <input type="file" name="user_image" id="user_image" style="display: none;">
                        <br>
                        <label for="user_image" class="m-t-15 btn btn-info btn-xl btn-sm">
                            <i class="fa fa-image"></i> อัพโหลดรูป
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" value="<?php echo $data->username; ?>" readonly="" required="">
            </div>
        </div>        
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">ชื่อผู้ใช้งาน <span class="text-danger">*</span></label>
                <input type="text" name="user_fullname" class="form-control form-control-sm" value="<?php echo $data->user_fullname; ?>" required="">
            </div>
            <div class="col-lg-6">
                <label class="control-label">อีเมล <span class="text-danger">*</span></label>
                <input type="email" name="user_email" class="form-control form-control-sm" value="<?php echo $data->user_email; ?>" required="">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">สิทธิ์ผู้ใช้งานระบบ <span class="text-danger">*</span></label>
                <select name="role_id" class="form-control form-control-sm">
                    <?php
                    foreach ($this->user_model->get_role()->result() as $row) {
                        ?>                    
                        <option value="<?php echo $row->role_id; ?>" <?php echo $data->role_id == $row->role_id ? 'selected' : ''; ?>><?php echo $row->role_name; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">เบอร์โทร </label>
                <input type="text" name="user_tel" class="form-control form-control-sm" value="<?php echo $data->user_tel; ?>">
            </div>
            <div class="col-lg-6">
                <label class="control-label">ที่อยู่</label>
                <textarea name="user_address" class="form-control form-control-sm" rows="2"><?php echo $data->user_address; ?></textarea>
            </div>
        </div>
        <div class="row form-group">           
            <div class="col-lg-6">       
                <label class="control-label">กำหนดวันที่หมดอายุ</label>
                <input type="text" name="user_expire_input" id="user_expire_input" value="<?php echo ($data->user_expire != '' ? $this->misc->offsetyear($data->user_expire, 543) : ''); ?>" onchange="date_convert('user_expire_input', 'user_expire')" class="form-control form-control-sm mydatepicker" />
                <input type="hidden" name="user_expire" id="user_expire" value="<?php echo $data->user_expire; ?>" class="form-control form-control-sm">
            </div>
            <div class="col-lg-6"></div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-edit-submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>

<script>

    $(function () {
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

    function readURLTo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#user_signature_path_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#user_signature_path').change(function () {
        readURLTo(this);
    });

</script>