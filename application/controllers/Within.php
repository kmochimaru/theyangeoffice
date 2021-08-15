<?php

class Within extends CI_Controller {

    public $group_id = 1;
    public $menu_id = 35;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('within_model');
    }

    public function index() {
        if ($this->within_model->checkDepartmentyear($this->session->userdata('dep_id_pri'))->num_rows() == 1) {
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/select2/dist/css/select2.min.css', 'plugin/datepicker/datepicker.css'),
                'js_full' => array('plugin/select2/dist/js/select2.full.min.js', 'plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js'),
            );
            $this->renderView('within_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาดร้ายแรง,กรุณาติดต่อ Admin');
            redirect(base_url());
        }
    }

    public function add() {
        $dep_years = $this->within_model->checkDepartmentyear($this->session->userdata('dep_id_pri'));
        if ($dep_years->num_rows() > 0) {
            $dep_year = $dep_years->row();
            if ($this->input->post('work_info_no') != null) {
                $booking = $this->input->post('booking');
                if ($booking > 1) {
                    for ($i = 0; $i < $booking; $i++) {
                        $data = array(
                            'year_id' => $this->session->userdata('year_id'),
                            'work_info_no' => NULL, //$this->input->post('work_info_no'),
                            'work_info_no_2' => NULL, //$this->input->post('work_info_no_2'),
                            'work_info_no_3' => NULL,
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
                            //'work_info_refer' => $this->input->post('work_info_refer'),
                            //'work_info_other_attach' => $this->input->post('work_info_other_attach'),
                            //'work_info_complete' => ($this->input->post('work_info_complete') == null) ? null : $this->input->post('work_info_complete'),
                            //'work_info_expire' => ($this->input->post('work_info_expire') == null) ? null : $this->input->post('work_info_expire'),
                            'work_info_follow' => ($this->input->post('work_info_follow') == 1) ? 1 : 0,
                            //'work_info_store' => $this->input->post('work_info_store'),
                            'secret_level_id' => $this->input->post('secret_level_id'),
                            'priority_info_id' => $this->input->post('priority_info_id'),
                            'action_info_id' => $this->input->post('action_info_id'),
                            'state_info_id' => 2,
                            //'doc_type_id' => $this->input->post('doc_type_id'),
                            'book_group_id' => $this->input->post('book_group_id'),
                            //'internal_action_id' => $this->input->post('internal_action_id'),
                            //'internal_action_name' => ($this->input->post('internal_action_id') == 1) ? null : $this->input->post('internal_action_name'),
                            'attach_original' => $this->input->post('attach_original'),
                            'work_info_create' => $this->misc->getdate(),
                            'work_info_update' => $this->misc->getdate()
                        );
                        $work_info_id_pri = $this->within_model->insert_workinfo($data);
                        if ($work_info_id_pri > 0) {
                            $dep_year = $this->within_model->getDepartmentyear($this->input->post('dep_id_pri'));
                            $data = array(
                                'work_info_no' => $this->input->post('work_info_no') . $dep_year->dep_year_number_last,
                                'work_info_code' => $dep_year->year . $this->input->post('dep_id_pri') . $work_info_id_pri . date('YmdHis'),
                                'work_info_id' => $dep_year->dep_year_send_last,
                            );
                            $this->within_model->update_workinfo($work_info_id_pri, $data);
                            $this->within_model->update_departmentyear(array('dep_year_number_last' => $dep_year->dep_year_number_last += 1, 'dep_year_send_last' => $dep_year->dep_year_send_last += 1, 'dep_year_update' => $this->misc->getdate()));
                            $text = 'ลงทะเบียนหนังสือส่งภายใน';
                            $datalog = array(
                                'work_info_id_pri' => $work_info_id_pri,
                                'year_id' => $this->session->userdata('year_id'),
                                'work_info_no' => $this->input->post('work_info_no') . $dep_year->dep_year_number_last,
                                'work_info_no_2' => NULL, //$this->input->post('work_info_no_2'),
                                'work_info_no_3' => NULL, //$dep_year->dep_year_number_last,
                                'work_info_code' => $dep_year->year . $this->input->post('dep_id_pri') . $work_info_id_pri . date('YmdHis'),
                                'work_info_id' => $dep_year->dep_year_send_last,
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
                                'work_info_follow' => ($this->input->post('work_info_follow') == 1) ? 1 : 0,
                                'secret_level_id' => $this->input->post('secret_level_id'),
                                'priority_info_id' => $this->input->post('priority_info_id'),
                                'action_info_id' => $this->input->post('action_info_id'),
                                'state_info_id' => 2,
                                'book_group_id' => $this->input->post('book_group_id'),
                                'attach_original' => $this->input->post('attach_original'),
                                'log_user_id' => $this->session->userdata('user_id'),
                                'log_text' => 'เพิ่ม',
                                'log_time' => $this->misc->getdate()
                            );
                            $this->systemlog->log_work_info_edit($datalog);
                        }
                    }
                    $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลเรียบร้อยแล้ว');
                    redirect(base_url('withinwaiting'));
                } else {
                    $data = array(
                        'year_id' => $this->session->userdata('year_id'),
                        'work_info_no' => NULL, //$this->input->post('work_info_no'),
                        'work_info_no_2' => NULL, //$this->input->post('work_info_no_2'),
                        'work_info_no_3' => NULL,
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
                        //'work_info_refer' => $this->input->post('work_info_refer'),
                        //'work_info_other_attach' => $this->input->post('work_info_other_attach'),
                        //'work_info_complete' => ($this->input->post('work_info_complete') == null) ? null : $this->input->post('work_info_complete'),
                        //'work_info_expire' => ($this->input->post('work_info_expire') == null) ? null : $this->input->post('work_info_expire'),
                        'work_info_follow' => ($this->input->post('work_info_follow') == 1) ? 1 : 0,
                        //'work_info_store' => $this->input->post('work_info_store'),
                        'secret_level_id' => $this->input->post('secret_level_id'),
                        'priority_info_id' => $this->input->post('priority_info_id'),
                        'action_info_id' => $this->input->post('action_info_id'),
                        'state_info_id' => 2,
                        //'doc_type_id' => $this->input->post('doc_type_id'),
                        'book_group_id' => $this->input->post('book_group_id'),
                        //'internal_action_id' => $this->input->post('internal_action_id'),
                        //'internal_action_name' => ($this->input->post('internal_action_id') == 1) ? null : $this->input->post('internal_action_name'),
                        'attach_original' => $this->input->post('attach_original'),
                        'work_info_create' => $this->misc->getdate(),
                        'work_info_update' => $this->misc->getdate()
                    );
                    $work_info_id_pri = $this->within_model->insert_workinfo($data);
                    if ($work_info_id_pri > 0) {
                        $dep_year = $this->within_model->getDepartmentyear($this->input->post('dep_id_pri'));
                        $data = array(
                            'work_info_no' => $this->input->post('work_info_no') . $dep_year->dep_year_number_last,
                            'work_info_code' => $dep_year->year . $this->input->post('dep_id_pri') . $work_info_id_pri . date('YmdHis'),
                            'work_info_id' => $dep_year->dep_year_send_last,
                        );
                        $this->within_model->update_workinfo($work_info_id_pri, $data);
                        $this->within_model->update_departmentyear(array('dep_year_number_last' => $dep_year->dep_year_number_last += 1, 'dep_year_send_last' => $dep_year->dep_year_send_last += 1, 'dep_year_update' => $this->misc->getdate()));
                        $text = 'ลงทะเบียนหนังสือส่งภายใน';
                        $this->systemlog->log_work_info($text, $work_info_id_pri);
                        $datalog = array(
                            'work_info_id_pri' => $work_info_id_pri,
                            'year_id' => $this->session->userdata('year_id'),
                            'work_info_no' => $this->input->post('work_info_no') . $dep_year->dep_year_number_last,
                            'work_info_no_2' => NULL, //$this->input->post('work_info_no_2'),
                            'work_info_no_3' => NULL, //$dep_year->dep_year_number_last,
                            'work_info_code' => $dep_year->year . $this->input->post('dep_id_pri') . $work_info_id_pri . date('YmdHis'),
                            'work_info_id' => $dep_year->dep_year_send_last,
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
                            'work_info_follow' => ($this->input->post('work_info_follow') == 1) ? 1 : 0,
                            'secret_level_id' => $this->input->post('secret_level_id'),
                            'priority_info_id' => $this->input->post('priority_info_id'),
                            'action_info_id' => $this->input->post('action_info_id'),
                            'state_info_id' => 2,
                            'book_group_id' => $this->input->post('book_group_id'),
                            'attach_original' => $this->input->post('attach_original'),
                            'log_user_id' => $this->session->userdata('user_id'),
                            'log_text' => 'เพิ่ม',
                            'log_time' => $this->misc->getdate()
                        );
                        $this->systemlog->log_work_info_edit($datalog);
                    }
                    $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลเรียบร้อยแล้ว');
                    redirect(base_url('withinwaiting/attach/' . $work_info_id_pri));
                }
            } else {
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
                redirect(base_url('within'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('within'));
        }
    }

    public function ajax_page() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $workinfo = $this->within_model->getWorkinfoByID($work_info_id_pri);
        $data = array(
            'datas' => $this->within_model->get_workinfofile($work_info_id_pri),
            'state_info_id' => $workinfo->row()->state_info_id,
        );
        $this->load->view('ajax/within_page', $data);
    }

    public function ajax_detail() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $workinfo = $this->within_model->getWorkinfoByID($work_info_id_pri);
        if ($workinfo->num_rows() > 0) {
            $data = array(
                'data' => $workinfo->row(),
            );
            $this->load->view('ajax/withindetail_page', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('within'));
        }
    }

    public function from_modal() {
        $this->load->view('modal/within_from_modal');
    }

    public function to_modal() {
        $this->load->view('modal/within_to_modal');
    }
}
