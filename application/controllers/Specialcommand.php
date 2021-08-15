<?php

class Specialcommand extends CI_Controller {

    public $group_id = 11;
    public $menu_id = 29;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('specialcommand_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'data' => $this->specialcommand_model->getSpecialcommand()
        );
        $this->renderView('specialcommand_view', $data);
    }

    public function add_modal() {
        $this->load->view('modal/specialcommand_add_modal');
    }

    public function edit_modal() {
        $data = array(
            'data' => $this->specialcommand_model->getSpecialcommandById($this->input->post('special_command_id'))->row()
        );
        $this->load->view('modal/specialcommand_edit_modal', $data);
    }

    public function delete_modal() {
        $data = array(
            'data' => $this->specialcommand_model->getSpecialcommandById($this->input->post('special_command_id'))->row()
        );
        $this->load->view('modal/specialcommand_delete_modal', $data);
    }

    public function add() {
        $data = array(
            'special_command_name' => $this->input->post('special_command_name')
        );
        $this->specialcommand_model->insert($data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('specialcommand'));
    }

    public function edit() {
        $data = array(
            'special_command_name' => $this->input->post('special_command_name')
        );
        $this->specialcommand_model->update($this->input->post('special_command_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เเก้ไขข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('specialcommand'));
    }

    public function delete() {
        $this->specialcommand_model->delete($this->input->post('special_command_id'));
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,ลบข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('specialcommand'));
    }

    public function sortspecialcommand() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array(),
            'css_full' => array('plugin/nestable/nestable.css'),
            'js' => array(),
            'js_full' => array('plugin/nestable/jquery.nestable.js'),
            'data' => $this->specialcommand_model->getSpecialcommand()
        );
        $this->renderView('specialcommand_sort_view', $data);
    }

    public function editsortspecialcommand() {
        $count = 1;
        foreach ($this->input->post('list') as $row) {
            $data = array(
                'special_command_sort' => $count
            );
            $this->specialcommand_model->update($row['id'], $data);
            $count++;
        }
    }

}
