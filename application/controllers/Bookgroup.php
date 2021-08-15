<?php

class Bookgroup extends CI_Controller {

    public $group_id = 11;
    public $menu_id = 28;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('bookgroup_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'data' => $this->bookgroup_model->getBookGroup()
        );
        $this->renderView('bookgroup_view', $data);
    }

    public function add_modal() {
        $this->load->view('modal/bookgroup_add_modal');
    }

    public function edit_modal() {
        $data = array(
            'data' => $this->bookgroup_model->getBookGroupById($this->input->post('book_group_id'))->row()
        );
        $this->load->view('modal/bookgroup_edit_modal', $data);
    }

    public function delete_modal() {
        $data = array(
            'data' => $this->bookgroup_model->getBookGroupById($this->input->post('book_group_id'))->row()
        );
        $this->load->view('modal/bookgroup_delete_modal', $data);
    }

    public function add() {
        $data = array(
            'book_group_name' => $this->input->post('book_group_name')
        );
        $this->bookgroup_model->insert($data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('bookgroup'));
    }

    public function edit() {
        $data = array(
            'book_group_name' => $this->input->post('book_group_name')
        );
        $this->bookgroup_model->update($this->input->post('book_group_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เเก้ไขข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('bookgroup'));
    }

    public function delete() {
        $this->bookgroup_model->delete($this->input->post('book_group_id'));
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,ลบข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('bookgroup'));
    }
    
        public function sortbookgroup() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array(),
            'css_full' => array('plugin/nestable/nestable.css'),
            'js' => array(),
            'js_full' => array('plugin/nestable/jquery.nestable.js'),
            'data' => $this->bookgroup_model->getBookGroup()
        );
        $this->renderView('bookgroup_sort_view', $data);
    }

    public function editsortbookgroup() {
        $count = 1;
        foreach ($this->input->post('list') as $row) {
            $data = array(
                'book_group_sort' => $count
            );
            $this->bookgroup_model->update($row['id'], $data);
            $count++;
        }
    }

}
