<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" style="padding-bottom: 10px;" width="7%">
                    <input type="checkbox" class="col-sm-4 offset-sm-2 filled-in" name="" id="select_checkbox_all" onchange="select_all();">
                    <label for="select_checkbox_all" style="font-weight: bold;">เลือก</label>
                </th>
                <th style="padding-bottom: 10px;" width="2%"></th>
                <th style="padding-bottom: 10px;" >ชื่อผู้ใช้งาน</th>
                <th style="padding-bottom: 10px;" >หน่วยงาน (ตำแหน่งหลัก)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count_data = $data->num_rows();
            if ($count_data > 0) {
                $i = 1;
                foreach ($data->result() as $row) {
                    if ($this->servicegroup_model->check_help_desk($row->user_id, $service_id) == 0) {
                        ?>
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" name="select_checkbox[]" value="<?php echo $row->user_id ?>" class="col-sm-4 offset-sm-2 filled-in select_checkbox" id="select_checkbox<?php echo $row->user_id; ?>">
                                <label style="margin-bottom: -5px" for="select_checkbox<?php echo $row->user_id; ?>"></label>
                            </td>
                            <td class="text-right"><?php echo $i . '.'; ?></td>
                            <td><?php echo $row->user_fullname; ?></td>
                            <td>
                                <?php
                                $dep_off_result = $this->servicegroup_model->getuser_dep_off($row->user_id);
                                if ($dep_off_result->num_rows() > 0) {
                                    $dep_off = $dep_off_result->row();
                                    echo $dep_off->dep_name . ' <span class="text-muted">(' . $dep_off->officer_name . ') <span>';
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>       
                        </tr>
                        <?php
                        $i++;
                    }
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
<script>
    function select_all() {
        if ($('#select_checkbox_all').is(':checked')) {
            $('.select_checkbox').prop('checked', true);
        } else {
            $('.select_checkbox').prop('checked', false);
        }
    }
</script>