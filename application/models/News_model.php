<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of News_model
 *
 * @author nut
 */
class News_model extends CI_Model {

    //put your code here
    public function count_pagination($filter) {
        $this->db->select('work_info.work_info_id_pri');
        $this->db->from('work_info');
        $this->db->join('ref_state_info', 'ref_state_info.state_info_id = work_info.state_info_id');
        $this->db->join('ref_priority_info', 'ref_priority_info.priority_info_id = work_info.priority_info_id');
        $this->db->join('ref_book_group', 'ref_book_group.book_group_id = work_info.book_group_id');
        $this->db->join('year', 'year.year_id = work_info.year_id');
        $this->db->join('user', 'user.user_id = work_info.user_id');
        $this->db->join('log_news', 'log_news.user_id = `user`.user_id AND log_news.work_info_id_pri = work_info.work_info_id_pri', 'LEFT');
        //$this->db->where('work_info.dep_off_id', $this->session->userdata('dep_off_id'));
        if ($filter['year_id'] != '') {
            $this->db->where("work_info.year_id", $filter['year_id']);
        }
        if ($filter['book_group_id'] != '') {
            $this->db->where("work_info.book_group_id", $filter['book_group_id']);
        }
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                CONCAT(work_info.work_info_no,work_info.work_info_no_3) LIKE '%" . $filter['searchtext'] . "%' OR
                work_info.work_info_subject LIKE '%" . $filter['searchtext'] . "%' OR 
                work_info.work_info_id LIKE '%" . $filter['searchtext'] . "%' OR 
                work_info.work_info_no LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        if ($filter['status_id'] == 1) {
            $this->db->where("log_news.log_id IS NOT NULL");
        } else if ($filter['status_id'] == 2) {
            $this->db->where("log_news.log_id IS NULL");
        }
        $this->db->where('work_info.work_info_retrospect', 0);
        $this->db->where('work_info.state_info_id',6);
        $this->db->where_in('work_info.work_type_id', array(4, 5));
        return $this->db->get()->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('work_info.*,ref_state_info.state_info_name,ref_book_group.book_group_name,year.year,user.user_fullname,ref_priority_info.priority_info_name');
        $this->db->from('work_info');
        $this->db->join('ref_state_info', 'ref_state_info.state_info_id = work_info.state_info_id');
        $this->db->join('ref_priority_info', 'ref_priority_info.priority_info_id = work_info.priority_info_id');
        $this->db->join('ref_book_group', 'ref_book_group.book_group_id = work_info.book_group_id');
        $this->db->join('year', 'year.year_id = work_info.year_id');
        $this->db->join('user', 'user.user_id = work_info.user_id');
        $this->db->join('log_news', 'log_news.user_id = `user`.user_id AND log_news.work_info_id_pri = work_info.work_info_id_pri', 'LEFT');
        //$this->db->where('work_info.dep_off_id', $this->session->userdata('dep_off_id'));
        if ($filter['year_id'] != '') {
            $this->db->where("work_info.year_id", $filter['year_id']);
        }
        if ($filter['book_group_id'] != '') {
            $this->db->where("work_info.book_group_id", $filter['book_group_id']);
        }
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                CONCAT(work_info.work_info_no,work_info.work_info_no_3) LIKE '%" . $filter['searchtext'] . "%' OR
                work_info.work_info_subject LIKE '%" . $filter['searchtext'] . "%' OR 
                work_info.work_info_id LIKE '%" . $filter['searchtext'] . "%' OR 
                work_info.work_info_no LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        if ($filter['status_id'] == 1) {
            $this->db->where("log_news.log_id IS NOT NULL");
        } else if ($filter['status_id'] == 2) {
            $this->db->where("log_news.log_id IS NULL");
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->where('work_info.work_info_retrospect', 0);
        $this->db->where('work_info.state_info_id',6);
        $this->db->where_in('work_info.work_type_id', array(4, 5));
        $this->db->order_by('work_info.work_info_create', 'DESC');
        $this->db->order_by('work_info.work_info_id_pri', 'DESC');
        return $this->db->get();
    }

    public function get_workinfofile($work_info_id_pri = null) {
        $this->db->select('*');
        $this->db->from('work_info_file');
        $this->db->join('ref_file_type', 'ref_file_type.file_type_id = work_info_file.file_type_id');
        $this->db->where('work_info_file.work_info_id_pri', $work_info_id_pri);
        return $this->db->get();
    }

    public function ref_file_type($file_type_name) {
        $this->db->select('*');
        $this->db->from('ref_file_type');
        $this->db->where('ref_file_type.file_type_name', $file_type_name);
        $this->db->limit(1);
        return $this->db->get();
    }

    public function get_workinfofileid($work_info_file_id = null) {
        $this->db->select('*');
        $this->db->from('work_info_file');
        $this->db->where('work_info_file.work_info_file_id', $work_info_file_id);
        return $this->db->get();
    }

    public function insert_workinfofile($data) {
        $this->db->insert('work_info_file', $data);
        return $this->db->insert_id();
    }

    public function delete_workinfofile($work_info_file_id) {
        $this->db->where('work_info_file.work_info_file_id', $work_info_file_id);
        $this->db->delete('work_info_file');
    }

//    public function getworkinfo($work_info_id_pri = null) {
//        $this->db->select('*');
//        $this->db->from('work_info');
//        $this->db->where('work_info.dep_off_id', $this->session->userdata('dep_off_id'));
//        if ($work_info_id_pri != null) {
//            $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
//            $this->db->limit(1);
//        }
//        $this->db->where('work_info.work_type_id', 3);
//        return $this->db->get();
//    }

    public function getworkinfo($work_info_id_pri = null) {
        $this->db->select('work_info.*,ref_state_info.state_info_name,ref_book_group.book_group_name,year.year,user.user_fullname,'
                . 'ref_work_type.work_type_name,ref_priority_info.priority_info_name,ref_secret_level.secret_level_name,'
                . 'department.dep_name, ref_action_info.action_info_name');
        $this->db->from('work_info');
        $this->db->join('department', 'department.dep_id_pri = work_info.dep_id_pri');
        $this->db->join('ref_work_type', 'ref_work_type.work_type_id = work_info.work_type_id');
        $this->db->join('ref_action_info', 'ref_action_info.action_info_id = work_info.action_info_id');
        $this->db->join('ref_priority_info', 'ref_priority_info.priority_info_id = work_info.priority_info_id');
        $this->db->join('ref_secret_level', 'ref_secret_level.secret_level_id = work_info.secret_level_id');
        $this->db->join('ref_state_info', 'ref_state_info.state_info_id = work_info.state_info_id');
        $this->db->join('ref_book_group', 'ref_book_group.book_group_id = work_info.book_group_id');
        $this->db->join('year', 'year.year_id = work_info.year_id');
        $this->db->join('user', 'user.user_id = work_info.user_id');
        //$this->db->where('work_info.dep_off_id', $this->session->userdata('dep_off_id'));
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->where_in('work_info.work_type_id', array(4, 5));
        $this->db->limit(1);
        return $this->db->get();
    }

    public function getworkinfocode($work_info_code = null) {
        $this->db->select('work_info.*,ref_state_info.state_info_name,ref_book_group.book_group_name,year.year,user.user_fullname,'
                . 'ref_work_type.work_type_name,ref_priority_info.priority_info_name,ref_secret_level.secret_level_name,'
                . 'department.dep_name, ref_action_info.action_info_name');
        $this->db->from('work_info');
        $this->db->join('department', 'department.dep_id_pri = work_info.dep_id_pri');
        $this->db->join('ref_work_type', 'ref_work_type.work_type_id = work_info.work_type_id');
        $this->db->join('ref_action_info', 'ref_action_info.action_info_id = work_info.action_info_id');
        $this->db->join('ref_priority_info', 'ref_priority_info.priority_info_id = work_info.priority_info_id');
        $this->db->join('ref_secret_level', 'ref_secret_level.secret_level_id = work_info.secret_level_id');
        $this->db->join('ref_state_info', 'ref_state_info.state_info_id = work_info.state_info_id');
        $this->db->join('ref_book_group', 'ref_book_group.book_group_id = work_info.book_group_id');
        $this->db->join('year', 'year.year_id = work_info.year_id');
        $this->db->join('user', 'user.user_id = work_info.user_id');
        //$this->db->where('work_info.dep_off_id', $this->session->userdata('dep_off_id'));
        $this->db->where('work_info.work_info_code', $work_info_code);
        $this->db->where_in('work_info.work_type_id', array(4, 5));
        $this->db->limit(1);
        return $this->db->get();
    }

    public function ref_action_info($action_info_id = null) {
        $this->db->select('*');
        $this->db->from('ref_action_info');
        if ($action_info_id != null) {
            $this->db->where('ref_action_info.action_info_id', $action_info_id);
            $this->db->limit(1);
        }
        $this->db->order_by('ref_action_info.action_info_sort');
        return $this->db->get();
    }

    public function ref_work_type($work_type_id = null) {
        $this->db->select('*');
        if ($work_type_id != null) {
            $this->db->where('ref_work_type.work_type_id', $work_type_id);
            $this->db->limit(1);
        }
        return $this->db->get('ref_work_type');
    }

    public function ref_book_group($book_group_id = null) {
        $this->db->select('*');
        $this->db->from('ref_book_group');
        if ($book_group_id != null) {
            $this->db->where('ref_book_group.book_group_id', $book_group_id);
            $this->db->limit(1);
        }
        $this->db->order_by('ref_book_group.book_group_sort');
        return $this->db->get();
    }

    public function ref_doc_type($doc_type_id = null) {
        $this->db->select('*');
        $this->db->from('ref_doc_type');
        if ($doc_type_id != null) {
            $this->db->where('ref_doc_type.doc_type_id', $doc_type_id);
            $this->db->limit(1);
        }
        $this->db->order_by('ref_doc_type.doc_type_sort');
        return $this->db->get();
    }

    public function ref_internal_action($internal_action_id = null) {
        $this->db->select('*');
        $this->db->from('ref_internal_action');
        if ($internal_action_id != null) {
            $this->db->where('ref_internal_action.internal_action_id', $internal_action_id);
            $this->db->limit(1);
        }
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

    public function ref_secret_level($secret_level_id = null) {
        $this->db->select('*');
        $this->db->from('ref_secret_level');
        if ($secret_level_id != null) {
            $this->db->where('ref_secret_level.secret_level_id', $secret_level_id);
            $this->db->limit(1);
        }
        $this->db->order_by('ref_secret_level.secret_level_sort');
        return $this->db->get();
    }

    function getuser_dep_off($dep_off_id) {
        $this->db->join('user', 'user_dep_off.user_id = user.user_id');
        $this->db->where('user_dep_off.dep_off_id', $dep_off_id);
        $this->db->where('user_dep_off.user_dep_off_status_id', 1);
        $this->db->where('user.user_status_id', 1);
        $this->db->where('user.user_line_token !=', null);
        return $this->db->get('user_dep_off');
    }

    public function get_year() {
        $this->db->order_by('year.year');
        return $this->db->get('year');
    }

    public function get_ref_state_info() {
        $this->db->where('ref_state_info.state_info_id >=', 4);
        $this->db->where('ref_state_info.state_info_id <=', 9);
        $this->db->order_by('ref_state_info.state_info_id');
        return $this->db->get('ref_state_info');
    }

    public function get_ref_book_group() {
        $this->db->order_by('ref_book_group.book_group_id');
        return $this->db->get('ref_book_group');
    }

    public function getDepartment($dep_id_pri = null) {
        $this->db->select('*');
        $this->db->from('department');
        if ($dep_id_pri != null) {
            $this->db->where('department.dep_id_pri', $dep_id_pri);
        }
        return $this->db->get();
    }

    public function ref_position($position_id = null) {
        $this->db->select('*');
        $this->db->from('ref_position');
        if ($position_id != null) {
            $this->db->where('ref_position.position_id', $position_id);
            $this->db->limit(1);
        }
        $this->db->order_by('ref_position.position_id');
        return $this->db->get();
    }

    public function update_workinfo($work_info_id_pri, $data) {
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->update('work_info', $data);
    }

    public function getDepartmentyear($dep_id_pri) {
        $this->db->select('*');
        $this->db->from('department_year');
        $this->db->where('department_year.dep_id_pri', $dep_id_pri);
        $this->db->where('department_year.year_id', $this->session->userdata('year_id'));
        $this->db->limit(1);
        return $this->db->get();
    }

    public function update_departmentyear($data) {
        $this->db->where('dep_id_pri', $this->session->userdata('dep_id_pri'));
        $this->db->where('year_id', $this->session->userdata('year_id'));
        $this->db->update('department_year', $data);
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

    function getdep_off_id($dep_off_id) {
        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        $this->db->join('officer', 'dep_off.officer_id = officer.officer_id');
        if ($dep_off_id != null) {
            $this->db->where('dep_off.dep_off_id', $dep_off_id);
        }
        $this->db->limit(1);
        return $this->db->get('dep_off')->row();
    }

    public function get_lognews($work_info_id_pri) {
        $this->db->select('*');
        $this->db->from('log_news');
        $this->db->where('log_news.user_id', $this->session->userdata('user_id'));
        $this->db->where('log_news.work_info_id_pri', $work_info_id_pri);
        $this->db->limit(1);
        return $this->db->get();
    }

}
