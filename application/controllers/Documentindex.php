<?php

/**
 * @author nut
 */
class Documentindex extends CI_Controller {

    //put your code here
    public $per_page = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('documentindex_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'icon' => '',
            'title' => 'ระบบดัชนีเอกสาร',
        );
        $this->load->view('documentindex_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'searchtext' => $this->input->post('searchtext'),
            'start' => $this->input->post('start'),
            'end' => $this->input->post('end'),
            'ref_doc_index_year_id' => $this->input->post('ref_doc_index_year_id'),
            'ref_doc_index_category_id' => $this->input->post('ref_doc_index_category_id'),
            'ref_doc_index_type_id' => $this->input->post('ref_doc_index_type_id'),
            'ref_doc_index_location_id' => $this->input->post('ref_doc_index_location_id'),
            'ref_doc_index_budget_id' => $this->input->post('ref_doc_index_budget_id'),
            'ref_doc_index_store1_id' => $this->input->post('ref_doc_index_store1_id'),
            'ref_doc_index_store2_id' => $this->input->post('ref_doc_index_store2_id'),
            'ref_doc_index_store3_id' => $this->input->post('ref_doc_index_store3_id'),
            'ref_doc_index_department_id' => $this->input->post('ref_doc_index_department_id'),
        );
        $count = $this->documentindex_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('documentindex/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = $this->ajax_pagination->filterParams($filter);
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if ($segment > 0 && $count <= $segment) {
            $segment = $segment - $this->per_page;
        }
        $data = array(
            'data' => $this->documentindex_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/documentindex_pagination', $data);
    }

    public function add_modal() {
        $data = array(
            'data' => ''
        );
        $this->load->view('modal/documentindex_add_modal', $data);
    }

    public function add() {
        $doc_index_year_name = $this->documentindex_model->get_ref_doc_index_year($this->input->post('doc_index_year'))->row()->ref_doc_index_year_name;
        $doc_index_year_code = $this->documentindex_model->get_ref_doc_index_year($this->input->post('doc_index_year'))->row()->ref_doc_index_year_code;
        $doc_index_category_name = $this->documentindex_model->get_ref_doc_index_category($this->input->post('doc_index_category'))->row()->ref_doc_index_category_name;
        $doc_index_category_code = $this->documentindex_model->get_ref_doc_index_category($this->input->post('doc_index_category'))->row()->ref_doc_index_category_code;
        $doc_index_type_name = $this->documentindex_model->get_ref_doc_index_type($this->input->post('doc_index_type'))->row()->ref_doc_index_type_name;
        $doc_index_type_code = $this->documentindex_model->get_ref_doc_index_type($this->input->post('doc_index_type'))->row()->ref_doc_index_type_code;
        $doc_index_budget_name = $this->documentindex_model->get_ref_doc_index_budget($this->input->post('doc_index_budget'))->row()->ref_doc_index_budget_name;
        $doc_index_budget_code = $this->documentindex_model->get_ref_doc_index_budget($this->input->post('doc_index_budget'))->row()->ref_doc_index_budget_code;
        $doc_index_store1_name = null;
        $doc_index_store1_code = '0';
        $doc_index_store2_name = null;
        $doc_index_store2_code = '0';
        $doc_index_store3_name = null;
        $doc_index_store3_code = '0';
        if ($this->input->post('doc_index_store1') != '') {
            $doc_index_store1_name = $this->documentindex_model->get_ref_doc_index_store1($this->input->post('doc_index_store1'))->row()->ref_doc_index_store1_name;
            $doc_index_store1_code = $this->documentindex_model->get_ref_doc_index_store1($this->input->post('doc_index_store1'))->row()->ref_doc_index_store1_code;
        }
        if ($this->input->post('doc_index_store2') != '') {
            $doc_index_store2_name = $this->documentindex_model->get_ref_doc_index_store2($this->input->post('doc_index_store2'), $this->input->post('doc_index_store1'))->row()->ref_doc_index_store2_name;
            $doc_index_store2_code = $this->documentindex_model->get_ref_doc_index_store2($this->input->post('doc_index_store2'), $this->input->post('doc_index_store1'))->row()->ref_doc_index_store2_code;
        }
        if ($this->input->post('doc_index_store3') != '') {
            $doc_index_store3_name = $this->documentindex_model->get_ref_doc_index_store3($this->input->post('doc_index_store3'), $this->input->post('doc_index_store2'))->row()->ref_doc_index_store3_name;
            $doc_index_store3_code = $this->documentindex_model->get_ref_doc_index_store3($this->input->post('doc_index_store3'), $this->input->post('doc_index_store2'))->row()->ref_doc_index_store3_code;
        }
        $doc_index_department = $this->input->post('doc_index_department');
        $doc_index_department_code = '';
        $check = 1;
        if ($doc_index_department != '') {
            foreach ($doc_index_department as $department) {
                if ($check == 1) {
                    $doc_index_department_code .= $department;
                    $check = 0;
                } else {
                    $doc_index_department_code .= '+' . $department;
                }
            }
        }
        //$doc_index_department_code = $this->documentindex_model->get_ref_doc_index_department_code($this->input->post('doc_index_department'))->row()->ref_doc_index_department_code;
        $doc_index_code = $doc_index_year_code . $doc_index_category_code . $doc_index_type_code . $doc_index_budget_code . $doc_index_store1_code . $doc_index_store2_code . $doc_index_store3_code . '/' . $this->input->post('doc_index_number');
        $data = array(
            'doc_index_code' => $doc_index_code,
            'doc_index_year' => $doc_index_year_name,
            'doc_index_category' => $doc_index_category_name,
            'doc_index_type' => $doc_index_type_name,
            'doc_index_date' => $this->input->post('doc_index_date'),
            'doc_index_number' => $this->input->post('doc_index_number'),
            'doc_index_budget' => $doc_index_budget_name,
            'doc_index_amount' => $this->input->post('doc_index_amount'),
            'doc_index_name' => $this->input->post('doc_index_name'),
            'doc_index_detail' => $this->input->post('doc_index_detail'),
            'doc_index_store1' => $doc_index_store1_name,
            'doc_index_store2' => $doc_index_store2_name,
            'doc_index_store3' => $doc_index_store3_name,
            'doc_index_department' => $doc_index_department_code,
            'doc_index_payee' => $this->input->post('doc_index_payee'),
            'doc_index_pathfinder' => $this->input->post('doc_index_pathfinder'),
            'doc_index_update' => $this->misc->getdate(),
            'doc_index_create' => $this->misc->getdate(),
        );
        $this->documentindex_model->insert($data);
        echo 1;
    }

    public function edit_modal() {
        $data = array(
            'data' => $this->documentindex_model->get_doc_index($this->input->post('doc_index_id'))->row(),
        );
        $this->load->view('modal/documentindex_edit_modal', $data);
    }

    public function edit() {
        $doc_index_year_name = $this->documentindex_model->get_ref_doc_index_year($this->input->post('doc_index_year'))->row()->ref_doc_index_year_name;
        $doc_index_year_code = $this->documentindex_model->get_ref_doc_index_year($this->input->post('doc_index_year'))->row()->ref_doc_index_year_code;
        $doc_index_category_name = $this->documentindex_model->get_ref_doc_index_category($this->input->post('doc_index_category'))->row()->ref_doc_index_category_name;
        $doc_index_category_code = $this->documentindex_model->get_ref_doc_index_category($this->input->post('doc_index_category'))->row()->ref_doc_index_category_code;
        $doc_index_type_name = $this->documentindex_model->get_ref_doc_index_type($this->input->post('doc_index_type'))->row()->ref_doc_index_type_name;
        $doc_index_type_code = $this->documentindex_model->get_ref_doc_index_type($this->input->post('doc_index_type'))->row()->ref_doc_index_type_code;
        $doc_index_budget_name = $this->documentindex_model->get_ref_doc_index_budget($this->input->post('doc_index_budget'))->row()->ref_doc_index_budget_name;
        $doc_index_budget_code = $this->documentindex_model->get_ref_doc_index_budget($this->input->post('doc_index_budget'))->row()->ref_doc_index_budget_code;
        $doc_index_store1_name = null;
        $doc_index_store1_code = '0';
        $doc_index_store2_name = null;
        $doc_index_store2_code = '0';
        $doc_index_store3_name = null;
        $doc_index_store3_code = '0';
        if ($this->input->post('doc_index_store1') != '') {
            $doc_index_store1_name = $this->documentindex_model->get_ref_doc_index_store1($this->input->post('doc_index_store1'))->row()->ref_doc_index_store1_name;
            $doc_index_store1_code = $this->documentindex_model->get_ref_doc_index_store1($this->input->post('doc_index_store1'))->row()->ref_doc_index_store1_code;
        }
        if ($this->input->post('doc_index_store2') != '') {
            $doc_index_store2_name = $this->documentindex_model->get_ref_doc_index_store2($this->input->post('doc_index_store2'), $this->input->post('doc_index_store1'))->row()->ref_doc_index_store2_name;
            $doc_index_store2_code = $this->documentindex_model->get_ref_doc_index_store2($this->input->post('doc_index_store2'), $this->input->post('doc_index_store1'))->row()->ref_doc_index_store2_code;
        }
        if ($this->input->post('doc_index_store3') != '') {
            $doc_index_store3_name = $this->documentindex_model->get_ref_doc_index_store3($this->input->post('doc_index_store3'), $this->input->post('doc_index_store2'))->row()->ref_doc_index_store3_name;
            $doc_index_store3_code = $this->documentindex_model->get_ref_doc_index_store3($this->input->post('doc_index_store3'), $this->input->post('doc_index_store2'))->row()->ref_doc_index_store3_code;
        }
        $doc_index_department = $this->input->post('doc_index_department');
        $doc_index_department_code = '';
        $check = 1;
        if ($doc_index_department != '') {
            foreach ($doc_index_department as $department) {
                if ($check == 1) {
                    $doc_index_department_code .= $department;
                    $check = 0;
                } else {
                    $doc_index_department_code .= '+' . $department;
                }
            }
        }
        //$doc_index_department_code = $this->documentindex_model->get_ref_doc_index_department_code($this->input->post('doc_index_department'))->row()->ref_doc_index_department_code;
        $doc_index_code = $doc_index_year_code . $doc_index_category_code . $doc_index_type_code . $doc_index_budget_code . $doc_index_store1_code . $doc_index_store2_code . $doc_index_store3_code . '/' . $this->input->post('doc_index_number');
        $data = array(
            'doc_index_code' => $doc_index_code,
            'doc_index_year' => $doc_index_year_name,
            'doc_index_category' => $doc_index_category_name,
            'doc_index_type' => $doc_index_type_name,
            'doc_index_date' => $this->input->post('doc_index_date'),
            'doc_index_number' => $this->input->post('doc_index_number'),
            'doc_index_budget' => $doc_index_budget_name,
            'doc_index_amount' => $this->input->post('doc_index_amount'),
            'doc_index_name' => $this->input->post('doc_index_name'),
            'doc_index_detail' => $this->input->post('doc_index_detail'),
            'doc_index_store1' => $doc_index_store1_name,
            'doc_index_store2' => $doc_index_store2_name,
            'doc_index_store3' => $doc_index_store3_name,
            'doc_index_department' => $doc_index_department_code,
            'doc_index_payee' => $this->input->post('doc_index_payee'),
            'doc_index_pathfinder' => $this->input->post('doc_index_pathfinder'),
            'doc_index_update' => $this->misc->getdate(),
        );
        $this->documentindex_model->update($this->input->post('doc_index_id'), $data);
        echo 1;
    }

    public function import() {
        $lines = explode("\r\n", file_get_contents($_FILES["file"]["tmp_name"]));
        $data = array();
        //echo sizeof($lines);
        foreach ($lines as $line) {
            $line1 = str_replace('"', "", $line);
            $explode = explode(",", $line1);
            //echo '<pre>';
            if (sizeof($explode) > 1) {
                $data[] = array(
                    'doc_index_year' => $explode[0],
                    'doc_index_category' => $explode[1],
                    'doc_index_type' => $explode[2],
                    'doc_index_date' => $explode[3],
                    'doc_index_number' => $explode[4],
                    'doc_index_budget' => $explode[5],
                    'doc_index_amount' => $explode[6],
                    'doc_index_name' => $explode[7],
                    'doc_index_detail' => $explode[8],
                    'doc_index_store1' => $explode[9],
                    'doc_index_store2' => $explode[10],
                    'doc_index_store3' => $explode[11],
                    'doc_index_department' => $explode[12],
                    'doc_index_payee' => $explode[13],
                    'doc_index_pathfinder' => $explode[14], //คอลัมม์ O
                );
            }
        }
        //print_r($data);
        foreach ($data as $row) {
            if ($row['doc_index_year'] == '') {
                $this->session->set_flashdata('flash_message', 'error', 'เกิดข้อผิดพลาด', 'นำเข้าข้อมูลไม่สำเร็จ');
                redirect(base_url('documentindex'));
            }
        }
        $i = 0;
        foreach ($data as $row) {
            if ($row['doc_index_year'] != '') {
                $dataadd = array(
                    'doc_index_year' => trim($row['doc_index_year']),
                    'doc_index_category' =>  trim($row['doc_index_category']),
                    'doc_index_type' =>  trim($row['doc_index_type']),
                    'doc_index_date' =>  $row['doc_index_date'],
                    'doc_index_number' => trim($row['doc_index_number']),
                    'doc_index_budget' =>  trim($row['doc_index_budget']),
                    'doc_index_amount' =>  $row['doc_index_amount'],
                    'doc_index_name' =>  trim($row['doc_index_name']),
                    'doc_index_detail' =>  trim($row['doc_index_detail']),
                    'doc_index_store1' =>  trim($row['doc_index_store1']),
                    'doc_index_store2' => trim($row['doc_index_store2']),
                    'doc_index_store3' => trim($row['doc_index_store3']),
                    'doc_index_department' => trim($row['doc_index_department']),
                    'doc_index_payee' =>  trim($row['doc_index_payee']),
                    'doc_index_pathfinder' =>  trim($row['doc_index_pathfinder']),
                    'doc_index_update' => $this->misc->getdate(),
                    'doc_index_create' => $this->misc->getdate(),
                );
                $this->documentindex_model->insert($dataadd);
                $i++;
            }
        }
        $this->session->set_flashdata('flash_message', 'success,สำเร็จ,นำเข้าข้อมูลจำนวน ' . $i . ' แถว');
        redirect(base_url('documentindex'));
    }

    public function checkimport() {
        $lines = explode("\r\n", file_get_contents($_FILES["file"]["tmp_name"]));
        $data = array();
        foreach ($lines as $line) {
            $line1 = str_replace('"', "", $line);
            $explode = explode(",", $line1);
            if (sizeof($explode) > 1) {
                $check = 0;
                if (count($explode) == 15) {
                    $check = 1;
                }
                $data[] = array(
                    'doc_index_year' => $explode[0],
                    'doc_index_category' => $explode[1],
                    'doc_index_type' => $explode[2],
                    'doc_index_date' => $explode[3],
                    'doc_index_number' => $explode[4],
                    'doc_index_budget' => $explode[5],
                    'doc_index_amount' => $explode[6],
                    'doc_index_name' => $explode[7],
                    'doc_index_detail' => $explode[8],
                    'doc_index_store1' => $explode[9],
                    'doc_index_store2' => $explode[10],
                    'doc_index_store3' => $explode[11],
                    'doc_index_department' => $explode[12],
                    'doc_index_payee' => $explode[13],
                    'doc_index_pathfinder' => $explode[14],
                    'check' => $check
                );
            }
        }
        $dataarray = array(
            'data' => $data
        );
        $this->load->view('ajax/documentindex_page', $dataarray);
    }

    public function delete_modal() {
        $data = array(
            'data' => $this->documentindex_model->get_doc_index($this->input->post('doc_index_id'))->row(),
        );
        $this->load->view('modal/documentindex_delete_modal', $data);
    }

    public function delete() {
        if ($this->input->post('pass') == 'admin1014') {
            $data = array(
                'doc_index_status' => 2,
            );
            $this->documentindex_model->update($this->input->post('doc_index_id'), $data);
            echo 1;
        } else {
            echo 0;
        }
    }

    public function selectedtype() {
        $types = $this->documentindex_model->get_ref_doc_index_type(null, $this->input->post('doc_index_category'))->result();
        $doc_index_type_id = array();
        $doc_index_type_name = array();
        $i = 0;
        foreach ($types as $type) {
            $doc_index_type_id[$i] = $type->ref_doc_index_type_id;
            $doc_index_type_name[$i] = $type->ref_doc_index_type_name;
            $i++;
        }
        $return["doc_index_type_id"] = $doc_index_type_id;
        $return["doc_index_type_name"] = $doc_index_type_name;
        print json_encode($return);
    }

    public function selectedstore2() {
        $store2s = $this->documentindex_model->get_ref_doc_index_store2(null, $this->input->post('doc_index_store1'))->result();
        $doc_index_store2_id = array();
        $doc_index_store2_name = array();
        $i = 0;
        foreach ($store2s as $store2) {
            $doc_index_store2_id[$i] = $store2->ref_doc_index_store2_id;
            $doc_index_store2_name[$i] = $store2->ref_doc_index_store2_name;
            $i++;
        }
        $return["doc_index_store2_id"] = $doc_index_store2_id;
        $return["doc_index_store2_name"] = $doc_index_store2_name;
        print json_encode($return);
    }

    public function selectedstore3() {
        $store3s = $this->documentindex_model->get_ref_doc_index_store3(null, $this->input->post('doc_index_store2'))->result();
        $doc_index_store3_id = array();
        $doc_index_store3_name = array();
        $i = 0;
        foreach ($store3s as $store3) {
            $doc_index_store3_id[$i] = $store3->ref_doc_index_store3_id;
            $doc_index_store3_name[$i] = $store3->ref_doc_index_store3_name;
            $i++;
        }
        $return["doc_index_store3_id"] = $doc_index_store3_id;
        $return["doc_index_store3_name"] = $doc_index_store3_name;
        print json_encode($return);
    }

    public function processid() {
        $indexs = $this->documentindex_model->get_doc_index();
        if ($indexs->num_rows() > 0) {
            foreach ($indexs->result() as $index) {
                $code = '';
                $year_code = $this->documentindex_model->get_ref_doc_index_year_name($index->doc_index_year);
                if ($year_code->num_rows() > 0) {
                    $code .= $year_code->row()->ref_doc_index_year_code;
                } else {
                    $code .= 'X';
                }
                $category_code = $this->documentindex_model->get_ref_doc_index_category_name($index->doc_index_category);
                if ($category_code->num_rows() > 0) {
                    $code .= $category_code->row()->ref_doc_index_category_code;
                } else {
                    $code .= 'X';
                }
                $type_code = $this->documentindex_model->get_ref_doc_index_type_name($index->doc_index_type);
                if ($type_code->num_rows() > 0) {
                    $code .= $type_code->row()->ref_doc_index_type_code;
                } else {
                    $code .= 'X';
                }
                $budget_code = $this->documentindex_model->get_ref_doc_index_budget_name($index->doc_index_budget);
                if ($budget_code->num_rows() > 0) {
                    $code .= $budget_code->row()->ref_doc_index_budget_code;
                } else {
                    $code .= 'X';
                }
                $store1_code = $this->documentindex_model->get_ref_doc_index_store1_name($index->doc_index_store1);
                if ($store1_code->num_rows() > 0) {
                    $code .= $store1_code->row()->ref_doc_index_store1_code;
                } else {
                    $code .= 'X';
                }
                $store2_code = $this->documentindex_model->get_ref_doc_index_store2_name($index->doc_index_store2);
                if ($store2_code->num_rows() > 0) {
                    $code .= $store2_code->row()->ref_doc_index_store2_code;
                } else {
                    $code .= 'X';
                }
                $store3_code = $this->documentindex_model->get_ref_doc_index_store3_name($index->doc_index_store3);
                if ($store3_code->num_rows() > 0) {
                    $code .= $store3_code->row()->ref_doc_index_store3_code;
                } else {
                    $code .= 'X';
                }
                $code .= $index->doc_index_number != null ? '/' . $index->doc_index_number : '';
                $data = array(
                    'doc_index_code' => $code,
                );
                $this->documentindex_model->update($index->doc_index_id, $data);
            }
        }
        echo 1;
    }
}
