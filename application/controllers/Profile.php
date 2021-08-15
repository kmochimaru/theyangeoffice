<?php

class Profile extends CI_Controller {

    public $menu_id = '';
    public $group_id = '';

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginNull();
        $this->load->model('profile_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-user',
            'title' => 'ประวัติส่วนตัว',
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/styleswitcher/jQuery.style.switcher.js'),
            'data' => $this->profile_model->getUser($this->session->userdata('user_id'))->row(),
            'data_dep_result' => $this->profile_model->getDepartment($this->session->userdata('dep_id_pri')),
            'data_loglogin' => $this->profile_model->getLoglogin($this->session->userdata('user_id')),
            'data_loguser' => $this->profile_model->getLogUser($this->session->userdata('user_id')),
            'data_userdepoff' => $this->profile_model->getUserDepOff($this->session->userdata('user_id')),
            'active' => "department",
        );
        $this->renderView('profile_view', $data);
    }

    public function officer() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-user',
            'title' => 'ประวัติส่วนตัว',
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/styleswitcher/jQuery.style.switcher.js'),
            'data' => $this->profile_model->getUser($this->session->userdata('user_id'))->row(),
            'data_dep_result' => $this->profile_model->getDepartment($this->session->userdata('dep_id_pri')),
            'data_loglogin' => $this->profile_model->getLoglogin($this->session->userdata('user_id')),
            'data_loguser' => $this->profile_model->getLogUser($this->session->userdata('user_id')),
            'data_userdepoff' => $this->profile_model->getUserDepOff($this->session->userdata('user_id')),
            'active' => "officer",
        );
        $this->renderView('profile_view', $data);
    }

    public function editprofile() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-user',
            'title' => 'ประวัติส่วนตัว',
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/styleswitcher/jQuery.style.switcher.js'),
            'data' => $this->profile_model->getUser($this->session->userdata('user_id'))->row(),
            'data_dep_result' => $this->profile_model->getDepartment($this->session->userdata('dep_id_pri')),
            'data_loguser' => $this->profile_model->getLogUser($this->session->userdata('user_id')),
            'data_loglogin' => $this->profile_model->getLoglogin($this->session->userdata('user_id')),
            'data_userdepoff' => $this->profile_model->getUserDepOff($this->session->userdata('user_id')),
            'active' => "profile",
        );
        $this->renderView('profile_view', $data);
    }

    public function loglogin() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-user',
            'title' => 'ประวัติส่วนตัว',
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/styleswitcher/jQuery.style.switcher.js'),
            'data' => $this->profile_model->getUser($this->session->userdata('user_id'))->row(),
            'data_dep' => $this->profile_model->getDepartment($this->session->userdata('dep_id_pri'))->row(),
            'data_loglogin' => $this->profile_model->getLoglogin($this->session->userdata('user_id')),
            'data_loguser' => $this->profile_model->getLogUser($this->session->userdata('user_id')),
            'data_userdepoff' => $this->profile_model->getUserDepOff($this->session->userdata('user_id')),
            'active' => "loglogin",
        );
        $this->renderView('profile_view', $data);
    }

    public function loguser() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-user',
            'title' => 'ประวัติส่วนตัว',
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/styleswitcher/jQuery.style.switcher.js'),
            'data' => $this->profile_model->getUser($this->session->userdata('user_id'))->row(),
            'data_dep' => $this->profile_model->getDepartment($this->session->userdata('dep_id_pri'))->row(),
            'data_loglogin' => $this->profile_model->getLoglogin($this->session->userdata('user_id')),
            'data_loguser' => $this->profile_model->getLogUser($this->session->userdata('user_id')),
            'data_userdepoff' => $this->profile_model->getUserDepOff($this->session->userdata('user_id')),
            'active' => "loguser",
        );
        $this->renderView('profile_view', $data);
    }

    public function edit() {
        $data = array(
            'user_fullname' => $this->input->post('user_fullname'),
            'user_address' => $this->input->post('user_address'),
            'user_tel' => $this->input->post('user_tel'),
            'user_update' => $this->misc->getdate()
        );
        $this->profile_model->edit($this->session->userdata('user_id'), $data);
        $datauser = $this->profile_model->getUser($this->session->userdata('user_id'))->row();
        $datalog = array(
            'log_text' => 'แก้ไขข้อมูล',
            'user_id' => $this->session->userdata('user_id'),
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
        $this->profile_model->insert_loguser($datalog);
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        redirect(base_url() . 'profile/editprofile');
    }

    public function upload_image() {
        $this->load->library('upload');
        $user_id = $this->session->userdata('user_id');
        $config = array(
            'upload_path' => "./assets/upload/user/",
            'allowed_types' => 'jpg|jpeg|gif|png',
            'overwrite' => 1,
            'max_size' => 8192,
            'file_name' => 'profile_' . $user_id . '_' . date('YmdHis')
        );
        $this->upload->initialize($config);

        foreach ($_FILES as $key) {
            $name_type = explode('.', $key['name']);
            if (!(preg_match("/^[a-zA-Z0-9\_\-]+$/", $name_type[0]))) {
                $key['name'] = "abc." . $name_type[1];
            }
            $_FILES['image']['name'] = $key['name'];
            $_FILES['image']['type'] = $key['type'];
            $_FILES['image']['tmp_name'] = $key['tmp_name'];
            $_FILES['image']['size'] = $key['size'];

            $json = array();
            if ($this->upload->do_upload('image')) {
                $config_resize['source_image'] = $this->upload->upload_path . $this->upload->file_name;
                $config_resize['maintain_ratio'] = TRUE;
                $config_resize['width'] = 400;
                $config_resize['height'] = 400;
                $this->load->library('image_lib', $config_resize);
                if ($this->upload->image_width > 400 || $this->upload->image_height > 400) {
                    $this->image_lib->resize();
                }
                $photo = $this->profile_model->getphoto($user_id);
                if ($photo != '' && $photo != 'none.png') {
                    @unlink('assets/upload/user/' . $photo);
                }
                $data = $this->upload->data();

                $data_user = array(
                    'user_image' => $data['file_name'],
                    'user_update' => $this->misc->getDate()
                );
                $this->profile_model->edit($user_id, $data_user);
                $datauser = $this->profile_model->getUser($this->session->userdata('user_id'))->row();
                $datalog = array(
                    'log_text' => 'อัพโหลดรูป',
                    'user_id' => $this->session->userdata('user_id'),
                    'username' => $datauser->username,
//                    'password' => $datauser->password,
                    'user_email' => $datauser->user_email,
                    'user_citizen' => $datauser->user_citizen,
                    'user_fullname' => $datauser->user_fullname,
                    'user_address' => $datauser->user_address,
                    'user_tel' => $datauser->user_tel,
                    'user_image' =>  $data['file_name'],
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
                $this->profile_model->insert_loguser($datalog);
                $json['file_name'] = $this->upload->data('file_name');
                $json['error'] = FALSE;
            } else {
                $json['file_name'] = '';
                $json['error'] = TRUE;
            }
        }
        echo json_encode($json);
    }

    public function upload_image_signature() {
        $this->load->library('upload');
        $user_id = $this->session->userdata('user_id');
        $config = array(
            'upload_path' => "./assets/upload/signature/",
            'allowed_types' => 'jpg|jpeg|gif|png',
            'overwrite' => 1,
            'max_size' => 8192,
            'file_name' => 'signature_' . $user_id . '_' . date('YmdHis')
        );
        $this->upload->initialize($config);

        foreach ($_FILES as $key) {
            $name_type = explode('.', $key['name']);
            if (!(preg_match("/^[a-zA-Z0-9\_\-]+$/", $name_type[0]))) {
                $key['name'] = "abc." . $name_type[1];
            }
            $_FILES['image']['name'] = $key['name'];
            $_FILES['image']['type'] = $key['type'];
            $_FILES['image']['tmp_name'] = $key['tmp_name'];
            $_FILES['image']['size'] = $key['size'];

            $json = array();
            if ($this->upload->do_upload('image')) {
                $config_resize['source_image'] = $this->upload->upload_path . $this->upload->file_name;
                $config_resize['maintain_ratio'] = TRUE;
                $config_resize['width'] = 600;
                $config_resize['height'] = 150;
                $this->load->library('image_lib', $config_resize);
                if ($this->upload->image_width > 600 || $this->upload->image_height > 150) {
                    $this->image_lib->resize();
                }
                $photo = $this->profile_model->getphotosignature($user_id);
                if ($photo != '' && $photo != 'none.png') {
                    //@unlink('assets/upload/signature/' . $photo);
                }
                $data = $this->upload->data();

                $data_user = array(
                    'user_signature_path' => $data['file_name'],
                    'user_update' => $this->misc->getDate()
                );
                $this->profile_model->edit($user_id, $data_user);
                $datauser = $this->profile_model->getUser($this->session->userdata('user_id'))->row();
                $datalog = array(
                    'log_text' => 'อัพโหลดลายเซ็น',
                    'user_id' => $this->session->userdata('user_id'),
                    'username' => $datauser->username,
//                    'password' => $datauser->password,
                    'user_email' => $datauser->user_email,
                    'user_citizen' => $datauser->user_citizen,
                    'user_fullname' => $datauser->user_fullname,
                    'user_address' => $datauser->user_address,
                    'user_tel' => $datauser->user_tel,
                    'user_image' =>  $datauser->user_image,
                    'role_id' => $datauser->role_id,
                    'user_status_id' => $datauser->user_status_id,
                    'user_style' => $datauser->user_style,
                    'user_activate' => $datauser->user_activate,
                    'user_activate_code' => $datauser->user_activate_code,
                    'user_line_token' => $datauser->user_line_token,
                    'user_signature_path' =>  $data['file_name'],
                    'public_key' => $datauser->public_key,
                    'private_key' => $datauser->private_key,
                    'pin_key' => $datauser->pin_key,
                    'log_ip_address' => $this->input->ip_address(),
                    'log_browser' => $this->getAgent(),
                    'log_time' => $this->misc->getdate(),
                );
                $this->profile_model->insert_loguser($datalog);
                $json['file_name'] = $this->upload->data('file_name');
                $json['error'] = FALSE;
            } else {
                $json['file_name'] = '';
                $json['error'] = TRUE;
            }
        }
        echo json_encode($json);
    }

    public function line() {
        $code = $this->input->get('code');
        $postdata = http_build_query(
            array(
                'grant_type' => 'authorization_code',
                'code' => $code,
                'client_id' => $this->config->item('line_id'),
                'client_secret' => $this->config->item('line_key'),
                'redirect_uri' => base_url('profile/line'),
            )
        );
        $url = 'https://notify-bot.line.me/oauth/token'; //'https://api.line.me/v2/oauth/accessToken';
        $opts = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
        // print_r($result);
        $access_token_decode = json_decode($result);
        $access_token = $access_token_decode->{'access_token'};
        $data = array(
            'user_line_token' => $access_token,
        );
        $this->profile_model->edit($this->session->userdata('user_id'), $data);
//        $datauser = $this->profile_model->getUser($this->session->userdata('user_id'))->row();
        $datalog = array(
            'log_text' => 'เชื่อมต่อไลน์',
            'user_id' => $this->session->userdata('user_id'),            
            'log_ip_address' => $this->input->ip_address(),
            'log_browser' => $this->getAgent(),
            'log_time' => $this->misc->getdate(),
        );
        $this->profile_model->insert_loguser($datalog);
        $message = "\nยินดีต้อนรับ เข้าสู่ระบบแจ้งเตือน " . $this->config->item('app_description');
        $opts = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n" . 'Authorization: Bearer ' . $access_token,
                'content' => 'message=' . $message
            )
        );
        $context = stream_context_create($opts);
        if (file_get_contents('https://notify-api.line.me/api/notify', false, $context)) {
            redirect(base_url() . 'profile');
        } else {
            redirect(base_url() . 'profile');
        }
    }

    public function unregisline() {
        $data = array(
            'user_line_token' => NULL,
            'user_update' => $this->misc->getdate()
        );
        $this->profile_model->edit($this->session->userdata('user_id'), $data);
        $datalog = array(
            'log_text' => 'ยกเลิกการเชื่อมไลน์',
            'user_id' => $this->session->userdata('user_id'),            
            'log_ip_address' => $this->input->ip_address(),
            'log_browser' => $this->getAgent(),
            'log_time' => $this->misc->getdate(),
        );
        $this->profile_model->insert_loguser($datalog);
        $this->session->set_flashdata('flash_message', 'success,Success,ยกเลิกการเชื่อมไลน์เรียบร้อยเเล้ว');
        redirect(base_url() . 'profile');
    }
    
    public function unregisline_modal() {
        $this->load->view('modal/profile_unregisline_modal');
    }
    
    public function getAgent() {
        $this->load->library('user_agent');
        $agent = $this->agent->browser() . '/' . $this->agent->version();
        $agent = $agent . ' ' . $this->agent->platform();
        $agent = $agent . ' ' . $this->agent->mobile();
        return $agent;
    }

    public function modaleditpin() {
        $data = array(
            'username' => $this->profile_model->getUser($this->session->userdata('user_id'))->row()->username,
        );
        $this->load->view('modal/profile_edit_pin_modal', $data);
    }

    public function editPin() {
        if (!empty($this->input->post('password')) && !empty($this->input->post('newpin')) && !empty($this->input->post('confirmpin'))) {
            $user_id = $this->session->userdata('user_id');
            $username = $this->profile_model->getUser($this->session->userdata('user_id'))->row()->username;
            $password = hash('sha256', $username . $this->input->post('password'));
            $checkpassword = $this->profile_model->checkPassword($user_id, $password);
            if ($checkpassword->num_rows() == 1) {
                $newpin = $this->input->post('newpin');
                $confirmpin = $this->input->post('confirmpin');
                if ($newpin == $confirmpin) {
                    $data = array(
                        'pin_key' => hash('sha256', $user_id . $newpin),
                    );
                    $this->profile_model->edit($user_id, $data);
                    $datauser = $this->profile_model->getUser($this->session->userdata('user_id'))->row();
                    $datalog = array(
                        'log_text' => 'แก้ไขรหัส PIN',
                        'user_id' => $this->session->userdata('user_id'),
                        'username' => $datauser->username,
//                        'password' => $datauser->password,
                        'user_email' => $datauser->user_email,
                        'user_citizen' => $datauser->user_citizen,
                        'user_fullname' => $datauser->user_fullname,
                        'user_address' => $datauser->user_address,
                        'user_tel' => $datauser->user_tel,
                        'user_image' =>  $datauser->user_image,
                        'role_id' => $datauser->role_id,
                        'user_status_id' => $datauser->user_status_id,
                        'user_style' => $datauser->user_style,
                        'user_activate' => $datauser->user_activate,
                        'user_activate_code' => $datauser->user_activate_code,
                        'user_line_token' => $datauser->user_line_token,
                        'user_signature_path' =>  $datauser->user_signature_path,
                        'public_key' => $datauser->public_key,
                        'private_key' => $datauser->private_key,
                        //'pin_key' => $datauser->pin_key,
                        'pin_key' => hash('sha256', $user_id . $newpin),
                        'log_ip_address' => $this->input->ip_address(),
                        'log_browser' => $this->getAgent(),
                        'log_time' => $this->misc->getdate(),
                    );
                    $this->profile_model->insert_loguser($datalog);
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo 2;
            }
        }
    }
    
    public function modalEditPassword() {
        $data = array(
            'username' => $this->input->post('username')
        );
        $this->load->view('modal/profile_edit_password_modal', $data);
    }

    public function editPassword() {
        $user_id = $this->session->userdata('user_id');
        $username = $this->input->post('username');
        $newpassword = $this->input->post('newpassword');

        $password = hash('sha256', $username . $this->input->post('oldpassword'));
        $checkpassword = $this->profile_model->checkPassword($user_id, $password);
        if ($checkpassword->num_rows() == 1) {
            if ($newpassword == $this->input->post('confirmpassword')) {
                $data = array(
                    'password' => hash('sha256', $username . $newpassword),
                );
                $this->profile_model->edit($user_id, $data);
                echo 1;
            } else {
                echo 3;
            }
        } else {
            echo 2;
        }
    }
    
}
