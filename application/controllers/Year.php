<?php

class Year extends CI_Controller {

    public $group_id = 8;
    public $menu_id = 22;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('year_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'datas' => $this->year_model->getData(),
            'css' => array('parsley.min.css'),
            'js' => array('parsley.min.js'),
            'css_full' => array('plugin/datepicker/datepicker.css'),
            'js_full' => array('plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js'),
        );
        $this->renderView('year_view', $data);
    }

    public function add_year_modal() {
        $this->load->view('modal/year_add_modal');
    }

    public function edit_year_modal() {
        $data = array(
            'data' => $this->year_model->getData($this->input->post('year_id'))->row()
        );
        $this->load->view('modal/year_edit_modal', $data);
    }

    public function delete_year_modal() {
        $data = array(
            'data' => $this->year_model->getData($this->input->post('year_id'))->row()
        );
        $this->load->view('modal/year_delete_modal', $data);
    }

    public function add_year() {
        $data = array(
            'year' => $this->input->post('year'),
            'year_th' => $this->input->post('year_th'),
            'year_en' => $this->input->post('year_en'),
            'year_start' => $this->input->post('year_start'),
            'year_end' => $this->input->post('year_end'),
        );
        $this->year_model->insert($data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('year'));
    }

    public function edit_year() {
        $year_id = $this->input->post('year_id');
        $data = array(
            'year' => $this->input->post('year'),
            'year_th' => $this->input->post('year_th'),
            'year_en' => $this->input->post('year_en'),
            'year_start' => $this->input->post('year_start'),
            'year_end' => $this->input->post('year_end'),
        );
        $this->year_model->update($year_id, $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('year'));
    }

    public function delete_year() {
        $year_id = $this->input->post('year_id');
        $this->year_model->delete($year_id);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,ลบข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('year'));
    }

    public function process($year_id) {
        if ($year_id != null) {
            foreach ($this->year_model->getDep()->result() as $row) {
                $check_map_dep = $this->year_model->check_map_dep($year_id, $row->dep_id_pri);
                if ($check_map_dep == 0) {
                    $year = $this->year_model->getData($year_id)->row();
                    $data = array(
                        'dep_id_pri' => $row->dep_id_pri,
                        'year_id' => $year_id,
                        'year' => $year->year,
                        'dep_year_number_last' => 1,
                        'dep_year_receive_last' => 1,
                        'dep_year_send_last' => 1,
                        'dep_year_send_out_last' => 1,                        
                        'dep_year_send_command_last' => 1,
                        'dep_year_send_publish_last' => 1,
                        'dep_year_create' => $this->misc->getdate(),
                        'dep_year_update' => $this->misc->getdate()
                    );
                    $this->year_model->insert_map_year($data);
                }
            }
            $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,ประมวลผลข้อมูลเรียบร้อยแล้ว');
            redirect(base_url('year'));
        } else {
            $this->session->set_flashdata('flash_message', 'warning,ทำรายการไม่สำเร็จ,ไม่สามารถทำรายการได้');
            redirect(base_url('year'));
        }
    }

}
