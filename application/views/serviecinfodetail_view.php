<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">
          <i class="<?php echo $icon; ?>"></i>&nbsp;<?php echo $title . ' Ticket ID ' . $service_info_id_pri; ?></span>
          <span style="float: right">
            <a href="<?php echo base_url() . 'serviecinfo'; ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-arrow-left"></i> กลับ</a>
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
            <hr>
            <div class="row">
              <div class="col-sm-12 text-right">
                <?php if ($serviceinfo->service_status_id != 0 && $serviceinfo->service_status_id < 4) { ?>
                  <button type="button" class="btn btn-danger" onclick="modal_cancel();"><i class="fa fa-times-circle-o"></i>&nbsp;ยกเลิก</button>
                <?php } else if ($serviceinfo->service_status_id == 4) { ?>
                  <button type="button" class="btn btn-info" onclick="modal_evaluate();"><i class="fa fa-thumbs-up"></i>&nbsp;ประเมินความพึ่งพอใจ</button>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php if ($data->num_rows() > 0) { ?>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">
            <i class="mdi mdi-screwdriver"></i>&nbsp;<?php echo 'การดำเนินงานแก้ไข'; ?></span>
          </h4>
          <hr>
          <div class="m-t-20">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>ตอบกลับ</th>
                    <th class="text-right">เมื่อ</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  if ($data->num_rows() > 0) {
                    foreach ($data->result() as $row) {
                  ?>
                      <tr>
                        <td>
                          <?php
                          if ($row->user_id != null) {
                            $fullname = $this->serviecinfo_model->get_uesr_id($row->user_id)->row()->user_fullname;
                          } else {
                            $fullname = 'ระบบอัตโนมัติ';
                          }
                          ?>
                          <span class="text-info" style="font-weight: bold"><?php echo $fullname; ?></span><?php echo ' ' . $row->service_user_comment; ?>
                        </td>
                        <td class="text-right">
                          <i><?php echo $this->misc->date2thai($row->service_user_create, '%d %m %y เวลา %h:%i น.', 1); ?></i>
                        </td>
                      </tr>
                    <?php
                      $i++;
                    }
                  }
                  if ($serviceinfo->service_inf_evaluate_id != 0) {
                    $evaluate = 'ดีมาก';
                    $text = 'text-success';
                    if ($serviceinfo->service_inf_evaluate_id == 1) {
                      $evaluate = 'ไม่พอใจ';
                      $text = 'text-danger';
                    } else if ($serviceinfo->service_inf_evaluate_id == 2) {
                      $evaluate = 'พอใจ';
                      $text = 'text-warning';
                    } else if ($serviceinfo->service_inf_evaluate_id == 3) {
                      $evaluate = 'ค่อนข้างดี';
                      $text = 'text-warning';
                    } else if ($serviceinfo->service_inf_evaluate_id == 4) {
                      $evaluate = 'ดี';
                      $text = 'text-success';
                    }
                    ?>
                    <tr>
                      <td>
                        <span class="<?php echo $text; ?>" style="font-weight: bold"><?php echo 'ผลประเมิน ' . $evaluate; ?></span><?php echo ' ' . $serviceinfo->service_inf_evaluate; ?>
                      </td>
                      <td class="text-right">
                        <i><?php echo $this->misc->date2thai($serviceinfo->service_inf_evaluate_date, '%d %m %y เวลา %h:%i น.', 1) ?></i>
                      </td>
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
  </div>
<?php } ?>
<div id="modal_cancel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_modal_cancel" method="post" action="<?php echo base_url('serviecinfo/edit_cancel'); ?>" enctype="multipart/form-data" autocomplete="off">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fa fa-times-circle"></i> ยกเลิก</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <div class="bootbox-body text-center text-danger">
            <b>ปรับสถานะยกเลิก</b>
          </div>
          <input type="hidden" name="service_info_id_pri_modal" value="<?php echo $service_info_id_pri; ?>">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div id="modal_evaluate" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_modal_evaluate" method="post" action="<?php echo base_url('serviecinfo/evaluate'); ?>" enctype="multipart/form-data" autocomplete="off">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fa fa-thumbs-up"></i> ประเมินความพึ่งพอใจ</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label">ระดับความพึ่งพอใจ</label>
            <select name="service_inf_evaluate_id" class="form-control form-control-sm" required="">
              <option value="">เลือกระดับความพึ่งพอใจ</option>
              <option value="5">ดีมาก</option>
              <option value="4">ดี</option>
              <option value="3">ค่อนข้างดี</option>
              <option value="2">พอใจ</option>
              <option value="1">ไม่พอใจ</option>
            </select>
            <label class="control-label m-t-10">บันทึกงานเพิ่มเติม</label>
            <textarea name="service_inf_evaluate" id="service_inf_evaluate" class="form-control form-control-sm" rows="4"></textarea>
            <input type="hidden" name="service_info_id_pri_modal" value="<?php echo $service_info_id_pri; ?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('.fancybox').fancybox({
      padding: 0,
      helpers: {
        title: {
          type: 'outside'
        }
      }
    });
    if (/Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
      $("a").removeClass("fancyboxpdf");
    } else {
      $('.fancyboxpdf').fancybox({
        width: "100%",
        padding: 0,
        helpers: {
          title: {
            type: 'outside'
          }
        },
        autoSize: true,
        iframe: {
          preload: false
        },
        type: 'iframe'
      });
    }
  });

  function modal_cancel() {
    $('#form_modal_cancel').parsley();
    $('#modal_evaluate').modal('hide');
    $('#modal_cancel').modal('show', {
      backdrop: 'true'
    });
  }

  function modal_evaluate() {
    $('#form_modal_evaluate').parsley();
    $('#modal_cancel').modal('hide');
    $('#modal_evaluate').modal('show', {
      backdrop: 'true'
    });
  }
</script>