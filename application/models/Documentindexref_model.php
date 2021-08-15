<?php

/**
 * @author nut
 */
class Documentindexref_model extends CI_Model {

    //put your code here
    public function get_ref_doc_index_year($ref_doc_index_year_id = null) {
        if ($ref_doc_index_year_id != null) {
            $this->db->where('ref_doc_index_year.ref_doc_index_year_id', $ref_doc_index_year_id);
        }
        $this->db->order_by('ref_doc_index_year.ref_doc_index_year_name', 'desc');
        return $this->db->get('ref_doc_index_year');
    }

    public function get_ref_doc_index_category($ref_doc_index_category_id = null) {
        if ($ref_doc_index_category_id != null) {
            $this->db->where('ref_doc_index_category.ref_doc_index_category_id', $ref_doc_index_category_id);
        }
        return $this->db->get('ref_doc_index_category');
    }

    public function get_ref_doc_index_type($ref_doc_index_category_id = null, $ref_doc_index_type_id = null) {
        if ($ref_doc_index_category_id != null) {
            $this->db->where('ref_doc_index_type.ref_doc_index_category_id', $ref_doc_index_category_id);
        }
        if ($ref_doc_index_type_id != null) {
            $this->db->where('ref_doc_index_type.ref_doc_index_type_id', $ref_doc_index_type_id);
        }
        return $this->db->get('ref_doc_index_type');
    }

    public function get_ref_doc_index_budget($ref_doc_index_budget_id = null) {
        if ($ref_doc_index_budget_id != null) {
            $this->db->where('ref_doc_index_budget.ref_doc_index_budget_id', $ref_doc_index_budget_id);
        }
        return $this->db->get('ref_doc_index_budget');
    }

    public function get_ref_doc_index_store1($ref_doc_index_store1_id = null) {
        if ($ref_doc_index_store1_id != null) {
            $this->db->where('ref_doc_index_store1.ref_doc_index_store1_id', $ref_doc_index_store1_id);
        }
        return $this->db->get('ref_doc_index_store1');
    }

    public function get_ref_doc_index_store2($ref_doc_index_store1_id = null, $ref_doc_index_store2_id = null) {
        if ($ref_doc_index_store1_id != null) {
            $this->db->where('ref_doc_index_store2.ref_doc_index_store1_id', $ref_doc_index_store1_id);
        }
        if ($ref_doc_index_store2_id != null) {
            $this->db->where('ref_doc_index_store2.ref_doc_index_store2_id', $ref_doc_index_store2_id);
        }
        return $this->db->get('ref_doc_index_store2');
    }

    public function get_ref_doc_index_store3($ref_doc_index_store2_id = null, $ref_doc_index_store3_id = null) {
        if ($ref_doc_index_store2_id != null) {
            $this->db->where('ref_doc_index_store3.ref_doc_index_store2_id', $ref_doc_index_store2_id);
        }
        if ($ref_doc_index_store3_id != null) {
            $this->db->where('ref_doc_index_store3.ref_doc_index_store3_id', $ref_doc_index_store3_id);
        }
        return $this->db->get('ref_doc_index_store3');
    }

    public function get_ref_doc_index_department($ref_doc_index_department_id = null) {
        if ($ref_doc_index_department_id != null) {
            $this->db->where('ref_doc_index_department.ref_doc_index_department_id', $ref_doc_index_department_id);
        }
        return $this->db->get('ref_doc_index_department');
    }

    public function insertyear($data) {
        $this->db->insert('ref_doc_index_year', $data);
    }

    public function updateyear($ref_doc_index_year_id, $data) {
        $this->db->where('ref_doc_index_year.ref_doc_index_year_id', $ref_doc_index_year_id);
        $this->db->update('ref_doc_index_year', $data);
    }

    public function insertcategory($data) {
        $this->db->insert('ref_doc_index_category', $data);
    }

    public function updatecategory($ref_doc_index_category_id, $data) {
        $this->db->where('ref_doc_index_category.ref_doc_index_category_id', $ref_doc_index_category_id);
        $this->db->update('ref_doc_index_category', $data);
    }

    public function inserttype($data) {
        $this->db->insert('ref_doc_index_type', $data);
    }

    public function updatetype($ref_doc_index_type_id, $data) {
        $this->db->where('ref_doc_index_type.ref_doc_index_type_id', $ref_doc_index_type_id);
        $this->db->update('ref_doc_index_type', $data);
    }

    public function insertbudget($data) {
        $this->db->insert('ref_doc_index_budget', $data);
    }

    public function updatebudget($ref_doc_index_budget_id, $data) {
        $this->db->where('ref_doc_index_budget.ref_doc_index_budget_id', $ref_doc_index_budget_id);
        $this->db->update('ref_doc_index_budget', $data);
    }

    public function insertstore1($data) {
        $this->db->insert('ref_doc_index_store1', $data);
    }

    public function updatestore1($ref_doc_index_store1_id, $data) {
        $this->db->where('ref_doc_index_store1.ref_doc_index_store1_id', $ref_doc_index_store1_id);
        $this->db->update('ref_doc_index_store1', $data);
    }

    public function insertstore2($data) {
        $this->db->insert('ref_doc_index_store2', $data);
    }

    public function updatestore2($ref_doc_index_store2_id, $data) {
        $this->db->where('ref_doc_index_store2.ref_doc_index_store2_id', $ref_doc_index_store2_id);
        $this->db->update('ref_doc_index_store2', $data);
    }

    public function insertstore3($data) {
        $this->db->insert('ref_doc_index_store3', $data);
    }

    public function updatestore3($ref_doc_index_store3_id, $data) {
        $this->db->where('ref_doc_index_store3.ref_doc_index_store3_id', $ref_doc_index_store3_id);
        $this->db->update('ref_doc_index_store3', $data);
    }

    public function insertdepartment($data) {
        $this->db->insert('ref_doc_index_department', $data);
    }

    public function updatedepartment($ref_doc_index_department_id, $data) {
        $this->db->where('ref_doc_index_department.ref_doc_index_department_id', $ref_doc_index_department_id);
        $this->db->update('ref_doc_index_department', $data);
    }

    public function get_ref_doc_index_department_code($ref_doc_index_department_code = null) {
        $this->db->where('ref_doc_index_department.ref_doc_index_department_code', $ref_doc_index_department_code);
        return $this->db->get('ref_doc_index_department');
    }

    public function get_ref_doc_index_department_name($ref_doc_index_department_name = null) {
        $this->db->where('ref_doc_index_department.ref_doc_index_department_name', $ref_doc_index_department_name);
        return $this->db->get('ref_doc_index_department');
    }

}
