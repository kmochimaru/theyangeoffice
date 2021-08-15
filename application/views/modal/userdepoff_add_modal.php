<form id="form-modal" method="post" action="<?php echo base_url('user/add_userdepoff'); ?>" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มตำแหน่งงาน</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row form-group">
            <div class="col-lg-12">
                <label class="control-label">หน่วยงาน <span class="text-danger">*</span></label>
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
                <select name="dep_id_pri" id="dep_id_pri" class="form-control form-control-sm" onchange="selected_depoff();">
                    <?php foreach ($this->user_model->get_department()->result() as $dep) { ?>
                        <option value="<?php echo $dep->dep_id_pri; ?>"><?php echo $dep->dep_name; ?></option>
                    <?php } ?>
                </select>
                <label class="control-label m-t-15">ตำแหน่ง <span class="text-danger">*</span></label>
                <select name="officer_id" id="officer_id" class="form-control form-control-sm" required="">
                    <option value="">-- เลือกตำแหน่ง --</option>
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

    $(function () {
        selected_depoff();
    });

    function selected_depoff() {
        dep_id_pri = $('#dep_id_pri').val();
        user_id = $('#user_id').val();
        officer_tag = $('#officer_id');
        officer_tag.find('option').remove();
        $.ajax({
            url: service_base_url + 'user/selected_depoff',
            type: 'POST',
            dataType: 'json',
            data: {
                dep_id_pri: dep_id_pri,
                user_id: user_id
            },
            success: function (response) {
                count_row = response.officer_id.length;
                officer_tag.append($("<option></option>").attr("value", "").text('-- เลือกตำแหน่ง --'));
                for (i = 0; i < count_row; i++) {
                    officer_id = response.officer_id[i];
                    officer_name = response.officer_name[i];
                    officer_tag.append($("<option></option>").attr("value", officer_id).text(officer_name));
                }
            }
        });
    }
</script>