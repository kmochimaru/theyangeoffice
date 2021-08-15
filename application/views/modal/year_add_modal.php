<form id="form-modal" method="post" action="<?php echo base_url('year/add_year'); ?>" autocomplete="off">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มปีงานสารบรรณ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">ปีงานสารบรรณ <span class="text-danger">*</span></label>
                <input type="text" name="year" class="form-control form-control-sm" required="">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">ปี พศ. <span class="text-danger">*</span></label>
                <input type="text" name="year_th" class="form-control form-control-sm" required="">
            </div>
            <div class="col-lg-6">
                <label class="control-label">ปี คศ. <span class="text-danger">*</span></label>
                <input type="text" name="year_en" class="form-control form-control-sm" required="">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">วันที่เริ่ม <span class="text-danger">*</span></label>
                <input type="text" name="year_start_input" id="year_start_input" value="<?php echo $this->misc->offsetyear(date('Y-m-d'), 543); ?>" onchange="date_convert('year_start_input', 'year_start')" class="form-control form-control-sm mydatepicker" required="" />
                <input type="hidden" name="year_start" id="year_start" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-sm" required="">
            </div>
            <div class="col-lg-6">
                <label class="control-label">วันที่สิ้นสุด <span class="text-danger">*</span></label>
                <input type="text" name="year_end_input" id="year_end_input" value="<?php echo $this->misc->offsetyear(date('Y-m-d'), 543); ?>" onchange="date_convert('year_end_input', 'year_end')" class="form-control form-control-sm mydatepicker" required="" />
                <input type="hidden" name="year_end" id="year_end" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-sm" required="">
            </div>
        </div>        
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-add-submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>

<script>
    $(function() {
        $('.mydatepicker').datepicker({
            language: 'th-th',
            format: 'dd/mm/yyyy',
            autoclose: true
        });
    });

    function date_convert(input_id, output_id) {
        get_date = $('#' + input_id).val();
        if (get_date != '') {
            split_date = get_date.split('/');
            date = (parseInt(split_date[2]) - 543) + '-' + split_date[1] + '-' + split_date[0];
            $('#' + output_id).val(date);
        } else {
            $('#' + output_id).val('');
        }
        $('#' + output_id).change();
    }

</script>
