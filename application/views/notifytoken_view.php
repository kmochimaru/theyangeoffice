<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo " " . $icon; ?>"></i> <?php echo " " . $title; ?>
                </h4>              
                <div class="row m-t-20">
                    <div class="col-sm-3">
                        <label class="control-label" style="font-weight: bold;">หน่วยงาน</label>
                        <select name="dep_id_pri" id="dep_id_pri" class="select2 form-control custom-select" style="width: 100%;" data-placeholder="หน่วยงานทั้งหมด" onchange="ajax_pagination()">
                            <option value=""></option>
                            <?php
                            foreach ($this->notifytoken_model->get_department()->result() as $row) {
                                ?>
                                <option value="<?php echo $row->dep_id_pri; ?>"><?php echo $row->dep_name . ' ( ' . $row->dep_name_short . ' ) '; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label" style="font-weight: bold;">สิทธิ์</label>
                        <select id="role_id" class="form-control form-control-sm" data-placeholder="ทั้งหมด" onchange="ajax_pagination()">
                            <option value="0">สิทธิ์ทั้งหมด</option>
                            <?php foreach ($this->notifytoken_model->get_role()->result() as $role) { ?>
                                <option value="<?php echo $role->role_id; ?>"><?php echo $role->role_name; ?></option>
                            <?php } ?>
                        </select> 
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label" style="font-weight: bold;">สถานะ</label>
                        <select id="status_id" class="form-control form-control-sm" data-placeholder="ทั้งหมด" onchange="ajax_pagination()">
                            <option value="0">สถานะทั้งหมด</option>
                            <option value="1" selected>ลงทะเบียนแล้ว</option>
                            <option value="2">ไม่ได้ลงทะเบียน</option>
                        </select> 
                    </div>
                    <div class="col-lg-3">
                        <label class="control-label" style="font-weight: bold;">ค้นหา</label>
                        <div class="input-group">
                            <input type="text" id="searchtext" class="form-control form-control-sm" placeholder="คำค้นหา">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-sm btn-info" onclick="ajax_page()">ค้นหา</button>
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
    var service_base_url = $('#service_base_url').val();

    $(function () {
        ajax_pagination();
        $(".select2").select2();
    });

    $('#searchtext').keypress(function (e) {
        if (e.which == 13) {
            ajax_pagination();
        }
    });

    function ajax_pagination() {
        $('#result-pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'notifytoken/ajax_pagination',
            type: 'POST',
            data: {
                dep_id_pri: $('#dep_id_pri').val(),
                role_id: $('#role_id').val(),
                status_id: $('#status_id').val(),
                searchtext: $('#searchtext').val(),
            },
            success: function (response) {
                $('#result-pagination').html(response);
            }
        });
    }
</script>