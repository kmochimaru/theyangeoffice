<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Routes
 *
 * @author nut
 */
class Groupdep extends CI_Controller {

    //put your code here
    public $group_id = 7;
    public $menu_id = 74;

    public function __construct() {
        parent::__construct();
        // $this->auth->isLogin($this->menu_id);
        $this->load->model('groupdep_model');
    }

    public function index() {
        $this->auth->isLogin($this->menu_id);
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'datas' => $this->groupdep_model->get_groupdep(),
            'css' => array('parsley.min.css'),
            'js' => array('parsley.min.js'),
        );
        $this->renderView('groupdep_view', $data);
    }

    public function addgroupdep() {
        $data = array(
            'groupdep_name' => $this->input->post('groupdep_name'),
            'dep_id_pri' => $this->session->userdata('dep_id_pri'),
            'groupdep_status_id' => 1,
            'groupdep_modify' => $this->misc->getdate()
        );
        $this->groupdep_model->addgroupdep($data);
        redirect(base_url('groupdep'));
    }

    public function getgroupdep() {
        $groupdep = $this->groupdep_model->get_groupdep($this->input->post('groupdep_id'))->row();
        echo json_encode($groupdep);
    }

    public function editgroupdep() {
        $data = array(
            'groupdep_name' => $this->input->post('groupdep_name'),
            'groupdep_status_id' => $this->input->post('groupdep_status_id'),
            'groupdep_modify' => $this->misc->getdate()
        );
        $this->groupdep_model->editgroupdep($this->input->post('groupdep_id'), $data);
        redirect(base_url('groupdep'));
    }

    public function deletegroupdep($id) {
        $this->groupdep_model->deletegroupdep($id);
        redirect(base_url('groupdep'));
    }

    public function set($groupdep_id) {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => 'กำหนดกลุ่มหน่วยงาน',
            'groupdep_id' => $groupdep_id,
            'groupdep' => $this->groupdep_model->get_groupdep($groupdep_id)->row(),
            'css_full' => array('plugin/nestable/nestable.css', 'plugin/select2/dist/css/select2.min.css'),
            'js_full' => array('plugin/nestable/jquery.nestable.js', 'plugin/select2/dist/js/select2.full.min.js')
        );
        $this->renderView('groupdepset_view', $data);
    }

    public function ajax_page() {
        $groupdep_id = $this->input->post('groupdep_id');
        $dep_id_pri = $this->input->post('dep_id_pri');
        $data = array(
            'data' => $this->groupdep_model->get_groupdep($groupdep_id),
            'groupdep_id' => $groupdep_id,
            'dep_id_pri' => $dep_id_pri,
        );
        $this->load->view('ajax/groupdep_page', $data);
    }

    public function ajax_sort() {
        $groupdep_id = $this->input->post('groupdep_id');
        $data = array(
            'data' => $this->groupdep_model->get_groupdep($groupdep_id),
            'groupdep_id' => $groupdep_id,
        );
        $this->load->view('ajax/groupdep_sort_page', $data);
    }

    public function add() {
        $data = array(
            'groupdep_id' => $this->input->post('groupdep_id'),
            'dep_off_id' => $this->input->post('dep_off_id'),
            'groupdep_process_sort' => $this->groupdep_model->get_last($this->input->post('groupdep_id'))->row()->groupdep_process_sort + 1,
        );
        $this->groupdep_model->addgroupdepprocess($data);
    }

    public function delete() {
        $groupdep_id = $this->input->post('groupdep_id');
        $dep_off_id = $this->input->post('dep_off_id');
        $this->groupdep_model->deletegroupdepprocess($groupdep_id, $dep_off_id);
    }

    public function editsort() {
        $count = 1;
        foreach ($this->input->post('list') as $row) {
            $data = array(
                'groupdep_process_sort' => $count
            );
            $this->groupdep_model->editgroupdepprocess($row['id'], $data);
            $count++;
        }
    }

    public function groupdepprocess() {
        $groupdep = $this->groupdep_model->get_groupdep_process($this->input->post('groupdep_id'))->row();
        echo json_encode($groupdep);
    }

    public function send_page() {
        $data = array(
            'groupdep_id' => null,
            'work_info_id_pri' =>  $this->input->post('work_info_id_pri')
        );
        $this->load->view('ajax/groupdepsend_page', $data);
    }

    public function groupdep_page() {
        $data = array(
            'groupdep_id' => $this->input->post('groupdep_id'),
        );
        $this->load->view('ajax/groupdepsend_page', $data);
    }
}
