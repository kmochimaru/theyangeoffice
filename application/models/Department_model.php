<?php

class Department_model extends CI_Model {

   function getOrganization($org_id_pri = null) {
      if ($org_id_pri != null) {
         if ($org_id_pri != 0) {
            $this->db->where('organization.org_id_pri', $org_id_pri);
            $this->db->limit(1);
         }
      }
      return $this->db->get('organization');
   }

   function getOrgDepartment($org_id_pri = null, $dep_id_pri = null) {
      if ($org_id_pri != null) {
         if ($org_id_pri != 0) {
            $this->db->where('department.org_id_pri', $org_id_pri);
         }
      }
      if ($dep_id_pri != null) {
         if ($dep_id_pri != 0) {
            $this->db->where('department.dep_id_pri', $dep_id_pri);
         }
      }
      $this->db->order_by('department.dep_id');
      $this->db->order_by('department.dep_id_pri');
      return $this->db->get('department');
   }

   function getDepartment($dep_id_pri = null) {
      if ($dep_id_pri != null) {
         $this->db->where('department.dep_id_pri', $dep_id_pri);
         $this->db->limit(1);
      }
      $this->db->order_by('department.dep_id');
      $this->db->order_by('department.dep_id_pri');
      return $this->db->get('department');
   }

   function getPlace($place_id = null) {
      if ($place_id != null) {
         $this->db->where('place.place_id', $place_id);
         $this->db->limit(1);
      }
      return $this->db->get('place');
   }

   function getOfficer($officer_id = null) {
      if ($officer_id != null) {
         $this->db->where('officer.officer_id', $officer_id);
         $this->db->limit(1);
      }
      $this->db->order_by('officer.officer_level');
      return $this->db->get('officer');
   }

   function getdep_off($dep_id_pri = null, $officer_id = null) {
      $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
      $this->db->join('officer', 'dep_off.officer_id = officer.officer_id');
      if ($dep_id_pri != null) {
         $this->db->where('department.dep_id_pri', $dep_id_pri);
      }
      if ($officer_id != null) {
         $this->db->where('officer.officer_id', $officer_id);
      }
      $this->db->order_by('officer.officer_level');
      return $this->db->get('dep_off');
   }

   function getDepOff($dep_off_id = null) {
      if ($dep_off_id != null) {
         $this->db->where('dep_off.dep_off_id', $dep_off_id);
      }
      return $this->db->get('dep_off');
   }

   function getuser_dep_off($dep_off_id = null) {
      $this->db->join('user', 'user_dep_off.user_id = user.user_id');
      $this->db->join('role', 'role.role_id = user.role_id');
      $this->db->join('ref_user_status', 'ref_user_status.user_status_id = user.user_status_id');
      if ($dep_off_id != null) {
         $this->db->where('user_dep_off.dep_off_id', $dep_off_id);
      }
      return $this->db->get('user_dep_off');
   }

   function insertDepartment($data) {
      $this->db->insert('department', $data);
   }

   function insertDepOff($data) {
      $this->db->insert('dep_off', $data);
   }

   function updateDepartment($data, $id) {
      $this->db->where('department.dep_id_pri', $id);
      $this->db->update('department', $data);
   }

   function deleteDepartment($id) {
      $this->db->where('department.dep_id_pri', $id);
      $this->db->delete('department');
   }

   function updateDepOff($data, $id) {
      $this->db->where('dep_off.dep_off_id', $id);
      $this->db->update('dep_off', $data);
   }

   function deleteDepOff($id) {
      $this->db->where('dep_off.dep_off_id', $id);
      $this->db->delete('dep_off');
   }

   //    function parent_list($array, $parent = 0, $level) {
   //        print "<tr>";
   //        $tab = '&nbsp';
   //        for ($i = 0; $i < $level; $i++) {
   //            $tab = '&nbsp&nbsp&nbsp' . $tab;
   //        }
   //        foreach ($array->result() as $row) {
   //            if ($row->dep_id_mother == $parent) {
   //                //$check_mother = $this->getDepartmentMother($row->dep_id_pri)->num_rows();
   //                if ($row->dep_status_id == 1) {
   //                    $status = "<span class='badge badge-success'><i class='fa fa-check'></i> ปกติ</span>";
   //                    $btn = 'btn-outline-danger';
   //                    $icon = 'close';
   //                    $name = 'ระงับ';
   //                } else {
   //                    $status = "<span class='badge badge-danger'><i class='fa fa-close'></i> ถูกระงับ</span>";
   //                    $btn = 'btn-outline-success';
   //                    $icon = 'check';
   //                    $name = 'เปิดใช้';
   //                }
   //                print "<td>$tab" . "<i class='mdi mdi-subdirectory-arrow-right'></i> $row->dep_name&nbsp;<span class='text-muted'> $row->dep_name_short ( $row->dep_id ) </span></td>";
   //                print "<td class='text-right'>$status</td>";
   //                print "<td class='text-center'>
   //                        <button class='btn btn-outline-warning btn-xs' onclick='modal_add($row->org_id_pri,$row->dep_id_pri);' data-toggle='tooltip' data-original-title='เพิ่มใน'><i class='fa fa-plus-circle'></i> เพิ่มหน่วยงาน</button>                            
   //                        <button class='btn btn-xs btn-outline-info' onclick='modal_add_dep_off($row->dep_id_pri);' data-toggle='tooltip' data-original-title='เพิ่มใน'><i class='fa fa-plus-circle'></i> เพิ่มตำแหน่ง</button>                            
   //                        <button class='btn btn-outline-primary btn-xs' onclick='modal_edit($row->org_id_pri,$row->dep_id_pri);' data-toggle='tooltip' data-original-title='แก้ไข'><i class='fa fa-edit'></i> แก้ไข</button>
   //                        <button class='btn $btn btn-xs' onclick='modal_edit_status($row->dep_id_pri);' data-toggle='tooltip' data-original-title='ระงับ'><i class='fa fa-$icon'></i> $name</button>
   //                   </td>";
   //                $this->parent_list($array, $row->dep_id_pri, ($level + 1));  # recurse
   //            }
   //        }
   //        print "</tr>";
   //    }

   // year number
   public function getDepartmentYear($dep_id_pri) {
      $this->db->select('*');
      $this->db->from('department_year');
      $this->db->join('year', 'year.year_id = department_year.year_id');
      $this->db->where('department_year.dep_id_pri', $dep_id_pri);
      return $this->db->get();
   }

   public function getDepartmentYearById($dep_year_id) {
      $this->db->select('*');
      $this->db->from('department_year');
      $this->db->where('department_year.dep_year_id', $dep_year_id);
      return $this->db->get();
   }

   public function updateDepartmentYear($dep_year_id, $data) {
      $this->db->where('department_year.dep_year_id', $dep_year_id);
      $this->db->update('department_year', $data);
   }

   public function update_user_dep_off($user_dep_off_id, $data) {
      $this->db->where('user_dep_off.user_dep_off_id', $user_dep_off_id);
      $this->db->update('user_dep_off', $data);
   }
}
