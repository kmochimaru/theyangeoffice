<form id="form-serial-delete" method="post" autocomplete="false" action="#">
    <div class="modal-header">
        <h4 class="modal-title">ยืนยันประกาศประชาสัมพันธ์เอกสาร</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="bootbox-body text-center">
            <p class="text-center" style="font-weight: bold;">ยืนยันการประกาศประชาสัมพันธ์เอกสารเลขที่ <?php echo $row->work_info_no . $row->work_info_no_2 . $row->work_info_no_3; ?></p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="btn_submit" class="btn btn-info" onclick="regisnumber('<?php echo $row->work_info_id_pri; ?>')"><span id="btn-modal-submit-loading" style="display: none;"><i class="fa fa-spinner fa-spin"></i> </span> ประกาศประชาสัมพันธ์</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"> ยกเลิก</button>
    </div>
</form>