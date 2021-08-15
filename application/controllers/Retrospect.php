<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Without
 *
 * @author nut
 */
class Retrospect extends CI_Controller {

    //put your code here
    public $group_id = 23;
    public $menu_id = 81;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('retrospect_model');
    }

    public function index() {
        if ($this->retrospect_model->checkDepartmentyear($this->session->userdata('dep_id_pri'))->num_rows() == 1) {
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/select2/dist/css/select2.min.css', 'plugin/datepicker/datepicker.css'),
                'js_full' => array('plugin/select2/dist/js/select2.full.min.js', 'plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js'),
            );
            $this->renderView('retrospect_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาดร้ายแรง,กรุณาติดต่อ Admin');
            redirect(base_url());
        }
    }

    public function add() {
        if ($this->input->post('work_info_no') != null) {
            $year = explode('-', $this->input->post('work_info_date'));
            $year = ($year[0] + 543);
            $year_id = 1;
            $checkyear = $this->retrospect_model->year($year);
            if ($checkyear->num_rows() == 1) {
                $year_id = $checkyear->row()->year_id;
            }
            $data = array(
                'year_id' => $year_id,
                'work_info_id' => $this->input->post('work_info_id'),
                'work_info_no' => $this->input->post('work_info_no'),
                'work_type_id' => $this->input->post('work_type_id'),
                'user_id' => $this->session->userdata('user_id'),
                'dep_id_pri' => $this->session->userdata('dep_id_pri'),
                'dep_off_id' => $this->session->userdata('dep_off_id'),
                'work_info_date' => $this->input->post('work_info_date'),
                'work_info_from_position' => $this->input->post('work_info_from_position'),
                'work_info_from' => $this->input->post('work_info_from'),
                'work_info_to_position' => $this->input->post('work_info_to_position'),
                'work_info_to' => $this->input->post('work_info_to'),
                'work_info_subject' => $this->input->post('work_info_subject'),
                'work_info_detail' => $this->input->post('work_info_detail'),
                'work_info_comment' => $this->input->post('work_info_comment'),
                'work_info_follow' => 0,
                'secret_level_id' => $this->input->post('secret_level_id'),
                'priority_info_id' => $this->input->post('priority_info_id'),
                'action_info_id' => $this->input->post('action_info_id'),
                'state_info_id' => 2,
                'book_group_id' => $this->input->post('book_group_id'),
                'attach_original' => 0,
                'work_info_retrospect' => 1,
                'work_info_create' => $this->misc->getdate(),
                'work_info_update' => $this->misc->getdate()
            );
            $work_info_id_pri = $this->retrospect_model->insert_workinfo($data);
            if ($work_info_id_pri > 0) {
                $data = array(
                    'work_info_code' => $year . $this->session->userdata('dep_id_pri') . $work_info_id_pri . date('YmdHis'),
                );
                $this->retrospect_model->update_workinfo($work_info_id_pri, $data);
                $text = 'บันทึกหนังสือย้อนหลัง';
                $this->systemlog->log_work_info($text, $work_info_id_pri);
            }
            $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลเรียบร้อยแล้ว');
            redirect(base_url('retrospectlist/attach/' . $work_info_id_pri));
        }
        $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
        redirect(base_url('retrospect'));
    }

    public function ajax_page() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $data = array(
            'datas' => $this->retrospect_model->get_workinfofile($work_info_id_pri),
        );
        $this->load->view('ajax/retrospect_page', $data);
    }

    public function to_modal() {
        $this->load->view('modal/retrospect_to_modal');
    }
}
