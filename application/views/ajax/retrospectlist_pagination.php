<div class="table-responsive" style="min-height: 30vh;">
  <table class="table">
    <thead>
      <tr>
        <th class="text-center" width="5%">#</th>
        <th class="text-center" width="6%">เลขทะเบียน</th>
        <th class="text-center" width="10%">เลขที่คำสั่ง</th>
        <th width="12%">ปีเอกสาร / ลงวันที่</th>
        <th width="26%">เรื่อง</th>
        <th width="14%">แนบไฟล์</th>
        <th width="10%">หมวดเอกสาร</th>
        <th class="text-center" width="8%">สถานะ</th>
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
            <td class="text-center">
              <?php echo ($row->work_info_id != '' ? $row->work_info_id : '-'); ?>
            </td>
            <td class="text-center">
              <a href="<?php echo base_url() . 'retrospectlist/detail/' . $row->work_info_code; ?>" title="รายละเอียด">
                <?php echo $row->work_info_no . $row->work_info_no_2 . $row->work_info_no_3; ?>
              </a><br>
              <span class="small"><?php echo ($row->attach_original == 1 ? 'ส่งต้นฉบับ' : 'ไม่ส่งต้นฉบับ'); ?></span>
            </td>
            <td>
              <?php echo $row->year; ?> / <?php echo $this->misc->date2thai($row->work_info_date, '%d %m %y', 1); ?>
            </td>
            <td>
              <b><?php echo $row->work_info_subject; ?></b><br>
              <span class="small"><span class="text-info">จาก :</span> <?php echo $row->work_info_from_position . ' ' . $row->work_info_from; ?></span><br>
              <span class="small"><span class="text-info">ถึง :</span> <?php echo (($row->work_info_to_position != '') || ($row->work_info_to != '') ? $row->work_info_to_position . ' ' . $row->work_info_to : '-'); ?></span>
            </td>
            <td>
              <?php
              $files = $this->retrospectlist_model->get_workinfofile($row->work_info_id_pri);
              if ($files->num_rows() > 0) {
                foreach ($files->result() as $file) {
              ?>
                  <a style="padding: 0px" href="<?php echo base_url() . 'store/file/' . $file->work_info_file_id; ?>" title="<?php echo $file->work_info_file_oldname; ?>" class="<?php echo ($file->file_type_check != 2) ? ($file->file_type_check != 1) ? 'fancybox' : 'fancyboxpdf' : ''; ?>" target="_blank">
                    <img id="icon_show" src="<?php echo base_url() . 'store/icon/' . $file->file_type_icon; ?>" style="padding: 0px" width="26px" style="cursor:pointer; border: 0px solid whitesmoke">
                  </a>
              <?php
                }
              } else {
                if ($row->state_info_id >= 2) {
                  echo '<i class="fa fa-ban text-danger"></i>';
                } else {
                  echo '<i class="fa fa-clock-o text-info"></i>';
                }
              }
              ?>
            </td>
            <td><?php echo $row->book_group_name; ?></td>
            <td class="text-center" style="font-weight: bold;">
              <?php if ($row->state_info_id == 5) { ?>
                <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo $row->state_info_name; ?></span>
              <?php } else if ($row->state_info_id == 6) { ?>
                <span class="badge badge-success"><i class="fa fa-power-off"></i> <?php echo $row->state_info_name; ?></span>
              <?php } else if ($row->state_info_id == 7) { ?>
                <span class="badge badge-warning"><i class="fa fa-reply-all"></i> <?php echo $row->state_info_name; ?></span>
              <?php } else if ($row->state_info_id == 8) { ?>
                <span class="badge badge-danger"><i class="fa fa-reply-all"></i> <?php echo $row->state_info_name; ?></span>
              <?php } else if ($row->state_info_id == 9) { ?>
                <span class="badge badge-danger"><i class="fa fa-times-circle"></i> <?php echo $row->state_info_name; ?></span>
              <?php } else if ($row->state_info_id == 4) { ?>
                <span class="badge badge-success"><i class="fa fa-send-o"></i> <?php echo $row->state_info_name; ?></span>
              <?php } else if ($row->state_info_id == 3) { ?>
                <span class="badge badge-success"><i class="fa fa-send-o"></i> <?php echo $row->state_info_name; ?></span>
              <?php } else if ($row->state_info_id == 2) { ?>
                <span class="badge badge-primary"><i class="fa fa-edit"></i> <?php echo $row->state_info_name; ?></span>
              <?php } else { ?>
                <span class="badge badge-info"><i class="fa fa-clock-o"></i> <?php echo $row->state_info_name; ?></span>
              <?php } ?>
            </td>
            <td class="text-center">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ตัวเลือก</button>
                <div class="dropdown-menu">
                  <a href="<?php echo base_url() . 'retrospectlist/detail/' . $row->work_info_code; ?>" class="dropdown-item small"><i class="fa fa-list"></i> รายละเอียด</a>
                  <?php if ($row->state_info_id == 1) { ?>
                    <a href="<?php echo base_url() . 'retrospectlist/edit/' . $row->work_info_id_pri; ?>" class="dropdown-item small"><i class="fa fa-edit"></i> แก้ไขเอกสาร</a>
                    <a href="<?php echo base_url() . 'retrospectlist/attach/' . $row->work_info_id_pri; ?>" class="dropdown-item small"><i class="fa fa-paperclip"></i> แนบไฟล์เอกสาร</a>
                    <a href="javascript:void(0)" onclick="modal_changestatus('<?php echo $row->work_info_id_pri; ?>');" class="dropdown-item small"><i class="fa fa-times-circle"></i> ยกเลิกเอกสาร</a>
                  <?php } ?>
                  <?php if ($row->state_info_id == 2) { ?>
                    <a href="<?php echo base_url() . 'retrospectlist/edit/' . $row->work_info_id_pri; ?>" class="dropdown-item small"><i class="fa fa-edit"></i> แก้ไขเอกสาร</a>
                    <a href="<?php echo base_url() . 'retrospectlist/attach/' . $row->work_info_id_pri; ?>" class="dropdown-item small"><i class="fa fa-paperclip"></i> แนบไฟล์เอกสาร</a>
                    <a href="javascript:void(0)" onclick="modal_changestatus('<?php echo $row->work_info_id_pri; ?>');" class="dropdown-item small"><i class="fa fa-times-circle"></i> ยกเลิกเอกสาร</a>
                  <?php } ?>
                  <?php if ($row->state_info_id == 3) { ?>
                    <a href="<?php echo base_url() . 'retrospectlist/edit/' . $row->work_info_id_pri; ?>" class="dropdown-item small"><i class="fa fa-edit"></i> แก้ไขเอกสาร</a>
                    <a href="<?php echo base_url() . 'retrospectlist/attach/' . $row->work_info_id_pri; ?>" class="dropdown-item small"><i class="fa fa-paperclip"></i> แนบไฟล์เอกสาร</a>
                    <a href="javascript:void(0)" onclick="modal_changestatus('<?php echo $row->work_info_id_pri; ?>');" class="dropdown-item small"><i class="fa fa-times-circle"></i> ยกเลิกเอกสาร</a>
                  <?php } ?>
                  <?php if ($row->state_info_id == 5) { ?>
                    <a href="<?php echo base_url() . 'retrospectlist/edit/' . $row->work_info_id_pri; ?>" class="dropdown-item small"><i class="fa fa-edit"></i> แก้ไขเอกสาร</a>
                    <a href="<?php echo base_url() . 'retrospectlist/attach/' . $row->work_info_id_pri; ?>" class="dropdown-item small"><i class="fa fa-paperclip"></i> แนบไฟล์เอกสาร</a>
                    <a href="javascript:void(0)" onclick="modal_changestatus('<?php echo $row->work_info_id_pri; ?>');" class="dropdown-item small"><i class="fa fa-times-circle"></i> ยกเลิกเอกสาร</a>
                  <?php } ?>
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