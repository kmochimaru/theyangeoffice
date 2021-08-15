<?php

/**
 * Description of Reportreceivelistdep_model
 * @author nut
 */
class Reportreceivelistdep_model extends CI_Model {

    public function count_pagination($filter) {
        $this->db->select('MIN(work_process.work_process_id_pri) AS work_process_id_pri');
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
        $this->db->where_in('work_info.work_type_id', array(1, 2, 6));
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                CONCAT(work_info.work_info_no,work_info.work_info_no_3) LIKE '%" . $filter['searchtext'] . "%' OR
                work_info.work_info_subject LIKE '%" . $filter['searchtext'] . "%' OR 
                work_info.work_info_no LIKE '%" . $filter['searchtext'] . "%' OR 
                work_info.work_info_no_2 LIKE '%" . $filter['searchtext'] . "%' OR 
                work_info.work_info_no_3 LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        if ($filter['year_id'] != '') {
            $this->db->where("work_info.year_id", $filter['year_id']);
        }
        if ($filter['status_id'] != '') {
            if ($filter['status_id'] == 0) {
                $this->db->where('work_process.work_process_receive !=', 1);
                $this->db->where_in('work_info.state_info_id', array(4, 5, 6, 8));
            } else if ($filter['status_id'] == 1) {
                $this->db->where('work_process.work_process_receive', 1);
                $this->db->where_in('work_info.state_info_id', array(4, 5, 6, 8));
            } else if ($filter['status_id'] == 2) {
                $this->db->where_in('work_info.state_info_id', array(6));
            }
        } else {
            $this->db->where_in('work_info.state_info_id', array(4, 5, 6, 8));
        }
        if ($filter['book_group_id'] != '') {
            $this->db->where("work_info.book_group_id", $filter['book_group_id']);
        }
        $this->db->where('work_process.work_process_status_id !=', 3);
        $this->db->where('work_process.work_process_sendstatus !=', 2);
        // $this->db->where('((work_process.work_process_receive = 0 AND work_process.work_process_receive_id IS NULL) 
        //             OR (work_process.work_process_receive != 0 AND work_process.work_process_receive_id IS NOT NULL))');
        if ($filter['date_start'] != '') {
            $this->db->where("work_process.work_process_date >=", $filter['date_start']);
        }
        if ($filter['date_end'] != '') {
            $this->db->where("work_process.work_process_date <=", $filter['date_end']);
        }
        $this->db->group_by('work_info.work_info_id_pri');
        return $this->db->get()->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('MIN(work_process.work_process_id_pri) AS work_process_id_pri');
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
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                CONCAT(work_info.work_info_no,work_info.work_info_no_3) LIKE '%" . $filter['searchtext'] . "%' OR
                work_info.work_info_subject LIKE '%" . $filter['searchtext'] . "%' OR 
                work_info.work_info_no LIKE '%" . $filter['searchtext'] . "%' OR 
                work_info.work_info_no_2 LIKE '%" . $filter['searchtext'] . "%' OR 
                work_info.work_info_no_3 LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        if ($filter['year_id'] != '') {
            $this->db->where("work_info.year_id", $filter['year_id']);
        }
        if ($filter['status_id'] != '') {
            if ($filter['status_id'] == 0) {
                $this->db->where('work_process.work_process_receive !=', 1);
                $this->db->where_in('work_info.state_info_id', array(4, 5, 6, 8));
            } else if ($filter['status_id'] == 1) {
                $this->db->where('work_process.work_process_receive', 1);
                $this->db->where_in('work_info.state_info_id', array(4, 5, 6, 8));
            } else if ($filter['status_id'] == 2) {
                $this->db->where_in('work_info.state_info_id', array(6));
            }
        } else {
            $this->db->where_in('work_info.state_info_id', array(4, 5, 6, 8));
        }
        if ($filter['book_group_id'] != '') {
            $this->db->where("work_info.book_group_id", $filter['book_group_id']);
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->where('work_process.work_process_status_id !=', 3);
        $this->db->where('work_process.work_process_sendstatus !=', 2);
        if ($filter['date_start'] != '') {
            $this->db->where("work_process.work_process_date >=", $filter['date_start']);
        }
        if ($filter['date_end'] != '') {
            $this->db->where("work_process.work_process_date <=", $filter['date_end']);
        }
        $this->db->order_by('work_process.work_process_receive_id', 'ASC');       
        $this->db->group_by('work_info.work_info_id_pri');
        return $this->db->get();
    }

    public function getData($work_process_id_pri) {
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
                work_process.work_process_create,
                work_process.work_process_update,
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
                dep_off.dep_off_id,
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
        return $this->db->get();
    }

    public function getworkprocess($work_process_id_pri, $work_process_sort = null) {
        $this->db->select('*');
        $this->db->from('work_process');
        if ($work_process_id_pri != null) {
            $this->db->where('work_process.work_process_id_pri', $work_process_id_pri);
        }
        if ($work_process_sort != null) {
            $this->db->where('work_process.work_process_sort', $work_process_sort);
        }
        return $this->db->get();
    }

    public function get_workprocess($work_process_id_pri, $work_process_sort = null) {
        $this->db->select('*');
        $this->db->from('work_process');
        $this->db->where('work_process.dep_off_id', $this->session->userdata('dep_off_id'));
        if ($work_process_id_pri != null) {
            $this->db->where('work_process.work_process_id_pri', $work_process_id_pri);
        }
        if ($work_process_sort != null) {
            $this->db->where('work_process.work_process_sort', $work_process_sort);
        }
        $this->db->where('work_process.work_process_status_id !=', 3);
        $this->db->where('work_process.work_process_sendstatus !=', 2);
        $this->db->where('((work_process.work_process_receive = 0 AND work_process.work_process_receive_id IS NULL) 
                OR (work_process.work_process_receive != 0 AND work_process.work_process_receive_id IS NOT NULL))');
        return $this->db->get();
    }

    public function getworkprocessinfo($work_info_id_pri, $work_process_sort = null) {
        $this->db->select('*');
        $this->db->from('work_process');
        if ($work_info_id_pri != null) {
            $this->db->where('work_process.work_info_id_pri', $work_info_id_pri);
        }
        if ($work_process_sort != null) {
            $this->db->where('work_process.work_process_sort', $work_process_sort);
        }
        return $this->db->get();
    }

    public function checkworkinfo($work_info_id_pri) {
        $this->db->select('*');
        $this->db->from('work_process');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->where('work_process.work_process_receive', 0);
        return $this->db->get();
    }

    public function checkworkinfoback($work_info_id_pri) {
        $this->db->select('*');
        $this->db->from('work_process');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->where('work_process.work_process_receive', 1);
        return $this->db->get();
    }

    public function checkworkprocess($work_process_id_pri) {
        $this->db->select('*');
        $this->db->from('work_process');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->where('work_process.work_process_id_pri', $work_process_id_pri);
        //$this->db->where('work_process.work_process_receive', 0);
        return $this->db->get();
    }

    public function getdepartmentyear() {
        $this->db->select('*');
        $this->db->from('department_year');
        $this->db->where('department_year.dep_id_pri', $this->session->userdata('dep_id_pri'));
        $this->db->where('department_year.year_id', $this->session->userdata('year_id'));
        $this->db->limit(1);
        return $this->db->get();
    }

    public function get_ref_state_info() {
        $this->db->where_in('ref_state_info.state_info_id', array(4, 5, 6, 8));
        $this->db->order_by('ref_state_info.state_info_id');
        return $this->db->get('ref_state_info');
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

    public function update_workinfo($work_info_id_pri, $data) {
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->update('work_info', $data);
    }

    public function update_workprocess($work_process_id_pri, $data) {
        $this->db->where('work_process.work_process_id_pri', $work_process_id_pri);
        $this->db->update('work_process', $data);
    }

    public function update_departmentyear($dep_year_id, $data) {
        $this->db->where('department_year.dep_year_id', $dep_year_id);
        $this->db->update('department_year', $data);
    }

    public function get_workinfofile($work_info_id_pri = null) {
        $this->db->select('*');
        $this->db->from('work_info_file');
        $this->db->join('ref_file_type', 'ref_file_type.file_type_id = work_info_file.file_type_id');
        $this->db->where('work_info_file.work_info_id_pri', $work_info_id_pri);
        return $this->db->get();
    }

    public function ref_user() {
        $this->db->select('user.user_fullname');
        $this->db->from('user');
        $this->db->where('user.user_id', $this->session->userdata('user_id'));
        return $this->db->get()->row()->user_fullname;
    }

    public function key_user() {
        $this->db->select('public_key,private_key,pin_key,user_fullname');
        $this->db->from('user');
        $this->db->where('user.user_id', $this->session->userdata('user_id'));
        $this->db->limit(1);
        return $this->db->get();
    }

    public function insert_signature($data) {
        $this->db->insert('signature', $data);
        return $this->db->insert_id();
    }

    public function getdepartment($dep_id_pri) {
        $this->db->select('*');
        $this->db->from('department');
        $this->db->where('department.dep_id_pri', $dep_id_pri);
        $this->db->limit(1);
        return $this->db->get();
    }

    public function get_withinprocess($work_info_id_pri) {
        $this->db->select('
            work_process.work_process_id_pri,
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
            work_process.work_process_receive_id,
            work_process.work_process_receive_date,
            work_process.work_process_receive,
            work_process.work_process_receive_user_id,
            work_process.work_process_receive_name,
            work_process.work_process_receive_comment,
            work_process.work_process_sendtype,
            work_process.work_process_sendstatus,
            work_process.work_process_sort,
            work_process.work_process_status_id,
            work_process.work_process_create,
            work_process.work_process_update,
            work_info.work_info_code,
            work_info.work_info_subject,
        ');
        $this->db->from('work_process');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->join('ref_state_info', 'work_info.state_info_id = ref_state_info.state_info_id');
        //$this->db->join('dep_off', 'work_process.dep_off_id = dep_off.dep_off_id');
        //$this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        //$this->db->where('work_info.dep_id_pri', $this->session->userdata('dep_id_pri'));
        //$this->db->where('work_process.year_id', $this->session->userdata('year_id'));
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->order_by('work_process.work_process_sort');
        $this->db->order_by('work_process.work_process_create', 'ASC');
        return $this->db->get();
    }

    public function get_workuser($work_process_id_pri) {
        $this->db->select('*');
        $this->db->from('work_process');
        $this->db->join('work_user', 'work_user.work_process_id_pri = work_process.work_process_id_pri');
        $this->db->where('work_process.work_process_id_pri', $work_process_id_pri);
        $this->db->order_by('work_user.work_user_create');
        return $this->db->get();
    }

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
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        //$this->db->where('work_info.work_type_id', 2);
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

    function getOrganization($org_id_pri = null) {
        if ($org_id_pri != null) {
            if ($org_id_pri != 0) {
                $this->db->where('organization.org_id_pri', $org_id_pri);
                $this->db->limit(0);
            }
        }
        return $this->db->get('organization');
    }

    function getOrgDepartment($org_id_pri = null, $dep_id_pri = null) {
        if ($org_id_pri != null) {
            if ($org_id_pri != 0) {
                $this->db->where('department.org_id_pri', $org_id_pri);
            }
        }
        if ($dep_id_pri != null) {
            if ($dep_id_pri != 0) {
                $this->db->where('department.dep_id_pri', $dep_id_pri);
            }
        }
        return $this->db->get('department');
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
        $this->db->where('officer.officer_level !=', 99);
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

    public function insert_workprocess($data) {
        $this->db->insert('work_process', $data);
        return $this->db->insert_id();
    }

    public function insert_workuser($data) {
        $this->db->insert('work_user', $data);
        return $this->db->insert_id();
    }

    public function checkwithinprocess($work_info_id_pri, $work_process_sort, $sendstatus) {
        $this->db->from('work_process');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->join('ref_state_info', 'work_info.state_info_id = ref_state_info.state_info_id');
        $this->db->join('dep_off', 'work_process.dep_off_id = dep_off.dep_off_id');
        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        //$this->db->where('work_info.dep_id_pri', $this->session->userdata('dep_id_pri'));
        //$this->db->where('work_process.year_id', $this->session->userdata('year_id'));
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->where('work_process.work_process_sort', $work_process_sort);
        $this->db->where('work_process.work_process_receive', 1);
        $this->db->where('work_process.work_process_sendstatus', $sendstatus);
        $this->db->where('work_process.work_process_status_id', 1);
        $this->db->where('work_process.work_process_receive_id IS NOT NULL');
        $this->db->order_by('work_process.work_process_create', 'DESC');
        return $this->db->get();
    }

    public function checkwithinprocesslast($work_info_id_pri) {
        $this->db->select('MAX(work_process.work_process_sort) AS work_process_sort');
        $this->db->from('work_process');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->join('ref_state_info', 'work_info.state_info_id = ref_state_info.state_info_id');
        $this->db->join('dep_off', 'work_process.dep_off_id = dep_off.dep_off_id');
        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        //$this->db->where('work_info.dep_id_pri', $this->session->userdata('dep_id_pri'));
        //$this->db->where('work_process.year_id', $this->session->userdata('year_id'));
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        return $this->db->get()->row();
    }

    public function getsortprocess($work_info_id_pri, $work_process_sort) {
        $this->db->from('work_process');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->join('ref_state_info', 'work_info.state_info_id = ref_state_info.state_info_id');
        $this->db->join('dep_off', 'work_process.dep_off_id = dep_off.dep_off_id');
        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        //$this->db->where('work_info.dep_id_pri', $this->session->userdata('dep_id_pri'));
        //$this->db->where('work_process.year_id', $this->session->userdata('year_id'));
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->where('work_process.work_process_sort >', $work_process_sort);
        $this->db->where('work_process.work_process_receive', 0);
        //$this->db->where('work_process.work_process_sendstatus', 0);
        $this->db->where('work_process.work_process_sendstatus', 2);
        $this->db->order_by('work_process.work_process_create', 'DESC');
        return $this->db->get();
    }

    public function getnextprocess($work_info_id_pri, $work_process_sort) {
        $this->db->from('work_process');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->where('work_process.work_process_sort', $work_process_sort);
        $this->db->where('work_process.work_process_receive', 0);
        $this->db->where('work_process.work_process_sendtype', 2);
        $this->db->where('work_process.work_process_sendstatus', 2);
        return $this->db->get();
    }

    public function get_userdep($dep_id_pri) {
        $this->db->from('user');
        $this->db->join('user_dep_off', 'user_dep_off.user_id = user.user_id');
        $this->db->join('dep_off', 'user_dep_off.dep_off_id = dep_off.dep_off_id');
        $this->db->where('dep_off.dep_id_pri', $dep_id_pri);
        $this->db->group_by('user.user_id');
        return $this->db->get();
    }

    public function get_user($user_id) {
        $this->db->from('user');
        $this->db->join('user_dep_off', 'user_dep_off.user_id = user.user_id');
        $this->db->join('dep_off', 'user_dep_off.dep_off_id = dep_off.dep_off_id');
        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        $this->db->where('user.user_id', $user_id);
        return $this->db->get()->row();
    }

    public function get_workprocessfofileid($work_process_id_pri = null) {
        $this->db->select('work_process.dep_off_id,
                work_process_file.work_process_file_id,
                work_process_file.work_process_id_pri,
                work_process_file.user_id,
                work_process_file.work_process_file_send,
                work_process_file.work_process_file_path,
                work_process_file.work_process_file_oldname,
                work_process_file.work_process_file_name,
                work_process_file.file_type_id,
                work_process_file.work_process_file_active,
                work_process_file.work_process_file_create,
                work_process_file.work_process_file_update,
                ref_file_type.file_type_id,
                ref_file_type.file_type_name,
                ref_file_type.file_type_icon,
                ref_file_type.file_type_check');
        $this->db->from('work_process_file');
        $this->db->join('ref_file_type', 'work_process_file.file_type_id = ref_file_type.file_type_id');
        $this->db->join('work_process', 'work_process_file.work_process_id_pri = work_process.work_process_id_pri');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        //$this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->where('work_process_file.work_process_id_pri', $work_process_id_pri);
        return $this->db->get();
    }

    public function get_workprocessfofile($work_info_id_pri = null) {
        $this->db->select('work_process.dep_off_id,
                work_process_file.work_process_file_id,
                work_process_file.work_process_id_pri,
                work_process_file.user_id,
                work_process_file.work_process_file_send,
                work_process_file.work_process_file_path,
                work_process_file.work_process_file_oldname,
                work_process_file.work_process_file_name,
                work_process_file.file_type_id,
                work_process_file.work_process_file_active,
                work_process_file.work_process_file_create,
                work_process_file.work_process_file_update,
                ref_file_type.file_type_id,
                ref_file_type.file_type_name,
                ref_file_type.file_type_icon,
                ref_file_type.file_type_check');
        $this->db->from('work_process_file');
        $this->db->join('ref_file_type', 'work_process_file.file_type_id = ref_file_type.file_type_id');
        $this->db->join('work_process', 'work_process_file.work_process_id_pri = work_process.work_process_id_pri');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        //$this->db->where('work_process_file.work_process_id_pri', $work_process_id_pri);
        return $this->db->get();
    }

    public function check_workprocessfofileinfo($work_info_id_pri = null) {
        $this->db->select('*');
        $this->db->from('work_process_file');
        $this->db->join('work_process', 'work_process_file.work_process_id_pri = work_process.work_process_id_pri');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->where('work_process_file.work_process_file_send', 2);
        return $this->db->get()->num_rows();
    }

    public function check_workprocessfofiledepoff($work_info_id_pri = null) {
        $this->db->select('*');
        $this->db->from('work_process_file');
        $this->db->join('work_process', 'work_process_file.work_process_id_pri = work_process.work_process_id_pri');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->where('work_process.dep_off_id', $this->session->userdata('dep_off_id'));
        $this->db->where('work_process_file.work_process_file_send', 1);
        return $this->db->get()->num_rows();
    }

    public function check_workprocessfofileprocess($work_process_id_pri = null) {
        $this->db->select('*');
        $this->db->from('work_process_file');
        $this->db->where('work_process_file.work_process_id_pri', $work_process_id_pri);
        $this->db->where('work_process_file.work_process_file_send', 1);
        return $this->db->get()->num_rows();
    }

    //    public function get_workprocessfofileid($work_process_file_id = null) {
    //        $this->db->from('work_process_file');
    //        $this->db->where('work_process_file.work_process_file_id', $work_process_file_id);
    //        return $this->db->get()->row();
    //    }

    public function ref_file_type($file_type_name) {
        $this->db->select('*');
        $this->db->from('ref_file_type');
        $this->db->where('ref_file_type.file_type_name', $file_type_name);
        $this->db->limit(1);
        return $this->db->get();
    }

    public function insert_workprocessfile($data) {
        $this->db->insert('work_process_file', $data);
        return $this->db->insert_id();
    }

    public function delete_workprocessfile($id) {
        $this->db->where('work_process_file.work_process_file_id', $id);
        $this->db->delete('work_process_file');
    }

    public function get_workuserfofile($work_info_id_pri = null) {
        $this->db->select('work_user_file.work_user_file_id,
            work_user_file.work_user_id,
            work_user_file.user_id,
            work_user_file.work_user_file_path,
            work_user_file.work_user_file_oldname,
            work_user_file.work_user_file_name,
            work_user_file.file_type_id,
            work_user_file.work_user_file_active,
            work_user_file.work_user_file_create,
            work_user_file.work_user_file_update,
            ref_file_type.file_type_id,
            ref_file_type.file_type_name,
            ref_file_type.file_type_icon,
            ref_file_type.file_type_check');
        $this->db->from('work_user_file');
        $this->db->join('ref_file_type', 'work_user_file.file_type_id = ref_file_type.file_type_id');
        $this->db->join('work_user', 'work_user_file.work_user_id = work_user.work_user_id');
        $this->db->join('work_process', 'work_user.work_process_id_pri = work_process.work_process_id_pri');
        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        return $this->db->get();
    }

    public function get_workuserid($work_user_id) {
        $this->db->select('*');
        $this->db->from('work_process');
        $this->db->join('work_user', 'work_user.work_process_id_pri = work_process.work_process_id_pri');
        //$this->db->where('work_process.year_id', $this->session->userdata('year_id'));
        $this->db->where('work_user.work_user_id', $work_user_id);
        $this->db->order_by('work_user.work_user_create');
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

    public function get_ref_book_group() {
        $this->db->order_by('ref_book_group.book_group_id');
        return $this->db->get('ref_book_group');
    }

    public function get_groupdep($groupdep_id = NULL) {
        $this->db->select('*');
        if ($groupdep_id != NULL) {
            $this->db->where('groupdep_id', $groupdep_id);
        }
        $this->db->where('groupdep.dep_id_pri', $this->session->userdata('dep_id_pri'));
        return $this->db->get('groupdep');
    }

    public function get_dataexcel($filter) {
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
        if ($filter['searchtext'] != 'null') {
            $this->db->where(" (
                CONCAT(work_info.work_info_no,work_info.work_info_no_3) LIKE '%" . $filter['searchtext'] . "%' OR
                work_info.work_info_subject LIKE '%" . $filter['searchtext'] . "%' OR 
                work_info.work_info_no LIKE '%" . $filter['searchtext'] . "%' OR 
                work_info.work_info_no_2 LIKE '%" . $filter['searchtext'] . "%' OR 
                work_info.work_info_no_3 LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        if ($filter['year_id'] != 'null') {
            $this->db->where("work_info.year_id", $filter['year_id']);
        }
        if ($filter['status_id'] != 'null') {
            if ($filter['status_id'] == 0) {
                $this->db->where('work_process.work_process_receive !=', 1);
                $this->db->where_in('work_info.state_info_id', array(4, 5, 6, 8));
            } else if ($filter['status_id'] == 1) {
                $this->db->where('work_process.work_process_receive', 1);
                $this->db->where_in('work_info.state_info_id', array(4, 5, 6, 8));
            } else if ($filter['status_id'] == 2) {
                $this->db->where_in('work_info.state_info_id', array(6));
            }
        } else {
            $this->db->where_in('work_info.state_info_id', array(4, 5, 6, 8));
        }
        if ($filter['book_group_id'] != 'null') {
            $this->db->where("work_info.book_group_id", $filter['book_group_id']);
        }
        $this->db->where('work_process.work_process_status_id !=', 3);
        $this->db->where('work_process.work_process_sendstatus !=', 2);
        if ($filter['date_start'] != 'null') {
            $this->db->where("work_process.work_process_date >=", $filter['date_start']);
        }
        if ($filter['date_end'] != 'null') {
            $this->db->where("work_process.work_process_date <=", $filter['date_end']);
        }
        $this->db->order_by('work_process.work_process_receive_id', 'ASC');       
        $this->db->group_by('work_info.work_info_id_pri');
        return $this->db->get();
    }
}
