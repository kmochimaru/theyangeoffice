<?php

class Setting_model extends CI_Model {

   public function getDepartment($id) {
      $this->db->select('*');
      $this->db->join("ref_department_status", "ref_department_status.dep_status_id = department.dep_status_id");
      $this->db->join("place", "place.place_id = department.place_id");
      $this->db->where('department.dep_id_pri', $id);
      return $this->db->get('department');
   }

   public function getDepartmentYear($id, $yaer) {
      $this->db->select('*');
      $this->db->join('year', 'year.year_id = department_year.year_id');
      $this->db->where('department_year.dep_id_pri', $id);
      $this->db->where('department_year.year', $yaer);
      return $this->db->get('department_year');
   }

   function getPlace($place_id = null) {
      if ($place_id != null) {
         $this->db->where('place.place_id', $place_id);
         $this->db->limit(0);
      }
      return $this->db->get('place');
   }

   function updateDepartment($data, $id) {
      $this->db->where('department.dep_id_pri', $id);
      $this->db->update('department', $data);
   }
}
