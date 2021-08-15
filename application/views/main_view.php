<div class="row">
    <div class="col-md-6 align-self-center">
        <h3 class="text-themecolor">ภาพรวมของปี <?php echo $this->session->userdata('year'); ?></h3>
    </div>    
</div>

<div class="row">
    <div class="col-lg-3">
        <div class="card bg-info">
            <div class="card-body">
                <a href="<?php echo base_url() . 'receivework'; ?>">
                    <div class="d-flex no-block">
                        <div class="m-r-20 align-self-center round round-lg round-info"><i class="fa fa-briefcase"></i></div>
                        <div class="align-self-center">
                            <h6 class="text-white m-t-10 m-b-0">งานที่รับมอบหมาย <small>(จำนวน)</small></h6>
                            <h2 class="m-t-0 text-white"><?php echo $this->main_model->countWordUser(); ?></h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <?php
    $role_arr = array(2, 3, 8, 10);
    if (in_array($this->session->userdata('role_id'), $role_arr)) {
        $withinwaiting = base_url() . 'receivelist';
        $withinprocess = base_url() . 'withinwaiting';
        $followme = base_url() . 'followme';

        $countWaiting = $this->main_model->countWorkInfoReceive();
        $countprocess = $this->main_model->countProcess();
        $countFollowme = $this->main_model->countFollowme();
    } else {
        $withinwaiting = 'javascript:void();';
        $withinprocess = 'javascript:void();';
        $followme = 'javascript:void();';
//
        $countWaiting = '<i class="fa fa-minus-circle"></i>';
        $countprocess = '<i class="fa fa-minus-circle"></i>';
        $countFollowme = '<i class="fa fa-minus-circle"></i>';
    }
    ?>
    <div class="col-lg-3">
        <div class="card bg-success">
            <div class="card-body">
                <a href="<?php echo $withinwaiting; ?>">
                    <div class="d-flex no-block">
                        <div class="m-r-20 align-self-center round round-lg round-success"><i class="fa fa-paperclip"></i></div>
                        <div class="align-self-center">
                            <h6 class="text-white m-t-10 m-b-0">หนังสือรอลงรับ <small>(จำนวน)</small></h6>                            
                            <h2 class="m-t-0 text-white"><?php echo $countWaiting; ?></h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card bg-primary">
            <div class="card-body">
                <a href="<?php echo $withinprocess; ?>">
                    <div class="d-flex no-block">
                        <div class="m-r-20 align-self-center round round-lg round-primary"><i class="fa fa-telegram"></i></div>
                        <div class="align-self-center">
                            <h6 class="text-white m-t-10 m-b-0">หนังสือรอดำเนินการ <small>(จำนวน)</small></h6>
                            <h2 class="m-t-0 text-white"><?php echo $countprocess; ?></h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card bg-danger">
            <div class="card-body">
                <a href="<?php echo $followme; ?>">
                    <div class="d-flex no-block">
                        <div class="m-r-20 align-self-center round round-lg round-danger"><i class="fa fa-envelope-o"></i></div>
                        <div class="align-self-center">
                            <h6 class="text-white m-t-10 m-b-0">หนังสือที่ต้องติดตาม <small>(จำนวน)</small></h6>
                            <h2 class="m-t-0 text-white"><?php echo $countFollowme; ?></h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<?php
if (in_array($this->session->userdata('role_id'), $role_arr)) {
    ?>
    <div class="row">
        
        <div class="col-md-6 col-sm-12">
            <div class="card">            
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="<?php echo base_url() . 'receivelist'; ?>"><i class="fa fa-download"></i> รายการลงรับหนังสือล่าสุด</a>
                    </h4>
                    <div class="table-responsive" style="min-height: 20vh;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <!--<th class="text-center" width="3%">#</th>-->
                                    <th class="text-center" width="8%">ทะเบียน</th>
                                    <th class="text-center" width="15%">เลขที่เอกสาร</th>
                                    <th class="text-center" width="15%">เข้าเมื่อ</th>
                                    <th >จากหน่วยงาน</th>
                                    <th class="text-center" width="8%">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data = $this->main_model->getWorkInfoReceive();
                                $j = 1;
                                if ($data->num_rows() > 0) {
                                    foreach ($data->result() as $rows) {
                                        $row = $this->main_model->getWorkInfoData($rows->work_process_id_pri)->row();
                                        if ($row->work_process_sendtype != 2) {
                                            ?>
                                            <tr>
                                                <!--<td class="text-center"><?php echo $j . '.'; ?></td>-->
                                                <td class="text-center">
                                                    <?php
                                                    if ($row->work_process_receive != 1) {
                                                        echo '-';
                                                    } else {
                                                        echo $row->work_process_receive_id;
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?php echo base_url() . 'receivelist/detail/' . $row->work_process_id_pri . '/1'; ?>" title="เปิด" data-toggle="tooltip">
                                                        <?php echo $row->work_process_no . $row->work_process_no_2 . $row->work_process_no_3; ?>
                                                    </a>
                                                    <br>
                                                    <span class="small"><?php echo ($row->attach_original == 1 ? 'ส่งต้นฉบับ' : 'ไม่ส่งต้นฉบับ'); ?></span>
                                                </td>
                                                <td ><?php echo $this->misc->date2thai($row->work_process_create, '%d %m %y', 1) . ' ' . $this->misc->date2thai($row->work_process_create, '%h:%i'); ?></td>
                                                <td >
                                                    <b><?php echo $row->work_info_subject; ?></b><br>
                                                    <span class="small"><span class="text-info">จาก :</span> <?php echo $this->main_model->getdepartment($row->work_info_dep_id_pri)->row()->dep_name; ?></span><br>
                                                </td>
                                                <td class="text-center" style="font-weight: bold;">
                                                    <?php if ($row->work_process_receive != 1) { ?>
                                                        <span class="badge badge-warning"><i class="fa fa-envelope"></i> <?php echo 'รอเปิด'; ?></span>
                                                    <?php } else { ?>
                                                        <span class="badge badge-success"><i class="fa fa-envelope-open"></i> <?php echo 'เปิดแล้ว'; ?></span>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $j++;
                                        } else {
                                            if ($row->work_process_sort == 1) {
                                                ?>
                                                <tr>
                                                    <!--<td class="text-center"><?php echo $j . '.'; ?></td>-->
                                                    <td class="text-center">
                                                        <?php
                                                        if ($row->work_process_receive != 0) {
                                                            echo $row->work_process_receive_id;
                                                        } else {
                                                            echo '-';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="<?php echo base_url() . 'receivelist/detail/' . $row->work_process_id_pri . '/1'; ?>" title="เปิด" data-toggle="tooltip">
                                                            <?php echo $row->work_process_no . $row->work_process_no_2 . $row->work_process_no_3; ?>
                                                        </a>
                                                        <br>
                                                        <span class="small"><?php echo ($row->attach_original == 1 ? 'ส่งต้นฉบับ' : 'ไม่ส่งต้นฉบับ'); ?></span>
                                                    </td>
                                                    <td ><?php echo $this->misc->date2thai($row->work_process_create, '%d %m %y', 1) . ' ' . $this->misc->date2thai($row->work_process_create, '%h:%i'); ?></td>
                                                    <td >
                                                        <b><?php echo $row->work_info_subject; ?></b><br>
                                                        <span class="small"><span class="text-info">จาก :</span> <?php echo $this->main_model->getdepartment($row->work_info_dep_id_pri)->row()->dep_name; ?></span><br>
                                                    </td>
                                                    <td class="text-center" style="font-weight: bold;">
                                                        <?php if ($row->work_process_receive != 1) { ?>
                                                            <span class="badge badge-warning"><i class="fa fa-envelope"></i> <?php echo 'รอเปิด'; ?></span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-success"><i class="fa fa-envelope-open"></i> <?php echo 'เปิดแล้ว'; ?></span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $j++;
                                            } else {
                                                ?>
                                                <tr>
                                                    <!--<td class="text-center"><?php echo $j . '.'; ?></td>-->
                                                    <td class="text-center">
                                                        <?php
                                                        if ($row->work_process_receive != 0) {
                                                            echo $row->work_process_receive_id;
                                                        } else {
                                                            echo '-';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="<?php echo base_url() . 'receivelist/detail/' . $row->work_process_id_pri . '/1'; ?>" title="เปิด" data-toggle="tooltip">
                                                            <?php echo $row->work_process_no . $row->work_process_no_2 . $row->work_process_no_3; ?>
                                                        </a>
                                                        <br>
                                                        <span class="small"><?php echo ($row->attach_original == 1 ? 'ส่งต้นฉบับ' : 'ไม่ส่งต้นฉบับ'); ?></span>
                                                    </td>
                                                    <td class="text-center"><?php echo $this->misc->date2thai($row->work_process_create, '%d %m %y', 1) . ' ' . $this->misc->date2thai($row->work_process_create, '%h:%i'); ?></td>
                                                    <td >
                                                        <b><?php echo $row->work_info_subject; ?></b><br>
                                                        <span class="small"><span class="text-info">จาก :</span> <?php echo $this->main_model->getdepartment($row->work_info_dep_id_pri)->row()->dep_name; ?></span><br>
                                                    </td>
                                                    <td class="text-center" style="font-weight: bold;">
                                                        <?php if ($row->work_process_receive != 1) { ?>
                                                            <span class="badge badge-warning"><i class="fa fa-envelope"></i> <?php echo 'รอเปิด'; ?></span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-success"><i class="fa fa-envelope-open"></i> <?php echo 'เปิดแล้ว'; ?></span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $j++;
                                            }
                                        }
                                    }
                                } if ($j == 1) {
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
        
        <div class="col-md-6 col-sm-12">
            <div class="card">            
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="<?php echo base_url() . 'withinlist'; ?>"><i class="fa fa-telegram"></i> รายการหนังสือส่งล่าสุด</a>
                    </h4>
                    <div class="table-responsive" style="min-height: 20vh;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <!--<th class="text-center" width="3%">#</th>-->
                                    <th class="text-center" width="8%">ทะเบียน</th>
                                    <th class="text-center" width="15%">เลขที่เอกสาร</th>
                                    <th class="text-center" width="15%">ส่งเมื่อ</th>
                                    <th>จากหน่วยงาน</th>
                                    <th class="text-center" width="8%">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $datas = $this->main_model->getWorkInfoSend();
                                $i = 1;
                                if ($datas->num_rows() > 0) {
                                    foreach ($datas->result() as $row) {
                                        ?>
                                        <tr>
                                            <!--<td class="text-center"><?php echo $i . '.'; ?></td>-->
                                            <td class="text-center">
                                                <?php echo ($row->work_info_id != '' ? $row->work_info_id : '-'); ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?php echo base_url() . 'withinlist/detail/' . $row->work_info_code . '/1'; ?>" title="รายละเอียด" data-toggle="tooltip">
                                                    <?php echo $row->work_info_no . $row->work_info_no_2 . $row->work_info_no_3; ?>
                                                </a>
                                                <br>
                                                <span class="small"><?php echo ($row->attach_original == 1 ? 'ส่งต้นฉบับ' : 'ไม่ส่งต้นฉบับ'); ?></span>
                                            </td>
                                            <td>
                                                <?php echo $this->misc->date2thai($row->work_info_date, '%d %m %y', 1); ?>
                                            </td>                        
                                            <td>
                                                <b><?php echo $row->work_info_subject; ?></b><br>
                                                <span class="small"><span class="text-info">จาก :</span> <?php echo $row->work_info_from_position . ' ' . $row->work_info_from; ?></span><br>
                                                <span class="small"><span class="text-info">ถึง :</span> <?php echo (($row->work_info_to_position != '') && ($row->work_info_to != '') ? $row->work_info_to_position . ' ' . $row->work_info_to : '-'); ?></span>
                                            </td>
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
    <?php
}
?>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card">            
            <div class="card-body">
                <h4 class="card-title">
                    <a href="<?php echo base_url() . 'receivework'; ?>"><i class="fa fa-briefcase"></i> งานที่รับมอบหมายล่าสุด</a>
                </h4>
                <div class="table-responsive" style="min-height: 20vh;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">#</th>
                                <th class="text-center" width="6%">สถานะ</th>
                                <th class="text-center" width="10%">เลขที่เอกสาร</th>
                                <th width="19%">ปีเอกสาร / ลงวันที่</th>      
                                <th >เรื่อง</th>                                
                                <th width="20%">มอบโดย</th>                                                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $receives = $this->main_model->getReceiveWork();
                            $i = 1;
                            if ($receives->num_rows() > 0) {
                                foreach ($receives->result() as $row_r_r) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i . '.'; ?></td>
                                        <td class="text-center" style="font-weight: bold;">
                                            <?php if ($row_r_r->work_user_status_id == 1) { ?>
                                                <span class="badge badge-warning"><i class="fa fa-clock-o"></i> รอดำเนินการ</span>
                                            <?php } else if ($row_r_r->work_user_status_id == 2) { ?>
                                                <span class="badge badge-primary"><i class="fa fa-hourglass-start"></i> ดำเนินการ</span>
                                            <?php } else { ?>
                                                <span class="badge badge-success"><i class="fa fa-check"></i> เสร็จสิ้น</span>
                                            <?php } ?>
                                        </td>   
                                        <td class="text-center">
                                            <a href="<?php echo base_url() . 'receivework/detail/' . $row_r_r->work_user_id . '/1'; ?>" title="เปิด" data-toggle="tooltip"><?php echo $row_r_r->work_info_no . $row_r_r->work_info_no_2 . $row_r_r->work_info_no_3; ?></a>                                                                        
                                        </td>
                                        <td>
                                            <?php echo $row_r_r->year; ?> / <?php echo $this->misc->date2thai($row_r_r->work_info_date, '%d %m %y', 1); ?></a>
                                        </td>    
                                        <td>
                                            <b><?php echo $row_r_r->work_info_subject; ?></b><br>
                                            <span class="small"><span class="text-info">จาก :</span> <?php echo $row_r_r->work_info_from_position . ' ' . $row_r_r->work_info_from; ?></span><br>
                                        </td>
                                        <td>
                                            <?php
                                            $dep_off_id = $this->main_model->getdep_off_id($this->main_model->getworkprocess($row_r_r->work_process_id_pri)->row()->dep_off_id);
                                            echo $dep_off_id->dep_name;
                                            ?>
                                            <br>
                                            <span class="small"><?php echo $dep_off_id->officer_name; ?></span> 
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
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        
    </div>
</div>

<script>
    $(function () {
        var url = window.location;
        var element = $('ul#sidebarnav a').filter(function () {
            return this.href == url;
        }).parent().addClass('active');
    });
</script>