<form method="post" action="<?php echo base_url('servicegroup/deleteuserhelpdesk'); ?>" autocomplete="off">
    <input type="hidden" name="help_desk_id" value="<?php echo $help_desk_id; ?>">
    <input type="hidden" name="service_group_id" id="service_group_id" value="<?php echo $service_group_id ?>" />
    <input type="hidden" name="service_id" id="service_id" value="<?php echo $service_id ?>" />
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-trash"></i> ยืนยันการลบข้อมูลนี้</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="bootbox-body text-center text-danger">
            <b>ต้องการลบข้อมูลนี้ ใช่หรือไม่ ?</b>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-delete-submit" class="btn btn-danger"><i class="fa fa-trash"></i> ตกลง</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>