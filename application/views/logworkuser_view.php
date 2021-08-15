<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
            <h4 class="card-title">
               <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
            </h4>
            <div class="row m-t-20">
               <div class="col-lg-2">
                  <label class="col-form-label font-bold">วันที่เริ่มต้น</label>
                  <input type="text" id="start_input" class="form-control form-control-sm" onchange="dateConvert('start_input', 'start')" placeholder="เลือกวันที่เริ่มต้น" value="" autocomplete="off">
                  <input type="hidden" id="start" value="" onchange="getPagination()">
               </div>
               <div class="col-lg-2">
                  <label class="col-form-label font-bold">วันที่สิ้นสุด</label>
                  <input type="text" id="end_input" class="form-control form-control-sm" onchange="dateConvert('end_input', 'end')" placeholder="เลือกวันที่สิ้นสุด" value="" autocomplete="off">
                  <input type="hidden" id="end" value="" onchange="getPagination()">
               </div>
               <div class="col-lg-3">
                  <label class="col-form-label font-bold">คำค้นหา</label>
                  <input type="text" id="search" class="form-control form-control-sm" placeholder="ระบุคำค้นหา" autocomplete="off">
               </div>
               <div class="col-lg-3" style="padding-top: 37px;">
                  <button type="button" class="btn btn-sm btn-info" onclick="getPagination()"><i class="fa fa-search"></i> ค้นหา</button>
                  <button type="button" class="btn btn-sm btn-inverse" onclick="resetPagination()"><i class="fa fa-close"></i> ยกเลิก</button>
               </div>
            </div>
            <div id="result_pagination" class="m-t-20"></div>
         </div>
      </div>
   </div>
</div>


<script>
   var service_base_url = $('#service_base_url').val()

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
      $('#search').keypress(function(e) {
         if (e.which == 13) {
            getPagination()
         }
      })
      getPagination()
   })

   function resetPagination() {
      $('#start_input').val('')
      $('#start').val('')
      $('#end_input').val('')
      $('#end').val('')
      $('#search').val('')
      getPagination()
   }

   function getPagination() {
      $('#result_pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>')
      $.ajax({
         url: service_base_url + 'logworkuser/getpagination',
         type: 'POST',
         data: {
            start: $('#start').val(),
            end: $('#end').val(),
            search: $('#search').val()
         },
         success: function(response) {
            $('#result_pagination').html(response)
         }
      })
   }

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
</script>