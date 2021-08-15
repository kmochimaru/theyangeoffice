<form method="post" action="<?php echo base_url('userdep/status_userdep'); ?>" autocomplete="off">
    <input type="hidden" name="user_dep_off_id" value="<?php echo $data->user_dep_off_id; ?>">
    <input type="hidden" name="user_dep_off_status_id" value="<?php echo $data->user_dep_off_status_id == 1 ? 0 : 1; ?>">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-close"></i> <?php echo $data->user_dep_off_status_id == 1 ? 'ยืนยันการระงับ' : 'ยืนยันยกเลิกการระงับ'; ?>การใช้งานหน่วยงาน</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="bootbox-body text-center text-danger">
            <b><?php echo $data->user_dep_off_status_id == 1 ? 'ยืนยันการระงับ' : 'ยืนยันยกเลิกการระงับ'; ?>การใช้งานหน่วยงาน ใช่หรือไม่ ?</b>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-status-submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>