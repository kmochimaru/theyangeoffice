<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Printout
 *
 * @author nut
 */
class Printout extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('printout_model');
        $this->load->library('mpdfphp7');
        $this->load->library('mpdfphp72');
    }

    public function index() {
        redirect(base_url());
    }

    public function docketinfo($work_info_code = null) {
        $pdf = $this->mpdfphp7->load_pdfA4();
        $workinfocode = $this->printout_model->getworkinfocode($work_info_code);
        if ($workinfocode->num_rows() == 1) {
            $data = array(
                'data' => $workinfocode->row(),
            );
            $pdf->AddPage('', '', '', '', '', 10, 10, 10, 10, 0, 0);
            $html = $this->load->view('ajax/docketinfo_view', $data, true);
            $pdf->WriteHTML($html);
            $pdf->Output('info_' . $work_info_code . '_' . date('dmYHis') . '_.pdf', 'I');
            exit;
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url());
        }
    }

    public function docketprocess($work_info_code = null) {
        $pdf = $this->mpdfphp7->load_pdfA4();
        $workinfocode = $this->printout_model->getworkinfocode($work_info_code);
        if ($workinfocode->num_rows() == 1) {
            $workprocess = $this->printout_model->getworkprocess($workinfocode->row()->work_info_id_pri);
            if ($workprocess->num_rows() > 0) {
                $data = array(
                    'data' => $this->printout_model->getworkinfocode($work_info_code)->row(),
                    'workprocess' => $workprocess,
                );
                $pdf->AddPage('', '', '', '', '', 10, 10, 10, 10, 0, 0);
                $html = $this->load->view('ajax/docketprocess_view', $data, true);
                $pdf->WriteHTML($html);
                $pdf->Output('process_' . $work_info_code . '_' . date('dmYHis') . '_.pdf', 'I');
                exit;
            } else {
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url());
        }
    }

    public function docketinfo2($work_info_code = null) {
        $pdf = $this->mpdfphp72->load_pdfA4();
        $pdf->SetHTMLHeader('<div style="text-align: right; font-weight: bold; padding-top: 10px;">หน้า {PAGENO} / {nbpg}</div>');
        $pdf->SetImportUse();
        $workinfocode = $this->printout_model->getworkinfocode($work_info_code);
        if ($workinfocode->num_rows() == 1) {
            $data = array(
                'data' => $workinfocode->row(),
            );
            $pdf->AddPage('', '', '', '', '', 10, 10, 10, 10, 0, 0);
            $pdf->Bookmark('Section 1', 0);
            $pdf->WriteHTML('<div>Section 1</div>');
            $html = $this->load->view('ajax/docketinfo_view', $data, true);
            $pdf->WriteHTML($html);
            $pagecount = $pdf->SetSourceFile(FCPATH . 'assets/upload/attach/2019/03/II1_20190305105917_NJAYLZE7i32file.pdf');
            for ($i = 1; $i <= $pagecount; $i++) {
                $pdf->AddPage();
                $pdf->Bookmark('Section ' . ($i + 1), 0);
                $pdf->WriteHTML('<div>Section ' . ($i + 1) . 'text</div>');
                $tplId = $pdf->ImportPage($i);
                $pdf->UseTemplate($tplId);
            }
            $pdf->Output('info_' . $work_info_code . '_' . date('dmYHis') . '_.pdf', 'I');
            exit;
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url());
        }
    }

}
