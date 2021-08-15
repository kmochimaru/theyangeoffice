<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Serviecinfo_model
 *
 * @author nut
 */
class Serviecinfo_model extends CI_Model {

    //put your code here
    public function count_pagination($filter) {
        $this->db->select('service_info.service_info_id_pri');
        $this->db->from('service_info');
        $this->db->join('service', 'service_info.service_id = service.service_id');
        $this->db->join('service_group', 'service.service_group_id = service_group.service_group_id');
        $this->db->join('ref_service_status', 'service_info.service_status_id = ref_service_status.service_status_id');
        $this->db->where('service_info.user_id', $this->session->userdata('user_id'));
        if ($filter['service_id'] != '') {
            $this->db->where("service_info.service_id", $filter['service_id']);
        }
        if ($filter['service_group_id'] != '') {
            $this->db->where("service_group.service_group_id", $filter['service_group_id']);
        }
        if ($filter['service_status_id'] != '') {
            $this->db->where("service_info.service_status_id", $filter['service_status_id']);
        }
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                service_info.service_info_id_pri LIKE '%" . $filter['searchtext'] . "%' OR 
                service_info.service_info_suject LIKE '%" . $filter['searchtext'] . "%' OR 
                service_info.service_info_detail LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        return $this->db->get()->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('*');
        $this->db->from('service_info');
        $this->db->join('service', 'service_info.service_id = service.service_id');
        $this->db->join('service_group', 'service.service_group_id = service_group.service_group_id');
        $this->db->join('ref_service_status', 'service_info.service_status_id = ref_service_status.service_status_id');
        $this->db->where('service_info.user_id', $this->session->userdata('user_id'));
        if ($filter['service_id'] != '') {
            $this->db->where("service_info.service_id", $filter['service_id']);
        }
        if ($filter['service_group_id'] != '') {
            $this->db->where("service_group.service_group_id", $filter['service_group_id']);
        }
        if ($filter['service_status_id'] != '') {
            $this->db->where("service_info.service_status_id", $filter['service_status_id']);
        }
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                service_info.service_info_id_pri LIKE '%" . $filter['searchtext'] . "%' OR
                service_info.service_info_suject LIKE '%" . $filter['searchtext'] . "%' OR 
                service_info.service_info_detail LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('service_info.service_info_create', 'DESC');
        return $this->db->get();
    }

    public function getDepartment($dep_id_pri = null) {
        $this->db->select('*');
        $this->db->from('department');
        if ($dep_id_pri != null) {
            $this->db->where('department.dep_id_pri', $dep_id_pri);
        }
        return $this->db->get();
    }

    public function get_uesr($instructor_id = null) {
        $this->db->select('*');
        $this->db->from('user');
        if ($instructor_id != null) {
            $this->db->where('user.instructor_id', $instructor_id);
            $this->db->limit(1);
        }
        $this->db->where('user.user_id', $this->session->userdata('user_id'));
        return $this->db->get();
    }

    public function getUserDepOff($dep_id_pri) {
        $this->db->select('*');
        $this->db->from('user_dep_off');
        $this->db->join('dep_off', 'user_dep_off.dep_off_id = dep_off.dep_off_id');
        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        $this->db->join('officer', 'dep_off.officer_id = officer.officer_id');
        $this->db->join('user', 'user_dep_off.user_id = user.user_id');
        $this->db->where('user_dep_off.user_dep_off_status_id', 1);
        $this->db->where('user_dep_off.user_dep_off_active_id', 1);
        $this->db->where('department.dep_status_id', 1);
        $this->db->where('dep_off.dep_off_status_id', 1);
        $this->db->where('department.dep_id_pri', $dep_id_pri);
        $this->db->order_by('officer.officer_level');
        return $this->db->get();
    }

    public function getDepOff($user_dep_off_id) {
        $this->db->select('*');
        $this->db->from('user_dep_off');
        $this->db->join('dep_off', 'user_dep_off.dep_off_id = dep_off.dep_off_id');
        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        $this->db->join('officer', 'dep_off.officer_id = officer.officer_id');
        $this->db->where('user_dep_off.user_dep_off_id', $user_dep_off_id);
        $this->db->where('user_dep_off.user_dep_off_status_id', 1);
        $this->db->where('user_dep_off.user_dep_off_active_id', 1);
        $this->db->where('department.dep_status_id', 1);
        $this->db->where('dep_off.dep_off_status_id', 1);
        $this->db->limit(1);
        return $this->db->get();
    }

    public function ref_priority_info($priority_info_id = null) {
        $this->db->select('*');
        $this->db->from('ref_priority_info');
        if ($priority_info_id != null) {
            $this->db->where('ref_priority_info.priority_info_id', $priority_info_id);
            $this->db->limit(1);
        }
        return $this->db->get();
    }

    public function get_service_group($service_group_id = null) {
        $this->db->select('*');
        $this->db->from('service_group');
        if ($service_group_id != null) {
            $this->db->where('service_group.service_group_id', $service_group_id);
        }
        $this->db->order_by('service_group.service_group_sort');
        return $this->db->get();
    }

    public function get_service($service_group_id = null, $service_id = null) {
        $this->db->select('*');
        $this->db->from('service_group');
        $this->db->join('service', 'service.service_group_id = service_group.service_group_id');
        if ($service_group_id != null) {
            $this->db->where('service_group.service_group_id', $service_group_id);
        }
        if ($service_id != null) {
            $this->db->where('service.service_id', $service_id);
        }
        $this->db->where('service.service_status_id', 1);
        $this->db->order_by('service_group.service_group_sort');
        $this->db->order_by('service.service_sort');
        return $this->db->get();
    }

    public function insert_serviceinfo($data) {
        $this->db->insert('service_info', $data);
        return $this->db->insert_id();
    }

    public function update_serviceinfo($service_info_id_pri, $data) {
        $this->db->where('service_info.service_info_id_pri', $service_info_id_pri);
        $this->db->update('service_info', $data);
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

    public function insert_help_desk_team($data) {
        $this->db->insert('help_desk_team', $data);
    }

    public function ref_service_status($service_status_id = null) {
        $this->db->select('*');
        $this->db->from('ref_service_status');
        if ($service_status_id != null) {
            $this->db->where('ref_service_status.service_status_id', $service_status_id);
            $this->db->limit(1);
        }
        return $this->db->get();
    }

    public function getserviceinfo($service_info_id_pri) {
        $this->db->select('*');
        $this->db->from('service_info');
        $this->db->join('service', 'service_info.service_id = service.service_id');
        $this->db->join('service_group', 'service.service_group_id = service_group.service_group_id');
        $this->db->join('ref_service_status', 'service_info.service_status_id = ref_service_status.service_status_id');
        $this->db->join('user', 'service_info.user_id = `user`.user_id');
        $this->db->join('ref_priority_info', 'service_info.priority_info_id = ref_priority_info.priority_info_id');
        $this->db->where('user.user_id', $this->session->userdata('user_id'));
        if ($service_info_id_pri != null) {
            $this->db->where('service_info.service_info_id_pri', $service_info_id_pri);
            $this->db->limit(1);
        }
        return $this->db->get();
    }

    public function insert_service_user($data) {
        $this->db->insert('service_user', $data);
    }

    public function get_service_user($service_info_id_pri) {
        $this->db->select('*');
        $this->db->from('service_info');
        $this->db->join('service_user', 'service_user.service_info_id_pri = service_info.service_info_id_pri');
        //$this->db->join('user', 'service_user.user_id = user.user_id');
        if ($service_info_id_pri != null) {
            $this->db->where('service_info.service_info_id_pri', $service_info_id_pri);
        }
        return $this->db->get();
    }

    public function get_uesr_id($uesr_id = null) {
        $this->db->select('*');
        $this->db->from('user');
        if ($uesr_id != null) {
            $this->db->where('user.user_id', $uesr_id);
            $this->db->limit(1);
        }
        return $this->db->get();
    }

}
