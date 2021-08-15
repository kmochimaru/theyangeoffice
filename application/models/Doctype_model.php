<?php

class Doctype_model extends CI_Model {

    public function getDoctype() {
        $this->db->select('*');
        $this->db->order_by('ref_doc_type.doc_type_sort', 'ASC');
        return $this->db->get('ref_doc_type');
    }
    
    public function getDoctypeById($doc_type_id) {
        $this->db->select('*');
        $this->db->where('ref_doc_type.doc_type_id', $doc_type_id);
        return $this->db->get('ref_doc_type');
    }

    public function insert($data) {
        $this->db->insert('ref_doc_type', $data);
    }

    public function update($doc_type_id, $data) {
        $this->db->where('ref_doc_type.doc_type_id', $doc_type_id);
        $this->db->update('ref_doc_type', $data);
    }
    
    public function delete($doc_type_id) {
        $this->db->where('ref_doc_type.doc_type_id', $doc_type_id);
        $this->db->delete('ref_doc_type');
    }

}
