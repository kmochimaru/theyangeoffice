<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notifylist_model
 *
 * @author nut
 */
class Notifylist_model extends CI_Model {

    //put your code here
    public function count_pagination($filter) {
        $this->db->select('notify.notify_id');
        $this->db->from('notify');
        //$this->db->join('notification', 'notification.notify_id = notify.notify_id');
        //$this->db->join('user', 'notification.user_id = user.user_id');
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                notify.notify_message LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        return $this->db->get()->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('*');
        $this->db->from('notify');
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                notify.notify_message LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('notify.notify_create');
        return $this->db->get();
    }

    public function get_notify($notify_id) {
        $this->db->select('*');
        $this->db->from('notify');
        $this->db->where('notify.notify_id', $notify_id);
        return $this->db->get();
    }

    public function get_notification($notify_id) {
        $this->db->from('notify');
        $this->db->join('notification', 'notification.notify_id = notify.notify_id');
        $this->db->join('user', 'notification.user_id = user.user_id');
        $this->db->where('notify.notify_id', $notify_id);
        return $this->db->get();
    }

    public function get_notification_id($notification_id) {
        $this->db->from('notify');
        $this->db->join('notification', 'notification.notify_id = notify.notify_id');
        $this->db->join('user', 'notification.user_id = user.user_id');
        $this->db->where('notification.notification_id', $notification_id);
        return $this->db->get();
    }

    public function count_send($notify_id, $notification_status_id) {
        $this->db->select('notification.user_id');
        $this->db->from('notification');
        $this->db->where('notification.notify_id', $notify_id);
        $this->db->where('notification.notification_status_id', $notification_status_id);
        return $this->db->get()->num_rows();
    }

    public function delete_notify($notify_id) {
        $this->db->where('notify.notify_id', $notify_id);
        $this->db->delete('notify');
    }

    public function delete_notification($notify_id) {
        $this->db->where('notification.notify_id', $notify_id);
        $this->db->delete('notification');
    }

    public function update_notification($notification, $data) {
        $this->db->where('notification.notification_id', $notification);
        $this->db->update('notification', $data);
    }

    public function get_user($user_id) {
        $this->db->from('user');
        $this->db->join('user_dep_off', 'user_dep_off.user_id = user.user_id');
        $this->db->join('dep_off', 'user_dep_off.dep_off_id = dep_off.dep_off_id');
        $this->db->join('department', 'dep_off.dep_id_pri = department.dep_id_pri');
        $this->db->join('officer', 'dep_off.officer_id = officer.officer_id');
        $this->db->where('user.user_id', $user_id);
        $this->db->where('user_dep_off.user_dep_off_active_id', 1);
        return $this->db->get()->row();
    }

}
