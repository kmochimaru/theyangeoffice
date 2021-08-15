<?php

class Logsignaturecheck_model extends CI_Model {

   public function getPagination($filter, $params = array()) {
      if (empty($params)) {
         $this->db->select('log_check_signature.log_check_signature_id');
      } else {
         $this->db->select('
            log_check_signature.*,
            user.user_fullname
         ');
      }
      $this->db->from('log_check_signature');
      $this->db->join('user', 'user.user_id = log_check_signature.user_id');
      if ($filter['start'] != '') {
         $this->db->where("log_check_signature.log_check_signature_time >=", $filter['start'] . ' 00:00:00');
      }
      if ($filter['end'] != '') {
         $this->db->where("log_check_signature.log_check_signature_time <=", $filter['end'] . ' 23:59:59');
      }
      if ($filter['search'] != '') {
         $this->db->where(" (
            user.user_fullname LIKE '%" . $filter['search'] . "%' OR 
            log_check_signature.signature_key LIKE '%" . $filter['search'] . "%' OR 
            log_check_signature.check_text LIKE '%" . $filter['search'] . "%'
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
         $this->db->order_by('log_check_signature.log_check_signature_time', 'DESC');
         return $this->db->get();
      }
   }
}
