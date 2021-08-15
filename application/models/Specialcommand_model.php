<?php

class Specialcommand_model extends CI_Model {

    public function getSpecialcommand() {
        $this->db->select('*');
        $this->db->order_by('ref_special_command.special_command_sort', 'ASC');
        return $this->db->get('ref_special_command');
    }

    public function getSpecialcommandById($special_command_id) {
        $this->db->select('*');
        $this->db->where('ref_special_command.special_command_id', $special_command_id);
        return $this->db->get('ref_special_command');
    }

    public function insert($data) {
        $this->db->insert('ref_special_command', $data);
    }

    public function update($special_command_id, $data) {
        $this->db->where('ref_special_command.special_command_id', $special_command_id);
        $this->db->update('ref_special_command', $data);
    }

    public function delete($special_command_id) {
        $this->db->where('ref_special_command.special_command_id', $special_command_id);
        $this->db->delete('ref_special_command');
    }

    public function getworkprocess($special_command_id) {
        $this->db->select('work_process.special_command_id');
        $this->db->where('work_process.special_command_id', $special_command_id);
        return $this->db->get('work_process');
    }
}
