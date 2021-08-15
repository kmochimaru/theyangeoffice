<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" width="5%">#</th>
                <th>รหัส</th>
                <th>ชื่อ</th>
                <th>ชื่อย่อ</th>
                <th>สถานะ</th>
                <th class="text-center" width="15%">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($data->num_rows() > 0) {
                $i = 1;
                foreach ($data->result() as $row) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td><?php echo $row->agency_id; ?></td>
                        <td><?php echo $row->agency_name; ?></td>
                        <td><?php echo $row->agency_name_short; ?></td>
                        <?php if ($row->dep_status_id == 1) { ?>                                            
                            <td> <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo $row->dep_status_name; ?></span></td>
                        <?php } else { ?>
                            <td> <span class="badge badge-danger"><i class="fa fa-times"></i> <?php echo $row->dep_status_name; ?></span></td>
                        <?php } ?>                      
                        <td class="text-center">
                            <button type="button" class="btn btn-xs btn-outline-info" onclick="modal_edit(<?php echo $row->agency_id_pri; ?>)"><i class="fa fa-edit"></i> แก้ไข</button>                           
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="modal_delete('<?php echo $row->agency_id_pri; ?>')"><i class="fa fa-trash"></i> ลบ</button>                        
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
            } else {
                ?>
                <tr>
                    <td class="text-center" colspan="6"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>