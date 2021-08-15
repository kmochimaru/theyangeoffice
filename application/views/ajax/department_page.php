<br />
<div class="table-responsive">
   <table class="table table-hover">
      <thead>
         <tr>
            <th class="">หน่วยงาน / ตำแหน่งงาน</th>
            <th class="text-right">สถานะ</th>
            <th class="text-center" colspan="3">ตัวเลือก</th>
         </tr>
      </thead>
      <tbody>
         <?php
         if ($orgs->num_rows() > 0) {
            foreach ($orgs->result() as $org) {
         ?>
               <tr style="background: #dee2e6;">
                  <td class="text-center" colspan="2" style="font-weight: bold;color: gray"><i class="mdi mdi-city"></i><?php echo ' ' . $org->org_name . ' (' . $org->org_id . ') '; ?></td>
                  <td class="text-right" colspan="4">
                     <button class="btn btn-success btn-xs btn-block" onclick="modal_add('<?php echo $org->org_id_pri; ?>');" data-toggle="tooltip" data-original-title="เพิ่ม"><i class="fa fa-plus-circle"></i> เพิ่มหน่วยงาน</button>
                  </td>
               </tr>
               <?php
               $deps = $this->department_model->getOrgDepartment($org->org_id_pri, $group2);
               if ($deps->num_rows() > 0) {
                  foreach ($deps->result() as $data) {
               ?>
                     <tr style="background: whitesmoke">
                        <td class=""><i class="mdi mdi-home-map-marker"></i><?php echo ' ' . $data->dep_name; ?>&nbsp;
                           <span class="text-muted"><?php echo ' ' . $data->dep_name_short . ' ( ' . $data->dep_id . ' ) '; ?></span>
                        </td>
                        <td class="text-right">
                           <?php if ($data->dep_status_id == 1) { ?>
                              <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo 'ปกติ'; ?></span>
                           <?php } else { ?>
                              <span class="badge badge-danger"><i class="fa fa-close"></i> <?php echo 'ถูกระงับ'; ?></span>
                           <?php } ?>
                        </td>
                        <td class="text-center" width="30px">
                           <?php if ($this->department_model->getdep_off($data->dep_id_pri)->num_rows() == $this->department_model->getOfficer()->num_rows()) { ?>
                              <button class="btn btn-xs btn-outline-info btn-block" disabled="" data-toggle="tooltip" data-original-title="เพิ่ม"><i class="fa fa-plus-circle"></i> เพิ่มตำแหน่ง</button>
                           <?php } else { ?>
                              <button class="btn btn-xs btn-outline-info btn-block" onclick="modal_add_dep_off(<?php echo $data->dep_id_pri; ?>);" data-toggle="tooltip" data-original-title="เพิ่ม"><i class="fa fa-plus-circle"></i> เพิ่มตำแหน่ง</button>
                           <?php } ?>
                        </td>
                        <td class="text-center" width="30px">
                           <button class="btn btn-xs btn-outline-info btn-block" onclick="modal_year_number(<?php echo $data->dep_id_pri; ?>);" data-toggle="tooltip" data-original-title="เลขสารบรรณ"><i class="fa fa-file-text-o"></i> เลขสารบรรณ</button>
                        </td>
                        <td class="text-center" width="30px">
                           <button class="btn btn-outline-primary btn-xs btn-block" onclick="modal_edit(<?php echo $org->org_id_pri; ?>,<?php echo $data->dep_id_pri; ?>);" data-toggle="tooltip" data-original-title="แก้ไข"><i class="fa fa-edit"></i> แก้ไข</button>
                        </td>
                        <td class="text-center" width="30px">
                           <button class="btn btn-xs btn-block btn-outline-<?php echo $data->dep_status_id == 1 ? 'danger' : 'success'; ?>" onclick="modal_edit_status(<?php echo $data->dep_id_pri; ?>)"><i class="fa fa-<?php echo $data->dep_status_id == 1 ? 'close' : 'check'; ?>"></i> <?php echo $data->dep_status_id == 1 ? 'ระงับ' : 'เปิดใช้'; ?></button>
                        </td>
                     </tr>
                     <?php
                     $dep_offs = $this->department_model->getdep_off($data->dep_id_pri);
                     if ($dep_offs->num_rows() > 0) {
                        foreach ($dep_offs->result() as $dep_off) {
                     ?>
                           <tr>
                              <td class="">&nbsp;&nbsp;&nbsp;&nbsp;<i class="mdi mdi-subdirectory-arrow-right"></i><?php echo ' ' . $dep_off->officer_name_display; ?><span class="text-muted"><?php echo '- ' . $dep_off->officer_name; ?></span></td>
                              <td class="text-right">
                                 <?php if ($dep_off->dep_off_status_id == 1) { ?>
                                    <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo 'ปกติ'; ?></span>
                                 <?php } else { ?>
                                    <span class="badge badge-danger"><i class="fa fa-close"></i> <?php echo 'ถูกระงับ'; ?></span>
                                 <?php } ?>
                              </td>
                              <td class="text-center" width="30px">
                              </td>
                              <td class="text-center" width="30px">
                                 <button class="btn btn-xs btn-outline-info btn-block" onclick="modal_view(<?php echo $dep_off->dep_off_id; ?>);" data-toggle="tooltip" data-original-title="ผู้ใช้งานระบบ"><i class="fa fa-user-circle"></i> ผู้ใช้งานระบบ</button>
                              </td>
                              <td class="text-center" width="30px">
                                 <?php if ($this->department_model->getuser_dep_off($dep_off->dep_off_id)->num_rows() > 0) { ?>
                                    <button class="btn btn-block btn-outline-danger btn-xs" disabled="" data-toggle="tooltip" data-original-title="แก้ไข"><i class="mdi mdi-delete"></i> ลบ</button>
                                 <?php } else { ?>
                                    <button class="btn btn-block btn-outline-danger btn-xs" onclick="modal_delete_dep_off(<?php echo $dep_off->dep_off_id; ?>,<?php echo $data->dep_id_pri; ?>);" data-toggle="tooltip" data-original-title="แก้ไข"><i class="mdi mdi-delete"></i> ลบ</button>
                                 <?php } ?>
                              </td>
                              <td class="text-center" width="30px">
                                 <button class="btn btn-block btn-xs btn-outline-<?php echo $dep_off->dep_off_status_id == 1 ? 'danger' : 'success'; ?>" onclick="modal_edit_status_dep_off(<?php echo $dep_off->dep_off_id; ?>)"><i class="fa fa-<?php echo $data->dep_status_id == 1 ? 'close' : 'check'; ?>"></i> <?php echo $dep_off->dep_off_status_id == 1 ? 'ระงับ' : 'เปิดใช้'; ?></button>
                              </td>
                           </tr>
            <?php
                        }
                     }
                  }
               }
            }
         } else {
            ?>
            <tr>
               <td class="text-center" colspan="11"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="fa text-danger">ไม่มีข้อมูล</span></td>
            </tr>
         <?php
         }
         ?>
      </tbody>
   </table>
</div>