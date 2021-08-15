<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" width="4%">#</th>
                <th >ชื่อผู้ใช้งาน</th>
                <th >สิทธิ์ผู้ใช้งาน</th>
                <th >หน่วยงาน (ตำแหน่งหลัก)</th>
                <th class="text-center" >สถานะ</th>
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
                        <td><?php echo $row->user_fullname; ?></td>
                        <td><?php echo $row->role_name; ?></td>
                        <td>
                            <?php
                            $dep_off_result = $this->notifytoken_model->getuser_dep_off($row->user_id);
                            if ($dep_off_result->num_rows() > 0) {
                                $dep_off = $dep_off_result->row();
                                echo $dep_off->dep_name . ' <span class="text-muted">(' . $dep_off->officer_name . ') <span>';
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>      
                        <td class="text-center" ><?php
                            $token = $this->notifytoken_model->get_line_token($row->user_id)->row();
                            if ($token->user_line_token != null) {
                                echo '<label class="label label-success">ลงทะเบียนแล้ว</label>';
                            } else {
                                echo '<label class="label label-danger">ไม่ได้ลงทะเบียน</label>';
                            }
                            ?>
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