<div id="logout_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-sign-out"></i> ยืนยันออกจากระบบ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body text-center text-danger">
                    <b>ต้องการออกจากระบบ ใช่หรือไม่ ?</b>
                </div>
            </div>
            <div class="modal-footer">
                <a href="<?php echo base_url() . 'login/logout'; ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> ตกลง</a>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
            </div>
        </div>
    </div>
</div>