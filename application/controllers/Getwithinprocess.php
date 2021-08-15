<?php

/**
 * Description of Getwithinprocess
 *
 * @author nut
 */
class Getwithinprocess extends CI_Controller {

    public $group_id = 10;
    public $menu_id = 51;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('getwithinprocess_model');
        $this->load->library('ajax_pagination');
        $this->load->library('../controllers/line');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js'),
        );
        $this->renderView('getwithinprocess_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'year_id' => $this->input->post('year_id'),
            'status_id' => $this->input->post('status_id'),
            'priority_info_id' => $this->input->post('priority_info_id'),
            'book_group_id' => $this->input->post('book_group_id'),
            'searchtext' => $this->input->post('searchtext'),
        );
        $count = $this->getwithinprocess_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('getwithinprocess/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "', 'year_id' : '" . $this->input->post('year_id') . "', 'status_id' : '" . $this->input->post('status_id') . "', 'priority_info_id' : '" . $this->input->post('priority_info_id') . "', 'book_group_id' : '" . $this->input->post('book_group_id') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->getwithinprocess_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/getwithinprocess_pagination', $data);
    }

    public function detail($work_process_id_pri = null) {
        if ($work_process_id_pri != null) {
            $workprocess = $this->getwithinprocess_model->getworkprocess($work_process_id_pri);
            if ($workprocess->num_rows() > 0) {
                $row = $workprocess->row();
                $data = array(
                    'group_id' => $this->group_id,
                    'menu_id' => $this->menu_id,
                    'icon' => $this->accesscontrol->getIcon($this->group_id),
                    'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                    'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
                    'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js'),
                    'workprocess' => $workprocess,
                    'work_process_id_pri' => $work_process_id_pri,
                    'work_info_id_pri' => $row->work_info_id_pri,
                    'data' => $this->getwithinprocess_model->getworkinfo($row->work_info_id_pri)->row(),
                );
                $this->renderView('getwithinprocessdetail_view', $data);
            } else {
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
                redirect(base_url('getwithinprocess'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('getwithinprocess'));
        }
    }

    public function modal_changestatus() {
        $work_process_id_pri = $this->input->post('work_process_id_pri');
        $workprocess = $this->getwithinprocess_model->getworkprocess($work_process_id_pri);
        if ($workprocess->num_rows() == 1) {
            if ($workprocess->row()->work_process_receive == 0) {
                $data = array(
                    'row' => $workprocess->row(),
                );
                $this->load->view('modal/getwithinprocesschangestatus_modal', $data);
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    public function changestatus() {
        $work_process_id_pri = $this->input->post('work_process_id_pri');
        $workprocess = $this->getwithinprocess_model->getworkprocess($work_process_id_pri);
        if ($workprocess->num_rows() == 1) {
            if ($workprocess->row()->work_process_receive == 0) {
                $data = array(
                    'work_process_status_id' => 0,
                    'work_process_update' => $this->misc->getdate(),
                );
                $this->getwithinprocess_model->update_workprocess($work_process_id_pri, $data);
                $text = 'ดึงเรื่องกลับ หนังสือส่งไปยังหน่วยงาน';
                $this->systemlog->log_work_process($text, $work_process_id_pri);
                $users = $this->getwithinprocess_model->getuser_dep_off($workprocess->row()->dep_off_id);
                $message = "\n" . "หนังสือเลขที่ " . $workprocess->row()->work_process_no . $workprocess->row()->work_process_no_2 . $workprocess->row()->work_process_no_3 . " ถูกดึงเรื่องกลับ";
                if ($users->num_rows() > 0) {
                    foreach ($users->result() as $user) {
                        $this->send_line($user->user_line_token, $message);
                    }
                }
                $work_info_id_pri = $workprocess->row()->work_info_id_pri;
                $workinfo = $this->getwithinprocess_model->getworkinfoprocess($work_info_id_pri);
                if ($workinfo->num_rows() == $this->getwithinprocess_model->checkworkinfo7($work_info_id_pri)) {
                    $data = array(
                        'state_info_id' => 7,
                        'work_info_update' => $this->misc->getdate(),
                    );
                    $this->getwithinprocess_model->update_workinfo($workprocess->row()->work_info_id_pri, $data);
                    $text = 'ดึงเรื่องกลับหนังสือส่งภายในทั้งหมด';
                    $this->systemlog->log_work_info($text, $work_info_id_pri);
                }
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    public function attach($work_process_id_pri = null) {
        if ($work_process_id_pri != null) {
            $workprocess = $this->getwithinprocess_model->getworkprocess($work_process_id_pri);
            if ($workprocess->num_rows() > 0) {
                $data = array(
                    'group_id' => $this->group_id,
                    'menu_id' => $this->menu_id,
                    'icon' => $this->accesscontrol->getIcon($this->group_id),
                    'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                    'css_full' => array('plugin/select2/dist/css/select2.min.css', 'plugin/datepicker/datepicker.css', 'plugin/fancybox/dist/jquery.fancybox.css'),
                    'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/select2/dist/js/select2.full.min.js', 'plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js'),
                    'workprocess' => $workprocess,
                    'work_process_id_pri' => $work_process_id_pri,
                    'work_info_id_pri' => $workprocess->row()->work_info_id_pri,
                    'data' => $this->getwithinprocess_model->getworkinfo($workprocess->row()->work_info_id_pri)->row(),
                );
                $this->renderView('getwithinprocessattach_view', $data);
            } else {
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
                redirect(base_url('getwithinprocess'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('getwithinprocess'));
        }
    }

    public function ajax_page() {
        $work_process_id_pri = $this->input->post('work_process_id_pri');
        $data = array(
            'datas' => $this->getwithinprocess_model->get_workprocessfofile($work_process_id_pri),
        );
        $this->load->view('ajax/getwithinprocess_page', $data);
    }

    public function upload_attach($work_process_id_pri) {
        $input_name = 'upload_attach[]';
        $this->load->library('upload');
        $this->load->library('managefolder');
        $genName = $this->generateRandomString();
        $file_name = 'P' . $work_process_id_pri . '_' . date('YmdHis') . '_' . $genName;
        $upload_path = $this->managefolder->convert_path("assets/upload/attach");
        $config = array(
            'upload_path' => $upload_path,
            'allowed_types' => 'csv|pdf|doc|docx|xls|xlsx|ppt|pptx|txt|zip|rar|jpg|jpeg|png|gif',
            'max_size' => 20480,
            'file_name' => $file_name,
            'file_ext_tolower' => TRUE
        );
        $this->upload->initialize($config);
        $status = array();
        $i = 0;
        foreach ($_FILES as $key) {
            $name_type = pathinfo($key['name'], PATHINFO_EXTENSION);
            $_FILES[$input_name]['name'] = $key['name'];
            $_FILES[$input_name]['type'] = $key['type'];
            $_FILES[$input_name]['tmp_name'] = $key['tmp_name'];
            $_FILES[$input_name]['size'] = $key['size'];
            $this->upload->initialize($config);
            if ($key['size'] < 20971520) {
                //print_r($key);echo $name_type;
                if ($this->upload->do_upload($input_name)) {
                    $upload = $this->upload->data();
                    $path = $upload_path . '/' . $this->upload->data('file_name');
                    $file_type_id = $this->getwithinprocess_model->ref_file_type($name_type)->row()->file_type_id;
                    //echo $path . '/' . $key['name'] . '/' . $this->upload->data('file_name') . '/' . $name_type . '/' . $file_type_id . '/';
                    $data = array(
                        'work_process_id_pri' => $work_process_id_pri,
                        'user_id' => $this->session->userdata('user_id'),
                        'work_process_file_send' => 1,
                        'work_process_file_path' => $path,
                        'work_process_file_oldname' => $key['name'],
                        'work_process_file_name' => $this->upload->data('file_name'),
                        'file_type_id' => $file_type_id,
                        'work_process_file_active' => 1,
                        'work_process_file_create' => $this->misc->getdate(),
                        'work_process_file_update' => $this->misc->getdate()
                    );
                    $work_process_file_id = $this->getwithinprocess_model->insert_workprocessfile($data);
                    $datalog = array(
                        'log_type_id' => 2,
                        'work_process_file_id' => $work_process_file_id,
                        'user_id' => $this->session->userdata('user_id'),
                        'log_text' => 'สร้าง File ' . $this->upload->data('file_name'),
                        'log_status_id' => 1,
                        'log_time' => $this->misc->getdate()
                    );
                    $this->systemlog->log_file($datalog);
                    // $workprocess = $this->getwithinprocess_model->getworkprocess($work_process_id_pri)->row();
                    // $users = $this->getwithinprocess_model->getuser_dep_off($workprocess->dep_off_id);
                    // $message = "\n" . 'หนังสือเลขที่ ' . $workprocess->work_process_no . $workprocess->work_process_no_2 . $workprocess->work_process_no_3 . ' มีการ "เพิ่ม" ไฟล์เอกสาร';
                    // if ($users->num_rows() > 0) {
                    //     foreach ($users->result() as $user) {
                    //         $this->send_line($user->user_line_token, $message);
                    //     }
                    // }
                    $status[$i] = 1;
                } else {
                    $status[$i] = 2;
                }
            } else {
                $status[$i] = 3;
            }
            $i++;
        }
        $return["status"] = $status;
        print json_encode($return);
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function delete_file() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        //$patch_file = './' . $workinfofile->work_info_file_path;
        //@unlink($patch_file);
        //log_delete_workinfofile();
        $datalog = array(
            'log_type_id' => 2,
            'work_process_file_id' => $id,
            'user_id' => $this->session->userdata('user_id'),
            'log_text' => 'ลบ File ' . $name,
            'log_status_id' => 2,
            'log_time' => $this->misc->getdate()
        );
        $this->systemlog->log_file($datalog);
        // $workprocess = $this->getwithinprocess_model->get_workprocessfofile_id($id)->row();
        // $users = $this->getwithinprocess_model->getuser_dep_off($workprocess->dep_off_id);
        // $message = "\n" . 'หนังสือเลขที่ ' . $workprocess->work_process_no . $workprocess->work_process_no_2 . $workprocess->work_process_no_3 . ' มีการ "ลบ" ไฟล์เอกสาร';
        // if ($users->num_rows() > 0) {
        //     foreach ($users->result() as $user) {
        //         $this->send_line($user->user_line_token, $message);
        //     }
        // }
        $this->getwithinprocess_model->delete_workprocessfile($id);
    }

    public function send_line($line_token, $message) {
        if ($line_token != null && $line_token != '') {
            $line = $this->line->line_notification($line_token, $message);
            if ($line == 1) {
                $this->systemlog->log_send_line($message, $this->session->userdata('user_id'), $line_token);
            }
        }
    }

}
