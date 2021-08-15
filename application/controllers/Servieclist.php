<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servieclist
 *
 * @author nut
 */
class Servieclist extends CI_Controller {

    //put your code here 19 61
    public $group_id = 19;
    public $menu_id = 61;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('servieclist_model');
        $this->load->library('ajax_pagination');
        $this->load->library('../controllers/line');
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
        $this->renderView('servieclist_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'service_id' => $this->input->post('service_id'),
            'service_group_id' => $this->input->post('service_group_id'),
            'service_status_id' => $this->input->post('service_status_id'),
            'searchtext' => $this->input->post('searchtext'),
        );
        $count = $this->servieclist_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('servieclist/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "', 'service_id' : '" . $this->input->post('service_id') . "', 'service_group_id' : '" . $this->input->post('service_group_id') . "', 'service_status_id' : '" . $this->input->post('service_status_id') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->servieclist_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/servieclist_pagination', $data);
    }

    public function detail($service_info_id_pri) {
        $serviceinfos = $this->servieclist_model->getserviceinfo($service_info_id_pri);
        if ($serviceinfos->num_rows() > 0) {
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
                'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js'),
                'service_info_id_pri' => $service_info_id_pri,
                'serviceinfo' => $serviceinfos->row(),
                'data' => $this->servieclist_model->get_service_user($service_info_id_pri),
            );
            $this->renderView('servieclistdetail_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('servieclist'));
        }
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
    }

    public function add_comment() {
        $service_info_id_pri = $this->input->post('service_info_id_pri_modal');
        $serviceinfos = $this->servieclist_model->getserviceinfo($service_info_id_pri);
        if ($serviceinfos->num_rows() == 1) {
            $dataserviceuser = array(
                'user_id' => $this->session->userdata('user_id'),
                'service_info_id_pri' => $service_info_id_pri,
                'service_user_comment' => $this->input->post('service_user_comment'),
                'service_user_active_id' => 1,
                'service_user_create' => $this->misc->getdate(),
                'service_user_update' => $this->misc->getdate()
            );
            $this->servieclist_model->insert_service_user($dataserviceuser);
            if ($serviceinfos->row()->service_status_id == 1) {
                $data = array(
                    'service_status_id' => 2,
                    'service_info_update' => $this->misc->getdate()
                );
                $this->servieclist_model->update_serviceinfo($service_info_id_pri, $data);
                $message = "\n" . 'มีการตอบกลับ ปัญหางานซ้อมและบริการ : "' . $serviceinfos->row()->service_name . '" ' . "\n" . 'เรื่อง : ' . $serviceinfos->row()->service_info_suject . "\n" . 'ตอบกลับ : "' . $this->input->post('service_user_comment') . '"';
                $this->send_line($serviceinfos->row()->user_line_token, $message);
            }
            $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ทำรายการสำเร็จแล้ว');
            redirect(base_url('servieclist/detail/' . $service_info_id_pri));
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('servieclist'));
        }
    }

    public function edit_pedding() {
        $service_info_id_pri = $this->input->post('service_info_id_pri_modal');
        $serviceinfos = $this->servieclist_model->getserviceinfo($service_info_id_pri);
        if ($serviceinfos->num_rows() == 1) {
            if ($serviceinfos->row()->service_status_id == 2) {
                $dataserviceuser = array(
                    'service_info_id_pri' => $service_info_id_pri,
                    'service_user_active_id' => 0,
                    'service_user_comment' => 'กำลังดำเนินงาน',
                    'service_user_create' => $this->misc->getdate(),
                    'service_user_update' => $this->misc->getdate()
                );
                $this->servieclist_model->insert_service_user($dataserviceuser);
                $data = array(
                    'service_status_id' => 3,
                    'service_info_update' => $this->misc->getdate()
                );
                $this->servieclist_model->update_serviceinfo($service_info_id_pri, $data);
                $message = "\n" . 'ปัญหางานซ้อมและบริการ : "' . $serviceinfos->row()->service_name . '" ' . "\n" . 'เรื่อง : ' . $serviceinfos->row()->service_info_suject . "\n" . 'กำลังดำเนินงาน';
                $this->send_line($serviceinfos->row()->user_line_token, $message);
            }
            $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ทำรายการสำเร็จแล้ว');
            redirect(base_url('servieclist/detail/' . $service_info_id_pri));
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('servieclist'));
        }
    }

    public function edit_success() {
        $service_info_id_pri = $this->input->post('service_info_id_pri_modal');
        $serviceinfos = $this->servieclist_model->getserviceinfo($service_info_id_pri);
        if ($serviceinfos->num_rows() == 1) {
            if ($serviceinfos->row()->service_status_id >= 2) {
                if ($serviceinfos->row()->service_status_id != 4) {
                    $dataserviceuser = array(
                        'service_info_id_pri' => $service_info_id_pri,
                        'service_user_active_id' => 0,
                        'service_user_comment' => 'ปิดงานเสร็จสิ้น',
                        'service_user_create' => $this->misc->getdate(),
                        'service_user_update' => $this->misc->getdate()
                    );
                    $this->servieclist_model->insert_service_user($dataserviceuser);
                    $data = array(
                        'service_status_id' => 4,
                        'service_info_update' => $this->misc->getdate()
                    );
                    $this->servieclist_model->update_serviceinfo($service_info_id_pri, $data);
                    $message = "\n" . 'ปัญหางานซ้อมและบริการ : "' . $serviceinfos->row()->service_name . '" ' . "\n" . 'เรื่อง : ' . $serviceinfos->row()->service_info_suject . "\n" . 'ปิดงานเสร็จสิ้น';
                    $this->send_line($serviceinfos->row()->user_line_token, $message);
                }
            }
            $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ทำรายการสำเร็จแล้ว');
            redirect(base_url('servieclist/detail/' . $service_info_id_pri));
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('servieclist'));
        }
    }

    public function send($service_info_id_pri) {
        $serviceinfos = $this->servieclist_model->getserviceinfo($service_info_id_pri);
        if ($serviceinfos->num_rows() == 1) {
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/datepicker/datepicker.css', 'plugin/fancybox/dist/jquery.fancybox.css', 'plugin/multiselect-tree/dist/jquery.tree-multiselect.css'),
                'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js', 'plugin/jqueryui/jquery-ui.min.js', 'plugin/multiselect-tree/dist/jquery.tree-multiselect.js'),
                'service_info_id_pri' => $service_info_id_pri,
                'serviceinfo' => $serviceinfos->row(),
            );
            $this->renderView('sendservieclist_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('receivelist'));
        }
    }

    public function sendto() {
        $service_info_id_pri = $this->input->post('service_info_id_pri');
        $select_checkbox = $this->input->post('user_id_select');
        $serviceinfos = $this->servieclist_model->getserviceinfo($service_info_id_pri);
        if ($serviceinfos->num_rows() == 1) {
            $serviceinfo = $serviceinfos->row();
            $message = "\n" . 'มีการส่งต่องานแจ้งซ่อม (บริการ) "' . $serviceinfo->service_name . '" ' . "\n" . 'ปัญหาที่พบ : ' . $serviceinfo->service_info_suject . ' ' . "\n" . 'สถานที่และติดต่อ : ' . $serviceinfo->service_info_contacts . ' ' . "\n" . 'ผู้แจ้ง : ' . $serviceinfo->user_fullname;
            if (count($select_checkbox) != 0) {
                foreach ($select_checkbox as $user_id) {
                    $uesr = $this->servieclist_model->get_uesr_id($user_id);
                    $this->send_line($uesr->row()->user_line_token, $message);
                    $datateam = array(
                        'user_id' => $user_id,
                        'service_info_id_pri' => $service_info_id_pri,
                        'user_id_help' => $this->session->userdata('user_id'),
                        'help_desk_team_modify' => $this->misc->getdate()
                    );
                    $this->servieclist_model->insert_help_desk_team($datateam);
                }
                $dataserviceuser = array(
                    'service_info_id_pri' => $service_info_id_pri,
                    'service_user_active_id' => 0,
                    'service_user_comment' => 'มีการส่งต่องานงาน',
                    'service_user_create' => $this->misc->getdate(),
                    'service_user_update' => $this->misc->getdate()
                );
                $this->servieclist_model->insert_service_user($dataserviceuser);
            }
            echo 1;
        } else {
            echo 0;
        }
    }

    // send line
    public function send_line($line_token, $message) {
        if ($line_token != null && $line_token != '') {
            $line = $this->line->line_notification($line_token, $message);
            if ($line == 1) {
                $this->systemlog->log_send_line($message, $this->session->userdata('user_id'), $line_token);
            }
        }
    }

}
