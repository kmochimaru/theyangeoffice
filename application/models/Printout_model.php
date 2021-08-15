<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Printout_model
 *
 * @author nut
 */
class Printout_model extends CI_Model {

    //put your code here
    public function getworkinfo($work_info_id_pri = null) {
        $this->db->select('*');
        $this->db->from('work_info');
        if ($work_info_id_pri != null) {
            $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
            $this->db->limit(1);
        }
        return $this->db->get();
    }

    public function getworkinfocode($work_info_code = null) {
        $this->db->select('*');
        $this->db->from('work_info');
        if ($work_info_code != null) {
            $this->db->where('work_info.work_info_code', $work_info_code);
            $this->db->limit(1);
        }
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

    public function get_department($dep_id_pri = null) {
        $this->db->select('*');
        $this->db->from('department');
        if ($dep_id_pri != null) {
            $this->db->where('department.dep_id_pri', $dep_id_pri);
        }
        return $this->db->get();
    }

    public function get_uesr($user_id = null) {
        $this->db->select('*');
        $this->db->from('user');
        if ($user_id != null) {
            $this->db->where('user.user_id', $user_id);
            $this->db->limit(1);
        }
        return $this->db->get();
    }

    public function get_depoff($dep_id_pri = null, $officer_id = null) {
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

    public function ref_state_info($state_info_id = null) {
        $this->db->select('*');
        $this->db->from('ref_state_info');
        if ($state_info_id != null) {
            $this->db->where('ref_state_info.state_info_id', $state_info_id);
            $this->db->limit(1);
        }
        return $this->db->get();
    }

    public function ref_special_command($special_command_id = null) {
        $this->db->select('*');
        $this->db->from('ref_special_command');
        if ($special_command_id != null) {
            $this->db->where('ref_special_command.special_command_id', $special_command_id);
            $this->db->limit(1);
        }
        return $this->db->get();
    }

    public function getworkprocess($work_info_id_pri = null) {
        $this->db->select('work_process.work_process_id_pri,
                    work_process.work_info_id_pri,
                    work_process.work_process_id,
                    work_process.work_process_no,
                    work_process.work_process_no_2,
                    work_process.work_process_no_3,
                    work_process.year_id,
                    work_process.dep_id_pri,
                    work_process.dep_off_id,
                    work_process.user_id,
                    work_process.work_process_id_to,
                    work_process.work_process_date,
                    work_process.special_command_id,
                    work_process.work_process_receive_id,
                    work_process.work_process_receive_date,
                    work_process.work_process_receive,
                    work_process.work_process_receive_user_id,
                    work_process.work_process_receive_name,
                    work_process.work_process_receive_comment,
                    work_process.work_process_sendtype,
                    work_process.work_process_sendstatus,
                    work_process.work_process_receive_signature,
                    work_process.work_process_receive_signature_name,
                    work_process.work_process_receive_signature_date,
                    work_process.work_process_receive_signature_key,
                    work_process.work_process_receive_commentback,
                    work_process.work_process_act_for_flag,
                    work_process.work_process_act_for_position,
                    work_process.work_process_status_id,
                    work_process.work_process_sort,
                    work_process.work_process_create,
                    work_process.work_process_update');
        $this->db->from('work_info');
        $this->db->join('work_process', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        if ($work_info_id_pri != null) {
            $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        }
        $this->db->where('work_process.work_process_active_id', 1);
        $this->db->order_by('work_process.work_process_sort');
        $this->db->order_by('work_process.work_process_create', 'ASC');
        return $this->db->get();
    }

    public function work_user_work_process($work_process_id_pri = null) {
        $this->db->select('*');
        $this->db->from('work_user');
        if ($work_process_id_pri != null) {
            $this->db->where('work_user.work_process_id_pri', $work_process_id_pri);
        }
        $this->db->where('work_user.work_user_status_id !=', 1);
        $this->db->where('work_user.work_user_signature_name IS NOT NULL');
        return $this->db->get();
    }

    public function getdepartment($dep_id_pri) {
        $this->db->select('*');
        $this->db->from('department');
        $this->db->where('department.dep_id_pri', $dep_id_pri);
        $this->db->limit(1);
        return $this->db->get();
    }

    public function getdepoff($dep_off_id) {
        $this->db->select('*');
        $this->db->from('dep_off');
        $this->db->join('officer', 'dep_off.officer_id = officer.officer_id');
        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        $this->db->where('dep_off.dep_off_id', $dep_off_id);
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
}
