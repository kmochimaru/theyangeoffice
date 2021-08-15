<?php ?>
<html>
    <head>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">   
        <style>
            td{
                border: 0px solid black;
            }
            p{
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
                                <p><?php echo $this->misc->offsetyear($data->work_info_date, 543); ?></p>
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
        </table>
    </body>
</html>