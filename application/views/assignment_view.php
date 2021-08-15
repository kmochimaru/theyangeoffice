<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
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
                        <select id="work_user_status_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">สถานะทั้งหมด</option>
                            <?php
                            $status = $this->assignment_model->get_ref_work_user_status();
                            if ($status->num_rows() > 0) {
                                foreach ($status->result() as $state) {
                                    ?>
                                    <option value="<?php echo $state->work_user_status_id; ?>"><?php echo $state->work_user_status_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-2 m-b-10">
                        <label class="control-label" style="font-weight: bold;">ชั้นความเร็ว</label>
                        <select id="priority_info_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">ชั้นความเร็วทั้งหมด</option>
                            <?php
                            $prioritys = $this->assignment_model->ref_priority_info();
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
                            $groups = $this->assignment_model->ref_book_group();
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
        <div class="modal-content"></div>
    </div>
</div>

<div id="result-modal-lg" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
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
            url: service_base_url + 'assignment/ajax_pagination',
            type: 'POST',
            data: {
                year_id: $('#year_id').val(),
                searchtext: $('#searchtext').val(),
                work_user_status_id: $('#work_user_status_id').val(),
                priority_info_id: $('#priority_info_id').val(),
                book_group_id: $('#book_group_id').val(),
            },
            success: function (response) {
                $('#result-pagination').html(response);
            }
        });
    }
</script>