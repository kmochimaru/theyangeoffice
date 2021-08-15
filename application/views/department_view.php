<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <h4 class="card-title">
               <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
            </h4>
            <div class="row">
               <div class="col-sm-3">
                  <select id="group1" class="select2 form-control custom-select" style="width: 100%; height:36px;" data-placeholder="ทั้งหมด" onchange="selected();">
                     <option value="">ทั้งหมด</option>
                     <option value="0">ทั้งหมด</option>
                     <?php foreach ($this->department_model->getOrganization()->result() as $org) { ?>
                        <option value="<?php echo $org->org_id_pri; ?>"><?php echo $org->org_name; ?></option>
                     <?php } ?>
                  </select>
               </div>
               <div class="col-sm-3">
                  <select id="group2" class="select2 form-control custom-select" style="width: 100%; height:36px;" data-placeholder="ทั้งหมด" onchange="data();">
                     <option value="">ทั้งหมด</option>
                     <option value="0">ทั้งหมด</option>
                     <?php foreach ($this->department_model->getOrgDepartment()->result() as $dep) { ?>
                        <option value="<?php echo $dep->dep_id_pri; ?>"><?php echo $dep->dep_name; ?></option>
                     <?php } ?>
                  </select>
               </div>
            </div>
            <div class="table-responsive" id="result-page">

            </div>
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
   $(function() {
      data();
      $(".select2").select2();
   });

   function data() {
      $('#result-page').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
      url = service_base_url + 'department/data';
      $.ajax({
         url: url,
         method: "POST",
         data: {
            group1: $('#group1').val(),
            group2: $('#group2').val()
         },
         success: function(res) {
            $('#result-page').html(res);
         }
      });
   }

   function modal_add(org_id_pri) {
      $('.modal-content').html('');
      $.ajax({
         url: service_base_url + 'department/add_department_modal',
         type: 'POST',
         data: {
            org_id_pri: org_id_pri
         },
         success: function(response) {
            $('#result-modal .modal-content').html(response);
            $('#result-modal').modal('show', {
               backdrop: 'true'
            });
         }
      });
   }

   function modal_add_dep_off(dep_id_pri) {
      $('.modal-content').html('');
      $.ajax({
         url: service_base_url + 'department/add_dep_off_modal',
         type: 'POST',
         data: {
            dep_id_pri: dep_id_pri
         },
         success: function(response) {
            $('#result-modal .modal-content').html(response);
            $('#result-modal').modal('show', {
               backdrop: 'true'
            });
         }
      });
   }

   function modal_edit(org_id_pri, dep_id_pri) {
      $('.modal-content').html('');
      $.ajax({
         url: service_base_url + 'department/edit_department_modal',
         type: 'POST',
         data: {
            org_id_pri: org_id_pri,
            dep_id_pri: dep_id_pri
         },
         success: function(response) {
            $('#result-modal .modal-content').html(response);
            $('#result-modal').modal('show', {
               backdrop: 'true'
            });
         }
      });
   }

   function modal_edit_status(dep_id_pri) {
      $('.modal-content').html('');
      $.ajax({
         url: service_base_url + 'department/status_department_modal',
         type: 'POST',
         data: {
            dep_id_pri: dep_id_pri
         },
         success: function(response) {
            $('#result-modal .modal-content').html(response);
            $('#result-modal').modal('show', {
               backdrop: 'true'
            });
         }
      });
   }

   function modal_edit_status_dep_off(dep_off_id) {
      $('.modal-content').html('');
      $.ajax({
         url: service_base_url + 'department/status_dep_off_modal',
         type: 'POST',
         data: {
            dep_off_id: dep_off_id
         },
         success: function(response) {
            $('#result-modal .modal-content').html(response);
            $('#result-modal').modal('show', {
               backdrop: 'true'
            });
         }
      });
   }

   function modal_delete_dep_off(dep_off_id) {
      $('.modal-content').html('');
      $.ajax({
         url: service_base_url + 'department/delete_dep_off_modal',
         type: 'POST',
         data: {
            dep_off_id: dep_off_id
         },
         success: function(response) {
            $('#result-modal .modal-content').html(response);
            $('#result-modal').modal('show', {
               backdrop: 'true'
            });
         }
      });
   }

   function modal_view(dep_off_id) {
      $('.modal-content').html('');
      $.ajax({
         url: service_base_url + 'department/view_dep_off_modal',
         type: 'POST',
         data: {
            dep_off_id: dep_off_id
         },
         success: function(response) {
            $('#result-modal-lg .modal-content').html(response);
            $('#result-modal-lg').modal('show', {
               backdrop: 'true'
            });
         }
      });
   }

   function modal_year_number(dep_id_pri) {
      $('.modal-content').html('');
      $.ajax({
         url: service_base_url + 'department/year_number_modal',
         type: 'POST',
         data: {
            dep_id_pri: dep_id_pri
         },
         success: function(response) {
            $('#result-modal .modal-content').html(response);
            $('#result-modal').modal('show', {
               backdrop: 'true'
            });
         }
      });
   }

   function selected() {
      org_id_pri = $('#group1').val();
      dep_tag = $('#group2');
      dep_tag.find('option').remove();
      $.ajax({
         url: service_base_url + 'department/selected_org',
         type: 'POST',
         dataType: 'json',
         data: {
            org_id_pri: org_id_pri
         },
         success: function(response) {
            count_row = response.dep_id_pri.length;
            dep_tag.append($("<option></option>").attr("value", "").text('ทั้งหมด'));
            dep_tag.append($("<option></option>").attr("value", "0").text('ทั้งหมด'));
            for (i = 0; i < count_row; i++) {
               dep_id_pri = response.dep_id_pri[i];
               dep_name = response.dep_name[i];
               dep_tag.append($("<option></option>").attr("value", dep_id_pri).text(dep_name));
            }
         }
      });
   }
</script>