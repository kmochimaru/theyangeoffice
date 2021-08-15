<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" width="5%">#</th>
                <th>รหัส</th>
                <th>ชื่อ</th>
                <th>ชื่อย่อ</th>
                <th class="text-right">หมายเลข</th>
                <th>คำนำหน้า</th>
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
                        <td><?php echo $row->org_id; ?></td>
                        <td><?php echo $row->org_name; ?></td>
                        <td><?php echo $row->org_name_short; ?></td>
                        <td class="text-right"><?php echo $row->org_number; ?></td>
                        <td><?php echo $row->org_prefix; ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-xs btn-outline-info" onclick="modal_edit(<?php echo $row->org_id_pri; ?>)"><i class="fa fa-edit"></i> แก้ไข</button>
                            <?php if ($this->organization_model->check_organization($row->org_id_pri)->num_rows() == 0) { ?>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="modal_delete('<?php echo $row->org_id_pri; ?>')"><i class="fa fa-trash"></i> ลบ</button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-trash"></i> ลบ</button>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
            } else {
                ?>
                <tr>
                    <td class="text-center" colspan="7"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>