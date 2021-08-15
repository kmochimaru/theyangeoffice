<form method="post" action="<?php echo base_url('postparceltran/delete'); ?>" autocomplete="off">
     <input type="hidden" name="parcel_tran_id" value="<?php echo $data->parcel_tran_id;?>">
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