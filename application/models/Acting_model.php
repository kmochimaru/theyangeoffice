<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Acting_model
 *
 * @author nut
 */
class Acting_model extends CI_Model {

    //put your code here
    public function getDepartment($dep_id_pri = null) {
        $this->db->select('*');
        $this->db->from('department');
        if ($dep_id_pri != null) {
            $this->db->where('department.dep_id_pri', $dep_id_pri);
        }
        return $this->db->get();
    }

    public function getDepartmentyear($dep_id_pri) {
        $this->db->select('*');
        $this->db->from('department_year');
        $this->db->where('department_year.dep_id_pri', $dep_id_pri);
        $this->db->where('department_year.year_id', $this->session->userdata('year_id'));
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function checkDepartmentyear($dep_id_pri) {
        $this->db->select('*');
        $this->db->from('department_year');
        $this->db->where('department_year.dep_id_pri', $dep_id_pri);
        $this->db->where('department_year.year_id', $this->session->userdata('year_id'));
        //$this->db->limit(1);
        return $this->db->get();
    }

    public function getOrganization() {
        $this->db->select('*');
        $this->db->from('organization');
        $this->db->where('organization.org_id_pri', 1);
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

    public function ref_special_command($special_command_id = null) {
        $this->db->select('*');
        $this->db->from('ref_special_command');
        if ($special_command_id != null) {
            $this->db->where('ref_special_command.special_command_id', $special_command_id);
            $this->db->limit(1);
        }
        $this->db->order_by('ref_special_command.special_command_sort');
        return $this->db->get();
    }

    public function getworkinfo($work_info_id_pri = null) {
        $this->db->select('*');
        $this->db->from('work_info');
        if ($work_info_id_pri != null) {
            $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
            $this->db->limit(1);
        }
        return $this->db->get();
    }

    public function insert_workinfo($data) {
        $this->db->insert('work_info', $data);
        return $this->db->insert_id();
    }

    public function update_workinfo($work_info_id_pri, $data) {
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->update('work_info', $data);
    }

    public function update_departmentyear($data) {
        $this->db->where('dep_id_pri', $this->session->userdata('dep_id_pri'));
        $this->db->where('year_id', $this->session->userdata('year_id'));
        $this->db->update('department_year', $data);
    }

    public function get_workinfofile($work_info_id_pri = null) {
        $this->db->select('*');
        $this->db->from('work_info_file');
        $this->db->join('ref_file_type', 'ref_file_type.file_type_id = work_info_file.file_type_id');
        $this->db->where('work_info_file.work_info_id_pri', $work_info_id_pri);
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

    public function ref_file_type($file_type_name) {
        $this->db->select('*');
        $this->db->from('ref_file_type');
        $this->db->where('ref_file_type.file_type_name', $file_type_name);
        $this->db->limit(1);
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

}
