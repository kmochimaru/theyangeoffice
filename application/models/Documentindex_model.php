<?php

/**
 * @author nut
 */
class Documentindex_model extends CI_Model {

    //put your code here
    public function count_pagination($filter) {
        $this->db->select('doc_index.doc_index_id');
        $this->db->from('doc_index');
        $this->db->where('doc_index.doc_index_status', 1);
        $this->db->where('doc_index.doc_index_date >=', $filter['start'] . ' 00:00:00');
        $this->db->where('doc_index.doc_index_date <=', $filter['end'] . ' 23:59:59');
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                doc_index.doc_index_code LIKE '%" . $filter['searchtext'] . "%' OR
                doc_index.doc_index_number LIKE '%" . $filter['searchtext'] . "%' OR
                doc_index.doc_index_name LIKE '%" . $filter['searchtext'] . "%' OR
                doc_index.doc_index_payee LIKE '%" . $filter['searchtext'] . "%' OR
                doc_index.doc_index_pathfinder LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        if ($filter['ref_doc_index_year_id'] != '') {
            $this->db->where('doc_index.doc_index_year', $filter['ref_doc_index_year_id']);
        }
        if ($filter['ref_doc_index_category_id'] != '') {
            $this->db->where('doc_index.doc_index_category', $filter['ref_doc_index_category_id']);
        }
        if ($filter['ref_doc_index_type_id'] != '') {
            $this->db->where('doc_index.doc_index_type', $filter['ref_doc_index_type_id']);
        }
        if ($filter['ref_doc_index_location_id'] != '') {
            $this->db->where('doc_index.doc_index_location', $filter['ref_doc_index_location_id']);
        }
        if ($filter['ref_doc_index_budget_id'] != '') {
            $this->db->where('doc_index.doc_index_budget', $filter['ref_doc_index_budget_id']);
        }
        if ($filter['ref_doc_index_store1_id'] != '') {
            $this->db->where('doc_index.doc_index_store1', $filter['ref_doc_index_store1_id']);
        }
        if ($filter['ref_doc_index_store2_id'] != '') {
            $this->db->where('doc_index.doc_index_store2', $filter['ref_doc_index_store2_id']);
        }
        if ($filter['ref_doc_index_store3_id'] != '') {
            $this->db->where('doc_index.doc_index_store3', $filter['ref_doc_index_store3_id']);
        }
        if ($filter['ref_doc_index_department_id'] != '') {
            $this->db->where("doc_index.doc_index_department LIKE '%" . $filter['ref_doc_index_department_id'] . "%'");
        }
        return $this->db->get()->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('*');
        $this->db->from('doc_index');
        $this->db->where('doc_index.doc_index_status', 1);
        $this->db->where('doc_index.doc_index_date >=', $filter['start'] . ' 00:00:00');
        $this->db->where('doc_index.doc_index_date <=', $filter['end'] . ' 23:59:59');
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                doc_index.doc_index_code LIKE '%" . $filter['searchtext'] . "%' OR
                doc_index.doc_index_number LIKE '%" . $filter['searchtext'] . "%' OR
                doc_index.doc_index_name LIKE '%" . $filter['searchtext'] . "%' OR
                doc_index.doc_index_payee LIKE '%" . $filter['searchtext'] . "%' OR
                doc_index.doc_index_pathfinder LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        if ($filter['ref_doc_index_year_id'] != '') {
            $this->db->where('doc_index.doc_index_year', $filter['ref_doc_index_year_id']);
        }
        if ($filter['ref_doc_index_category_id'] != '') {
            $this->db->where('doc_index.doc_index_category', $filter['ref_doc_index_category_id']);
        }
        if ($filter['ref_doc_index_type_id'] != '') {
            $this->db->where('doc_index.doc_index_type', $filter['ref_doc_index_type_id']);
        }
        if ($filter['ref_doc_index_location_id'] != '') {
            $this->db->where('doc_index.doc_index_location', $filter['ref_doc_index_location_id']);
        }
        if ($filter['ref_doc_index_budget_id'] != '') {
            $this->db->where('doc_index.doc_index_budget', $filter['ref_doc_index_budget_id']);
        }
        if ($filter['ref_doc_index_store1_id'] != '') {
            $this->db->where('doc_index.doc_index_store1', $filter['ref_doc_index_store1_id']);
        }
        if ($filter['ref_doc_index_store2_id'] != '') {
            $this->db->where('doc_index.doc_index_store2', $filter['ref_doc_index_store2_id']);
        }
        if ($filter['ref_doc_index_store3_id'] != '') {
            $this->db->where('doc_index.doc_index_store3', $filter['ref_doc_index_store3_id']);
        }
        if ($filter['ref_doc_index_department_id'] != '') {
            $this->db->where("doc_index.doc_index_department LIKE '%" . $filter['ref_doc_index_department_id'] . "%'");
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('doc_index.doc_index_number');
        $this->db->order_by('doc_index.doc_index_id');
        return $this->db->get();
    }

    public function get_doc_index($doc_index_id = null) {
        $this->db->select('*');
        $this->db->from('doc_index');
        $this->db->where('doc_index.doc_index_status', 1);
        if ($doc_index_id != null) {
            $this->db->where('doc_index.doc_index_id', $doc_index_id);
        }
        $this->db->order_by('doc_index.doc_index_date', 'desc');
        return $this->db->get();
    }

    public function minyear() {
        $this->db->select('MIN(YEAR(doc_index.doc_index_date)) AS minyear');
        return $this->db->get('doc_index');
    }

    public function mindate() {
        $this->db->select('MIN(DATE(doc_index.doc_index_date)) AS mindate');
        return $this->db->get('doc_index');
    }

    public function get_ref_doc_index_year($ref_doc_index_year_id = null) {
        if ($ref_doc_index_year_id != null) {
            $this->db->where('ref_doc_index_year.ref_doc_index_year_id', $ref_doc_index_year_id);
        }
        return $this->db->get('ref_doc_index_year');
    }
    
    public function get_ref_doc_index_year_name($ref_doc_index_year_name = null) {
        if ($ref_doc_index_year_name != null) {
            $this->db->where('ref_doc_index_year.ref_doc_index_year_name', $ref_doc_index_year_name);
        }
        return $this->db->get('ref_doc_index_year');
    }

    public function get_ref_doc_index_category($ref_doc_index_category_id = null) {
        if ($ref_doc_index_category_id != null) {
            $this->db->where('ref_doc_index_category.ref_doc_index_category_id', $ref_doc_index_category_id);
        }
        return $this->db->get('ref_doc_index_category');
    }

    public function get_ref_doc_index_category_name($ref_doc_index_category_name = null) {
        if ($ref_doc_index_category_name != null) {
            $this->db->where('ref_doc_index_category.ref_doc_index_category_name', $ref_doc_index_category_name);
        }
        return $this->db->get('ref_doc_index_category');
    }

    public function get_ref_doc_index_type($ref_doc_index_type_id = null, $ref_doc_index_category_id = null) {
        $this->db->join('ref_doc_index_category', 'ref_doc_index_type.ref_doc_index_category_id = ref_doc_index_category.ref_doc_index_category_id');
        if ($ref_doc_index_type_id != null) {
            $this->db->where('ref_doc_index_type.ref_doc_index_type_id', $ref_doc_index_type_id);
        }
        if ($ref_doc_index_category_id != null) {
            $this->db->where('ref_doc_index_type.ref_doc_index_category_id', $ref_doc_index_category_id);
        }
        return $this->db->get('ref_doc_index_type');
    }

    public function get_ref_doc_index_type_name($ref_doc_index_type_name = null) {
        if ($ref_doc_index_type_name != null) {
            $this->db->where('ref_doc_index_type.ref_doc_index_type_name', $ref_doc_index_type_name);
        }
        return $this->db->get('ref_doc_index_type');
    }

    public function get_ref_doc_index_budget($ref_doc_index_budget_id = null) {
        if ($ref_doc_index_budget_id != null) {
            $this->db->where('ref_doc_index_budget.ref_doc_index_budget_id', $ref_doc_index_budget_id);
        }
        return $this->db->get('ref_doc_index_budget');
    }
    
    public function get_ref_doc_index_budget_name($ref_doc_index_budget_name = null) {
        if ($ref_doc_index_budget_name != null) {
            $this->db->where('ref_doc_index_budget.ref_doc_index_budget_name', $ref_doc_index_budget_name);
        }
        return $this->db->get('ref_doc_index_budget');
    }

    public function get_ref_doc_index_store1($ref_doc_index_store1_id = null) {
        if ($ref_doc_index_store1_id != null) {
            $this->db->where('ref_doc_index_store1.ref_doc_index_store1_id', $ref_doc_index_store1_id);
        }
        return $this->db->get('ref_doc_index_store1');
    }

    public function get_ref_doc_index_store1_name($ref_doc_index_store1_name = null) {
        if ($ref_doc_index_store1_name != null) {
            $this->db->where('ref_doc_index_store1.ref_doc_index_store1_name', $ref_doc_index_store1_name);
        } else {
            $this->db->group_by('ref_doc_index_store1.ref_doc_index_store1_name');
            $this->db->order_by('ref_doc_index_store1.ref_doc_index_store1_id');
        }
        return $this->db->get('ref_doc_index_store1');
    }

    public function get_ref_doc_index_store2_name($ref_doc_index_store2_name = null) {
        if ($ref_doc_index_store2_name != null) {
            $this->db->where('ref_doc_index_store2.ref_doc_index_store2_name', $ref_doc_index_store2_name);
        } else {
            $this->db->group_by('ref_doc_index_store2.ref_doc_index_store2_name');
            $this->db->order_by('ref_doc_index_store2.ref_doc_index_store2_id');
        }
        return $this->db->get('ref_doc_index_store2');
    }

    public function get_ref_doc_index_store2($ref_doc_index_store2_id = null, $ref_doc_index_store1_id = null) {
        $this->db->join('ref_doc_index_store1', 'ref_doc_index_store2.ref_doc_index_store1_id = ref_doc_index_store1.ref_doc_index_store1_id');
        if ($ref_doc_index_store2_id != null) {
            $this->db->where('ref_doc_index_store2.ref_doc_index_store2_id', $ref_doc_index_store2_id);
        }
        if ($ref_doc_index_store1_id != null) {
            $this->db->where('ref_doc_index_store2.ref_doc_index_store1_id', $ref_doc_index_store1_id);
        } else {
            $this->db->where('ref_doc_index_store2.ref_doc_index_store1_id', 0);
        }
        return $this->db->get('ref_doc_index_store2');
    }

    public function get_ref_doc_index_store3_name($ref_doc_index_store3_name = null) {
        if ($ref_doc_index_store3_name != null) {
            $this->db->where('ref_doc_index_store3.ref_doc_index_store3_name', $ref_doc_index_store3_name);
        } else {
            $this->db->group_by('ref_doc_index_store3.ref_doc_index_store3_name');
            $this->db->order_by('ref_doc_index_store3.ref_doc_index_store3_id');
        }
        return $this->db->get('ref_doc_index_store3');
    }

    public function get_ref_doc_index_store3($ref_doc_index_store3_id = null, $ref_doc_index_store2_id = null) {
        $this->db->join('ref_doc_index_store2', 'ref_doc_index_store3.ref_doc_index_store2_id = ref_doc_index_store2.ref_doc_index_store2_id');
        if ($ref_doc_index_store3_id != null) {
            $this->db->where('ref_doc_index_store3.ref_doc_index_store3_id', $ref_doc_index_store3_id);
        }
        if ($ref_doc_index_store2_id != null) {
            $this->db->where('ref_doc_index_store3.ref_doc_index_store2_id', $ref_doc_index_store2_id);
        } else {
            $this->db->where('ref_doc_index_store3.ref_doc_index_store2_id', 0);
        }
        return $this->db->get('ref_doc_index_store3');
    }

    public function get_ref_doc_index_department($ref_doc_index_department_id = null) {
        if ($ref_doc_index_department_id != null) {
            $this->db->where('ref_doc_index_department.ref_doc_index_department_id', $ref_doc_index_department_id);
        }
        return $this->db->get('ref_doc_index_department');
    }

    public function get_ref_doc_index_department_code($ref_doc_index_department_code = null) {
        if ($ref_doc_index_department_code != null) {
            $this->db->where('ref_doc_index_department.ref_doc_index_department_code', $ref_doc_index_department_code);
        }
        return $this->db->get('ref_doc_index_department');
    }

    public function insert($data) {
        $this->db->insert('doc_index', $data);
    }

    public function update($doc_index_id, $data) {
        $this->db->where('doc_index.doc_index_id', $doc_index_id);
        $this->db->update('doc_index', $data);
    }

}
