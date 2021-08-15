<form method="post" action="<?php echo base_url('department/status_dep_off'); ?>" autocomplete="off">
    <input type="hidden" name="dep_off_id" value="<?php echo $data->dep_off_id; ?>">
    <input type="hidden" name="dep_off_status_id" value="<?php echo $data->dep_off_status_id == 1 ? 2 : 1; ?>">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-close"></i> <?php echo $data->dep_off_status_id == 1 ? 'ยืนยันการระงับ' : 'ยืนยันยกเลิกการระงับ'; ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="bootbox-body text-center text-danger">
            <b><?php echo $data->dep_off_status_id == 1 ? 'ยืนยันการระงับ' : 'ยืนยันยกเลิกการระงับ'; ?> ใช่หรือไม่ ?</b>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-status-submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>