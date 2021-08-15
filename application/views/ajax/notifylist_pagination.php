<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th class="text-center" width="4%">#</th>
        <th class="text-center" width="8%">รูป</th>
        <th>ข้อความ</th>
        <th class="text-center" width="10%">ส่งแล้ว</th>
        <th class="text-center" width="10%">ยังไม่ได้ส่ง</th>
        <th class="text-center" width="10%">ตัวเลือก</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $count_data = $data->num_rows();
      if ($count_data > 0) {
        $i = $segment + 1;
        foreach ($data->result() as $row) {
          $send = $this->notifylist_model->count_send($row->notify_id, 1);
          $unsend = $this->notifylist_model->count_send($row->notify_id, 0);
      ?>
          <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center">
              <a href="<?php echo $row->notify_image; ?>" class="fancybox">
                <img class="img" src="<?php echo $row->notify_image ?>" width="40" height="40" />
              </a>
            </td>
            <td><?php echo $row->notify_message; ?></td>
            <td class="text-center"><?php echo number_format($send, 0); ?></td>
            <td class="text-center"><?php echo number_format($unsend, 0); ?></td>
            <td class="text-center">
              <a href="<?php echo base_url('notifylist/send/' . $row->notify_id); ?>" class="btn btn-success btn-sm"><i class="fa fa-send"></i> ส่งข้อความ</a>
              <?php if ($send == 0) { ?>
                <button type="button" class="btn btn-danger btn-sm" onclick="modal_delete('<?php echo $row->notify_id; ?>')"><i class="fa fa-trash"></i> ลบ</button>
              <?php } else { ?>
                <button type="button" class="btn btn-default btn-sm" disabled><i class="fa fa-trash"></i> ลบ</button>
              <?php } ?>
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
<div class="row m-t-20">
  <?php
  if ($count != 0) {
  ?>
    <div class="col-lg-6">
      แสดง <?php echo $segment + 1; ?> ถึง <?php echo $i - 1; ?> ทั้งหมด <?php echo ($count); ?> รายการ
    </div>
    <div class="col-lg-6">
      <?php echo $links; ?>
    </div>
  <?php
  }
  ?>
</div>
<script>
  $(document).ready(function() {
    $('.fancybox').fancybox({
      padding: 0,
      helpers: {
        title: {
          type: 'outside'
        }
      }
    });
    if (/Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
      $("a").removeClass("fancyboxpdf");
    } else {
      $('.fancyboxpdf').fancybox({
        width: "100%",
        padding: 0,
        helpers: {
          title: {
            type: 'outside'
          }
        },
        autoSize: true,
        iframe: {
          preload: false
        },
        type: 'iframe'
      });
    }
  });
</script>