<?php

/**
 * Description of Acting
 * @author nut
 */
class Acting extends CI_Controller {

    public $group_id = 21;
    public $menu_id = 68;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('acting_model');
    }

    public function index() {
        if ($this->acting_model->checkDepartmentyear($this->session->userdata('dep_id_pri'))->num_rows() == 1) {
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/select2/dist/css/select2.min.css', 'plugin/datepicker/datepicker.css'),
                'js_full' => array('plugin/select2/dist/js/select2.full.min.js', 'plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js'),
            );
            $this->renderView('acting_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาดร้ายแรง,กรุณาติดต่อ Admin');
            redirect(base_url());
        }
    }

    public function add() {
        if ($this->input->post('work_info_no') != null) {
            $data = array(
                'year_id' => $this->session->userdata('year_id'),
                'work_info_no' => $this->input->post('work_info_no'),
                'work_info_no_2' => $this->input->post('work_info_no_2'),
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
                'state_info_id' => 1,
                'book_group_id' => $this->input->post('book_group_id'),
                'attach_original' => $this->input->post('attach_original'),
                'work_info_create' => $this->misc->getdate(),
                'work_info_update' => $this->misc->getdate()
            );
            $work_info_id_pri = $this->acting_model->insert_workinfo($data);
            if ($work_info_id_pri > 0) {
                $dep_year = $this->acting_model->getDepartmentyear($this->input->post('dep_id_pri'));
                $data = array(
                    'work_info_no_3' => $dep_year->dep_year_number_last,
                    'work_info_code' => $dep_year->year . $this->input->post('dep_id_pri') . $work_info_id_pri . date('YmdHis'),
                );
                $this->acting_model->update_workinfo($work_info_id_pri, $data);
                $this->acting_model->update_departmentyear(array('dep_year_number_last' => $dep_year->dep_year_number_last += 1, 'dep_year_update' => $this->misc->getdate()));
                $text = 'ร่างหนังสือรักษาการ';
                $this->systemlog->log_work_info($text, $work_info_id_pri);
                $getworkinfo = $this->accesscontrol->getworkinfo($work_info_id_pri);
                $workinfo = $getworkinfo->row();
                $datalog = array(
                    'work_info_id_pri' => $workinfo->work_info_id_pri,
                    'work_info_code' => $workinfo->work_info_code,
                    'work_info_id' => $workinfo->work_info_id,
                    'work_info_no' => $workinfo->work_info_no,
                    'work_info_no_2' => $workinfo->work_info_no_2,
                    'work_info_no_3' => $workinfo->work_info_no_3,
                    'year_id' => $workinfo->year_id,
                    'work_type_id' => $workinfo->work_type_id,
                    'user_id' => $workinfo->user_id,
                    'dep_id_pri' => $workinfo->dep_id_pri,
                    'dep_off_id' => $workinfo->dep_off_id,
                    'work_info_date' => $workinfo->work_info_date,
                    'work_info_from_position' => $workinfo->work_info_from_position,
                    'work_info_from' => $workinfo->work_info_from,
                    'work_info_to_position' => $workinfo->work_info_to_position,
                    'work_info_to' => $workinfo->work_info_to,
                    'work_info_subject' => $workinfo->work_info_subject,
                    'work_info_detail' => $workinfo->work_info_detail,
                    'work_info_comment' => $workinfo->work_info_comment,
                    'work_info_refer' => $workinfo->work_info_refer,
                    'work_info_other_attach' => $workinfo->work_info_other_attach,
                    'work_info_complete' => $workinfo->work_info_complete,
                    'work_info_expire' => $workinfo->work_info_expire,
                    'work_info_follow' => $workinfo->work_info_follow,
                    'work_info_store' => $workinfo->work_info_store,
                    'secret_level_id' => $workinfo->secret_level_id,
                    'priority_info_id' => $workinfo->priority_info_id,
                    'action_info_id' => $workinfo->action_info_id,
                    'state_info_id' => $workinfo->state_info_id,
                    'doc_type_id' => $workinfo->doc_type_id,
                    'book_group_id' => $workinfo->book_group_id,
                    'internal_action_id' => $workinfo->internal_action_id,
                    'internal_action_name' => $workinfo->internal_action_name,
                    'attach_original' => $workinfo->attach_original,
                    'work_info_signature' => $workinfo->work_info_signature,
                    'log_user_id' => $this->session->userdata('user_id'),
                    'log_text' => 'เพิ่ม',
                    'log_time' => $this->misc->getdate()
                );
                $this->systemlog->log_work_info_edit($datalog);
            }
            $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลเรียบร้อยแล้ว');
            redirect(base_url('actingwaiting'));
        }
        $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
        redirect(base_url('acting'));
    }

//    public function ajax_page() {
//        $work_info_id_pri = $this->input->post('work_info_id_pri');
//        $data = array(
//            'datas' => $this->acting_model->get_workinfofile($work_info_id_pri),
//        );
//        $this->load->view('ajax/acting_page', $data);
//    }

}
