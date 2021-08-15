<div class="form-group row">
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
                <?php if ($data->state_info_id == 2) { ?>
                    <span class="badge badge-primary"><i class="fa fa-edit"></i> <?php echo $data->state_info_name; ?></span>
                <?php } else if ($data->state_info_id == 3) { ?>
                    <span class="badge badge-success"><i class="fa fa-send-o"></i> <?php echo $data->state_info_name; ?></span>
                <?php } else if ($data->state_info_id == 4) { ?>
                    <span class="badge badge-info"><i class="fa fa-clock-o"></i> <?php echo $data->state_info_name; ?></span>
                <?php } else if ($data->state_info_id == 5) { ?>
                    <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo $data->state_info_name; ?></span>
                <?php } else if ($data->state_info_id == 6) { ?>
                    <span class="badge badge-success"><i class="fa fa-power-off"></i> <?php echo $data->state_info_name; ?></span>
                <?php } else if ($data->state_info_id == 7) { ?>
                    <span class="badge badge-warning"><i class="fa fa-reply-all"></i> <?php echo $data->state_info_name; ?></span>
                <?php } else if ($data->state_info_id == 8) { ?>
                    <span class="badge badge-danger"><i class="fa fa-reply-all"></i> <?php echo $data->state_info_name; ?></span>
                <?php } else { ?>
                    <span class="badge badge-danger"><i class="fa fa-times-circle"></i> <?php echo $data->state_info_name; ?></span>
                <?php }  ?>
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
</div>