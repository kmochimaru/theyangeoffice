<?php

class Logworkinfomanage_model extends CI_Model {

    public function getPagination($filter, $params = array()) {
        if (empty($params)) {
            $this->db->select('log_work_info_edit.log_work_info_id');
        } else {
            $this->db->select('
         log_work_info_edit.*,
            user.user_fullname
         ');
        }
        $this->db->from('log_work_info_edit');
        $this->db->join('user', 'user.user_id = log_work_info_edit.log_user_id');
        if ($filter['start'] != '') {
            $this->db->where("log_work_info_edit.log_time >=", $filter['start'] . ' 00:00:00');
        }
        if ($filter['end'] != '') {
            $this->db->where("log_work_info_edit.log_time <=", $filter['end'] . ' 23:59:59');
        }
        if ($filter['search'] != '') {
            $this->db->where(" (
            user.user_fullname LIKE '%" . $filter['search'] . "%' OR 
            log_work_info_edit.work_info_no LIKE '%" . $filter['search'] . "%' OR 
            log_work_info_edit.log_text LIKE '%" . $filter['search'] . "%'
         ) ");
        }

        if (empty($params)) {
            return $this->db->get()->num_rows();
        } else {
            if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
                $this->db->limit($params['limit'], $params['start']);
            } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
                $this->db->limit($params['limit']);
            }
            $this->db->order_by('log_work_info_edit.log_time', 'DESC');
            return $this->db->get();
        }
    }

    public function getLogDetail($log_id) {
        $this->db->select('log_work_info_edit.*,ref_state_info.state_info_name,ref_book_group.book_group_name,year.year,user.user_fullname,'
            . 'ref_work_type.work_type_name,ref_priority_info.priority_info_name,ref_secret_level.secret_level_name,'
            . 'department.dep_name, ref_action_info.action_info_name');
        $this->db->from('log_work_info_edit');
        $this->db->join('department', 'department.dep_id_pri = log_work_info_edit.dep_id_pri');
        $this->db->join('ref_work_type', 'ref_work_type.work_type_id = log_work_info_edit.work_type_id');
        $this->db->join('ref_action_info', 'ref_action_info.action_info_id = log_work_info_edit.action_info_id');
        $this->db->join('ref_priority_info', 'ref_priority_info.priority_info_id = log_work_info_edit.priority_info_id');
        $this->db->join('ref_secret_level', 'ref_secret_level.secret_level_id = log_work_info_edit.secret_level_id');
        $this->db->join('ref_state_info', 'ref_state_info.state_info_id = log_work_info_edit.state_info_id');
        $this->db->join('ref_book_group', 'ref_book_group.book_group_id = log_work_info_edit.book_group_id');
        $this->db->join('year', 'year.year_id = log_work_info_edit.year_id');
        $this->db->join('user', 'user.user_id = log_work_info_edit.user_id');
        $this->db->where('log_work_info_edit.log_work_info_id', $log_id);
        $this->db->limit(1);
        return $this->db->get();
    }

    public function getLogDetailOld($work_info_id_pri, $log_work_info_id) {
        $this->db->select('log_work_info_edit.log_work_info_id');
        $this->db->from('log_work_info_edit');
        $this->db->where('log_work_info_edit.work_info_id_pri', $work_info_id_pri);
        $this->db->where('log_work_info_edit.log_work_info_id <', $log_work_info_id);
        $this->db->order_by('log_work_info_edit.log_work_info_id', 'DESC');
        $this->db->limit(1);
        return $this->db->get();
    }
}
