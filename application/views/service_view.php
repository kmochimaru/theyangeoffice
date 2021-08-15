<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> <?php echo " - " . $service_group->service_group_name; ?>
                    <span style="float: right">
                        <button type="button" class="btn btn-sm btn-rounded btn-outline-success" onclick="modaladd();"><i class="fa fa-plus"></i> เพิ่มงานแก้ไขและบริการ</button>
                        <a href="<?php echo base_url('servicegroup/sortservice/' . $service_group_id); ?>" class="btn btn-sm btn-rounded btn-outline-info"><i class="fa fa-sort"></i> จัดเรียงงานแก้ไขและบริการ</a>
                        <a href="<?php echo base_url('servicegroup'); ?>" class="btn btn-sm btn-rounded btn-outline-inverse"><i class="fa fa-close"></i> ยกเลิก</a>
                    </span>
                </h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>งานแก้ไขและบริการ</th>
                                <th class="text-center">จัดเรียง</th>
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
                                        <td><?php echo $data->service_name; ?></td>
                                        <td class="text-center"><?php echo $data->service_sort; ?></td>
                                        <td class="text-center">
                                            <?php if ($data->service_status_id == 1) { ?>
                                                <span class="badge badge-success"><i class="fa fa-check"></i> เปิด</span>
                                            <?php } else if ($data->service_status_id == 2) { ?>
                                                <span class="badge badge-danger"><i class="fa fa-times"></i> ปิด</span>
                                            <?php } else { ?>
                                                <span class="badge badge-info"><i class="fa fa-minus-circle"></i> แสดงไม่ให้คลิก</span>
                                            <?php } ?>                                           
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url('servicegroup/helpdesk/' . $service_group_id . '/' . $data->service_id); ?>" class="btn btn-sm btn-outline-primary"><i class="fa fa-user-md"></i> ผู้ช่วยเหลือ</a>
                                            <button type="button" class="btn btn-sm btn-outline-info" onclick="modaledit(<?php echo $data->service_id; ?>)"><i class="fa fa-edit"></i> แก้ไข</button>
                                            <?php if ($this->servicegroup_model->checkservice($data->service_id) > 0) { ?>
                                                <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-trash"></i> ลบ</button>
                                            <?php } else {
                                                ?>
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="modaldelete(<?php echo $data->service_group_id; ?>,<?php echo $data->service_id; ?>);"><i class="fa fa-trash"></i> ลบ</button>
                                            <?php } ?>
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
            <form id="add-form" method="post" action="<?php echo base_url('servicegroup/addservice'); ?>" autocomplete="off">
                <input type="hidden" name="service_group_id" value="<?php echo $service_group_id; ?>">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มงานแก้ไขและบริการ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">งานแก้ไขและบริการ <span class="text-danger">*</span></label>
                        <input type="text" name="service_name" class="form-control form-control-line" required>
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
            <form id="edit-form" method="post" action="<?php echo base_url('servicegroup/editservice'); ?>" autocomplete="off">
                <input type="hidden" id="service_group_id" name="service_group_id" value="">
                <input type="hidden" id="service_id" name="service_id" value="">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> แก้ไขงานแก้ไขและบริการ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">งานแก้ไขและบริการ <span class="text-danger">*</span></label>
                        <input type="text" id="service_name" name="service_name" class="form-control form-control-line" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">สถานะ</label>
                        <input name="service_status_id" type="radio" id="status_1" value="1">
                        <label for="status_1">เปิดงานแก้ไขและบริการ</label>
                        <input name="service_status_id" type="radio" id="status_2" value="2">
                        <label for="status_2">ปิดงานแก้ไขและบริการ</label>
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

    function modaledit(service_id) {
        $('#service_group_id').val('');
        $('#service_id').val('');
        $('#service_name').val('');
        let url = service_base_url + 'servicegroup/getservice';
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'JSON',
            data: {
                service_id: service_id
            },
            success: function (response) {
                $('#service_group_id').val(response.service_group_id);
                $('#service_id').val(response.service_id);
                $('#service_name').val(response.service_name);
                $('#status_' + response.service_status_id).prop('checked', true);
                $('#service_openlink_' + response.service_openlink).prop('checked', true);
                $('#edit-form').parsley().reset();
                $('#edit-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

    function modaldelete(service_group_id, service_id) {
        let url = service_base_url + 'servicegroup/deleteservice/' + service_group_id + '/' + service_id;
        $('#delete_id').attr('href', url);
        $('#delete-modal').modal('show', {backdrop: 'true'});
    }
</script>