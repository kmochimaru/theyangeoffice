<div class="row">
    <div class="col-md-7 col-sm-7 col-7">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                </h4>
                <?php
                $result = $this->setting_model->getDepartment($this->session->userdata('dep_id_pri'));
                if ($result->num_rows() == 1) {
                    $data = $result->row();
                    ?>
                    <form class="form-horizontal" id="form_setting" method="post" action="<?php echo base_url() . 'setting/edit'; ?>" autocomplete="off">
                        <input type="hidden" name="dep_id_pri" class="form-control form-control-sm" value="<?php echo $data->dep_id_pri; ?>">
                        <div class="form-group row p-t-10">
                            <label class="col-sm-4 col-form-label text-right">รหัสหน่วยงาน</label>
                            <div class="col-md-6">
                                <input type="text" name="dep_id" class="form-control form-control-sm" value="<?php echo $data->dep_id; ?>" readonly="" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-right">ชื่อหน่วยงาน</label>
                            <div class="col-md-6">
                                <input type="text" name="dep_name" class="form-control form-control-sm" value="<?php echo $data->dep_name; ?>" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-right">ชื่อย่อหน่วยงาน</label>
                            <div class="col-md-6">
                                <input type="text" name="dep_name_short" class="form-control form-control-sm" value="<?php echo $data->dep_name_short; ?>" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-right">เบอร์โทร</label>
                            <div class="col-md-6">
                                <input type="text" name="dep_tel" class="form-control form-control-sm" value="<?php echo $data->dep_tel; ?>" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-right">สถานะที่</label>
                            <div class="col-md-6">
                                <select name="place_id" id="place_id" class="form-control form-control-sm" required="">
                                    <?php foreach ($this->setting_model->getPlace()->result() as $place) { ?>
                                        <option value="<?php echo $place->place_id; ?>" <?php echo ($place->place_id == $data->place_id) ? 'selected' : '' ?>><?php echo $place->place_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-right">ลักษณะหน่วยงาน</label>
                            <div class="col-md-6">
                                <textarea name="dep_description" class="form-control form-control-sm" rows="2"><?php echo $data->dep_description; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-right">สถานะหน่วยงาน</label>
                            <div class="col-md-6" style="margin-top:5px;">
                                <?php if ($data->dep_status_id == 1) { ?>
                                    <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo $data->dep_status_name; ?></span>
                                <?php } else { ?>
                                    <span class="badge badge-danger"><i class="fa fa-close"></i> <?php echo $data->dep_status_name; ?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-right">รหัสนำหน้าหนังสือส่งภายใน</label>
                            <div class="col-md-6">
                                <input type="text" name="dep_prefix_within" class="form-control form-control-sm" value="<?php echo $data->dep_prefix_within; ?>" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-right">รหัสนำหน้าหนังสือส่งภายนอก</label>
                            <div class="col-md-6">
                                <input type="text" name="dep_prefix_without" class="form-control form-control-sm" value="<?php echo $data->dep_prefix_without; ?>" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-right">อนุญาติให้ส่งหนังสือภายนอก</label>
                            <div class="col-md-6" style="margin-top:5px;">
                                <?php if ($data->dep_without_active_id == 1) { ?>
                                    <span class="badge badge-success"><i class="fa fa-check"></i> ให้ส่งออกได้</span>
                                <?php } else { ?>
                                    <span class="badge badge-danger"><i class="fa fa-close"></i> ไมให้ส่งออก</span>
                                <?php } ?>
                            </div>
                        </div>
                        <br />
                        <div class="form-group text-center">
                            <button type="submit" id="btn-add-submit" class="btn btn-sm btn-outline-info"><i class="fa fa-save"></i> บันทึก</button>
                            <button type="reset" class="btn btn-sm btn-outline-danger "><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        </div>
                    </form>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    $department_year = $this->setting_model->getDepartmentYear($this->session->userdata('dep_id_pri'), $this->misc->getYearThai());
    if ($department_year->num_rows() == 1) {
        $row_dep_yaer = $department_year->row();
        ?>
        <div class="col-md-5 col-sm-5 col-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="<?php echo $icon; ?>"></i> ปีงานสารบรรณ
                    </h4>

                    <div class="form-horizontal">
                        <div class="form-group row p-t-10">
                            <label class="col-sm-6 col-form-label text-right">ปีงานสารบรรณ</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-control-sm" value="<?php echo $row_dep_yaer->year; ?>" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-6 col-sm-6 col-form-label text-right"><i class="fa fa-file-text-o"></i> เลขที่เอกสาร</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-control-sm" value="<?php echo $row_dep_yaer->dep_year_number_last; ?>" readonly="">
                            </div>
                            <label class="col-md-2 col-sm-2 col-form-label">(ถัดไป)</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="<?php echo $icon; ?>"></i> เลขทะเบียน
                    </h4>
                    <div class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-6 col-sm-6 col-form-label text-right"><i class="fa fa-download"></i> เลขทะเบียนรับ</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-control-sm" value="<?php echo $row_dep_yaer->dep_year_receive_last; ?>" readonly="">
                            </div>
                            <label class="col-md-2 col-sm-2 col-form-label">(ถัดไป)</label>
                        </div>
                    </div>
                    <div class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-6 col-sm-6 col-form-label text-right"><i class="fa fa-telegram"></i> เลขทะเบียนส่งภายใน</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-control-sm" value="<?php echo $row_dep_yaer->dep_year_send_last; ?>" readonly="">
                            </div>
                            <label class="col-md-2 col-sm-2 col-form-label">(ถัดไป)</label>
                        </div>
                    </div>
                    <div class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-6 col-sm-6 col-form-label text-right"><i class="fa fa-paper-plane-o"></i> เลขทะเบียนหนังสือส่ง</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-control-sm" value="<?php echo $row_dep_yaer->dep_year_send_out_last; ?>" readonly="">
                            </div>
                            <label class="col-md-2 col-sm-2 col-form-label">(ถัดไป)</label>
                        </div>
                    </div>
                    <div class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-6 col-sm-6 col-form-label text-right"><i class="fa fa-paper-plane-o"></i> เลขทะเบียนคำสั่ง</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-control-sm" value="<?php echo $row_dep_yaer->dep_year_send_command_last; ?>" readonly="">
                            </div>
                            <label class="col-md-2 col-sm-2 col-form-label">(ถัดไป)</label>
                        </div>
                    </div>
                    <div class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-6 col-sm-6 col-form-label text-right"><i class="fa fa-paper-plane-o"></i> เลขทะเบียนประกาศ</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-control-sm" value="<?php echo $row_dep_yaer->dep_year_send_publish_last; ?>" readonly="">
                            </div>
                            <label class="col-md-2 col-sm-2 col-form-label">(ถัดไป)</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<script>
    $(function () {
        $('#form_setting').parsley();
    });
</script>