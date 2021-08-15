<?php

/**
 * Description of Receivework
 * @author nut
 */
class Receivework extends CI_Controller {

    public $group_id = 12;
    public $menu_id = 42;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('receivework_model');
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
        $this->renderView('receivework_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'year_id' => $this->input->post('year_id'),
            'work_user_status_id' => $this->input->post('work_user_status_id'),
            'searchtext' => $this->input->post('searchtext'),
            'priority_info_id' => $this->input->post('priority_info_id'),
            'book_group_id' => $this->input->post('book_group_id'),
        );
        $count = $this->receivework_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('receivework/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "', 'year_id' : '" . $this->input->post('year_id') . "', 'work_user_status_id' : '" . $this->input->post('work_user_status_id') . "', 'priority_info_id' : '" . $this->input->post('priority_info_id') . "', 'book_group_id' : '" . $this->input->post('book_group_id') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->receivework_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/receivework_pagination', $data);
    }

    public function detail($work_user_id, $check = null) {
        $workusers = $this->receivework_model->getworkuser($work_user_id);
        if ($workusers->num_rows() > 0) {
            if ($check != null) {
                if ($workusers->row()->work_user_status_id == 1) {
                    $this->receivework_model->update_workpuser($work_user_id, array(
                        'work_user_status_id' => 2,
                        'work_user_startdate' => $this->misc->getdate(),
                        'work_user_update' => $this->misc->getdate(),
                    ));
                    $text = 'เปิด หนังสือส่งไปยังผู้ปฏิบัติงาน';
                    $this->systemlog->log_work_user($text, $work_user_id);
                }
            }
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
                'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js'),
                'work_user_id' => $work_user_id,
                'workuser' => $workusers->row(),
                'data' => $this->receivework_model->getworkinfo($workusers->row()->work_info_id_pri)->row(),
            );
            $this->renderView('receiveworkdetail_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('receivework'));
        }
    }

    public function add_comment() {
        $work_user_id = $this->input->post('work_user_id');
        $signature_current = $this->input->post('signature_current');
        $workusers = $this->receivework_model->getworkuser($work_user_id);
        if ($workusers->num_rows() == 1) {
            if ($this->input->post('signature_status_id') != 1) {
                $data = array(
                    'work_user_comment' => $this->input->post('work_user_comment'),
                    'work_user_signature' => null,
                    'work_user_signature_name' => $this->receivework_model->key_user()->row()->user_fullname,
                    'work_user_signature_date' => $this->misc->getdate(),
                    'work_user_signature_key' => null,
                    'work_user_update' => $this->misc->getdate(),
                );
                $this->receivework_model->update_workpuser($work_user_id, $data);
                $text = 'แสดงความคิดเห็น หนังสือส่งไปยังผู้ปฏิบัติงาน';
                $this->systemlog->log_work_user($text, $work_user_id);
                $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ทำรายการสำเร็จแล้ว');
                redirect(base_url('receivework/detail/' . $work_user_id));
            } else {
                if (!empty($this->input->post('pin_key'))) {
                    $pin = hash('sha256', $this->session->userdata('user_id') . $this->input->post('pin_key'));
                    $pin_key = $this->receivework_model->key_user()->row()->pin_key;
                    if ($pin === $pin_key) {
                        $signature = '';
                        $row = $workusers->row();
                        if (!empty($_FILES['signature']['name'])) {
                            $this->load->library('upload');
                            $this->load->library('image_lib');
                            $config_photo = array(
                                'upload_path' => './assets/upload/signature/',
                                'allowed_types' => 'jpg|gif|png',
                                'max_size' => 8192,
                                'file_name' => 'signature_user_' . $work_user_id . '_' . date('YmdHis')
                            );
                            $this->upload->initialize($config_photo);
                            if ($this->upload->do_upload('signature')) {
                                $upload_data = $this->upload->data();
                                //resize
                                $max_width = 600;
                                $max_height = 150;
                                if ($upload_data['image_width'] > $max_width || $upload_data['image_height'] > $max_height) {
                                    $config_resize['source_image'] = $this->upload->upload_path . $this->upload->file_name;
                                    $config_resize['maintain_ratio'] = TRUE;
                                    $config_resize['width'] = $max_width;
                                    $config_resize['height'] = $max_height;
                                    $this->load->library('image_lib', $config_resize);
                                    $this->image_lib->resize();
                                }
                                $signature = $upload_data['file_name'];
                                if ($this->input->post('signature_current') != '' || $this->input->post('signature_current') != null) {
                                    //@unlink('./assets/upload/signature/' . $this->input->post('signature_current'));
                                }
                            }
                        }
                        $signature_key = $this->misc->generateSignature($row->work_info_id_pri, $this->session->userdata('user_id'));
                        $signature_date = $this->misc->getdate();
                        $data = array(
                            'work_user_comment' => $this->input->post('work_user_comment'),
                            'work_user_signature' => $signature == '' ? $signature_current : $signature,
                            'work_user_signature_name' => $this->receivework_model->key_user()->row()->user_fullname,
                            'work_user_signature_date' => $signature_date,
                            'work_user_signature_key' => $signature_key,
                            'work_user_update' => $this->misc->getdate(),
                        );
                        $this->receivework_model->update_workpuser($work_user_id, $data);
                        $datasignature = array(
                            'user_id' => $this->session->userdata('user_id'),
                            'year_id' => $row->year_id,
                            'work_info_id_pri' => $row->work_info_id_pri,
                            'work_process_id_pri' => $row->work_process_id_pri,
                            'work_user_id' => $row->work_user_id,
                            'signature_type_id' => 3,
                            'signature_work_no' => $row->work_info_no . $row->work_info_no_2 . $row->work_info_no_3,
                            'signature_image' => $signature == '' ? $signature_current : $signature,
                            'signature_name' => $this->receivework_model->key_user()->row()->user_fullname,
                            'signature_date' => $signature_date,
                            'signature_key' => $signature_key,
                            'signaturec_modify' => $this->misc->getdate(),
                        );
                        $this->receivework_model->insert_signature($datasignature);
                        $text = 'แสดงความคิดเห็น หนังสือส่งไปยังผู้ปฏิบัติงาน';
                        $this->systemlog->log_work_user($text, $work_user_id);
                        $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ทำรายการสำเร็จแล้ว');
                        redirect(base_url('receivework/detail/' . $work_user_id));
                    } else {
                        $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,รหัส PIN ไม่ถูกต้อง');
                        redirect(base_url('receivework/detail/' . $work_user_id));
                    }
                } else {
                    $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,รหัส PIN ไม่ถูกต้อง');
                    redirect(base_url('receivework/detail/' . $work_user_id));
                }
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('receivework'));
        }
    }

    public function edit_userstatus() {
        $work_user_id = $this->input->post('work_user_id');
        $workusers = $this->receivework_model->getworkuser($work_user_id);
        if ($workusers->num_rows() == 1) {
            $row = $workusers->row();
            if ($row->work_user_status_id == 2) {
                $data = array(
                    'work_user_status_id' => 3,
                    'work_user_report' => $this->input->post('work_user_report'),
                    'work_user_enddate' => $this->misc->getdate(),
                    'work_user_update' => $this->misc->getdate(),
                );
                $this->receivework_model->update_workpuser($work_user_id, $data);
                $this->receivework_model->update_workinfo($row->work_info_id_pri, array('state_info_id' => 5, 'work_info_update' => $this->misc->getdate()));
                $text = 'เสร็จสิ้น รายงานผล หนังสือส่งไปยังผู้ปฏิบัติงาน';
                $this->systemlog->log_work_user($text, $work_user_id);
                $work_info_id_pri = $this->receivework_model->get_workuserid($work_user_id)->row()->work_info_id_pri;
                $workinfo = $this->receivework_model->getworkinfo($work_info_id_pri)->row();
                $workprocess = $this->receivework_model->getworkprocess($row->work_process_id_pri)->row();
                // workprocess
                $data = array(
                    'work_info_id_pri' => $workinfo->work_info_id_pri,
                    'work_process_id' => $workinfo->work_info_id,
                    'work_process_no' => $workinfo->work_info_no,
                    'work_process_no_2' => $workinfo->work_info_no_2,
                    'work_process_no_3' => $workinfo->work_info_no_3,
                    'year_id' => $row->year_id,
                    'user_id' => $this->session->userdata('user_id'),
                    'dep_id_pri' => $this->session->userdata('dep_id_pri'),
                    'dep_off_id' => $workprocess->dep_off_id,
                    'work_process_receive_id' => $workprocess->work_process_receive_id,
                    'work_process_receive' => 2,
                    'work_process_date' => $workinfo->work_info_date,
                    'work_process_sendtype' => $workprocess->work_process_sendtype,
                    'work_process_sendstatus' => $workprocess->work_process_sendstatus,
                    'work_process_sort' => $workprocess->work_process_sort,
                    'work_user_id' => $work_user_id,
                    'work_process_create' => $this->misc->getdate(),
                    'work_process_update' => $this->misc->getdate(),
                );
                $work_process_id_pri_log = $this->receivework_model->insert_workprocess($data);
                $text = 'สร้าง(ส่งต่อ) หนังสือส่งไปยังหน่วยงาน';
                $this->systemlog->log_work_process($text, $work_process_id_pri_log);
                // line
                $message = "\n" . 'หนังสือเลขที่ ' . $workinfo->work_info_no . $workinfo->work_info_no_2 . $workinfo->work_info_no_3 . ' รายงานผล : ' . $this->input->post('work_user_report');
                $user = $this->receivework_model->get_user($row->work_user_giver_id);
                $this->send_line($user->user_line_token, $message);
                $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ทำรายการสำเร็จแล้ว');
                redirect(base_url('receivework/detail/' . $work_user_id));
            } else {
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('receivework'));
        }
    }

    public function attach($work_user_id) {
        $workusers = $this->receivework_model->getworkuser($work_user_id);
        if ($workusers->num_rows() > 0) {
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/select2/dist/css/select2.min.css', 'plugin/datepicker/datepicker.css', 'plugin/fancybox/dist/jquery.fancybox.css'),
                'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/select2/dist/js/select2.full.min.js', 'plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js'),
                'work_user_id' => $work_user_id,
                'work_process_id_pri' => $workusers->row()->work_process_id_pri,
                'work_info_id_pri' => $workusers->row()->work_info_id_pri,
                'data' => $this->receivework_model->getworkinfo($workusers->row()->work_info_id_pri)->row(),
            );
            $this->renderView('receiveworkattach_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('receivework'));
        }
    }

    public function ajax_page() {
        $work_user_id = $this->input->post('work_user_id');
        $data = array(
            'datas' => $this->receivework_model->getworkuserfofile($work_user_id),
        );
        $this->load->view('ajax/receivework_page', $data);
    }

    public function upload_attach($work_user_id) {
        $input_name = 'upload_attach[]';
        $this->load->library('upload');
        $this->load->library('managefolder');
        $genName = $this->generateRandomString();
        $file_name = 'RW' . $work_user_id . '_' . date('YmdHis') . '_' . $genName;
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
                    $file_type_id = $this->receivework_model->ref_file_type($name_type)->row()->file_type_id;
                    //echo $path . '/' . $key['name'] . '/' . $this->upload->data('file_name') . '/' . $name_type . '/' . $file_type_id . '/';
                    $data = array(
                        'work_user_id' => $work_user_id,
                        'user_id' => $this->session->userdata('user_id'),
                        'work_user_file_path' => $path,
                        'work_user_file_oldname' => $key['name'],
                        'work_user_file_name' => $this->upload->data('file_name'),
                        'file_type_id' => $file_type_id,
                        'work_user_file_active' => 1,
                        'work_user_file_create' => $this->misc->getdate(),
                        'work_user_file_update' => $this->misc->getdate()
                    );
                    $work_user_file_id = $this->receivework_model->insert_workuserfile($data);
                    $datalog = array(
                        'log_type_id' => 3,
                        'work_user_file_id' => $work_user_file_id,
                        'user_id' => $this->session->userdata('user_id'),
                        'log_text' => 'สร้าง File ' . $this->upload->data('file_name'),
                        'log_status_id' => 1,
                        'log_time' => $this->misc->getdate()
                    );
                    $this->systemlog->log_file($datalog);

                    // $work_info_id_pri = $this->receivework_model->get_workuserid($work_user_id)->row()->work_info_id_pri;
                    // $workinfo = $this->receivework_model->getworkinfo($work_info_id_pri)->row();
                    // $users = $this->receivework_model->getuser_dep_off($workinfo->dep_off_id);
                    // $message = "\n" . 'หนังสือเลขที่ ' . $workinfo->work_info_no . $workinfo->work_info_no_2 . $workinfo->work_info_no_3 . ' มีการ "เพิ่ม" ไฟล์เอกสาร';
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
            'log_type_id' => 3,
            'work_user_file_id' => $id,
            'user_id' => $this->session->userdata('user_id'),
            'log_text' => 'สร้าง File ' . $name,
            'log_status_id' => 2,
            'log_time' => $this->misc->getdate()
        );
        $this->systemlog->log_file($datalog);
        // $work_user_id = $this->receivework_model->getworkuserfofileid($id)->work_user_id;
        // $work_info_id_pri = $this->receivework_model->get_workuserid($work_user_id)->row()->work_info_id_pri;
        // $workinfo = $this->receivework_model->getworkinfo($work_info_id_pri)->row();
        // $users = $this->receivework_model->getuser_dep_off($workinfo->dep_off_id);
        // $message = "\n" . 'หนังสือเลขที่ ' . $workinfo->work_info_no . $workinfo->work_info_no_2 . $workinfo->work_info_no_3 . ' มีการ "เพิ่ม" ไฟล์เอกสาร';
        // if ($users->num_rows() > 0) {
        //     foreach ($users->result() as $user) {
        //         $this->send_line($user->user_line_token, $message);
        //     }
        // }
        $this->receivework_model->delete_workuserfile($id);
    }

    // send line
    public function send_line($line_token, $message) {
        if ($line_token != null && $line_token != '') {
            $line = $this->line->line_notification($line_token, $message);
            if ($line == 1) {
                $this->systemlog->log_send_line($message, $this->session->userdata('user_id'), $line_token);
            }
        }
    }
}
