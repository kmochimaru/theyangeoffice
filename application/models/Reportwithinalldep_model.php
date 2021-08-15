<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportwithindep_model
 *
 * @author nut
 */
class Reportwithinalldep_model extends CI_Model {

    //put your code here
    public function count_pagination($filter) {
        $this->db->select('work_info.work_info_id_pri');
        $this->db->from('work_info');
        $this->db->join('ref_work_type', 'work_info.work_type_id = ref_work_type.work_type_id');
        $this->db->join('ref_state_info', 'ref_state_info.state_info_id = work_info.state_info_id');
        $this->db->join('ref_book_group', 'ref_book_group.book_group_id = work_info.book_group_id');
        $this->db->join('year', 'year.year_id = work_info.year_id');
        $this->db->join('user', 'user.user_id = work_info.user_id');
        $this->db->where('work_info.dep_id_pri', $this->session->userdata('dep_id_pri'));
        if ($filter['year_id'] != '') {
            $this->db->where("work_info.year_id", $filter['year_id']);
        }
        if ($filter['work_type_id'] != '') {
            $this->db->where("work_info.work_type_id", $filter['work_type_id']);
        }
        if ($filter['state_info_id'] != '') {
            $this->db->where("work_info.state_info_id", $filter['state_info_id']);
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
        if ($filter['date_start'] != '') {
            $this->db->where("work_info.work_info_date >=", $filter['date_start']);
        }
        if ($filter['date_end'] != '') {
            $this->db->where("work_info.work_info_date <=", $filter['date_end']);
        }
        //$this->db->where('work_info.state_info_id >=', 4);
        // $this->db->where('work_info.work_type_id', 2);
        return $this->db->get()->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('work_info.*,ref_state_info.state_info_name,ref_book_group.book_group_name,year.year,user.user_fullname,ref_work_type.work_type_name');
        $this->db->from('work_info');
        $this->db->join('ref_work_type', 'work_info.work_type_id = ref_work_type.work_type_id');
        $this->db->join('ref_state_info', 'ref_state_info.state_info_id = work_info.state_info_id');
        $this->db->join('ref_book_group', 'ref_book_group.book_group_id = work_info.book_group_id');
        $this->db->join('year', 'year.year_id = work_info.year_id');
        $this->db->join('user', 'user.user_id = work_info.user_id');

        $this->db->where('work_info.dep_id_pri', $this->session->userdata('dep_id_pri'));

        if ($filter['year_id'] != '') {
            $this->db->where("work_info.year_id", $filter['year_id']);
        }
        if ($filter['work_type_id'] != '') {
            $this->db->where("work_info.work_type_id", $filter['work_type_id']);
        }
        if ($filter['state_info_id'] != '') {
            $this->db->where("work_info.state_info_id", $filter['state_info_id']);
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
        if ($filter['date_start'] != '') {
            $this->db->where("work_info.work_info_date >=", $filter['date_start']);
        }
        if ($filter['date_end'] != '') {
            $this->db->where("work_info.work_info_date <=", $filter['date_end']);
        }

        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        // $this->db->where('work_info.state_info_id >=', 3);
        // $this->db->where('work_info.work_type_id', 2);
        $this->db->order_by('work_info.work_info_id', 'ASC');
        return $this->db->get();
    }

    public function get_ref_work_type() {
        $this->db->where('ref_work_type.work_type_id !=', 6);
        $this->db->where('ref_work_type.work_type_id !=', 1);
        $this->db->order_by('ref_work_type.work_type_id');
        return $this->db->get('ref_work_type');
    }

    public function get_ref_state_info() {
        $this->db->where('ref_state_info.state_info_id >=', 2);
        $this->db->where('ref_state_info.state_info_id <=', 9);
        $this->db->order_by('ref_state_info.state_info_id');
        return $this->db->get('ref_state_info');
    }

    public function get_ref_book_group() {
        $this->db->order_by('ref_book_group.book_group_id');
        return $this->db->get('ref_book_group');
    }

    public function get_workinfofile($work_info_id_pri = null) {
        $this->db->select('*');
        $this->db->from('work_info_file');
        $this->db->join('ref_file_type', 'ref_file_type.file_type_id = work_info_file.file_type_id');
        $this->db->where('work_info_file.work_info_id_pri', $work_info_id_pri);
        return $this->db->get();
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


    public function get_dataexcel($filter) {
        $this->db->select('work_info.*,ref_state_info.state_info_name,ref_book_group.book_group_name,year.year,user.user_fullname,ref_work_type.work_type_name');
        $this->db->from('work_info');
        $this->db->join('ref_work_type', 'work_info.work_type_id = ref_work_type.work_type_id');
        $this->db->join('ref_state_info', 'ref_state_info.state_info_id = work_info.state_info_id');
        $this->db->join('ref_book_group', 'ref_book_group.book_group_id = work_info.book_group_id');
        $this->db->join('year', 'year.year_id = work_info.year_id');
        $this->db->join('user', 'user.user_id = work_info.user_id');
        $this->db->where('work_info.dep_id_pri', $this->session->userdata('dep_id_pri'));
        if ($filter['year_id'] != 'null') {
            $this->db->where("work_info.year_id", $filter['year_id']);
        }
        if ($filter['work_type_id'] != 'null') {
            $this->db->where("work_info.work_type_id", $filter['work_type_id']);
        }
        if ($filter['state_info_id'] != 'null') {
            $this->db->where("work_info.state_info_id", $filter['state_info_id']);
        }
        if ($filter['book_group_id'] != 'null') {
            $this->db->where("work_info.book_group_id", $filter['book_group_id']);
        }
        if ($filter['searchtext'] != 'null') {
            $this->db->where(" (
              CONCAT(work_info.work_info_no,work_info.work_info_no_3) LIKE '%" . $filter['searchtext'] . "%' OR
              work_info.work_info_subject LIKE '%" . $filter['searchtext'] . "%' OR 
              work_info.work_info_id LIKE '%" . $filter['searchtext'] . "%' OR 
              work_info.work_info_no LIKE '%" . $filter['searchtext'] . "%'
          ) ");
        }
        if ($filter['date_start'] != 'null') {
            $this->db->where("work_info.work_info_date >=", $filter['date_start']);
        }
        if ($filter['date_end'] != 'null') {
            $this->db->where("work_info.work_info_date <=", $filter['date_end']);
        }

        // if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
        //     $this->db->limit($params['limit'], $params['start']);
        // } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
        //     $this->db->limit($params['limit']);
        // }
        // $this->db->where('work_info.state_info_id >=', 3);
        // $this->db->where('work_info.work_type_id', 2);
        $this->db->order_by('work_info.work_info_id', 'ASC');
        return $this->db->get();
    }
}
