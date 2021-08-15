<div class="table-responsive" style="min-height: 30vh;">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" width="2%">#</th>
                <th width="5%">สถานะ</th>
                <th class="text-center" width="5%">ทะเบียนรับ</th>
                <th class="text-center" width="8%">เลขที่เอกสาร</th>
                <th width="12%">ปีเอกสาร / ลงวันที่</th>
                <th>จาก</th>
                <th>เรื่อง</th>
                <th width="10%">ชั้นความเร็ว</th>
                <th width="10%">หมวดเอกสาร</th>
                <th width="10%">ผู้ลงรับ</th>
                <th class="text-center" width="10%">วันที่ลงรับ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            if ($data->num_rows() > 0) {
                $i = $segment + 1;
                foreach ($data->result() as $rows) {
                    $row = $this->reportreceivelistalldep_model->getData($rows->work_process_id_pri)->row();
                    if ($row->work_process_sendtype != 2) {
            ?>
                        <tr>
                            <td class="text-center"><?php echo $i; ?></td>
                            <td>
                                <?php
                                if ($row->work_process_receive == 1) {
                                    if ($row->state_info_id == 6) {
                                        echo 'ปิดงานแล้ว';
                                    } else {
                                        echo 'ลงรับแล้ว';
                                    }
                                } else {
                                    echo 'รอลงรับ';
                                } ?>
                            </td>
                            <td class="text-center">
                                <?php
                                if ($row->work_process_receive != 1) {
                                    echo '-';
                                } else {
                                ?>
                                    <span><?php echo $row->work_process_receive_id; ?></span>
                                <?php
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <span><?php echo $row->work_process_no . $row->work_process_no_2 . $row->work_process_no_3; ?></span>
                                <br>
                                <span class="small"><?php echo ($row->attach_original == 1 ? 'ส่งต้นฉบับ' : 'ไม่ส่งต้นฉบับ'); ?></span>
                            </td>
                            <td>
                                <?php echo $row->year; ?> / <?php echo $this->misc->date2thai($row->work_info_date, '%d %m %y', 1); ?><br>
                            </td>
                            <td>
                                <?php echo $this->reportreceivelistalldep_model->getdep_off($row->work_info_dep_id_pri)->row()->dep_name; ?>
                                <br>
                                <span class="small"><?php echo $this->reportreceivelistalldep_model->getdep_off_id($row->work_info_dep_off_id)->officer_name; ?></span>
                            </td>
                            <td>
                                <b><?php echo $row->work_info_subject; ?></b><br>
                                <span class="small"><span class="text-info">จาก :</span> <?php echo $row->work_info_from_position . ' ' . $row->work_info_from; ?></span><br>
                                <span class="small"><span class="text-info">ถึง :</span> <?php echo (($row->work_info_to_position != '') || ($row->work_info_to != '') ? $row->work_info_to_position . ' ' . $row->work_info_to : '-'); ?></span>
                            </td>
                            <td><?php echo $row->priority_info_name; ?></td>
                            <td><?php echo $row->book_group_name; ?></td>
                            <?php if ($row->work_process_receive == 1) { ?>
                                <td><?php echo $row->work_process_receive_name; ?>
                                    <br>
                                    <span class="small"><?php echo $this->reportreceivelistalldep_model->getdep_off_id($row->dep_off_id)->officer_name; ?></span>
                                </td>
                                <td class="text-center"><?php echo $this->misc->offsetyear($row->work_process_receive_date, 543) . ' ' . $this->misc->date2thai($row->work_process_receive_date, '%h:%i'); ?></td>
                            <?php } else { ?>
                                <td></td>
                                <td></td>
                            <?php } ?>
                        </tr>
                        <?php
                        $i++;
                    } else {
                        if ($row->work_process_sort == 1) {
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i; ?></td>
                                <td>
                                    <?php
                                    if ($row->work_process_receive == 1) {
                                        if ($row->state_info_id == 6) {
                                            echo 'ปิดงานแล้ว';
                                        } else {
                                            echo 'ลงรับแล้ว';
                                        }
                                    } else {
                                        echo 'ไม่ลงรับ';
                                    } ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if ($row->work_process_receive != 1) {
                                        echo '-';
                                    } else {
                                    ?>
                                        <span class="text-info"><?php echo $row->work_process_receive_id; ?></span>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <span class="text-info"><?php echo $row->work_process_no . $row->work_process_no_2 . $row->work_process_no_3; ?></span>
                                    <br>
                                    <span class="small"><?php echo ($row->attach_original == 1 ? 'ส่งต้นฉบับ' : 'ไม่ส่งต้นฉบับ'); ?></span>
                                </td>
                                <td>
                                    <?php echo $row->year; ?> / <?php echo $this->misc->date2thai($row->work_info_date, '%d %m %y', 1); ?><br>
                                </td>
                                <td>
                                    <?php echo $this->reportreceivelistalldep_model->getdep_off($row->work_info_dep_id_pri)->row()->dep_name; ?>
                                    <br>
                                    <span class="small"><?php echo $this->reportreceivelistalldep_model->getdep_off_id($row->work_info_dep_off_id)->officer_name; ?></span>
                                </td>
                                <td>
                                    <b><?php echo $row->work_info_subject; ?></b><br>
                                    <span class="small"><span class="text-info">จาก :</span> <?php echo $row->work_info_from_position . ' ' . $row->work_info_from; ?></span><br>
                                    <span class="small"><span class="text-info">ถึง :</span> <?php echo (($row->work_info_to_position != '') || ($row->work_info_to != '') ? $row->work_info_to_position . ' ' . $row->work_info_to : '-'); ?></span>
                                </td>
                                <td><?php echo $row->priority_info_name; ?></td>
                                <td><?php echo $row->book_group_name; ?></td>
                                <?php if ($row->work_process_receive == 1) { ?>
                                    <td><?php echo $row->work_process_receive_name; ?>
                                        <br>
                                        <span class="small"><?php echo $this->reportreceivelistalldep_model->getdep_off_id($row->dep_off_id)->officer_name; ?></span>
                                    </td>
                                    <td class="text-center"><?php echo $this->misc->offsetyear($row->work_process_receive_date, 543) . ' ' . $this->misc->date2thai($row->work_process_receive_date, '%h:%i'); ?></td>
                                <?php } else { ?>
                                    <td></td>
                                    <td></td>
                                <?php } ?>
                            </tr>
                        <?php
                            $i++;
                        } else {
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i; ?></td>
                                <td style="font-weight: bold;">
                                    <?php
                                    if ($row->work_process_receive == 1) {
                                        if ($row->state_info_id == 6) {
                                            echo 'ปิดงานแล้ว';
                                        } else {
                                            echo 'ลงรับแล้ว';
                                        }
                                    } else {
                                        echo 'ไม่ลงรับ';
                                    } ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if ($row->work_process_receive != 1) {
                                        echo '-';
                                    } else {
                                    ?>
                                        <span class="text-info"><?php echo $row->work_process_receive_id; ?></span>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo base_url() . 'reportreceivelistdep/detail/' . $row->work_process_id_pri . '/1'; ?>" title="เปิด" data-toggle="tooltip">
                                        <span class="text-info"><?php echo $row->work_process_no . $row->work_process_no_2 . $row->work_process_no_3; ?></span>
                                    </a>
                                    <br>
                                    <span class="small"><?php echo ($row->attach_original == 1 ? 'ส่งต้นฉบับ' : 'ไม่ส่งต้นฉบับ'); ?></span>
                                </td>
                                <td>
                                    <?php echo $row->year; ?> / <?php echo $this->misc->date2thai($row->work_info_date, '%d %m %y', 1); ?><br>
                                </td>
                                <td>
                                    <?php echo $this->reportreceivelistalldep_model->getdep_off($row->work_info_dep_id_pri)->row()->dep_name; ?>
                                    <br>
                                    <span class="small"><?php echo $this->reportreceivelistalldep_model->getdep_off_id($row->work_info_dep_off_id)->officer_name; ?></span>
                                </td>
                                <td>
                                    <b><?php echo $row->work_info_subject; ?></b><br>
                                    <span class="small"><span class="text-info">จาก :</span> <?php echo $row->work_info_from_position . ' ' . $row->work_info_from; ?></span><br>
                                    <span class="small"><span class="text-info">ถึง :</span> <?php echo (($row->work_info_to_position != '') || ($row->work_info_to != '') ? $row->work_info_to_position . ' ' . $row->work_info_to : '-'); ?></span>
                                </td>
                                <td><?php echo $row->priority_info_name; ?></td>
                                <td><?php echo $row->book_group_name; ?></td>
                                <td><?php echo $row->work_process_receive_name; ?></td>
                                <?php if ($row->work_process_receive == 1) { ?>
                                    <td><?php echo $row->work_process_receive_name; ?>
                                        <br>
                                        <span class="small"><?php echo $this->reportreceivelistalldep_model->getdep_off_id($row->dep_off_id)->officer_name; ?></span>
                                    </td>
                                    <td class="text-center"><?php echo $this->misc->offsetyear($row->work_process_receive_date, 543) . ' ' . $this->misc->date2thai($row->work_process_receive_date, '%h:%i'); ?></td>
                                <?php } else { ?>
                                    <td></td>
                                    <td></td>
                                <?php } ?>
                            </tr>
                <?php
                            $i++;
                        }
                    }
                }
            }
            if ($i <= 1) {
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
    if ($i > 1) {
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

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>