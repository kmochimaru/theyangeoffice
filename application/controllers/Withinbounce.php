<?php

/**
 * Description of Withinbounce
 * @author nut
 */
class Withinbounce extends CI_Controller {

    public $group_id = 1;
    public $menu_id = 3;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('withinbounce_model');
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
        $this->renderView('withinbounce_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'year_id' => $this->input->post('year_id'),
            'searchtext' => $this->input->post('searchtext'),
        );
        $count = $this->withinbounce_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('withinbounce/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "', 'year_id' : '" . $this->input->post('year_id') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->withinbounce_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/withinbounce_pagination', $data);
    }

    public function detail($work_process_id_pri, $check = null) {
        $workprocess = $this->withinbounce_model->getworkprocess($work_process_id_pri);
        if ($workprocess->num_rows() > 0) {
            $dataupdate = array(
                'work_process_receive_user_id' => $this->session->userdata('user_id'),
                'work_process_receive_name' => $this->withinbounce_model->ref_user(),
                'work_process_receive' => 1,
//                'work_process_sendstatus' => 0,
                'work_process_receive_date' => $this->misc->getdate(),
                'work_process_receive_date' => $this->misc->getdate(),
                'work_process_update' => $this->misc->getdate(),
            );
            $this->withinbounce_model->update_workprocess($work_process_id_pri, $dataupdate);
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
                'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js'),
                'work_process_id_pri' => $work_process_id_pri,
                'workprocess' => $workprocess->row(),
                'data' => $this->withinbounce_model->getworkinfo($workprocess->row()->work_info_id_pri)->row(),
            );
            if ($check != null) {
                $text = 'เปิด หนังสือส่งไปยังหน่วยงาน';
                $this->systemlog->log_work_process($text, $work_process_id_pri);
            }
            $this->renderView('withinbouncedetail_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('withinbounce'));
        }
    }

    public function add_comment() {
        $work_process_id_pri = $this->input->post('work_process_id_pri');
        $workprocess = $this->withinbounce_model->checkworkprocess($work_process_id_pri);
        if ($workprocess->num_rows() == 1) {
            $row = $workprocess->row();
            if ($row->work_process_receive == 1) {
                $data = array(
                    'work_process_receive_comment' => $this->input->post('work_process_receive_comment'),
                    'work_process_update' => $this->misc->getdate(),
                );
                $this->withinbounce_model->update_workprocess($work_process_id_pri, $data);
                $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ทำรายการสำเร็จแล้ว');
                redirect(base_url('withinbounce/detail/' . $work_process_id_pri));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('withinbounce'));
        }
    }

    public function attach($work_process_id_pri = null) {
        if ($work_process_id_pri != null) {
            $workprocess = $this->withinbounce_model->getworkprocess($work_process_id_pri);
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
                    'data' => $this->withinbounce_model->getworkinfo($workprocess->row()->work_info_id_pri)->row(),
                );
                $this->renderView('withinbounceattach_view', $data);
            } else {
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
                redirect(base_url('withinbounce'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('withinbounce'));
        }
    }

    public function ajax_page() {
        $work_process_id_pri = $this->input->post('work_process_id_pri');
        $workprocess = $this->withinbounce_model->getworkprocess($work_process_id_pri)->row();
        $data = array(
            'datas' => $this->withinbounce_model->get_workprocessfofile($workprocess->work_process_id_to),
        );
        $this->load->view('ajax/withinbounce_page', $data);
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
                    $file_type_id = $this->withinbounce_model->ref_file_type($name_type)->row()->file_type_id;
                    $workprocess = $this->withinbounce_model->getworkprocess($work_process_id_pri)->row();
                    //echo $path . '/' . $key['name'] . '/' . $this->upload->data('file_name') . '/' . $name_type . '/' . $file_type_id . '/';
                    $data = array(
                        'work_process_id_pri' => $workprocess->work_process_id_to,
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
                    $work_process_file_id = $this->withinbounce_model->insert_workprocessfile($data);
                    $datalog = array(
                        'log_type_id' => 2,
                        'work_process_file_id' => $work_process_file_id,
                        'user_id' => $this->session->userdata('user_id'),
                        'log_text' => 'สร้าง File ' . $this->upload->data('file_name'),
                        'log_status_id' => 1,
                        'log_time' => $this->misc->getdate()
                    );
                    $this->systemlog->log_file($datalog);
                    // $users = $this->withinbounce_model->getuser_dep_off($workprocess->dep_off_id);
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
        // $workprocess = $this->withinbounce_model->get_workprocessfofile_id($id)->row();
        // $users = $this->withinbounce_model->getuser_dep_off($workprocess->dep_off_id);
        // $message = "\n" . 'หนังสือเลขที่ ' . $workprocess->work_process_no . $workprocess->work_process_no_2 . $workprocess->work_process_no_3 . ' มีการ "ลบ" ไฟล์เอกสาร';
        // if ($users->num_rows() > 0) {
        //     foreach ($users->result() as $user) {
        //         $this->send_line($user->user_line_token, $message);
        //     }
        // }
        $this->withinbounce_model->delete_workprocessfile($id);
    }

    //ส่งกลับคืน
    public function sendback() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $work_process_id_pri = $this->input->post('work_process_id_pri');
        $workinfo = $this->withinbounce_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() == 1) {
            $row = $workinfo->row();
            $this->withinbounce_model->update_workprocess($work_process_id_pri, array(
                'work_process_status_id' => 1,
                'work_process_sendstatus' => 1,
                'work_process_update' => $this->misc->getdate(),
            ));
            $workproces = $this->withinbounce_model->getworkprocess($work_process_id_pri)->row();
            $workprocesback = $this->withinbounce_model->getworkprocess($workproces->work_process_id_to)->row();
            $dep_off_id = $workprocesback->dep_off_id;
            $data = array(
                'work_info_id_pri' => $row->work_info_id_pri,
                'work_process_id' => $row->work_info_id,
                'work_process_no' => $row->work_info_no,
                'work_process_no_2' => $row->work_info_no_2,
                'work_process_no_3' => $row->work_info_no_3,
                'work_process_id_to' => $work_process_id_pri,
                'year_id' => $row->year_id,
                'user_id' => $this->session->userdata('user_id'),
                'dep_id_pri' => $this->session->userdata('dep_id_pri'),
                'dep_off_id' => $dep_off_id,
                'work_process_receive' => 0,
                'work_process_date' => $row->work_info_date,
                'work_process_sendtype' => $workproces->work_process_sendtype,
                'work_process_sendstatus' => $workproces->work_process_sendstatus,
                'work_process_sort' => $workproces->work_process_sort,
                'work_process_create' => $this->misc->getdate(),
                'work_process_update' => $this->misc->getdate(),
            );
            //print_r($data);
            $text = 'ส่งต่อ หนังสือส่งไปยังหน่วยงาน';
            $this->systemlog->log_work_process($text, $work_process_id_pri);
            $work_process_id_pri_log = $this->withinbounce_model->insert_workprocess($data);
            $text = 'สร้าง(ส่งต่อ) หนังสือส่งไปยังหน่วยงาน';
            $this->systemlog->log_work_process($text, $work_process_id_pri_log);
            $users = $this->withinbounce_model->getuser_dep_off($dep_off_id);
            $message = "\n" . "หนังสือเลขที่ " . $row->work_info_no . $row->work_info_no_2 . $row->work_info_no_3 . " เรื่อง " . $row->work_info_subject . " ส่งถึงท่าน ";
            if ($users->num_rows() > 0) {
                foreach ($users->result() as $user) {
                    $this->send_line($user->user_line_token, $message);
                }
            }
            $this->withinbounce_model->update_workinfo($row->work_info_id_pri, array('state_info_id' => 4, 'work_info_update' => $this->misc->getdate()));
            $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ทำรายการสำเร็จแล้ว');
            echo 1;
        } else {
            echo 0;
        }
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

    public function modal_closestatus() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $workinfo = $this->withinbounce_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() == 1) {
            if ($workinfo->row()->state_info_id <= 5 || $workinfo->row()->state_info_id == 8) {
                $data = array(
                    'row' => $workinfo->row(),
                );
                $this->load->view('modal/withinbounceclosestatus_modal', $data);
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    public function closestatus() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $workinfo = $this->withinbounce_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() == 1) {
            if ($workinfo->row()->state_info_id <= 5 || $workinfo->row()->state_info_id == 8) {
                $data = array(
                    'state_info_id' => 6,
                    'work_info_update' => $this->misc->getdate(),
                );
                $this->withinbounce_model->update_workinfo($work_info_id_pri, $data);
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    public function attachall($work_info_code, $work_process_id_pri) {
        $workinfo = $this->withinbounce_model->getworkinfocode($work_info_code);
        if ($workinfo->num_rows() > 0) {
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/select2/dist/css/select2.min.css', 'plugin/datepicker/datepicker.css', 'plugin/fancybox/dist/jquery.fancybox.css'),
                'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/select2/dist/js/select2.full.min.js', 'plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js'),
                'work_info_id_pri' => $workinfo->row()->work_info_id_pri,
                'work_process_id_pri' => $work_process_id_pri,
                'data' => $workinfo->row(),
            );
            $this->renderView('withinbounceattachall_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('withinbounce'));
        }
    }

    public function ajax_pageall() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $data = array(
            'datas' => $this->withinbounce_model->get_workinfofile($work_info_id_pri),
        );
        $this->load->view('ajax/withinbounceall_page', $data);
    }

    public function upload_attachall($work_info_id_pri) {
        $input_name = 'upload_attach[]';
        $this->load->library('upload');
        $this->load->library('managefolder');
        $genName = $this->generateRandomString();
        $file_name = 'IB' . $work_info_id_pri . '_' . date('YmdHis') . '_' . $genName;
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
                if ($this->upload->do_upload($input_name)) {
                    $upload = $this->upload->data();
                    $path = $upload_path . '/' . $this->upload->data('file_name');
                    $file_type_id = $this->withinbounce_model->ref_file_type($name_type)->row()->file_type_id;
                    $data = array(
                        'work_info_id_pri' => $work_info_id_pri,
                        'user_id' => $this->session->userdata('user_id'),
                        'work_info_file_path' => $path,
                        'work_info_file_oldname' => $key['name'],
                        'work_info_file_name' => $this->upload->data('file_name'),
                        'file_type_id' => $file_type_id,
                        'work_info_file_active' => 2,
                        'work_info_file_create' => $this->misc->getdate(),
                        'work_info_file_update' => $this->misc->getdate()
                    );
                    $work_info_file_id = $this->withinbounce_model->insert_workinfofile($data);
                    $datalog = array(
                        'log_type_id' => 1,
                        'work_info_file_id' => $work_info_file_id,
                        'user_id' => $this->session->userdata('user_id'),
                        'log_text' => 'สร้าง File ' . $this->upload->data('file_name'),
                        'log_status_id' => 1,
                        'log_time' => $this->misc->getdate()
                    );
                    $this->systemlog->log_file($datalog);
                    $withinprocess = $this->withinbounce_model->get_withinprocess($work_info_id_pri);
                    foreach ($withinprocess->result() as $row) {
                        $users = $this->withinbounce_model->getuser_dep_off($row->dep_off_id);
                        $message = "\n" . 'หนังสือเลขที่ ' . $row->work_process_no . $row->work_process_no_2 . $row->work_process_no_3 . ' มีการ "แนบ" ไฟล์เอกสาร';
                        if ($users->num_rows() > 0) {
                            foreach ($users->result() as $user) {
                                $this->send_line($user->user_line_token, $message);
                            }
                        }
                    }
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

    public function delete_fileall() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        //$patch_file = './' . $workinfofile->work_info_file_path;
        //@unlink($patch_file);
        //log_delete_workinfofile();
        $datalog = array(
            'log_type_id' => 1,
            'work_info_file_id' => $id,
            'user_id' => $this->session->userdata('user_id'),
            'log_text' => 'ลบ File ' . $name,
            'log_status_id' => 2,
            'log_time' => $this->misc->getdate()
        );
        $this->systemlog->log_file($datalog);
        // $work_info_id_pri = $this->withinbounce_model->get_workinfofileid($id)->row()->work_info_id_pri;
        // $withinprocess = $this->withinbounce_model->get_withinprocess($work_info_id_pri);
        // foreach ($withinprocess->result() as $row) {
        //     $users = $this->withinbounce_model->getuser_dep_off($row->dep_off_id);
        //     $message = "\n" . 'หนังสือเลขที่ ' . $row->work_process_no . $row->work_process_no_2 . $row->work_process_no_3 . ' มีการ "ลบ" ไฟล์เอกสาร';
        //     if ($users->num_rows() > 0) {
        //         foreach ($users->result() as $user) {
        //             $this->send_line($user->user_line_token, $message);
        //         }
        //     }
        // }
        $this->withinbounce_model->delete_workinfofile($id);
    }

}
