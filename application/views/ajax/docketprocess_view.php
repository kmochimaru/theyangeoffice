<?php ?>
<html>

<head>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
    <style>
        td {
            border: 0px solid black;
        }

        p {
            font-size: 14pt;
        }
    </style>
</head>

<body>
    <table style="border-collapse: collapse;width: 100%;">
        <tr>
            <td style="vertical-align: top;">
                <p style="font-weight: bold;"><?php echo 'เลขทะเบียน ' . $data->work_info_id; ?></p>
            </td>
            <td style="vertical-align: top; text-align: right;">
                <p style="font-weight: bold;"><?php echo 'สถานะ ' . $this->printout_model->ref_state_info($data->state_info_id)->row()->state_info_name; ?></p>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top;" width="50%">
                <table style="border-collapse: collapse;width: 100%;">
                    <tr>
                        <td style="text-align: right;padding-right: 20px;" width="40%">
                            <p style="font-weight: bold;"><?php echo 'เลขที่เอกสาร'; ?></p>
                        </td>
                        <td>
                            <p><?php echo $data->work_info_no . $data->work_info_no_2 . $data->work_info_no_3; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;padding-right: 20px;">
                            <p style="font-weight: bold;"><?php echo 'ประเภทเอกสาร'; ?></p>
                        </td>
                        <td>
                            <p><?php echo $this->printout_model->ref_work_type($data->work_type_id)->row()->work_type_name; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;padding-right: 20px;">
                            <p style="font-weight: bold;"><?php echo 'จาก'; ?></p>
                        </td>
                        <td>
                            <p><?php echo $data->work_info_from_position . '' . $data->work_info_from; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;padding-right: 20px;">
                            <p style="font-weight: bold;"><?php echo 'ถึง'; ?></p>
                        </td>
                        <td>
                            <p><?php echo $data->work_info_to_position . '' . $data->work_info_to; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;padding-right: 20px;">
                            <p style="font-weight: bold;"><?php echo 'หมวดเอกสาร'; ?></p>
                        </td>
                        <td>
                            <p><?php echo $this->printout_model->ref_book_group($data->book_group_id)->row()->book_group_name; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;padding-right: 20px;">
                            <p style="font-weight: bold;"><?php echo 'เรื่อง'; ?></p>
                        </td>
                        <td>
                            <p><?php echo $data->work_info_subject; ?></p>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="vertical-align: top;" width="50%">
                <table style="border-collapse: collapse;width: 100%;">
                    <tr>
                        <td style="text-align: right;padding-right: 20px;">
                            <p style="font-weight: bold;"><?php echo 'ลงวันที่'; ?></p>
                        </td>
                        <td>
                            <p><?php echo $this->misc->date2thai($data->work_info_date, '%d %m %y', 1); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;padding-right: 20px;" width="40%">
                            <p style="font-weight: bold;"><?php echo 'ชั้นความเร็ว'; ?></p>
                        </td>
                        <td>
                            <p><?php echo $this->printout_model->ref_priority_info($data->priority_info_id)->row()->priority_info_name; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;padding-right: 20px;">
                            <p style="font-weight: bold;"><?php echo 'ชั้นความลับ'; ?></p>
                        </td>
                        <td>
                            <p><?php echo $this->printout_model->ref_secret_level($data->secret_level_id)->row()->secret_level_name; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;padding-right: 20px;">
                            <p style="font-weight: bold;"><?php echo 'ผู้ส่ง'; ?></p>
                        </td>
                        <td>
                            <p><?php echo $this->printout_model->get_uesr($data->user_id)->row()->user_fullname; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;padding-right: 20px;">
                            <p style="font-weight: bold;"><?php echo 'หน่วยงาน'; ?></p>
                        </td>
                        <td>
                            <p><?php echo $this->printout_model->get_department($data->dep_id_pri)->row()->dep_name; ?></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <?php
        $rows = $workprocess;
        if ($rows->num_rows() > 0) {
            $i = 1;
            foreach ($rows->result() as $row) {
                if ($row->work_process_receive == 1) {
                    if ($row->special_command_id != 1 || $row->work_process_status_id > 1) { ?>
                        <tr>
                            <td style="vertical-align: top;" width="50%">
                                <hr>
                                <table style="border-collapse: collapse;width: 100%;">
                                    <tr>
                                        <td style="text-align: right;padding-right: 20px;" width="40%">
                                            <p style="font-weight: bold;"><?php echo 'เลขทะเบียนรับ'; ?></p>
                                        </td>
                                        <td>
                                            <p><?php echo $row->work_process_receive_id; ?></p>
                                        </td>
                                    </tr>
                                    <?php if ($row->work_process_status_id == 1) { ?>
                                        <tr>
                                            <td style="text-align: right;padding-right: 20px;" width="40%">
                                                <p style="font-weight: bold;"><?php echo 'สถานะตอบรับ'; ?></p>
                                            </td>
                                            <td>
                                                <p><?php echo $this->printout_model->ref_special_command($row->special_command_id)->row()->special_command_name; ?></p>
                                            </td>
                                        </tr>
                                    <?php }
                                    if ($row->work_process_status_id != 3) { ?>
                                        <tr>
                                            <td style="text-align: right;padding-right: 20px;" width="40%">
                                                <p style="font-weight: bold;"><?php echo 'บันทึกงาน'; ?></p>
                                            </td>
                                            <td>
                                                <p><?php echo $row->work_process_receive_comment; ?></p>
                                            </td>
                                        </tr>
                                    <?php }
                                    if ($row->work_process_status_id == 2) { ?>
                                        <tr>
                                            <td style="text-align: right;padding-right: 20px;" width="40%">
                                                <p style="font-weight: bold;"><?php echo 'บันทึกงาน (ตีกลีบ)'; ?></p>
                                            </td>
                                            <td>
                                                <p><?php echo $row->work_process_receive_commentback; ?></p>
                                            </td>
                                        </tr>
                                    <?php } else if ($row->work_process_status_id == 3) { ?>
                                        <tr>
                                            <td style="text-align: right;padding-right: 20px;" width="40%">
                                                <p style="font-weight: bold;"><?php echo 'บันทึกงาน (รับตีกลับ)'; ?></p>
                                            </td>
                                            <td>
                                                <p><?php echo $row->work_process_receive_comment; ?></p>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </td>
                            <td style="vertical-align: top;" width="50%">
                                <hr>
                                <table style="border-collapse: collapse;width: 100%;">
                                    <?php if ($row->work_process_receive_signature != null) { ?>
                                        <tr>
                                            <td style="text-align: center;padding-right: 20px;vertical-align: middle;">
                                                <p><img width="200px" height="50px" src="<?php echo base_url() . 'assets/upload/signature/' . $row->work_process_receive_signature; ?>"></p>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td style="text-align: center;padding-right: 20px;">
                                            <p><?php echo $row->work_process_receive_signature_name; ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;padding-right: 19px;">
                                            <p><?php echo ($row->work_process_act_for_flag == 1 ? $row->work_process_act_for_position : $this->printout_model->getdepoff($row->dep_off_id)->row()->officer_name_display . ' ' . $this->printout_model->getdepoff($row->dep_off_id)->row()->dep_name); ?></p>
                                        </td>
                                    </tr>
                                    <?php if ($row->work_process_receive_signature_key != null) { ?>
                                        <tr>
                                            <td style="text-align: center;padding-right: 18px;">
                                                <p><?php echo $this->misc->date2thai($row->work_process_receive_signature_date, '%d %m %y เวลา %h:%i:%s', 1) . '  Non-PKI server Sign'; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;padding-right: 17px;">
                                                <p><?php echo 'Signature Code : ' . $row->work_process_receive_signature_key;  ?></p>
                                            </td>
                                        </tr>
                                    <?php } else { ?>
                                        <tr>
                                            <td style="text-align: center;padding-right: 18px;">
                                                <p><?php echo $row->special_command_id == 1 ?  $this->misc->date2thai($row->work_process_receive_date, '%d %m %y เวลา %h:%i:%s', 1) : $this->misc->date2thai($row->work_process_receive_signature_date, '%d %m %y เวลา %h:%i:%s', 1); ?></p>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </td>
                        </tr>
                        <?php
                    }
                    $users = $this->printout_model->work_user_work_process($row->work_process_id_pri);
                    if ($users->num_rows() > 0) {
                        foreach ($users->result() as $user) {
                        ?>
                            <tr>
                                <td style="vertical-align: top;" width="50%">
                                    <hr>
                                    <table style="border-collapse: collapse;width: 100%;">
                                        <tr>
                                            <td style="text-align: right;padding-right: 20px;" width="40%">
                                                <p style="font-weight: bold;"><?php echo 'บันทึกงาน'; ?></p>
                                            </td>
                                            <td>
                                                <p><?php echo $user->work_user_comment; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right;padding-right: 20px;" width="40%">
                                                <p style="font-weight: bold;"><?php echo 'รายงานผล'; ?></p>
                                            </td>
                                            <td>
                                                <p><?php echo $user->work_user_report; ?></p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="vertical-align: top;" width="50%">
                                    <hr>
                                    <table style="border-collapse: collapse;width: 100%;">
                                        <?php if ($user->work_user_signature != null) { ?>
                                            <tr>
                                                <td style="text-align: center;padding-right: 20px;vertical-align: middle;">
                                                    <p><img width="200px" height="50px" src="<?php echo base_url() . 'assets/upload/signature/' . $user->work_user_signature; ?>"></p>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td style="text-align: center;padding-right: 20px;">
                                                <p><?php echo $user->work_user_signature_name; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;padding-right: 19px;">
                                                <p><?php echo 'ผู้ปฏิบัติงาน'; ?></p>
                                            </td>
                                        </tr>
                                        <?php if ($user->work_user_signature_key != null) { ?>
                                            <tr>
                                                <td style="text-align: center;padding-right: 18px;">
                                                    <p><?php echo $this->misc->date2thai($user->work_user_signature_date, '%d %m %y เวลา %h:%i:%s', 1) . '  Non-PKI server Sign'; ?></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;padding-right: 17px;">
                                                    <p><?php echo 'Signature Code : ' . $user->work_user_signature_key;  ?></p>
                                                </td>
                                            </tr>
                                        <?php } else { ?>
                                            <tr>
                                                <td style="text-align: center;padding-right: 18px;">
                                                    <p><?php echo $this->misc->date2thai($user->work_user_signature_date, '%d %m %y เวลา %h:%i:%s', 1); ?></p>
                                                </td>
                                            </tr>
                                        <?php }  ?>
                                    </table>
                                </td>
                            </tr>
        <?php

                        }
                    }
                }
            }
        }
        ?>
    </table>
</body>

</html>