<form id="form-modal" method="post" onsubmit="return false;" autocomplete="off">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-search-plus"></i> ค้นหาหน่วยงาน</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row form-group">
            <div class="col-lg-12">
                <label class="control-label">ค้นหาหน่วยงาน</label>
                <select name="dep_name_from" id="dep_name_from" class="select2 form-control custom-select" style="width: 100%;" data-placeholder="ค้นหาจากชื่อหรือ ID" required="">
                    <option value=""></option>
                    <?php
                    foreach ($this->within_model->getDepartment()->result() as $row) {
                        ?>
                        <option value="<?php echo $row->dep_name; ?>"><?php echo $row->dep_name . ' ( ' . $row->dep_id . ' ) '; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-info" onclick="addfrom();"><i class="fa fa-save"></i> ตกลง</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>
<script>
    $(function () {
        $(".select2").select2({dropdownParent: $('#form-modal')});
    });
</script>
