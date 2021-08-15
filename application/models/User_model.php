<?php

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function count_pagination($filter) {
        $this->db->select('user.user_id');
        $this->db->from('user');
        $this->db->join('role', 'role.role_id = user.role_id');
        $this->db->join('ref_user_status', 'ref_user_status.user_status_id = user.user_status_id');
        if ($filter['role_id'] != '0') {
            $this->db->where('user.role_id', $filter['role_id']);
        }
        if ($filter['user_status_id'] != '0') {
            $this->db->where('user.user_status_id', $filter['user_status_id']);
        }
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                user.user_citizen LIKE '%" . $filter['searchtext'] . "%' OR
                user.username LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_email LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_fullname LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_tel LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        return $this->db->get()->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('role', 'role.role_id = user.role_id');
        $this->db->join('ref_user_status', 'ref_user_status.user_status_id = user.user_status_id');
        if ($filter['role_id'] != '0') {
            $this->db->where('user.role_id', $filter['role_id']);
        }
        if ($filter['user_status_id'] != '0') {
            $this->db->where('user.user_status_id', $filter['user_status_id']);
        }
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                user.user_citizen LIKE '%" . $filter['searchtext'] . "%' OR
                user.username LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_email LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_fullname LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_tel LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('user.user_id');
        return $this->db->get();
    }

    public function get_user($user_id = null) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('role', 'role.role_id = user.role_id');
        $this->db->join('ref_user_status', 'ref_user_status.user_status_id = user.user_status_id');
        if ($user_id != NULL) {
            $this->db->where('user.user_id', $user_id);
        }
        $this->db->limit(1);
        return $this->db->get();
    }

    public function check_username($username = NULL) {
        $this->db->select('user.user_id');
        $this->db->where('user.username', $username);
        return $this->db->get('user');
    }

    public function check_password($user_id, $password) {
        $this->db->where('user.user_id', $user_id);
        $this->db->where('user.password', $password);
        return $this->db->get('user');
    }

    public function insert_user($data) {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    public function update_user($user_id, $data) {
        $this->db->where('user.user_id', $user_id);
        $this->db->update('user', $data);
    }

    public function get_department($dep_id_pri = null) {
        if ($dep_id_pri != null) {
            $this->db->where('department.dep_id_pri', $dep_id_pri);
        }
        return $this->db->get('department');
    }

    public function get_ref_user_status($user_status_id = null) {
        if ($user_status_id != null) {
            $this->db->where('ref_user_status.user_status_id', $user_status_id);
        }
        return $this->db->get('ref_user_status');
    }

    public function get_setting_style($style_id = null) {
        if ($style_id != null) {
            $this->db->where('setting_style.style_id', $style_id);
        }
        return $this->db->get('setting_style');
    }

    public function get_role($role_id = null) {
        if ($role_id != null) {
            $this->db->where('role.role_id', $role_id);
        }
        return $this->db->get('role');
    }

    public function get_user_status() {
        return $this->db->get('ref_user_status');
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

    public function insert_user_dep_off($data) {
        $this->db->insert('user_dep_off', $data);
    }

    public function update_user_dep_off($user_dep_off_id, $data) {
        $this->db->where('user_dep_off.user_dep_off_id', $user_dep_off_id);
        $this->db->update('user_dep_off', $data);
    }

    public function update_user_dep_off_active1($user_dep_off_id, $data) {
        $this->db->where('user_dep_off.user_dep_off_id', $user_dep_off_id);
        $this->db->update('user_dep_off', $data);
    }

    public function update_user_dep_off_active2($user_dep_off_id, $user_id, $data) {
        $this->db->where('user_dep_off.user_dep_off_id !=', $user_dep_off_id);
        $this->db->where('user_dep_off.user_id', $user_id);
        $this->db->update('user_dep_off', $data);
    }

    public function checkuser_dep_off($dep_id_pri = null, $officer_id = null, $user_id = null) {
        $this->db->join('dep_off', 'user_dep_off.dep_off_id = dep_off.dep_off_id');
        if ($dep_id_pri != null) {
            $this->db->where('dep_off.dep_id_pri', $dep_id_pri);
        }
        if ($officer_id != null) {
            $this->db->where('dep_off.officer_id', $officer_id);
        }
        if ($user_id != null) {
            $this->db->where('user_dep_off.user_id', $user_id);
        }
        return $this->db->get('user_dep_off');
    }

    public function checkuserdepoff($dep_off_id = null, $user_id = null) {
        if ($dep_off_id != null) {
            $this->db->where('user_dep_off.dep_off_id', $dep_off_id);
        }
        if ($user_id != null) {
            $this->db->where('user_dep_off.user_id', $user_id);
        }
        return $this->db->get('user_dep_off');
    }

    public function check_profile($instructor_id, $citizen, $email) {
        $this->db->select('user.user_id');
        $this->db->where('user.instructor_id', $instructor_id);
        $this->db->where('user.user_citizen', $citizen);
        $this->db->where('user.user_email', $email);
        return $this->db->get('user')->num_rows();
    }

    public function get_profile_user($instructor_id, $citizen, $email) {
        $this->db->select('user.user_id');
        $this->db->where('user.instructor_id', $instructor_id);
        $this->db->where('user.user_citizen', $citizen);
        $this->db->where('user.user_email', $email);
        return $this->db->get('user')->row();
    }

    public function insert_loguser($data) {
        $this->db->insert('log_user', $data);
    }

}
