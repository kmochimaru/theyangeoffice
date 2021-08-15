<form id="form-modal" method="post" action="<?php echo base_url('documentindexref/add_store2'); ?>" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มข้อมูลลักษณะจัดเก็บ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label">ชื่อลักษณะจัดเก็บ <span class="text-danger">*</span></label>
            <input type="text" name="ref_doc_index_store1_name" value="<?php echo $data->ref_doc_index_store1_name ?>" class="form-control form-control-sm" readonly="">
            <input type="hidden" name="ref_doc_index_store1_id" value="<?php echo $data->ref_doc_index_store1_id ?>" class="form-control form-control-sm" readonly="">
        </div>
        <div class="form-group">
            <label class="control-label">ID <span class="text-danger">*</span></label>
            <input type="text" name="ref_doc_index_store2_code" class="form-control form-control-sm" required="">
        </div>
        <div class="form-group">
            <label class="control-label">ชื่อลักษณะจัดเก็บ (ย่อย)<span class="text-danger">*</span></label>
            <input type="text" name="ref_doc_index_store2_name" class="form-control form-control-sm" required="">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-add-submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>