<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">
          <i class="<?php echo $icon; ?>"></i>&nbsp;<?php echo $title . ' - เลขที่เอกสาร' . ' '; ?><span class="text-muted"><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></span>
          <span style="float: right">
            <a href="<?php echo base_url() . 'withinprocess'; ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-arrow-left"></i> กลับ</a>
          </span>
        </h4>
        <hr>
        <div class="row">
          <div class="col-md-12 text-left">
            <div class="form-group row">
              <input type="hidden" name="work_process_id_pri" id="work_process_id_pri" value="<?php echo $work_process_id_pri; ?>">
              <div class="col-sm-1 text-center"></div>
              <div class="col-sm-5">
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">เลขทะเบียน :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo ($data->work_info_id != '' ? $data->work_info_id : '-'); ?></span>
                </div>
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">เลขที่เอกสาร :</span>
                  <span class="col-sm-7 col-form-span" style="font-weight: bold;font-size: 14px;"><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></span>
                </div>
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ลงวันที่ :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->misc->date2thai($data->work_info_date, '%d %m %y', 1); ?></span>
                </div>
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">จาก :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->work_info_from_position . ' ' . $data->work_info_from; ?></span>
                </div>
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ถึง :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo (($data->work_info_to_position != '') && ($data->work_info_to != '') ? $data->work_info_to_position . ' ' . $data->work_info_to : '-'); ?></span>
                </div>
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">เรื่อง :</span>
                  <span class="col-sm-7 col-form-span" style="font-weight: bold;font-size: 14px;"><?php echo $data->work_info_subject; ?></span>
                </div>
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">รายละเอียด :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->work_info_detail; ?></span>
                </div>
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">วัตถุประสงค์ :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->action_info_name; ?></span>
                </div>
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ส่งจาก :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->dep_name; ?></span>
                </div>
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">สถานะ :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;">
                    <?php if ($data->state_info_id == 5) { ?>
                      <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo $data->state_info_name; ?></span>
                    <?php } else if ($data->state_info_id == 6) { ?>
                      <span class="badge badge-success"><i class="fa fa-power-off"></i> <?php echo $data->state_info_name; ?></span>
                    <?php } else if ($data->state_info_id == 7) { ?>
                      <span class="badge badge-warning"><i class="fa fa-reply-all"></i> <?php echo $data->state_info_name; ?></span>
                    <?php } else if ($data->state_info_id == 8) { ?>
                      <span class="badge badge-danger"><i class="fa fa-reply-all"></i> <?php echo $data->state_info_name; ?></span>
                    <?php } else if ($data->state_info_id == 9) { ?>
                      <span class="badge badge-danger"><i class="fa fa-times-circle"></i> <?php echo $data->state_info_name; ?></span>
                    <?php } else { ?>
                      <span class="badge badge-info"><i class="fa fa-clock-o"></i> <?php echo $data->state_info_name; ?></span>
                    <?php } ?>
                  </span>
                </div>
              </div>
              <div class="col-sm-1 text-center"></div>
              <div class="col-sm-5">
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ประเภทเอกสาร :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->work_type_name; ?></span>
                </div>

                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ชั้นความเร็ว :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->priority_info_name; ?></span>
                </div>
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ชั้นความลับ :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->secret_level_name; ?></span>
                </div>
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">หมวดเอกสาร :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->book_group_name; ?></span>
                </div>
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ต้นฉบับ :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo ($data->attach_original == 0) ? 'ไม่ส่งต้นฉบับ' : 'ส่งต้นฉบับ'; ?></span>
                </div>
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">หมายเหตุ :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo ($data->work_info_comment != '') ? $data->work_info_comment : '-'; ?></span>
                </div>
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">สร้างโดย :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->user_fullname; ?></span>
                </div>
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">สร้างเมื่อ :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->misc->date2thai($data->work_info_create, '%d %m %y %h:%i', 1); ?></span>
                </div>
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">อัพเดทเมื่อ :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->misc->date2thai($data->work_info_update, '%d %m %y %h:%i', 1); ?></span>
                </div>
              </div>
              <div class="col-sm-1 m-t-0"></div>
              <div class="col-sm-10 m-t-0">
                <?php
                $files = $this->withinprocess_model->get_workinfofile($data->work_info_id_pri);
                ?>
                <div class="form-group row" style="margin-bottom: -10px;">
                  <span class="col-sm-2 col-form-span" style="font-weight: bold;font-size: 14px;">ไฟล์แนบ :</span>
                  <span class="col-sm-10 col-form-span" style="font-size: 14px;">
                    <?php
                    if ($files->num_rows() > 0) {
                      echo 'มีเอกสารแนบจำนวน ' . $files->num_rows() . ' รายการ<br><br>';
                    } else {
                      echo '<i class="fa fa-ban text-danger"></i>';
                    }
                    ?>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
        if ($this->withinprocess_model->checkworkprocess($work_process_id_pri)->num_rows() == 1) {
          $work_process = $this->withinprocess_model->getworkprocess($work_process_id_pri)->row();
        ?>
          <hr>
          <div class="row">
            <div class="col-md-12 text-left">
              <div class="form-group row">
                <div class="col-sm-1 text-center"></div>
                <div class="col-sm-5">
                  <div class="form-group row">
                    <span class="col-sm-4 col-form-span text-success" style="font-weight: bold;font-size: 14px;">เลขที่ลงรับหนังสือ :</span>
                    <span class="col-sm-7 col-form-span text-success" style="font-size: 14px;"><?php echo $work_process->work_process_receive_id; ?></span>
                  </div>
                </div>
                <div class="col-sm-1 text-center"></div>
                <div class="col-sm-5">
                  <div class="form-group row">
                    <span class="col-sm-4 col-form-span text-success" style="font-weight: bold;font-size: 14px;">ลงรับวันที่ :</span>
                    <span class="col-sm-7 col-form-span text-success" style="font-size: 14px;"><?php echo $this->misc->offsetyear($work_process->work_process_receive_date, 543) . ' ' . $this->misc->date2thai($work_process->work_process_receive_date, '%h:%i'); ?></span>
                  </div>
                </div>
                <div class="col-sm-1 text-center"></div>
                <div class="col-sm-5">
                  <div class="form-group row">
                    <span class="col-sm-4 col-form-span text-success" style="font-weight: bold;font-size: 14px;">ผู้ลงรับ :</span>
                    <span class="col-sm-7 col-form-span text-success" style="font-size: 14px;"><?php echo $work_process->work_process_receive_name; ?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php
        $workusers = $this->withinprocess_model->get_workuser($work_process_id_pri);
        if ($workusers->num_rows() > 0) {
          foreach ($workusers->result() as $workuser) {
        ?>
            <hr>
            <div class="row">
              <div class="col-md-12 text-left">
                <div class="form-group row">
                  <div class="col-sm-1 text-center"></div>
                  <div class="col-sm-5">
                    <div class="form-group row">
                      <span class="col-sm-4 col-form-span text-primary" style="font-weight: bold;font-size: 14px;">มอบให้ :</span>
                      <span class="col-sm-7 col-form-span text-primary" style="font-size: 14px;"><?php echo $this->withinprocess_model->get_user($workuser->user_id)->user_fullname; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-1 text-center"></div>
                  <div class="col-sm-5">
                    <div class="form-group row">
                      <span class="col-sm-4 col-form-span text-primary" style="font-weight: bold;font-size: 14px;">มอบวันที่ :</span>
                      <span class="col-sm-7 col-form-span text-primary" style="font-size: 14px;"><?php echo $this->misc->offsetyear($workuser->work_user_create, 543) . ' ' . $this->misc->date2thai($workuser->work_user_create, '%h:%i'); ?></span>
                    </div>
                  </div>
                  <div class="col-sm-1 text-center"></div>
                  <div class="col-sm-5">
                    <div class="form-group row">
                      <span class="col-sm-4 col-form-span text-primary" style="font-weight: bold;font-size: 14px;">สถานะ :</span>
                      <span class="col-sm-7 col-form-span text-primary" style="font-size: 14px;">
                        <?php if ($workuser->work_user_status_id == 1) { ?>
                          <span class="badge badge-warning"><i class="fa fa-clock-o"></i> รอดำเนินการ</span>
                        <?php } else if ($workuser->work_user_status_id == 2) { ?>
                          <span class="badge badge-primary"><i class="fa fa-hourglass-start"></i> ดำเนินการ</span>
                        <?php } else { ?>
                          <span class="badge badge-success"><i class="fa fa-check"></i> เสร็จสิ้น</span>
                        <?php } ?>
                      </span>
                    </div>
                  </div>
                  <div class="col-sm-1 text-center"></div>
                  <div class="col-sm-5">
                    <div class="form-group row">
                      <span class="col-sm-4 col-form-span text-primary" style="font-weight: bold;font-size: 14px;">รับวันที่ :</span>
                      <span class="col-sm-7 col-form-span text-primary" style="font-size: 14px;"><?php echo $this->misc->offsetyear($workuser->work_user_startdate, 543) . ' ' . $this->misc->date2thai($workuser->work_user_startdate, '%h:%i'); ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        <?php
          }
        }
        ?>
        <hr>
        <div class="row">
          <div class="col-md-12 text-right">
            <a href="<?php echo base_url() . 'withinprocess/attach/' . $work_process_id_pri; ?>" class="btn btn-info"><i class="fa fa-paperclip"></i>&nbsp;เพิ่มไฟล์เอกสาร</a>
            <a href="<?php echo base_url() . 'printout/docketprocess/' . $data->work_info_code; ?>" class="btn btn-success fancyboxpdf" target="_blank"><i class="fa fa-print"></i>&nbsp;พิมพ์เอกสาร</a>
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
          <i class="fa fa-paperclip"></i>&nbsp;<?php echo 'ไฟล์เอกสาร - เลขที่เอกสาร' . ' '; ?><span class="text-muted"><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></span>
        </h4>
        <hr>
        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th class="text-right" width="3%">#</th>
                    <th class="text-center" width="7%">ไฟล์</th>
                    <th>ชื่อไฟล์</th>
                    <th width="20%">เพิ่มโดย</th>
                    <th width="20%">ตำแหน่ง</th>
                    <th width="13%">ผู้เพิ่ม</th>
                    <th class="text-center" width="15%">เพิ่มเมื่อ</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  if ($files->num_rows() > 0) {
                    foreach ($files->result() as $file) { ?>
                      <tr>
                        <td class="text-right"><?php echo $i; ?></td>
                        <td class="text-center">
                          <a style="padding-right: 5px" href="<?php echo base_url() . 'store/file/' . $file->work_info_file_id; ?>" title="<?php echo $file->work_info_file_oldname; ?>" class="<?php echo ($file->file_type_check != 2) ? ($file->file_type_check != 1) ? 'fancybox' : 'fancyboxpdf' : ''; ?>" target="_blank">
                            <img id="icon_show" src="<?php echo base_url() . 'store/icon/' . $file->file_type_icon; ?>" style="padding: 0px" width="26px" style="cursor:pointer; border: 0px solid whitesmoke">
                          </a>
                        </td>
                        <td><a style="padding-right: 5px" href="<?php echo base_url() . 'store/file/' . $file->work_info_file_id; ?>" title="<?php echo $file->work_info_file_oldname; ?>" class="<?php echo ($file->file_type_check != 2) ? ($file->file_type_check != 1) ? 'fancybox' : 'fancyboxpdf' : ''; ?>" target="_blank">
                            <?php echo $file->work_info_file_oldname; ?>
                          </a></td>
                        <td colspan="2">ต้นเรื่อง</td>
                        <td><?php echo $this->withinprocess_model->get_user($file->user_id)->user_fullname; ?></td>
                        <td class="text-center"><?php echo $this->misc->offsetyear($file->work_info_file_create, 543) . ' ' . $this->misc->date2thai($file->work_info_file_create, '%h:%i'); ?></td>
                      </tr>
                    <?php
                      $i++;
                    }
                  }
                  $workprocessfiles = $this->withinprocess_model->get_workprocessfofile($work_process_id_pri);
                  if ($workprocessfiles->num_rows() > 0) {
                    foreach ($workprocessfiles->result() as $workprocessfile) {
                    ?>
                      <tr>
                        <td class="text-right"><?php echo $i; ?></td>
                        <td class="text-center">
                          <a style="padding-right: 5px" href="<?php echo base_url() . 'store/workprocessfile/' . $workprocessfile->work_process_file_id; ?>" title="Item Title" class="<?php echo ($workprocessfile->file_type_check != 2) ? ($workprocessfile->file_type_check != 1) ? 'fancybox' : 'fancyboxpdf' : ''; ?>" target="_blank">
                            <img id="icon_show" src="<?php echo base_url() . 'store/icon/' . $workprocessfile->file_type_icon; ?>" style="padding: 0px" width="26px" style="cursor:pointer; border: 0px solid whitesmoke">
                          </a>
                        </td>
                        <td><a style="padding-right: 5px" href="<?php echo base_url() . 'store/workprocessfile/' . $workprocessfile->work_process_file_id; ?>" title="Item Title" class="<?php echo ($workprocessfile->file_type_check != 2) ? ($workprocessfile->file_type_check != 1) ? 'fancybox' : 'fancyboxpdf' : ''; ?>" target="_blank">
                            <?php echo $workprocessfile->work_process_file_oldname; ?>
                          </a></td>
                        <?php
                        if ($workprocessfile->work_process_file_send == 1) {
                          echo '<td colspan="2">ต้นเรื่อง (เอกสารเพิ่มเติม)</td>';
                        } else {
                          $dep_off = $this->withinprocess_model->getdep_off_id($workprocessfile->dep_off_id);
                          echo '<td>' . $dep_off->dep_name . '</td><td>' . $dep_off->officer_name . '</td>';
                        }
                        ?>
                        <td><?php echo $this->withinprocess_model->get_user($workprocessfile->user_id)->user_fullname; ?></td>
                        <td class="text-center"><?php echo $this->misc->offsetyear($workprocessfile->work_process_file_create, 543) . ' ' . $this->misc->date2thai($workprocessfile->work_process_file_create, '%h:%i'); ?></td>
                      </tr>
                    <?php
                      $i++;
                    }
                  }
                  if ($i == 1) {
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
</script>