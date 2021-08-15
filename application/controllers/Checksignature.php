<?php

class Checksignature extends CI_Controller {

    public $group_id = 22;
    public $menu_id = 77;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('checksignature_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'data' => $this->checksignature_model->getUser($this->session->userdata('user_id'))->row(),
            'css_full' => array(),
            'js_full' => array(),
        );
        $this->renderView('checksignature_view', $data);
    }

    public function check() {
        $signature_key = $this->input->post('signature');
        if ($signature_key != null && $signature_key != '') {
            $result = $this->checksignature_model->check($signature_key);
            if ($result->num_rows() == 1) {
                $row = $result->row();
                $data = array(
                    'row' => $row,
                    'user' => $this->checksignature_model->getWorkProcess($row->work_process_id_pri)->row()
                );
                $this->systemlog->log_check_signature($signature_key, 'ตรวจสอบลายเซ็นต์สำเร็จ');
                $this->load->view('checksignature_success_view', $data);
            } else {
                $this->systemlog->log_check_signature($signature_key, 'ไม่พบข้อมูลลายเซ็นต์');
                $this->load->view('checksignature_danger_view');
            }
        } else {
            $this->systemlog->log_check_signature($signature_key, 'เกิดข้อผิดพลาดในการตรวจสอบ');
            $this->load->view('checksignature_false_view');
        }
    }

}
