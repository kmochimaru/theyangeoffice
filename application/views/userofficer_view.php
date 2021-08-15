<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-user-plus"></i> <?php echo " จัดการตำแหน่ง - " . $user_fullname; ?>
                    <span style="float: right">
                        <button type="button" class="btn btn-sm btn-rounded btn-outline-success" onclick="modal_add('<?php echo $user_id; ?>');"><i class="fa fa-plus"></i> เพิ่มตำแหน่ง</button>
                        <button class="btn btn-sm btn-default btn-rounded" onclick="window.close();"><i class="fa fa-times"></i></button>
                    </span>
                </h4>
                <div id="result-pagination" class="m-t-20">
                    <table class="table" >
                        <thead>
                            <tr>
                                <th class="text-center" width="4%">#</th>
                                <th >หน่วยงาน</th>
                                <th >ตำแหน่ง</th>
                                <th class="text-center">ใช้งาน (หลัก)</th>
                                <th class="text-center">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($data->num_rows() > 0) {
                                $i = 1;
                                foreach ($data->result() as $row) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td ><?php echo $row->dep_name; ?></td>  
                                        <td ><?php echo $row->officer_name; ?><spam class="text-muted"><?php echo ' - ' . $row->officer_name_display; ?></spam></td> 
                                <td class="text-center">
                                    <div class="switch text-center">
                                        <label>
                                            <input type="checkbox" onchange="switchactive('<?php echo $row->user_dep_off_id; ?>', '<?php echo $row->user_id; ?>', this);" id="checkbox_active_<?php echo $row->user_dep_off_id ?>" <?php echo ($row->user_dep_off_active_id == 1 ? 'checked disabled' : ''); ?> <?php echo ($row->user_dep_off_status_id == 1 ? '' : 'disabled'); ?>><span class="lever switch-col-red"></span>
                                        </label>
                                    </div>
                                </td> 
                                <td class="text-center">
                                    <div class="switch text-center">
                                        <label>
                                            <?php if ($this->session->userdata('user_id') == $row->user_id) { ?>
                                                <input type="checkbox" onchange="switchstatus('<?php echo $row->user_dep_off_id; ?>', this);" id="checkbox_status_<?php echo $row->user_dep_off_id ?>" <?php echo ($row->user_dep_off_status_id == 1 ? 'checked' : ''); ?> <?php echo ($row->user_dep_off_active_id == 1 ? 'disabled' : ''); ?> <?php echo ($row->dep_id_pri == $this->session->userdata('dep_id_pri') ? 'disabled' : ''); ?>><span class="lever"></span>
                                            <?php } else { ?>
                                                <input type="checkbox" onchange="switchstatus('<?php echo $row->user_dep_off_id; ?>', this);" id="checkbox_status_<?php echo $row->user_dep_off_id ?>" <?php echo ($row->user_dep_off_status_id == 1 ? 'checked' : ''); ?> <?php echo ($row->user_dep_off_active_id == 1 ? 'disabled' : ''); ?>><span class="lever"></span>
                                            <?php } ?>
                                        </label>
                                    </div>
                                </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td class="text-center" colspan="5"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
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
    function modal_add(user_id) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'user/add_userdepoff_modal',
            type: 'POST',
            data: {
                user_id: user_id
            },
            success: function (response) {
                $('#result-modal .modal-content').html(response);
                $('#form-modal').parsley();
                $('#result-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

    function switchstatus(user_dep_off_id, checkbox) {
        if (checkbox.checked) {
            var url = service_base_url + 'user/status1';
            $.post(url, {user_dep_off_id: user_dep_off_id}, function (response) {
                setTimeout(function () {
                    location.reload();
                }, 200);
            });
        } else {
            var url = service_base_url + 'user/status2';
            $.post(url, {user_dep_off_id: user_dep_off_id}, function (response) {
                setTimeout(function () {
                    location.reload();
                }, 200);
            });
        }
    }

    function switchactive(user_dep_off_id, user_id, checkbox) {
        var url = service_base_url + 'user/active';
        $.post(url, {user_dep_off_id: user_dep_off_id, user_id: user_id}, function (response) {
            setTimeout(function () {
                location.reload();
            }, 200);
        });
    }
</script>