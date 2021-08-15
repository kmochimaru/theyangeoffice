<form id="form-modal" method="post" action="<?php echo base_url('userdep/edit_userdep'); ?>" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="user_id" value="<?php echo $data->user_id; ?>">
    <input type="hidden" name="user_image_current" value="<?php echo $data->user_image; ?>">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-edit"></i> แก้ไขผู้ใช้ระบบ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row form-group p-b-30">
            <div class="col-lg-12 text-center">
                <img id="user_image_preview" src="<?php echo base_url('assets/upload/user/' . $data->user_image); ?>" style="max-height: 170px; border-radius: 3px;">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" value="<?php echo $data->username; ?>" readonly="">
            </div>
            <div class="col-lg-6">
                <label class="control-label">สิทธิ์ <span class="text-danger">*</span></label>
                <?php
                if ($data->role_id < 7) {
                    ?>
                    <select name="role_id" class="form-control form-control-sm">
                        <?php
                        foreach ($this->userdep_model->get_role_edit()->result() as $row) {
                            ?>                    
                            <option value="<?php echo $row->role_id; ?>" <?php echo $data->role_id == $row->role_id ? 'selected' : ''; ?>><?php echo $row->role_name; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                <?php } else { ?>
                    <input type="text" class="form-control form-control-sm" value="<?php echo $data->role_name; ?>" readonly="">
                    <input type="hidden" name="role_id" value="<?php echo $data->role_id; ?>" required="">
                <?php } ?>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">ชื่อผู้ใช้งาน <span class="text-danger">*</span></label>
                <input type="text" name="user_fullname" class="form-control form-control-sm" value="<?php echo $data->user_fullname; ?>" required="">
            </div>
            <div class="col-lg-6">
                <label class="control-label">อีเมล <span class="text-danger">*</span></label>
                <input class="form-control form-control-sm" value="<?php echo $data->user_email; ?>" readonly="">
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
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-edit-submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>

<script>

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