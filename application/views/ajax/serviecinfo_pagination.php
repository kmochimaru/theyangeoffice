<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th class="text-center" width="4%">#</th>
        <th class="text-center" width="5%">Ticket ID</th>
        <th width="10%">สถานะ</th>
        <th>งานแก้ไขและบริการ</th>
        <th>ปัญหาที่พบ</th>
        <th>รายละเอียด</th>
        <th>แจ้งเมื่อ</th>
        <th class="text-center" width="4%">ตัวเลือก</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $i = 0;
      if ($data->num_rows() > 0) {
        $i = $segment + 1;
        foreach ($data->result() as $row) {
      ?>
          <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $row->service_info_id_pri; ?></td>
            <td>
              <label class="badge badge-dark"><?php echo $this->serviecinfo_model->ref_service_status($row->service_status_id)->row()->service_status_name; ?></label>
            </td>
            <td><?php echo $row->service_name; ?></td>
            <td><?php echo $row->service_info_suject; ?></td>
            <td><?php echo $row->service_info_detail; ?></td>
            <td><?php echo $this->misc->date2thai($row->service_info_create, '%d %m %y %h:%i', 1); ?></td>
            <td class="text-center">
              <a href="<?php echo base_url() . 'serviecinfo/detail/' . $row->service_info_id_pri; ?>" class="btn btn-sm btn-outline-info"><i class="fa fa-tasks"></i> รายละเอียด</a>
            </td>
          </tr>
        <?php
          $i++;
        }
      }
      if ($i <= 1) {
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
  if ($i > 1) {
  ?>
    <div class="col-sm-5">
      แสดง <?php echo $segment + 1; ?> ถึง <?php echo $i - 1; ?> ทั้งหมด <?php echo ($count); ?> รายการ
    </div>
    <div class="col-sm-7">
      <?php echo $links; ?>
    </div>
  <?php
  }
  ?>
</div>

<script>
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip({
      trigger: 'hover'
    })
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