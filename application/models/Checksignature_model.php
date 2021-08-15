<?php

class Checksignature_model extends CI_Model {

    public function check($signature) {
        $this->db->from('signature');
        $this->db->join('work_info', 'work_info.work_info_id_pri = signature.work_info_id_pri');
        $this->db->where('signature.signature_key', $signature);
        return $this->db->get();
    }

    public function getWorkProcess($work_process_id_pri) {
        $this->db->from('work_process');
        $this->db->join('dep_off', 'dep_off.dep_off_id = work_process.dep_off_id');
        $this->db->join('officer', 'officer.officer_id = dep_off.officer_id');
        $this->db->where('work_process.work_process_id_pri', $work_process_id_pri);
        return $this->db->get();
    }

    public function getUser($id = null) {
        $this->db->select('*');
        $this->db->where('user.user_id', $id);
        return $this->db->get('user');
    }

}
