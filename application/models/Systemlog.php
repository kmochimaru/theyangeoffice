<?php

/*
 * Class name : Systemlog
 * Author : Sakchai Kantada
 * Mail : sakchaiwebmaster@gmail.com
 */

class Systemlog extends CI_Model {

    public function getAgent() {
        $this->load->library('user_agent');
        $agent = $this->agent->browser() . '/' . $this->agent->version();
        $agent = $agent . ' ' . $this->agent->platform();
        $agent = $agent . ' ' . $this->agent->mobile();
        return $agent;
    }

    public function addUserLogin($user_id, $text) {
        $data = array(
            'user_id' => $user_id,
            'log_text' => $text,
            'log_ip_address' => $this->input->ip_address(),
            'log_browser' => $this->getAgent(),
            'log_time' => $this->misc->getDate()
        );
        $this->db->insert('log_user_login', $data);
    }

    //------ check Login------------------------------------------------------------
    public function checkAddLogin($user_id) {
        $this->db->select('user_check_login.login_id');
        $this->db->from('user_check_login');
        $this->db->where('user_check_login.user_id', $user_id);
        return $this->db->get()->num_rows();
    }

    //------ add Login Check-----------------
    public function addLoginCheck($user_id, $regenerate_login) {
        $data = array(
            'user_id' => $user_id,
            'ip_address' => $this->input->ip_address(),
            'regenerate_login' => $regenerate_login,
            'login_last_time' => $this->misc->getDate()
        );
        $this->db->insert('user_check_login', $data);
    }

    //------ update Login Check-----------------
    public function updateLoginCheck($user_id, $regenerate_login) {
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'regenerate_login' => $regenerate_login,
            'login_last_time' => $this->misc->getDate()
        );
        $this->db->where('user_check_login.user_id', $user_id);
        $this->db->update('user_check_login', $data);
    }

    //------ delete Login Check-----------------
    public function deleteLoginCheck($user_id) {
        $this->db->where('user_check_login.user_id', $user_id);
        $this->db->delete('user_check_login');
    }

    //------- Log -----------------
    public function log_send_email($text, $shop_id_pri, $user_id) {
        $data = array(
            'log_text' => $text,
            'shop_id_pri' => $shop_id_pri,
            'user_id' => $user_id,
            'log_time' => $this->misc->getDate()
        );
        $this->db->insert('log_send_email', $data);
    }

    public function log_work_info($text, $id) {
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'work_info_id_pri' => $id,
            'log_text' => $text,
            'log_time' => $this->misc->getDate()
        );
        $this->db->insert('log_work_info', $data);
    }

    public function log_work_process($text, $id) {
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'work_process_id_pri' => $id,
            'log_text' => $text,
            'log_time' => $this->misc->getDate()
        );
        $this->db->insert('log_work_process', $data);
    }

    public function log_work_user($text, $id) {
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'work_user_id' => $id,
            'log_text' => $text,
            'log_time' => $this->misc->getDate()
        );
        $this->db->insert('log_work_user', $data);
    }

    public function log_file($data) {
        $this->db->insert('log_file', $data);
    }

    public function log_send_line($text, $user_id, $line_token) {
        $data = array(
            'log_text' => $text,
            'user_id' => $user_id,
            'log_line_token' => $line_token,
            'log_time' => $this->misc->getDate()
        );
        $this->db->insert('log_send_line', $data);
    }

    public function log_news($work_info_id_pri) {
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'work_info_id_pri' => $work_info_id_pri,
            'log_time' => $this->misc->getDate()
        );
        $this->db->insert('log_news', $data);
    }

    public function log_check_signature($signature_key, $check_text) {
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'signature_key' => $signature_key,
            'check_text' => $check_text,
            'log_check_signature_time' => $this->misc->getDate()
        );
        $this->db->insert('log_check_signature', $data);
    }

    public function log_work_info_edit($data) {
        $this->db->insert('log_work_info_edit', $data);
    }
}
