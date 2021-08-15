<?php

/*
 * Class name : Reportsendin
 * Author : Sakchai Kantada
 * Mail : sakchaiwebmaster@gmail.com
 */

class Reportwithindep extends CI_Controller
{

  public $group_id = 5;
  public $menu_id = 13;
  public $per_page = 100;

  public function __construct()
  {
    parent::__construct();
    $this->auth->isLogin($this->menu_id);
    $this->load->model('reportwithindep_model');
    $this->load->library('ajax_pagination');
  }

  public function index()
  {
    $data = array(
      'group_id' => $this->group_id,
      'menu_id' => $this->menu_id,
      'icon' => $this->accesscontrol->getIcon($this->group_id),
      'title' => $this->accesscontrol->getNameTitle($this->menu_id),
      'css_full' => array(
        'plugin/datepicker/datepicker.css',
      ),
      'js_full' => array(
        'plugin/datepicker/bootstrap-datepicker.js',
        'plugin/datepicker/bootstrap-datepicker-thai.js',
        'plugin/datepicker/bootstrap-datepicker.th.js'
      )
    );
    $this->renderView('reportwithindep_view', $data);
  }

  public function ajax_pagination()
  {
    $filter = array(
      'year_id' => $this->input->post('year_id'),
      'work_type_id' => $this->input->post('work_type_id'),
      'state_info_id' => $this->input->post('state_info_id'),
      'book_group_id' => $this->input->post('book_group_id'),
      'searchtext' => $this->input->post('searchtext'),
      'date_start' => $this->input->post('date_start'),
      'date_end' => $this->input->post('date_end')
    );
    $count = $this->reportwithindep_model->count_pagination($filter);
    $config['div'] = 'result-pagination';
    $config['base_url'] = base_url('reportwithindep/ajax_pagination');
    $config['total_rows'] = $count;
    $config['per_page'] = $this->per_page;
    $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "', 'year_id' : '" . $this->input->post('year_id') . "', 'state_info_id' : '" . $this->input->post('state_info_id') . "', 'book_group_id' : '" . $this->input->post('book_group_id') . "', 'date_start' : '" . $this->input->post('date_start') . "', 'date_end' : '" . $this->input->post('date_end') . "'}";
    $config['num_links'] = 4;
    $config['uri_segment'] = 3;
    $this->ajax_pagination->initialize($config);
    $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data = array(
      'data' => $this->reportwithindep_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
      'count' => $count,
      'segment' => $segment,
      'links' => $this->ajax_pagination->create_links()
    );
    // echo $this->db->last_query();
    // exit();
    $this->load->view('ajax/reportwithindep_pagination', $data);
  }

  public function excel($year = null, $workTypeId = null, $stateInfoId = null, $bookGroupid = null, $searchText = null, $dateStart = null, $dateEnd = null)
  {
    $this->load->library("excel");
    $excel = new PHPExcel();
    $sheet = $excel->createSheet(0);

    $filter = array(
      'year_id' => $year,
      'work_type_id' => $workTypeId,
      'state_info_id' => $stateInfoId,
      'book_group_id' => $bookGroupid,
      'searchtext' => $searchText,
      'date_start' => $dateStart,
      'date_end' => $dateEnd
    );
    $data = $this->reportwithindep_model->get_dataexcel($filter);

    // $this->db->last_query();
    // exit();

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
    $sheet->mergeCells('A1:N1');
    $sheet->getStyle('A1')->getAlignment()->setWrapText(true);
    $sheet->setCellValue('A1', 'รายงานสรุปหนังสือส่งในหน่วยงาน');
    $sheet->getStyle('A1:N1')->applyFromArray($style_header);
    $sheet->getRowDimension(1)->setRowHeight(30);

    $sheet->setCellValue('A3', '#');
    $sheet->getColumnDimension('A')->setWidth(10);
    $sheet->setCellValue('B3', 'ประเภทหนังสือ');
    $sheet->getColumnDimension('B')->setWidth(20);
    $sheet->setCellValue('C3', 'สถานะ');
    $sheet->getColumnDimension('C')->setWidth(20);
    $sheet->setCellValue('D3', 'เลขทะเบียน');
    $sheet->getColumnDimension('D')->setWidth(20);
    $sheet->setCellValue('E3', 'เลขที่เอกสาร');
    $sheet->getColumnDimension('E')->setWidth(30);
    $sheet->setCellValue('F3', 'ส่งต้นฉบับ');
    $sheet->getColumnDimension('F')->setWidth(20);
    $sheet->setCellValue('G3', 'ปีเอกสาร');
    $sheet->getColumnDimension('G')->setWidth(20);
    $sheet->setCellValue('H3', 'ลงวันที่');
    $sheet->getColumnDimension('H')->setWidth(20);
    $sheet->setCellValue('I3', 'เรื่อง');
    $sheet->getColumnDimension('I')->setWidth(30);
    $sheet->setCellValue('J3', 'จาก');
    $sheet->getColumnDimension('J')->setWidth(50);
    $sheet->setCellValue('K3', 'ถึง');
    $sheet->getColumnDimension('K')->setWidth(50);
    $sheet->setCellValue('L3', 'หมวดเอกสาร');
    $sheet->getColumnDimension('L')->setWidth(30);
    $sheet->setCellValue('M3', 'ส่งโดย');
    $sheet->getColumnDimension('M')->setWidth(30);
    $sheet->setCellValue('N3', 'ตำแหน่ง');
    $sheet->getColumnDimension('N')->setWidth(30);

    $sheet->getStyle('A3:N3')->applyFromArray($style_th);
    $sheet->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $sheet->getStyle('C3:F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G3:N3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

    $i = 0;
    $r = 4;
    if ($data->num_rows() > 0) {
      foreach ($data->result() as $row) {
        $sheet->setCellValue("A$r", $i + 1);
        $sheet->setCellValue("B$r", $row->work_type_name);
        $sheet->setCellValue("C$r", $row->state_info_name);
        $sheet->setCellValue("D$r", ($row->work_info_id != '' ? $row->work_info_id : '-'));
        $sheet->setCellValue("E$r", $row->work_info_no . $row->work_info_no_2 . $row->work_info_no_3);
        $sheet->setCellValue("F$r", $row->attach_original == 1 ? 'ส่งต้นฉบับ' : 'ไม่ส่งต้นฉบับ');
        $sheet->setCellValue("G$r", $row->year);
        $sheet->setCellValue("H$r", $this->misc->date2thai($row->work_info_date, '%d %m %y', 1));
        $sheet->setCellValue("I$r", $row->work_info_subject);
        $sheet->setCellValue("J$r", $row->work_info_from_position . ' ' . $row->work_info_from);
        $sheet->setCellValue("K$r", (($row->work_info_to_position != '') || ($row->work_info_to != '') ? $row->work_info_to_position . ' ' . $row->work_info_to : '-'));
        $sheet->setCellValue("L$r", $row->book_group_name);
        $sheet->setCellValue("M$r", $row->user_fullname);
        $sheet->setCellValue("N$r", $this->reportwithindep_model->getdep_off_id($row->dep_off_id)->officer_name);
        $sheet->getStyle("A$r:N$r")->applyFromArray($style_td);
        $sheet->getStyle("A$r")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("B$r")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle("C$r:F$r")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("G$r:N$r")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $r++;
        $i++;
      }
    }

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="รายงานสรุปหนังสือส่งในหน่วยงาน' . date('Y_m_d_H_i_s') . '.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
  }
}
