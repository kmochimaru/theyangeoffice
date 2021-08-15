<style>
   th {
      white-space: nowrap;
   }
</style>
<div class="table-responsive">
   <table class="table">
      <thead>
         <tr>
            <th>#</th>
            <th>ผู้ใช้งาน</th>
            <th>รหัสลายเซ็น</th>
            <th>รายละเอียด</th>
            <th>เวลา</th>
            <th class="text-right">ตัวเลือก</th>
         </tr>
      </thead>
      <tbody>
         <?php
         if ($data->num_rows() > 0) {
            $i = $segment + 1;
            foreach ($data->result() as $row) {
         ?>
               <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $row->user_fullname; ?></td>
                  <td><?php echo $row->work_info_no; ?></td>
                  <td><?php echo $row->log_text; ?></td>
                  <td><?php echo $this->misc->date2Thai($row->log_time, '%d %m %y, %h:%i:%s', true); ?></td>
                  <td class="text-right">
                     <button type="button" class="btn btn-sm btn-info" onclick="showLogDetail(<?php echo $row->log_work_info_id; ?>)">รายละเอียด</button>
                  </td>
               </tr>
            <?php
               $i++;
            }
         } else {
            ?>
            <tr>
               <td class="text-center p-3 text-default" colspan="6"><i class="fa fa-exclamation-triangle"></i>&nbsp;ไม่มีข้อมูล</td>
            </tr>
         <?php
         }
         ?>
      </tbody>
   </table>
</div>
<div class="row m-t-20">
   <?php
   if ($count != 0) {
   ?>
      <div class="col-sm-4">
         แสดง <?php echo $segment + 1; ?> ถึง <?php echo $i - 1; ?> ทั้งหมด <?php echo ($count); ?> รายการ
      </div>
      <div class="col-sm-8">
         <?php echo $links; ?>
      </div>
   <?php
   }
   ?>
</div>