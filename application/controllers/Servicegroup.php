<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servicegroup
 *
 * @author nut
 */
class Servicegroup extends CI_Controller {

    //put your code here
    public $group_id = 8;
    public $menu_id = 60;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('servicegroup_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'datas' => $this->servicegroup_model->get_servicegroup(),
            'css' => array('parsley.min.css'),
            'css_full' => array(),
            'js' => array('parsley.min.js'),
            'js_full' => array()
        );
        $this->renderView('servicegroup_view', $data);
    }

    public function getservicegroup() {
        $servicegroup = $this->servicegroup_model->get_servicegroup($this->input->post('service_group_id'))->row();
        echo json_encode($servicegroup);
    }

    public function addservicegroup() {
        $data = array(
            'service_group_name' => $this->input->post('service_group_name'),
            'service_group_sort' => $this->servicegroup_model->get_last_servicegroup()->row()->service_group_sort + 1,
            'service_group_update' => $this->misc->getdate()
        );
        $this->servicegroup_model->addservicegroup($data);
        redirect(base_url('servicegroup'));
    }

    public function editservicegroup() {
        $data = array(
            'service_group_name' => $this->input->post('service_group_name'),
            'service_group_update' => $this->misc->getdate()
        );
        $this->servicegroup_model->editservicegroup($this->input->post('service_group_id'), $data);
        redirect(base_url('servicegroup'));
    }

    public function deleteservicegroup($id) {
        $this->servicegroup_model->deleteservicegroup($id);
        redirect(base_url('servicegroup'));
    }

    public function sortservicegroup() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array(),
            'css_full' => array('plugin/nestable/nestable.css'),
            'js' => array(),
            'js_full' => array('plugin/nestable/jquery.nestable.js')
        );
        $this->renderView('servicegroup_sort_view', $data);
    }

    public function editsortservicegroup() {
        $count = 1;
        foreach ($this->input->post('list') as $row) {
            $data = array(
                'service_group_sort' => $count
            );
            $this->servicegroup_model->editservicegroup($row['id'], $data);
            $count++;
        }
    }

    // menu
    public function service($service_group_id = null) {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'service_group_id' => $service_group_id,
            'service_group' => $this->servicegroup_model->get_servicegroup($service_group_id)->row(),
            'datas' => $this->servicegroup_model->get_service_all($service_group_id),
            'css' => array('parsley.min.css'),
            'css_full' => array(),
            'js' => array('parsley.min.js'),
            'js_full' => array()
        );
        $this->renderView('service_view', $data);
    }

    public function getservice() {
        $service = $this->servicegroup_model->get_service($this->input->post('service_id'))->row();
        echo json_encode($service);
    }

    public function addservice() {
        $service_group_id = $this->input->post('service_group_id');
        $data = array(
            'service_group_id' => $service_group_id,
            'service_name' => $this->input->post('service_name'),
            'service_status_id' => 1,
            'service_sort' => $this->servicegroup_model->get_last_service($service_group_id)->row()->service_sort + 1,
            'service_update' => $this->misc->getdate()
        );
        $this->servicegroup_model->addservice($data);
        redirect(base_url('servicegroup/service/' . $service_group_id));
    }

    public function editservice() {
        $service_group_id = $this->input->post('service_group_id');
        $data = array(
            'service_name' => $this->input->post('service_name'),
            'service_status_id' => $this->input->post('service_status_id'),
            'service_update' => $this->misc->getdate()
        );
        $this->servicegroup_model->editservice($this->input->post('service_id'), $data);
        redirect(base_url('servicegroup/service/' . $service_group_id));
    }

    public function deleteservice($service_group_id, $id) {
        $this->servicegroup_model->deleteservice($id);
        redirect(base_url('servicegroup/service/' . $service_group_id));
    }

    public function sortservice($service_group_id) {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'service_group_id' => $service_group_id,
            'service_group' => $this->servicegroup_model->get_servicegroup($service_group_id)->row(),
            'css' => array(),
            'css_full' => array('plugin/nestable/nestable.css'),
            'js' => array(),
            'js_full' => array('plugin/nestable/jquery.nestable.js')
        );
        $this->renderView('service_sort_view', $data);
    }

    public function editsortservice() {
        $count = 1;
        foreach ($this->input->post('list') as $row) {
            $data = array(
                'service_sort' => $count
            );
            $this->servicegroup_model->editservice($row['id'], $data);
            $count++;
        }
    }

    public function helpdesk($service_group_id, $service_id) {
        if ($service_group_id != null || $service_id != null) {
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'service_group_id' => $service_group_id,
                'service_group' => $this->servicegroup_model->get_servicegroup($service_group_id)->row(),
                'service_id' => $service_id,
                'service' => $this->servicegroup_model->get_service($service_id)->row(),
                'datas' => $this->servicegroup_model->get_service_help_desk($service_id),
                'css' => array('parsley.min.css'),
                'css_full' => array(),
                'js' => array('parsley.min.js'),
                'js_full' => array()
            );
            $this->renderView('servicehelpdesk_view', $data);
        } else {
            redirect(base_url('servicegroup'));
        }
    }

    public function addhelpdesk($service_group_id, $service_id) {
        if ($service_group_id != null || $service_id != null) {
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'service_group_id' => $service_group_id,
                'service_group' => $this->servicegroup_model->get_servicegroup($service_group_id)->row(),
                'service_id' => $service_id,
                'service' => $this->servicegroup_model->get_service($service_id)->row(),
                'datas' => $this->servicegroup_model->get_service_help_desk($service_id),
                'css' => array('parsley.min.css'),
                'js' => array('parsley.min.js'),
                'css_full' => array('plugin/select2/dist/css/select2.min.css'),
                'js_full' => array('plugin/select2/dist/js/select2.full.min.js')
            );
            $this->renderView('servicehelpdesk_add_view', $data);
        } else {
            redirect(base_url('servicegroup'));
        }
    }

    public function ajax_page() {
        $filter = array(
            'dep_id_pri' => $this->input->post('dep_id_pri'),
            'searchtext' => $this->input->post('searchtext'),
        );
        $data = array(
            'data' => $this->servicegroup_model->get_user($filter),
            'service_group_id' => $this->input->post('service_group_id'),
            'service_id' => $this->input->post('service_id'),
        );
        $this->load->view('ajax/servicehelpdesk_page', $data);
    }

    public function adduserhelpdesk() {
        $select_checkbox = $this->input->post('select_checkbox');
        $service_group_id = $this->input->post('service_group_id');
        $service_id = $this->input->post('service_id');
        if ($select_checkbox != '') {
            foreach ($select_checkbox as $user_id) {
                $data = array(
                    'service_id' => $service_id,
                    'user_id' => $user_id,
                    'help_desk_active_id' => 2,
                    'help_desk_modify' => date('Y-m-d H:i:s')
                );
                $this->servicegroup_model->insert_help_desk($data);
            }
            $this->session->set_flashdata('flash_message', 'success,ทำรายการสำเร็จ !,เพิ่มรายการเรียบร้อยแล้ว');
            redirect(base_url('servicegroup/helpdesk/' . $service_group_id . '/' . $service_id));
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด !,เพิ่มรายการไม่สำเร็จ');
            redirect(base_url('servicegroup/helpdesk/' . $service_group_id . '/' . $service_id));
        }
    }

    public function deleteuserhelpdesk_modal() {
        $data = array(
            'help_desk_id' => $this->input->post('help_desk_id'),
            'service_group_id' => $this->input->post('service_group_id'),
            'service_id' => $this->input->post('service_id'),
        );
        $this->load->view('modal/servicehelpdesk_delete_modal', $data);
    }

    public function deleteuserhelpdesk() {
        if ($this->input->post('help_desk_id') != '') {
            $this->servicegroup_model->delete_help_desk($this->input->post('help_desk_id'));
            $this->session->set_flashdata('flash_message', 'success,ทำรายการสำเร็จ !,ลบรายการเรียบร้อยแล้ว');
            redirect(base_url('servicegroup/helpdesk/' . $this->input->post('service_group_id') . '/' . $this->input->post('service_id')));
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด !,ลบรายการไม่สำเร็จ');
            redirect(base_url('servicegroup/helpdesk/' . $this->input->post('service_group_id') . '/' . $this->input->post('service_id')));
        }
    }
    
    public function editactive() {
        $this->servicegroup_model->update_help_desk($this->input->post('help_desk_id'), array('help_desk_active_id' => 1));
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        echo 1;
    }

    public function editchangeactive() {
        $this->servicegroup_model->update_help_desk($this->input->post('help_desk_id'), array('help_desk_active_id' => 2));
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        echo 1;
    }

}
