<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">
          <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
        </h4>
        <div class="row m-t-20">
          <div class="col-sm-3 m-b-10">
            <label class="control-label" style="font-weight: bold;">ปีสารบรรณ</label>
            <select id="year_id" class="form-control form-control-sm" onchange="ajax_pagination();">
              <option value="">ปีทั้งหมด</option>
              <?php
              $years = $this->accesscontrol->get_year();
              if ($years->num_rows() > 0) {
                foreach ($years->result() as $year) {
              ?>
                  <option value="<?php echo $year->year_id; ?>" <?php echo ($year->year_id == $this->session->userdata('year_id') ? 'selected="selected"' : ''); ?>><?php echo $year->year; ?></option>
              <?php
                }
              }
              ?>
            </select>
          </div>
          <div class="col-sm-3 m-b-10">
            <label class="control-label" style="font-weight: bold;">วันที่เริ่มต้น</label>
            <input type="text" id="start_input" class="form-control form-control-sm" onchange="dateConvert('start_input', 'start')" placeholder="เลือกวันที่เริ่มต้น" value="" autocomplete="off">
            <input type="hidden" id="start" value="" onchange="ajax_pagination()">
          </div>
          <div class="col-sm-3 m-b-10">
            <label class="control-label" style="font-weight: bold;">วันที่สิ้นสุด</label>
            <input type="text" id="end_input" class="form-control form-control-sm" onchange="dateConvert('end_input', 'end')" placeholder="เลือกวันที่สิ้นสุด" value="" autocomplete="off">
            <input type="hidden" id="end" value="" onchange="ajax_pagination()">
          </div>
          <div class="col-sm-3 m-b-10">
            <label class="control-label" style="font-weight: bold;">สถานะ</label>
            <select id="status_id" class="form-control form-control-sm" onchange="ajax_pagination();">
              <option value="">สถานะทั้งหมด</option>
              <option value="0">รอลงรับ</option>
              <option value="1">ลงรับแล้ว</option>
              <option value="2">ปิดงานแล้ว</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-3 m-b-10">
            <label class="control-label" style="font-weight: bold;">หมวดเอกสาร</label>
            <select id="book_group_id" class="form-control form-control-sm" onchange="ajax_pagination();">
              <option value="">หมวดทั้งหมด</option>
              <?php
              $groups = $this->reportreceivelistalldep_model->get_ref_book_group();
              if ($groups->num_rows() > 0) {
                foreach ($groups->result() as $group) {
              ?>
                  <option value="<?php echo $group->book_group_id; ?>"><?php echo $group->book_group_name; ?></option>
              <?php
                }
              }
              ?>
            </select>
          </div>

          <div class="col-sm-6 m-b-10">
            <label class="control-label" style="font-weight: bold;">ค้นหา</label>
            <div class="input-group">
              <input type="text" id="searchtext" class="form-control form-control-sm" placeholder="คำค้นหา">
              <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-info" onclick="ajax_pagination()">ค้นหา</button>
              </div>
            </div>
          </div>
          <div class="col-sm-3 d-flex justify-content-center align-items-center">
            <button class="btn-sm btn-block btn-success mt-3" onclick="Exportexcel()">
              <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export
            </button>
          </div>
        </div>
        <div id="result-pagination" class="m-t-20"></div>
      </div>
    </div>
  </div>
</div>

<div id="result-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content"></div>
  </div>
</div>

<div id="result-modal-lg" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"></div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#start_input').datepicker({
      language: 'th-th',
      format: 'dd/mm/yyyy',
      autoclose: true
    })
    $('#end_input').datepicker({
      language: 'th-th',
      format: 'dd/mm/yyyy',
      autoclose: true
    })
    ajax_pagination()
  })

  function resetPagination() {
    $('#start_input').val('')
    $('#start').val('')
    $('#end_input').val('')
    $('#end').val('')
    $('#search').val('')
    ajax_pagination()
  }

  $('#searchtext').keypress(function(e) {
    if (e.which == 13) {
      ajax_pagination();
    }
  });

  function dateConvert(input_id, output_id) {
    let get_date = $('#' + input_id).val()
    if (get_date != '') {
      let split_date = get_date.split('/')
      let date = (parseInt(split_date[2]) - 543) + '-' + split_date[1] + '-' + split_date[0]
      $('#' + output_id).val(date)
      if (input_id == 'start_input') {
        $('#end_input').val('')
        $('#end').val('')
        $('#end_input').datepicker('setStartDate', new Date(date))
      }
    } else {
      $('#' + output_id).val('')
      if (input_id == 'start_input') {
        $('#end_input').val('')
        $('#end').val('')
        $('#end_input').datepicker('setStartDate', '')
      }
    }
    $('#' + output_id).change()
  }

  function ajax_pagination() {
    $('#result-pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
    $.ajax({
      url: service_base_url + 'reportreceivelistalldep/ajax_pagination',
      type: 'POST',
      data: {
        year_id: $('#year_id').val(),
        searchtext: $('#searchtext').val(),
        status_id: $('#status_id').val(),
        book_group_id: $('#book_group_id').val(),
//        work_type_id: $('#work_type_id').val(),
        date_start: $('#start').val(),
        date_end: $('#end').val(),
      },
      success: function(response) {
        $('#result-pagination').html(response);
      }
    });
  }


  function Exportexcel() {
    // var params = $('#year_id').val() + '/' + $('#work_type_id').val() + '/' + $('#state_info_id').val() + '/' + $('#book_group_id').val() + '/' + $('#searchtext').val() + '/' + $('#start').val() + '/' + $('#end').val();
    var params = '';
    if ($('#year_id').val() != '') {
      params += $('#year_id').val() + '/';
    } else {
      params += null + '/';
    }
    if ($('#searchtext').val() != '') {
      params += $('#searchtext').val() + '/';
    } else {
      params += null + '/';
    }
    if ($('#status_id').val() != '') {
      params += $('#status_id').val() + '/';
    } else {
      params += null + '/';
    }
    if ($('#book_group_id').val() != '') {
      params += $('#book_group_id').val() + '/';
    } else {
      params += null + '/';
    }
//    if ($('#work_type_id').val() != '') {
//      params += $('#work_type_id').val() + '/';
//    } else {
//      params += null + '/';
//    }
    if ($('#start').val() != '') {
      params += $('#start').val() + '/';
    } else {
      params += null + '/';
    }
    if ($('#end').val() != '') {
      params += $('#end').val();
    } else {
      params += null;
    }
    window.open(service_base_url + 'reportreceivelistdep/excel/' + params, '_blank');
  }
</script>