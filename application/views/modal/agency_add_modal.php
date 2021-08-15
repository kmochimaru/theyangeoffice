<form id="form-modal" method="post" action="<?php echo base_url('agency/add'); ?>" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มข้อมูลหน่วยงานภายนอก</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label">รหัส <span class="text-danger">*</span></label>
            <input type="text" name="agency_id" class="form-control form-control-sm" required="">
        </div>
        <div class="form-group">
            <label class="control-label">ชื่อ <span class="text-danger">*</span></label>
            <input type="text" name="agency_name" class="form-control form-control-sm" required="">
        </div>
        <div class="form-group">
            <label class="control-label">ชื่อย่อ <span class="text-danger">*</span></label>
            <input type="text" name="agency_name_short" class="form-control form-control-sm" required="">
        </div>
        <div class="form-group">
            <label class="control-label">เบอร์โทรศัพท์ <span class="text-danger">*</span></label>
            <input type="text" name="agency_tel" class="form-control form-control-sm" required="">
        </div>
        <div class="form-group">
            <label class="control-label">อีเมล์ <span class="text-danger">*</span></label>
            <input type="email" name="agency_email" class="form-control form-control-sm" required="">
        </div>
        <div class="row form-group">
            <div class="col-lg-12">
                <label class="control-label">สถานะ <span class="text-danger">*</span></label>
                <select name="dep_status_id" id="dep_status_id"  class="form-control form-control-sm">
                    <?php foreach ($this->agency_model->departmentStatus()->result() as $row) { ?>
                        <option value="<?php echo $row->dep_status_id; ?>"><?php echo $row->dep_status_name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">รายละเอียด </label>
            <textarea class="form-control form-control-sm" name="agency_description"></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-add-submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>