<?php

class Officer_model extends CI_Model {

    public function get_officer($id = NULL) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('officer.officer_id', $id);
        }
        $this->db->order_by('officer.officer_level');
        return $this->db->get('officer');
    }

    public function checkofficer($id) {
        $this->db->from('dep_off');
        $this->db->where('dep_off.officer_id', $id);
        return $this->db->count_all_results();
    }

    public function addofficer($data) {
        $this->db->insert('officer', $data);
    }

    public function editofficer($id, $data) {
        $this->db->where('officer.officer_id', $id);
        $this->db->update('officer', $data);
    }

    public function deleteofficer($id) {
        $this->db->where('officer.officer_id', $id);
        $this->db->delete('officer');
    }

}
