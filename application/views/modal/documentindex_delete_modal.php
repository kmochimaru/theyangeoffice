<form id="form-modal" method="post" action="#" onsubmit="return false" autocomplete="off">
    <input type="hidden" id="doc_index_id" name="doc_index_id" value="<?php echo $data->doc_index_id; ?>">
    <div class="modal-header">
        <h4 class="modal-title">ยืนยันการลบข้อมูล</h4>
    </div>
    <div class="modal-body">
        <div class="bootbox-body text-danger">
            <b><i class="fa fa-exclamation-triangle"></i> ยืนยันการลบข้อมูลนี้ โปรดระบุ Password</b>
            <input type="password" id="pass" name="pass" class="form-control form-control-sm m-t-10" autocomplete="new-password" required="" placeholder="Password" >
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="btn-form-modal" class="btn btn-danger"><i id="fa-form-modal" class="fa fa-check"></i> ตกลง</button>
        <button type="button" class="btn btn-inverse" data-dismiss="modal"><i class="fa fa-times"></i> ยกเลิก</button>
    </div>
</form>
<script>

    $('#form-modal').parsley()

    $('#btn-form-modal').click(function () {
        if ($('#form-modal').parsley().validate() === true) {
            $('#fa-form-modal').removeClass('fa-check').addClass('fa-spinner fa-spin')
            $('#btn-form-modal').prop('disabled', true)
            $.ajax({
                url: service_base_url + 'documentindex/delete',
                type: 'POST',
                data: $('#form-modal').serialize(),
                dataType: 'JSON',
                success: function (res) {
                    $('#result-modal').modal('hide');
                    if (res == 1) {
                        setTimeout(function () {
                            reloadPagination();
                            notification('success', 'ทำรายการเรียบร้อย', 'ลบข้อมูลสำเร็จ');
                        }, 500);
                    } else {
                        notification('error', 'เกิดข้อผิดผลาด', 'ไม่สามารถลบข้อมูลได้');
                        reloadPagination();
                    }
                }
            })
        }
    })

</script>