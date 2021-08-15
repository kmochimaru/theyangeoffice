<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" width="2%">#</th>
                <th width="10%">ประเภทเอกสาร</th>
                <th class="text-center" width="8%">สถานะ</th>
                <th class="text-center" width="6%">เลขทะเบียน</th>
                <th class="text-center" width="10%">เลขที่เอกสาร</th>
                <th width="12%">ปีเอกสาร / ลงวันที่</th>
                <th>เรื่อง</th>
                <!-- <th width="10%">แนบไฟล์</th> -->
                <th width="10%">หมวดเอกสาร</th>
                <th width="12%">ส่งโดย</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            if ($data->num_rows() > 0) {
                $i = $segment + 1;
                foreach ($data->result() as $row) {
            ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td><?php echo $row->work_type_name; ?></td>
                        <td class="text-center" style="font-weight: bold;">
                            <?php if ($row->state_info_id == 5) { ?>
                                <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo $row->state_info_name; ?></span>
                            <?php } else if ($row->state_info_id == 6) { ?>
                                <span class="badge badge-success"><i class="fa fa-power-off"></i> <?php echo $row->state_info_name; ?></span>
                            <?php } else if ($row->state_info_id == 7) { ?>
                                <span class="badge badge-warning"><i class="fa fa-reply-all"></i> <?php echo $row->state_info_name; ?></span>
                            <?php } else if ($row->state_info_id == 8) { ?>
                                <span class="badge badge-danger"><i class="fa fa-reply-all"></i> <?php echo $row->state_info_name; ?></span>
                            <?php } else if ($row->state_info_id == 9) { ?>
                                <span class="badge badge-danger"><i class="fa fa-times-circle"></i> <?php echo $row->state_info_name; ?></span>
                            <?php } else { ?>
                                <span class="badge badge-info"><i class="fa fa-clock-o"></i> <?php echo $row->state_info_name; ?></span>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <?php echo ($row->work_info_id != '' ? $row->work_info_id : '-'); ?>
                        </td>
                        <td class="text-center">
                            <?php echo $row->work_info_no . $row->work_info_no_2 . $row->work_info_no_3; ?><br>
                            <span class="small"><?php echo ($row->attach_original == 1 ? 'ส่งต้นฉบับ' : 'ไม่ส่งต้นฉบับ'); ?></span>
                        </td>
                        <td>
                            <?php echo $row->year; ?> / <?php echo $this->misc->date2thai($row->work_info_date, '%d %m %y', 1); ?>
                        </td>
                        <td>
                            <b><?php echo $row->work_info_subject; ?></b><br>
                            <span class="small"><span class="text-info">จาก :</span> <?php echo $row->work_info_from_position . ' ' . $row->work_info_from; ?></span><br>
                            <span class="small"><span class="text-info">ถึง :</span> <?php echo (($row->work_info_to_position != '') || ($row->work_info_to != '') ? $row->work_info_to_position . ' ' . $row->work_info_to : '-'); ?></span>
                        </td>
                        <!-- <td>
                            <?php
                            // $files = $this->reportwithindep_model->get_workinfofile($row->work_info_id_pri);
                            // if ($files->num_rows() > 0) {
                            //     foreach ($files->result() as $file) {
                            ?>
                                    <a style="padding: 0px" href="<?php //echo base_url() . 'store/file/' . $file->work_info_file_id; ?>" title="<?php //echo $file->work_info_file_oldname; ?>" class="<?php //echo ($file->file_type_check != 2) ? ($file->file_type_check != 1) ? 'fancybox' : 'fancyboxpdf' : ''; ?>">
                                        <img id="icon_show" src="<?php //echo base_url() . 'store/icon/' . $file->file_type_icon; ?>" style="padding: 0px" width="26px" style="cursor:pointer; border: 0px solid whitesmoke">
                                    </a>
                            <?php
                            //     }
                            // } else {
                            //     echo '<i class="fa fa-ban text-danger"></i>';
                            // }
                            ?>
                        </td> -->
                        <td><?php echo $row->book_group_name; ?></td>
                        <td>
                            <span><?php echo $row->user_fullname; ?></span><br>
                            <span class="small"><?php echo $this->reportwithindep_model->getdep_off_id($row->dep_off_id)->officer_name; ?></span>
                        </td>
                    </tr>
                <?php
                    $i++;
                }
            } else {
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
<div class="row m-t-20">
    <?php
    //    if ($count != 0) {
    if ($i > 1) {
    ?>
        <div class="col-sm-5">
            แสดง <?php echo $segment + 1; ?> ถึง <?php echo $i - 1; ?> ทั้งหมด <?php echo ($count); ?> รายการ
        </div>
        <div class="col-sm-7">
            <?php echo $links; ?>
        </div>
    <?php
    }
    ?>
</div>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>