<?php

class Worktype_model extends CI_Model {

    public function getWorkType() {
        $this->db->select('*');
        return $this->db->get('ref_work_type');
    }

}
