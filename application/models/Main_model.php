<?php

/*
 * Class Name : Main_model
 * Author : Sakchai Kantada
 * Email : sakchaiwebmaster@gmail.com
 */

class Main_model extends CI_Model {

    public function countWordUser() {
        $this->db->select('work_user.work_user_id');
        $this->db->from('work_user');
        $this->db->where('work_user.user_id', $this->session->userdata('user_id'));
        $this->db->where('work_user.year_id', $this->session->userdata('year_id'));
        $this->db->where('work_user.work_user_status_id', 1);
        return $this->db->get()->num_rows();
    }

    public function countProcess() {
        $this->db->select('work_info.work_info_id_pri');
        $this->db->from('work_info');
        $this->db->where('work_info.dep_off_id', $this->session->userdata('dep_off_id'));
        $this->db->where('work_info.year_id', $this->session->userdata('year_id'));
        $this->db->where('work_info.work_info_retrospect', 0);
//        $this->db->where_in('work_info.state_info_id', array(4, 8));
        $this->db->where('work_info.work_type_id', 2);
        $this->db->where('work_info.state_info_id <=', 3);
        $this->db->group_by('work_info.work_info_id_pri');
        return $this->db->get()->num_rows();
    }

    public function countFollowme() {
        $this->db->select('work_info.work_info_id_pri');
        $this->db->from('work_info');
        $this->db->where('work_info.dep_off_id', $this->session->userdata('dep_off_id'));
        $this->db->where("work_info.year_id", $this->session->userdata('year_id'));
        $this->db->where('work_info.work_info_retrospect', 0);
        $this->db->where('work_info.work_info_follow', 1);
        return $this->db->get()->num_rows();
    }

    //- ------

    public function getWorkInfoSend() {
        $this->db->select('work_info.*,ref_state_info.state_info_name,ref_book_group.book_group_name,year.year,user.user_fullname');
        $this->db->from('work_info');
        $this->db->join('ref_state_info', 'ref_state_info.state_info_id = work_info.state_info_id');
        $this->db->join('ref_book_group', 'ref_book_group.book_group_id = work_info.book_group_id');
        $this->db->join('year', 'year.year_id = work_info.year_id');
        $this->db->join('user', 'user.user_id = work_info.user_id');
        $this->db->where('work_info.dep_off_id', $this->session->userdata('dep_off_id'));
        $this->db->where("work_info.year_id", $this->session->userdata('year_id'));
        $this->db->where('work_info.work_type_id', 2);
        $this->db->where('work_info.work_info_retrospect', 0);
        $this->db->order_by('work_info.work_info_create', 'DESC');
        $this->db->limit(10);
        return $this->db->get();
    }

    public function countWorkInfoReceive() {
        $this->db->select('MAX(work_process.work_process_id_pri) AS work_process_id_pri');
        $this->db->from('work_process');
        $this->db->join('work_info', 'work_info.work_info_id_pri = work_process.work_info_id_pri');
        $this->db->join('ref_state_info', 'ref_state_info.state_info_id = work_info.state_info_id');
        $this->db->join('dep_off', 'dep_off.dep_off_id = work_process.dep_off_id');
        $this->db->join('department', 'department.dep_id_pri = dep_off.dep_id_pri');
        $this->db->join('ref_priority_info', 'work_info.priority_info_id = ref_priority_info.priority_info_id');
        $this->db->join('ref_book_group', 'work_info.book_group_id = ref_book_group.book_group_id');
        $this->db->join('year', 'work_process.year_id = year.year_id');
        $this->db->join('user', 'work_info.user_id = user.user_id');
        $this->db->where('work_process.dep_off_id', $this->session->userdata('dep_off_id'));
        $this->db->where("work_info.year_id", $this->session->userdata('year_id'));
        $this->db->where_in('work_info.state_info_id', array(4, 5, 6, 8));
        $this->db->where('work_info.work_info_retrospect', 0);
        $this->db->where('work_process.work_process_status_id !=', 3);
        $this->db->where('work_process.work_process_sendstatus !=', 2);
        $this->db->where('work_process.work_process_active_id', 1);
        $this->db->where('work_process.work_process_receive !=', 1);
        $this->db->group_by('work_info.work_info_id_pri');
        return $this->db->get()->num_rows();
    }

    public function getWorkInfoReceive() {
        $this->db->select('MAX(work_process.work_process_id_pri) AS work_process_id_pri');
        $this->db->from('work_process');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->join('ref_state_info', 'work_info.state_info_id = ref_state_info.state_info_id');
        $this->db->join('dep_off', 'work_process.dep_off_id = dep_off.dep_off_id');
        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        $this->db->join('ref_priority_info', 'work_info.priority_info_id = ref_priority_info.priority_info_id');
        $this->db->join('ref_book_group', 'work_info.book_group_id = ref_book_group.book_group_id');
        $this->db->join('year', 'work_process.year_id = year.year_id');
        $this->db->join('user', 'work_info.user_id = user.user_id');
        $this->db->where('work_process.dep_off_id', $this->session->userdata('dep_off_id'));
        $this->db->where("work_info.year_id", $this->session->userdata('year_id'));
        $this->db->where_in('work_info.state_info_id', array(4, 5, 6, 8));
        $this->db->limit(10);
        $this->db->where('work_info.work_info_retrospect', 0);
        $this->db->where('work_process.work_process_status_id !=', 3);
        $this->db->where('work_process.work_process_sendstatus !=', 2);
        $this->db->where('work_process.work_process_active_id', 1);
        $this->db->order_by('work_process.work_process_id_pri', 'DESC');
        $this->db->group_by('work_info.work_info_id_pri');
        return $this->db->get();
    }

    public function getWorkInfoData($work_process_id_pri) {
        $this->db->select('work_process.work_process_id_pri,
                work_process.work_info_id_pri,
                work_process.work_process_id,
                work_process.work_process_no,
                work_process.work_process_no_2,
                work_process.work_process_no_3,
                work_process.year_id,
                work_process.user_id,
                work_process.dep_off_id,
                work_process.work_process_date,
                work_process.work_process_receive,
                work_process.work_process_receive_id,
                work_process.work_process_receive_date,
                work_process.work_process_receive_name,
                work_process.work_process_sendstatus,
                work_process.work_process_sendtype,
                work_process.work_process_sort,
                work_process.work_process_status_id,
                work_process.work_process_create,
                work_process.work_process_update,
                work_process.special_command_id,
                work_info.dep_id_pri AS work_info_dep_id_pri,
                work_info.dep_off_id AS work_info_dep_off_id,
                work_info.work_info_subject,
                work_info.work_info_code,
                work_info.attach_original,
                work_info.work_info_date,
                work_info.work_info_from_position,
                work_info.work_info_from,
                work_info.work_info_to_position,
                work_info.work_info_to,
                work_info.state_info_id,
                user.user_fullname,
                ref_priority_info.priority_info_name,
                ref_book_group.book_group_name,
                dep_off.dep_id_pri,
                year.year
                ');
        $this->db->from('work_process');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->join('ref_state_info', 'work_info.state_info_id = ref_state_info.state_info_id');
        $this->db->join('dep_off', 'work_process.dep_off_id = dep_off.dep_off_id');
        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        $this->db->join('ref_priority_info', 'work_info.priority_info_id = ref_priority_info.priority_info_id');
        $this->db->join('ref_book_group', 'work_info.book_group_id = ref_book_group.book_group_id');
        $this->db->join('year', 'work_process.year_id = year.year_id');
        $this->db->join('user', 'work_info.user_id = user.user_id');
        $this->db->where('work_process.work_process_id_pri', $work_process_id_pri);
        $this->db->where('work_process.dep_off_id', $this->session->userdata('dep_off_id'));
        $this->db->where('work_info.work_info_retrospect', 0);
        $this->db->where('work_process.work_process_status_id !=', 3);
        $this->db->where('work_process.work_process_sendstatus !=', 2);
        $this->db->where('work_process.work_process_active_id', 1);
        return $this->db->get();
    }

    public function getReceiveWork() {
        $this->db->select('*');
        $this->db->from('work_user');
        $this->db->join('work_info', 'work_info.work_info_id_pri = work_user.work_info_id_pri');
        $this->db->join('ref_state_info', 'ref_state_info.state_info_id = work_info.state_info_id');
        $this->db->join('user', 'user.user_id = work_user.user_id');
        $this->db->join('user_dep_off', 'user_dep_off.user_id = `user`.user_id');
        $this->db->join('dep_off', 'dep_off.dep_off_id = user_dep_off.dep_off_id');
        $this->db->join('department', 'department.dep_id_pri = dep_off.dep_id_pri');
        $this->db->join('ref_priority_info', 'work_info.priority_info_id = ref_priority_info.priority_info_id');
        $this->db->join('ref_book_group', 'work_info.book_group_id = ref_book_group.book_group_id');
        $this->db->join('year', 'year.year_id = work_info.year_id');
        $this->db->where('dep_off.dep_off_id', $this->session->userdata('dep_off_id'));
        $this->db->where('user.user_id', $this->session->userdata('user_id'));
        $this->db->where('work_info.state_info_id >=', 4);
        $this->db->where('work_info.work_info_retrospect', 0);
        $this->db->limit(10);
        $this->db->order_by('work_user.work_user_create', 'DESC');
        return $this->db->get();
    }

    public function checkwithinprocess($work_info_id_pri, $work_process_sort, $sendstatus) {
        $this->db->from('work_process');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->join('ref_state_info', 'work_info.state_info_id = ref_state_info.state_info_id');
        $this->db->join('dep_off', 'work_process.dep_off_id = dep_off.dep_off_id');
        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        $this->db->where('work_process.year_id', $this->session->userdata('year_id'));
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->where('work_process.work_process_sort', $work_process_sort);
        $this->db->where('work_process.work_process_receive', 1);
        $this->db->where('work_process.work_process_sendstatus', $sendstatus);
        $this->db->order_by('work_process.work_process_create', 'DESC');
        return $this->db->get();
    }

    public function getdepartment($dep_id_pri) {
        $this->db->select('*');
        $this->db->from('department');
        $this->db->where('department.dep_id_pri', $dep_id_pri);
        $this->db->limit(1);
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

    public function getworkprocess($work_process_id_pri = null) {
        $this->db->select('*');
        $this->db->from('work_process');
        if ($work_process_id_pri != null) {
            $this->db->where('work_process.work_process_id_pri', $work_process_id_pri);
            $this->db->limit(1);
        }
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

    public function getNews() {
        $this->db->select('work_info.*,ref_state_info.state_info_name,ref_book_group.book_group_name,year.year,user.user_fullname,ref_priority_info.priority_info_name');
        $this->db->from('work_info');
        $this->db->join('ref_state_info', 'ref_state_info.state_info_id = work_info.state_info_id');
        $this->db->join('ref_priority_info', 'ref_priority_info.priority_info_id = work_info.priority_info_id');
        $this->db->join('ref_book_group', 'ref_book_group.book_group_id = work_info.book_group_id');
        $this->db->join('year', 'year.year_id = work_info.year_id');
        $this->db->join('user', 'user.user_id = work_info.user_id');
        $this->db->join('log_news', 'log_news.user_id = `user`.user_id AND log_news.work_info_id_pri = work_info.work_info_id_pri', 'LEFT');
        $this->db->where_in('work_info.state_info_id', array(5, 6));
        $this->db->where_in('work_info.work_type_id', array(4, 5));
        $this->db->order_by('work_info.work_info_create', 'DESC');
        $this->db->order_by('work_info.work_info_id_pri', 'DESC');
        return $this->db->get();
    }

    public function get_lognews($work_info_id_pri) {
        $this->db->select('*');
        $this->db->from('log_news');
        $this->db->where('log_news.user_id', $this->session->userdata('user_id'));
        $this->db->where('log_news.work_info_id_pri', $work_info_id_pri);
        $this->db->limit(1);
        return $this->db->get();
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

    public function getWithinbounce($params = array()) {
        $this->db->select('work_process.work_process_id_pri,
                work_process.work_info_id_pri,
                work_process.work_process_id,
                work_process.work_process_no,
                work_process.work_process_no_2,
                work_process.work_process_no_3,
                work_process.year_id,
                work_process.user_id,
                dep_off.dep_id_pri,
                work_process.work_process_date,
                work_process.work_process_receive,
                work_process.work_process_receive_id,
                work_process.work_process_receive_date,
                work_process.work_process_receive_name,
                work_process.work_process_sendstatus,
                work_process.work_process_sendtype,
                work_process.work_process_sort,
                work_process.work_process_status_id,
                work_process.work_process_receive_commentback,
                work_process.work_process_create,
                work_process.work_process_update,
                work_info.*,
                ref_priority_info.priority_info_name,ref_state_info.state_info_name,ref_book_group.book_group_name,year.year');
        $this->db->from('work_process');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->join('dep_off', 'work_process.dep_off_id = dep_off.dep_off_id');
        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        $this->db->join('ref_priority_info', 'work_info.priority_info_id = ref_priority_info.priority_info_id');
        $this->db->join('ref_state_info', 'ref_state_info.state_info_id = work_info.state_info_id');
        $this->db->join('ref_book_group', 'ref_book_group.book_group_id = work_info.book_group_id');
        $this->db->join('year', 'year.year_id = work_info.year_id');
        $this->db->where('dep_off.dep_id_pri', $this->session->userdata('dep_id_pri'));
        $this->db->where('dep_off.dep_off_id', $this->session->userdata('dep_off_id'));
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->where_in('work_info.state_info_id', array(4, 5, 8));
        $this->db->where('work_process.work_process_status_id', 3);
        $this->db->where('work_process.work_process_sendstatus !=', 2);
        $this->db->where('work_info.work_type_id', 2);
        $this->db->where('work_process.work_process_active_id', 1);
        $this->db->order_by('work_process.work_process_create', 'DESC');
        return $this->db->get();
    }

    public function getWithinbounceComment($work_info_id_pri) {
        $this->db->select('work_process.work_process_id_pri,
                work_process.work_info_id_pri,
                work_process.work_process_id,
                work_process.work_process_no,
                work_process.work_process_no_2,
                work_process.work_process_no_3,
                work_process.year_id,
                work_process.user_id,
                work_process.work_process_date,
                work_process.work_process_receive,
                work_process.work_process_receive_id,
                work_process.work_process_receive_date,
                work_process.work_process_receive_name,
                work_process.work_process_sendstatus,
                work_process.work_process_sendtype,
                work_process.work_process_sort,
                work_process.work_process_status_id,
                work_process.work_process_receive_commentback'
        );
        $this->db->from('work_process');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->join('year', 'year.year_id = work_info.year_id');
        $this->db->where('work_process.work_info_id_pri', $work_info_id_pri);
        $this->db->where_in('work_info.state_info_id', array(4, 5, 8));
        $this->db->where('work_process.work_process_status_id', 2);
        $this->db->where('work_process.work_process_sendstatus !=', 2);
        $this->db->where('work_info.work_type_id', 2);
        $this->db->where('work_process.work_process_active_id', 1);
        $this->db->limit(1);
        $this->db->order_by('work_process.work_process_create', 'DESC');
        return $this->db->get();
    }

}
