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
            <th>สถานะ</th>
            <th>IP</th>
            <th>Browser</th>
            <th>เวลา</th>
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
                  <td><?php echo $row->log_text; ?></td>
                  <td><?php echo $row->log_ip_address; ?></td>
                  <td><?php echo $row->log_browser; ?></td>
                  <td><?php echo $this->misc->date2Thai($row->log_time, '%d %m %y, %h:%i:%s', true); ?></td>
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