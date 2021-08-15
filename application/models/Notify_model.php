<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notify_model
 *
 * @author nut
 */
class Notify_model extends CI_Model {

    //put your code here
    public function get_user($filter) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('role', 'role.role_id = user.role_id');
        $this->db->join('user_dep_off', ' user_dep_off.user_id = `user`.user_id');
        $this->db->join('dep_off', 'user_dep_off.dep_off_id = dep_off.dep_off_id');
        if ($filter['dep_id_pri'] != '') {
            $this->db->where('dep_off.dep_id_pri', $filter['dep_id_pri']);
        }
        if ($filter['role_id'] != '0') {
            $this->db->where('user.role_id', $filter['role_id']);
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
        $this->db->where('user.user_line_token IS NOT NULL');
        return $this->db->get();
    }

    public function get_role($role_id = null) {
        if ($role_id != null) {
            $this->db->where('role.role_id', $role_id);
        }
        return $this->db->get('role');
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

    public function insert_notify($data) {
        $this->db->insert('notify', $data);
        return $this->db->insert_id();
    }

    public function insert_notification($data) {
        $this->db->insert('notification', $data);
        //return $this->db->insert_id();
    }

    public function get_line_token($user_id = null) {
        $this->db->select('user_line_token');
        if ($user_id != null) {
            $this->db->where('user.user_id', $user_id);
        }
        return $this->db->get('user');
    }

    function get_department($dep_id_pri = null) {
        if ($dep_id_pri != null) {
            $this->db->where('department.dep_id_pri', $dep_id_pri);
        }
        return $this->db->get('department');
    }

}
