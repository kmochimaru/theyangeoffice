<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i>&nbsp;<?php echo $title . ' Ticket ID ' . $service_info_id_pri; ?></span>
                    <span style="float: right">
                        <a href="<?php echo base_url() . 'servieclist/detail/' . $service_info_id_pri; ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-arrow-left"></i> กลับ</a>
                    </span>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-md-12 text-left">
                        <div class="form-group row">
                            <input type="hidden" name="service_info_id_pri" id="service_info_id_pri" value="<?php echo $service_info_id_pri; ?>">
                            <div class="col-sm-1 text-center"></div>
                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">กลุ่มงานแก้ไขและบริการ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $serviceinfo->service_group_name; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ปัญหาที่พบ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $serviceinfo->service_info_suject; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">รายละเอียด :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $serviceinfo->service_info_detail; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">แจ้งเมื่อ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->misc->date2thai($serviceinfo->service_info_create, '%d %m %y เวลา %h:%i น.', 1); ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">สถานะ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><label class="badge badge-dark"><?php echo $serviceinfo->service_status_name; ?></label></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ไฟล์แนบ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;">
                                        <?php
                                        $check = 0;
                                        $service_info_file = $serviceinfo->service_info_file_1;
                                        if ($service_info_file != null) {
                                            $check = 1;
                                            $type = explode(".", $service_info_file);
                                        ?>
                                            <a style="padding-right: 5px" href="<?php echo base_url() . 'assets/upload/service/' . $service_info_file; ?>" class="<?php echo ($type[1] == 'jpg' || $type[1] == 'png' || $type[1] == 'pdf') ? ($type[1] != 'pdf') ? 'fancybox' : 'fancyboxpdf' : ''; ?>" target="_blank">
                                                <img class="img-thumbnail" src="<?php echo base_url() . 'assets/upload/service/' . $service_info_file; ?>" width="100px" style="height: 100px; padding: 0px; cursor:pointer; border: 0px solid whitesmoke;">
                                            </a>
                                        <?php
                                        }
                                        $service_info_file = $serviceinfo->service_info_file_2;
                                        if ($service_info_file != null) {
                                            $check = 1;
                                            $type = explode(".", $service_info_file);
                                        ?>
                                            <a style="padding-right: 5px" href="<?php echo base_url() . 'assets/upload/service/' . $service_info_file; ?>" class="<?php echo ($type[1] == 'jpg' || $type[1] == 'png' || $type[1] == 'pdf') ? ($type[1] != 'pdf') ? 'fancybox' : 'fancyboxpdf' : ''; ?>" target="_blank">
                                                <img class="img-thumbnail" src="<?php echo base_url() . 'assets/upload/service/' . $service_info_file; ?>" width="100px" style="height: 100px; padding: 0px; cursor:pointer; border: 0px solid whitesmoke;">
                                            </a>
                                        <?php
                                        }
                                        $service_info_file = $serviceinfo->service_info_file_3;
                                        if ($service_info_file != null) {
                                            $check = 1;
                                            $type = explode(".", $service_info_file);
                                        ?>
                                            <a style="padding-right: 5px" href="<?php echo base_url() . 'assets/upload/service/' . $service_info_file; ?>" class="<?php echo ($type[1] == 'jpg' || $type[1] == 'png' || $type[1] == 'pdf') ? ($type[1] != 'pdf') ? 'fancybox' : 'fancyboxpdf' : ''; ?>" target="_blank">
                                                <img class="img-thumbnail" src="<?php echo base_url() . 'assets/upload/service/' . $service_info_file; ?>" width="100px" style="height: 100px; padding: 0px; cursor:pointer; border: 0px solid whitesmoke;">
                                            </a>
                                        <?php
                                        }
                                        $service_info_file = $serviceinfo->service_info_file_4;
                                        if ($service_info_file != null) {
                                            $check = 1;
                                            $type = explode(".", $service_info_file);
                                        ?>
                                            <a style="padding-right: 5px" href="<?php echo base_url() . 'assets/upload/service/' . $service_info_file; ?>" class="<?php echo ($type[1] == 'jpg' || $type[1] == 'png' || $type[1] == 'pdf') ? ($type[1] != 'pdf') ? 'fancybox' : 'fancyboxpdf' : ''; ?>" target="_blank">
                                                <img class="img-thumbnail" src="<?php echo base_url() . 'assets/upload/service/' . $service_info_file; ?>" width="100px" style="height: 100px; padding: 0px; cursor:pointer; border: 0px solid whitesmoke;">
                                            </a>
                                        <?php
                                        }
                                        $service_info_file = $serviceinfo->service_info_file_5;
                                        if ($service_info_file != null) {
                                            $check = 1;
                                            $type = explode(".", $service_info_file);
                                        ?>
                                            <a style="padding-right: 5px" href="<?php echo base_url() . 'assets/upload/service/' . $service_info_file; ?>" class="<?php echo ($type[1] == 'jpg' || $type[1] == 'png' || $type[1] == 'pdf') ? ($type[1] != 'pdf') ? 'fancybox' : 'fancyboxpdf' : ''; ?>" target="_blank">
                                                <img class="img-thumbnail" src="<?php echo base_url() . 'assets/upload/service/' . $service_info_file; ?>" width="100px" style="height: 100px; padding: 0px; cursor:pointer; border: 0px solid whitesmoke;">
                                            </a>
                                        <?php
                                        }
                                        if ($check == 0) {
                                            echo '<i class="fa fa-ban text-danger"></i>';
                                        }
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-1 text-center"></div>
                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">งานแก้ไขและบริการ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $serviceinfo->service_name; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ชื่อผู้แจ้งปัญหา :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $serviceinfo->user_fullname; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">สถานที่ซ่อม / ติดต่อกลับได้ที่ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $serviceinfo->service_info_contacts; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">หมายเลขครุภัณฑ์ / TeamViewer / อื่นๆ :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $serviceinfo->service_info_comment; ?></span>
                                </div>
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ชั้นความเร็ว :</span>
                                    <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $serviceinfo->priority_info_name; ?></span>
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
                    <i class="fa fa-send"></i>&nbsp;<?php echo 'ส่งต่องาน'; ?>
                </h4>
                <hr>
                <form id="from_add" class="form-horizontal" method="post" autocomplete="off">
                    <input type="hidden" name="service_info_id_pri" value="<?php echo $service_info_id_pri; ?>">
                    <div class="row">
                        <div class=" col-md-12 text-left">
                            <select id="user_id" name="user_id_select[]" multiple="multiple">
                                <?php
                                $deps = $this->servieclist_model->getDepartment();
                                if ($deps->num_rows() > 0) {
                                    foreach ($deps->result() as $dep) {
                                        $users = $this->servieclist_model->get_userdep($dep->dep_id_pri);
                                        if ($users->num_rows() > 0) {
                                            foreach ($users->result() as $user) {
                                ?>
                                                <option value="<?php echo $user->user_id; ?>" data-section="<?php echo $dep->dep_name; ?>" data-index="1"><?php echo $user->user_fullname; ?></option>
                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <hr />
                    <div id="modal_send" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"> ยืนยันการงต่องาน</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="bootbox-body text-center">
                                        <p class="text-center" style="font-weight: bold;">ยืนยันการงต่องาน ใช่หรือไม่</p>
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
                                    <h4 class="modal-title"> ยืนยันการงต่องาน</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="bootbox-body text-center">
                                        <p class="text-center" style="font-weight: bold;">กรุณาเลือกผู้ที่ต้องการส่งต่องาน</p>
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
                            <button type="button" class="btn btn-info" onclick="modal_send();"><i class="fa fa-send"></i>&nbsp;ส่งต่องาน</button>
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
    $("#user_id").treeMultiselect({
        allowBatchSelection: true,
        enableSelectAll: true,
        searchable: true,
        sortable: false,
        startCollapsed: true
    });

    function modal_send() {
        if ($("[name='user_id_select[]']").val().length > 0) {
            $('#modal_send').modal('show', {
                backdrop: 'true'
            });
            $('#modal_send_0').modal('hide');
        } else {
            $('#modal_send_0').modal('show', {
                backdrop: 'true'
            });
            $('#modal_send').modal('hide');
        }
    }

    $('#from_add').submit(function(e) {
        $('#btn_update').prop('disabled', true);
        $('#btn-modal-submit-loading').show();
        e.preventDefault()
        var postData = new FormData($(this)[0])
        $.ajax({
            url: '<?php echo base_url() . 'servieclist/sendto'; ?>',
            type: 'POST',
            data: postData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#modal_send').modal('hide');
                // console.log(response);
                if (response == 0) {
                    $('#btn_update').prop('disabled', false);
                    $('#btn-modal-submit-loading').hide();
                    notification('error', 'ไม่สำเร็จ', 'เพิ่มข้อมูลไม่สำเร็จ ลองใหม่อีกครั้ง');
                } else {
                    //notification('success', 'สำเร็จ', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
                    window.location.href = '<?php echo base_url() . 'servieclist/detail/'; ?>' + $('#service_info_id_pri').val();
                }
            }
        })
    })
</script>