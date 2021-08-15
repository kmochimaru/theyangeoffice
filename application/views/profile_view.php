<div>
    <h2 class="text-info"><?php echo $title; ?></h2>
</div>
<div class="row">
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body" style="padding-top: 0px; padding-bottom: 15px;">
                <center class="m-t-30"> <img src="<?php echo base_url() . 'store/user/' . ($data->user_image != '' ? $data->user_image : 'none.png'); ?>" class="img-circle" width="150" />
                    <h4 class="card-title m-t-10"><?php echo $data->user_fullname; ?></h4>
                    <h6 class="card-subtitle"><?php echo $data->user_email != "" ? $data->user_email : "-"; ?></h6>
                    <div class="row text-center justify-content-md-center">
                        <?php echo $data->role_name; ?>
                    </div>
                </center>
            </div>
            <hr>
            <div class="card-body " style="padding-top: 0px; padding-bottom: 15px;">
                <?php
                $UserDepOff_result = $this->accesscontrol->getUserDepOff($data->user_id, 1);
                if ($UserDepOff_result->num_rows == 1) {
                    $UserDepOff = $UserDepOff_result->row();
                ?>
                    <h5 class="text-muted">หน่วยงาน :</h5>
                    <h5><?php echo $UserDepOff->dep_name != "" ? $UserDepOff->dep_name : "-"; ?></h5>
                    <h5 class="text-muted p-t-10">ตำเเหน่งงาน </h5>
                    <h5><?php echo $UserDepOff->officer_name != "" ? $UserDepOff->officer_name : "-"; ?></h5>
                <?php
                }
                ?>
                <h5 class="text-muted p-t-10">เบอร์โทร :</h5>
                <h5><?php echo $data->user_tel != "" ? $data->user_tel : "-"; ?></h5>
                <h5 class="text-muted p-t-10">ที่อยู่ :</h5>
                <h6><?php echo $data->user_address != "" ? $data->user_address : "-"; ?></h6>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 text-center">
                    <a id="image_a_signature" href="<?php echo base_url() . 'assets/upload/signature/' . ($data->user_signature_path != '' ? $data->user_signature_path : 'none.png'); ?>" class="fancybox">
                        <img id="image_show_signature" src="<?php echo base_url() . 'assets/upload/signature/' . ($data->user_signature_path != '' ? $data->user_signature_path : 'none.png'); ?>" style="max-height: 50px; max-width: 200px; border-radius: 3px;" style="cursor:pointer;">
                    </a>
                </div>
            </div>
            <p />
            <div class="row">
                <div class="col-md-12 text-center">
                    <label for="upload-image-signature" class="btn btn-info btn-xl btn-sm">
                        <i class="fa fa-image"></i> อัพโหลดรูปลายเซ็นขนาด กว้าง 600px และสูง 150px
                        <input type="file" accept="image/*" name="user_signature_path" onchange="upload_image_signature();" id="upload-image-signature" style="display: none">
                    </label>
                </div>
            </div>
            <hr>
            <div class="card-body " style="padding-top: 0px; padding-bottom: 15px;">
                <h5 class="text-muted p-t-10">Public Key :</h5>
                <h5><?php echo $data->public_key != "" ? $data->public_key : "-"; ?></h5>
                <h5 class="text-muted p-t-10">Private Key :</h5>
                <h6>******************************************************</h6>
            </div>
            <hr>
            <div class="card-body text-center" style="padding-top: 0px; padding-bottom: 15px;">
                <?php if ($data->user_line_token != "" || $data->user_line_token != null) { ?>
                    <button onclick="un_regis_line();" class="btn btn-block btn-sm text-white" style="font-size: 12pt;"><img src="<?php echo base_url() . "assets/img/line.png"; ?>" width="30" height="30" /> ยกเลิกการเเจ้งเตือนผ่าน LINE</button>
                <?php } else { ?>
                    <button onclick="regis_line();" class="btn btn-block btn-sm text-white" style="background-color:#44C70F;font-size: 12pt;"><img src="<?php echo base_url() . "assets/img/line.png"; ?>" width="30" height="30" /> รับการเเจ้งเตือนผ่าน LINE</button>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link <?php echo $active == "department" ? "active" : null; ?>" data-toggle="tab" href="#home" role="tab">หน่วยงาน</a> </li>
                <li class="nav-item"> <a class="nav-link <?php echo $active == "officer" ? "active" : null; ?>" data-toggle="tab" href="#officer" role="tab">ตำแหน่งงาน</a> </li>
                <li class="nav-item"> <a class="nav-link <?php echo $active == "profile" ? "active" : null; ?>" data-toggle="tab" href="#profile" role="tab">ประวัติส่วนตัว</a> </li>
                <li class="nav-item"> <a class="nav-link <?php echo $active == "loglogin" ? "active" : null; ?>" data-toggle="tab" href="#loglogin" role="tab">ประวัติเข้าใช้ระบบ</a> </li>
                <li class="nav-item"> <a class="nav-link <?php echo $active == "loguser" ? "active" : null; ?>" data-toggle="tab" href="#loguser" role="tab">ประวัติแก้ไขข้อมูล</a> </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane <?php echo $active == "department" ? "active" : null; ?>" id="home" role="tabpanel">
                    <div class="card-body">
                        <?php
                        if ($data_dep_result->num_rows() == 1) {
                            $data_dep = $data_dep_result->row();
                        ?>
                            <div class="form-horizontal">
                                <div class="form-group row p-t-10">
                                    <label class="col-sm-4 col-form-label text-right">รหัสหน่วยงาน</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $data_dep->dep_id; ?>" readonly="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-right">ชื่อหน่วยงาน</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $data_dep->dep_name; ?>" readonly="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-right">เบอร์โทร</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $data_dep->dep_tel; ?>" readonly="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-right">สถานะที่</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $data_dep->place_name; ?>" readonly="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-right">รายละเอียด</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control form-control-sm" rows="2" readonly=""><?php echo $data_dep->dep_description; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-right">สถานะหน่วยงาน</label>
                                    <div class="col-md-6" style="margin-top:5px;">
                                        <?php echo $data_dep->dep_status_name; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-right">รหัสนำหน้าหนังสือส่งออกภายใน</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $data_dep->dep_prefix_within; ?>" readonly="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-right">รหัสนำหน้าหนังสือส่งออกภายนอก</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $data_dep->dep_prefix_without; ?>" readonly="">
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="form-horizontal">
                                <div class="form-group row p-t-10">
                                    <label class="col-sm-4 col-form-label text-right">รหัสหน่วยงาน</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm" value="-" readonly="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-right">ชื่อหน่วยงาน</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm" value="-" readonly="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-right">เบอร์โทร</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm" value="-" readonly="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-right">สถานะที่</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm" value="-" readonly="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-right">รายละเอียด</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control form-control-sm" rows="2" readonly="">-</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-right">สถานะหน่วยงาน</label>
                                    <div class="col-md-6" style="margin-top:5px;">
                                        -
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-right">รหัสนำหน้าหนังสือส่งออกภายใน</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm" value="-" readonly="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-right">รหัสนำหน้าหนังสือส่งออกภายนอก</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm" value="-" readonly="">
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <hr>
                    <div class="card-body">
                        <?php
                        $department_year = $this->profile_model->getDepartmentYear($this->session->userdata('dep_id_pri'), $this->misc->getYearThai());
                        if ($department_year->num_rows() == 1) {
                            $row_dep_yaer = $department_year->row();
                        ?>
                            <div class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-right">ปีงานสารบรรณ</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $row_dep_yaer->year; ?>" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-right">เลขทะเบียนรับเข้าสุดท้าย</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $row_dep_yaer->dep_year_receive_last; ?>" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-right">เลขที่ส่งออกภายในสุดท้าย</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $row_dep_yaer->dep_year_send_last; ?>" readonly="">
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="tab-pane <?php echo $active == "officer" ? "active" : null; ?>" id="officer" role="tabpanel">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="4%">#</th>
                                        <th>หน่วยงาน</th>
                                        <th>ตำแหน่ง</th>
                                        <th class="text-center">ใช้งาน (หลัก)</th>
                                        <th class="text-center">สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($data_userdepoff->num_rows() > 0) {
                                        $i = 1;
                                        foreach ($data_userdepoff->result() as $userdepoff) {
                                    ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i; ?></td>
                                                <td><?php echo $userdepoff->dep_name; ?></td>
                                                <td><?php echo $userdepoff->officer_name; ?></td>
                                                <td class="text-center">
                                                    <div class="switch text-center">
                                                        <label>
                                                            <input type="checkbox" onchange="switchactive('<?php echo $userdepoff->user_dep_off_id; ?>', '<?php echo $userdepoff->user_id; ?>', this);" id="checkbox_active_<?php echo $userdepoff->user_dep_off_id ?>" <?php echo ($userdepoff->user_dep_off_active_id == 1 ? 'checked disabled' : ''); ?> <?php echo ($userdepoff->user_dep_off_status_id == 1 ? '' : 'disabled'); ?>><span class="lever switch-col-red"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="switch text-center">
                                                        <label>
                                                            <input type="checkbox" onchange="switchstatus('<?php echo $userdepoff->user_dep_off_id; ?>', this);" id="checkbox_status_<?php echo $userdepoff->user_dep_off_id ?>" <?php echo ($userdepoff->user_dep_off_status_id == 1 ? 'checked' : ''); ?> <?php echo ($userdepoff->user_dep_off_active_id == 1 ? 'disabled' : ''); ?> <?php echo ($userdepoff->dep_id_pri == $this->session->userdata('dep_id_pri') ? 'disabled' : ''); ?>><span class="lever"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            $i++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td class="text-center" colspan="5"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php echo $active == "profile" ? "active" : null; ?>" id="profile" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="card table-responsive">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <div>
                                            <!--<button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>-->
                                        </div>
                                    </h4>
                                    <form class="form-horizontal" id="formedit" method="post" action="<?php echo base_url() . 'profile/edit'; ?>" autocomplete="off">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <a id="image_a" href="<?php echo base_url() . 'store/user/' . ($data->user_image != '' ? $data->user_image : 'none.png'); ?>" class="fancybox">
                                                    <img id="image_show" src="<?php echo base_url() . 'store/user/' . ($data->user_image != '' ? $data->user_image : 'none.png'); ?>" class="img-thumbnail" width="150" height="150" style="cursor:pointer;">
                                                </a>
                                            </div>
                                        </div>
                                        <p />
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                แนะนำรูปขนาด 400x400 px
                                            </div>
                                        </div>
                                        <p />
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <label for="upload-image" class="btn btn-info btn-xl btn-sm">
                                                    <i class="fa fa-image"></i> อัพโหลดรูป
                                                    <input type="file" accept="image/*" name="user_image" onchange="upload_image();" id="upload-image" style="display: none">
                                                </label>
                                            </div>
                                        </div>
                                        <p class="p-t-30"></p>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label text-right"> Username</label>
                                            <div class="col-sm-5">
                                                <input type="text" value="<?php echo $data->username; ?>" id="username" class="form-control form-control-sm" required readonly>
                                            </div>
                                            <div class="col-sm-2 ">                                                
                                                <button type="button" class="btn btn-warning btn-sm" onclick="modaleditpassword();"><i class="fa fa-refresh"></i>&nbsp;เปลี่ยนรหัสผ่าน</button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label text-right"> ชื่อผู้ใช้งาน</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="user_fullname" value="<?php echo $data->user_fullname; ?>" class="form-control form-control-sm" required>
                                            </div>
                                            <div class="col-sm-2">
                                                <div id=pin_key1 style="display: <?php echo $data->pin_key == null ? 'block' : 'none' ?>;">
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="modaleditpin('<?php echo $data->user_id; ?>');"><i class="fa fa-unlock"></i>&nbsp;สร้างรหัส PIN</button>
                                                </div>
                                                <div id=pin_key2 style="display: <?php echo $data->pin_key != null ? 'block' : 'none' ?>;">
                                                    <button type="button" class="btn btn-inverse btn-sm" onclick="modaleditpin('<?php echo $data->user_id; ?>');"><i class="fa fa-unlock"></i>&nbsp;แก้ไขรหัส PIN</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label text-right"> เบอร์โทร</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="user_tel" value="<?php echo $data->user_tel; ?>" onblur="check_phone_format(this);" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label text-right"> อีเมล์</label>
                                            <div class="col-sm-5">
                                                <input type="email" name="user_email" value="<?php echo $data->user_email; ?>" class="form-control form-control-sm" readonly="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label text-right"> ที่อยู่</label>
                                            <div class="col-sm-5">
                                                <textarea name="user_address" class="form-control form-control-sm" rows="3"><?php echo $data->user_address; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label text-right">สถานะผู้ใช้งาน</label>
                                            <div class="col-md-5" style="margin-top:5px;">
                                                <?php if ($data->user_status_id == 1) { ?>
                                                    <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo $data->user_status_name; ?></span>
                                                <?php } else if ($data->user_status_id == 2) { ?>
                                                    <span class="badge badge-danger"><i class="fa fa-close"></i> <?php echo $data->user_status_name; ?></span>
                                                <?php } else { ?>
                                                    <span class="badge badge-warning"><i class="fa fa-spinner"></i> <?php echo $data->user_status_name; ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12 text-center">
                                                <button type="submit" class="btn btn-sm btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                                <button type="reset" class="btn btn-sm btn-outline-danger "><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php echo $active == "loglogin" ? "active" : null; ?>" id="loglogin" role="tabpanel">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="10%">#</th>
                                        <th width="10%">สถานะ</th>
                                        <th width="25%">IP</th>
                                        <th width="30%">Browser</th>
                                        <th width="25%">เวลา</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($data_loglogin->num_rows() > 0) {
                                        $i = 1;
                                        foreach ($data_loglogin->result() as $row) {
                                    ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i; ?></td>
                                                <td>
                                                    <?php if ($row->log_text == "Login") { ?>
                                                        <span class="badge badge-success"><?php echo $row->log_text; ?></span>
                                                    <?php } else { ?>
                                                        <span class="badge badge-danger"><?php echo $row->log_text; ?></span>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $row->log_ip_address; ?></td>
                                                <td><?php echo $row->log_browser; ?></td>
                                                <td><?php echo $this->misc->date2Thai($row->log_time, '%d %m %y, %h:%i:%s', true); ?></td>
                                            </tr>
                                        <?php
                                            $i++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td class="text-center" colspan="10"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php echo $active == "loguser" ? "active" : null; ?>" id="loguser" role="tabpanel">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="10%">#</th>
                                        <th width="20%">ประวัติ</th>
                                        <th width="15%">ชื่อผู้ใช้งาน</th>
                                        <th width="10%">IP</th>
                                        <th width="25%">Browser</th>
                                        <th width="20%">เวลา</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($data_loguser->num_rows() > 0) {
                                        $i = 1;
                                        foreach ($data_loguser->result() as $row) {
                                    ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i; ?></td>
                                                <td><?php echo $row->log_text; ?></td>
                                                <td><?php echo $row->user_fullname; ?></td>
                                                <td><?php echo $row->log_ip_address; ?></td>
                                                <td><?php echo $row->log_browser; ?></td>
                                                <td><?php echo $this->misc->date2Thai($row->log_time, '%d %m %y, %h:%i:%s', true); ?></td>
                                            </tr>
                                        <?php
                                            $i++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td class="text-center" colspan="10"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
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

<div class="right-sidebar">
    <div class="slimscrollright">
        <div class="rpanel-title"> เลือกสีเมนู <span><i class="ti-close right-side-toggle"></i></span> </div>
        <div class="r-panel-body">
            <ul id="themecolors" class="m-t-20">
                <li><b>แถบด้านข้างโทนสว่าง</b></li>
                <li><a href="javascript:void(0)" data-theme="default" class="default-theme<?php echo ($data->user_style == 'default' ? ' working' : ''); ?>">1</a></li>
                <li><a href="javascript:void(0)" data-theme="green" class="green-theme<?php echo ($data->user_style == 'green' ? ' working' : ''); ?>">2</a></li>
                <li><a href="javascript:void(0)" data-theme="red" class="red-theme<?php echo ($data->user_style == 'red' ? ' working' : ''); ?>">3</a></li>
                <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme<?php echo ($data->user_style == 'blue' ? ' working' : ''); ?>">4</a></li>
                <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme<?php echo ($data->user_style == 'purple' ? ' working' : ''); ?>">5</a></li>
                <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme<?php echo ($data->user_style == 'megna' ? ' working' : ''); ?>">6</a></li>
                <li class="d-block m-t-20"><b>แถบด้านข้างโทนเข็ม</b></li>
                <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme<?php echo ($data->user_style == 'default-dark' ? ' working' : ''); ?>">7</a></li>
                <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme<?php echo ($data->user_style == 'green-dark' ? ' working' : ''); ?>">8</a></li>
                <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme<?php echo ($data->user_style == 'red-dark' ? ' working' : ''); ?>">9</a></li>
                <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme<?php echo ($data->user_style == 'blue-dark' ? ' working' : ''); ?>">10</a></li>
                <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme<?php echo ($data->user_style == 'purple-dark' ? ' working' : ''); ?>">11</a></li>
                <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme<?php echo ($data->user_style == 'megna-dark' ? ' working' : ''); ?> ">12</a></li>
            </ul>
            <hr>
            <input type="hidden" id="style_theme" value="<?php echo ($data->user_style != '' ? $data->user_style : 'default'); ?>" />
            <button type="button" class="btn btn-sm btn-block btn-info waves-effect waves-light" onclick="save_theme();"><i class="fa fa-save"></i> บันทึก</button>
        </div>
    </div>
</div>
<div class="modal fade" id="editpassword">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<div class="modal fade" id="editpin">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<div class="modal fade" id="unregisline">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>

<script>
    var service_base_url = $('#service_base_url').val();

    function regis_line() {
        window.location = 'https://notify-bot.line.me/oauth/authorize?response_type=code&client_id=<?php echo $this->config->item('line_id'); ?>&redirect_uri=<?php echo base_url() . 'profile/line&scope=notify&state=1&bot_prompt=aggressive'; ?>';
    }
    
    function un_regis_line() {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'profile/unregisline_modal',
            type: 'POST',
            data: {},
            success: function (response) {
                $('#unregisline .modal-content').html(response);
                $('#unregisline').modal('show', {backdrop: 'true'});
            }
        });
    }
    
    $(function() {
        $('#formedit').parsley();
        $('.fancybox').fancybox({
            padding: 0,
            helpers: {
                title: {
                    type: 'outside'
                }
            }
        });
    });

    function save_theme() {
        url = service_base_url + 'profile/save_theme';
        $.ajax({
            url: url,
            method: "POST",
            data: {
                style_theme: $('#style_theme').val()
            },
            success: function(response) {
                if (response == '1') {
                    notification('success', 'Success', 'บันทึกเรียบร้อยเเล้ว');
                }
            }
        });
    }

    function modaleditpin($user_id) {
        url = service_base_url + 'profile/modaleditpin';
        $('#editpin').modal('show', {
            backdrop: 'true'
        });
        $.ajax({
            url: url,
            method: "POST",
            data: {
                user_id: $user_id
            },
            success: function(response) {
                $('#editpin .modal-content').html(response);
            }
        });
    }

    function modaleditpassword() {
        url = service_base_url + 'profile/modaleditpassword';
        $('#editpassword').modal('show', {
            backdrop: 'true'
        });
        $.ajax({
            url: url,
            method: "POST",
            data: {
                username: $('#username').val()
            },
            success: function(response) {
                $('#editpassword .modal-content').html(response);
            }
        });
    }

    function editpassword() {
        if ($("#oldpassword").val() != '') {
            if ($("#newpassword").val() != '') {
                if ($("#confirmpassword").val() != '') {

                    url = service_base_url + 'profile/editpassword';
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: {
                            username: $('#usernamepassword').val(),
                            oldpassword: $('#oldpassword').val(),
                            newpassword: $('#newpassword').val(),
                            confirmpassword: $('#confirmpassword').val()
                        },
                        success: function(res) {
                            if (res == 1) {
                                $('#editpassword').modal('hide');
                                notification('success', 'Success', 'บันทึกเรียบร้อยเเล้ว');
                            } else if (res == 2) {
                                $('#statuspassword').html('Password เดิม ไม่ถูกต้อง');
                                $('#statusconfirmpassword').html('');
                                $("#newpassword").val('');
                                $("#confirmpassword").val('');
                            } else {
                                $('#statusconfirmpassword').html('ยืนยัน Password ไม่ตรงกัน');
                                $('#statuspassword').html('');
                                $("#newpassword").val('');
                                $("#confirmpassword").val('');
                            }
                        }
                    });
                }
            }
        }
        return false;
    }

    function upload_image_signature() {
        var myfiles = document.getElementById("upload-image-signature");
        var files = myfiles.files;
        var data = new FormData();

        for (i = 0; i < files.length; i++) {
            data.append('file' + i, files[i]);
        }
        url = service_base_url + 'profile/upload_image_signature';
        $.ajax({
            url: url,
            dataType: "json",
            type: 'POST',
            contentType: false,
            data: data,
            processData: false,
            cache: false
        }).done(function(res) {
            if (res.error) {
                notification('error', 'Fail Uploaded', 'อัพโหลดรูปไม่สำเร็จ');
            } else {
                image_link = service_base_url + 'assets/upload/signature/' + res.file_name;
                $('#image_a_signature').attr("href", image_link);
                $('#image_show_signature').attr("src", image_link);
                //                $('#image_h1').attr("src", image_link);
                //                $('#image_h2').attr("src", image_link);
                notification('success', 'Uploaded', 'บันทึกรูปเรียบร้อยเเล้ว');
            }
        });
    }

    function upload_image() {
        var myfiles = document.getElementById("upload-image");
        var files = myfiles.files;
        var data = new FormData();

        for (i = 0; i < files.length; i++) {
            data.append('file' + i, files[i]);
        }
        url = service_base_url + 'profile/upload_image';
        $.ajax({
            url: url,
            dataType: "json",
            type: 'POST',
            contentType: false,
            data: data,
            processData: false,
            cache: false
        }).done(function(res) {
            if (res.error) {
                notification('error', 'Fail Uploaded', 'อัพโหลดรูปไม่สำเร็จ');
            } else {
                image_link = service_base_url + 'assets/upload/user/' + res.file_name;
                $('#image_a').attr("href", image_link);
                $('#image_show').attr("src", image_link);
                //                $('#image_h1').attr("src", image_link);
                //                $('#image_h2').attr("src", image_link);
                notification('success', 'Uploaded', 'บันทึกรูปเรียบร้อยเเล้ว');
            }
        });
    }

    function switchstatus(user_dep_off_id, checkbox) {
        if (checkbox.checked) {
            var url = service_base_url + 'user/status1';
            $.post(url, {
                user_dep_off_id: user_dep_off_id
            }, function(response) {
                //notification('success', 'สำเร็จ', 'อนุญาตสถานะ');
                setTimeout(function() {
                    location.reload();
                }, 200);
            });
        } else {
            var url = service_base_url + 'user/status2';
            $.post(url, {
                user_dep_off_id: user_dep_off_id
            }, function(response) {
                //notification('warning', 'สำเร็จ', 'ระงับสถานะ');
                setTimeout(function() {
                    location.reload();
                }, 200);
            });
        }
    }

    function switchactive(user_dep_off_id, user_id, checkbox) {
        var url = service_base_url + 'user/active';
        $.post(url, {
            user_dep_off_id: user_dep_off_id,
            user_id: user_id
        }, function(response) {
            setTimeout(function() {
                location.reload();
            }, 200);
        });
    }
</script>