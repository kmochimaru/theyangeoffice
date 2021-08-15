<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;รหัส PIN</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="bootbox-body">
        <form class="form-horizontal" id="formeditpin" method="post" onsubmit="return editPin();" autocomplete="off">
            <input type="hidden" name="username" id="username" value="<?php echo $username; ?>" class="form-control form-control-sm" readonly="">
            <div class="form-group row">
                <label class="col-sm-4 text-right control-label col-form-label"> Password : <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="password" autocomplete="new-password" name="password" id="password" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกข้อมูล" required>
                </div>
            </div>
            <p class="text-right text-danger col-sm-11" id="statuspin"></p>
            <div class="form-group row">
                <label class="col-sm-4 text-right control-label col-form-label">รหัส PIN 6 หลัก : <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="password" name="newpin" id="newpin" pattern="[0-9]{6}" maxlength="6" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกรหัส PIN ตัวเลข 6 หลัก" required>
                </div>
            </div>
            <p class="text-right text-danger col-sm-11" id="statusconfirmpin"></p>
            <div class="form-group row">
                <label class="col-sm-4 text-right control-label col-form-label"> ยืนยัน PIN 6 หลัก : <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="password" name="confirmpin" id="confirmpin" pattern="[0-9]{6}" maxlength="6" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกรหัส PIN ตัวเลข 6 หลัก" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="button" id="btn-form-modal" class="btn btn-info waves-effect waves-light"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                    &nbsp;
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('#formeditpin').parsley()

    $('#btn-form-modal').click(function() {
        if ($('#formeditpin').parsley().validate() === true) {
            if ($("password").val() != '') {
                if ($("#newpin").val() != '') {
                    if ($("#confirmpin").val() != '') {
                        url = service_base_url + 'profile/editpin';
                        $.ajax({
                            url: url,
                            method: "POST",
                            data: {
                                username: $('#username').val(),
                                password: $('#password').val(),
                                newpin: $('#newpin').val(),
                                confirmpin: $('#confirmpin').val()
                            },
                            success: function(res) {
                                if (res == 1) {
                                    $('#editpin').modal('hide');
                                    $('#pin_key1').hide();
                                    $('#pin_key2').show();
                                    notification('success', 'Success', 'บันทึกเรียบร้อยเเล้ว');
                                } else if (res == 2) {
                                    $('#statuspin').html('Password ไม่ถูกต้อง');
                                    $('#statusconfirmpin').html('');
                                    $("#newpin").val('');
                                    $("#confirmpin").val('');
                                } else {
                                    $('#statusconfirmpin').html('PIN 6 หลัก ไม่ตรงกัน');
                                    $('#statuspin').html('');
                                    $("#newpin").val('');
                                    $("#confirmpin").val('');
                                }
                            }
                        });
                    }
                }
            }
        }
        return false;
    })
</script>