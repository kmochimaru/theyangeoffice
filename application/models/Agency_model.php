<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Organization_model
 *
 * @author nut
 */
class Agency_model extends CI_Model {

    //put your code here
    public function get_page($filter) {
        $this->db->select('*');
        $this->db->from('agency');
        $this->db->join('ref_department_status', 'ref_department_status.dep_status_id = agency.dep_status_id');
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                agency.agency_id_pri LIKE '%" . $filter['searchtext'] . "%' OR 
                agency.agency_id LIKE '%" . $filter['searchtext'] . "%' OR 
                agency.agency_name LIKE '%" . $filter['searchtext'] . "%' OR 
                agency.agency_name_short LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        $this->db->order_by('agency.agency_id_pri', 'DESC');
        return $this->db->get();
    }

    public function departmentStatus() {
        $this->db->select('*');
        $this->db->from('ref_department_status');
        return $this->db->get();
    }

    public function getAgencyById($agency_id_pri) {
        $this->db->select('*');
        $this->db->from('agency');
        $this->db->where('agency.agency_id_pri', $agency_id_pri);
        return $this->db->get();
    }

    public function insert($data) {
        $this->db->insert('agency', $data);
    }

    public function update($agency_id_pri, $data) {
        $this->db->where('agency.agency_id_pri', $agency_id_pri);
        $this->db->update('agency', $data);
    }

    public function delete($agency_id_pri) {
        $this->db->where('agency.agency_id_pri', $agency_id_pri);
        $this->db->delete('agency');
    }

}
