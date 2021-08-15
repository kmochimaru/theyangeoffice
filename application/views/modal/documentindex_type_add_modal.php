<form id="form-modal" method="post" action="<?php echo base_url('documentindexref/add_type'); ?>" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มข้อมูลประเภทเอกสาร</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label">ประเภทเอกสาร <span class="text-danger">*</span></label>
            <input type="text" name="ref_doc_index_category_name" value="<?php echo $data->ref_doc_index_category_name ?>" class="form-control form-control-sm" readonly="">
            <input type="hidden" name="ref_doc_index_category_id" value="<?php echo $data->ref_doc_index_category_id ?>" class="form-control form-control-sm" readonly="">
        </div>
        <div class="form-group">
            <label class="control-label">ID (ย่อย) <span class="text-danger">*</span></label>
            <input type="text" name="ref_doc_index_type_code" class="form-control form-control-sm" required="">
        </div>
        <div class="form-group">
            <label class="control-label">ชื่อประเภทเอกสาร (ย่อย) <span class="text-danger">*</span></label>
            <input type="text" name="ref_doc_index_type_name" class="form-control form-control-sm" required="">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-add-submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>