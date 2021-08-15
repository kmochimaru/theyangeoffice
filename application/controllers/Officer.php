<?php

class Officer extends CI_Controller {

    public $group_id = 8;
    public $menu_id = 40;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('officer_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.min.css'),
            'js' => array('parsley.min.js'),
            'datas' => $this->officer_model->get_officer()
        );
        $this->renderView('officer_view', $data);
    }

    public function addofficer() {
        $data = array(
            'officer_name' => $this->input->post('officer_name'),
            'officer_name_display' => $this->input->post('officer_name_display'),
            'officer_level' => $this->input->post('officer_level'),
        );
        $this->officer_model->addofficer($data);
        redirect(base_url('officer'));
    }

    public function getofficer() {
        $officer = $this->officer_model->get_officer($this->input->post('officer_id'))->row();
        echo json_encode($officer);
    }

    public function editofficer() {
        $data = array(
            'officer_name' => $this->input->post('officer_name'),
            'officer_name_display' => $this->input->post('officer_name_display'),
            'officer_level' => $this->input->post('officer_level'),
        );
        $this->officer_model->editofficer($this->input->post('officer_id'), $data);
        redirect(base_url('officer'));
    }

    public function deleteofficer($id) {
        $this->officer_model->deleteofficer($id);
        redirect(base_url('officer'));
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
            'data' => $this->officer_model->get_officer()
        );
        $this->renderView('officer_sort_view', $data);
    }

    public function editsort() {
        $count = 1;
        foreach ($this->input->post('list') as $row) {
            $data = array(
                'officer_level' => $count
            );
            $this->officer_model->editofficer($row['id'], $data);
            $count++;
        }
    }

}
