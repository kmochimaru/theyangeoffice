<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th >หน่วยงาน</th>
                <th >ตำแหน่ง</th>
                <th class="text-center">สถานะ</th>
                <th class="text-center">เส้นทาง</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $dep_id_pri = $dep_id_pri;
            if ($dep_id_pri == 0) {
                $dep_id_pri = null;
            }
            $datas = $this->routes_model->get_dep_off(null, $dep_id_pri);
            if ($datas->num_rows() > 0) {
                $i = 1;
                foreach ($datas->result() as $data) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td><?php echo $data->dep_name; ?></td>
                        <td><?php echo $data->officer_name; ?></td>
                        <?php
                        $check_status = $this->routes_model->check_status($routes_id, $data->dep_off_id);
                        if ($check_status == 0) {
                            ?>
                            <td class="text-center" id="<?php echo 'routes_show_checkbock' . $data->dep_off_id; ?>" >
                                <span class="badge badge-warning" ><i class="fa fa-times-circle"></i>&nbsp;ไม่เลือก</span>
                            </td>
                        <?php } else {
                            ?>
                            <td class="text-center" id="<?php echo 'routes_show_checkbock' . $data->dep_off_id; ?>" >
                                <span class="badge badge-success" ><i class="fa fa-check-circle"></i>&nbsp;เลือก</span>
                            </td>
                        <?php } ?>
                        <td>
                            <div class="switch text-center">
                                <label>
                                    <input type="checkbox" onchange="switchroutes('<?php echo $routes_id; ?>', '<?php echo $data->dep_off_id; ?>', this);" id="checkbox_<?php echo $data->dep_off_id; ?>" <?php echo ($check_status == 0 ? '' : 'checked'); ?>><span class="lever"></span>
                                </label>
                            </div>
                        </td>
                        <?php
                        $i++;
                    }
                } else {
                    ?>
                <tr>
                    <td class="text-center" colspan="10">ไม่มีข้อมูล</td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
</div>