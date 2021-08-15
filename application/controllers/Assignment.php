<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Assignment
 *
 * @author nut
 */
class Assignment extends CI_Controller {

    //put your code here13 47
    public $group_id = 13;
    public $menu_id = 47;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('assignment_model');
        $this->load->library('ajax_pagination');
    }
    
    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js'),
        );
        $this->renderView('assignment_view', $data);
    }
    
    public function ajax_pagination() {
        $filter = array(
            'year_id' => $this->input->post('year_id'),
            'work_user_status_id' => $this->input->post('work_user_status_id'),
            'searchtext' => $this->input->post('searchtext'),
            'priority_info_id' => $this->input->post('priority_info_id'),
            'book_group_id' => $this->input->post('book_group_id'),
        );
        $count = $this->assignment_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('assignment/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "', 'year_id' : '" . $this->input->post('year_id') . "', 'work_user_status_id' : '" . $this->input->post('work_user_status_id') . "', 'priority_info_id' : '" . $this->input->post('priority_info_id') . "', 'book_group_id' : '" . $this->input->post('book_group_id') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->assignment_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/assignment_pagination', $data);
    }

    public function detail($work_user_id) {
        $workusers = $this->assignment_model->getworkuser($work_user_id);
        if ($workusers->num_rows() > 0) {
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
                'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js'),
                'work_user_id' => $work_user_id,
                'workuser' => $workusers->row(),
                'data' => $this->assignment_model->getworkinfo($workusers->row()->work_info_id_pri)->row(),
            );
            $this->renderView('assignmentdetail_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('assignment'));
        }
    }
}
