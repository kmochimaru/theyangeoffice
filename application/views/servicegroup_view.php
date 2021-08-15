<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <span style="float: right">
                        <button type="button" class="btn btn-sm btn-rounded btn-outline-success" onclick="modaladd();"><i class="fa fa-plus"></i> เพิ่มกลุ่มงานแก้ไขและบริการ</button>
                        <a href="<?php echo base_url('servicegroup/sortservicegroup'); ?>" class="btn btn-sm btn-rounded btn-outline-info"><i class="fa fa-sort"></i> จัดเรียงกลุ่มงานแก้ไขและบริการ</a>
                    </span>
                </h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>กลุ่มงานแก้ไขและบริการ</th>
                                <th>จัดเรียง</th>
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
                                        <td><?php echo $data->service_group_name; ?> (<?php echo $data->service_group_id; ?>)</td>
                                        <td><?php echo $data->service_group_sort; ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url('servicegroup/service/' . $data->service_group_id); ?>" class="btn btn-sm btn-outline-warning"><i class="fa fa-list"></i> จัดการเมนู</a>
                                            <button type="button" class="btn btn-sm btn-outline-info" onclick="modaledit(<?php echo $data->service_group_id; ?>)"><i class="fa fa-edit"></i> แก้ไข</button>
                                            <?php if ($this->servicegroup_model->checkservicegroup($data->service_group_id) > 0) { ?>
                                                <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-trash"></i> ลบ</button>
                                            <?php } else {
                                                ?>
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="modaldelete(<?php echo $data->service_group_id; ?>);"><i class="fa fa-trash"></i> ลบ</button>
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

<div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="add-form" method="post" action="<?php echo base_url('servicegroup/addservicegroup'); ?>" autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มกลุ่มงานแก้ไขและบริการ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">กลุ่มงานแก้ไขและบริการ <span class="text-danger">*</span></label>
                        <input type="text" name="service_group_name" class="form-control form-control-line" required>
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
            <form id="edit-form" method="post" action="<?php echo base_url('servicegroup/editservicegroup'); ?>" autocomplete="off">
                <input type="hidden" id="service_group_id" name="service_group_id" value="">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> แก้ไขกลุ่มงานแก้ไขและบริการ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">กลุ่มงานแก้ไขและบริการ <span class="text-danger">*</span></label>
                        <input type="text" id="service_group_name" name="service_group_name" class="form-control form-control-line" required>
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

    $(function () {
        //
    });

    function modaladd() {
        $('#add-form').parsley().reset();
        $('#add-modal').modal('show', {backdrop: 'true'});
    }

    function modaledit(service_group_id) {
        $('#service_group_id').val('');
        $('#service_group_name').val('');
        let url = service_base_url + 'servicegroup/getservicegroup';
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'JSON',
            data: {
                service_group_id: service_group_id
            },
            success: function (response) {
                $('#service_group_id').val(response.service_group_id);
                $('#service_group_name').val(response.service_group_name);
                $('#edit-form').parsley().reset();
                $('#edit-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

    function modaldelete(service_group_id) {
        let url = service_base_url + 'servicegroup/deleteservicegroup/' + service_group_id;
        $('#delete_id').attr('href', url);
        $('#delete-modal').modal('show', {backdrop: 'true'});
    }

</script>