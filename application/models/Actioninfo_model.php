<?php

class Actioninfo_model extends CI_Model {

    public function getActioninfo() {
        $this->db->select('*');
        $this->db->order_by('ref_action_info.action_info_sort', 'ASC');
        return $this->db->get('ref_action_info');
    }
    
    public function getActioninfoById($action_info_id) {
        $this->db->select('*');
        $this->db->where('ref_action_info.action_info_id', $action_info_id);
        return $this->db->get('ref_action_info');
    }

    public function insert($data) {
        $this->db->insert('ref_action_info', $data);
    }

    public function update($action_info_id, $data) {
        $this->db->where('ref_action_info.action_info_id', $action_info_id);
        $this->db->update('ref_action_info', $data);
    }
    
    public function delete($action_info_id) {
        $this->db->where('ref_action_info.action_info_id', $action_info_id);
        $this->db->delete('ref_action_info');
    }

}
