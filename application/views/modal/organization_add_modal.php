<form id="form-modal" method="post" action="<?php echo base_url('organization/add_organization'); ?>" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มข้อมูล</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label">รหัส <span class="text-danger">*</span></label>
            <input type="text" name="org_id" class="form-control form-control-sm" required="">
        </div>
        <div class="form-group">
            <label class="control-label">ชื่อ <span class="text-danger">*</span></label>
            <input type="text" name="org_name" class="form-control form-control-sm" required="">
        </div>
        <div class="form-group">
            <label class="control-label">ชื่อย่อ <span class="text-danger">*</span></label>
            <input type="text" name="org_name_short" class="form-control form-control-sm" required="">
        </div>
        <div class="form-group">
            <label class="control-label">หมายเลข <span class="text-danger">*</span></label>
            <input type="text" name="org_number" class="form-control form-control-sm" required="">
        </div>
        <div class="form-group">
            <label class="control-label">คำนำหน้า <span class="text-danger">*</span></label>
            <input type="text" name="org_prefix" class="form-control form-control-sm" required="">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-add-submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>