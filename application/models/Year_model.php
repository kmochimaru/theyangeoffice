<?php

class Year_model extends CI_Model {

    public function getData($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('year_id', $id);
        }
        $this->db->order_by('year.year');
        return $this->db->get('year');
    }

    public function insert($data) {
        $this->db->insert('year', $data);
    }

    public function update($year_id, $data) {
        $this->db->where('year.year_id', $year_id);
        $this->db->update('year', $data);
    }

    public function delete($year_id) {
        $this->db->where('year.year_id', $year_id);
        $this->db->delete('year');
    }

    //----- check -----------
    public function check_map_dep($year_id, $dep_id = null) {
        $this->db->select('department_year.dep_year_id');
        $this->db->where('department_year.year_id', $year_id);
        if ($dep_id != null) {
            $this->db->where('department_year.dep_id_pri', $dep_id);
        }
        return $this->db->get('department_year')->num_rows();
    }

    public function check_map_work($year_id) {
        $this->db->select('work.work_id_pri');
        $this->db->where('work.year_id', $year_id);
        return $this->db->get('work')->num_rows();
    }

    public function getDep() {
        $this->db->select('department.dep_id_pri');
        return $this->db->get('department');
    }

    public function insert_map_year($data) {
        $this->db->insert('department_year', $data);
    }

}
