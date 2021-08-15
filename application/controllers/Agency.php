<?php
 
class Agency extends CI_Controller {
 
    public $group_id = 11;
    public $menu_id = 31;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginNull();
        $this->load->model('agency_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css_full' => array('plugin/select2/dist/css/select2.min.css'),
            'js_full' => array('plugin/select2/dist/js/select2.full.min.js'),
        );
        $this->renderView('agency_view', $data);
    }

    public function ajax_page() {

        $filter = array(
            "searchtext" => $this->input->post('searchtext')
        );
        $data = array(
            'data' => $this->agency_model->get_page($filter),
        );
        $this->load->view('ajax/agency_page', $data);
    }

    public function add_modal() {
        $data = array(
            'data' => ''
        );
        $this->load->view('modal/agency_add_modal', $data);
    }

    public function edit_modal() {
        $data = array(
            'data' => $this->agency_model->getAgencyById($this->input->post('agency_id_pri'))->row()
        );
        $this->load->view('modal/agency_edit_modal', $data);
    }

    public function delete_modal() {
        $data = array(
            'data' => $this->agency_model->getAgencyById($this->input->post('agency_id_pri'))->row()
        );
        $this->load->view('modal/agency_delete_modal', $data);
    }

    public function add() {
        $data = array(
            'agency_id' => $this->input->post('agency_id'),
            'agency_name' => $this->input->post('agency_name'),
            'agency_name_short' => $this->input->post('agency_name_short'),
            'agency_tel' => $this->input->post('agency_tel'),
            'agency_email' => $this->input->post('agency_email'),
            'dep_status_id' => $this->input->post('dep_status_id'),          
            'agency_description' => $this->input->post('agency_description'),           
            'agency_create' => $this->misc->getdate(),
            'agency_update' => $this->misc->getdate()
        );
        $this->agency_model->insert($data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('agency'));
    }

    public function edit() {
        $data = array(
            'agency_id' => $this->input->post('agency_id'),
            'agency_name' => $this->input->post('agency_name'),
            'agency_name_short' => $this->input->post('agency_name_short'),
            'agency_tel' => $this->input->post('agency_tel'),
            'agency_email' => $this->input->post('agency_email'),
            'dep_status_id' => $this->input->post('dep_status_id'),          
            'agency_description' => $this->input->post('agency_description'),           
            'agency_update' => $this->misc->getdate()
        );
        $this->agency_model->update($this->input->post('agency_id_pri'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('agency'));
    }

    public function delete() {
        $this->agency_model->delete($this->input->post('agency_id_pri'));
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,ลบกลุ่มลูกค้าเรียบร้อยแล้ว');
        redirect(base_url('agency'));
    }

}
