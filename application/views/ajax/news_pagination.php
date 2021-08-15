<div class="table-responsive" style="min-height: 30vh;">
  <table class="table">
    <thead>
      <tr>
        <th class="text-center" width="5%">#</th>
        <th class="text-center" width="6%">สถานะ</th>
        <th class="text-center" width="10%">เลขที่เอกสาร</th>
        <th width="12%">ปีเอกสาร / ลงวันที่</th>
        <th width="">เรื่อง</th>
        <th width="12%">ประกาศโดย</th>
        <th width="10%">ชั้นความเร็ว</th>
        <th width="10%">หมวดเอกสาร</th>
        <th class="text-center" width="9%">ตัวเลือก</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($data->num_rows() > 0) {
        $i = $segment + 1;
        foreach ($data->result() as $row) {
      ?>
          <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $this->news_model->get_lognews($row->work_info_id_pri)->num_rows() == 0 ? '<i class="fa fa-envelope text-warning"></i>' : '<i class="fa fa-envelope-open text-success"></i>'; ?></td>
            <td class="text-center">
              <a href="<?php echo base_url() . 'news/detail/' . $row->work_info_code; ?>" title="รายละเอียด">
                <?php echo $row->work_info_no . $row->work_info_no_2 . $row->work_info_no_3; ?>
              </a><br>
              <span class="small"><?php echo ($row->attach_original == 1 ? 'ส่งต้นฉบับ' : 'ไม่ส่งต้นฉบับ'); ?></span>
            </td>
            <td>
              <?php echo $row->year; ?> / <?php echo $this->misc->date2thai($row->work_info_date, '%d %m %y', 1); ?> / <a href="javascript:void()" title="<?php echo $row->user_fullname; ?>" data-toggle="tooltip"><i class="fa fa-user"></i></a>
            </td>
            <td>
              <?php
              $subject = '';
              if ($row->work_type_id == 4) {
                $subject = 'ประชาสัมพันธ์ : ';
              } else {
                $subject = 'รักษาการ : ';
              }
              ?>
              <b><?php echo $subject . $row->work_info_subject; ?></b><br>
              <span class="small"><span class="text-info">จาก :</span> <?php echo $row->work_info_from_position . ' ' . $row->work_info_from; ?></span><br>
            </td>
            <td>
              <?php echo $this->news_model->getdep_off($row->dep_id_pri)->row()->dep_name; ?>
              <br>
              <span class="small"><?php echo $this->news_model->getdep_off_id($row->dep_off_id)->officer_name; ?></span>
            </td>
            <td><?php echo $row->priority_info_name; ?></td>
            <td><?php echo $row->book_group_name; ?></td>
            <td class="text-center">
              <a href="<?php echo base_url() . 'news/detail/' . $row->work_info_code; ?>" class="btn btn-sm btn-info" title="เปิด" data-toggle="tooltip"><i class="fa fa-envelope-open"></i> เปิด</a>
            </td>
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
<div class="row m-t-20">
  <?php
  if ($count != 0) {
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
    $('[data-toggle="tooltip"]').tooltip();
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