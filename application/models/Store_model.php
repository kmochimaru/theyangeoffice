<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Store_model
 *
 * @author nut
 */
class Store_model extends CI_Model {

    //put your code here
    public function get_work_info_signature($id = null) {
        $this->db->select('work_info.work_info_signature');
        $this->db->from('work_info');
        if ($id != null) {
            $this->db->where('work_info.work_info_id_pri', $id);
        }
        return $this->db->get()->row();
    }

    public function get_work_info_file($work_info_file_id = null) {
        $this->db->select('work_info.work_info_id_pri,work_info_file.work_info_file_id,work_info_file.work_info_file_path,work_info_file.work_info_file_path,work_info_file.work_info_file_name,work_info_file.work_info_file_oldname');
        $this->db->from('work_info');
        $this->db->join('work_info_file', 'work_info_file.work_info_id_pri = work_info.work_info_id_pri');
        if ($work_info_file_id != null) {
            $this->db->where('work_info_file.work_info_file_id', $work_info_file_id);
        }
        return $this->db->get()->row();
    }

    public function get_work_process_file($work_process_file_id = null) {
        $this->db->select('work_info.work_info_id_pri,work_process_file.work_process_file_id,work_process_file.work_process_file_path,work_process_file.work_process_file_name,work_process_file.work_process_file_oldname');
        $this->db->from('work_process_file');
        $this->db->join('work_process', 'work_process_file.work_process_id_pri = work_process.work_process_id_pri');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        if ($work_process_file_id != null) {
            $this->db->where('work_process_file.work_process_file_id', $work_process_file_id);
        }
        return $this->db->get()->row();
    }

    public function get_work_user_file($work_user_file_id = null) {
        $this->db->select('work_info.work_info_id_pri,work_user_file.work_user_file_id,work_user_file.work_user_file_path,work_user_file.work_user_file_name,work_user_file.work_user_file_oldname');
        $this->db->from('work_user_file');
        $this->db->join('work_user', 'work_user_file.work_user_id = work_user.work_user_id');
        $this->db->join('work_process', 'work_user.work_process_id_pri = work_process.work_process_id_pri');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        if ($work_user_file_id != null) {
            $this->db->where('work_user_file.work_user_file_id', $work_user_file_id);
        }
        return $this->db->get()->row();
    }

    public function check_work_info($work_info_id_pri) {
        $this->db->select('work_info.work_info_id_pri');
        $this->db->from('work_info');
        $this->db->join('dep_off', 'work_info.dep_off_id = dep_off.dep_off_id');
        $this->db->join('user_dep_off', 'user_dep_off.dep_off_id = dep_off.dep_off_id');
        $this->db->join('user', 'user_dep_off.user_id = user.user_id');
        $this->db->where('user_dep_off.user_dep_off_status_id', 1);
        $this->db->where('dep_off.dep_off_status_id', 1);
        $this->db->where('user.user_status_id', 1);
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->where_in('user_dep_off.user_dep_off_id', $this->session->userdata('user_dep_off_id'));
        return $this->db->get()->num_rows();
    }

    public function check_work_process($work_info_id_pri) {
        $this->db->select('work_info.work_info_id_pri');
        $this->db->from('work_info');
        $this->db->join('work_process', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->join('dep_off', 'work_process.dep_off_id = dep_off.dep_off_id');
        $this->db->join('user_dep_off', 'user_dep_off.dep_off_id = dep_off.dep_off_id');
        $this->db->join('user', 'user_dep_off.user_id = user.user_id');
        $this->db->where('user_dep_off.user_dep_off_status_id', 1);
        $this->db->where('dep_off.dep_off_status_id', 1);
        $this->db->where('user.user_status_id', 1);
        //$this->db->where('work_process.work_process_sendstatus', 1);
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->where_in('user_dep_off.user_dep_off_id', $this->session->userdata('user_dep_off_id'));
        return $this->db->get()->num_rows();
    }

    public function check_work_process_sendtype1($work_info_id_pri) {
        $this->db->select('work_info.work_info_id_pri');
        $this->db->from('work_info');
        $this->db->join('work_process', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->join('dep_off', 'work_process.dep_off_id = dep_off.dep_off_id');
        $this->db->join('user_dep_off', 'user_dep_off.dep_off_id = dep_off.dep_off_id');
        $this->db->join('user', 'user_dep_off.user_id = user.user_id');
        $this->db->where('user_dep_off.user_dep_off_status_id', 1);
        $this->db->where('dep_off.dep_off_status_id', 1);
        $this->db->where('user.user_status_id', 1);
        $this->db->where('work_process.work_process_sendstatus', 1);
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->where_in('user_dep_off.user_dep_off_id', $this->session->userdata('user_dep_off_id'));
        return $this->db->get()->num_rows();
    }

    public function check_work_process_sendtype2($work_info_id_pri) {
        $this->db->select('work_info.work_info_id_pri');
        $this->db->from('work_info');
        $this->db->join('work_process', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->join('dep_off', 'work_process.dep_off_id = dep_off.dep_off_id');
        $this->db->join('user_dep_off', 'user_dep_off.dep_off_id = dep_off.dep_off_id');
        $this->db->join('user', 'user_dep_off.user_id = user.user_id');
        $this->db->where('user_dep_off.user_dep_off_status_id', 1);
        $this->db->where('dep_off.dep_off_status_id', 1);
        $this->db->where('user.user_status_id', 1);
        $this->db->where('work_process.work_process_sendtype', 2);
        $this->db->where('work_process.work_process_receive', 1);
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->where_in('user_dep_off.user_dep_off_id', $this->session->userdata('user_dep_off_id'));
        return $this->db->get()->num_rows();
    }

    public function check_work_user($work_info_id_pri) {
        $this->db->select('work_info.work_info_id_pri');
        $this->db->from('work_info');
        $this->db->join('work_process', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->join('work_user', 'work_user.work_process_id_pri = work_process.work_process_id_pri');
        $this->db->join('user', 'work_user.user_id = user.user_id');
        $this->db->where('user.user_status_id', 1);
        //$this->db->where('work_user.work_user_status_id', 1);
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->where('user.user_id', $this->session->userdata('user_id'));
        return $this->db->get()->num_rows();
    }

}
