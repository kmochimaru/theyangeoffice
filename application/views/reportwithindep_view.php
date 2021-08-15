<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                </h4>
                <div class="row m-t-20">
                    <div class="col-sm-3 m-b-10">
                        <label class="control-label" style="font-weight: bold;">ปีสารบรรณ</label>
                        <select id="year_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">ปีทั้งหมด</option>
                            <?php
                            $years = $this->accesscontrol->get_year();
                            if ($years->num_rows() > 0) {
                                foreach ($years->result() as $year) {
                            ?>
                                    <option value="<?php echo $year->year_id; ?>" <?php echo ($year->year_id == $this->session->userdata('year_id') ? 'selected="selected"' : ''); ?>><?php echo $year->year; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3 m-b-10">
                        <label class="control-label" style="font-weight: bold;">วันที่เริ่มต้น</label>
                        <input type="text" id="start_input" class="form-control form-control-sm" onchange="dateConvert('start_input', 'start')" placeholder="เลือกวันที่เริ่มต้น" value="" autocomplete="off">
                        <input type="hidden" id="start" value="" onchange="ajax_pagination()">
                    </div>
                    <div class="col-sm-3 m-b-10">
                        <label class="control-label" style="font-weight: bold;">วันที่สิ้นสุด</label>
                        <input type="text" id="end_input" class="form-control form-control-sm" onchange="dateConvert('end_input', 'end')" placeholder="เลือกวันที่สิ้นสุด" value="" autocomplete="off">
                        <input type="hidden" id="end" value="" onchange="ajax_pagination()">
                    </div>
                    <div class="col-sm-3 m-b-10">
                        <label class="control-label" style="font-weight: bold;">ประเภทเอกสาร</label>
                        <select id="work_type_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">ประเภทเอกสารทั้งหมด</option>
                            <?php
                            $work_types = $this->reportwithindep_model->get_ref_work_type();
                            if ($work_types->num_rows() > 0) {
                                foreach ($work_types->result() as $work_type) {
                            ?>
                                    <option value="<?php echo $work_type->work_type_id; ?>"><?php echo $work_type->work_type_name; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3 m-b-10">
                        <label class="control-label" style="font-weight: bold;">สถานะ</label>
                        <select id="state_info_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">สถานะทั้งหมด</option>
                            <?php
                            $states = $this->reportwithindep_model->get_ref_state_info();
                            if ($states->num_rows() > 0) {
                                foreach ($states->result() as $state) {
                            ?>
                                    <option value="<?php echo $state->state_info_id; ?>"><?php echo $state->state_info_name; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3 m-b-10">
                        <label class="control-label" style="font-weight: bold;">หมวดเอกสาร</label>
                        <select id="book_group_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">หมวดทั้งหมด</option>
                            <?php
                            $groups = $this->reportwithindep_model->get_ref_book_group();
                            if ($groups->num_rows() > 0) {
                                foreach ($groups->result() as $group) {
                            ?>
                                    <option value="<?php echo $group->book_group_id; ?>"><?php echo $group->book_group_name; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3 m-b-10">
                        <label class="control-label" style="font-weight: bold;">ค้นหา</label>
                        <div class="input-group">
                            <input type="text" id="searchtext" class="form-control form-control-sm" placeholder="คำค้นหา">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-sm btn-info" onclick="ajax_pagination()">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 d-flex justify-content-center align-items-center">
                        <button class="btn-sm btn-block btn-success mt-3" onclick="Exportexcel()">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export
                        </button>
                    </div>
                </div>
                <div id="result-pagination" class="m-t-20"></div>
            </div>
        </div>
    </div>
</div>
<div id="result-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content">

        </div>
    </div>
</div>
<div id="modal_changestatus_fail" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> เกิดข้อผิดพลาด</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body text-center">
                    <p class="text-center" style="font-weight: bold;">เอกสารนี้ไม่สามารถยกเลิกได้</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="location.reload();">ปิด</button>
            </div>
        </div>
    </div>
</div>
<script>
    // $(function() {
    //   $('#start_input').datepicker({
    //     language: 'th-th',
    //     format: 'dd/mm/yyyy',
    //     autoclose: true
    //   })
    //   $('#end_input').datepicker({
    //     language: 'th-th',
    //     format: 'dd/mm/yyyy',
    //     autoclose: true
    //   })
    //   ajax_pagination();
    // });

    $(document).ready(function() {
        $('#start_input').datepicker({
            language: 'th-th',
            format: 'dd/mm/yyyy',
            autoclose: true
        })
        $('#end_input').datepicker({
            language: 'th-th',
            format: 'dd/mm/yyyy',
            autoclose: true
        })
        ajax_pagination()
    })

    function resetPagination() {
        $('#start_input').val('')
        $('#start').val('')
        $('#end_input').val('')
        $('#end').val('')
        $('#search').val('')
        ajax_pagination()
    }

    $('#searchtext').keypress(function(e) {
        if (e.which == 13) {
            ajax_pagination();
        }
    });

    function Exportexcel() {
        // var params = $('#year_id').val() + '/' + $('#work_type_id').val() + '/' + $('#state_info_id').val() + '/' + $('#book_group_id').val() + '/' + $('#searchtext').val() + '/' + $('#start').val() + '/' + $('#end').val();
        var params = '';
        if ($('#year_id').val() != '') {
            params += $('#year_id').val() + '/';
        } else {
            params += null + '/';
        }
        if ($('#work_type_id').val() != '') {
            params += $('#work_type_id').val() + '/';
        } else {
            params += null + '/';
        }
        if ($('#state_info_id').val() != '') {
            params += $('#state_info_id').val() + '/';
        } else {
            params += null + '/';
        }
        if ($('#book_group_id').val() != '') {
            params += $('#book_group_id').val() + '/';
        } else {
            params += null + '/';
        }
        if ($('#searchtext').val() != '') {
            params += $('#searchtext').val() + '/';
        } else {
            params += null + '/';
        }
        if ($('#start').val() != '') {
            params += $('#start').val() + '/';
        } else {
            params += null + '/';
        }
        if ($('#end').val() != '') {
            params += $('#end').val();
        } else {
            params += null;
        }
        window.open(service_base_url + 'reportwithindep/excel/' + params, '_blank');
    }

    function ajax_pagination() {
        $('#result-pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'reportwithindep/ajax_pagination',
            type: 'POST',
            data: {
                year_id: $('#year_id').val(),
                work_type_id: $('#work_type_id').val(),
                state_info_id: $('#state_info_id').val(),
                book_group_id: $('#book_group_id').val(),
                searchtext: $('#searchtext').val(),
                date_start: $('#start').val(),
                date_end: $('#end').val(),
            },
            success: function(response) {
                $('#result-pagination').html(response);
            }
        });
    }

    function modal_changestatus(work_info_id_pri) {
        $.ajax({
            url: service_base_url + 'reportwithindep/modal_changestatus',
            type: 'POST',
            data: {
                work_info_id_pri: work_info_id_pri
            },
            success: function(response) {
                if (response != 0) {
                    $('#modal_changestatus_fail').modal('hide');
                    $('#result-modal #modal-content').html(response);
                    $('#result-modal').modal('show', {
                        backdrop: 'true'
                    });
                } else {
                    $('#result-modal').modal('hide');
                    $('#modal_changestatus_fail').modal('show', {
                        backdrop: 'true'
                    });
                }
            }
        });
    }

    function changestatus(work_info_id_pri) {
        var form = $("#form_cancel_comment_modal");
        form.parsley().validate();
        if (form.parsley().isValid() == true) {
            $('#btn_submit').prop('disabled', true);
            $('#btn-modal-submit-loading').show();
            $.ajax({
                url: service_base_url + 'reportwithindep/changestatus',
                type: 'POST',
                data: {
                    work_info_id_pri: work_info_id_pri,
                    work_info_comment: $('#work_info_comment_changestatus').val()
                },
                success: function(response) {
                    $('#result-modal').modal('hide');
                    if (response == 1) {
                        notification('success', 'สำเร็จ', 'ยกเลิกเอกสารสำเร็จ');
                    } else {
                        notification('error', 'ไม่สำเร็จ', 'ยกเลิกเอกสารไม่สำเร็จ!');
                    }
                    ajax_pagination();
                }
            })
        }
    }

    function modal_closestatus(work_info_id_pri) {
        $.ajax({
            url: service_base_url + 'reportwithindep/modal_closestatus',
            type: 'POST',
            data: {
                work_info_id_pri: work_info_id_pri
            },
            success: function(response) {
                if (response != 0) {
                    $('#modal_changestatus_fail').modal('hide');
                    $('#result-modal #modal-content').html(response);
                    $('#result-modal').modal('show', {
                        backdrop: 'true'
                    });
                } else {
                    $('#result-modal').modal('hide');
                    $('#modal_changestatus_fail').modal('show', {
                        backdrop: 'true'
                    });
                }
            }
        });
    }

    function closestatus(work_info_id_pri) {
        $('#btn_submit').prop('disabled', true);
        $('#btn-modal-submit-loading').show();
        $.ajax({
            url: service_base_url + 'reportwithindep/closestatus',
            type: 'POST',
            data: {
                work_info_id_pri: work_info_id_pri,
            },
            success: function(response) {
                $('#result-modal').modal('hide');
                if (response == 1) {
                    notification('success', 'สำเร็จ', 'ปิดงานสำเร็จ');
                } else {
                    notification('error', 'ไม่สำเร็จ', 'ปิดงานไม่สำเร็จ!');
                }
                ajax_pagination();
            }
        })
    }

    function dateConvert(input_id, output_id) {
        let get_date = $('#' + input_id).val()
        if (get_date != '') {
            let split_date = get_date.split('/')
            let date = (parseInt(split_date[2]) - 543) + '-' + split_date[1] + '-' + split_date[0]
            $('#' + output_id).val(date)
            if (input_id == 'start_input') {
                $('#end_input').val('')
                $('#end').val('')
                $('#end_input').datepicker('setStartDate', new Date(date))
            }
        } else {
            $('#' + output_id).val('')
            if (input_id == 'start_input') {
                $('#end_input').val('')
                $('#end').val('')
                $('#end_input').datepicker('setStartDate', '')
            }
        }
        $('#' + output_id).change()
    }
</script>