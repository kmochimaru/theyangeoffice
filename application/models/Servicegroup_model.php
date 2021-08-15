<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servicegroup_model
 *
 * @author nut
 */
class Servicegroup_model extends CI_Model {

    //put your code here
    public function get_servicegroup($id = NULL) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('service_group_id', $id);
        }
        $this->db->order_by('service_group.service_group_sort');
        return $this->db->get('service_group');
    }

    public function get_last_servicegroup() {
        $this->db->select('service_group.service_group_sort');
        $this->db->order_by('service_group.service_group_sort', 'desc');
        return $this->db->get('service_group');
    }

    public function checkservicegroup($service_group_id) {
        $this->db->from('service');
        $this->db->where('service.service_group_id', $service_group_id);
        return $this->db->count_all_results();
    }

    public function addservicegroup($data) {
        $this->db->insert('service_group', $data);
    }

    public function editservicegroup($id, $data) {
        $this->db->where('service_group.service_group_id', $id);
        $this->db->update('service_group', $data);
    }

    public function deleteservicegroup($id) {
        $this->db->where('service_group.service_group_id', $id);
        $this->db->delete('service_group');
    }

    // service
    public function get_service($id = NULL) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('service_id', $id);
        }
        $this->db->order_by('service.service_sort');
        return $this->db->get('service');
    }

    public function get_service_all($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('service_group_id', $id);
        }
        $this->db->order_by('service.service_sort');
        return $this->db->get('service');
    }

    public function get_last_service($service_group_id) {
        $this->db->select('service.service_sort');
        $this->db->where('service.service_group_id', $service_group_id);
        $this->db->order_by('service.service_sort', 'desc');
        return $this->db->get('service');
    }

    public function checkservice($service_id) {
        $this->db->from('help_desk');
        $this->db->where('help_desk.service_id', $service_id);
        return $this->db->count_all_results();
    }

    public function addservice($data) {
        $this->db->insert('service', $data);
    }

    public function editservice($id, $data) {
        $this->db->where('service.service_id', $id);
        $this->db->update('service', $data);
    }

    public function deleteservice($id) {
        $this->db->where('service.service_id', $id);
        $this->db->delete('service');
    }

    public function get_service_help_desk($service_id = NULL) {
        $this->db->select('*');
        $this->db->join('help_desk', 'help_desk.service_id = service.service_id');
        $this->db->join('user', 'help_desk.user_id = user.user_id');
        if ($service_id != NULL) {
            $this->db->where('service.service_id', $service_id);
        }
        $this->db->order_by('help_desk.help_desk_id');
        return $this->db->get('service');
    }

    public function get_user($filter) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('user_dep_off', ' user_dep_off.user_id = `user`.user_id');
        $this->db->join('dep_off', 'user_dep_off.dep_off_id = dep_off.dep_off_id');
        if ($filter['dep_id_pri'] != '') {
            $this->db->where('dep_off.dep_id_pri', $filter['dep_id_pri']);
        }
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                user.user_citizen LIKE '%" . $filter['searchtext'] . "%' OR
                user.user_email LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_fullname LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_tel LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        $this->db->where('user_dep_off.user_dep_off_status_id', 1);
        $this->db->where('user_dep_off.user_dep_off_active_id', 1);
        //$this->db->where('user.user_line_token IS NOT NULL');
        return $this->db->get();
    }

    function getuser_dep_off($user_id = null) {
        $this->db->join('dep_off', 'user_dep_off.dep_off_id = dep_off.dep_off_id');
        $this->db->join('officer', 'dep_off.officer_id = officer.officer_id');
        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        if ($user_id != null) {
            $this->db->where('user_dep_off.user_id', $user_id);
        }
        $this->db->where('user_dep_off.user_dep_off_status_id', 1);
        $this->db->where('user_dep_off.user_dep_off_active_id', 1);
        $this->db->limit(1);
        return $this->db->get('user_dep_off');
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
        $this->db->order_by('officer.officer_level');
        return $this->db->get('dep_off');
    }

    function getUserDepOff($user_id = null) {
        $this->db->join('user', 'user_dep_off.user_id = user.user_id');
        $this->db->join('dep_off', 'user_dep_off.dep_off_id = dep_off.dep_off_id');
        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        $this->db->join('officer', 'dep_off.officer_id = officer.officer_id');
        if ($user_id != null) {
            $this->db->where('user.user_id', $user_id);
        }
        $this->db->order_by('user_dep_off.user_dep_off_active_id');
        return $this->db->get('user_dep_off');
    }

    function get_department($dep_id_pri = null) {
        if ($dep_id_pri != null) {
            $this->db->where('department.dep_id_pri', $dep_id_pri);
        }
        return $this->db->get('department');
    }

    public function insert_help_desk($data) {
        $this->db->insert('help_desk', $data);
        return $this->db->insert_id();
    }

    public function update_help_desk($help_desk_id, $data) {
        $this->db->where('help_desk.help_desk_id', $help_desk_id);
        $this->db->update('help_desk', $data);
    }

    public function delete_help_desk($help_desk_id) {
        $this->db->where('help_desk.help_desk_id', $help_desk_id);
        $this->db->delete('help_desk');
    }

    function check_help_desk($user_id, $service_id) {
        $this->db->where('help_desk.user_id', $user_id);
        $this->db->where('help_desk.service_id', $service_id);
        return $this->db->get('help_desk')->num_rows();
    }

    function check_help_desk_active($service_id) {
        $this->db->where('help_desk.service_id', $service_id);
        $this->db->where('help_desk.help_desk_active_id', 1);
        return $this->db->get('help_desk')->num_rows();
    }

}
