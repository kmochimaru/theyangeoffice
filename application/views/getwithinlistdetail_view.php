<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">
          <i class="<?php echo $icon; ?>"></i>&nbsp;<?php echo $title . ' - เลขที่เอกสาร' . ' '; ?><span class="text-muted"><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></span>
          <span style="float: right">
            <a href="<?php echo base_url() . 'getwithinlist'; ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-arrow-left"></i> กลับ</a>
          </span>
        </h4>
        <hr>
        <div class="row">
          <div class="col-md-12 col-sm-12 text-left">
            <div class="row">
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
                $files = $this->getwithinlist_model->get_workinfofile($data->work_info_id_pri);
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
        <hr>
        <div class="row">
          <div class="col-md-12 text-right">
            <?php if ($data->state_info_id <= 4) { ?>
              <a href="<?php echo base_url() . 'getwithinlist/attach/' . $data->work_info_code; ?>" class="btn btn-info"><i class="mdi mdi-paperclip"></i>&nbsp;เพิ่มไฟล์แนบ</a>
            <?php } ?>
            <?php if ($data->state_info_id == 4 || $data->state_info_id == 5) { ?>
              <a href="javascript:void(0)" onclick="modal_closestatus('<?php echo $data->work_info_id_pri; ?>');" class="btn btn-outline-success"><i class="fa fa-power-off"></i> ปิดงาน</a>
            <?php } ?>
            <a href="<?php echo base_url() . 'printout/docketprocess/' . $data->work_info_code; ?>" class="btn btn-success fancyboxpdf" target="_blank"><i class="fa fa-print"></i>&nbsp;พิมพ์เอกสาร</a>
            <?php if ($data->work_info_follow == 0) { ?>
              <button type="button" onclick="modal_follow();" class="btn btn-outline-warning"><i class="fa fa-star"></i> ติดตาม</button>
            <?php } else { ?>
              <button type="button" onclick="modal_unfollow();" class="btn btn-warning"><i class="fa fa-star"></i> เลิกติดตาม</button>
            <?php } ?>
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
                        <td><?php echo $this->getwithinlist_model->get_user($file->user_id)->user_fullname; ?></td>
                        <td class="text-center"><?php echo $this->misc->offsetyear($file->work_info_file_create, 543) . ' ' . $this->misc->date2thai($file->work_info_file_create, '%h:%i'); ?></td>
                      </tr>
                    <?php
                      $i++;
                    }
                  }
                  $workprocessfiles = $this->getwithinlist_model->get_workprocessfofile($data->work_info_id_pri);
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
                          $dep_off = $this->getwithinlist_model->getdep_off_id($workprocessfile->dep_off_id);
                          echo '<td>' . $dep_off->dep_name . '</td><td>' . $dep_off->officer_name_display . '</td>';
                        }
                        ?>
                        <td><?php echo $this->getwithinlist_model->get_user($workprocessfile->user_id)->user_fullname; ?></td>
                        <td class="text-center"><?php echo $this->misc->offsetyear($workprocessfile->work_process_file_create, 543) . ' ' . $this->misc->date2thai($workprocessfile->work_process_file_create, '%h:%i'); ?></td>
                      </tr>
                    <?php
                      $i++;
                    }
                  }
                  $workuserfofiles = $this->getwithinlist_model->get_workuserfofile($data->work_info_id_pri);
                  if ($workuserfofiles->num_rows() > 0) {
                    foreach ($workuserfofiles->result() as $workuserfofile) {
                    ?>
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
                          $file_work_process = $this->getwithinlist_model->get_workuserid($workuserfofile->work_user_id)->row();
                          $dep_off = $this->getwithinlist_model->getdep_off_id($file_work_process->dep_off_id);
                          echo $dep_off->dep_name;
                          ?>
                        </td>
                        <td><?php echo 'ผู้ปฏิบัติงาน'; ?></td>
                        <td><?php echo $this->getwithinlist_model->get_user($workuserfofile->user_id)->user_fullname; ?></td>
                        <td class="text-center"><?php echo $this->misc->offsetyear($workuserfofile->work_user_file_create, 543) . ' ' . $this->misc->date2thai($workuserfofile->work_user_file_create, '%h:%i'); ?></td>
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
                $rows = $this->getwithinlist_model->get_withinprocess($work_info_id_pri);
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
                        $checks = $this->getwithinlist_model->checkwithinprocess($row->work_info_id_pri, ($row->work_process_sort - 1), 0);
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
                          <i class="fa fa-reply text-warning"></i>
                        <?php } else if ($row->work_process_status_id == 2) { ?>
                          <i class="fa fa-reply text-danger"></i>
                        <?php } ?>
                      </td>
                      <td class="text-center"><?php echo $this->misc->date2thai($row->work_process_create, '%d %m %y', 1) . ' ' . $this->misc->date2thai($row->work_process_create, '%h:%i'); ?></td>
                      <td style="border-right: 1px solid whitesmoke;">
                        <?php
                        if ($row->work_process_id_to == null) {
                          if ($row->work_user_id != null) {
                            echo  $this->getwithinlist_model->get_user($row->user_id)->user_fullname . '<br> ( ผู้ปฏิบัติงาน )';
                          } else {
                            echo $this->getwithinlist_model->getdep_off_id($data->dep_off_id)->dep_name . '<br> ( ' . $this->getwithinlist_model->getdep_off_id($data->dep_off_id)->officer_name_display . ' )';
                          }
                        } else {
                          $dep_off_to = $this->getwithinlist_model->getdep_off_id($this->getwithinlist_model->getworkprocess($row->work_process_id_to)->row()->dep_off_id);
                          echo $dep_off_to->dep_name . '<br> ( ' . $dep_off_to->officer_name_display . ' )';
                        }
                        ?>
                      </td>
                      <td>
                        <?php
                        $dep_off_to = $this->getwithinlist_model->getdep_off_id($row->dep_off_id);
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
                      <?php $special_command_name = $this->getwithinlist_model->ref_special_command($row->special_command_id)->row()->special_command_name; ?>
                      <td colspan="4" style="border-top: 0px; font-weight: bold;"><?php echo !empty($row->work_process_receive_comment) ?  $special_command_name . ' : ' . $row->work_process_receive_comment : $special_command_name; ?></td>
                    </tr>
                    <?php
                    $i++;
                    $user_rows = $this->getwithinlist_model->get_workuser($row->work_process_id_pri);
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
                            $dep_off_id = $this->getwithinlist_model->getdep_off_id($this->getwithinlist_model->getworkprocess($row->work_process_id_pri)->row()->dep_off_id);
                            echo $dep_off_id->dep_name . '<br> ( ' . $dep_off_id->officer_name_display . ' )';
                            ?>
                          </td>
                          <td><?php echo  $this->getwithinlist_model->get_user($user_row->user_id)->user_fullname . '<br> ( ผู้ปฏิบัติงาน )'; ?></td>
                          <td class="text-center"><?php echo '-'; ?></td>
                          <?php if ($user_row->work_user_status_id != 1) { ?>
                            <td><?php echo $this->getwithinlist_model->get_user($user_row->user_id)->user_fullname; ?></td>
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
    <div class="modal-content" id="modal-content">

    </div>
  </div>
</div>
<div id="modal_changestatus_fail" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> เกิดข้อผิดพลาด</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <div class="bootbox-body text-center">
          <p class="text-center" style="font-weight: bold;">เอกสารนี้ไม่สามารถปิดงานได้</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="location.reload();">ปิด</button>
      </div>
    </div>
  </div>
</div>
<div id="modal_follow" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_cancel_comment_modal" method="post" autocomplete="false" action="#">
        <div class="modal-header">
          <h4 class="modal-title">ยืนยันการติดตาม</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <div class="bootbox-body text-warning">
            <p class="text-warning text-center" style="font-weight: bold;">ยืนยันการติดตามเอกสารเลขที่ <?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="btn_follow" class="btn btn-info" onclick="follow('<?php echo $data->work_info_id_pri; ?>')"><span id="btn-modal-follow-loading" style="display: none;"><i class="fa fa-spinner fa-spin"></i> </span> บันทึก</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"> ปิด</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div id="modal_unfollow" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_cancel_comment_modal" method="post" autocomplete="false" action="#">
        <div class="modal-header">
          <h4 class="modal-title">ยืนยันการเลิกการติดตาม</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <div class="bootbox-body text-warning">
            <p class="text-warning text-center" style="font-weight: bold;">ยืนยันการเลิกติดตามเอกสารเลขที่ <?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="btn_unfollow" class="btn btn-info" onclick="unfollow('<?php echo $data->work_info_id_pri; ?>')"><span id="btn-modal-unfollow-loading" style="display: none;"><i class="fa fa-spinner fa-spin"></i> </span> บันทึก</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"> ปิด</button>
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

  function modal_closestatus(work_info_id_pri) {
    $.ajax({
      url: service_base_url + 'getwithinlist/modal_closestatus',
      type: 'POST',
      data: {
        work_info_id_pri: work_info_id_pri
      },
      success: function(response) {
        if (response != 0) {
          $('#modal_changestatus_fail').modal('hide');
          $('#result-modal #modal-content').html(response);
          $('#result-modal').modal('show', {
            backdrop: 'true'
          });
        } else {
          $('#result-modal').modal('hide');
          $('#modal_changestatus_fail').modal('show', {
            backdrop: 'true'
          });
        }
      }
    });
  }

  function closestatus(work_info_id_pri) {
    $('#btn_submit').prop('disabled', true);
    $('#btn-modal-submit-loading').show();
    $.ajax({
      url: service_base_url + 'getwithinlist/closestatus',
      type: 'POST',
      data: {
        work_info_id_pri: work_info_id_pri,
      },
      success: function(response) {

        if (response == 1) {
          $('#result-modal').modal('hide');
          notification('success', 'สำเร็จ', 'ปิดงานสำเร็จ');
          setTimeout(function() {
            location.reload();
          }, 2500);
        } else {
          $('#result-modal').modal('hide');
          notification('error', 'ไม่สำเร็จ', 'ปิดงานไม่สำเร็จ!');
        }
      }
    })
  }

  function modal_follow() {
    $('#result-modal').modal('hide');
    $('#modal_follow').modal('show', {
      backdrop: 'true'
    });
  }

  function follow(work_info_id_pri) {
    $('#btn_follow').prop('disabled', true);
    $('#btn-modal-follow-loading').show();
    $.ajax({
      url: service_base_url + 'getwithinlist/follow',
      type: 'POST',
      data: {
        work_info_id_pri: work_info_id_pri,
      },
      success: function(response) {
        if (response == 1) {
          $('#modal_follow').modal('hide');
          notification('success', 'สำเร็จ', 'เลิกติดตามสำเร็จ');
          setTimeout(function() {
            window.location.href = '<?php echo base_url() . 'getwithinlist/detail/' . $data->work_info_code; ?>';
          }, 2500);
        } else {
          $('#modal_unfollow').modal('hide');
          notification('error', 'ไม่สำเร็จ', 'เลิกติดตามไม่สำเร็จ!');
        }
      }
    });
  }

  function modal_unfollow() {
    $('#result-modal').modal('hide');
    $('#modal_unfollow').modal('show', {
      backdrop: 'true'
    });
  }

  function unfollow(work_info_id_pri) {
    $('#btn_unfollow').prop('disabled', true);
    $('#btn-modal-unfollow-loading').show();
    $.ajax({
      url: service_base_url + 'getwithinlist/unfollow',
      type: 'POST',
      data: {
        work_info_id_pri: work_info_id_pri,
      },
      success: function(response) {
        if (response == 1) {
          $('#modal_unfollow').modal('hide');
          notification('success', 'สำเร็จ', 'เลิกติดตามสำเร็จ');
          setTimeout(function() {
            window.location.href = '<?php echo base_url() . 'getwithinlist/detail/' . $data->work_info_code; ?>';
          }, 2500);
        } else {
          $('#modal_unfollow').modal('hide');
          notification('error', 'ไม่สำเร็จ', 'เลิกติดตามไม่สำเร็จ!');
        }
      }
    });
  }
</script>