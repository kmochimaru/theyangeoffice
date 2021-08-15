<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">
          <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
          <span style="float: right">
            <button type="button" class="btn btn-sm btn-rounded btn-outline-success" onclick="backup_process();"><i class="fa fa-download"></i> Backup</button>
          </span>
        </h4>
        <div class="row m-t-20">
          <div class="col-lg-3">
            <div class="input-group">
              <input type="text" id="keyword" class="form-control form-control-sm" placeholder="คำค้นหา">
              <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-info" onclick="getData()">ค้นหา</button>
              </div>
            </div>
          </div>
        </div>
        <div id="result-page" class="m-t-20"></div>
      </div>
    </div>
  </div>
</div>

<div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-trash"></i> ยืนยันการลบข้อมูล</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <div class="bootbox-body text-center text-danger">
          <b>ยืนยันการลบข้อมูลนี้ ใช่หรือไม่ <i class="fa fa-question-circle"></i></b>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-danger waves-effect waves-light" id="delete_id"><i class="fa fa-trash"></i> ตกลง</a>
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(function() {
    getData();
  });

  function getData() {
    $('#result-page').html('');
    $.ajax({
      url: service_base_url + 'backup/getfilezip',
      type: 'POST',
      data: {
        search: $('#keyword').val()
      },
      success: function(response) {
        var content = `<div class="row" style="min-height: 50vh;">`;
        response.forEach(val => {
          content += `<div class="col col-xl-2" style="display: flex; justify-content: center;">
            <div class="card" style="width: 250px; height: 250px; border: 1px solid #555; border-radius: 5px;">
              <div class="card-body text-center pb-0">
                <i class="fa fa-file-archive-o fa-4x mb-3 mt-3" aria-hidden="true"></i>
                <b class="card-title" style="font-size: 14px;">` + val['filename'] + `</b>
              </div>
              <div class="card-footer bg-white">
                <div class="row">
                  <div class="col-7 text-center pl-0 pr-0 d-flex justify-content-center align-items-center" style="font-size: 12px;">` + val['datetime'] + `</div>
                  <div class="col-3 pl-0 pr-0 text-center">
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="download('` + val['path'] + `')"><i class="fa fa-download" aria-hidden="true"></i></button>
                  </div>
                  <div class="col-2 pl-0 pr-0 text-center">
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="modaldelete('` + val['filename'] + `')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>`;
        })
        if (response.length < 1) {
          content += `<div class="col-12 text-center" style="padding-top: 10%;"><i class="fa fa-folder-open-o" aria-hidden="true" style="font-size: 100px;"></i><h4 class="mt-2">ไม่มีข้อมูล</h2></div>`;
        }
        content += `</div>`;
        $('#result-page').html(content);
      }
    });
  }

  function download(url) {
    window.open(service_base_url + 'backup/download?url=' + url, '_blank')
  }

  function modaldelete(filename) {
    let url = service_base_url + 'backup/delzip/' + filename;
    $('#delete_id').attr('href', url);
    $('#delete-modal').modal('show', {
      backdrop: 'true'
    });
  }

  function backup_process() {
    $.ajax({
      url: service_base_url + 'backup/process',
      type: 'POST',
      data: {},
      success: function(response) {
        if (response.status == true) {
          notification('success', 'สำเร็จ', 'สำรองข้อมูลเรียบร้อย');
          getData();
          window.open(service_base_url + 'backup/download?url=' + response.url, '_blank');
        } else {
          getData();
          notification('error', 'ไม่สำเร็จ', 'ไม่สามารถสำรองข้อมูลได้');
        }
      }
    });
  }
</script>