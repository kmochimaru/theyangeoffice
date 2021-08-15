<?php

class Wordcomment_model extends CI_Model {

    public function getWordComment() {
        $this->db->select('*');
        $this->db->order_by('word_comment.word_sort', 'ASC');
        return $this->db->get('word_comment');
    }
    
    public function getWordCommentById($word_id) {
        $this->db->select('*');
        $this->db->where('word_comment.word_id', $word_id);
        return $this->db->get('word_comment');
    }

    public function insert($data) {
        $this->db->insert('word_comment', $data);
    }

    public function update($word_id, $data) {
        $this->db->where('word_comment.word_id', $word_id);
        $this->db->update('word_comment', $data);
    }
    
    public function delete($word_id) {
        $this->db->where('word_comment.word_id', $word_id);
        $this->db->delete('word_comment');
    }

}
