<?php

class Logworkprocess_model extends CI_Model {

   public function getPagination($filter, $params = array()) {
      if (empty($params)) {
         $this->db->select('log_work_process.log_id');
      } else {
         $this->db->select('
            log_work_process.*,
            user.user_fullname,
            work_process.work_process_no
         ');
      }
      $this->db->from('log_work_process');
      $this->db->join('work_process', 'work_process.work_process_id_pri = log_work_process.work_process_id_pri');
      $this->db->join('user', 'user.user_id = log_work_process.user_id');
      if ($filter['start'] != '') {
         $this->db->where("log_work_process.log_time >=", $filter['start'] . ' 00:00:00');
      }
      if ($filter['end'] != '') {
         $this->db->where("log_work_process.log_time <=", $filter['end'] . ' 23:59:59');
      }
      if ($filter['search'] != '') {
         $this->db->where(" (
            user.user_fullname LIKE '%" . $filter['search'] . "%' OR 
            log_work_process.log_text LIKE '%" . $filter['search'] . "%' OR 
            work_process.work_process_no LIKE '%" . $filter['search'] . "%'
         ) ");
      }

      if (empty($params)) {
         return $this->db->get()->num_rows();
      } else {
         if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
         } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
         }
         $this->db->order_by('log_work_process.log_time', 'DESC');
         return $this->db->get();
      }
   }
}
