<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i>&nbsp;<?php echo $title . ' - เลขที่เอกสาร' . ' '; ?><span class="text-muted"><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></span>
                    <span style="float: right">
                        <a href="<?php echo base_url() . 'actingwaiting'; ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-arrow-left"></i> กลับ</a>
                    </span>
                </h4>
                <hr>
                <div class="row">
                    <div class=" col-md-12 text-left">
                        <div class="form-group row">
                            <div class="col-sm-1 text-center"></div>
                            <div class="col-sm-5"> 
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ประเภทเอกสาร :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->actingwaiting_model->ref_work_type($data->work_type_id)->row()->work_type_name; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">เลขที่เอกสาร :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">จาก :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->work_info_from_position . '' . $data->work_info_from; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ถึง :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->work_info_to_position . '' . $data->work_info_to; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">เรื่อง :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->work_info_subject; ?></span>
                                </div>
                            </div>
                            <div class="col-sm-1 text-center"></div>
                            <div class="col-sm-5"> 
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ลงวันที่ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->misc->offsetyear($data->work_info_date, 543); ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ชั้นความเร็ว :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->actingwaiting_model->ref_priority_info($data->priority_info_id)->row()->priority_info_name; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ชั้นความลับ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->actingwaiting_model->ref_secret_level($data->secret_level_id)->row()->secret_level_name; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">หมวดเอกสาร :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->actingwaiting_model->ref_book_group($data->book_group_id)->row()->book_group_name; ?></span>
                                </div>
                                
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-send"></i>&nbsp;<?php echo 'ส่งถึงหน่วยงาน : ส่งตามลำดับเส้นทาง'; ?>
                </h4>
                <hr>
                <div class="row"  style="margin-left: -5px;">
                    <div class=" col-md-12">
                        <?php
                        $routes = $this->actingwaiting_model->get_routes();
                        if ($routes->num_rows() > 0) {
                            foreach ($routes->result() as $route) {
                                ?>
                                <button class="btn btn-outline-inverse btn-sm" style="margin-right: 10px;" onclick="routes(<?php echo $route->routes_id; ?>)"><?php echo $route->routes_name ?></button>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <form id="from_add" class="form-horizontal" method="post" autocomplete="off">
                    <div class="row">
                        <div class=" col-md-12 text-left">
                            <input type="hidden" name="work_info_id_pri" id="work_info_id_pri" value="<?php echo $data->work_info_id_pri; ?>">
                            <div id="result-pagination">

                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div id="modal_send" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"> ยืนยันการส่งหนังสือ</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="bootbox-body text-center">
                                        <p class="text-center" style="font-weight: bold;">ยืนยันการส่งหนังสือ เลขที่เอกสาร <?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?> ใช่หรือไม่</p>
                                        <input type="hidden" id="work_process_sendtype" name="work_process_sendtype">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="btn_update" class="btn btn-info"><span id="btn-modal-submit-loading" style="display: none;"><i class="fa fa-spinner fa-spin"></i> </span> ทำการส่ง</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="modal_send_0" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"> ยืนยันการส่งหนังสือ</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="bootbox-body text-center">
                                        <p class="text-center" style="font-weight: bold;">กรุณาเลือกหน่วยงานที่ต้องการส่ง</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-right">
                            <button type="button" class="btn btn-success" onclick="modal_send(2);"><i class="fa fa-send-o"></i>&nbsp;ส่งตามลำดับเส้นทาง</button>
                        </div>
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
        sendsort();
    });

//    $("#def_id_pri").treeMultiselect({
//        allowBatchSelection: true,
//        enableSelectAll: true,
//        searchable: true,
//        sortable: false,
//        startCollapsed: true,
//    });

    function sendsort(routes_id) {
        $('#result-pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'routes/send_page',
            type: 'POST',
            data: {routes_id: routes_id},
            success: function (response) {
                $('#result-pagination').html(response);
            }
        });
    }

    function routes(routes_id) {
        $('#result-pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'routes/routes_page',
            type: 'POST',
            data: {routes_id: routes_id},
            success: function (response) {
                $('#result-pagination').html(response);
            }
        });
    }

    function modal_send(type) {
        if ($("[name='def_id_pri_select[]']").val().length > 0) {
            $('#modal_send').modal('show', {backdrop: 'true'});
            $('#modal_send_0').modal('hide');
            $('#work_process_sendtype').val(type);
        } else {
            $('#modal_send_0').modal('show', {backdrop: 'true'});
            $('#modal_send').modal('hide');
        }
    }

    $('#from_add').submit(function (e) {
        $('#btn_update').prop('disabled', true);
        $('#btn-modal-submit-loading').show();
        e.preventDefault()
        var postData = new FormData($(this)[0]);
        if ($('#work_process_sendtype').val() == 1) {
            url = '<?php echo base_url() . 'actingwaiting/sendto'; ?>'
        } else {
            url = '<?php echo base_url() . 'actingwaiting/sendtosort'; ?>'
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: postData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('#modal_send').modal('hide');
                $('#btn_update').prop('disabled', false);
                $('#btn-modal-submit-loading').hide();
                // console.log(response);
                if (response == 0) {
                    notification('error', 'ไม่สำเร็จ', 'เพิ่มข้อมูลไม่สำเร็จ ลองใหม่อีกครั้ง');
                } else {
                    //notification('success', 'สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
                    window.location.href = '<?php echo base_url() . 'actingwaiting'; ?>';
                }
            }
        })
    })

</script>
