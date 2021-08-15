<form id="form-serial-delete" method="post" autocomplete="false" action="#">
    <div class="modal-header">
        <h4 class="modal-title">ยืนยันส่งต่อตามเส้นทาง</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="bootbox-body text-center">
            <p class="text-center" style="font-weight: bold;">ยืนยันการส่งอกสารเลขที่ <?php echo $row->work_process_no . $row->work_process_no_2. $row->work_process_no_3; ?></p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="btn_submit" class="btn btn-info" onclick="receivesend('<?php echo $work_process_id_pri; ?>')"><span id="btn-modal-submit-loading" style="display: none;"><i class="fa fa-spinner fa-spin"></i> </span> ส่งต่อตามเส้นทาง</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"> ยกเลิก</button>
    </div>
</form>