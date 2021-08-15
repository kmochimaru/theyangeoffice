<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> <?php echo " - " . $service_group->service_group_name . " - " . $service->service_name; ?>
                    <span style="float: right">
                        <a href="<?php echo base_url('servicegroup/addhelpdesk/' . $service_group_id . '/' . $service_id); ?>" class="btn btn-sm btn-rounded btn-outline-success"><i class="fa fa-user-plus"></i> ผู้ช่วยเหลือ</a>                                        
                    </span>
                    <input type="hidden" name="service_group_id" id="service_group_id" value="<?php echo $service_group_id ?>" />
                    <input type="hidden" name="service_id" id="service_id" value="<?php echo $service_id ?>" />
                </h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>ผู้ช่วยเหลือ</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if ($datas->num_rows() > 0) {
                                foreach ($datas->result() as $data) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td><?php echo $data->user_fullname; ?></td>
                                        <td class="text-center">
                                            <?php if ($data->help_desk_active_id == 1) { ?>
                                                <span class="badge badge-warning"><i class="mdi mdi-account-star"></i> หัวหน้างาน</span>
                                            <?php } else { ?>
                                                <span class="badge badge-primary"><i class="mdi mdi-account"></i> สนับสนุน</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($this->servicegroup_model->check_help_desk_active($data->service_id) == 0) { ?>
                                                <?php if ($data->help_desk_active_id == 2) { ?>
                                                    <button type="button" class="btn btn-sm btn-outline-warning" onclick="modalEditactive(<?php echo $data->help_desk_id; ?>)"><i class="mdi mdi-account-star"></i> หัวหน้า</button>
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="modalEditchangeactive(<?php echo $data->help_desk_id; ?>)"><i class="mdi mdi-account"></i> สนับสนุน</button>
                                                    <?php
                                                }
                                            } else {
                                                if ($data->help_desk_active_id == 1) {
                                                    ?>
                                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="modalEditchangeactive(<?php echo $data->help_desk_id; ?>)"><i class="mdi mdi-account"></i> สนับสนุน</button>
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-sm btn-outline-primary" disabled=""><i class="mdi mdi-account"></i> สนับสนุน</button>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="modal_delete('<?php echo $data->help_desk_id; ?>');"><i class="fa fa-trash"></i> ลบ</button>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="11"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
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

    var service_base_url = $('#service_base_url').val();

    function modal_delete(help_desk_id) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'servicegroup/deleteuserhelpdesk_modal',
            type: 'POST',
            data: {
                help_desk_id: help_desk_id,
                service_group_id: $('#service_group_id').val(),
                service_id: $('#service_id').val(),
            },
            success: function (response) {
                $('#result-modal .modal-content').html(response);
                $('#result-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

    //active
    function modalEditactive(help_desk_id) {
        $.ajax({
            url: service_base_url + 'servicegroup/editactive',
            type: 'post',
            data: {
                help_desk_id: help_desk_id
            },
            success: function (response) {
                if (response == 1) {
                    location.reload();
                }
            }
        });
    }
    
    function modalEditchangeactive(help_desk_id) {
        $.ajax({
            url: service_base_url + 'servicegroup/editchangeactive',
            type: 'post',
            data: {
                help_desk_id: help_desk_id
            },
            success: function (response) {
                if (response == 1) {
                    location.reload();
                }
            }
        });
    }
</script>