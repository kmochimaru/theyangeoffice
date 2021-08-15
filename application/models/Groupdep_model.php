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
class Groupdep_model extends CI_Model {

    //put your code here
    public function get_groupdep($id = NULL) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('groupdep_id', $id);
        }
        $this->db->where('groupdep.dep_id_pri', $this->session->userdata('dep_id_pri'));
        return $this->db->get('groupdep');
    }

    public function checkgroupdep($id) {
        $this->db->from('groupdep_process');
        $this->db->where('groupdep_process.groupdep_id', $id);
        return $this->db->count_all_results();
    }

    public function addgroupdep($data) {
        $this->db->insert('groupdep', $data);
    }

    public function editgroupdep($id, $data) {
        $this->db->where('groupdep.groupdep_id', $id);
        $this->db->update('groupdep', $data);
    }

    public function deletegroupdep($id) {
        $this->db->where('groupdep.groupdep_id', $id);
        $this->db->delete('groupdep');
    }

    public function get_groupdep_process($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('groupdep_process.groupdep_id', $id);
        }
        $this->db->join('groupdep', 'groupdep_process.groupdep_id = groupdep.groupdep_id');
        $this->db->order_by('groupdep_process.groupdep_process_sort');
        return $this->db->get('groupdep_process');
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

    public function check_status($groupdep_id, $dep_off_id) {
        $this->db->where('groupdep_process.groupdep_id', $groupdep_id);
        $this->db->where('groupdep_process.dep_off_id', $dep_off_id);
        return $this->db->count_all_results('groupdep_process');
    }

    public function addgroupdepprocess($data) {
        $this->db->insert('groupdep_process', $data);
        return 1;
    }

    public function editgroupdepprocess($id, $data) {
        $this->db->where('groupdep_process.groupdep_process_id', $id);
        $this->db->update('groupdep_process', $data);
    }

    public function deletegroupdepprocess($groupdep_id, $dep_off_id) {
        $this->db->where('groupdep_id', $groupdep_id);
        $this->db->where('dep_off_id', $dep_off_id);
        $this->db->delete('groupdep_process');
        return 1;
    }

    public function get_last($groupdep_id) {
        $this->db->select('groupdep_process.groupdep_process_sort');
        $this->db->where('groupdep_process.groupdep_id', $groupdep_id);
        $this->db->order_by('groupdep_process.groupdep_process_sort', 'desc');
        return $this->db->get('groupdep_process');
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
        $this->db->order_by('department.dep_id');
        $this->db->order_by('department.dep_id_pri');
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

    public function checkprocessnotopen($work_info_id_pri, $dep_off_id) {
        $this->db->select('*');
        $this->db->from('work_process');
        $this->db->where('work_process.work_info_id_pri', $work_info_id_pri);
        $this->db->where('work_process.dep_off_id', $dep_off_id);
        $this->db->where('work_process.work_process_receive !=', 1);
        return $this->db->get();
    }
}
