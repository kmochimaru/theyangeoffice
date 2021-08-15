<form id="form-modal" method="post" action="<?php echo base_url('documentindexref/edit_year'); ?>" autocomplete="off">
    <input type="hidden" name="ref_doc_index_year_id" value="<?php echo $data->ref_doc_index_year_id; ?>">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-edit"></i> เเก้ไขปีงบประมาณ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row form-group">
            <div class="col-lg-12">
                <label class="control-label">ID <span class="text-danger">*</span></label>
                <input type="text" name="ref_doc_index_year_code" value="<?php echo $data->ref_doc_index_year_code; ?>" class="form-control form-control-sm" required="">
            </div>
            <div class="col-lg-12">
                <label class="control-label">ปีงบประมาณ <span class="text-danger">*</span></label>
                <input type="text" name="ref_doc_index_year_name" value="<?php echo $data->ref_doc_index_year_name; ?>" class="form-control form-control-sm" required="">
            </div>
        </div>   
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-add-submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>
