<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <span style="float: right">
                        <button type="button" class="btn btn-sm btn-rounded btn-outline-success" onclick="modaladd();"><i class="fa fa-plus"></i> เพิ่มเส้นทาง</button>
                    </span>
                </h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>เส้นทาง</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center" width="38%">ตัวเลือก</th>
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
                                        <td><?php echo $data->routes_name; ?></td>
                                        <td class="text-center">
                                            <?php if ($data->routes_status_id == 1) { ?>
                                                <span class="badge badge-success"><i class="fa fa-check"></i> ใช้งาน</span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger"><i class="fa fa-times"></i> ระงับ</span>
                                            <?php } ?>                                           
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url('routes/set/' . $data->routes_id); ?>" class="btn btn-sm btn-outline-primary" target="_blank"><i class="fa fa-list"></i> กำหนดและจัดเรียงเส้นทาง</a>
                                            <?php if ($this->routes_model->checkroutes($data->routes_id) > 0) { ?>
                                                <button type="button" class="btn btn-sm btn-outline-info" onclick="modaledit(<?php echo $data->routes_id; ?>)"><i class="fa fa-edit"></i> แก้ไข</button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-trash"></i> ลบ</button>
                                            <?php } else {
                                                ?>
                                                <button type="button" class="btn btn-sm btn-outline-info" onclick="modaledit(<?php echo $data->routes_id; ?>)"><i class="fa fa-edit"></i> แก้ไข</button>
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="modaldelete(<?php echo $data->routes_id; ?>);"><i class="fa fa-trash"></i> ลบ</button>
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
                                    <td class="text-center" colspan="10"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
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

<div id="add-modal" class="modal fade" tabindex="-1" routes="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="add-form" method="post" action="<?php echo base_url('routes/addroutes'); ?>" autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มเส้นทาง</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">เส้นทาง <span class="text-danger">*</span></label>
                        <input type="text" name="routes_name" class="form-control form-control-sm" required>
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

<div id="edit-modal" class="modal fade" tabindex="-1" routes="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edit-form" method="post" action="<?php echo base_url('routes/editroutes'); ?>" autocomplete="off">
                <input type="hidden" id="routes_id" name="routes_id" value="">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> แก้ไขเส้นทาง</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">เส้นทาง <span class="text-danger">*</span></label>
                        <input type="text" id="routes_name" name="routes_name" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">สถานะ</label>
                        <input name="routes_status_id" id="routes_status_id_1" type="radio" value="1">
                        <label for="routes_status_id_1">ใช้งาน</label>
                        <input name="routes_status_id" id="routes_status_id_2" type="radio" value="2">
                        <label for="routes_status_id_2">ระงับ</label>
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

<div id="delete-modal" class="modal fade" tabindex="-1" routes="dialog" aria-hidden="true" style="display: none;">
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

<div id="set-routes-modal" class="modal fade" tabindex="-1" routes="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div id="set-routes-form" class="modal-content">
        </div>
    </div>
</div>

<script>

    var service_base_url = $('#service_base_url').val();

    function modalset(routes_id) {
        url = service_base_url + 'routes/setroutes';
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                routes_id: routes_id
            },
            success: function (response) {
                $('#set-routes-form').html(response);
                $('#set-routes-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

    function switchroutes(routes_id, dep_off_id, checkbox) {
        if (checkbox.checked) {
            var url = service_base_url + 'routes/add';
            $.post(url, {routes_id: routes_id, dep_off_id: dep_off_id}, function (response) {
                $('#routes_show_checkbock' + dep_off_id).html('<span class="badge badge-success"><i class="fa fa-check-circle"></i>&nbsp;เลือก</span>');
                notification('success', 'สำเร็จ', 'กำหนดเส้นทางสำเร็จ');
            });
        } else {
            var url = service_base_url + 'routes/delete';
            $.post(url, {routes_id: routes_id, dep_off_id: dep_off_id}, function (response) {
                $('#routes_show_checkbock' + dep_off_id).html('<span class="badge badge-warning"><i class="fa fa-times-circle"></i>&nbsp;ไม่เลือก</span>');
                notification('success', 'สำเร็จ', 'กำหนดเส้นทางสำเร็จ');
            });
        }
    }

    function modaladd() {
        $('#add-form').parsley().reset();
        $('#add-modal').modal('show', {backdrop: 'true'});
    }

    function modaledit(routes_id) {
        $('#routes_id').val('');
        $('#routes_name').val('');
        $.ajax({
            url: service_base_url + 'routes/getroutes',
            method: 'POST',
            dataType: 'JSON',
            data: {
                routes_id: routes_id
            },
            success: function (response) {
                $('#routes_id').val(response.routes_id);
                $('#routes_name').val(response.routes_name);
                $('#routes_status_id_' + response.routes_status_id).attr('checked', true);
                $('#edit-form').parsley().reset();
                $('#edit-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

    function modaldelete(routes_id) {
        url = service_base_url + 'routes/deleteroutes/' + routes_id;
        $('#delete_id').attr('href', url);
        $('#delete-modal').modal('show', {backdrop: 'true'});
    }

</script>