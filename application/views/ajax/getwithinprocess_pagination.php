<div class="table-responsive" style="min-height: 30vh;">
  <table class="table">
    <thead>
      <tr>
        <th class="text-center" width="4%">#</th>
        <th class="text-center" width="6%">เลขทะเบียน</th>
        <th class="text-center" width="8%">เลขที่เอกสาร</th>
        <th width="10%">ปีเอกสาร / ลงวันที่ / <a href="javascript:void()" title="ผู้สร้าง" data-toggle="tooltip"><i class="fa fa-user"></i></a></th>
        <th>เรื่อง</th>
        <th>ส่งถึง</th>
        <th width="10%">ชั้นความเร็ว</th>
        <th width="10%">หมวดเอกสาร</th>
        <th class="text-center" width="6%">สถานะ</th>
        <th class="text-center" width="8%">ตัวเลือก</th>
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
            <td class="text-center">
              <?php echo ($row->work_info_id != '' ? $row->work_info_id : '-'); ?>
            </td>
            <td class="text-center">
              <a href="<?php echo base_url() . 'getwithinprocess/detail/' . $row->work_process_id_pri; ?>" title="รายละเอียด" data-toggle="tooltip">
                <?php echo $row->work_info_no . $row->work_info_no_2 . $row->work_info_no_3; ?>
              </a><br>
              <span class="small"><?php echo ($row->attach_original == 1 ? 'ส่งต้นฉบับ' : 'ไม่ส่งต้นฉบับ'); ?></span>
            </td>
            <td>
              <?php echo $row->year; ?> / <?php echo $this->misc->date2thai($row->work_info_date, '%d %m %y', 1); ?><br>
              / <a href="javascript:void()" title="<?php echo $row->user_fullname; ?>" data-toggle="tooltip"><i class="fa fa-user"></i></a>
            </td>
            <td>
              <b><?php echo $row->work_info_subject; ?></b><br>
              <span class="small"><span class="text-info">จาก :</span> <?php echo $row->work_info_from_position . ' ' . $row->work_info_from; ?></span><br>
              <span class="small"><span class="text-info">ถึง :</span> <?php echo (($row->work_info_to_position != '') || ($row->work_info_to != '') ? $row->work_info_to_position . ' ' . $row->work_info_to : '-'); ?></span>
            </td>
            <td>
              <?php $dep_off = $this->getwithinprocess_model->getdep_off_id($row->work_process_dep_off_id); ?>
              <?php echo $dep_off->dep_name; ?><br>
              <span class="small"><?php echo $dep_off->officer_name; ?></span>
            </td>
            <td><?php echo $row->priority_info_name; ?></td>
            <td><?php echo $row->book_group_name; ?></td>
            <td class="text-center" style="font-weight: bold;">
              <?php if ($row->work_process_receive != 1) { ?>
                <?php if ($row->work_process_status_id == 3) { ?>
                  <i class="fa fa-envelope text-danger"></i>
                <?php } else { ?>
                  <i class="fa fa-envelope text-warning"></i>
                <?php } ?>
              <?php } else { ?>
                <i class="fa fa-envelope-open text-success"></i>
              <?php } ?>
              <?php if ($row->work_process_sendtype == 2) { ?>
                <?php echo $row->work_process_sort; ?><i class="fa fa-list-ol text-dark"></i>
              <?php } ?>
              <?php
              $checks = $this->getwithinprocess_model->checkwithinprocess($row->work_info_id_pri, ($row->work_process_sort - 1), 0);
              if ($checks->num_rows() == 1) {
                $check = $checks->row();
                if ($check->work_process_receive == 1) {
                  if ($check->work_process_sendtype == 2) {
                    if ($check->work_process_sendstatus == 0) {
              ?>
                      <i class="fa fa-clock-o text-warning"></i>
              <?php
                    }
                  }
                }
              }
              ?>
              <?php if ($row->work_process_status_id == 0) { ?>
                <i class="fa fa-share text-warning"></i>
              <?php } else if ($row->work_process_status_id == 2) { ?>
                <i class="fa fa-share text-danger"></i>
              <?php } ?>
            </td>
            <td class="text-center">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ตัวเลือก</button>
                <div class="dropdown-menu">
                  <a href="<?php echo base_url() . 'getwithinprocess/detail/' . $row->work_process_id_pri; ?>" class="dropdown-item small"><i class="fa fa-navicon"></i> รายละเอียด</a>
                  <a href="<?php echo base_url() . 'getwithinprocess/attach/' . $row->work_process_id_pri; ?>" class="dropdown-item small"><i class="fa fa-paperclip"></i> เพิ่มไฟล์เอกสาร</a>
                  <?php if ($row->work_process_receive != 1) { ?>
                    <?php if ($row->work_process_status_id == 1) { ?>
                      <a href="javascript:void(0)" onclick="modal_changestatus('<?php echo $row->work_process_id_pri; ?>');" class="dropdown-item small"><i class="fa fa-reply"></i> ดึงเรื่องกลับ</a>
                  <?php
                    }
                  }
                  ?>
                </div>
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