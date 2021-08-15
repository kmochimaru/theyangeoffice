<?php

// @tomtom

class Groupmenu_model extends CI_Model {

    // group menu
    public function get_groupmenu($id = NULL) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('group_menu_id', $id);
        }
        $this->db->order_by('group_menu.group_menu_sort');
        return $this->db->get('group_menu');
    }

    public function get_last_groupmenu() {
        $this->db->select('group_menu.group_menu_sort');
        $this->db->order_by('group_menu.group_menu_sort', 'desc');
        return $this->db->get('group_menu');
    }

    public function checkgroupmenu($group_menu_id) {
        $this->db->from('menu');
        $this->db->where('menu.group_menu_id', $group_menu_id);
        return $this->db->count_all_results();
    }

    public function addgroupmenu($data) {
        $this->db->insert('group_menu', $data);
    }

    public function editgroupmenu($id, $data) {
        $this->db->where('group_menu.group_menu_id', $id);
        $this->db->update('group_menu', $data);
    }

    public function deletegroupmenu($id) {
        $this->db->where('group_menu.group_menu_id', $id);
        $this->db->delete('group_menu');
    }

    // menu
    public function get_menu($id = NULL) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('menu_id', $id);
        }
        $this->db->order_by('menu.menu_sort');
        return $this->db->get('menu');
    }

    public function get_menu_all($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('group_menu_id', $id);
        }
        $this->db->order_by('menu.menu_sort');
        return $this->db->get('menu');
    }

    public function get_last_menu($group_menu_id) {
        $this->db->select('menu.menu_sort');
        $this->db->where('menu.group_menu_id', $group_menu_id);
        $this->db->order_by('menu.menu_sort', 'desc');
        return $this->db->get('menu');
    }

    public function checkmenu($menu_id) {
        $this->db->from('map_menu_role');
        $this->db->where('map_menu_role.menu_id', $menu_id);
        return $this->db->count_all_results();
    }

    public function addmenu($data) {
        $this->db->insert('menu', $data);
    }

    public function editmenu($id, $data) {
        $this->db->where('menu.menu_id', $id);
        $this->db->update('menu', $data);
    }

    public function deletemenu($id) {
        $this->db->where('menu.menu_id', $id);
        $this->db->delete('menu');
    }

}
