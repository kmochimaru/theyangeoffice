<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Routes_model
 *
 * @author nut
 */
class Routes_model extends CI_Model {

    //put your code here
    public function get_routes($id = NULL) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('routes_id', $id);
        }
        $this->db->where('routes.dep_id_pri', $this->session->userdata('dep_id_pri'));
        return $this->db->get('routes');
    }

    public function checkroutes($id) {
        $this->db->from('routes_process');
        $this->db->where('routes_process.routes_id', $id);
        return $this->db->count_all_results();
    }

    public function addroutes($data) {
        $this->db->insert('routes', $data);
    }

    public function editroutes($id, $data) {
        $this->db->where('routes.routes_id', $id);
        $this->db->update('routes', $data);
    }

    public function deleteroutes($id) {
        $this->db->where('routes.routes_id', $id);
        $this->db->delete('routes');
    }

    public function get_routes_process($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('routes_process.routes_id', $id);
        }
        $this->db->join('routes', 'routes_process.routes_id = routes.routes_id');
        $this->db->order_by('routes_process.routes_process_sort');
        return $this->db->get('routes_process');
    }

    public function get_dep_off($id = null, $dep_id_pri = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('dep_off.dep_off_id', $id);
        }
        if ($dep_id_pri != NULL) {
            $this->db->where('dep_off.dep_id_pri', $dep_id_pri);
        }
        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        $this->db->join('officer', 'dep_off.officer_id = officer.officer_id');
        $this->db->order_by('department.dep_id');
        $this->db->order_by('officer.officer_level');
        return $this->db->get('dep_off');
    }

    public function check_status($routes_id, $dep_off_id) {
        $this->db->where('routes_process.routes_id', $routes_id);
        $this->db->where('routes_process.dep_off_id', $dep_off_id);
        return $this->db->count_all_results('routes_process');
    }

    public function addroutesprocess($data) {
        $this->db->insert('routes_process', $data);
        return 1;
    }

    public function editroutesprocess($id, $data) {
        $this->db->where('routes_process.routes_process_id', $id);
        $this->db->update('routes_process', $data);
    }

    public function deleteroutesprocess($routes_id, $dep_off_id) {
        $this->db->where('routes_id', $routes_id);
        $this->db->where('dep_off_id', $dep_off_id);
        $this->db->delete('routes_process');
        return 1;
    }

    public function get_last($routes_id) {
        $this->db->select('routes_process.routes_process_sort');
        $this->db->where('routes_process.routes_id', $routes_id);
        $this->db->order_by('routes_process.routes_process_sort', 'desc');
        return $this->db->get('routes_process');
    }

    function getOrganization($org_id_pri = null) {
        if ($org_id_pri != null) {
            if ($org_id_pri != 0) {
                $this->db->where('organization.org_id_pri', $org_id_pri);
                $this->db->limit(0);
            }
        }
        return $this->db->get('organization');
    }

    function getOrgDepartment($org_id_pri = null, $dep_id_pri = null) {
        if ($org_id_pri != null) {
            if ($org_id_pri != 0) {
                $this->db->where('department.org_id_pri', $org_id_pri);
            }
        }
        if ($dep_id_pri != null) {
            if ($dep_id_pri != 0) {
                $this->db->where('department.dep_id_pri', $dep_id_pri);
            }
        }
        return $this->db->get('department');
    }

    function getdep_off($dep_id_pri = null, $officer_id = null) {
        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        $this->db->join('officer', 'dep_off.officer_id = officer.officer_id');
        if ($dep_id_pri != null) {
            $this->db->where('department.dep_id_pri', $dep_id_pri);
        }
        if ($officer_id != null) {
            $this->db->where('officer.officer_id', $officer_id);
        }
        $this->db->where('officer.officer_level !=', 99);
        $this->db->order_by('officer.officer_level');
        return $this->db->get('dep_off');
    }

}
