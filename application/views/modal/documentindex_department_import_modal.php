<form id="form-modal" method="post" action="<?php echo base_url('documentindexref/import_department'); ?>" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-plus"></i> นำเข้าข้อมูลหน่วยงาน</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label">เลือกไฟล์ข้อมูลหน่วยงาน <span class="text-danger">*</span></label>
            <input type="file" name="file" accept=".csv" class="form-control form-control-sm" required=""/>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-add-submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>