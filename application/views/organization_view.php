<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <span style="float: right">
                        <button type="button" class="btn btn-sm btn-rounded btn-outline-success" onclick="modal_add();"><i class="fa fa-plus"></i> เพิ่ม<?php echo $title; ?></button>
                    </span>
                </h4>
                <div class="row m-t-20">
                    <div class="col-lg-3">
                        <div class="input-group">
                            <input type="text" id="searchtext" class="form-control form-control-sm" placeholder="คำค้นหา">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-sm btn-info" onclick="ajax_page()">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="result-page" class="m-t-20"></div>
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
        ajax_page();
    });

    $('#searchtext').keypress(function (e) {
        if (e.which == 13) {
            ajax_page();
        }
    });

    function ajax_page() {
        $('#result-page').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'organization/ajax_page',
            type: 'POST',
            data: {
                searchtext: $('#searchtext').val()
            },
            success: function (response) {
                $('#result-page').html(response);
            }
        });
    }

    function modal_add() {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'organization/add_organization_modal',
            type: 'POST',
            data: {

            },
            success: function (response) {
                $('#result-modal .modal-content').html(response);
                $('#form-modal').parsley().reset();
                $('#result-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

    function modal_edit(org_id_pri) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'organization/edit_organization_modal',
            type: 'POST',
            data: {
                org_id_pri: org_id_pri
            },
            success: function (response) {
                $('#result-modal .modal-content').html(response);
                $('#form-modal').parsley().reset();
                $('#result-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

    function modal_edit_status(org_id_pri) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'organization/status_organization_modal',
            type: 'POST',
            data: {
                org_id_pri: org_id_pri
            },
            success: function (response) {
                $('#result-modal .modal-content').html(response);
                $('#result-modal').modal('show', {backdrop: 'true'});
            }
        });
    }
    
    function modal_delete(org_id_pri) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'organization/delete_organization_modal',
            type: 'POST',
            data: {
                org_id_pri: org_id_pri
            },
            success: function (response) {
                $('#result-modal .modal-content').html(response);
                $('#result-modal').modal('show', {backdrop: 'true'});
            }
        });
    }
</script>