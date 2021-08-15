<?php

class Loguserlogin_model extends CI_Model {

   public function getPagination($filter, $params = array()) {
      if (empty($params)) {
         $this->db->select('log_user_login.log_id');
      } else {
         $this->db->select('
            log_user_login.*,
            user.user_fullname
         ');
      }
      $this->db->from('log_user_login');
      $this->db->join('user', 'user.user_id = log_user_login.user_id');
      if ($filter['start'] != '') {
         $this->db->where("log_user_login.log_time >=", $filter['start'] . ' 00:00:00');
      }
      if ($filter['end'] != '') {
         $this->db->where("log_user_login.log_time <=", $filter['end'] . ' 23:59:59');
      }
      if ($filter['search'] != '') {
         $this->db->where(" (
            user.user_fullname LIKE '%" . $filter['search'] . "%' OR 
            log_user_login.log_text LIKE '%" . $filter['search'] . "%' OR 
            log_user_login.log_ip_address LIKE '%" . $filter['search'] . "%' OR 
            log_user_login.log_browser LIKE '%" . $filter['search'] . "%'
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
         $this->db->order_by('log_user_login.log_time', 'DESC');
         return $this->db->get();
      }
   }
}
