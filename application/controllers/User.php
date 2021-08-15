<?php

class User extends CI_Controller {

    public $group_id = 8;
    public $menu_id = 23;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('user_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.min.css'),
            'css_full' => array('plugin/datepicker/datepicker.css'),
            'js' => array('parsley.min.js'),
            'js_full' => array('plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js'),
        );
        $this->renderView('user_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'role_id' => $this->input->post('role_id'),
            'user_status_id' => $this->input->post('user_status_id'),
            'searchtext' => $this->input->post('searchtext'),
            'per_page' => $this->input->post('per_page')
        );
        $count = $this->user_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('user/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->input->post('per_page');
        $config['additional_param'] = "{'role_id' : '" . $this->input->post('role_id') . "', 'user_status_id' : '" . $this->input->post('user_status_id') . "', 'searchtext' : '" . $this->input->post('searchtext') . "', 'per_page' : '" . $this->input->post('per_page') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->user_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->input->post('per_page'))),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/user_pagination', $data);
    }

    public function add_user_modal() {
        $data = array(
            'data' => ''
        );
        $this->load->view('modal/user_add_modal', $data);
    }

    public function edit_user_modal() {
        $data = array(
            'data' => $this->user_model->get_user($this->input->post('user_id'))->row(),
            'dep' => $this->user_model->get_department()->row()
        );
        $this->load->view('modal/user_edit_modal', $data);
    }

    public function status_user_modal() {
        $data = array(
            'data' => $this->user_model->get_user($this->input->post('user_id'))->row()
        );
        $this->load->view('modal/user_status_modal', $data);
    }

    public function check_username() {
        $check = $this->user_model->check_username($this->input->post('username'));
        if ($check->num_rows() > 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function add_user() {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => hash('sha256', $this->input->post('username') . $this->input->post('password')),
            'user_email' => $this->input->post('user_email'),
            'user_citizen' => NULL, //$this->input->post('citizen'),
            'user_fullname' => $this->input->post('user_fullname'),
            'user_address' => $this->input->post('user_address'),
            'user_tel' => $this->input->post('user_tel'),
            'user_image' => 'none.png',
            'role_id' => $this->input->post('role_id'),
            'user_status_id' => 1,
            'user_style' => 'green',
            'user_activate' => 1,
            'pin_key' => NULL,
            'user_expire' => ($this->input->post('user_expire') != '' ? $this->input->post('user_expire') : NULL),
            'user_create' => $this->misc->getdate(),
            'user_update' => $this->misc->getdate()
        );
        $user_id = $this->user_model->insert_user($data);

        //update key
        $update_key = array(
            'public_key' => $user_id . $this->generatePublicKey() . date('Ymd'),
            'private_key' => $this->generatePrivateKey() . date('YmdHis') . $user_id
        );
        $this->user_model->update_user($user_id, $update_key);

        if ($user_id > 0) {
            $this->load->library('upload');
            $this->load->library('image_lib');
            $config_photo = array(
                'upload_path' => './assets/upload/user/',
                'allowed_types' => 'jpg|gif|png',
                'max_size' => 4096,
                'file_name' => 'profile_' . $user_id . '_' . date('YmdHis')
            );
            $this->upload->initialize($config_photo);
            if ($this->upload->do_upload('user_image')) {
                $upload_data = $this->upload->data();
                $image_data = array(
                    'user_image' => $upload_data['file_name']
                );
                $this->user_model->update_user($user_id, $image_data);
            }
        }
        $dep_off_id = $this->user_model->getdep_off($this->input->post('dep_id_pri'), $this->input->post('officer_id'))->row()->dep_off_id;
        $datadep_off = array(
            'user_id' => $user_id,
            'dep_off_id' => $dep_off_id,
            'user_dep_off_status_id' => 1,
            'user_dep_off_active_id' => 1,
        );
        $this->user_model->insert_user_dep_off($datadep_off);
        $datauser = $this->user_model->get_user($user_id)->row();
        $datalog = array(
            'log_text' => 'เพิ่ม',
            'user_id' => $user_id,
            'username' => $datauser->username,
            'password' => $datauser->password,
            'user_email' => $datauser->user_email,
            'user_citizen' => $datauser->user_citizen,
            'user_fullname' => $datauser->user_fullname,
            'user_address' => $datauser->user_address,
            'user_tel' => $datauser->user_tel,
            'user_image' => $datauser->user_image,
            'role_id' => $datauser->role_id,
            'user_status_id' => $datauser->user_status_id,
            'user_style' => $datauser->user_style,
            'user_activate' => $datauser->user_activate,
            'user_activate_code' => $datauser->user_activate_code,
            'user_line_token' => $datauser->user_line_token,
            'user_signature_path' => $datauser->user_signature_path,
            'public_key' => $datauser->public_key,
            'private_key' => $datauser->private_key,
            'pin_key' => $datauser->pin_key,
            'log_ip_address' => $this->input->ip_address(),
            'log_browser' => $this->getAgent(),
            'log_time' => $this->misc->getdate(),
        );
        $this->user_model->insert_loguser($datalog);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มผู้ใช้ระบบเรียบร้อยแล้ว');
        redirect(base_url('user'));
    }

    public function edit_user() {
        $user_image = '';
        if (!empty($_FILES['user_image']['name'])) {
            $this->load->library('upload');
            $this->load->library('image_lib');
            $config_photo = array(
                'upload_path' => './assets/upload/user/',
                'allowed_types' => 'jpg|gif|png',
                'max_size' => 8192,
                'file_name' => 'profile_' . $this->input->post('user_id') . '_' . date('YmdHis')
            );
            $this->upload->initialize($config_photo);
            if ($this->upload->do_upload('user_image')) {
                $upload_data = $this->upload->data();
                $user_image = $upload_data['file_name'];
                if ($this->input->post('user_image_current') != 'none.png') {
                    @unlink('./assets/upload/user/' . $this->input->post('user_image_current'));
                }
            }
        }
        //        $user_signature_path = '';
        //        if (!empty($_FILES['user_signature_path']['name'])) {
        //            $this->load->library('upload');
        //            $this->load->library('image_lib');
        //            $config_photo = array(
        //                'upload_path' => './assets/upload/signature/',
        //                'allowed_types' => 'jpg|gif|png',
        //                'max_size' => 8192,
        //                'file_name' => 'signature_' . $this->input->post('user_id') . '_' . date('YmdHis')
        //            );
        //            $this->upload->initialize($config_photo);
        //            if ($this->upload->do_upload('user_signature_path')) {
        //                $upload_data = $this->upload->data();
        //                $user_signature_path = $upload_data['file_name'];
        //                if ($this->input->post('user_signature_path_current') != 'none.png') {
        //                    @unlink('./assets/upload/signature/' . $this->input->post('user_signature_path_current'));
        //                }
        //            }
        //        }
        if ($user_image != '') {
            //            if ($user_signature_path != '') {
            //                $data = array(
            //                    'username' => $this->input->post('username'),
            //                    'user_email' => $this->input->post('user_email'),
            //                    'user_citizen' => $this->input->post('citizen'),
            //                    'user_fullname' => $this->input->post('user_fullname'),
            //                    'user_address' => $this->input->post('user_address'),
            //                    'user_tel' => $this->input->post('user_tel'),
            //                    'user_image' => $user_image,
            //                    'user_signature_path' => $user_signature_path,
            //                    'role_id' => $this->input->post('role_id'),
            //                    'user_update' => $this->misc->getdate()
            //                );
            //            } else {
            $data = array(
                'user_email' => $this->input->post('user_email'),
                'user_fullname' => $this->input->post('user_fullname'),
                'user_address' => $this->input->post('user_address'),
                'user_tel' => $this->input->post('user_tel'),
                'user_image' => $user_image,
                'role_id' => $this->input->post('role_id'),
                'user_expire' => ($this->input->post('user_expire') != '' ? $this->input->post('user_expire') : NULL),
                'user_update' => $this->misc->getdate()
            );
            //            }
        } else {
            //            if ($user_signature_path != '') {
            //                $data = array(
            //                    'user_email' => $this->input->post('user_email'),
            //                    'user_fullname' => $this->input->post('user_fullname'),
            //                    'user_address' => $this->input->post('user_address'),
            //                    'user_tel' => $this->input->post('user_tel'),
            //                    'role_id' => $this->input->post('role_id'),
            //                    'user_signature_path' => $user_signature_path,
            //                    'user_update' => $this->misc->getdate()
            //                );
            //            } else {
            $data = array(
                'user_email' => $this->input->post('user_email'),
                'user_fullname' => $this->input->post('user_fullname'),
                'user_address' => $this->input->post('user_address'),
                'user_tel' => $this->input->post('user_tel'),
                'role_id' => $this->input->post('role_id'),
                'user_expire' => ($this->input->post('user_expire') != '' ? $this->input->post('user_expire') : NULL),
                'user_update' => $this->misc->getdate()
            );
            //            }
        }
        $datauser = $this->user_model->get_user($this->input->post('user_id'))->row();
        $datalog = array(
            'log_text' => 'แก้ไข',
            'user_id' => $this->input->post('user_id'),
            'username' => $datauser->username,
            'password' => $datauser->password,
            'user_email' => $datauser->user_email,
            'user_citizen' => $datauser->user_citizen,
            'user_fullname' => $datauser->user_fullname,
            'user_address' => $datauser->user_address,
            'user_tel' => $datauser->user_tel,
            'user_image' => $datauser->user_image,
            'role_id' => $datauser->role_id,
            'user_status_id' => $datauser->user_status_id,
            'user_style' => $datauser->user_style,
            'user_activate' => $datauser->user_activate,
            'user_activate_code' => $datauser->user_activate_code,
            'user_line_token' => $datauser->user_line_token,
            'user_signature_path' => $datauser->user_signature_path,
            'public_key' => $datauser->public_key,
            'private_key' => $datauser->private_key,
            'pin_key' => $datauser->pin_key,
            'log_ip_address' => $this->input->ip_address(),
            'log_browser' => $this->getAgent(),
            'log_time' => $this->misc->getdate(),
        );
        $this->user_model->insert_loguser($datalog);
        $this->user_model->update_user($this->input->post('user_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขผู้ใช้ระบบเรียบร้อยแล้ว');
        redirect(base_url('user'));
    }

    public function status_user() {
        $data = array(
            'user_status_id' => $this->input->post('user_status_id'),
            'user_update' => $this->misc->getdate()
        );
        $this->user_model->update_user($this->input->post('user_id'), $data);
        $datauser = $this->user_model->get_user($this->input->post('user_id'))->row();
        $datalog = array(
            'log_text' => 'แก้ไข',
            'user_id' => $this->input->post('user_id'),
            'username' => $datauser->username,
            'password' => $datauser->password,
            'user_email' => $datauser->user_email,
            'user_citizen' => $datauser->user_citizen,
            'user_fullname' => $datauser->user_fullname,
            'user_address' => $datauser->user_address,
            'user_tel' => $datauser->user_tel,
            'user_image' => $datauser->user_image,
            'role_id' => $datauser->role_id,
            'user_status_id' => $datauser->user_status_id,
            'user_style' => $datauser->user_style,
            'user_activate' => $datauser->user_activate,
            'user_activate_code' => $datauser->user_activate_code,
            'user_line_token' => $datauser->user_line_token,
            'user_signature_path' => $datauser->user_signature_path,
            'public_key' => $datauser->public_key,
            'private_key' => $datauser->private_key,
            'pin_key' => $datauser->pin_key,
            'log_ip_address' => $this->input->ip_address(),
            'log_browser' => $this->getAgent(),
            'log_time' => $this->misc->getdate(),
        );
        $this->user_model->insert_loguser($datalog);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขผู้ใช้ระบบเรียบร้อยแล้ว');
        redirect(base_url('user'));
    }

    public function selected_officer() {
        $officers = $this->user_model->getdep_off($this->input->post('dep_id_pri'))->result();
        $officer_id = array();
        $officer_name = array();
        $i = 0;
        foreach ($officers as $officer) {
            $officer_id[$i] = $officer->officer_id;
            $officer_name[$i] = $officer->officer_name;
            $i++;
        }
        if ($i == 0) {
            $officer_id[$i] = "";
            $officer_name[$i] = "ไม่ระบุตำแหน่ง";
        }

        $return["officer_id"] = $officer_id;
        $return["officer_name"] = $officer_name;
        print json_encode($return);
    }

    public function selected_depoff() {
        $officers = $this->user_model->getdep_off($this->input->post('dep_id_pri'))->result();
        $officer_id = array();
        $officer_name = array();
        $i = 0;
        foreach ($officers as $officer) {
            if ($this->user_model->checkuser_dep_off($this->input->post('dep_id_pri'), $officer->officer_id, $this->input->post('user_id'))->num_rows() == 0) {
                $officer_id[$i] = $officer->officer_id;
                $officer_name[$i] = $officer->officer_name;
                $i++;
            }
        }
        $return["officer_id"] = $officer_id;
        $return["officer_name"] = $officer_name;
        print json_encode($return);
    }

    public function officer($user_id = NULL) {
        if ($user_id != NULL) {
            $user_result = $this->user_model->get_user($user_id);
            if ($user_result->num_rows() > 0) {
                $data = array(
                    'group_id' => $this->group_id,
                    'menu_id' => $this->menu_id,
                    'icon' => $this->accesscontrol->getIcon($this->group_id),
                    'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                    'css' => array('parsley.min.css'),
                    'js' => array('parsley.min.js'),
                    'data' => $this->user_model->getUserDepOff($user_id),
                    'user_fullname' => $user_result->row()->user_fullname,
                    'user_id' => $user_id,
                );
                $this->renderView('userofficer_view', $data);
            } else {
                redirect(base_url('user'));
            }
        } else {
            redirect(base_url('user'));
        }
    }

    public function add_userdepoff_modal() {
        $data = array(
            'user_id' => $this->input->post('user_id'),
        );
        $this->load->view('modal/userdepoff_add_modal', $data);
    }

    public function add_userdepoff() {
        $user_id = $this->input->post('user_id');
        $dep_off_id = $this->user_model->getdep_off($this->input->post('dep_id_pri'), $this->input->post('officer_id'))->row()->dep_off_id;
        $datadep_off = array(
            'user_id' => $user_id,
            'dep_off_id' => $dep_off_id,
            'user_dep_off_status_id' => 1,
            'user_dep_off_active_id' => 2,
        );
        $this->user_model->insert_user_dep_off($datadep_off);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มตำแหน่งงานผู้ใช้ระบบเรียบร้อย');
        redirect(base_url('user/officer/' . $user_id));
    }

    public function status1() {
        $data = array(
            'user_dep_off_status_id' => 1,
        );
        $this->user_model->update_user_dep_off($this->input->post('user_dep_off_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,สำเร็จ,อนุญาตสถานะ');
    }

    public function status2() {
        $data = array(
            'user_dep_off_status_id' => 2,
        );
        $this->user_model->update_user_dep_off($this->input->post('user_dep_off_id'), $data);
        $this->session->set_flashdata('flash_message', 'warning,สำเร็จ,ระงับสถานะ');
    }

    public function active() {
        $data = array(
            'user_dep_off_active_id' => 1,
        );
        $this->user_model->update_user_dep_off_active1($this->input->post('user_dep_off_id'), $data);
        $data2 = array(
            'user_dep_off_active_id' => 2,
        );
        $this->user_model->update_user_dep_off_active2($this->input->post('user_dep_off_id'), $this->input->post('user_id'), $data2);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,ตำแหน่งงานหลักสำเร็จ');
    }

    // password
    public function password_user_modal() {
        $data = array(
            'data' => $this->user_model->get_user($this->input->post('user_id'))->row()
        );
        $this->load->view('modal/user_password_modal', $data);
    }

    public function password_user() {
        if ($this->input->post('password_new') == $this->input->post('password_confirm')) {
            $data = array(
                'password' => hash('sha256', $this->input->post('username') . $this->input->post('password_new')),
                'user_update' => $this->libs->getdate()
            );
            $this->user_model->update_user($this->input->post('user_id'), $data);
            $datauser = $this->user_model->get_user($this->input->post('user_id'))->row();
            $datalog = array(
                'log_text' => 'เพิ่ม',
                'user_id' => $this->input->post('user_id'),
                'username' => $datauser->username,
                'password' => $datauser->password,
                'user_email' => $datauser->user_email,
                'user_citizen' => $datauser->user_citizen,
                'user_fullname' => $datauser->user_fullname,
                'user_address' => $datauser->user_address,
                'user_tel' => $datauser->user_tel,
                'user_image' => $datauser->user_image,
                'role_id' => $datauser->role_id,
                'user_status_id' => $datauser->user_status_id,
                'user_style' => $datauser->user_style,
                'user_activate' => $datauser->user_activate,
                'user_activate_code' => $datauser->user_activate_code,
                'user_line_token' => $datauser->user_line_token,
                'user_signature_path' => $datauser->user_signature_path,
                'public_key' => $datauser->public_key,
                'private_key' => $datauser->private_key,
                'pin_key' => $datauser->pin_key,
                'log_ip_address' => $this->input->ip_address(),
                'log_browser' => $this->getAgent(),
                'log_time' => $this->misc->getdate(),
            );
            $this->user_model->insert_loguser($datalog);
            $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขรหัสผ่านเรียบร้อยแล้ว');
        } else {
            $this->session->set_flashdata('flash_message', 'error,ทำรายการไม่สำเร็จ,ทำรายการไม่สำเร็จ');
        }
        redirect(base_url('user'));
    }

    function generatePublicKey($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function generatePrivateKey($length = 30) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getAgent() {
        $this->load->library('user_agent');
        $agent = $this->agent->browser() . '/' . $this->agent->version();
        $agent = $agent . ' ' . $this->agent->platform();
        $agent = $agent . ' ' . $this->agent->mobile();
        return $agent;
    }

    public function gen($info = null, $user = null) {
        echo $this->misc->generateSignature($info, $user);
    }

}
