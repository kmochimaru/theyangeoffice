<form action="<?php echo base_url() . 'user/add_user_search'; ?>" method="post" autocomplete="off" id="form-add-user">
    <div class="table-responsive" style="min-height: 30vh;">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center" width="5%">
                        <input type="checkbox" id="trigger_check_all_input" value="" onclick="trigger_check_all()" class="filled-in">
                        <label for="trigger_check_all_input">เลือก</label>
                    </th>
                    <th width="10%">เลขบัตรประชาชน</th>
                    <th width="10%">Email</th>
                    <th width="12%">ชื่อ-นามสกุล</th>
                    <th width="8%">เบอร์โทรศัพท์</th>
                    <th width="22%">สังกัด</th>
                    <th width="22%">ประเภท / สายงาน / ตำแหน่งงาน / ระดับตำแหน่ง</th>
                    <th class="text-center" width="5%">สถานะ</th>
                    <th class="text-center" width="5%">Login</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count_data = $data->num_rows();
                if ($count_data > 0) {
                    $i = $segment + 1;
                    foreach ($data->result() as $row) {
                        ?>
                        <tr>

                            <?php
                            $check = $this->user_model->check_profile($row->instructor_id, $row->citizen_id, $row->username);
                            if (in_array($row->staff_status_id, array(1, 4)) && ($row->login_status == 1) && ($row->citizen_id != '') && ($row->username != '')) {
//                                if (in_array($row->staff_status_id, array(1, 4)) && ($row->login_status == 1) && ($check == 0) && ($row->citizen_id != '') && ($row->username != '')) {
                                ?>
                                <td class="text-center">
                                    <input type="checkbox" id="instructor_id_<?php echo $row->instructor_id; ?>" name="instructor_id[]" value="<?php echo $row->instructor_id; ?>" onclick="" class="filled-in check_all_input">
                                    <label for="instructor_id_<?php echo $row->instructor_id; ?>"><?php echo $i; ?></label>
                                </td>
                                <?php
                            } else {
//                                if ($check > 0) {
                                ?>
            <!--                                    <td class="text-center">
                                        <span class="badge badge-success">มีแล้ว</span>
                                        <label>//<?php echo $i; ?></label>
                                    </td>-->
                                <?php
//                                } else {
                                ?>
                                <td class="text-center">
                                    <span class="badge badge-danger">ไม่ผ่าน</span>
                                    <label><?php echo $i; ?></label>
                                </td>
                                <?php
//                                }
                            }
                            ?>                            
                            <td><?php echo $row->citizen_id; ?></td>
                            <td><?php echo $row->username; ?></td>
                            <td><?php echo $row->prefix_name . $row->firstname . ' ' . $row->lastname; ?></td>
                            <td><?php echo $row->phone; ?></td>
                            <td><?php echo $row->campus_name . ' / ' . $row->faculty_name . ' / ' . $row->department_name . ' / ' . $row->major_name; ?></td>
                            <td><?php echo $row->staff_type_name . ' / ' . $row->sub_staff_type_name . ' / ' . $row->position_work_name . ' / ' . $row->position_academic_name; ?></td>
                            <td class="text-center"><?php echo (in_array($row->staff_status_id, array(1, 4))) ? '<span class="badge badge-success">' . $row->staff_status_name . '</span>' : '<span class="badge badge-danger">' . $row->staff_status_name . '</span>'; ?></td>
                            <td class="text-center"><?php echo $row->login_status == 1 ? '<span class="badge badge-success">ปกติ</span>' : '<span class="badge badge-danger">ระงับ</span>'; ?></td>
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
    <div class="row m-t-10">
        <?php
        if ($count != 0) {
            ?>
            <div class="col-lg-4 col-md-4">
                แสดง <?php echo $segment + 1; ?> ถึง <?php echo $i - 1; ?> ทั้งหมด <?php echo ($count); ?> รายการ
            </div>
            <div class="col-lg-8 col-md-8">
                <?php echo $links; ?>
            </div>
            <?php
        }
        ?>
    </div>
    <hr>
    <div class="m-t-20 m-b-30" style="min-height:300px;">
        <div class="row m-t-10">
            <div class="col-lg-2 col-md-2"></div>
            <div class="col-lg-6 col-md-6">
                <h4 class="card-title">
                    <i class="fa fa-tags"></i> บันทึกการเพิ่มผู้ใช้งาน กำหนดตำแหน่ง และสิทธิ์การใช้งาน
                </h4>
            </div>            
        </div>
        <div class="row m-t-10">
            <div class="col-lg-2 col-md-2"></div>
            <div class="col-lg-4 col-md-4">
                <label class="control-label">หน่วยงานหลัก <span class="text-danger">*</span></label>
                <select name="dep_id_pri" id="dep_id_pri" class="form-control form-control-sm" onchange="selected();" required="">
                    <?php foreach ($this->user_model->get_department()->result() as $dep) { ?>
                        <option value="<?php echo $dep->dep_id_pri; ?>"><?php echo $dep->dep_name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row m-t-10">
            <div class="col-lg-2 col-md-2"></div>
            <div class="col-lg-4 col-md-4">
                <label class="control-label">ตำแหน่งหลัก <span class="text-danger">*</span></label>
                <select name="officer_id" id="officer_id" class="form-control form-control-sm" required="">
                </select>
            </div>
        </div>
        <div class="row m-t-10">
            <div class="col-lg-2 col-md-2"></div>
            <div class="col-lg-4 col-md-4">
                <label class="control-label">สิทธิ์ <span class="text-danger">*</span></label>
                <select name="role_id" class="form-control form-control-sm" required="">
                    <?php foreach ($this->user_model->get_role()->result() as $role) { ?>
                        <option value="<?php echo $role->role_id; ?>"><?php echo $role->role_name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-lg-2 col-md-2"></div>
            <div class="col-lg-4 col-md-4">
                <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-save"></i> บันทึก</button>
                <a class="btn btn-sm btn-light" href="<?php echo base_url() . 'user'; ?>"><i class="fa fa-reply"></i> กลับ</a>
            </div>
        </div>
    </div>
</form>
<script>

    $(function () {
        selected();
        $('#form-add-user').parsley();
    });

    function trigger_check_all() {
        if ($('#trigger_check_all_input').is(':checked')) {
            $('.check_all_input').prop('checked', true);
        } else {
            $('.check_all_input').prop('checked', false);
        }
    }

    function selected() {
        dep_id_pri = $('#dep_id_pri').val();
        officer_tag = $('#officer_id');
        officer_tag.find('option').remove();
        $.ajax({
            url: service_base_url + 'user/selected_officer',
            type: 'POST',
            dataType: 'json',
            data: {
                dep_id_pri: dep_id_pri
            },
            success: function (response) {
                count_row = response.officer_id.length;
                for (i = 0; i < count_row; i++) {
                    officer_id = response.officer_id[i];
                    officer_name = response.officer_name[i];
                    officer_tag.append($("<option></option>").attr("value", officer_id).text(officer_name));
                }
            }
        });
    }

</script>