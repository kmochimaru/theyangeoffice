<?php

class Profile_model extends CI_Model {

    public function getUser($id = null) {
        $this->db->select('*');
        $this->db->join("ref_user_status", "ref_user_status.user_status_id = user.user_status_id");
        $this->db->join('role', 'role.role_id = user.role_id');
        if ($id != NULL) {
            $this->db->where('user.user_id', $id);
        }
        return $this->db->get('user');
    }

    public function getDepartment($id) {
        $this->db->select('*');
        $this->db->join("ref_department_status", "ref_department_status.dep_status_id = department.dep_status_id");
        $this->db->join("place", "place.place_id = department.place_id");
        $this->db->where('department.dep_id_pri', $id);
        return $this->db->get('department');
    }

    public function getLoglogin($id) {
        $this->db->select('log_user_login.*,user.user_fullname');
        $this->db->join('user', 'user.user_id = log_user_login.user_id');
        $this->db->where('log_user_login.user_id', $id);
        $this->db->limit(10);
        $this->db->order_by('log_user_login.log_time', 'DESC');
        return $this->db->get('log_user_login');
    }

    public function getLogUser($id) {
        $this->db->where('log_user.user_id', $id);
        $this->db->limit(10);
        $this->db->order_by('log_user.log_time', 'DESC');
        return $this->db->get('log_user');
    }

    public function getDepartmentYear($id, $yaer) {
        $this->db->select('*');
        $this->db->join('year', 'year.year_id = department_year.year_id');
        $this->db->where('department_year.dep_id_pri', $id);
        $this->db->where('department_year.year', $yaer);
        return $this->db->get('department_year');
    }

    public function edit($id, $data) {
        $this->db->where('user.user_id', $id);
        $this->db->update('user', $data);
    }

    public function checkPassword($user_id, $password) {
        $this->db->where('user_id', $user_id);
        $this->db->where('password', $password);
        return $this->db->get('user');
    }

    public function getPhoto($user_id) {
        $this->db->select('user.user_image');
        $this->db->where('user.user_id', $user_id);
        return $this->db->get('user')->row()->user_image;
    }

    public function getPhotosignature($user_id) {
        $this->db->select('user.user_signature_path');
        $this->db->where('user.user_id', $user_id);
        return $this->db->get('user')->row()->user_signature_path;
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

    public function insert_loguser($data) {
        $this->db->insert('log_user', $data);
    }

}
