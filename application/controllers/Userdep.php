<?php

class Userdep extends CI_Controller {

    public $group_id = 7;
    public $menu_id = 19;
//    public $per_page = 10;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('userdep_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.min.css'),
            'css_full' => array(),
            'js' => array('parsley.min.js'),
            'js_full' => array()
        );
        $this->renderView('userdep_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'searchtext' => $this->input->post('searchtext'),
            'officer_id' => $this->input->post('officer_id'),
            'per_page' => $this->input->post('per_page')
        );
        $count = $this->userdep_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('userdep/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->input->post('per_page');
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "', 'officer_id' : '" . $this->input->post('officer_id') . "', 'per_page' : '" . $this->input->post('per_page') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->userdep_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->input->post('per_page'))),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/userdep_pagination', $data);
    }

    public function add_userdep_modal() {
        $data = array(
            'data' => ''
        );
        $this->load->view('modal/userdep_add_modal', $data);
    }

    public function edit_userdep_modal() {
        $data = array(
            'data' => $this->userdep_model->get_user($this->input->post('user_id'))->row(),
            'dep' => $this->userdep_model->get_department()->row()
        );
        $this->load->view('modal/userdep_edit_modal', $data);
    }

    public function status_userdep_modal() {
        $data = array(
            'data' => $this->userdep_model->get_user_dep_off($this->input->post('user_dep_off_id'))->row()
        );
        $this->load->view('modal/userdep_status_modal', $data);
    }

    public function check_username() {
        $check = $this->userdep_model->check_username($this->input->post('username'));
        if ($check->num_rows() > 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function edit_userdep() {
        $data = array(
            'user_fullname' => $this->input->post('user_fullname'),
            'user_address' => $this->input->post('user_address'),
            'user_tel' => $this->input->post('user_tel'),
            'role_id' => $this->input->post('role_id'),
            'user_update' => $this->misc->getdate()
        );
        $this->userdep_model->update_user($this->input->post('user_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขผู้ใช้ระบบเรียบร้อยแล้ว');
        redirect(base_url('userdep'));
    }

    public function status_userdep() {
        $data = array(
            'user_dep_off_status_id' => $this->input->post('user_dep_off_status_id')
        );
        $this->userdep_model->update_user_dep_off($this->input->post('user_dep_off_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขผู้ใช้ระบบเรียบร้อยแล้ว');
        redirect(base_url('userdep'));
    }

}
