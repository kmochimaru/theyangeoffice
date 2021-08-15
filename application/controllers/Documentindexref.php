<?php

/**
 * @author nut
 */
class Documentindexref extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('documentindexref_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'icon' => '',
            'title' => 'ระบบดัชนีเอกสาร',
            'data_years' => $this->documentindexref_model->get_ref_doc_index_year(),
            'data_categorys' => $this->documentindexref_model->get_ref_doc_index_category(),
            'data_budgets' => $this->documentindexref_model->get_ref_doc_index_budget(),
            'data_stores1' => $this->documentindexref_model->get_ref_doc_index_store1(),
            'data_departments' => $this->documentindexref_model->get_ref_doc_index_department(),
        );
        $this->load->view('documentindexref_view', $data);
    }

    public function add_modal_year() {
        $data = array(
            'data' => ''
        );
        $this->load->view('modal/documentindex_year_add_modal', $data);
    }

    public function add_modal_category() {
        $data = array(
            'data' => ''
        );
        $this->load->view('modal/documentindex_category_add_modal', $data);
    }

    public function add_modal_type() {
        $data = array(
            'data' => $this->documentindexref_model->get_ref_doc_index_category($this->input->post('ref_doc_index_category_id'))->row()
        );
        $this->load->view('modal/documentindex_type_add_modal', $data);
    }

    public function add_modal_budget() {
        $data = array(
            'data' => ''
        );
        $this->load->view('modal/documentindex_budget_add_modal', $data);
    }

    public function add_modal_store1() {
        $data = array(
            'data' => ''
        );
        $this->load->view('modal/documentindex_store1_add_modal', $data);
    }

    public function add_modal_store2() {
        $data = array(
            'data' => $this->documentindexref_model->get_ref_doc_index_store1($this->input->post('ref_doc_index_store1_id'))->row()
        );
        $this->load->view('modal/documentindex_store2_add_modal', $data);
    }

    public function add_modal_store3() {
        $data = array(
            'data' => $this->documentindexref_model->get_ref_doc_index_store2(null,$this->input->post('ref_doc_index_store2_id'))->row()
        );
        $this->load->view('modal/documentindex_store3_add_modal', $data);
    }

    public function add_modal_department() {
        $data = array(
            'data' => ''
        );
        $this->load->view('modal/documentindex_department_add_modal', $data);
    }

    public function import_modal_department() {
        $data = array(
            'data' => ''
        );
        $this->load->view('modal/documentindex_department_import_modal', $data);
    }

    public function add_year() {
        $data = array(
            'ref_doc_index_year_code' => $this->input->post('ref_doc_index_year_code'),
            'ref_doc_index_year_name' => $this->input->post('ref_doc_index_year_name'),
        );
        $this->documentindexref_model->insertyear($data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลสำเร็จ');
        redirect(base_url('documentindexref'));
    }

    public function add_category() {
        $data = array(
            'ref_doc_index_category_code' => $this->input->post('ref_doc_index_category_code'),
            'ref_doc_index_category_name' => $this->input->post('ref_doc_index_category_name'),
        );
        $this->documentindexref_model->insertcategory($data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลสำเร็จ');
        redirect(base_url('documentindexref'));
    }

    public function add_type() {
        $data = array(
            'ref_doc_index_category_id' => $this->input->post('ref_doc_index_category_id'),
            'ref_doc_index_type_code' => $this->input->post('ref_doc_index_type_code'),
            'ref_doc_index_type_name' => $this->input->post('ref_doc_index_type_name'),
        );
        $this->documentindexref_model->inserttype($data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลสำเร็จ');
        redirect(base_url('documentindexref'));
    }

    public function add_budget() {
        $data = array(
            'ref_doc_index_budget_code' => $this->input->post('ref_doc_index_budget_code'),
            'ref_doc_index_budget_name' => $this->input->post('ref_doc_index_budget_name'),
        );
        $this->documentindexref_model->insertbudget($data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลสำเร็จ');
        redirect(base_url('documentindexref'));
    }

    public function add_store1() {
        $data = array(
            'ref_doc_index_store1_code' => $this->input->post('ref_doc_index_store1_code'),
            'ref_doc_index_store1_name' => $this->input->post('ref_doc_index_store1_name'),
        );
        $this->documentindexref_model->insertstore1($data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลสำเร็จ');
        redirect(base_url('documentindexref'));
    }

    public function add_store2() {
        $data = array(
            'ref_doc_index_store1_id' => $this->input->post('ref_doc_index_store1_id'),
            'ref_doc_index_store2_code' => $this->input->post('ref_doc_index_store2_code'),
            'ref_doc_index_store2_name' => $this->input->post('ref_doc_index_store2_name'),
        );
        $this->documentindexref_model->insertstore2($data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลสำเร็จ');
        redirect(base_url('documentindexref'));
    }

    public function add_store3() {
        $data = array(
            'ref_doc_index_store2_id' => $this->input->post('ref_doc_index_store2_id'),
            'ref_doc_index_store3_code' => $this->input->post('ref_doc_index_store3_code'),
            'ref_doc_index_store3_name' => $this->input->post('ref_doc_index_store3_name'),
        );
        $this->documentindexref_model->insertstore3($data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลสำเร็จ');
        redirect(base_url('documentindexref'));
    }

    public function add_department() {
        $data = array(
            'ref_doc_index_department_code' => $this->input->post('ref_doc_index_department_code'),
            'ref_doc_index_department_name' => $this->input->post('ref_doc_index_department_name'),
        );
        $this->documentindexref_model->insertdepartment($data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลสำเร็จ');
        redirect(base_url('documentindexref'));
    }

    public function import_department() {
        $lines = explode("\r\n", file_get_contents($_FILES["file"]["tmp_name"]));
        $data = array();
        $i = 0;
        //echo sizeof($lines);
        foreach ($lines as $line) {
            $explode = explode(",", $line);
            //echo '<pre>';
            if ($i != 0) {
                if (sizeof($explode) > 1) {
                    $data[] = array(
                        'ref_doc_index_department_code' => $explode[0],
                        'ref_doc_index_department_name' => $explode[1],
                    );
                }
            }
            $i++;
        }
        //print_r($data);
        foreach ($data as $row) {
            if ($row['ref_doc_index_department_code'] == '' || $row['ref_doc_index_department_name'] == '') {
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,เพิ่มข้อมูลไม่สำเร็จ');
                redirect(base_url('documentindexref'));
            }
        }
        foreach ($data as $row) {
            if ($this->documentindexref_model->get_ref_doc_index_department_code($row['ref_doc_index_department_code'])->num_rows() == 0) {
                if ($this->documentindexref_model->get_ref_doc_index_department_name($row['ref_doc_index_department_name'])->num_rows() == 0) {
                    $dataadd = array(
                        'ref_doc_index_department_code' => $row['ref_doc_index_department_code'],
                        'ref_doc_index_department_name' => $row['ref_doc_index_department_name']
                    );
                    $this->documentindexref_model->insertdepartment($dataadd);
                }
            }
        }
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เพิ่มข้อมูลสำเร็จ');
        redirect(base_url('documentindexref'));
    }

    public function edit_modal_year() {
        $data = array(
            'data' => $this->documentindexref_model->get_ref_doc_index_year($this->input->post('ref_doc_index_year_id'))->row()
        );
        $this->load->view('modal/documentindex_year_edit_modal', $data);
    }

    public function edit_modal_category() {
        $data = array(
            'data' => $this->documentindexref_model->get_ref_doc_index_category($this->input->post('ref_doc_index_category_id'))->row()
        );
        $this->load->view('modal/documentindex_category_edit_modal', $data);
    }

    public function edit_modal_type() {
        $data = array(
            'data' => $this->documentindexref_model->get_ref_doc_index_type(null, $this->input->post('ref_doc_index_type_id'))->row()
        );
        $this->load->view('modal/documentindex_type_edit_modal', $data);
    }

    public function edit_modal_budget() {
        $data = array(
            'data' => $this->documentindexref_model->get_ref_doc_index_budget($this->input->post('ref_doc_index_budget_id'))->row()
        );
        $this->load->view('modal/documentindex_budget_edit_modal', $data);
    }

    public function edit_modal_store1() {
        $data = array(
            'data' => $this->documentindexref_model->get_ref_doc_index_store1($this->input->post('ref_doc_index_store1_id'))->row()
        );
        $this->load->view('modal/documentindex_store1_edit_modal', $data);
    }

    public function edit_modal_store2() {
        $data = array(
            'data' => $this->documentindexref_model->get_ref_doc_index_store2(null,$this->input->post('ref_doc_index_store2_id'))->row()
        );
        $this->load->view('modal/documentindex_store2_edit_modal', $data);
    }

    public function edit_modal_store3() {
        $data = array(
            'data' => $this->documentindexref_model->get_ref_doc_index_store3(null,$this->input->post('ref_doc_index_store3_id'))->row()
        );
        $this->load->view('modal/documentindex_store3_edit_modal', $data);
    }

    public function edit_modal_department() {
        $data = array(
            'data' => $this->documentindexref_model->get_ref_doc_index_department($this->input->post('ref_doc_index_department_id'))->row()
        );
        $this->load->view('modal/documentindex_department_edit_modal', $data);
    }

    public function edit_year() {
        $data = array(
            'ref_doc_index_year_code' => $this->input->post('ref_doc_index_year_code'),
            'ref_doc_index_year_name' => $this->input->post('ref_doc_index_year_name'),
        );
        $this->documentindexref_model->updateyear($this->input->post('ref_doc_index_year_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขข้อมูลสำเร็จ');
        redirect(base_url('documentindexref'));
    }

    public function edit_category() {
        $data = array(
            'ref_doc_index_category_code' => $this->input->post('ref_doc_index_category_code'),
            'ref_doc_index_category_name' => $this->input->post('ref_doc_index_category_name'),
        );
        $this->documentindexref_model->updatecategory($this->input->post('ref_doc_index_category_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขข้อมูลสำเร็จ');
        redirect(base_url('documentindexref'));
    }

    public function edit_type() {
        $data = array(
            'ref_doc_index_type_code' => $this->input->post('ref_doc_index_type_code'),
            'ref_doc_index_type_name' => $this->input->post('ref_doc_index_type_name'),
        );
        $this->documentindexref_model->updatetype($this->input->post('ref_doc_index_type_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขข้อมูลสำเร็จ');
        redirect(base_url('documentindexref'));
    }

    public function edit_budget() {
        $data = array(
            'ref_doc_index_budget_code' => $this->input->post('ref_doc_index_budget_code'),
            'ref_doc_index_budget_name' => $this->input->post('ref_doc_index_budget_name'),
        );
        $this->documentindexref_model->updatebudget($this->input->post('ref_doc_index_budget_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขข้อมูลสำเร็จ');
        redirect(base_url('documentindexref'));
    }

    public function edit_store1() {
        $data = array(
            'ref_doc_index_store1_code' => $this->input->post('ref_doc_index_store1_code'),
            'ref_doc_index_store1_name' => $this->input->post('ref_doc_index_store1_name'),
        );
        $this->documentindexref_model->updatestore1($this->input->post('ref_doc_index_store1_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขข้อมูลสำเร็จ');
        redirect(base_url('documentindexref'));
    }

    public function edit_store2() {
        $data = array(
            'ref_doc_index_store2_code' => $this->input->post('ref_doc_index_store2_code'),
            'ref_doc_index_store2_name' => $this->input->post('ref_doc_index_store2_name'),
        );
        $this->documentindexref_model->updatestore2($this->input->post('ref_doc_index_store2_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขข้อมูลสำเร็จ');
        redirect(base_url('documentindexref'));
    }

    public function edit_store3() {
        $data = array(
            'ref_doc_index_store3_code' => $this->input->post('ref_doc_index_store3_code'),
            'ref_doc_index_store3_name' => $this->input->post('ref_doc_index_store3_name'),
        );
        $this->documentindexref_model->updatestore3($this->input->post('ref_doc_index_store3_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขข้อมูลสำเร็จ');
        redirect(base_url('documentindexref'));
    }

    public function edit_department() {
        $data = array(
            'ref_doc_index_department_code' => $this->input->post('ref_doc_index_department_code'),
            'ref_doc_index_department_name' => $this->input->post('ref_doc_index_department_name'),
        );
        $this->documentindexref_model->updatedepartment($this->input->post('ref_doc_index_department_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขข้อมูลสำเร็จ');
        redirect(base_url('documentindexref'));
    }

}
