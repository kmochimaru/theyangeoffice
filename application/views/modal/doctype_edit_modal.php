<form id="form-modal" method="post" action="<?php echo base_url('doctype/edit'); ?>" autocomplete="off">
    <input type="hidden" name="doc_type_id" value="<?php echo $data->doc_type_id;?>">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-edit"></i> เเก้ไขวิธีการรับ-ส่ง</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row form-group">
            <div class="col-lg-12">
                <label class="control-label">ชื่อ <span class="text-danger">*</span></label>
                <input type="text" name="doc_type_name" value="<?php echo $data->doc_type_name;?>" class="form-control form-control-sm" required="">
            </div>
        </div>   
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-add-submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>
