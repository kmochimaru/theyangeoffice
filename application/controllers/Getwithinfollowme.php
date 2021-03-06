<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Getwithinfollowme
 *
 * @author nut
 */
class Getwithinfollowme extends CI_Controller {

    //put your code here
    public $group_id = 10;
    public $menu_id = 52;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('getwithinfollowme_model');
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
        $this->renderView('getwithinfollowme_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'year_id' => $this->input->post('year_id'),
            'state_info_id' => $this->input->post('state_info_id'),
            'book_group_id' => $this->input->post('book_group_id'),
            'searchtext' => $this->input->post('searchtext'),
        );
        $count = $this->getwithinfollowme_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('getwithinfollowme/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "', 'year_id' : '" . $this->input->post('year_id') . "', 'state_info_id' : '" . $this->input->post('state_info_id') . "', 'book_group_id' : '" . $this->input->post('book_group_id') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->getwithinfollowme_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/getwithinfollowme_pagination', $data);
    }

    public function detail($work_info_code) {
        $workinfo = $this->getwithinfollowme_model->getworkinfocode($work_info_code);
        if ($workinfo->num_rows() > 0) {
            $row = $workinfo->row();
            if ($workinfo->row()->work_info_follow == 1) {
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
                $this->renderView('getwithinfollowmedetail_view', $data);
            } else {
                $this->session->set_flashdata('flash_message', 'error,??????????????????????????????????????????,????????????????????????????????????????????????????????????');
                redirect(base_url('getwithinfollowme'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,??????????????????????????????????????????,????????????????????????????????????????????????????????????');
            redirect(base_url('getwithinfollowme'));
        }
    }

    public function unfollow() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $workinfo = $this->getwithinfollowme_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() == 1) {
            if ($workinfo->row()->work_info_follow == 1) {
                $data = array(
                    'work_info_follow' => 0,
                    'work_info_update' => $this->misc->getdate(),
                );
                $this->getwithinfollowme_model->update_workinfo($work_info_id_pri, $data);
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

}
