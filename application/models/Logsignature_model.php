<?php

class Logsignature_model extends CI_Model {

   public function getPagination($filter, $params = array()) {
      if (empty($params)) {
         $this->db->select('signature.signature_id');
      } else {
         $this->db->select('
            signature.*,
            user.user_fullname
         ');
      }
      $this->db->from('signature');
      $this->db->join('user', 'user.user_id = signature.user_id');
      if ($filter['start'] != '') {
         $this->db->where("signature.signaturec_modify >=", $filter['start'] . ' 00:00:00');
      }
      if ($filter['end'] != '') {
         $this->db->where("signature.signaturec_modify <=", $filter['end'] . ' 23:59:59');
      }
      if ($filter['search'] != '') {
         $this->db->where(" (
            user.user_fullname LIKE '%" . $filter['search'] . "%' OR 
            signature.signature_work_no LIKE '%" . $filter['search'] . "%' OR 
            signature.signature_name LIKE '%" . $filter['search'] . "%'
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
         $this->db->order_by('signature.signaturec_modify', 'DESC');
         return $this->db->get();
      }
   }
}
