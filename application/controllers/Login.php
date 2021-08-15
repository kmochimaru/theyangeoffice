<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->session->userdata('islogin') == 1 && $this->accesscontrol->checkLogin($this->session->userdata('user_id'), $this->session->userdata('regenerate_login')) == 1) {
            redirect(base_url('main'));
        }
        $login_token = rand(100000, 999999);
        $this->session->set_userdata(array('login_token' => $login_token));
        $data = array(
            'title' => 'เข้าสู่ระบบ',
            'login_token' => $login_token
        );
        $this->load->view('login_view', $data);
    }

    public function doLogin() {
        if ($this->input->post('login_token') == $this->session->userdata('login_token')) {
            $username = $this->input->post('username_input');
            $password = $this->input->post('password_input');

            if ($username == '' || $password == '') {
                redirect(base_url('login'));
            }
            $result = $this->accesscontrol->getUserPass($username, hash('sha256', $username . $password));
            if ($result->num_rows() == 1) {
                $row = $result->row();
                if ($row->user_status_id == 1) {
                    if ($row->user_expire == NULL || date('Y-m-d') < $row->user_expire) {
//                    if ($row->user_activate == 1) {
                        $user_dep_off_id = $this->accesscontrol->getUserDepOff($row->user_id, 1);
                        $y = $this->accesscontrol->getYear(date('Y-m-d'))->row();
                        if ($user_dep_off_id->num_rows() == 1) {
                            $sessiondata = array(
                                'islogin' => 1,
                                'user_id' => $row->user_id,
                                'user_dep_off_id' => $user_dep_off_id->row()->user_dep_off_id,
                                'dep_off_id' => $user_dep_off_id->row()->dep_off_id,
                                'dep_id_pri' => $user_dep_off_id->row()->dep_id_pri,
                                'role_id' => $row->role_id,
                                'year_id' => $y->year_id,
                                'year' => $y->year,
                                'regenerate_login' => rand(100000, 999999)
                            );
                            $this->session->set_userdata($sessiondata);
                            $this->systemlog->addUserLogin($row->user_id, 'Login');
                            if ($this->systemlog->checkAddLogin($row->user_id) == 1) {
                                $this->systemlog->updateLoginCheck($row->user_id, $this->session->userdata('regenerate_login'));
                            } else {
                                $this->systemlog->addLoginCheck($row->user_id, $this->session->userdata('regenerate_login'));
                            }
                            redirect(base_url());
                        } else {
                            $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;ตำแหน่งงานหรือหน่วยงานถูกระงับการใช้งาน</div>');
                            redirect(base_url('login'));
                        }
//                    } else {
//                        $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-info-circle" style="color: #ffb22b;"></i>&nbsp;กรุณายืนยันตัวตนในอีเมลของท่าน</div>');
//                        redirect(base_url('login'));
//                    }
                    } else {
                        $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;User หมดอายุการใช้งาน</div>');
                        redirect(base_url('login'));
                    }
                } else if ($row->user_status_id == 0) {
                    $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #ffb22b;"><i class="fa fa-info-circle" style="color: #ffb22b;"></i>&nbsp;สถานะรอการตรวจสอบการสมัคร</div>');
                    redirect(base_url('login'));
                } else {
                    $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;User ระงับการใช้งาน</div>');
                    redirect(base_url('login'));
                }
            } else {
                $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;Username หรือ Password ไม่ถูกต้อง</div>');
                redirect(base_url('login'));
            }
        } else {
            $this->session->set_flashdata('flash_message', '<div class=""col-lg-12><span style="padding: 7px; font-size: 11px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;การเข้าสู่ระบบเกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง</span></div>');
            redirect(base_url('login'));
        }
    }

    public function logout_modal() {
        $this->load->view('modal/logout_modal');
    }

    public function logout() {
        if ($this->session->userdata('islogin') == 1) {
            $this->systemlog->addUserLogin($this->session->userdata('user_id'), 'Logout');
            $this->systemlog->deleteLoginCheck($this->session->userdata('user_id'));
        }
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }

    public function active() {
        $sessiondata = array(
            'user_dep_off_id' => $this->input->post('user_dep_off_id'),
            'dep_off_id' => $this->input->post('dep_off_id'),
            'dep_id_pri' => $this->input->post('dep_id_pri'),
        );
        $this->session->set_userdata($sessiondata);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เปลี่ยนตำแหน่งงานสำเร็จ');
    }

}
