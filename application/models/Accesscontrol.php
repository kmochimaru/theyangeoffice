<?php

class Accesscontrol extends CI_Model {

    public function getGroupMenuByRole($role_id) {
        $this->db->select('group_menu.group_menu_id,
                            group_menu.group_menu_name,
                            group_menu.group_menu_icon,
                            group_menu.group_menu_sort,
                            group_menu.group_menu_update');
        $this->db->join('menu', 'menu.group_menu_id = group_menu.group_menu_id');
        $this->db->join('map_menu_role', 'map_menu_role.menu_id = menu.menu_id');
        $this->db->where('map_menu_role.role_id', $role_id);
        $this->db->group_by('group_menu.group_menu_id');
        $this->db->order_by('group_menu.group_menu_sort');
        return $this->db->get('group_menu');
    }

    public function getMenuByGroup($group_menu_id, $role_id) {
        $this->db->select('menu.menu_id,menu.menu_link,menu.menu_name,menu.menu_status_id,menu.menu_openlink');
        $this->db->from('group_menu');
        $this->db->join('menu', 'menu.group_menu_id = group_menu.group_menu_id');
        $this->db->join('map_menu_role', 'map_menu_role.menu_id = menu.menu_id');
        $this->db->where('group_menu.group_menu_id', $group_menu_id);
        $this->db->where('map_menu_role.role_id', $role_id);
        $this->db->where_in('menu.menu_status_id', array(1, 3));
        $this->db->order_by('menu.menu_sort');
        return $this->db->get();
    }

    public function getUser($mail, $citizen) {
        $this->db->select('*');
        $this->db->where('user.user_email', $mail);
        $this->db->where('user.user_citizen', $citizen);
        return $this->db->get('user');
    }

    public function getUserPass($username, $password) {
        $this->db->select('*');
        $this->db->where('user.username', $username);
        $this->db->where('user.password', $password);
        return $this->db->get('user');
    }

    public function getUserFull($user_id) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user.user_id', $user_id);
        return $this->db->get()->row();
    }

    public function getDepartment($dep_id_pri) {
        $this->db->select('*');
        $this->db->from('department');
        $this->db->where('department.dep_id_pri', $dep_id_pri);
        $this->db->where('department.dep_status_id', 1);
        $this->db->limit(1);
        return $this->db->get();
    }

    public function getUserDepOff($user_id) {
        $this->db->select('*');
        $this->db->from('user_dep_off');
        $this->db->join('dep_off', 'user_dep_off.dep_off_id = dep_off.dep_off_id');
        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        $this->db->join('officer', 'dep_off.officer_id = officer.officer_id');
        $this->db->where('user_dep_off.user_dep_off_status_id', 1);
        $this->db->where('user_dep_off.user_dep_off_active_id', 1);
        $this->db->where('department.dep_status_id', 1);
        $this->db->where('dep_off.dep_off_status_id', 1);
        $this->db->where('user_dep_off.user_id', $user_id);
        $this->db->limit(1);
        $this->db->order_by('user_dep_off.user_dep_off_active_id');
        return $this->db->get();
    }

    public function getUserDepOffSession($user_id) {
        $this->db->select('*');
        $this->db->from('user_dep_off');
        $this->db->join('dep_off', 'dep_off.dep_off_id = user_dep_off.dep_off_id');
        $this->db->join('department', 'department.dep_id_pri = dep_off.dep_id_pri');
        $this->db->join('officer', 'officer.officer_id = dep_off.officer_id');
        $this->db->where('user_dep_off.user_dep_off_status_id', 1);
        $this->db->where('department.dep_status_id', 1);
        $this->db->where('dep_off.dep_off_status_id', 1);
        $this->db->where('user_dep_off.user_id', $user_id);
        $this->db->order_by('user_dep_off.user_dep_off_active_id');
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
        $this->db->limit(1);
        return $this->db->get();
    }

    public function getYear($date) {
        $this->db->select('*');
        $this->db->from('year');
        $this->db->where('year.year_start <=', $date);
        $this->db->where('year.year_end >=', $date);
        $this->db->limit(1);
        return $this->db->get();
    }

    public function get_year() {
        $this->db->order_by('year.year');
        return $this->db->get('year');
    }

    public function accessMenu($role_id, $menu_id) {
        $this->db->select('menu.menu_id');
        $this->db->from('menu');
        $this->db->join('map_menu_role', 'map_menu_role.menu_id = menu.menu_id');
        $this->db->where('map_menu_role.role_id', $role_id);
        $this->db->where('menu.menu_id', $menu_id);
        $this->db->where('menu.menu_status_id', 1);
        return $this->db->get()->num_rows();
    }

    public function checkLogin($user_id, $regenerate_login) {
        $this->db->select('user_check_login.login_id');
        $this->db->from('user_check_login');
        $this->db->where('user_check_login.user_id', $user_id);
        $this->db->where('user_check_login.regenerate_login', $regenerate_login);
        $this->db->where('user_check_login.ip_address', $this->input->ip_address());
        return $this->db->get()->num_rows();
    }

    public function getNameTitle($id = NULL) {
        if ($id == NULL) {
            return 'ยังไม่ได้ระบุเมนู';
        } else {
            $this->db->select('menu_name');
            $this->db->from('menu');
            $this->db->where('menu.menu_id', $id);
            $row = $this->db->get()->row();
            return $row->menu_name;
        }
    }

    public function getNameGroup($id = NULL) {
        if ($id == NULL) {
            return 'ยังไม่ได้ระบุกลุ่มเมนู';
        } else {
            $this->db->select('group_menu_name, group_menu_icon');
            $this->db->from('group_menu');
            $this->db->where('group_menu.group_menu_id', $id);
            return $this->db->get()->row();
        }
    }

    public function getIcon($id = NULL) {
        $this->db->select('group_menu_icon');
        $this->db->from('group_menu');
        $this->db->where('group_menu.group_menu_id', $id);
        $row = $this->db->get()->row();
        return $row->group_menu_icon;
    }

//    public function getWorkInfoReceive() {
//        $this->db->select('*');
//        $this->db->from('work_process');
//        $this->db->join('work_info', 'work_process.work_info_id_pri = work_info.work_info_id_pri');
//        $this->db->join('ref_state_info', 'work_info.state_info_id = ref_state_info.state_info_id');
//        $this->db->join('dep_off', 'work_process.dep_off_id = dep_off.dep_off_id');
//        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
//        $this->db->join('ref_priority_info', 'work_info.priority_info_id = ref_priority_info.priority_info_id');
//        $this->db->where('work_process.dep_off_id', $this->session->userdata('dep_off_id'));
//        $this->db->where_in('work_info.state_info_id', array(4, 5, 6));
//        $this->db->where('work_process.work_process_receive !=', 1);
//        $this->db->where('work_process.work_process_status_id !=', 3);
//        $this->db->where('work_process.work_process_sendstatus !=', 2);
//        $this->db->where('work_info.work_info_retrospect', 0);
//        $this->db->where('work_process.work_process_active_id', 1);
//        $this->db->where('((work_process.work_process_receive = 0 AND work_process.work_process_receive_id IS NULL) 
//                OR (work_process.work_process_receive != 0 AND work_process.work_process_receive_id IS NOT NULL))');
//        return $this->db->get();
//    }

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
        $this->db->where('work_process.work_process_receive !=', 1);
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
        $this->db->where('dep_off.dep_off_id', $this->session->userdata('dep_off_id'));
        $this->db->where('work_user.user_id', $this->session->userdata('user_id'));
        $this->db->where('work_info.work_info_retrospect', 0);
        $this->db->where('work_info.state_info_id >=', 4);
        $this->db->where('work_user.work_user_status_id', 1);
        $this->db->order_by('work_user.work_user_create', 'DESC');
        return $this->db->get();
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

    public function getworkinfo($work_info_id_pri = null) {
        $this->db->select('*');
        $this->db->from('work_info');
        $this->db->where('work_info.work_info_id_pri', $work_info_id_pri);
        $this->db->limit(1);
        return $this->db->get();
    }
}
