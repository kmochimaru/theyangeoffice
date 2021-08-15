<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo " " . $icon; ?>"></i> <?php echo " " . $title; ?>
                </h4>  
                <div class="row m-t-20">
                    <div class="col-md-2">
                        <label class="control-label" style="font-weight: bold;">ตัวเลือก</label>
                        <select id="select_type" class="form-control form-control-sm" onchange="ajax_pagination()">
                            <option value="1">นำเข้าพัสดุ</option>
                            <option value="2">ส่งออกพัสดุ</option>
                        </select>
                    </div>
                    <input type="hidden" id="ymd" value="<?php echo date('Y-m-d'); ?>" onchange="ajax_pagination()">
                    <input type="hidden" id="start" value="<?php echo date('Y-m-d'); ?>" onchange="ajax_pagination()">
                    <input type="hidden" id="end" value="<?php echo date('Y-m-d'); ?>" onchange="ajax_pagination()">
                    <input type="hidden" id="min" value="<?php echo $this->reportpostparcel_model->mindate()->row()->mindate; ?>" onchange="ajax_pagination()">
                    <input type="hidden" id="max" value="<?php echo date('Y-m-d'); ?>" onchange="ajax_pagination()">
                    <div class="col-md-2">
                        <label class="control-label" style="font-weight: bold;">เลือกช่วงเวลา</label>
                        <select id="select_time" class="form-control form-control-sm" onchange="set_select_time()">
                            <option value="1">รายวัน</option>
                            <option value="2">รายเดือน</option>
                            <option value="3">รายปี</option>
                            <option value="4">กำหนดเอง</option>
                            <option value="5">ทั้งหมด</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label" style="font-weight: bold;">ตัวเลือกช่วงเวลา</label>
                        <div class="select_control" id="select_1">
                            <input type="text" id="input_select_1" class="form-control form-control-sm" value="<?php echo $this->misc->offsetyear(date('Y-m-d'), 543); ?>" onchange="set_select_time_input()">
                        </div>
                        <div class="select_control" id="select_2">
                            <select id="input_select_2" class="form-control form-control-sm" onchange="set_select_time_input()">
                                <option value="01" <?php echo date('m') == 1 ? 'selected' : '' ?>>มกราคม</option>
                                <option value="02" <?php echo date('m') == 2 ? 'selected' : '' ?>>กุมภาพันธ์</option>
                                <option value="03" <?php echo date('m') == 3 ? 'selected' : '' ?>>มีนาคม</option>
                                <option value="04" <?php echo date('m') == 4 ? 'selected' : '' ?>>เมษายน</option>
                                <option value="05" <?php echo date('m') == 5 ? 'selected' : '' ?>>พฤษภาคม</option>
                                <option value="06" <?php echo date('m') == 6 ? 'selected' : '' ?>>มิถุนายน</option>
                                <option value="07" <?php echo date('m') == 7 ? 'selected' : '' ?>>กรกฎาคม</option>
                                <option value="08" <?php echo date('m') == 8 ? 'selected' : '' ?>>สิงหาคม</option>
                                <option value="09" <?php echo date('m') == 9 ? 'selected' : '' ?>>กันยายน</option>
                                <option value="10" <?php echo date('m') == 10 ? 'selected' : '' ?>>ตุลาคม</option>
                                <option value="11" <?php echo date('m') == 11 ? 'selected' : '' ?>>พฤศจิกายน</option>
                                <option value="12" <?php echo date('m') == 12 ? 'selected' : '' ?>>ธันวาคม</option>
                            </select>
                        </div>
                        <div class="select_control" id="select_3">
                            <select id="input_select_3" class="form-control form-control-sm" onchange="set_select_time_input()">
                                <?php
                                $minyears = $this->reportpostparcel_model->minyear();
                                if ($minyears->row()->minyear != 0) {
                                    $minyear = $minyears->row();
                                    $maxyear = date('Y');
                                    for ($i = $minyear->minyear; $i <= $maxyear; $i++) {
                                        ?>
                                        <option value="<?php echo ($i + 543); ?>" <?php echo date('Y') == $i ? 'selected' : '' ?>><?php echo ($i + 543); ?></option>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <option value="<?php echo (date('Y') + 543); ?>"><?php echo (date('Y') + 543); ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="select_control" id="select_4">
                            <input type="text" class="form-control form-control-sm" value="" disabled>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label" style="font-weight: bold;">เริ่มต้น</label>
                        <input type="text" id="input_start" class="form-control form-control-sm" value="<?php echo $this->misc->offsetyear(date('Y-m-d'), 543); ?>" onchange="date_convert('input_start', 'start')" disabled>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label" style="font-weight: bold;">สิ้นสุด</label>
                        <input type="text" id="input_end" class="form-control form-control-sm" value="<?php echo $this->misc->offsetyear(date('Y-m-d'), 543); ?>" onchange="date_convert('input_end', 'end')" disabled>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label" style="font-weight: bold;">สถานะ</label>
                        <select id="parcel_status_id" class="form-control form-control-sm" onchange="ajax_pagination()">
                            <option value="">ทั้งหมด</option>
                            <?php
                            foreach ($this->reportpostparcel_model->get_ref_parcel_status()->result() as $status) {
                                ?>
                                <option value="<?php echo $status->parcel_status_id; ?>"><?php echo $status->parcel_status_name; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-2">
                        <label class="control-label" style="font-weight: bold;">กลุ่มผู้รับ</label>
                        <select id="parcel_group_id" class="form-control form-control-sm" onchange="ajax_pagination()">
                            <option value="">ทั้งหมด</option>
                            <?php
                            foreach ($this->reportpostparcel_model->get_ref_parcel_group()->result() as $group) {
                                ?>
                                <option value="<?php echo $group->parcel_group_id; ?>"><?php echo $group->parcel_group_name; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label" style="font-weight: bold;">แหล่งขนส่ง</label>
                        <select id="parcel_tran_id" class="form-control form-control-sm" onchange="ajax_pagination()">
                            <option value="">ทั้งหมด</option>
                            <?php
                            foreach ($this->reportpostparcel_model->get_ref_parcel_tran()->result() as $tran) {
                                ?>
                                <option value="<?php echo $tran->parcel_tran_id; ?>"><?php echo $tran->parcel_tran_name; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label" style="font-weight: bold;">ประเภทพัสดุ</label>
                        <select id="parcel_type_id" class="form-control form-control-sm" onchange="ajax_pagination()">
                            <option value="">ทั้งหมด</option>
                            <?php
                            foreach ($this->reportpostparcel_model->get_ref_parcel_type()->result() as $type) {
                                ?>
                                <option value="<?php echo $type->parcel_type_id; ?>"><?php echo $type->parcel_type_name; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label class="control-label" style="font-weight: bold;">ค้นหา</label>
                        <div class="input-group">
                            <input type="text" id="searchtext" class="form-control form-control-sm" placeholder="คำค้นหา">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-sm btn-info" onclick="ajax_pagination()">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="result-pagination" class="m-t-20"></div>
            </div>
        </div>
    </div>
</div>

<div id="result-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>

<div id="result-modal-lg" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
    </div>
</div>

<script>

    var service_base_url = $('#service_base_url').val();

    $(function () {
        ajax_pagination();
    });

    $('#searchtext').keypress(function (e) {
        if (e.which == 13) {
            ajax_pagination();
        }
    });

    $(document).ready(function () {
        set_select_time();
        $('#input_start').datepicker({
            language: 'th-th',
            format: 'dd/mm/yyyy',
            autoclose: true
        });
        $('#input_end').datepicker({
            language: 'th-th',
            format: 'dd/mm/yyyy',
            autoclose: true
        });
    });

    function date_convert(input_id, output_id, id) {
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

    function set_select_time() {
        select_time = $('#select_time').val();
        $('.select_control').hide();
        $('#input_start').prop('disabled', true);
        $('#input_end').prop('disabled', true);
        if (select_time == 1) {
            $('#select_1').show();
            $('#input_select_1').datepicker({
                language: 'th-th',
                format: 'dd/mm/yyyy',
                autoclose: true
            });
            set_select_time_input();
        } else if (select_time == 2) {
            $('#select_2').show();
            set_select_time_input();
        } else if (select_time == 3) {
            $('#select_3').show();
            set_select_time_input();
        } else if (select_time == 4) {
            $('#select_4').show();
            $('#input_start').prop('disabled', false);
            $('#input_end').prop('disabled', false);
        } else {
            $('#select_4').show();
            $('#input_start').val('');
            $('#input_end').val('');
            $('#start').val('');
            $('#end').val('');
            ajax_pagination();
        }
    }

    function set_select_time_input() {
        select_time = $('#select_time').val();
        if (select_time == 1) {
            th_date = $('#input_select_1').val();
            if (th_date != '') {
                split_date = th_date.split('/');
                en_date = (parseInt(split_date[2]) - 543) + '-' + split_date[1] + '-' + split_date[0];
                $('#input_start').val(th_date);
                $('#input_end').val(th_date);
                $('#start').val(en_date);
                $('#end').val(en_date);
            } else {
                $('#input_start').val('');
                $('#input_end').val('');
                $('#start').val('');
                $('#end').val('');
            }
            $('#end').change();
        } else if (select_time == 2) {
            en_ymd = $('#ymd').val().split('-');
            en_y = en_ymd[0];
            th_y = parseInt(en_ymd[0]) + 543;
            m = $('#input_select_2').val();
            d = new Date(en_y, m, 0).getDate();
            input_start = '01/' + m + '/' + th_y;
            input_end = d + '/' + m + '/' + th_y;
            start = en_y + '-' + m + '-01';
            end = en_y + '-' + m + '-' + d;
            $('#input_start').val(input_start);
            $('#input_end').val(input_end);
            $('#start').val(start);
            $('#end').val(end);
            $('#end').change();
        } else if (select_time == 3) {
            th_y = $('#input_select_3').val();
            en_y = parseInt(th_y) - 543;
            input_start = '01/01/' + th_y;
            input_end = '31/12/' + th_y;
            start = en_y + '-01-01';
            end = en_y + '-12-31';
            $('#input_start').val(input_start);
            $('#input_end').val(input_end);
            $('#start').val(start);
            $('#end').val(end);
            $('#end').change();
        } else {

        }
    }

    function ajax_pagination() {
        $('#result-pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        var start = $('#start').val();
        var end = $('#end').val();
        if (start === '') {
            start = $('#min').val();
        }
        if (end === '') {
            end = $('#max').val();
        }
        $.ajax({
            url: service_base_url + 'reportpostparcel/ajax_pagination',
            type: 'POST',
            data: {
                searchtext: $('#searchtext').val(),
                type: $('#select_type').val(),
                start: start,
                end: end,
                parcel_status_id: $('#parcel_status_id').val(),
                parcel_group_id: $('#parcel_group_id').val(),
                parcel_tran_id: $('#parcel_tran_id').val(),
                parcel_type_id: $('#parcel_type_id').val(),
            },
            success: function (response) {
                $('#result-pagination').html(response);
            }
        });
    }

</script>