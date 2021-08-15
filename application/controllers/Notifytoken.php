<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notifytoken
 *
 * @author nut
 */
class Notifytoken extends CI_Controller {

    //put your code here
    public $group_id = 17;
    public $menu_id = 59;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('notifytoken_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css_full' => array('plugin/select2/dist/css/select2.min.css'),
            'js_full' => array('plugin/select2/dist/js/select2.full.min.js')
        );
        $this->renderView('notifytoken_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'dep_id_pri' => $this->input->post('dep_id_pri'),
            'role_id' => $this->input->post('role_id'),
            'status_id' => $this->input->post('status_id'),
            'searchtext' => $this->input->post('searchtext'),
        );
        $count = $this->notifytoken_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('notifytoken/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "', 'dep_id_pri' : '" . $this->input->post('dep_id_pri') . "', 'role_id' : '" . $this->input->post('role_id') . "', 'status_id' : '" . $this->input->post('status_id') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->notifytoken_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/notifytoken_pagination', $data);
    }

}
