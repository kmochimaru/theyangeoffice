<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i>&nbsp;<?php echo $title . ' - เลขที่เอกสาร' . ' '; ?><span class="text-muted"><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></span>
                    <span style="float: right">
                        <a href="<?php echo base_url() . 'assignment'; ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-arrow-left"></i> กลับ</a>
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
                                $files = $this->assignment_model->get_workinfofile($data->work_info_id_pri);
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
                                <?php
                                if ($files->num_rows() > 0) {
                                    foreach ($files->result() as $file) {
                                        ?>
                                        <div class="form-group row">
                                            <span class="col-sm-2 col-form-span" style="font-weight: bold;font-size: 14px;">
                                                <a style="padding-right: 5px" href="<?php echo base_url() . 'store/file/' . $file->work_info_file_id; ?>" title="<?php echo $file->work_info_file_oldname; ?>" class="<?php echo ($file->file_type_check != 2) ? ($file->file_type_check != 1) ? 'fancybox' : 'fancyboxpdf' : ''; ?>" target="_blank">
                                                    <img id="icon_show" src="<?php echo base_url() . 'store/icon/' . $file->file_type_icon; ?>" style="padding: 0px" width="28px" style="cursor:pointer; border: 0px solid whitesmoke">
                                                </a>
                                            </span>
                                            <span class="col-sm-10 col-form-span" style="font-size: 14px;"><?php echo $file->work_info_file_oldname; ?></span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
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
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>