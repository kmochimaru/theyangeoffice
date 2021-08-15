<?php

class Doctype extends CI_Controller {

    public $group_id = 11;
    public $menu_id = 30;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('doctype_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'data' => $this->doctype_model->getDoctype()
        );
        $this->renderView('doctype_view', $data);
    }

    public function add_modal() {
        $this->load->view('modal/doctype_add_modal');
    }

    public function edit_modal() {
        $data = array(
            'data' => $this->doctype_model->getDoctypeById($this->input->post('doc_type_id'))->row()
        );
        $this->load->view('modal/doctype_edit_modal', $data);
    }

    public function delete_modal() {
        $data = array(
            'data' => $this->doctype_model->getDoctypeById($this->input->post('doc_type_id'))->row()
        );
        $this->load->view('modal/doctype_delete_modal', $data);
    }

    public function add() {
        $data = array(
            'doc_type_name' => $this->input->post('doc_type_name')
        );
        $this->doctype_model->insert($data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('doctype'));
    }

    public function edit() {
        $data = array(
            'doc_type_name' => $this->input->post('doc_type_name')
        );
        $this->doctype_model->update($this->input->post('doc_type_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เเก้ไขข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('doctype'));
    }

    public function delete() {
        $this->doctype_model->delete($this->input->post('doc_type_id'));
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,ลบข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('doctype'));
    }

    public function sortdoctype() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array(),
            'css_full' => array('plugin/nestable/nestable.css'),
            'js' => array(),
            'js_full' => array('plugin/nestable/jquery.nestable.js'),
            'data' => $this->doctype_model->getDoctype()
        );
        $this->renderView('doctype_sort_view', $data);
    }

    public function editsortsortdoctype() {
        $count = 1;
        foreach ($this->input->post('list') as $row) {
            $data = array(
                'doc_type_sort' => $count
            );
            $this->doctype_model->update($row['id'], $data);
            $count++;
        }
    }

}
