<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <span style="float: right">
                        <button type="button" class="btn btn-sm btn-rounded btn-outline-success" onclick="modaladd();"><i class="fa fa-plus"></i> เพิ่มตำแหน่งงาน</button>
                        <a href="<?php echo base_url('officer/sort'); ?>" class="btn btn-sm btn-rounded btn-outline-info"><i class="fa fa-sort"></i> จัดเรียงตำแหน่งงาน</a>
                    </span>
                </h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ตำแหน่งงาน</th>
                                <th>ชื่อตำแหน่ง</th>
                                <th class="text-center">ลำดับขั้น</th>
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
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $data->officer_name; ?></td>
                                        <td><?php echo $data->officer_name_display; ?></td>
                                        <td class="text-center"><?php echo $data->officer_level; ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-outline-info" onclick="modaledit(<?php echo $data->officer_id; ?>)"><i class="fa fa-edit"></i> แก้ไข</button>
                                            <?php if ($this->officer_model->checkofficer($data->officer_id) > 0) { ?>
                                                <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-trash"></i> ลบ</button>
                                            <?php } else {
                                                ?>
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="modaldelete(<?php echo $data->officer_id; ?>);"><i class="fa fa-trash"></i> ลบ</button>
                                            <?php }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="5"><?php echo 'ไม่มีข้อมูล'; ?></td>
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

<div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="add-form" method="post" action="<?php echo base_url('officer/addofficer'); ?>" autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มตำแหน่งงาน</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">ตำแหน่งงาน <span class="text-danger">*</span></label>
                        <input type="text" name="officer_name" class="form-control form-control-line" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">ชื่อตำแหน่ง <span class="text-danger">*</span></label>
                        <input type="text" name="officer_name_display" class="form-control form-control-line" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">ลำดับขั้น</label>
                        <input type="number" min='1' name="officer_level" class="form-control form-control-line" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info waves-effect waves-light"><i class="fa fa-save"></i> บันทึก</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>                   
                </div>
            </form>
        </div>
    </div>
</div>

<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edit-form" method="post" action="<?php echo base_url('officer/editofficer'); ?>" autocomplete="off">
                <input type="hidden" id="officer_id" name="officer_id" value="">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> แก้ไขตำแหน่งงาน</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">ตำแหน่งงาน <span class="text-danger">*</span></label>
                        <input type="text" id="officer_name" name="officer_name" class="form-control form-control-line" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">ชื่อตำแหน่ง <span class="text-danger">*</span></label>
                        <input type="text" id="officer_name_display" name="officer_name_display" class="form-control form-control-line" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">ลำดับขั้น</label>
                        <input type="number" min='1'  id="officer_level" name="officer_level" class="form-control form-control-line" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info waves-effect waves-light"><i class="fa fa-save"></i> บันทึก</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>                    
                </div>
            </form>
        </div>
    </div>
</div>

<div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-trash"></i> ยืนยันการลบข้อมูล</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body text-center text-danger">
                    <b>ยืนยันการลบข้อมูลนี้ ใช่หรือไม่  <i class="fa fa-question-circle"></i></b>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-danger waves-effect waves-light" id="delete_id"><i class="fa fa-trash"></i> ตกลง</a>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>               
            </div>
        </div>
    </div>
</div>

<script>
    var service_base_url = $('#service_base_url').val();

    function modaladd() {
        $('#add-form').parsley().reset();
        $('#add-modal').modal('show', {backdrop: 'true'});
    }

    function modaledit(officer_id) {
        $('#officer_id').val('');
        $('#officer_name').val('');
        $('#officer_name_display').val('');
        $('#officer_level').val('');
        $.ajax({
            url: service_base_url + 'officer/getofficer',
            method: 'POST',
            dataType: 'JSON',
            data: {
                officer_id: officer_id
            },
            success: function (response) {
                $('#officer_id').val(response.officer_id);
                $('#officer_name').val(response.officer_name);
                $('#officer_name_display').val(response.officer_name_display);
                $('#officer_level').val(response.officer_level);
                $('#edit-form').parsley().reset();
                $('#edit-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

    function modaldelete(officer_id) {
        $('#delete_id').attr('href', service_base_url + 'officer/deleteofficer/' + officer_id);
        $('#delete-modal').modal('show', {backdrop: 'true'});
    }

</script>