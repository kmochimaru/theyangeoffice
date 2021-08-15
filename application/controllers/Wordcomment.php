<?php

class Wordcomment extends CI_Controller {

    public $group_id = 11;
    public $menu_id = 84;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('wordcomment_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'data' => $this->wordcomment_model->getWordComment()
        );
        $this->renderView('wordcomment_view', $data);
    }

    public function add_modal() {
        $this->load->view('modal/wordcomment_add_modal');
    }

    public function edit_modal() {
        $data = array(
            'data' => $this->wordcomment_model->getWordCommentById($this->input->post('word_id'))->row()
        );
        $this->load->view('modal/wordcomment_edit_modal', $data);
    }

    public function delete_modal() {
        $data = array(
            'data' => $this->wordcomment_model->getWordCommentById($this->input->post('word_id'))->row()
        );
        $this->load->view('modal/wordcomment_delete_modal', $data);
    }

    public function add() {
        $data = array(
            'word_comment' => $this->input->post('word_comment')
        );
        $this->wordcomment_model->insert($data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('wordcomment'));
    }

    public function edit() {
        $data = array(
            'word_comment' => $this->input->post('word_comment')
        );
        $this->wordcomment_model->update($this->input->post('word_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เเก้ไขข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('wordcomment'));
    }

    public function delete() {
        $this->wordcomment_model->delete($this->input->post('word_id'));
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,ลบข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('wordcomment'));
    }

    public function sort() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array(),
            'css_full' => array('plugin/nestable/nestable.css'),
            'js' => array(),
            'js_full' => array('plugin/nestable/jquery.nestable.js'),
            'data' => $this->wordcomment_model->getWordComment()
        );
        $this->renderView('wordcomment_sort_view', $data);
    }

    public function editsort() {
        $count = 1;
        foreach ($this->input->post('list') as $row) {
            $data = array(
                'word_sort' => $count
            );
            $this->wordcomment_model->update($row['id'], $data);
            $count++;
        }
    }

}
