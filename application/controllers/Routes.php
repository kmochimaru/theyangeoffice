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
class Routes extends CI_Controller {

    //put your code here
    public $group_id = 7;
    public $menu_id = 41;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('routes_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'datas' => $this->routes_model->get_routes(),
            'css' => array('parsley.min.css'),
            'js' => array('parsley.min.js'),
        );
        $this->renderView('routes_view', $data);
    }

    public function addroutes() {
        $data = array(
            'routes_name' => $this->input->post('routes_name'),
            'dep_id_pri' => $this->session->userdata('dep_id_pri'),
            'routes_status_id' => 1,
            'routes_modify' => $this->misc->getdate()
        );
        $this->routes_model->addroutes($data);
        redirect(base_url('routes'));
    }

    public function getroutes() {
        $routes = $this->routes_model->get_routes($this->input->post('routes_id'))->row();
        echo json_encode($routes);
    }

    public function editroutes() {
        $data = array(
            'routes_name' => $this->input->post('routes_name'),
            'routes_status_id' => $this->input->post('routes_status_id'),
            'routes_modify' => $this->misc->getdate()
        );
        $this->routes_model->editroutes($this->input->post('routes_id'), $data);
        redirect(base_url('routes'));
    }

    public function deleteroutes($id) {
        $this->routes_model->deleteroutes($id);
        redirect(base_url('routes'));
    }

    public function set($routes_id) {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => 'กำหนดเส้นทาง',
            'routes_id' => $routes_id,
            'routes' => $this->routes_model->get_routes($routes_id)->row(),
            'css_full' => array('plugin/nestable/nestable.css', 'plugin/select2/dist/css/select2.min.css'),
            'js_full' => array('plugin/nestable/jquery.nestable.js', 'plugin/select2/dist/js/select2.full.min.js')
        );
        $this->renderView('routesset_view', $data);
    }

    public function ajax_page() {
        $routes_id = $this->input->post('routes_id');
        $dep_id_pri = $this->input->post('dep_id_pri');
        $data = array(
            'data' => $this->routes_model->get_routes($routes_id),
            'routes_id' => $routes_id,
            'dep_id_pri' => $dep_id_pri,
        );
        $this->load->view('ajax/routes_page', $data);
    }

    public function ajax_sort() {
        $routes_id = $this->input->post('routes_id');
        $data = array(
            'data' => $this->routes_model->get_routes($routes_id),
            'routes_id' => $routes_id,
        );
        $this->load->view('ajax/routes_sort_page', $data);
    }

    public function add() {
        $data = array(
            'routes_id' => $this->input->post('routes_id'),
            'dep_off_id' => $this->input->post('dep_off_id'),
            'routes_process_sort' => $this->routes_model->get_last($this->input->post('routes_id'))->row()->routes_process_sort + 1,
        );
        $this->routes_model->addroutesprocess($data);
    }

    public function delete() {
        $routes_id = $this->input->post('routes_id');
        $dep_off_id = $this->input->post('dep_off_id');
        $this->routes_model->deleteroutesprocess($routes_id, $dep_off_id);
    }

    public function editsort() {
        $count = 1;
        foreach ($this->input->post('list') as $row) {
            $data = array(
                'routes_process_sort' => $count
            );
            $this->routes_model->editroutesprocess($row['id'], $data);
            $count++;
        }
    }

    public function routesprocess() {
        $routes = $this->routes_model->get_routes_process($this->input->post('routes_id'))->row();
        echo json_encode($routes);
    }

    public function send_page() {
        $data = array(
            'routes_id' => null,
        );
        $this->load->view('ajax/routessend_page', $data);
    }

    public function routes_page() {
        $data = array(
            'routes_id' => $this->input->post('routes_id')
        );
        $this->load->view('ajax/routessend_page', $data);
    }

}
