<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">
          <i class="<?php echo $icon; ?>"></i>&nbsp;<?php echo $title . ' - เลขที่เอกสาร' . ' '; ?><span class="text-muted"><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></span>
          <span style="float: right">
            <a href="<?php echo base_url() . 'receivework'; ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-arrow-left"></i> กลับ</a>
          </span>
        </h4>
        <hr>
        <div class="row">
          <div class="col-md-12 text-left">
            <div class="form-group row">
              <input type="hidden" name="work_user_id" id="work_process_id_pri" value="<?php echo $work_user_id; ?>">
              <input type="hidden" name="work_process_id_pri" id="work_process_id_pri" value="<?php echo $workuser->work_process_id_pri; ?>">
              <input type="hidden" name="work_process_sendtype" id="work_process_sendtype" value="<?php echo $workuser->work_process_sendtype; ?>">
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
                $files = $this->receivework_model->get_workinfofile($data->work_info_id_pri);
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
            <hr>
            <div class="row">
              <div class="col-sm-1 text-center"></div>
              <div class="col-sm-5">
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">บันทึกงาน :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;">
                    <?php echo $workuser->work_user_comment; ?>
                  </span>
                </div>
              </div>
              <div class="col-sm-1 text-center"></div>
              <div class="col-sm-5">
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">สถานะงาน :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 16px;">
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
            </div>
            <div class="row">
              <div class="col-sm-1 text-center"></div>
              <div class="col-sm-5">
                <div class="form-group row">
                  <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">รายงานผล :</span>
                  <span class="col-sm-7 col-form-span" style="font-size: 14px;">
                    <?php echo $workuser->work_user_report; ?>
                  </span>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-12 text-right">
                <?php if ($workuser->work_user_status_id == 2) { ?>
                  <button type="button" class="btn btn-success" onclick="modal_userstatus();"><i class="fa fa-check-circle"></i>&nbsp;รายงานผล</button>
                <?php } ?>
                <button type="button" class="btn btn-primary" onclick="modal_comment();"><i class="fa fa-pencil-square-o"></i>&nbsp;บันทึกงาน</button>
                <a href="<?php echo base_url() . 'receivework/attach/' . $work_user_id; ?>" class="btn btn-info"><i class="fa fa-paperclip"></i>&nbsp;เพิ่มไฟล์เอกสาร</a>
                <a href="<?php echo base_url() . 'printout/docketprocess/' . $data->work_info_code; ?>" class="btn btn-success fancyboxpdf" target="_blank"><i class="fa fa-print"></i>&nbsp;พิมพ์เอกสาร</a>
                <!--<button type="button" class="btn btn-danger" onclick=""><i class="fa fa-reply"></i>&nbsp;คืนหนังสือ</button>-->
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
                  $files = $this->receivework_model->get_workinfofile($data->work_info_id_pri);
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
                        <td><?php echo $this->receivework_model->get_user($file->user_id)->user_fullname; ?></td>
                        <td class="text-center"><?php echo $this->misc->offsetyear($file->work_info_file_create, 543) . ' ' . $this->misc->date2thai($file->work_info_file_create, '%h:%i'); ?></td>
                      </tr>
                      <?php
                      $i++;
                    }
                  }
                  $workprocessfiles = $this->receivework_model->get_workprocessfofile($data->work_info_id_pri);
                  if ($workprocessfiles->num_rows() > 0) {
                    if ($this->receivework_model->check_workprocessfofileinfo($data->work_info_id_pri) > 0 || $this->receivework_model->check_workprocessfofileprocess($workuser->work_process_id_pri) > 0) {
                      foreach ($workprocessfiles->result() as $workprocessfile) {
                        if ($workprocessfile->work_process_file_send == 1) {
                          if ($workprocessfile->work_process_id_pri == $workuser->work_process_id_pri) { ?>
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
                                $dep_off = $this->receivework_model->getdep_off_id($workprocessfile->dep_off_id);
                                echo '<td>' . $dep_off->dep_name . '</td><td>' . $dep_off->officer_name_display . '</td>';
                              }
                              ?>
                              <td><?php echo $this->receivework_model->get_user($workprocessfile->user_id)->user_fullname; ?></td>
                              <td class="text-center"><?php echo $this->misc->offsetyear($workprocessfile->work_process_file_create, 543) . ' ' . $this->misc->date2thai($workprocessfile->work_process_file_create, '%h:%i'); ?></td>
                            </tr>
                          <?php
                            $i++;
                          }
                        } else {
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
                              $dep_off = $this->receivework_model->getdep_off_id($workprocessfile->dep_off_id);
                              echo '<td>' . $dep_off->dep_name . '</td><td>' . $dep_off->officer_name_display . '</td>';
                            }
                            ?>
                            <td><?php echo $this->receivework_model->get_user($workprocessfile->user_id)->user_fullname; ?></td>
                            <td class="text-center"><?php echo $this->misc->offsetyear($workprocessfile->work_process_file_create, 543) . ' ' . $this->misc->date2thai($workprocessfile->work_process_file_create, '%h:%i'); ?></td>
                          </tr>
                      <?php
                          $i++;
                        }
                      }
                      ?>
                    <?php
                    }
                  }
                  $workuserfofiles = $this->receivework_model->get_workuserfofile($data->work_info_id_pri);
                  if ($workuserfofiles->num_rows() > 0) {
                    ?>
                    <?php
                    foreach ($workuserfofiles->result() as $workuserfofile) { ?>
                      <tr>
                        <td class="text-right"><?php echo $i; ?></td>
                        <td class="text-center">
                          <a style="padding-right: 5px" href="<?php echo base_url() . 'store/workuserfile/' . $workuserfofile->work_user_file_id; ?>" title="Item Title" class="<?php echo ($workuserfofile->file_type_check != 2) ? ($workuserfofile->file_type_check != 1) ? 'fancybox' : 'fancyboxpdf' : ''; ?>" target="_blank">
                            <img id="icon_show" src="<?php echo base_url() . 'store/icon/' . $workuserfofile->file_type_icon; ?>" style="padding: 0px" width="26px" style="cursor:pointer; border: 0px solid whitesmoke">
                          </a>
                        </td>
                        <td><a style="padding-right: 5px" href="<?php echo base_url() . 'store/workuserfile/' . $workuserfofile->work_user_file_id; ?>" title="Item Title" class="<?php echo ($workuserfofile->file_type_check != 2) ? ($workuserfofile->file_type_check != 1) ? 'fancybox' : 'fancyboxpdf' : ''; ?>" target="_blank">
                            <?php echo $workuserfofile->work_user_file_oldname; ?>
                          </a></td>
                        <td>
                          <?php
                          $file_work_process = $this->receivework_model->get_workuserid($workuserfofile->work_user_id)->row();
                          $dep_off = $this->receivework_model->getdep_off_id($file_work_process->dep_off_id);
                          echo $dep_off->dep_name;
                          ?>
                        </td>
                        <td><?php echo 'ผู้ปฏิบัติงาน'; ?></td>
                        <td><?php echo $this->receivework_model->get_user($workuserfofile->user_id)->user_fullname; ?></td>
                        <td class="text-center"><?php echo $this->misc->offsetyear($workuserfofile->work_user_file_create, 543) . ' ' . $this->misc->date2thai($workuserfofile->work_user_file_create, '%h:%i'); ?></td>
                      </tr>
                    <?php
                      $i++;
                    }
                    ?>
                  <?php }
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

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">
          <i class="fa fa-share"></i>&nbsp;<?php echo 'เส้นทางเอกสาร - เลขที่เอกสาร' . ' '; ?><span class="text-muted"><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></span>
        </h4>
        <hr>
        <div class="m-t-20">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="text-center" width="4%">#</th>
                  <th width="6%">สถานะ</th>
                  <th class="text-center" width="15%">วันที่ส่ง</th>
                  <th width="15%" style="border-right: 1px solid whitesmoke;">ส่งจาก</th>
                  <th>ส่งถึง</th>
                  <th class="text-center" width="10%">เลขทะเบียนรับ</th>
                  <th width="10%">ผู้ลงรับ</th>
                  <th class="text-center" width="15%">วันที่ลงรับ</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                $rows = $this->receivework_model->get_withinprocess($data->work_info_id_pri);
                if ($rows->num_rows() > 0) {
                  foreach ($rows->result() as $row) {
                ?>
                    <tr>
                      <td class="text-center"><?php echo $i; ?></td>
                      <td style="font-weight: bold;">
                        <?php if ($row->work_process_receive != 1) { ?>
                          <?php if ($row->work_process_status_id == 3) { ?>
                            <i class="fa fa-envelope text-danger"></i>
                          <?php } else { ?>
                            <i class="fa fa-envelope text-warning"></i>
                          <?php } ?>
                        <?php } else { ?>
                          <i class="fa fa-envelope-open text-success"></i>
                        <?php } ?>
                        <?php if ($row->work_process_sendtype == 2) { ?>
                          <?php echo $row->work_process_sort; ?><i class="fa fa-list-ol text-dark"></i>
                        <?php } ?>
                        <?php
                        $checks = $this->receivework_model->checkwithinprocess($row->work_info_id_pri, ($row->work_process_sort - 1), 0);
                        if ($checks->num_rows() == 1) {
                          $check = $checks->row();
                          if ($check->work_process_receive == 1) {
                            if ($check->work_process_sendtype == 2) {
                              if ($check->work_process_sendstatus == 0) {
                        ?>
                                <i class="fa fa-clock-o text-warning"></i>
                        <?php
                              }
                            }
                          }
                        }
                        ?>
                        <?php if ($row->work_process_status_id == 0) { ?>
                          <i class="fa fa-share text-warning"></i>
                        <?php } else if ($row->work_process_status_id == 2) { ?>
                          <i class="fa fa-share text-danger"></i>
                        <?php } ?>
                      </td>
                      <td class="text-center"><?php echo $this->misc->date2thai($row->work_process_create, '%d %m %y', 1) . ' ' . $this->misc->date2thai($row->work_process_create, '%h:%i'); ?></td>
                      <td style="border-right: 1px solid whitesmoke;">
                        <?php
                        if ($row->work_process_id_to == null) {
                          if ($row->work_user_id != null) {
                            echo  $this->receivework_model->get_user($row->user_id)->user_fullname . '<br> ( ผู้ปฏิบัติงาน )';
                          } else {
                            echo $this->receivework_model->getdep_off_id($data->dep_off_id)->dep_name . '<br> ( ' . $this->receivework_model->getdep_off_id($data->dep_off_id)->officer_name_display . ' )';
                          }
                        } else {
                          $dep_off_to = $this->receivework_model->getdep_off_id($this->receivework_model->getworkprocess($row->work_process_id_to)->row()->dep_off_id);
                          echo $dep_off_to->dep_name . '<br> ( ' . $dep_off_to->officer_name_display . ' )';
                        }
                        ?>
                      </td>
                      <td>
                        <?php
                        $dep_off_to = $this->receivework_model->getdep_off_id($row->dep_off_id);
                        echo $dep_off_to->dep_name . '<br> ( ' . ($row->work_process_act_for_flag == 1 ? $row->work_process_act_for_position : $dep_off_to->officer_name_display) . ' )';
                        ?>
                      </td>
                      <?php if ($row->work_process_receive == 1) { ?>
                        <td class="text-center"><?php echo $row->work_process_receive_id; ?></td>
                        <td><?php echo $row->work_process_receive_name; ?></td>
                        <td class="text-center"><?php echo $this->misc->offsetyear($row->work_process_receive_date, 543) . ' ' . $this->misc->date2thai($row->work_process_receive_date, '%h:%i'); ?></td>
                      <?php } else { ?>
                        <td></td>
                        <td></td>
                        <td></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td colspan="4" style="border-top: 0px; border-right: 1px solid whitesmoke;"></td>
                      <?php $special_command_name = $this->receivework_model->ref_special_command($row->special_command_id)->row()->special_command_name; ?>
                      <td colspan="4" style="border-top: 0px; font-weight: bold;"><?php echo !empty($row->work_process_receive_comment) ?  $special_command_name . ' : ' . $row->work_process_receive_comment : $special_command_name; ?></td>
                    </tr>
                    <?php
                    $i++;
                    $user_rows = $this->receivework_model->get_workuser($row->work_process_id_pri);
                    if ($user_rows->num_rows() > 0) {
                      foreach ($user_rows->result() as $user_row) {
                    ?>
                        <tr>
                          <td class="text-center"><i class="fa fa-arrow-right"></i></td>
                          <td><i class="fa fa-user-circle-o"></i>
                            <?php
                            if ($user_row->work_user_status_id == 1) {
                              echo '<i class="fa fa-warning text-warning"></i>';
                            } else if ($user_row->work_user_status_id == 2) {
                              echo '<i class="fa fa-clock-o text-primary"></i>';
                            } else {
                              echo '<i class="fa fa-check text-success"></i>';
                            }
                            ?>
                          </td>
                          <td class="text-center"><?php echo $this->misc->date2thai($user_row->work_user_create, '%d %m %y', 1) . ' ' . $this->misc->date2thai($user_row->work_user_create, '%h:%i'); ?></td>
                          <td style="border-right: 1px solid whitesmoke;">
                            <?php
                            $dep_off_id = $this->receivework_model->getdep_off_id($this->receivework_model->getworkprocess($row->work_process_id_pri)->row()->dep_off_id);
                            echo $dep_off_id->dep_name . '<br> ( ' . $dep_off_id->officer_name_display . ' )';
                            ?>
                          </td>
                          <td><?php echo  $this->receivework_model->get_user($user_row->user_id)->user_fullname . '<br> ( ผู้ปฏิบัติงาน )'; ?></td>
                          <td class="text-center"><?php echo '-'; ?></td>
                          <?php if ($user_row->work_user_status_id != 1) { ?>
                            <td><?php echo $this->receivework_model->get_user($user_row->user_id)->user_fullname; ?></td>
                            <td class="text-center"><?php echo $this->misc->offsetyear($user_row->work_user_startdate, 543) . ' ' . $this->misc->date2thai($user_row->work_user_startdate, '%h:%i'); ?></td>
                          <?php } else { ?>
                            <td></td>
                            <td></td>
                          <?php } ?>
                        </tr>
                        <tr>
                          <td colspan="4" style="border-top: 0px; border-right: 1px solid whitesmoke;"></td>
                          <td colspan="4" style="border-top: 0px; font-weight: bold;"><?php echo !empty($user_row->work_user_comment) ? 'บันทึกงาน : ' . $user_row->work_user_comment : ''; ?></td>
                        </tr>
                        <tr>
                          <td colspan="4" style="border-top: 0px; border-right: 1px solid whitesmoke;"></td>
                          <td colspan="4" style="border-top: 0px; font-weight: bold;"><?php echo !empty($user_row->work_user_report) ? 'รายงานผล : ' . $user_row->work_user_report : ''; ?></td>
                        </tr>
                  <?php
                      }
                    }
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
<div id="modal_receive_1" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> เกิดข้อผิดพลาด</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <div class="bootbox-body text-center">
          <p class="text-center" style="font-weight: bold;">เอกสารมีการลงรับแล้ว</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="location.reload();">ปิด</button>
      </div>
    </div>
  </div>
</div>
<div id="modal_comment" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form_modal_comment" method="post" action="<?php echo base_url('receivework/add_comment'); ?>" enctype="multipart/form-data" autocomplete="off">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fa fa-pencil-square-o"></i> บันทึกงาน</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label">บันทึกงาน</label>
            <input type="hidden" name="work_user_id" value="<?php echo $work_user_id; ?>">
            <textarea name="work_user_comment" id="work_user_comment" class="form-control form-control-sm" rows="4"><?php echo $this->receivework_model->getworkuser($work_user_id)->row()->work_user_comment ?></textarea>
          </div>
          <?php
          $user_signature_path = $this->receivework_model->get_user($this->session->userdata('user_id'))->user_signature_path;
          $work_user_signature = $this->receivework_model->getworkuserid($work_user_id)->row()->work_user_signature;
          $signature = $work_user_signature == null ? $user_signature_path : $work_user_signature;
          ?>
          <div class="form-group">
            <input name="signature_status_id" id="signature_status_id" type="checkbox" value="<?php echo $signature == 'none.png' ? 0 : 1; ?>" class="filled-in chk-col-orange" <?php echo $signature == 'none.png' ? '' : 'checked'; ?> onchange="signature_check();">
            <label for="signature_status_id">&nbsp; ต้องการแนบลายเซ็นดิจิตอล</label>
          </div>
          <div class="form-group">
            <label class="control-label">ลายเซ็นดิจิตอล</label>
            <div class="row">
              <div class="col-lg-12 text-center">
                <input type="hidden" name="signature_active_id" id="signature_active_id" value="<?php echo $signature == 'none.png' ? 0 : 1; ?>">
                <input type="hidden" name="signature_current" value="<?php echo $signature; ?>">
                <img id="signature_preview" src="<?php echo base_url('assets/upload/signature/' . $signature); ?>" style="max-height: 75px; max-width: 300px; border-radius: 3px;">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-lg-6">
                <label class="control-label">รหัส PIN <span class="text-danger">*</span></label>
                <input type="password" name="pin_key" id="pin_key" pattern="[0-9]{6}" maxlength="6" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกรหัส PIN ตัวเลข 6 หลัก" required="">
              </div>
            </div>
            <!-- <div class="row">
                            <div class="col-lg-12">
                                <a id="signature_btn" href="<?php echo base_url() . 'profile/editprofile'; ?>" class="m-t-15 btn btn-success btn-xl btn-sm"> อัพโหลดรูปลายเซ็นหรือรหัส PIN</a>
                            </div>
                        </div> -->
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
<div id="modal_userstatus" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form_modal_comment_report" method="post" action="<?php echo base_url('receivework/edit_userstatus'); ?>" enctype="multipart/form-data" autocomplete="off">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fa fa-check-circle"></i> เสร็จสิ้น</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <!-- <div class="form-group">
                        <p class="control-label text-center" style="font-weight: bold;">ยืนยันการเสร็จสิ้น </p>
                    </div> -->
          <div class="form-group">
            <label class="control-label">รายงานผล <span class="text-danger">*</span></label>
            <input type="hidden" name="work_user_id" value="<?php echo $work_user_id; ?>">
            <textarea name="work_user_report" id="work_user_report" class="form-control form-control-sm" rows="4" required=""><?php echo $this->receivework_model->getworkuser($work_user_id)->row()->work_user_report ?></textarea>
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
    signature_check();
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#signature_preview').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $('#signature').change(function() {
    $('#form_modal_comment').parsley().reset();
    readURL(this);
  });

  function modal_receive() {
    $.ajax({
      url: service_base_url + 'receivework/modal_receive',
      type: 'POST',
      data: {
        work_process_id_pri: $('#work_process_id_pri').val(),
      },
      success: function(response) {
        if (response != 0) {
          $('#modal_receive_1').modal('hide');
          $('#result-modal .modal-content').html(response);
          $('#result-modal').modal('show', {
            backdrop: 'true'
          });
        } else {
          $('#result-modal').modal('hide');
          $('#modal_receive_1').modal('show', {
            backdrop: 'true'
          });
        }
      }
    });
  }

  function modal_sendstatus() {
    $.ajax({
      url: service_base_url + 'receivework/modal_sendstatus',
      type: 'POST',
      data: {
        work_process_id_pri: $('#work_process_id_pri').val(),
      },
      success: function(response) {
        if (response != 0) {
          $('#modal_receive_1').modal('hide');
          $('#result-modal .modal-content').html(response);
          $('#result-modal').modal('show', {
            backdrop: 'true'
          });
        } else {
          $('#result-modal').modal('hide');
          $('#modal_receive_1').modal('show', {
            backdrop: 'true'
          });
        }
      }
    });
  }

  function receivework(work_process_id_pri) {
    $('#btn_submit').prop('disabled', true);
    $('#btn-modal-submit-loading').show();
    work_process_sendtype = $('#work_process_sendtype').val();
    $.ajax({
      url: service_base_url + 'receivework/receive',
      type: 'POST',
      data: {
        work_process_id_pri: work_process_id_pri,
        work_process_sendtype: work_process_sendtype,
      },
      success: function(response) {
        $('#result-modal').modal('hide');
        if (response == 1) {
          window.location.href = '<?php echo base_url() . 'receivework/detail/'; ?>' + work_process_id_pri;
        } else {
          notification('error', 'ไม่สำเร็จ', 'ลงรับเอกสารไม่สำเร็จ!');
        }
      }
    })
  }

  function receivesend(work_process_id_pri) {
    $('#btn_submit').prop('disabled', true);
    $('#btn-modal-submit-loading').show();
    $.ajax({
      url: service_base_url + 'receivework/receivesend',
      type: 'POST',
      data: {
        work_process_id_pri: work_process_id_pri,
      },
      success: function(response) {
        $('#result-modal').modal('hide');
        if (response == 1) {
          window.location.href = '<?php echo base_url() . 'receivework/detail/'; ?>' + work_process_id_pri;
        } else {
          notification('error', 'ไม่สำเร็จ', 'ส่งเอกสารไม่สำเร็จ!');
        }
      }
    })
  }

  function modal_comment() {
    $('#result-modal').modal('hide');
    $('#modal_receive_1').modal('hide');
    $('#modal_userstatus').modal('hide');
    $('#form_modal_comment').parsley();
    $('#modal_comment').modal('show', {
      backdrop: 'true'
    });
  }

  function modal_userstatus() {
    $('#result-modal').modal('hide');
    $('#modal_receive_1').modal('hide');
    $('#modal_comment').modal('hide');
    $('#form_modal_comment_report').parsley();
    $('#modal_userstatus').modal('show', {
      backdrop: 'true'
    });
  }

  function signature_check() {
    if ($('#signature_status_id').is(':checked') == false) {
      $("#pin_key").prop("readonly", true);
      $("#pin_key").prop("required", false);
    } else {
      if ($('#signature_active_id').val() == 0) {
        notification('warning', 'ไม่สามารถทำรายการได้', 'กรุณาอัพโหลดลายเซ็นหรือรหัส PIN !');
        $("#signature_status_id").prop("checked", false);
        $("#pin_key").prop("readonly", true);
        $("#pin_key").prop("required", false);
      } else {
        $("#pin_key").prop("readonly", false);
        $("#pin_key").prop("required", true);
      }
    }
  }
</script>