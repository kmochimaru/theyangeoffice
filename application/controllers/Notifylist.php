<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notifylist
 *
 * @author nut
 */
class Notifylist extends CI_Controller {

    //put your code here
    public $group_id = 17;
    public $menu_id = 58;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('notifylist_model');
        $this->load->library('ajax_pagination');
        $this->load->library('../controllers/line');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.min.css'),
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js' => array('parsley.min.js'),
            'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js')
        );
        $this->renderView('notifylist_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'searchtext' => $this->input->post('searchtext'),
        );
        $count = $this->notifylist_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('notifylist/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->notifylist_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/notifylist_pagination', $data);
    }

    public function delete_modal() {
        $data = array(
            'notify_id' => $this->input->post('notify_id')
        );
        $this->load->view('modal/notifylist_delete_modal', $data);
    }

    public function delete() {
        if ($this->input->post('notify_id') != '') {
            $notifys = $this->notifylist_model->get_notify($this->input->post('notify_id'));
            if ($notifys->num_rows() == 1) {
                $notify = $notifys->row();
                if ($notify->notify_image != 'none.png') {
                    @unlink('./assets/upload/line/' . $notify->notify_fileimage);
                }
                $this->notifylist_model->delete_notification($this->input->post('notify_id'));
                $this->notifylist_model->delete_notify($this->input->post('notify_id'));
                $this->session->set_flashdata('flash_message', 'success,ทำรายการสำเร็จ !,ลบรายการเรียบร้อยแล้ว');
                redirect(base_url('notifylist'));
            } else {
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด !,ลบรายการไม่สำเร็จ');
                redirect(base_url('notifylist'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด !,ลบรายการไม่สำเร็จ');
            redirect(base_url('notifylist'));
        }
    }

    public function send($notify_id) {
        $notifys = $this->notifylist_model->get_notify($notify_id);
        if ($notifys->num_rows() == 1) {
            $notify = $notifys->row();
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css' => array('parsley.min.css'),
                'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
                'js' => array('parsley.min.js'),
                'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js'),
                'data' => $notify,
            );
            $this->renderView('notifysend_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด !,ลบรายการไม่สำเร็จ');
            redirect(base_url('notifylist'));
        }
    }

    public function notification() {
        $notification_id = $this->input->post('id');
        if ($notification_id != '') {
            $notification = $this->notifylist_model->get_notification_id($notification_id);
            if ($notification->num_rows() == 1) {
                $row = $notification->row();
                $img = $row->notify_image;
                if ($row->notify_fileimage != 'none.png') {
                    $status = $this->send_line($row->line_token, $row->notify_message, $img);
                } else {
                    $status = $this->send_line($row->line_token, $row->notify_message);
                }
                if ($status == 1) {
                    $data = array(
                        'notification_status_id' => 1,
                        'notification_modify' => $this->misc->getdate()
                    );
                    $this->notifylist_model->update_notification($notification_id, $data);
                }
                echo $status;
            }
        } else {
            echo $status;
        }
    }

    // send line
    public function send_line($line_token, $message, $img = null) {
        if ($line_token != null && $line_token != '') {
            $status = $this->line->line_notification($line_token, $message, $img);
            if ($status == 1) {
                $this->systemlog->log_send_line($message, $this->session->userdata('user_id'), $line_token);
            }
        }
        return $status;
    }

}
