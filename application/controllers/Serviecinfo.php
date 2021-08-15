<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Serviecinfo
 *
 * @author nut
 */
class Serviecinfo extends CI_Controller {

    //put your code here
    public $group_id = 12;
    public $menu_id = 62;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('serviecinfo_model');
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
        $this->renderView('serviecinfo_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'service_id' => $this->input->post('service_id'),
            'service_group_id' => $this->input->post('service_group_id'),
            'service_status_id' => $this->input->post('service_status_id'),
            'searchtext' => $this->input->post('searchtext'),
        );
        $count = $this->serviecinfo_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('serviecinfo/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "', 'service_id' : '" . $this->input->post('service_id') . "', 'service_group_id' : '" . $this->input->post('service_group_id') . "', 'service_status_id' : '" . $this->input->post('service_status_id') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->serviecinfo_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/serviecinfo_pagination', $data);
    }

    public function selected() {
        $services = $this->serviecinfo_model->get_service($this->input->post('service_group_id'))->result();
        $service_id = array();
        $service_name = array();
        $i = 0;
        foreach ($services as $service) {
            $service_id[$i] = $service->service_id;
            $service_name[$i] = $service->service_name;
            $i++;
        }
        $return["service_id"] = $service_id;
        $return["service_name"] = $service_name;
        print json_encode($return);
    }

    public function serviecgroup() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
        );
        $this->renderView('serviecinfogroup_view', $data);
    }

    public function serviec($serviec_id) {
        $serviecs = $this->serviecinfo_model->get_service(null, $serviec_id);
        if ($serviecs->num_rows() == 1) {
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/select2/dist/css/select2.min.css', 'plugin/datepicker/datepicker.css'),
                'js_full' => array('plugin/select2/dist/js/select2.full.min.js', 'plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js'),
                'data' => $serviecs->row(),
            );
            $this->renderView('serviecinfoadd_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาดร้ายแรง,กรุณาติดต่อ Admin');
            redirect(base_url());
        }
    }

    public function add() {
        if ($this->input->post('service_id') != null) {
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'priority_info_id' => $this->input->post('priority_info_id'),
                'dep_id_pri' => $this->input->post('dep_id_pri'),
                'service_info_contacts' => $this->input->post('service_info_contacts'),
                'service_info_comment' => $this->input->post('service_info_comment'),
                'service_id' => $this->input->post('service_id'),
                'service_info_suject' => $this->input->post('service_info_suject'),
                'service_info_detail' => $this->input->post('service_info_detail'),
                'service_status_id' => 1,
                'service_info_create' => $this->misc->getdate(),
                'service_info_update' => $this->misc->getdate()
            );
            $service_info_id_pri = $this->serviecinfo_model->insert_serviceinfo($data);
            if ($service_info_id_pri > 0) {
                $this->load->library('upload');
                $this->load->library('image_lib');
                for ($i = 1; $i <= 5; $i++) {
                    $config_photo = array(
                        'upload_path' => './assets/upload/service/',
                        'allowed_types' => 'pdf|doc|docx|xls|xlsx|ppt|pptx|txt|zip|rar|jpg|jpeg|png|gif',
                        'max_size' => 20480,
                        'file_name' => 'service_' . $i . '_' . $service_info_id_pri . '_' . date('YmdHis'),
                        'file_ext_tolower' => TRUE
                    );
                    $this->upload->initialize($config_photo);
                    if ($this->upload->do_upload('service_info_file_' . $i)) {
                        $upload_data = $this->upload->data();
                        $image_data = array(
                            'service_info_file_' . $i => $upload_data['file_name']
                        );
                        $this->serviecinfo_model->update_serviceinfo($service_info_id_pri, $image_data);
                    }
                }
                $services = $this->serviecinfo_model->get_service_help_desk($this->input->post('service_id'));
                $message = "\n" . 'มีการมอบหมายงานแจ้งซ่อม (บริการ) "' . $services->row(1)->service_name . '" ' . "\n" . 'ปัญหาที่พบ : ' . $this->input->post('service_info_suject') . ' ' . "\n" . 'สถานที่และติดต่อ : ' . $this->input->post('service_info_contacts') . ' ' . "\n" . 'ผู้แจ้ง : ' . $this->serviecinfo_model->get_uesr()->row()->user_fullname;
                if ($services->num_rows() > 0) {
                    foreach ($services->result() as $service) {
                        $this->send_line($service->user_line_token, $message);
                        $datateam = array(
                            'user_id' => $service->user_id,
                            'service_info_id_pri' => $service_info_id_pri,
                            'user_id_help' => $this->session->userdata('user_id'),
                            'help_desk_team_modify' => $this->misc->getdate()
                        );
                        $this->serviecinfo_model->insert_help_desk_team($datateam);
                    }
                }
                $dataserviceuser = array(
                    'service_info_id_pri' => $service_info_id_pri,
                    'service_user_active_id' => 0,
                    'service_user_comment' => 'แจ้งปัญหาไปยังทีมที่เกี่ยวข้องแล้ว',
                    'service_user_create' => $this->misc->getdate(),
                    'service_user_update' => $this->misc->getdate()
                );
                $this->serviecinfo_model->insert_service_user($dataserviceuser);
            }
            //echo $service_info_id_pri;
            $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลเรียบร้อยแล้ว');
            redirect(base_url('serviecinfo'));
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('serviecinfo'));
        }
    }

    public function edit_cancel() {
        $service_info_id_pri = $this->input->post('service_info_id_pri_modal');
        $serviceinfos = $this->serviecinfo_model->getserviceinfo($service_info_id_pri);
        if ($serviceinfos->num_rows() == 1) {
            if ($serviceinfos->row()->service_status_id != 4) {
                $dataserviceuser = array(
                    'service_info_id_pri' => $service_info_id_pri,
                    'service_user_active_id' => 0,
                    'service_user_comment' => 'ยกเลิกจากผู้แจ้ง',
                    'service_user_create' => $this->misc->getdate(),
                    'service_user_update' => $this->misc->getdate()
                );
                $this->serviecinfo_model->insert_service_user($dataserviceuser);
                $data = array(
                    'service_status_id' => 6,
                    'service_info_update' => $this->misc->getdate()
                );
                $this->serviecinfo_model->update_serviceinfo($service_info_id_pri, $data);
                $services = $this->serviecinfo_model->get_service_help_desk($serviceinfos->row()->service_id);
                $message = "\n" . 'ปัญหางานซ้อมและบริการ : "' . $serviceinfos->row()->service_name . '" ' . "\n" . 'เรื่อง : ' . $serviceinfos->row()->service_info_suject . "\n" . 'ถูกยกเลิกจากผู้แจ้ง';
                //$this->send_line($serviceinfos->row()->user_line_token, $message);
                if ($services->num_rows() > 0) {
                    foreach ($services->result() as $service) {
                        $this->send_line($service->user_line_token, $message);
                    }
                }
            }
            $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ทำรายการสำเร็จแล้ว');
            redirect(base_url('serviecinfo/detail/' . $service_info_id_pri));
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('serviecinfo'));
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

    public function detail($service_info_id_pri) {
        $serviceinfos = $this->serviecinfo_model->getserviceinfo($service_info_id_pri);
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
                'data' => $this->serviecinfo_model->get_service_user($service_info_id_pri),
            );
            $this->renderView('serviecinfodetail_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('serviecinfo'));
        }
    }

    public function evaluate() {
        $service_info_id_pri = $this->input->post('service_info_id_pri_modal');
        $serviceinfos = $this->serviecinfo_model->getserviceinfo($service_info_id_pri);
        if ($serviceinfos->num_rows() == 1) {
            if ($serviceinfos->row()->service_status_id == 4) {
                $data = array(
                    'service_inf_evaluate_id' => $this->input->post('service_inf_evaluate_id'),
                    'service_inf_evaluate' => $this->input->post('service_inf_evaluate'),
                    'service_inf_evaluate_date' => $this->misc->getdate()
                );
                $this->serviecinfo_model->update_serviceinfo($service_info_id_pri, $data);
                //$services = $this->serviecinfo_model->get_service_help_desk($serviceinfos->row()->service_id);
                //$message = "\n" . 'ปัญหางานซ้อมและบริการ : "' . $serviceinfos->row()->service_name . '" ' . "\n" . 'เรื่อง : ' . $serviceinfos->row()->service_info_suject . "\n" . 'ถูกยกเลิกจากผู้แจ้ง';
                //$this->send_line($serviceinfos->row()->user_line_token, $message);
                //if ($services->num_rows() > 0) {
                //    foreach ($services->result() as $service) {
                //        $this->send_line($service->user_line_token, $message);
                //    }
                //}
            }
            $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ทำรายการสำเร็จแล้ว');
            redirect(base_url('serviecinfo/detail/' . $service_info_id_pri));
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('serviecinfo'));
        }
    }

}
