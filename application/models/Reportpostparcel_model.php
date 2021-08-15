<?php

/**
 * @author nut
 */
class Reportpostparcel_model extends CI_Model {

    //put your code here
    public function get_pagination($filter) {
        $this->db->select('*');
        $this->db->from('post_parcel');
        $this->db->join('ref_parcel_type', 'post_parcel.parcel_type_id = ref_parcel_type.parcel_type_id');
        $this->db->join('ref_parcel_tran', 'post_parcel.parcel_tran_id = ref_parcel_tran.parcel_tran_id');
        $this->db->join('ref_parcel_status', 'post_parcel.parcel_status_id = ref_parcel_status.parcel_status_id');
        $this->db->join('ref_parcel_group', 'post_parcel.parcel_group_id = ref_parcel_group.parcel_group_id');
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                post_parcel.post_parcel_code LIKE '%" . $filter['searchtext'] . "%' OR
                post_parcel.post_parcel_to LIKE '%" . $filter['searchtext'] . "%' OR
                post_parcel.post_parcel_tel LIKE '%" . $filter['searchtext'] . "%' OR
                post_parcel.post_parcel_name LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        if ($filter['type'] == 1) {
            $this->db->where('post_parcel.post_parcel_in >=', $filter['start'] . ' 00:00:00');
            $this->db->where('post_parcel.post_parcel_in <=', $filter['end'] . ' 23:59:59');
        } else {
            $this->db->where('post_parcel.post_parcel_out >=', $filter['start'] . ' 00:00:00');
            $this->db->where('post_parcel.post_parcel_out <=', $filter['end'] . ' 23:59:59');
        }
        if ($filter['parcel_status_id'] != '') {
            $this->db->where('post_parcel.parcel_status_id', $filter['parcel_status_id']);
        }
        if ($filter['parcel_group_id'] != '') {
            $this->db->where('post_parcel.parcel_group_id', $filter['parcel_group_id']);
        }
        if ($filter['parcel_tran_id'] != '') {
            $this->db->where('post_parcel.parcel_tran_id', $filter['parcel_tran_id']);
        }
        if ($filter['parcel_type_id'] != '') {
            $this->db->where('post_parcel.parcel_type_id', $filter['parcel_type_id']);
        }
        return $this->db->get();
    }

    public function minyear() {
        $this->db->select('MIN(YEAR(post_parcel.post_parcel_create)) AS minyear');
        return $this->db->get('post_parcel');
    }

    public function mindate() {
        $this->db->select('MIN(DATE(post_parcel.post_parcel_create)) AS mindate');
        return $this->db->get('post_parcel');
    }

    public function get_ref_parcel_group($parcel_group_id = null) {
        if ($parcel_group_id != null) {
            $this->db->where('ref_parcel_group.parcel_group_id', $parcel_group_id);
        }
        return $this->db->get('ref_parcel_group');
    }

    public function get_ref_parcel_type($parcel_type_id = null) {
        if ($parcel_type_id != null) {
            $this->db->where('ref_parcel_type.parcel_type_id', $parcel_type_id);
        }
        return $this->db->get('ref_parcel_type');
    }

    public function get_ref_parcel_tran($parcel_tran_id = null) {
        if ($parcel_tran_id != null) {
            $this->db->where('ref_parcel_tran.parcel_tran_id', $parcel_tran_id);
        }
        return $this->db->get('ref_parcel_tran');
    }

    public function get_ref_parcel_status($parcel_status_id = null) {
        if ($parcel_status_id != null) {
            $this->db->where('ref_parcel_status.parcel_status_id', $parcel_status_id);
        }
        return $this->db->get('ref_parcel_status');
    }

    public function get_user($q) {
        $this->db->select('*');
        $this->db->from('user');
        if ($q != null) {
            $this->db->where(" (
                user.user_fullname LIKE '%" . $q . "%' OR 
                user.user_citizen LIKE '%" . $q . "%' OR 
                user.user_tel LIKE '%" . $q . "%'
            ) ");
        }
        return $this->db->get();
    }

    public function getInstructor($q) {
        $CI = &get_instance();
        $this->reg = $CI->load->database('reg', TRUE);
        $this->reg->from('instructor');
        $this->reg->join('personal_profile', 'personal_profile.instructor_id = instructor.instructor_id');
        if ($q != null) {
            $this->reg->where(" (
                instructor.firstname LIKE '%" . $q . "%' OR 
                instructor.lastname LIKE '%" . $q . "%' OR 
                instructor.phone LIKE '%" . $q . "%' OR 
                instructor.citizen_id LIKE '%" . $q . "%'
            ) ");
        }
        $this->reg->where_in('personal_profile.staff_status_id', array(1, 4, 12));
        $this->reg->order_by('instructor.firstname');
        $this->reg->order_by('instructor.lastname');
        return $this->reg->get();
    }

    public function getInstructorID($id) {
        $CI = &get_instance();
        $this->reg = $CI->load->database('reg', TRUE);
        $this->reg->from('instructor');
        $this->reg->join('personal_profile', 'personal_profile.instructor_id = instructor.instructor_id');
        $this->reg->join('ref_campus', 'instructor.campus_id_pri = ref_campus.campus_id_pri');
        $this->reg->join('ref_faculty', 'instructor.faculty_id_pri = ref_faculty.faculty_id_pri');
        $this->reg->join('ref_department', 'instructor.department_id_pri = ref_department.department_id_pri');
        $this->reg->where('instructor.instructor_id', $id);
        return $this->reg->get();
    }

    public function getStd($q) {
        $CI = &get_instance();
        $this->reg = $CI->load->database('reg', TRUE);
        $this->reg->select('std_data.std_fname,
            std_data.std_lname,
            std_data.citizen_id,
            std_profile.mobile_phone,
            std_data.std_id_pri');
        $this->reg->from('std_data');
        $this->reg->join('std_profile', 'std_profile.std_id_pri = std_data.std_id_pri');
        if ($q != null) {
            $this->reg->where(" (
                std_data.std_fname LIKE '%" . $q . "%' OR 
                std_data.std_lname LIKE '%" . $q . "%' OR 
                std_data.citizen_id LIKE '%" . $q . "%' OR 
                std_profile.mobile_phone LIKE '%" . $q . "%'
            ) ");
        }
        $this->reg->where_in('std_data.status_id', array(1));
        $this->reg->order_by('std_data.std_fname');
        $this->reg->order_by('std_data.std_lname');
        return $this->reg->get();
    }

    public function getStdID($id) {
        $CI = &get_instance();
        $this->reg = $CI->load->database('reg', TRUE);
        $this->reg->select('std_data.std_fname AS firstname,
            std_data.std_lname AS lastname,
            std_data.citizen_id,
            std_profile.mobile_phone AS phone,
            std_data.status_id,
            std_data.std_id_pri,
            std_data.line_token,
            ref_campus.campus_name,
            ref_faculty.faculty_name,
            ref_department.department_name,
            ref_major.major_name');
        $this->reg->from('std_data');
        $this->reg->join('std_profile', 'std_profile.std_id_pri = std_data.std_id_pri');
        $this->reg->join('std_section', 'std_data.std_section_id = std_section.std_section_id');
        $this->reg->join('ref_major', 'std_section.major_id_pri = ref_major.major_id_pri');
        $this->reg->join('ref_department', 'ref_major.department_id_pri = ref_department.department_id_pri');
        $this->reg->join('ref_faculty', 'ref_department.faculty_id_pri = ref_faculty.faculty_id_pri');
        $this->reg->join('ref_campus', 'std_section.campus_id_pri = ref_campus.campus_id_pri');
        $this->reg->where('std_data.std_id_pri', $id);
        return $this->reg->get();
    }

    public function getCode($id) {
        $this->db->select('*');
        $this->db->from('post_parcel');
        $this->db->where('post_parcel.post_parcel_code', $id);
        return $this->db->get();
    }

    public function getPostParcel($id) {
        $this->db->select('*');
        $this->db->from('post_parcel');
        $this->db->join('ref_parcel_type', 'post_parcel.parcel_type_id = ref_parcel_type.parcel_type_id');
        $this->db->join('ref_parcel_tran', 'post_parcel.parcel_tran_id = ref_parcel_tran.parcel_tran_id');
        $this->db->join('ref_parcel_status', 'post_parcel.parcel_status_id = ref_parcel_status.parcel_status_id');
        $this->db->join('ref_parcel_group', 'post_parcel.parcel_group_id = ref_parcel_group.parcel_group_id');
        $this->db->where('post_parcel.post_parcel_id', $id);
        return $this->db->get();
    }

    public function insert_post_parcel($data) {
        $this->db->insert('post_parcel', $data);
        //return $this->db->insert_id();
    }

    public function update_post_parcel($post_parcel_id, $data) {
        $this->db->where('post_parcel.post_parcel_id', $post_parcel_id);
        $this->db->update('post_parcel', $data);
    }

}
