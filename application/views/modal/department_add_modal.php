<?php
$org = $this->department_model->getOrganization($org_id_pri)->row();
?>
<form id="form_department" method="post" onsubmit="return adddepartment();" autocomplete="false">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มหน่วยงาน</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row form-group">
            <div class="col-lg-12">
                <label class="control-label">หน่วยงานธุรกิจ <span class="text-danger">*</span></label>
                <input type="text" value="<?php echo $org->org_name; ?>" class="form-control form-control-sm" readonly="">
                <input type="hidden" name="org_id_pri" id="org_id_pri" value="<?php echo $org_id_pri; ?>" class="form-control form-control-sm" required="">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">รหัสหน่วยงาน <span class="text-danger">*</span></label>
                <input type="text" name="dep_id" id="dep_id" class="form-control form-control-sm" required="">
            </div>
            <div class="col-lg-6">
                <label class="control-label">ชื่อย่อหน่วยงาน <span class="text-danger">*</span></label>
                <input type="text" name="dep_name_short" id="dep_name_short" class="form-control form-control-sm" required="">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-12">
                <label class="control-label">ชื่อหน่วยงาน <span class="text-danger">*</span></label>
                <input type="text" name="dep_name" id="dep_name" class="form-control form-control-sm" required="">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-12">
                <label class="control-label">ลักษณะหน่วยงาน <span class="text-danger">*</span></label>
                <input type="text" name="dep_description" id="dep_description" class="form-control form-control-sm" required="">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-12">
                <label class="control-label">เบอ์โทรติดต่อ <span class="text-danger">*</span></label>
                <input type="text" name="dep_tel" id="dep_tel" class="form-control form-control-sm" required="">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">รหัสนำหน้าหนังสือส่งภายใน <span class="text-danger">*</span></label>
                <input type="text" name="dep_prefix_within" id="dep_prefix_within" class="form-control form-control-sm" required="">
            </div>
            <div class="col-lg-6">
                <label class="control-label">รหัสนำหน้าหนังสือส่งภายนอก <span class="text-danger">*</span></label>
                <input type="text" name="dep_prefix_without" id="dep_prefix_without" class="form-control form-control-sm" required="">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6">

            </div>
            <div class="col-lg-6">                              
                <input name="dep_without_active_id" id="dep_without_active_id" type="checkbox" value="1" class="filled-in chk-col-red">
                <label for="dep_without_active_id">&nbsp; อนุญาติให้ส่งหนังสือภายนอก</label>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-12">
                <label class="control-label">สถานที่ตั้ง <span class="text-danger">*</span></label>
                <select name="place_id" id="place_id"  class="form-control form-control-sm">
                    <?php foreach ($this->department_model->getPlace()->result() as $place) { ?>
                        <option value="<?php echo $place->place_id; ?>"><?php echo $place->place_name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-add-submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>

<script>
    function adddepartment() {
        var active = 0;
        if ($('#dep_without_active_id').is(':checked')) {
            active = 1;
        }
        var form = $("#form_department");
        form.parsley().validate();
        if (form.parsley().isValid() == true) {
            $('#result-page').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
            $('#result-modal').modal('hide');
            $.ajax({
                url: service_base_url + 'department/adddepartment',
                method: "POST",
                data: {
                    dep_id: $('#dep_id').val(),
                    dep_name: $('#dep_name').val(),
                    dep_name_short: $('#dep_name_short').val(),
                    dep_description: $('#dep_description').val(),
                    dep_tel: $('#dep_tel').val(),
                    dep_prefix_within: $('#dep_prefix_within').val(),
                    dep_prefix_without: $('#dep_prefix_without').val(),
                    dep_without_active_id: active,
                    org_id_pri: $('#org_id_pri').val(),
                    place_id: $('#place_id').val(),
                    dep_id_mother: $('#dep_id_mother').val(),
                },
                success: function (response)
                {
                    if (response == true) {
                        notification('success', 'Success', 'เพิ่มข้อมูลเรียบร้อยเเล้ว');
                        data();
                    } else {
                        notification('error', 'Error', 'เกิดข้อผิดพลาด');
                    }
                }
            });
        }
        return false;
    }
</script>
