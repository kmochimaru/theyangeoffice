<?php

class Bookgroup_model extends CI_Model {

    public function getBookGroup() {
        $this->db->select('*');
        $this->db->order_by('ref_book_group.book_group_sort', 'ASC');
        return $this->db->get('ref_book_group');
    }
    
    public function getBookGroupById($book_group_id) {
        $this->db->select('*');
        $this->db->where('ref_book_group.book_group_id', $book_group_id);
        return $this->db->get('ref_book_group');
    }

    public function insert($data) {
        $this->db->insert('ref_book_group', $data);
    }

    public function update($book_group_id, $data) {
        $this->db->where('ref_book_group.book_group_id', $book_group_id);
        $this->db->update('ref_book_group', $data);
    }
    
    public function delete($book_group_id) {
         $this->db->where('ref_book_group.book_group_id', $book_group_id);
        $this->db->delete('ref_book_group');
    }

}
