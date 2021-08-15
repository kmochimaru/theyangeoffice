<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of News
 *
 * @author nut
 */
class News extends CI_Controller {

    //put your code here
    public $group_id = 12;
    public $menu_id = 56;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('news_model');
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
        $this->renderView('news_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'year_id' => $this->input->post('year_id'),
            'status_id' => $this->input->post('status_id'),
            'searchtext' => $this->input->post('searchtext'),
            'priority_info_id' => $this->input->post('priority_info_id'),
            'book_group_id' => $this->input->post('book_group_id'),
        );
        $count = $this->news_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('news/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "', 'year_id' : '" . $this->input->post('year_id') . "', 'status_id' : '" . $this->input->post('status_id') . "', 'priority_info_id' : '" . $this->input->post('priority_info_id') . "', 'book_group_id' : '" . $this->input->post('book_group_id') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->news_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/news_pagination', $data);
    }

    public function detail($work_info_code) {
        $workinfo = $this->news_model->getworkinfocode($work_info_code);
        if ($workinfo->num_rows() > 0) {
            $row = $workinfo->row();
            $checks = $this->news_model->get_lognews($row->work_info_id_pri);
            if ($checks->num_rows() == 0) {
                $this->systemlog->log_news($row->work_info_id_pri);
            }
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
                'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js'),
                'work_info_id_pri' => $row->work_info_id_pri,
                'data' => $row,
            );
            $this->renderView('newsdetail_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('news'));
        }
    }

}
