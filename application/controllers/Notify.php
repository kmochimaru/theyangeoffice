<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notify
 *
 * @author nut
 */
class Notify extends CI_Controller {

    //put your code here17 57
    public $group_id = 17;
    public $menu_id = 57;

    //public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('notify_model');
        //$this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.min.css'),
            'js' => array('parsley.min.js'),
            'css_full' => array('plugin/select2/dist/css/select2.min.css'),
            'js_full' => array('plugin/select2/dist/js/select2.full.min.js')
        );
        $this->renderView('notify_view', $data);
    }

    public function ajax_page() {
        $filter = array(
            'dep_id_pri' => $this->input->post('dep_id_pri'),
            'role_id' => $this->input->post('role_id'),
            'searchtext' => $this->input->post('searchtext'),
        );
        $data = array(
            'data' => $this->notify_model->get_user($filter),
        );
        $this->load->view('ajax/notify_page', $data);
    }

    public function add() {
        $select_checkbox = $this->input->post('select_checkbox');
        $notify_message = $this->input->post('notify_message');
        if ($select_checkbox && $notify_message != '') {
            $notify_image = '';
            if (!empty($_FILES['notify_image']['name'])) {
                // upload
                $config_upload = array(
                    'upload_path' => './assets/upload/line/',
                    'allowed_types' => 'jpg|jpeg|png',
                    'overwrite' => 1,
                    'max_size' => 8192,
                    'file_name' => 'line_' . date('YmdHis')
                );
                $this->load->library('upload', $config_upload);
                $width = 800;
                $height = 800;
                if ($this->upload->do_upload('notify_image')) {
                    // resize
                    if ($this->upload->image_width > $width || $this->upload->image_height > $height) {
                        $config_resize = array(
                            'source_image' => $this->upload->upload_path . $this->upload->file_name,
                            'maintain_ratio' => TRUE,
                            'width' => $width,
                            'height' => $height
                        );
                        $this->load->library('image_lib', $config_resize);
                        $this->image_lib->resize();
                    }
                    $notify_image = $this->upload->file_name;
                }
            } else {
                $notify_image = 'none.png';
            }
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'notify_message' => trim($notify_message),
                'notify_image' => base_url() . 'assets/upload/line/' . $notify_image,
                'notify_fileimage' => $notify_image,
                //'notify_image' => 'https://e-office.rmutl.ac.th/assets/upload/line/' . $notify_image,
                'notify_create' => $this->misc->getdate(),
                'notify_update' => $this->misc->getdate(),
            );
            $notify_id = $this->notify_model->insert_notify($data);

            if ($notify_id) {
                foreach ($select_checkbox as $user_id) {
                    $get_line_token = $this->notify_model->get_line_token($user_id);
                    if ($get_line_token->num_rows() == 1) {
                        $line_token = $get_line_token->row()->user_line_token;
                        $data = array(
                            'notify_id' => $notify_id,
                            'user_id' => $user_id,
                            'line_token' => $line_token,
                            'notification_status_id' => 0,
                            'notification_modify' => date('Y-m-d H:i:s')
                        );
                        $this->notify_model->insert_notification($data);
                    }
                }
            }

            $this->session->set_flashdata('flash_message', 'success,ทำรายการสำเร็จ !,เพิ่มรายการเรียบร้อยแล้ว');
            redirect(base_url('notifylist'));
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด !,เพิ่มรายการไม่สำเร็จ');
            redirect(base_url('notify'));
        }
    }

}
