<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <span style="float: right">
                        <button type="button" class="btn btn-sm btn-rounded btn-outline-success" onclick="modal_add();"><i class="fa fa-plus"></i> เพิ่มประเภทเอกสารพิเศษ</button>
                        <a href="<?php echo base_url('specialcommand/sortspecialcommand'); ?>" class="btn btn-sm btn-rounded btn-outline-info"><i class="fa fa-sort"></i> จัดเรียงประเภทเอกสารพิเศษ</a>
                    </span>
                </h4>
                <div class="m-t-20 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center" width="10%">#</th>
                                <th width="70%">ชื่อ</th>
                                <th width="20%" class="text-center">ตัวเลือก</th>
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
                                        <td><?php echo $row->special_command_name; ?></td>
                                        <td class="text-center">
                                            <button type="button" onclick="modal_edit(<?php echo $row->special_command_id; ?>);" class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i> แก้ไข</button>
                                            <button type="button" <?php echo $this->specialcommand_model->getworkprocess($row->special_command_id)->num_rows() > 0 ? 'disabled' : '';?> onclick="modal_delete(<?php echo $row->special_command_id; ?>);" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> ลบ</button>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="3"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
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

    function modal_add() {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'specialcommand/add_modal',
            type: 'POST',
            data: {},
            success: function(response) {
                $('#result-modal .modal-content').html(response);
                $('#form-modal').parsley();
                $('#result-modal').modal('show', {
                    backdrop: 'true'
                });
            }
        });
    }

    function modal_edit(special_command_id) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'specialcommand/edit_modal',
            type: 'POST',
            data: {
                special_command_id: special_command_id
            },
            success: function(response) {
                $('#result-modal .modal-content').html(response);
                $('#form-modal').parsley();
                $('#result-modal').modal('show', {
                    backdrop: 'true'
                });
            }
        });
    }

    function modal_delete(special_command_id) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'specialcommand/delete_modal',
            type: 'POST',
            data: {
                special_command_id: special_command_id
            },
            success: function(response) {
                $('#result-modal .modal-content').html(response);
                $('#result-modal').modal('show', {
                    backdrop: 'true'
                });
            }
        });
    }
</script>