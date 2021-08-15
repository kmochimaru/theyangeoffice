<div class="table-responsive" style="min-height: 30vh;">
  <table class="table">
    <thead>
      <tr>
        <th class="text-center" width="4%">#</th>
        <th width="6%">สถานะ</th>
        <th class="text-center" width="8%">เลขที่เอกสาร</th>
        <th width="12%">ปีเอกสาร / ลงวันที่ / <a href="javascript:void()" title="ผู้สร้าง" data-toggle="tooltip"><i class="fa fa-user"></i></a></th>
        <th width="12%">จาก</th>
        <th>เรื่อง</th>
        <th width="15%">มอบหมาย</th>
        <th width="10%">ชั้นความเร็ว</th>
        <th width="10%">หมวดเอกสาร</th>
        <th class="text-center" width="3%">ตัวเลือก</th>
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
            <td style="font-weight: bold;">
              <?php if ($row->work_user_status_id == 1) { ?>
                <span class="badge badge-warning"><i class="fa fa-clock-o"></i> รอดำเนินการ</span>
              <?php } else if ($row->work_user_status_id == 2) { ?>
                <span class="badge badge-primary"><i class="fa fa-hourglass-start"></i> ดำเนินการ</span>
              <?php } else { ?>
                <span class="badge badge-success"><i class="fa fa-check"></i> เสร็จสิ้น</span>
              <?php } ?>
            </td>
            <td class="text-center">
              <a href="<?php echo base_url() . 'assignments/detail/' . $row->work_user_id . '/1'; ?>" title="เปิด" data-toggle="tooltip"><?php echo $row->work_process_no . $row->work_process_no_2 . $row->work_process_no_3; ?></a>
              <br>
              <span class="small"><?php echo ($row->attach_original == 1 ? 'ส่งต้นฉบับ' : 'ไม่ส่งต้นฉบับ'); ?></span>
            </td>
            <td>
              <?php echo $row->year; ?> / <?php echo $this->misc->date2thai($row->work_info_date, '%d %m %y', 1); ?> / <a href="javascript:void()" title="<?php echo $row->user_fullname; ?>" data-toggle="tooltip"><i class="fa fa-user"></i></a>
            </td>
            <td>
              <?php echo $this->assignments_model->getdep_off($row->work_info_dep_id_pri)->row()->dep_name; ?>
              <br>
              <span class="small"><?php echo $this->assignments_model->getdep_off_id($row->work_info_dep_off_id)->officer_name; ?></span>
            </td>
            <td>
              <b><?php echo $row->work_info_subject; ?></b><br>
              <span class="small"><span class="text-info">จาก :</span> <?php echo $row->work_info_from_position . ' ' . $row->work_info_from; ?></span><br>
              <span class="small"><span class="text-info">ถึง :</span> <?php echo (($row->work_info_to_position != '') || ($row->work_info_to != '') ? $row->work_info_to_position . ' ' . $row->work_info_to : '-'); ?></span>
            </td>
            <td>
              <?php
              $dep_off_id = $this->assignments_model->getdep_off_id($this->assignments_model->getworkprocess($row->work_process_id_pri)->row()->dep_off_id);
              echo $row->user_fullname;
              ?>
              <br>
              <span class="small"><?php echo $dep_off_id->dep_name; ?></span>
            </td>
            <td><?php echo $row->priority_info_name; ?></td>
            <td><?php echo $row->book_group_name; ?></td>
            <td class="text-center">
              <a href="<?php echo base_url() . 'assignments/detail/' . $row->work_user_id; ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> แสดงงาน</a>
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