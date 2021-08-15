<form id="form_year_number" method="post" onsubmit="return false" autocomplete="false">
   <div class="modal-header">
      <h4 class="modal-title"><i class="fa fa-file-text-o"></i> เลขสารบรรณ</h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
   </div>
   <div class="modal-body">
      <div class="row">
         <div class="col-md-6 col-sm-6 col-6">
            <label class="control-label">ปีงานสารบรรณ</label>
            <?php $year_th = $this->misc->getYearThai(); ?>
            <select name="dep_year_id" id="dep_year_id_" class="form-control form-control-sm" onchange="setYearNumber()" required="">
               <?php foreach ($this->department_model->getDepartmentYear($dep_id_pri)->result() as $year) { ?>
                  <option value="<?php echo $year->dep_year_id; ?>" <?php echo ($year->year == $year_th) ? 'selected' : '' ?>><?php echo $year->year; ?></option>
               <?php } ?>
            </select>
         </div>
         <div class="col-md-6 col-sm-6 col-6">
            <label class="control-label">เลขที่เอกสาร ( ถัดไป )</label>
            <input type="text" name="dep_year_number_last" id="dep_year_number_last_" class="form-control form-control-sm" value="" required="">
            <label class="control-label m-t-10">เลขทะเบียนรับ ( ถัดไป )</label>
            <input type="text" name="dep_year_receive_last" id="dep_year_receive_last_" class="form-control form-control-sm" value="" required="">
            <label class="control-label m-t-10">เลขทะเบียนส่งภายใน ( ถัดไป )</label>
            <input type="text" name="dep_year_send_last" id="dep_year_send_last_" class="form-control form-control-sm" value="" required="">
            <label class="control-label m-t-10">เลขทะเบียนหนังสือส่ง ( ถัดไป )</label>
            <input type="text" name="dep_year_send_out_last" id="dep_year_send_out_last_" class="form-control form-control-sm" value="" required="">
            <label class="control-label m-t-10">เลขทะเบียนคำสั่ง ( ถัดไป )</label>
            <input type="text" name="dep_year_send_command_last" id="dep_year_send_command_last_" class="form-control form-control-sm" value="" required="">
            <label class="control-label m-t-10">เลขทะเบียนประกาศ ( ถัดไป )</label>
            <input type="text" name="dep_year_send_publish_last" id="dep_year_send_publish_last_" class="form-control form-control-sm" value="" required="">
         </div>
      </div>
   </div>
   </div>
   <div class="modal-footer">
      <button type="submit" id="btn_submit_" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
      <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
   </div>
</form>

<script>
   $(function() {
      setYearNumber()
   })

   function setYearNumber() {
      $.ajax({
         url: service_base_url + 'department/get_year_number',
         method: 'POST',
         data: {
            dep_year_id: $('#dep_year_id_').val()
         },
         dataType: 'JSON',
         success: function(response) {
            if (response.status == '1') {
               $('#dep_year_number_last_').val(response.data.dep_year_number_last)
               $('#dep_year_receive_last_').val(response.data.dep_year_receive_last)
               $('#dep_year_send_last_').val(response.data.dep_year_send_last)
               $('#dep_year_send_out_last_').val(response.data.dep_year_send_out_last)
               $('#dep_year_send_command_last_').val(response.data.dep_year_send_command_last)
               $('#dep_year_send_publish_last_').val(response.data.dep_year_send_publish_last)
            } else {
               $('#dep_year_number_last_').val('')
               $('#dep_year_receive_last_').val('')
               $('#dep_year_send_last_').val('')
               $('#dep_year_send_out_last_').val('')
               $('#dep_year_send_command_last_').val('')
               $('#dep_year_send_publish_last_').val('')
            }
         }
      })
   }

   $('#form_year_number').submit(function(e) {
      $('#btn_submit_').prop('disabled', true)
      e.preventDefault()
      var postData = new FormData($(this)[0])
      $.ajax({
         url: service_base_url + 'department/update_year_number',
         type: 'POST',
         data: postData,
         processData: false,
         contentType: false,
         success: function(response) {
            if (response == 1) {
               notification('success', 'Success', 'แก้ไขข้อมูลเรียบร้อยเเล้ว')
            } else {
               notification('error', 'Error', 'เกิดข้อผิดพลาด')
            }
            $('#result-modal').modal('hide')
         }
      })
   })
</script>