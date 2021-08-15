<form id="form-modal" method="post" action="<?php echo base_url('documentindexref/edit_store2'); ?>" autocomplete="off">
    <input type="hidden" name="ref_doc_index_store2_id" value="<?php echo $data->ref_doc_index_store2_id; ?>">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-edit"></i> เเก้ไขลักษณะจัดเก็บ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row form-group">
            <div class="col-lg-12">
                <label class="control-label">ชื่อลักษณะจัดเก็บ <span class="text-danger">*</span></label>
                <input type="text" name="ref_doc_index_store1_name" value="<?php echo $this->documentindexref_model->get_ref_doc_index_store1($data->ref_doc_index_store1_id)->row()->ref_doc_index_store1_name ?>" class="form-control form-control-sm" readonly="">
            </div>
            <div class="col-lg-12">
                <label class="control-label">ID <span class="text-danger">*</span></label>
                <input type="text" name="ref_doc_index_store2_code" value="<?php echo $data->ref_doc_index_store2_code; ?>" class="form-control form-control-sm" required="">
            </div>
            <div class="col-lg-12">
                <label class="control-label">ชื่อลักษณะจัดเก็บ (ย่อย)<span class="text-danger">*</span></label>
                <input type="text" name="ref_doc_index_store2_name" value="<?php echo $data->ref_doc_index_store2_name; ?>" class="form-control form-control-sm" required="">
            </div>
        </div>   
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-add-submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>
