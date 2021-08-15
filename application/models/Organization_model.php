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
class Organization_model extends CI_Model {

    //put your code here
    public function get_page($searchtext) {
        $this->db->select('*');
        $this->db->from('organization');
        if ($searchtext != '') {
            $this->db->where(" (organization.org_name LIKE '%" . $searchtext . "%') ");
        }
        $this->db->order_by('organization.org_id');
        $this->db->order_by('organization.org_name');
        return $this->db->get();
    }

    public function getorganization($org_id_pri = null) {
        $this->db->select('*');
        $this->db->from('organization');
        if ($org_id_pri != null) {
            $this->db->where('org_id_pri', $org_id_pri);
            $this->db->limit(1);
        }
        return $this->db->get();
    }
    
    public function check_organization($org_id_pri) {
        $this->db->where('department.org_id_pri', $org_id_pri);
        return $this->db->get('department');
    }
    
    public function insert_organization($data) {
        $this->db->insert('organization', $data);
    }

    public function update_organization($org_id_pri, $data) {
        $this->db->where('organization.org_id_pri', $org_id_pri);
        $this->db->update('organization', $data);
    }
    
    public function delete_organization($org_id_pri) {
        $this->db->where('organization.org_id_pri', $org_id_pri);
        $this->db->delete('organization');
    }

}
