<div class="table-responsive" style="min-height: 30vh;">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" width="4%">#</th>
                <th class="text-center" width="4%">Avatar</th>
                <th width="8%">Username</th>
                <th width="12%">ชื่อผู้ใช้งาน</th>
                <th width="10%">เบอร์โทรศัพท์</th>
                <th width="12%">อีเมล</th>
                <th width="15%">สิทธิ์ผู้ใช้งาน</th>
                <th width="15%">หน่วยงาน (ตำแหน่งหลัก)</th>
                <th class="text-center" width="8%">สถานะ/หมดอายุ</th>
                <th class="text-center" width="8%">ตัวเลือก</th>
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
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center">
                            <img class="img-circle" src="<?php echo base_url() . 'assets/upload/user/' . ($row->user_image != '' ? $row->user_image : 'none.png') ?>" width="32" height="32" />
                        </td>
                        <td><?php echo $row->username; ?></td>
                        <td><?php echo $row->user_fullname; ?></td>
                        <td><?php echo $row->user_tel; ?></td>
                        <td><?php echo $row->user_email; ?></td>
                        <td><?php echo $row->role_name; ?></td>
                        <td>
                            <?php
                            $dep_off_result = $this->user_model->getuser_dep_off($row->user_id);
                            if ($dep_off_result->num_rows() > 0) {
                                $dep_off = $dep_off_result->row();
                                echo $dep_off->dep_name_short . ' <span class="text-muted">(' . $dep_off->officer_name . ') <span>';
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <?php if ($row->user_status_id == 1) { ?>
                                <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo $row->user_status_name; ?></span>
                            <?php } else { ?>
                                <span class="badge badge-danger"><i class="fa fa-close"></i> <?php echo $row->user_status_name; ?></span>
                            <?php } ?>
                            <br>
                            <?php if ($row->user_expire != NULL && $row->user_expire <= date('Y-m-d')) { ?>
                                <span class="badge badge-danger"><i class="fa fa-close"></i> หมดอายุ</span>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ตัวเลือก</button>
                                <div class="dropdown-menu">                                    
                                    <button type="button" class="dropdown-item small" onclick="modal_edit(<?php echo $row->user_id; ?>)"><i class="fa fa-edit"></i> แก้ไข</button>
                                    <a class="dropdown-item small" href="<?php echo base_url() . 'user/officer/' . $row->user_id ?>" target="_blank"><i class="fa fa-user-plus"></i> ตำแหน่ง</a>                                    
                                    <button type="button" class="dropdown-item small" onclick="modal_edit_password('<?php echo $row->user_id; ?>')"><i class="fa fa-unlock-alt"></i> เปลี่ยนรหัสผ่าน</button>
                                    <button type="button" class="dropdown-item small" onclick="modal_edit_status('<?php echo $row->user_id; ?>')"><i class="fa fa-close"></i> <?php echo $row->user_status_id == 1 ? 'ระงับ' : 'ยกเลิก'; ?></button>                                    
                                </div>
                            </div>
                        </td>
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
<div class="row m-t-20">
    <?php
    if ($count != 0) {
        ?>
        <div class="col-lg-6">
            แสดง <?php echo $segment + 1; ?> ถึง <?php echo $i - 1; ?> ทั้งหมด <?php echo ($count); ?> รายการ
        </div>
        <div class="col-lg-6">
            <?php echo $links; ?>
        </div>
        <?php
    }
    ?>
</div>