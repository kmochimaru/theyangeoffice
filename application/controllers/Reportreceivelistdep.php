<?php

class Reportreceivelistdep extends CI_Controller {

    public $group_id = 5;
    public $menu_id = 80;
    public $per_page = 100;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('reportreceivelistdep_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css_full' => array(
                'plugin/datepicker/datepicker.css'
            ),
            'css' => array(),
            'js_full' => array(
                'plugin/datepicker/bootstrap-datepicker.js',
                'plugin/datepicker/bootstrap-datepicker-thai.js',
                'plugin/datepicker/bootstrap-datepicker.th.js'
            ),
            'js' => array()
        );
        $this->renderView('reportreceivelistdep_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'year_id' => $this->input->post('year_id'),
            'status_id' => $this->input->post('status_id'),
            'book_group_id' => $this->input->post('book_group_id'),
            'searchtext' => $this->input->post('searchtext'),
            'date_start' => $this->input->post('date_start'),
            'date_end' => $this->input->post('date_end')
        );
        $count = $this->reportreceivelistdep_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('reportreceivelistdep/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "', 'year_id' : '" . $this->input->post('year_id') . "', 'status_id' : '" . $this->input->post('status_id') . "', 'priority_info_id' : '" . $this->input->post('priority_info_id') . "', 'book_group_id' : '" . $this->input->post('book_group_id') . "', 'date_start' : '" . $this->input->post('date_start') . "', 'date_end' : '" . $this->input->post('date_end') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->reportreceivelistdep_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/reportreceivelistdep_pagination', $data);
    }


    public function excel($year = null, $searchtext = null, $status_id = null, $book_group_id = null, $dateStart = null, $dateEnd = null) {
        $filter = array(
            'year_id' => $year,
            'status_id' => $status_id,
            'book_group_id' => $book_group_id,
            'searchtext' => $searchtext,
            'date_start' => $dateStart,
            'date_end' => $dateEnd
        );

        $data = $this->reportreceivelistdep_model->get_dataexcel($filter);
        $this->load->library("excel");
        $excel = new PHPExcel();
        $sheet = $excel->createSheet(0);

        // header
        $style_header = array(
            'font'      => array(
                'bold' => true,
                'size' => 16,
                'name' => 'TH Sarabun New'
            ),
            'fill'      => array(
                'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ffffff')
            ),
            'borders'   => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );
        $sheet->getRowDimension(1)->setRowHeight(50);
        // table 1
        $style_th = array(
            'font'    => array(
                'bold' => true,
                'size' => 12,
                'name' => 'TH Sarabun New'
            ),
            'fill'    => array(
                'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'dbdbdb')
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $style_td = array(
            'font'    => array(
                'size' => 12,
                'name' => 'TH Sarabun New'
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        //
        $sheet->mergeCells('A1:Q1');
        $sheet->getStyle('A1')->getAlignment()->setWrapText(true);
        $sheet->setCellValue('A1', 'สรุปหนังสือรับในหน่วยงาน');
        $sheet->getStyle('A1:Q1')->applyFromArray($style_header);
        $sheet->getRowDimension(1)->setRowHeight(30);

        $sheet->setCellValue('A3', '#');
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->setCellValue('B3', 'สถานะ');
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->setCellValue('C3', 'ทะเบียนรับ');
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->setCellValue('D3', 'เลขที่เอกสาร');
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->setCellValue('E3', 'ส่งต้นฉบับ');
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->setCellValue('F3', 'ปีเอกสาร');
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->setCellValue('G3', 'ลงวันที่');
        $sheet->getColumnDimension('G')->setWidth(20);
        $sheet->setCellValue('H3', 'จาก');
        $sheet->getColumnDimension('H')->setWidth(30);
        $sheet->setCellValue('I3', 'ตำแหน่ง');
        $sheet->getColumnDimension('I')->setWidth(30);
        $sheet->setCellValue('J3', 'เรื่อง');
        $sheet->getColumnDimension('J')->setWidth(20);
        $sheet->setCellValue('K3', 'จาก');
        $sheet->getColumnDimension('K')->setWidth(30);
        $sheet->setCellValue('L3', 'ถึง');
        $sheet->getColumnDimension('L')->setWidth(50);
        $sheet->setCellValue('M3', 'ชั้นความเร็ว');
        $sheet->getColumnDimension('M')->setWidth(50);
        $sheet->setCellValue('N3', 'หมวดเอกสาร');
        $sheet->getColumnDimension('N')->setWidth(30);
        $sheet->setCellValue('O3', 'ผู้ลงรับ');
        $sheet->getColumnDimension('O')->setWidth(30);
        $sheet->setCellValue('P3', 'ตำแหน่ง');
        $sheet->getColumnDimension('P')->setWidth(30);
        $sheet->setCellValue('Q3', 'วันที่ลงรับ');
        $sheet->getColumnDimension('Q')->setWidth(30);

        $sheet->getStyle('A3:Q3')->applyFromArray($style_th);
        $sheet->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('C3:F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G3:Q3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        $i = 0;
        $r = 4;
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $rows) {
                $row = $this->reportreceivelistdep_model->getData($rows->work_process_id_pri)->row();
                if ($row->work_process_sendtype != 2) {

                    $sheet->setCellValue("A$r", $i + 1);

                    $wpr = "รอลงรับ";
                    if ($row->work_process_receive == 1) {
                        if ($row->state_info_id == 6) {
                            $wpr = 'ปิดงานแล้ว';
                        } else {
                            $wpr = 'ลงรับแล้ว';
                        }
                    }
                    $sheet->setCellValue("B$r", $wpr);

                    $sheet->setCellValue("C$r", ($row->work_process_receive != 1) ? "-" : $row->work_process_receive_id);
                    $sheet->setCellValue("D$r", $row->work_process_no . $row->work_process_no_2 . $row->work_process_no_3);
                    $sheet->setCellValue("E$r", $row->attach_original == 1 ? 'ส่งต้นฉบับ' : 'ไม่ส่งต้นฉบับ');
                    $sheet->setCellValue("F$r", $row->year);
                    $sheet->setCellValue("G$r", $this->misc->date2thai($row->work_info_date, '%d %m %y', 1));
                    $sheet->setCellValue("H$r", $this->reportreceivelistdep_model->getdep_off($row->work_info_dep_id_pri)->row()->dep_name);
                    $sheet->setCellValue("I$r", $this->reportreceivelistdep_model->getdep_off_id($row->work_info_dep_off_id)->officer_name);
                    $sheet->setCellValue("J$r", $row->work_info_subject);
                    $sheet->setCellValue("K$r", $row->work_info_from_position . ' ' . $row->work_info_from);
                    $sheet->setCellValue("L$r", (($row->work_info_to_position != '') || ($row->work_info_to != '') ? $row->work_info_to_position . ' ' . $row->work_info_to : '-'));
                    $sheet->setCellValue("M$r", $row->priority_info_name);
                    $sheet->setCellValue("N$r", $row->book_group_name);
                    $sheet->setCellValue("O$r", ($row->work_process_receive == 1) ? $row->work_process_receive_name : '');
                    $sheet->setCellValue("P$r", $this->reportreceivelistdep_model->getdep_off_id($row->dep_off_id)->officer_name);
                    $sheet->setCellValue("Q$r", ($row->work_process_receive == 1) ? $this->misc->offsetyear($row->work_process_receive_date, 543) . ' ' . $this->misc->date2thai($row->work_process_receive_date, '%h:%i') : '');
                    $sheet->getStyle("A$r:Q$r")->applyFromArray($style_td);
                    $sheet->getStyle("A$r")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle("B$r")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                    $sheet->getStyle("C$r:F$r")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle("G$r:Q$r")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                    $r++;
                    $i++;
                } else {
                    if ($row->work_process_sort == 1) {
                        $sheet->setCellValue("A$r", $i + 1);

                        $wpr = "ไม่ลงรับ";
                        if ($row->work_process_receive == 1) {
                            if ($row->state_info_id == 6) {
                                $wpr = 'ปิดงานแล้ว';
                            } else {
                                $wpr = 'ลงรับแล้ว';
                            }
                        }
                        $sheet->setCellValue("B$r", $wpr);

                        $sheet->setCellValue("C$r", ($row->work_process_receive != 1) ? "-" : $row->work_process_receive_id);
                        $sheet->setCellValue("D$r", $row->work_process_no . $row->work_process_no_2 . $row->work_process_no_3);
                        $sheet->setCellValue("E$r", $row->attach_original == 1 ? 'ส่งต้นฉบับ' : 'ไม่ส่งต้นฉบับ');
                        $sheet->setCellValue("F$r", $row->year);
                        $sheet->setCellValue("G$r", $this->misc->date2thai($row->work_info_date, '%d %m %y', 1));
                        $sheet->setCellValue("H$r", $this->reportreceivelistdep_model->getdep_off($row->work_info_dep_id_pri)->row()->dep_name);
                        $sheet->setCellValue("I$r", $this->reportreceivelistdep_model->getdep_off_id($row->work_info_dep_off_id)->officer_name);
                        $sheet->setCellValue("J$r", $row->work_info_subject);
                        $sheet->setCellValue("K$r", $row->work_info_from_position . ' ' . $row->work_info_from);
                        $sheet->setCellValue("L$r", (($row->work_info_to_position != '') || ($row->work_info_to != '') ? $row->work_info_to_position . ' ' . $row->work_info_to : '-'));
                        $sheet->setCellValue("M$r", $row->priority_info_name);
                        $sheet->setCellValue("N$r", $row->book_group_name);
                        $sheet->setCellValue("O$r", ($row->work_process_receive == 1) ? $row->work_process_receive_name : '');
                        $sheet->setCellValue("P$r", $this->reportreceivelistdep_model->getdep_off_id($row->dep_off_id)->officer_name);
                        $sheet->setCellValue("Q$r", ($row->work_process_receive == 1) ? $this->misc->offsetyear($row->work_process_receive_date, 543) . ' ' . $this->misc->date2thai($row->work_process_receive_date, '%h:%i') : '');
                        $sheet->getStyle("A$r:Q$r")->applyFromArray($style_td);
                        $sheet->getStyle("A$r")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $sheet->getStyle("B$r")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                        $sheet->getStyle("C$r:F$r")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $sheet->getStyle("G$r:Q$r")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                        $r++;
                        $i++;
                    } else {
                        $sheet->setCellValue("A$r", $i + 1);

                        $wpr = "ไม่ลงรับ";
                        if ($row->work_process_receive == 1) {
                            if ($row->state_info_id == 6) {
                                $wpr = 'ปิดงานแล้ว';
                            } else {
                                $wpr = 'ลงรับแล้ว';
                            }
                        }
                        $sheet->setCellValue("B$r", $wpr);

                        $sheet->setCellValue("C$r", ($row->work_process_receive != 1) ? "-" : $row->work_process_receive_id);
                        $sheet->setCellValue("D$r", $row->work_process_no . $row->work_process_no_2 . $row->work_process_no_3);
                        $sheet->setCellValue("E$r", $row->attach_original == 1 ? 'ส่งต้นฉบับ' : 'ไม่ส่งต้นฉบับ');
                        $sheet->setCellValue("F$r", $row->year);
                        $sheet->setCellValue("G$r", $this->misc->date2thai($row->work_info_date, '%d %m %y', 1));
                        $sheet->setCellValue("H$r", $this->reportreceivelistdep_model->getdep_off($row->work_info_dep_id_pri)->row()->dep_name);
                        $sheet->setCellValue("I$r", $this->reportreceivelistdep_model->getdep_off_id($row->work_info_dep_off_id)->officer_name);
                        $sheet->setCellValue("J$r", $row->work_info_subject);
                        $sheet->setCellValue("K$r", $row->work_info_from_position . ' ' . $row->work_info_from);
                        $sheet->setCellValue("L$r", (($row->work_info_to_position != '') || ($row->work_info_to != '') ? $row->work_info_to_position . ' ' . $row->work_info_to : '-'));
                        $sheet->setCellValue("M$r", $row->priority_info_name);
                        $sheet->setCellValue("N$r", $row->book_group_name);
                        $sheet->setCellValue("O$r", ($row->work_process_receive == 1) ? $row->work_process_receive_name : '');
                        $sheet->setCellValue("P$r", $this->reportreceivelistdep_model->getdep_off_id($row->dep_off_id)->officer_name);
                        $sheet->setCellValue("Q$r", ($row->work_process_receive == 1) ? $this->misc->offsetyear($row->work_process_receive_date, 543) . ' ' . $this->misc->date2thai($row->work_process_receive_date, '%h:%i') : '');
                        $sheet->getStyle("A$r:Q$r")->applyFromArray($style_td);
                        $sheet->getStyle("A$r")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $sheet->getStyle("B$r")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                        $sheet->getStyle("C$r:F$r")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $sheet->getStyle("G$r:Q$r")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                        $r++;
                        $i++;
                    }
                }
            }
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="รายงานสรุปหนังสือรับในหน่วยงาน' . date('Y_m_d_H_i_s') . '.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
}
