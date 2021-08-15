<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> <?php echo " - " . $service_group->service_group_name . " - " . $service->service_name; ?>
                </h4>              
                <div class="row m-t-20">
                    <div class="col-sm-3">
                        <label class="control-label" style="font-weight: bold;">หน่วยงาน</label>
                        <select name="dep_id_pri" id="dep_id_pri" class="select2 form-control custom-select" style="width: 100%;" data-placeholder="หน่วยงานทั้งหมด" onchange="ajax_page()">
                            <option value=""></option>
                            <?php
                            foreach ($this->servicegroup_model->get_department()->result() as $row) {
                                ?>
                                <option value="<?php echo $row->dep_id_pri; ?>"><?php echo $row->dep_name . ' ( ' . $row->dep_name_short . ' ) '; ?></option>
                                <?php
                            }
                            ?>
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
                <form class="form-horizontal" id="form_add" method="post" action="<?php echo base_url() . 'servicegroup/adduserhelpdesk'; ?>" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="service_group_id" id="service_group_id" value="<?php echo $service_group_id ?>" />
                    <input type="hidden" name="service_id" id="service_id" value="<?php echo $service_id ?>" />
                    <div id="result-page" class="m-t-20">

                    </div>
                    <div class="col-md-12 m-t-20 m-b-10 text-center">
                        <button type="submit" class="btn btn-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                        <button type="reset" class="btn btn-default" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                    </div>
                </form>
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
        $(".select2").select2();
    });

    $('#searchtext').keypress(function (e) {
        if (e.which == 13) {
            ajax_page();
        }
    });

    function ajax_page() {
        $('#result-page').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'servicegroup/ajax_page',
            type: 'POST',
            data: {
                dep_id_pri: $('#dep_id_pri').val(),
                searchtext: $('#searchtext').val(),
                service_group_id: $('#service_group_id').val(),
                service_id: $('#service_id').val(),
            },
            success: function (response) {
                $('#result-page').html(response);
            }
        });
    }
</script>