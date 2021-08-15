<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-user"></i> <?php echo " " . $title; ?>
                    <span style="float: right">                        
                        <button type="button" class="btn btn-sm btn-rounded btn-outline-success" onclick="modal_add();"><i class="fa fa-plus"></i> เพิ่มผู้ใช้ระบบ</button>                        
                    </span>
                </h4>
                <div class="row m-t-20">
                    <div class="col-sm-3">
                        <label style="font-weight: bold;">สิทธิ์ </label>
                        <select id="role_id" class="form-control form-control-sm" data-placeholder="ทั้งหมด" onchange="ajax_pagination()">
                            <option value="0">ทั้งหมด</option>
                            <?php foreach ($this->user_model->get_role()->result() as $role) { ?>
                                <option value="<?php echo $role->role_id; ?>"><?php echo $role->role_name; ?></option>
                            <?php } ?>
                        </select> 
                    </div>
                    <div class="col-sm-3">
                        <label style="font-weight: bold;">สถานะ </label>
                        <select id="user_status_id" class="form-control form-control-sm" data-placeholder="ทั้งหมด" onchange="ajax_pagination()">
                            <option value="0">ทั้งหมด</option>
                            <?php foreach ($this->user_model->get_user_status()->result() as $sts) { ?>
                                <option value="<?php echo $sts->user_status_id; ?>"><?php echo $sts->user_status_name; ?></option>
                            <?php } ?>
                        </select>    
                    </div>
                    <div class="col-lg-3">
                        <label style="font-weight: bold;">ค้นหา </label>
                        <div class="input-group">
                            <input type="text" id="searchtext" class="form-control form-control-sm" placeholder="คำค้นหา">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-sm btn-info" onclick="ajax_pagination()">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <label style="font-weight: bold;">จำนวนต่อหน้า </label>
                        <select id="per_page" class="form-control form-control-sm" onchange="ajax_pagination()">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
                <div id="result-pagination" class="m-t-20" style="min-height: 400px;"></div>
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
    });

    $('#searchtext').keypress(function (e) {
        if (e.which == 13) {
            ajax_pagination();
        }
    });

    function ajax_pagination() {
        $('#result-pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'user/ajax_pagination',
            type: 'POST',
            data: {
                role_id: $('#role_id').val(),
                user_status_id: $('#user_status_id').val(),
                searchtext: $('#searchtext').val(),
                per_page: $('#per_page').val()
            },
            success: function (response) {
                $('#result-pagination').html(response);
            }
        });
    }

    function modal_add() {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'user/add_user_modal',
            type: 'POST',
            data: {},
            success: function (response) {
                $('#result-modal-lg .modal-content').html(response);
                $('#form-modal').parsley().reset();
                $('#btn-submit').prop('disabled', true);
                $('#result-modal-lg').modal('show', {backdrop: 'true'});
            }
        });
    }

    function modal_edit(user_id) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'user/edit_user_modal',
            type: 'POST',
            data: {
                user_id: user_id
            },
            success: function (response) {
                $('#result-modal-lg .modal-content').html(response);
                $('#form-modal').parsley().reset();
                $('#btn-submit').prop('disabled', true);
                $('#result-modal-lg').modal('show', {backdrop: 'true'});
            }
        });
    }

    function modal_edit_status(user_id) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'user/status_user_modal',
            type: 'POST',
            data: {
                user_id: user_id
            },
            success: function (response) {
                $('#result-modal .modal-content').html(response);
                $('#result-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

    function modal_edit_password(user_id) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'user/password_user_modal',
            type: 'POST',
            data: {
                user_id: user_id
            },
            success: function (response) {
                $('#result-modal .modal-content').html(response);
                $('#form-modal').parsley().reset();
                $('#result-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

</script>