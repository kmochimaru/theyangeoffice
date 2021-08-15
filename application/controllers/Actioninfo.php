<?php

class Actioninfo extends CI_Controller {

    public $group_id = 11;
    public $menu_id = 27;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('actioninfo_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'data' => $this->actioninfo_model->getActioninfo()
        );
        $this->renderView('actioninfo_view', $data);
    }

    public function add_modal() {
        $this->load->view('modal/actioninfo_add_modal');
    }

    public function edit_modal() {
        $data = array(
            'data' => $this->actioninfo_model->getActioninfoById($this->input->post('action_info_id'))->row()
        );
        $this->load->view('modal/actioninfo_edit_modal', $data);
    }

    public function delete_modal() {
        $data = array(
            'data' => $this->actioninfo_model->getActioninfoById($this->input->post('action_info_id'))->row()
        );
        $this->load->view('modal/actioninfo_delete_modal', $data);
    }

    public function add() {
        $data = array(
            'action_info_name' => $this->input->post('action_info_name')
        );
        $this->actioninfo_model->insert($data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('actioninfo'));
    }

    public function edit() {
        $data = array(
            'action_info_name' => $this->input->post('action_info_name')
        );
        $this->actioninfo_model->update($this->input->post('action_info_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เเก้ไขข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('actioninfo'));
    }

    public function delete() {
        $this->actioninfo_model->delete($this->input->post('action_info_id'));
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,ลบข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('actioninfo'));
    }

    public function sortactioninfo() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array(),
            'css_full' => array('plugin/nestable/nestable.css'),
            'js' => array(),
            'js_full' => array('plugin/nestable/jquery.nestable.js'),
            'data' => $this->actioninfo_model->getActioninfo()
        );
        $this->renderView('actioninfo_sort_view', $data);
    }

    public function editsortactioninfo() {
        $count = 1;
        foreach ($this->input->post('list') as $row) {
            $data = array(
                'action_info_sort' => $count
            );
            $this->actioninfo_model->update($row['id'], $data);
            $count++;
        }
    }

}
