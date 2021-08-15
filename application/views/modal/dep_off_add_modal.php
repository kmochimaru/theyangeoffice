<?php
$dep = $this->department_model->getDepartment($dep_id_pri)->row();
?>
<form id="form_dep_off" method="post" onsubmit="return adddepoff();" autocomplete="false">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มตำแหน่ง</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row form-group">
            <div class="col-lg-12">
                <label class="control-label">ภายใต้หน่วยงาน <span class="text-danger">*</span></label>
                <input type="text" value="<?php echo $dep->dep_name; ?>" class="form-control form-control-sm" readonly="">
            </div>
        </div>
        <input type="hidden" name="dep_id_pri" id="dep_id_pri" value="<?php echo $dep->dep_id_pri ?>" class="form-control form-control-sm" required="">
        <div class="row form-group">
            <div class="col-lg-12">
                <label class="control-label">ตำแหน่ง <span class="text-danger">*</span></label>
                <select name="officer_id" id="officer_id"  class="form-control form-control-sm" required="">
                    <?php
                    foreach ($this->department_model->getOfficer()->result() as $officer) {
                        $dep_offs = $this->department_model->getdep_off($dep->dep_id_pri, $officer->officer_id);
                        if ($dep_offs->num_rows() == 0) {
                            ?>
                            <option value="<?php echo $officer->officer_id; ?>"><?php echo $officer->officer_name; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-add-submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>

<script>
    function adddepoff() {
        var form = $("#form_dep_off");
        form.parsley().validate();
        if (form.parsley().isValid() == true) {
            $('#result-page').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
            $('#result-modal').modal('hide');
            $.ajax({
                url: service_base_url + 'department/adddepoff',
                method: "POST",
                data: {
                    dep_id_pri: $('#dep_id_pri').val(),
                    officer_id: $('#officer_id').val(),
                },
                success: function (response)
                {
                    if (response == true) {
                        notification('success', 'Success', 'เพิ่มข้อมูลเรียบร้อยเเล้ว');
                        data();
                    } else {
                        notification('error', 'Error', 'เกิดข้อผิดพลาด');
                    }
                }
            });
        }
        return false;
    }
</script>
