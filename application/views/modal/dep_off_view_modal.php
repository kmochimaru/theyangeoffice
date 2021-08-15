<div class="modal-header">
   <h4 class="modal-title"><i class="fa fa-user-circle"></i> <?php echo 'ผู้ใช้งานระบบ'; ?></h4>
   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
   <table class="table">
      <thead>
         <tr>
            <th class="text-left" width="4%">#</th>
            <th class="text-left">รูปภาพ</th>
            <th class="text-left">ชื่อผู้ใช้งาน</th>
            <th class="text-left">เบอร์โทรศัพท์</th>
            <th class="text-left">ตำแหน่ง</th>
            <th class="text-right">สถานะตำแหน่ง</th>
            <th class="text-right">สถานะผู้ใช้งาน</th>
            <th class="text-right">ตัวเลือก</th>
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
                  <td class="text-left"><?php echo $i; ?></td>
                  <td class="text-left">
                     <img class="img-circle" src="<?php echo base_url() . 'assets/upload/user/' . ($row->user_image != '' ? $row->user_image : 'none.png') ?>" width="32" height="32" />
                  </td>
                  <td class="text-left"><?php echo $row->user_fullname; ?></td>
                  <td class="text-left"><?php echo $row->user_tel; ?></td>
                  <td class="text-left"><?php echo $row->role_name; ?></td>
                  <td class="text-right">
                     <?php if ($row->user_dep_off_status_id == 1) { ?>
                        <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo 'ปกติ'; ?></span>
                     <?php } else { ?>
                        <span class="badge badge-danger"><i class="fa fa-close"></i> <?php echo 'ระงับ'; ?></span>
                     <?php } ?>
                  </td>
                  <td class="text-right"><?php echo $row->user_status_name; ?></td>

                  <td class="text-right">
                     <div class="switch">
                        <label>
                           <?php if ($row->user_dep_off_active_id == 1) { ?>
                              <input type="checkbox" <?php echo ($row->user_dep_off_status_id == 1 ? 'checked' : ''); ?> disabled><span class="lever"></span>
                           <?php } else { ?>
                              <input type="checkbox" onchange="switchstatus('<?php echo $row->user_dep_off_id; ?>', this);" id="checkbox_status_<?php echo $row->user_dep_off_id ?>" <?php echo ($row->user_dep_off_status_id == 1 ? 'checked' : ''); ?>><span class="lever"></span>
                           <?php } ?>
                        </label>
                     </div>
                  </td>
               </tr>
            <?php
               $i++;
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
<div class="modal-footer">
   <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ปิด</button>
</div>

<script>
   function switchstatus(user_dep_off_id, checkbox) {
      if (checkbox.checked) {
         var url = service_base_url + 'department/status1';
         $.post(url, {
            user_dep_off_id: user_dep_off_id
         }, function(response) {
            notification('success', 'สำเร็จ', 'แก้ไขข้อมูลเรียบร้อยเเล้ว');
         });
      } else {
         var url = service_base_url + 'department/status2';
         $.post(url, {
            user_dep_off_id: user_dep_off_id
         }, function(response) {
            notification('success', 'สำเร็จ', 'แก้ไขข้อมูลเรียบร้อยเเล้ว');
         });
      }
   }
</script>