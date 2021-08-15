<?php

class Logworkinfomanage extends CI_Controller {
    public $group_id = 9;
    public $menu_id = 79;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('logworkinfomanage_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css_full' => array(
                'plugin/datepicker/datepicker.css'
            ),
            'css' => array(),
            'js_full' => array(
                'plugin/datepicker/bootstrap-datepicker.js',
                'plugin/datepicker/bootstrap-datepicker-thai.js',
                'plugin/datepicker/bootstrap-datepicker.th.js'
            ),
            'js' => array()
        );
        $this->renderView('logworkinfomanage_view', $data);
    }

    public function getPagination() {
        $filter = array(
            'start' => $this->input->post('start'),
            'end' => $this->input->post('end'),
            'search' => $this->input->post('search')
        );
        $count = $this->logworkinfomanage_model->getPagination($filter, array());
        $config['div'] = 'result_pagination';
        $config['base_url'] = base_url('logworkinfomanage/getpagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = $this->libs->filterParams($filter);
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->logworkinfomanage_model->getPagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/logworkinfomanage_pagination', $data);
    }

    public function getLogDetail() {
        $get_modal = $this->logworkinfomanage_model->getLogDetail($this->input->post('log_id'));
        if ($get_modal->num_rows() == 1) {
            $data = array(
                'data' => $get_modal->row()
            );
            $this->load->view('modal/logworkinfomanage_modal', $data);
        }
    }
}
