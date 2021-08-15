<form id="form_cancel_comment_modal" method="post" autocomplete="false" action="#">
    <div class="modal-header">
        <h4 class="modal-title">ยืนยันการยกเลิกเอกสาร</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="bootbox-body text-danger">
            <p class="text-danger" style="font-weight: bold;">ยืนยันการยกเลิกเอกสารเลขที่ <?php echo $row->work_info_no . $row->work_info_no_2 . $row->work_info_no_3; ?></p>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label class="control-label" style="font-weight: bold;font-size: 14px;">หมายเหตุที่ยกเลิก :</label>
                <textarea type="text" name="work_info_comment_changestatus" id="work_info_comment_changestatus" class="form-control form-control-sm" rows="4" required=""></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="btn_submit" class="btn btn-info" onclick="changestatus('<?php echo $row->work_info_id_pri; ?>')"><span id="btn-modal-submit-loading" style="display: none;"><i class="fa fa-spinner fa-spin"></i> </span> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"> ปิด</button>
    </div>
</form>