<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" width="2%">#</th>
                <th >รหัสพัสดุ</th>
                <th >วัน-เวลาพัสดุเข้า</th>
                <th >กลุ่มผู้รับ</th>
                <th >พัสดุส่งถึง</th>
                <th >พัสดุส่งจาก</th>
                <th >ขนส่ง / ประเภท</th>
                <th >สถานที่จัดเก็บพัสดุ</th>
                <th >ผู้รับพัสดุ</th>
                <th >วัน-เวลาพัสดุออก</th>
                <th class="text-center">สถานะ</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $count_data = $data->num_rows();
            if ($count_data > 0) {
                $i = 1;
                foreach ($data->result() as $row) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td ><?php echo $row->post_parcel_code; ?></td>
                        <td ><?php echo $this->misc->date2thai($row->post_parcel_in, '%d %m %y %h:%i', 1); ?></td>
                        <td ><?php echo $row->parcel_group_name; ?></td>
                        <td ><?php echo $row->post_parcel_name . ' ' . ($row->post_parcel_tel != null ? 'โทร. '.$row->post_parcel_tel : ''); ?><br><span><?php echo $row->post_parcel_to; ?></span></td>
                        <td ><?php echo $row->post_parcel_from; ?></td>
                        <td ><?php echo $row->parcel_tran_name; ?><br><span><?php echo $row->parcel_type_name; ?></span></td>
                        <td ><?php echo $row->post_parcel_store; ?></td>
                        <td ><?php echo $row->parcel_status_id != 1 ? $row->post_parcel_receive : ''; ?></td>
                        <td ><?php echo $row->parcel_status_id != 1 ? $this->misc->date2thai($row->post_parcel_out, '%d %m %y %h:%i', 1) : ''; ?></td>
                        <td class="text-center"><?php echo $row->parcel_status_name; ?></td>
                    </tr>
                    <?php
                    $i++;
                }
            } else {
                ?>
                <tr>
                    <td class="text-center" colspan="11"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>