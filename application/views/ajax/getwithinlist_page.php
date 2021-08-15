<input type="hidden" id="amount_upload_attach" value="<?php echo (5 - $datas->num_rows()); ?>" />
<div class="row" id="sortable-image-list">
  <div class="col-lg-1"></div>
  <?php
  if ($datas->num_rows() > 0) {
    foreach ($datas->result() as $data) {
  ?>
      <div class="col-lg-2">
        <div class="row">
          <div class="col-lg-10 text-right" style="z-index: 1">
            <?php if ($data->work_info_file_active == 2) { ?>
              <button type="button" style="margin-bottom: -50px;" class="btn btn-sm btn-rounded btn-danger" onclick="delete_file('<?php echo $data->work_info_file_id; ?>', '<?php echo $data->work_info_file_name; ?>');"><i class="fa fa-close"></i></button>
            <?php } else { ?>
              <button type="button" style="margin-bottom: -50px;" class="btn btn-sm btn-rounded btn-default"><i class="fa fa-close"></i></button>
            <?php } ?>
          </div>
          <div class="col-lg-12 text-center">
            <a style="padding: 0px" href="<?php echo base_url() . 'store/file/' . $data->work_info_file_id; ?>" title="Item Title" class="<?php echo ($data->file_type_check != 2) ? ($data->file_type_check != 1) ? 'fancybox' : 'fancyboxpdf' : ''; ?>" target="_blank">
              <img id="icon_show" src="<?php echo base_url() . 'store/icon/' . $data->file_type_icon; ?>" class="img-thumbnail" width="50%" style="cursor:pointer; border: 0px solid whitesmoke">
            </a>
          </div>
          <div class="col-lg-12 text-center">
            <span><?php echo $data->work_info_file_oldname; ?></span><br /><span class="text-muted"><?php echo ' ( ' . $this->misc->date2thai($data->work_info_file_create, '%d %m %y', 1) . ' )'; ?></span>
          </div>
        </div>
      </div>
    <?php
    }
  } else {
    ?>
    <div class="col-md-12 text-center" style="color: #999;">
      <br />
      <i class="fa fa-info-circle"></i> ยังไม่มีไฟล์เอกสาร
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