<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">
          <i class="<?php echo " " . $icon; ?>"></i> <?php echo " " . $title; ?>
          <span style="float: right">
            <a class="btn btn-sm btn-rounded btn-outline-inverse" href="<?php echo base_url() . 'notifylist'; ?>"><i class="fa fa-arrow-left"></i> กลับ</a>
          </span>
        </h4>
        <div class="row m-t-20">
          <label class="col-md-2 control-label text-right" style="font-weight: bold">ข้อความ : </label>
          <div class="col-md-3">
            <textarea class="form-control input-sm" rows="4" readonly><?php echo $data->notify_message; ?></textarea>
          </div>
          <label class="col-md-2 control-label text-right" style="font-weight: bold">รูปภาพ : </label>
          <div class="col-md-3">
            <?php
            if ($data->notify_image != "") {
            ?>
              <a href="<?php echo $data->notify_image; ?>" class="fancybox">
                <img class="img" src="<?php echo $data->notify_image ?>" width="120" height="120" />
              </a>
            <?php
            }
            ?>

          </div>
        </div>
        <div class="m-t-20 table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th class="text-center" width="4%">#</th>
                <th>ชื่อ-นามสกุล</th>
                <th>หน่วยงาน / ตำแหน่งงาน (หลัก)</th>
                <th class="text-center" width="10%">สถานะ</th>
                <th class="text-center" style="width: 60px; padding: 4px;">
                  <button type="button" id="btn_send_all" class="btn btn-primary btn-block btn-sm" onclick="send_all()">ส่งทั้งหมด</button>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              $count_data = $this->notifylist_model->get_notification($data->notify_id);
              if ($count_data->num_rows() > 0) {
                $i = 1;
                foreach ($count_data->result() as $row) {
              ?>
                  <tr>
                    <td class="text-center"><?php echo $i; ?></td>
                    <td><?php echo $row->user_fullname; ?></td>
                    <td><?php
                        $user = $this->notifylist_model->get_user($row->user_id);
                        echo $user->dep_name . ' / ' . $user->officer_name
                        ?></td>
                    <td id="status_<?php echo $row->notification_id; ?>" class="text-center" style="vertical-align: middle;">
                      <?php echo $row->notification_status_id == 1 ? '<label class="label label-success">ส่งแล้ว</label>' : '<label class="label label-danger">ยังไม่ได้ส่ง</label>'; ?>
                    </td>
                    <td id="btn_<?php echo $row->notification_id; ?>" class="text-center" style="vertical-align: middle; padding: 4px;">
                      <?php if ($row->notification_status_id == 0) { ?>
                        <button type="button" id="btn_<?php echo $row->notification_id; ?>" class="btn btn-success btn-block btn-sm" onclick="send_once('<?php echo $row->notification_id; ?>')">ส่ง</button>
                      <?php } else { ?>
                        <button type="button" class="btn btn-default btn-block btn-sm" disabled>ส่งแล้ว</button>
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
      </div>
    </div>
  </div>
</div>
<?php
if ($count_data->num_rows() > 0) {
  foreach ($count_data->result() as $row) {
    if ($row->notification_status_id == 0) {
?>
      <input class="<?php echo 'ids_' . $row->notification_id; ?>" type="hidden" name="ids[]" value="<?php echo $row->notification_id; ?>">
<?php
    }
  }
}
?>
<input type="hidden" id="alert_message" value="<?php echo ($this->session->flashdata('flash_message') != '') ? $this->session->flashdata('flash_message') : ''; ?>">
<script>
  async function send_once(id) {
    $('#status_' + id).html('<i class="fa fa-spinner fa-pulse fa-fw"></i> กำลังส่ง');
    $('#btn_' + id).html('<button type="button" class="btn btn-default btn-block btn-sm" disabled>กำลังส่ง</button>');
    await $.ajax({
      url: service_base_url + 'notifylist/notification',
      method: 'POST',
      data: {
        id: id
      },
      success: function(response) {
        if (response == '1') {
          $('#status_' + id).html('<label class="label label-success">ส่งแล้ว</label>')
          $('#btn_' + id).html('<button type="button" class="btn btn-default btn-block btn-sm" disabled>ส่งแล้ว</button>')
          notification('success', 'ทำรายการสำเร็จ !', 'ส่งข้อความเรียบร้อยแล้ว')
        } else {
          notification('error', 'เกิดข้อผิดพลาด !', 'ส่งข้อความไม่สำเร็จ')
        }
      }
    })
  }

  async function send_all() {
    $('#btn_send_all').prop('disabled', true)
    $('#ico_loading').show()
    const ids = await $('input[name="ids[]"]').map(function() {
      return $(this).val()
    }).get()
    const cnt = ids.length;
    if (cnt > 0) {
      for (let i = 0; i < cnt; i++) {
        let id = ids[i];
        $('#btn_' + id).html('<button type="button" class="btn btn-default btn-block btn-sm" disabled>กำลังส่ง</button>')
      }
      for (let i = 0; i < cnt; i++) {
        let id = ids[i];
        $('#status_' + id).html('<i class="fa fa-spinner fa-pulse fa-fw"></i> กำลังส่ง')
        await $.ajax({
          url: service_base_url + 'notifylist/notification',
          method: 'POST',
          data: {
            id: id
          },
          success: function(response) {
            console.log(id + '/' + response);
            if (response == '1') {
              $('#status_' + id).html('<label class="label label-success">ส่งแล้ว</label>')
              $('#btn_' + id).html('<button type="button" class="btn btn-default btn-block btn-sm" disabled>ส่งแล้ว</button>')
              $('.ids_' + id).remove()
            }
          }
        })
      }
    } else {
      notification('success', 'ทำรายการสำเร็จ !', 'ส่งข้อความทั้งหมดเรียบร้อยแล้ว')
    }
    $('#btn_send_all').prop('disabled', false)
    $('#ico_loading').hide()
  }

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