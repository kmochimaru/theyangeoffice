<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <span style="float: right">                        
                    </span>
                </h4>
                <div class="row m-t-20">
                    <div class="col-sm-2 m-b-10">
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
                    <div class="col-sm-2 m-b-10">
                        <label class="control-label" style="font-weight: bold;">สถานะ</label>
                        <select id="status_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">สถานะทั้งหมด</option>
                            <option value="0">ยังไม่ได้เปิด</option>
                            <option value="1">เปิดแล้ว</option>
                            <option value="2">ส่งตีกลับ</option>
                        </select>
                    </div>
                    <div class="col-sm-2 m-b-10">
                        <label class="control-label" style="font-weight: bold;">ชั้นความเร็ว</label>
                        <select id="priority_info_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">ชั้นความเร็วทั้งหมด</option>
                            <?php
                            $prioritys = $this->getwithinprocess_model->ref_priority_info();
                            if ($prioritys->num_rows() > 0) {
                                foreach ($prioritys->result() as $priority) {
                                    ?>
                                    <option value="<?php echo $priority->priority_info_id; ?>"><?php echo $priority->priority_info_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-2 m-b-10">
                        <label class="control-label" style="font-weight: bold;">หมวดเอกสาร</label>
                        <select id="book_group_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">หมวดทั้งหมด</option>
                            <?php
                            $groups = $this->getwithinprocess_model->get_ref_book_group();
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
                    <div class="col-sm-4 m-b-10">
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
                    <p class="text-center" style="font-weight: bold;">เอกสารนี้ไม่สามารถดึงเรื่องกลับได้</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="location.reload();">ปิด</button>
            </div>
        </div>
    </div>
</div>
<script>

    $(function () {
        ajax_pagination();
    });

    $('#searchtext').keypress(function (e) {
        if (e.which == 13) {
            ajax_pagination();
        }
    });

    function ajax_pagination() {
        $('#result-pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'getwithinprocess/ajax_pagination',
            type: 'POST',
            data: {
                year_id: $('#year_id').val(),
                searchtext: $('#searchtext').val(),
                status_id: $('#status_id').val(),
                priority_info_id: $('#priority_info_id').val(),
                book_group_id: $('#book_group_id').val(),
            },
            success: function (response) {
                $('#result-pagination').html(response);
            }
        });
    }

    function modal_changestatus(work_process_id_pri) {
        $.ajax({
            url: service_base_url + 'getwithinprocess/modal_changestatus',
            type: 'POST',
            data: {
                work_process_id_pri: work_process_id_pri
            },
            success: function (response) {
                if (response != 0) {
                    $('#modal_changestatus_fail').modal('hide');
                    $('#result-modal #modal-content').html(response);
                    $('#result-modal').modal('show', {backdrop: 'true'});
                } else {
                    $('#result-modal').modal('hide');
                    $('#modal_changestatus_fail').modal('show', {backdrop: 'true'});
                }
            }
        });
    }

    function changestatus(work_process_id_pri) {
        $('#btn_submit').prop('disabled', true);
        $('#btn-modal-submit-loading').show();
        $.ajax({
            url: service_base_url + 'getwithinprocess/changestatus',
            type: 'POST',
            data: {
                work_process_id_pri: work_process_id_pri
            },
            success: function (response) {
                $('#result-modal').modal('hide');
                if (response == 1) {
                    notification('success', 'สำเร็จ', 'ดึงเรื่องกลับสำเร็จ');
                } else {
                    notification('error', 'ไม่สำเร็จ', 'ดึงเรื่องกลับไม่สำเร็จ!');
                }
                ajax_pagination();
            }
        });
    }
</script>
