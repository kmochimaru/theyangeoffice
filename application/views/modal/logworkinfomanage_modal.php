<form id="form_cancel_comment_modal" method="post" autocomplete="false" action="#">
    <div class="modal-header">
        <h4 class="modal-title">รายละเอียดเอกสารเลขที่ <?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row" style="margin-left: 50px;">
            <div class="col-md-6 text-left">
                <p style="font-weight: bold;"><u>รายละเอียดของข้อมูล</u></p>
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
            </div>

            <?php $detailold = $this->logworkinfomanage_model->getLogDetailOld($data->work_info_id_pri, $data->log_work_info_id);
            if ($detailold->num_rows() == 1) {
                $detailold = $detailold->row();
                $olds = $this->logworkinfomanage_model->getLogDetail($detailold->log_work_info_id);
                if ($olds->num_rows() == 1) {
                    $old = $olds->row();
            ?>
                    <div class="col-md-6 text-left" style="border-left: 1px solid darkgray;">
                        <p style="font-weight: bold;"><u>รายละเอียดก่อนการแก้ไข </u></p>

                        <div class="form-group row">
                            <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">เลขทะเบียน :</span>
                            <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo ($old->work_info_id != '' ? $old->work_info_id : '-'); ?></span>
                        </div>
                        <div class="form-group row">
                            <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">เลขที่เอกสาร :</span>
                            <span class="col-sm-7 col-form-span" style="font-weight: bold;font-size: 14px;"><?php echo $old->work_info_no . $old->work_info_no_2 . $old->work_info_no_3; ?></span>
                        </div>
                        <div class="form-group row">
                            <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ลงวันที่ :</span>
                            <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $this->misc->date2thai($old->work_info_date, '%d %m %y', 1); ?></span>
                        </div>
                        <div class="form-group row">
                            <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">จาก :</span>
                            <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $old->work_info_from_position . ' ' . $old->work_info_from; ?></span>
                        </div>
                        <div class="form-group row">
                            <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ถึง :</span>
                            <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo (($old->work_info_to_position != '') && ($old->work_info_to != '') ? $old->work_info_to_position . ' ' . $old->work_info_to : '-'); ?></span>
                        </div>
                        <div class="form-group row">
                            <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">เรื่อง :</span>
                            <span class="col-sm-7 col-form-span" style="font-weight: bold;font-size: 14px;"><?php echo $old->work_info_subject; ?></span>
                        </div>
                        <div class="form-group row">
                            <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">รายละเอียด :</span>
                            <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $old->work_info_detail; ?></span>
                        </div>
                        <div class="form-group row">
                            <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">วัตถุประสงค์ :</span>
                            <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $old->action_info_name; ?></span>
                        </div>
                        <div class="form-group row">
                            <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ส่งจาก :</span>
                            <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $old->dep_name; ?></span>
                        </div>

                        <div class="form-group row">
                            <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ประเภทเอกสาร :</span>
                            <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $old->work_type_name; ?></span>
                        </div>

                        <div class="form-group row">
                            <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ชั้นความเร็ว :</span>
                            <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $old->priority_info_name; ?></span>
                        </div>
                        <div class="form-group row">
                            <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ชั้นความลับ :</span>
                            <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $old->secret_level_name; ?></span>
                        </div>
                        <div class="form-group row">
                            <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">หมวดเอกสาร :</span>
                            <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $old->book_group_name; ?></span>
                        </div>

                        <div class="form-group row">
                            <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">ต้นฉบับ :</span>
                            <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo ($old->attach_original == 0) ? 'ไม่ส่งต้นฉบับ' : 'ส่งต้นฉบับ'; ?></span>
                        </div>
                        <div class="form-group row">
                            <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">หมายเหตุ :</span>
                            <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo ($old->work_info_comment != '') ? $old->work_info_comment : '-'; ?></span>
                        </div>
                        <div class="form-group row">
                            <span class="col-sm-4 col-form-span" style="font-weight: bold;font-size: 14px;">สร้างโดย :</span>
                            <span class="col-sm-7 col-form-span" style="font-size: 14px;"><?php echo $data->user_fullname; ?></span>
                        </div>
                    </div>
            <?php }
            }
            ?>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"> ปิด</button>
    </div>
</form>