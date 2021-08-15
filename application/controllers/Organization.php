<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Organization
 *
 * @author nut
 */
class Organization extends CI_Controller {

    //put your code here
    public $group_id = 8;
    public $menu_id = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginNull();
        $this->load->model('organization_model');
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
        $this->renderView('organization_view', $data);
    }

    public function ajax_page() {
        $searchtext = $this->input->post('searchtext');
        $data = array(
            'data' => $this->organization_model->get_page($searchtext),
        );
        $this->load->view('ajax/organization_page', $data);
    }

    public function add_organization_modal() {
        $data = array(
            'data' => ''
        );
        $this->load->view('modal/organization_add_modal', $data);
    }

    public function edit_organization_modal() {
        $data = array(
            'data' => $this->organization_model->getorganization($this->input->post('org_id_pri'))->row()
        );
        $this->load->view('modal/organization_edit_modal', $data);
    }

    public function delete_organization_modal() {
        $data = array(
            'data' => $this->organization_model->getorganization($this->input->post('org_id_pri'))->row()
        );
        $this->load->view('modal/organization_delete_modal', $data);
    }

    public function add_organization() {
        $data = array(
            'org_id' => $this->input->post('org_id'),
            'org_name' => $this->input->post('org_name'),
            'org_name_short' => $this->input->post('org_name_short'),
            'org_number' => $this->input->post('org_number'),
            'org_prefix' => $this->input->post('org_prefix'),
            'org_create' => $this->misc->getdate(),
            'org_update' => $this->misc->getdate(),
        );
        $this->organization_model->insert_organization($data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('organization'));
    }

    public function edit_organization() {
        $data = array(
            'org_id' => $this->input->post('org_id'),
            'org_name' => $this->input->post('org_name'),
            'org_name_short' => $this->input->post('org_name_short'),
            'org_number' => $this->input->post('org_number'),
            'org_prefix' => $this->input->post('org_prefix'),
            'org_update' => $this->misc->getdate(),
        );
        $this->organization_model->update_organization($this->input->post('org_id_pri'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขข้อมูลเรียบร้อยแล้ว');
        redirect(base_url('organization'));
    }

    public function delete_organization() {
        $this->organization_model->delete_organization($this->input->post('org_id_pri'));
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,ลบกลุ่มลูกค้าเรียบร้อยแล้ว');
        redirect(base_url('organization'));
    }

}
