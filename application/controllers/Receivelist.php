<?php

/**
 * Description of Receivelist
 * @author nut
 */
class Receivelist extends CI_Controller {

    public $group_id = 15;
    public $menu_id = 49;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('receivelist_model');
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
        $this->renderView('receivelist_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'year_id' => $this->input->post('year_id'),
            'status_id' => $this->input->post('status_id'),
            'priority_info_id' => $this->input->post('priority_info_id'),
            'book_group_id' => $this->input->post('book_group_id'),
            'searchtext' => $this->input->post('searchtext'),
        );
        $count = $this->receivelist_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('receivelist/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "', 'year_id' : '" . $this->input->post('year_id') . "', 'status_id' : '" . $this->input->post('status_id') . "', 'priority_info_id' : '" . $this->input->post('priority_info_id') . "', 'book_group_id' : '" . $this->input->post('book_group_id') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->receivelist_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/receivelist_pagination', $data);
    }

    //เปิด
    public function detail($work_process_id_pri, $check = null) {
        $workprocess = $this->receivelist_model->get_workprocess($work_process_id_pri);
        if ($workprocess->num_rows() > 0) {
            if ($workprocess->row()->work_process_receive == 2) {
                $data = array(
                    'work_process_receive_user_id' => $this->session->userdata('user_id'),
                    'work_process_receive_name' => $this->receivelist_model->ref_user(),
                    'work_process_receive' => 1,
                    'work_process_receive_date' => $this->misc->getdate(),
                    'work_process_update' => $this->misc->getdate(),
                );
                $this->receivelist_model->update_workprocess($work_process_id_pri, $data);
                if ($this->receivelist_model->checkworkinfo($workprocess->row()->work_info_id_pri)->num_rows() == 0) {
                    $this->receivelist_model->update_workinfo($workprocess->row()->work_info_id_pri, array('state_info_id' => 5, 'work_info_update' => $this->misc->getdate()));
                }
            }
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
                'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js'),
                'work_process_id_pri' => $work_process_id_pri,
                'workprocess' => $workprocess->row(),
                'data' => $this->receivelist_model->getworkinfo($workprocess->row()->work_info_id_pri)->row(),
            );
            if ($check != null) {
                if ($check != 2) {
                    $text = 'เปิด หนังสือส่งไปยังหน่วยงาน';
                    $this->systemlog->log_work_process($text, $work_process_id_pri);
                } else {
                    $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ส่งข้อมูลเรียบร้อยแล้ว');
                    redirect(base_url('receivelist'));
                }
            }
            $this->renderView('receivelistdetail_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('receivelist'));
        }
    }

    public function modal_receive() {
        $work_process_id_pri = $this->input->post('work_process_id_pri');
        $workprocess = $this->receivelist_model->checkworkprocess($work_process_id_pri);
        if ($workprocess->num_rows() == 1) {
            $row = $workprocess->row();
            if ($row->work_process_receive == 0) {
                $data = array(
                    'work_process_id_pri' => $work_process_id_pri,
                    'row' => $workprocess->row(),
                );
                $this->load->view('modal/receivelist_modal', $data);
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    //ลงทะเบียนรับเอกสาร
    public function receive() {
        $work_process_id_pri = $this->input->post('work_process_id_pri');
        $workprocess = $this->receivelist_model->checkworkprocess($work_process_id_pri);
        if ($workprocess->num_rows() == 1) {
            $row = $workprocess->row();
            if ($row->work_process_receive == 0) {
                $departmentyear = $this->receivelist_model->getdepartmentyear($work_process_id_pri)->row();
                $data = array(
                    'work_process_receive_user_id' => $this->session->userdata('user_id'),
                    'work_process_receive_name' => $this->receivelist_model->ref_user(),
                    'work_process_receive' => 1,
                    'work_process_receive_id' => $departmentyear->dep_year_receive_last,
                    'work_process_sendstatus' => $this->input->post('work_process_sendtype') == 1 ? 1 : 0,
                    'work_process_receive_date' => $this->misc->getdate(),
                    'work_process_update' => $this->misc->getdate(),
                );
                $this->receivelist_model->update_workprocess($work_process_id_pri, $data);
                $this->receivelist_model->update_departmentyear($departmentyear->dep_year_id, array('dep_year_receive_last' => $departmentyear->dep_year_receive_last + 1));
                if ($this->receivelist_model->checkworkinfo($row->work_info_id_pri)->num_rows() == 0) {
                    $this->receivelist_model->update_workinfo($row->work_info_id_pri, array('state_info_id' => 5, 'work_info_update' => $this->misc->getdate()));
                }

                //เช็ค ถ้าในหน่วยงานรับแล้วจะไม่ลงทะเบียนเอกสารอีก
                $deps = $this->receivelist_model->getworkprocessdep($row->work_info_id_pri);
                if ($deps->num_rows() > 0) {
                    foreach ($deps->result() as $dep) {
                        $dataprocess = array(
                            'work_process_receive_id' => $departmentyear->dep_year_receive_last,
                            'work_process_receive' => 2,
                            'work_process_update' => $this->misc->getdate(),
                        );
                        $this->receivelist_model->update_workprocess($dep->work_process_id_pri, $dataprocess);
                    }
                }

                $text = 'ลงรับ หนังสือส่งไปยังหน่วยงาน';
                $this->systemlog->log_work_process($text, $work_process_id_pri);
                $dep_off_id = $this->receivelist_model->getworkinfo($row->work_info_id_pri)->row()->dep_off_id;
                $users = $this->receivelist_model->getuser_dep_off($dep_off_id);
                $withinprocess = $this->receivelist_model->getworkprocess($work_process_id_pri)->row();
                $dep_off = $this->receivelist_model->getdep_off_id($withinprocess->dep_off_id);
                //ส่ง line
                if ($row->work_info_follow == 1) {
                    $message = "\n" . "ลงรับ หนังสือเลขที่ " . $row->work_info_no . $row->work_info_no_2 . $row->work_info_no_3 . " โดย " . $dep_off->officer_name . ' : ' . $dep_off->dep_name;
                    if ($users->num_rows() > 0) {
                        foreach ($users->result() as $user) {
                            //                            echo $user->user_id .'<br>';
                            if (!empty($user->user_line_token)) {
                                $this->send_line($user->user_line_token, $message);
                            }
                        }
                    }
                }
                $this->session->set_flashdata('flash_message', 'success,ลงทะเบียนสำเร็จ,ทำรายการสำเร็จแล้ว');
                echo 1;
            } else {
                $this->session->set_flashdata('flash_message', 'success,ลงทะเบียนรับหนังสือแล้ว,ทำรายการสำเร็จแล้ว');
                echo 1;
            }
        } else {
            echo 0;
        }
    }

    public function modal_sendstatus() {
        $work_process_id_pri = $this->input->post('work_process_id_pri');
        $workprocess = $this->receivelist_model->checkworkprocess($work_process_id_pri);
        if ($workprocess->num_rows() == 1) {
            $row = $workprocess->row();
            if ($row->work_process_sendstatus == 0) {
                $data = array(
                    'work_process_id_pri' => $work_process_id_pri,
                    'row' => $workprocess->row(),
                );
                $this->load->view('modal/receivesendstatus_modal', $data);
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    //ส่งต่อตามเส้นทาง
    public function receivesend() {
        $work_process_id_pri = $this->input->post('work_process_id_pri');
        $workprocess = $this->receivelist_model->checkworkprocess($work_process_id_pri);
        if ($workprocess->num_rows() == 1) {
            $row = $workprocess->row();
            if ($row->work_process_receive == 1) {
                if ($row->work_process_sendstatus == 0) {
                    $data = array(
                        'work_process_sendstatus' => 1,
                        'work_process_update' => $this->misc->getdate(),
                    );
                    $this->receivelist_model->update_workprocess($work_process_id_pri, $data);
                    $checks = $this->receivelist_model->getnextprocess($row->work_info_id_pri, $row->work_process_sort + 1, 3);
                    if ($checks->num_rows() > 0) {
                        $check = $checks->row();
                        $withinprocess = $this->receivelist_model->getworkprocess($check->work_process_id_pri)->row();
                        if ($this->receivelist_model->getdep_off_id($withinprocess->dep_off_id)->dep_id_pri == $this->session->userdata('dep_id_pri')) {
                            $datacheck = array(
                                'work_process_receive_id' => $row->work_process_receive_id,
                                'work_process_receive' => 2,
                                'work_process_sendstatus' => 0,
                                'work_process_update' => $this->misc->getdate(),
                            );
                        } else {
                            $datacheck = array(
                                'work_process_sendstatus' => 0,
                                'work_process_update' => $this->misc->getdate(),
                            );
                        }
                        //print_r($datacheck);
                        $this->receivelist_model->update_workprocess($check->work_process_id_pri, $datacheck);
                        $text = 'ส่งต่อตามเส้นทาง หนังสือส่งไปยังหน่วยงาน';
                        $this->systemlog->log_work_process($text, $work_process_id_pri);
                        $users = $this->receivelist_model->getuser_dep_off($withinprocess->dep_off_id);
                        $message = "\n" . "หนังสือเลขที่ " . $row->work_info_no . $row->work_info_no_2 . $row->work_info_no_3 . " เรื่อง " . $row->work_info_subject . " ส่งถึงท่าน ";
                        if ($users->num_rows() > 0) {
                            foreach ($users->result() as $user) {
                                if (!empty($user->user_line_token)) {
                                    $this->send_line($user->user_line_token, $message);
                                }
                            }
                        }
                        $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ทำรายการสำเร็จแล้ว');
                        echo 1;
                    } else {
                        echo 0;
                    }
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    //แสดงความคิดเห็น
    public function add_comment() {
        $work_process_id_pri = $this->input->post('work_process_id_pri');
        $signature_current = $this->input->post('signature_current');
        $workprocess = $this->receivelist_model->checkworkprocess($work_process_id_pri);
        if ($workprocess->num_rows() == 1) {
            if ($this->input->post('signature_status_id') != 1) {
                $data = array(
                    'special_command_id' => $this->input->post('special_command_id'),
                    'work_process_receive_user_id' => $this->session->userdata('user_id'),
                    'work_process_receive_name' => $this->receivelist_model->key_user()->row()->user_fullname,
                    'work_process_receive_comment' => $this->input->post('work_process_receive_comment'),
                    'work_process_receive_signature' => null,
                    'work_process_receive_signature_name' => $this->receivelist_model->key_user()->row()->user_fullname,
                    'work_process_receive_signature_date' => $this->misc->getdate(),
                    'work_process_receive_signature_key' => null,
                    'work_process_act_for_flag' => $this->input->post('work_process_act_for_flag'),
                    'work_process_act_for_position' => $this->input->post('work_process_act_for_position'),
                    'work_process_update' => $this->misc->getdate(),
                );
                $this->receivelist_model->update_workprocess($work_process_id_pri, $data);
                $text = 'แสดงความคิดเห็น หนังสือส่งไปยังหน่วยงาน';
                $this->systemlog->log_work_process($text, $work_process_id_pri);
                $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ทำรายการสำเร็จแล้ว');
                redirect(base_url('receivelist/detail/' . $work_process_id_pri));
            } else {
                if (!empty($this->input->post('pin_key'))) {
                    $pin = hash('sha256', $this->session->userdata('user_id') . $this->input->post('pin_key'));
                    $pin_key = $this->receivelist_model->key_user()->row()->pin_key;
                    if ($pin === $pin_key) {
                        $row = $workprocess->row();
                        if ($row->work_process_receive == 1) {
                            $signature = '';
                            if (!empty($_FILES['signature']['name'])) {
                                $this->load->library('upload');
                                $this->load->library('image_lib');
                                $config_photo = array(
                                    'upload_path' => './assets/upload/signature/',
                                    'allowed_types' => 'jpg|gif|png',
                                    'max_size' => 8192,
                                    'file_name' => 'signature_process_' . $work_process_id_pri . '_' . date('YmdHis')
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
                            $signature_key = $this->misc->generateSignature($row->work_info_id_pri, $this->session->userdata('user_id')); //($info, $user)
                            $signature_date = $this->misc->getdate();
                            $data = array(
                                'special_command_id' => $this->input->post('special_command_id'),
                                'work_process_receive_user_id' => $this->session->userdata('user_id'),
                                'work_process_receive_name' => $this->receivelist_model->key_user()->row()->user_fullname,
                                'work_process_receive_comment' => $this->input->post('work_process_receive_comment'),
                                'work_process_receive_signature' => $signature == '' ? $signature_current : $signature,
                                'work_process_receive_signature_name' => $this->receivelist_model->key_user()->row()->user_fullname,
                                'work_process_receive_signature_date' => $signature_date,
                                'work_process_receive_signature_key' => $signature_key,
                                'work_process_act_for_flag' => $this->input->post('work_process_act_for_flag'),
                                'work_process_act_for_position' => $this->input->post('work_process_act_for_position'),
                                'work_process_update' => $this->misc->getdate(),
                            );
                            $this->receivelist_model->update_workprocess($work_process_id_pri, $data);
                            $datasignature = array(
                                'user_id' => $this->session->userdata('user_id'),
                                'year_id' => $row->year_id,
                                'work_info_id_pri' => $row->work_info_id_pri,
                                'work_process_id_pri' => $row->work_process_id_pri,
                                'work_user_id' => null,
                                'signature_type_id' => 2,
                                'signature_work_no' => $row->work_process_no . $row->work_process_no_2 . $row->work_process_no_3,
                                'signature_image' => $signature == '' ? $signature_current : $signature,
                                'signature_name' => $this->receivelist_model->key_user()->row()->user_fullname,
                                'signature_date' => $signature_date,
                                'signature_key' => $signature_key,
                                'signaturec_modify' => $this->misc->getdate(),
                            );
                            $this->receivelist_model->insert_signature($datasignature);
                            $text = 'แสดงความคิดเห็น หนังสือส่งไปยังหน่วยงาน';
                            $this->systemlog->log_work_process($text, $work_process_id_pri);
                            $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ทำรายการสำเร็จแล้ว');
                            redirect(base_url('receivelist/detail/' . $work_process_id_pri));
                        }
                    } else {
                        $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,รหัส PIN ไม่ถูกต้อง');
                        redirect(base_url('receivelist/detail/' . $work_process_id_pri));
                    }
                } else {
                    $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,รหัส PIN ไม่ถูกต้อง');
                    redirect(base_url('receivelist/detail/' . $work_process_id_pri));
                }
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('receivelist'));
        }
    }

    //ตีกลับ
    public function add_back() {
        $work_process_id_pri = $this->input->post('work_process_id_pri');
        $workprocess = $this->receivelist_model->checkworkprocess($work_process_id_pri);
        if ($workprocess->num_rows() == 1) {
            $row = $workprocess->row();
            if ($this->receivelist_model->checkwithinbounce($row->work_info_id_pri)->num_rows() == 0) {
                if ($row->work_process_receive == 1) {
                    $data = array(
                        'work_process_receive_commentback' => $this->input->post('work_process_receive_comment_1'),
                        'work_process_status_id' => 2,
                        'work_process_update' => $this->misc->getdate(),
                    );
                    $this->receivelist_model->update_workprocess($work_process_id_pri, $data);
                    if ($this->receivelist_model->checkworkinfoback($row->work_info_id_pri)->num_rows() == 1) {
                        $this->receivelist_model->update_workinfo($row->work_info_id_pri, array('state_info_id' => 8, 'work_info_update' => $this->misc->getdate()));
                    } else {
                        $this->receivelist_model->update_workinfo($row->work_info_id_pri, array('state_info_id' => 4, 'work_info_update' => $this->misc->getdate()));
                    }
                    $dep_off_id = $this->receivelist_model->getworkinfo($row->work_info_id_pri)->row()->dep_off_id;
                    $withinprocess = $this->receivelist_model->getworkprocess($work_process_id_pri)->row();
                    $datasend = array(
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
                        'work_process_sendtype' => $withinprocess->work_process_sendtype,
                        'work_process_sendstatus' => $withinprocess->work_process_sendstatus,
                        'work_process_sort' => $withinprocess->work_process_sort,
                        'work_process_status_id' => 3,
                        'work_process_create' => $this->misc->getdate(),
                        'work_process_update' => $this->misc->getdate(),
                    );
                    //                echo '<pre>';
                    //                print_r($datasend);
                    //                echo '</pre>';
                    $this->receivelist_model->insert_workprocess($datasend);
                    $text = 'ตีกลับ หนังสือส่งไปยังหน่วยงาน';
                    $this->systemlog->log_work_process($text, $work_process_id_pri);
                    $dep_off = $this->receivelist_model->getdep_off_id($withinprocess->dep_off_id);
                    $users = $this->receivelist_model->getuser_dep_off($dep_off_id);
                    $message = "\n" . "หนังสือเลขที่ " . $row->work_info_no . $row->work_info_no_2 . $row->work_info_no_3 . " เรื่อง " . $row->work_info_subject . " ถูกตีกลับ โดย " . $dep_off->officer_name . ' : ' . $dep_off->dep_name;
                    if ($users->num_rows() > 0) {
                        foreach ($users->result() as $user) {
                            if (!empty($user->user_line_token)) {
                                $this->send_line($user->user_line_token, $message);
                            }
                        }
                    }
                    $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ทำรายการตีกลับสำเร็จแล้ว');
                    redirect(base_url('receivelist/detail/' . $work_process_id_pri));
                }
            } else {
                $this->session->set_flashdata('flash_message', 'error,มีรายการตีกลับแล้ว,ไม่สามารถทำรายการได้');
                redirect(base_url('receivelist'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('receivelist'));
        }
    }

    public function send($work_info_id_pri, $work_process_id_pri) {
        $workinfo = $this->receivelist_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() > 0) {
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/datepicker/datepicker.css', 'plugin/fancybox/dist/jquery.fancybox.css', 'plugin/multiselect-tree/dist/jquery.tree-multiselect.css'),
                'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js', 'plugin/jqueryui/jquery-ui.min.js', 'plugin/multiselect-tree/dist/jquery.tree-multiselect.js'),
                'work_info_id_pri' => $work_info_id_pri,
                'data' => $workinfo->row(),
                'work_process_id_pri' => $work_process_id_pri,
            );
            $this->renderView('sendreceive_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('receivelist'));
        }
    }

    //แจกจ่ายส่งต่อ
    public function sendto() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $work_process_id_pri = $this->input->post('work_process_id_pri');
        $select_checkbox = $this->input->post('def_id_pri_select');
        $workinfo = $this->receivelist_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() == 1) {
            $row = $workinfo->row();
            if (count($select_checkbox) != 0) {
                $check = 0;
                foreach ($select_checkbox as $dep_off_id) {
                    if ($this->receivelist_model->checkprocessnotopen($work_info_id_pri, $dep_off_id)->num_rows() == 0) {
                        if ($dep_off_id != $this->session->userdata('dep_off_id')) {
                            $workprocess = $this->receivelist_model->getworkprocess($work_process_id_pri)->row();
                            $processdepoff =  $this->receivelist_model->check_info_depoff_id($row->work_info_id_pri, $dep_off_id);
                            if ($this->receivelist_model->getdep_off_id($dep_off_id)->dep_id_pri == $this->receivelist_model->getdep_off_id($workprocess->dep_off_id)->dep_id_pri) {
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
                                    'work_process_receive_id' => $workprocess->work_process_receive_id,
                                    'work_process_receive' => 2,
                                    'work_process_date' => $row->work_info_date,
                                    'work_process_sendtype' => $workprocess->work_process_sendtype,
                                    'work_process_sendstatus' => $workprocess->work_process_sendstatus,
                                    'work_process_sort' => $workprocess->work_process_sort,
                                    'work_process_create' => $this->misc->getdate(),
                                    'work_process_update' => $this->misc->getdate(),
                                );
                            } else if ($processdepoff->num_rows() > 0) {
                                $processdepoff = $processdepoff->row();
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
                                    'work_process_receive_id' => $processdepoff->work_process_receive_id,
                                    'work_process_receive' => $processdepoff->work_process_receive_id == null ? 0 : 2,
                                    'work_process_date' => $row->work_info_date,
                                    'work_process_sendtype' => $workprocess->work_process_sendtype,
                                    'work_process_sendstatus' => $workprocess->work_process_sendstatus,
                                    'work_process_sort' => $workprocess->work_process_sort,
                                    'work_process_create' => $this->misc->getdate(),
                                    'work_process_update' => $this->misc->getdate(),
                                );
                            } else {
                                $data = array(
                                    'work_info_id_pri' => $row->work_info_id_pri,
                                    'work_process_id' => $row->work_info_id,
                                    'work_process_no' => $row->work_info_no,
                                    'work_process_no_2' => $row->work_info_no_2,
                                    'work_process_no_3' => $row->work_info_no_3,
                                    'work_process_id_to' => $work_process_id_pri,
                                    'year_id' => $row->year_id,
                                    'work_process_receive' => 0,
                                    'user_id' => $this->session->userdata('user_id'),
                                    'dep_id_pri' => $this->session->userdata('dep_id_pri'),
                                    'dep_off_id' => $dep_off_id,
                                    'work_process_receive' => 0,
                                    'work_process_date' => $row->work_info_date,
                                    'work_process_sendtype' => $workprocess->work_process_sendtype,
                                    'work_process_sendstatus' => $workprocess->work_process_sendstatus,
                                    'work_process_sort' => $workprocess->work_process_sort,
                                    'work_process_create' => $this->misc->getdate(),
                                    'work_process_update' => $this->misc->getdate(),
                                );
                            }
                            $check = 1;
                            $text = 'ส่งต่อ หนังสือส่งไปยังหน่วยงาน';
                            $this->systemlog->log_work_process($text, $work_process_id_pri);
                            $work_process_id_pri_log = $this->receivelist_model->insert_workprocess($data);
                            $text = 'สร้าง(ส่งต่อ) หนังสือส่งไปยังหน่วยงาน';
                            $this->systemlog->log_work_process($text, $work_process_id_pri_log);
                            $users = $this->receivelist_model->getuser_dep_off($dep_off_id);
                            $message = "\n" . "หนังสือเลขที่ " . $row->work_info_no . $row->work_info_no_2 . $row->work_info_no_3 . " เรื่อง " . $row->work_info_subject . " ส่งถึงท่าน ";
                            if ($users->num_rows() > 0) {
                                foreach ($users->result() as $user) {
                                    if (!empty($user->user_line_token)) {
                                        $this->send_line($user->user_line_token, $message);
                                    }
                                }
                            }
                            //print_r($data);
                        }
                    }
                }
                if ($check == 1) {
                    $this->receivelist_model->update_workinfo($row->work_info_id_pri, array('state_info_id' => 4, 'work_info_update' => $this->misc->getdate()));
                }
                $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ทำรายการสำเร็จแล้ว');
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    public function changesend($work_info_id_pri, $work_process_id_pri) {
        $workinfo = $this->receivelist_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() > 0) {
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/datepicker/datepicker.css', 'plugin/fancybox/dist/jquery.fancybox.css', 'plugin/multiselect-tree/dist/jquery.tree-multiselect.css'),
                'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js', 'plugin/jqueryui/jquery-ui.min.js', 'plugin/multiselect-tree/dist/jquery.tree-multiselect.js'),
                'work_info_id_pri' => $work_info_id_pri,
                'data' => $workinfo->row(),
                'work_process_id_pri' => $work_process_id_pri,
            );
            $this->renderView('sendreceivechange_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('receivelist'));
        }
    }

    //เปลี่ยนเส้นทาง
    public function changesendto() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $workinfo = $this->receivelist_model->getworkinfo($work_info_id_pri);
        $select_checkbox = $this->input->post('def_id_pri_select');
        if ($workinfo->num_rows() == 1) {
            $row = $workinfo->row();
            $work_process_id_pri = $this->input->post('work_process_id_pri');
            $workprocess = $this->receivelist_model->getworkprocess($work_process_id_pri)->row();
            if (count($select_checkbox) != 0) {
                $checksend = 0;
                foreach ($select_checkbox as $dep_off_id) {
                    if ($this->receivelist_model->checkprocessnotopen($work_info_id_pri, $dep_off_id)->num_rows() == 0) {
                        if ($dep_off_id != $this->session->userdata('dep_off_id')) {
                            $checksend = 1;
                        }
                    }
                }
                if ($checksend == 1) {
                    $count = count($select_checkbox);
                    $checks = $this->receivelist_model->getsortprocess($work_info_id_pri, $workprocess->work_process_sort);
                    if ($checks->num_rows() > 0) {
                        foreach ($checks->result() as $check) {
                            //echo $check->work_process_id_pri . '/' . $check->work_process_sort . '/' . ($check->work_process_sort + $count);
                            $this->receivelist_model->update_workprocess($check->work_process_id_pri, array('work_process_sort' => ($check->work_process_sort + $count), 'work_process_update' => $this->misc->getdate()));
                        }
                        $i = 1;
                        foreach ($select_checkbox as $dep_off_id) {
                            if ($this->receivelist_model->checkprocessnotopen($work_info_id_pri, $dep_off_id)->num_rows() == 0) {
                                if ($dep_off_id != $this->session->userdata('dep_off_id')) {
                                    $data = array(
                                        'work_info_id_pri' => $row->work_info_id_pri,
                                        'work_process_id' => $row->work_info_id,
                                        'work_process_no' => $row->work_info_no,
                                        'work_process_no_2' => $row->work_info_no_2,
                                        'work_process_no_3' => $row->work_info_no_3,
                                        'work_process_id_to' => $work_process_id_pri,
                                        'year_id' => $row->year_id,
                                        'dep_id_pri' => $this->session->userdata('dep_id_pri'),
                                        'dep_off_id' => $dep_off_id,
                                        'user_id' => $this->session->userdata('user_id'),
                                        'work_process_receive' => 0,
                                        'work_process_date' => $row->work_info_date,
                                        'work_process_sendtype' => 2,
                                        'work_process_sendstatus' => ($i == 1) ? 0 : 2,
                                        'work_process_sort' => ($workprocess->work_process_sort + $i),
                                        'work_process_create' => $this->misc->getdate(),
                                        'work_process_update' => $this->misc->getdate(),
                                    );

                                    //print_r($data);
                                    if ($i == 1) {
                                        $text = 'ส่งต่อ หนังสือส่งไปยังหน่วยงาน';
                                        $this->systemlog->log_work_process($text, $work_process_id_pri);
                                        $work_process_id_pri_log = $this->receivelist_model->insert_workprocess($data);
                                        $text = 'สร้าง(ส่งต่อ) หนังสือส่งไปยังหน่วยงาน';
                                        $this->systemlog->log_work_process($text, $work_process_id_pri_log);
                                        $users = $this->receivelist_model->getuser_dep_off($dep_off_id);
                                        $message = "\n" . "หนังสือเลขที่ " . $row->work_info_no . $row->work_info_no_2 . $row->work_info_no_3 . " เรื่อง " . $row->work_info_subject . " ส่งถึงท่าน ";
                                        if ($users->num_rows() > 0) {
                                            foreach ($users->result() as $user) {
                                                if (!empty($user->user_line_token)) {
                                                    $this->send_line($user->user_line_token, $message);
                                                }
                                            }
                                        }
                                    }
                                    $i++;
                                }
                            }
                        }
                        $this->receivelist_model->update_workinfo($row->work_info_id_pri, array('state_info_id' => 4, 'work_info_update' => $this->misc->getdate()));
                        if ($workprocess->work_process_receive == 1) {
                            if ($workprocess->work_process_sendstatus == 0) {
                                $dataupdate = array(
                                    'work_process_sendstatus' => 1,
                                    'work_process_update' => $this->misc->getdate(),
                                );
                                $this->receivelist_model->update_workprocess($work_process_id_pri, $dataupdate);
                                $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ทำรายการสำเร็จแล้ว');
                                echo 1;
                            } else {
                                echo 0;
                            }
                        } else {
                            echo 0;
                        }
                    } else {
                        echo 0;
                    }
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    public function senduser($work_info_id_pri, $work_process_id_pri) {
        $workinfo = $this->receivelist_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() > 0) {
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/datepicker/datepicker.css', 'plugin/fancybox/dist/jquery.fancybox.css', 'plugin/multiselect-tree/dist/jquery.tree-multiselect.css'),
                'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js', 'plugin/jqueryui/jquery-ui.min.js', 'plugin/multiselect-tree/dist/jquery.tree-multiselect.js'),
                'work_info_id_pri' => $work_info_id_pri,
                'data' => $workinfo->row(),
                'work_process_id_pri' => $work_process_id_pri,
            );
            $this->renderView('sendreceiveuesr_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('receivelist'));
        }
    }

    //ส่งถึงผู้ปฏิบัติงาน
    public function sendtouser() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $work_process_id_pri = $this->input->post('work_process_id_pri');
        $select_checkbox = $this->input->post('user_id_select');
        $workinfo = $this->receivelist_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() == 1) {
            $row = $workinfo->row();
            if (count($select_checkbox) != 0) {
                foreach ($select_checkbox as $user_id) {
                    $data = array(
                        'work_info_id_pri' => $work_info_id_pri,
                        'work_process_id_pri' => $work_process_id_pri,
                        'work_user_giver_id' => $this->session->userdata('user_id'),
                        'year_id' => $row->year_id,
                        'user_id' => $user_id,
                        'work_user_status_id' => 1,
                        //'work_user_startdate' => $row->work_info_date,
                        'work_user_create' => $this->misc->getdate(),
                        'work_user_update' => $this->misc->getdate(),
                    );
                    $work_user_id = $this->receivelist_model->insert_workuser($data);
                    $text = 'สร้าง(ส่งต่อ) หนังสือส่งไปยังผู้ปฏิบัติงาน';
                    $this->systemlog->log_work_process($text, $work_process_id_pri);
                    $text = 'สร้าง หนังสือส่งไปยังผู้ปฏิบัติงาน';
                    $this->systemlog->log_work_user($text, $work_user_id);
                    //print_r($data);
                    $user = $this->receivelist_model->get_user($user_id);
                    $message = "\n" . "หนังสือเลขที่ " . $row->work_info_no . $row->work_info_no_2 . $row->work_info_no_3 . " เรื่อง " . $row->work_info_subject . " ส่งถึงท่าน ";
                    if (!empty($user->user_line_token)) {
                        $this->send_line($user->user_line_token, $message);
                    }
                }
                $this->receivelist_model->update_workinfo($row->work_info_id_pri, array('state_info_id' => 4, 'work_info_update' => $this->misc->getdate()));
                $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ทำรายการสำเร็จแล้ว');
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    //เพิ่มไฟล์เอกสาร
    public function attach($work_process_id_pri) {
        $workprocess = $this->receivelist_model->getworkprocess($work_process_id_pri);
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
                'data' => $this->receivelist_model->getworkinfo($workprocess->row()->work_info_id_pri)->row(),
            );
            $this->renderView('receivelistattach_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('receivelist'));
        }
    }

    public function ajax_page() {
        $work_process_id_pri = $this->input->post('work_process_id_pri');
        $data = array(
            'datas' => $this->receivelist_model->get_workprocessfofileid($work_process_id_pri),
        );
        $this->load->view('ajax/receivelist_page', $data);
    }

    public function upload_attach($work_process_id_pri) {
        $input_name = 'upload_attach[]';
        $this->load->library('upload');
        $this->load->library('managefolder');
        $genName = $this->generateRandomString();
        $file_name = 'R' . $work_process_id_pri . '_' . date('YmdHis') . '_' . $genName;
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
                    $file_type_id = $this->receivelist_model->ref_file_type($name_type)->row()->file_type_id;
                    //echo $path . '/' . $key['name'] . '/' . $this->upload->data('file_name') . '/' . $name_type . '/' . $file_type_id . '/';
                    $data = array(
                        'work_process_id_pri' => $work_process_id_pri,
                        'user_id' => $this->session->userdata('user_id'),
                        'work_process_file_send' => 2,
                        'work_process_file_path' => $path,
                        'work_process_file_oldname' => $key['name'],
                        'work_process_file_name' => $this->upload->data('file_name'),
                        'file_type_id' => $file_type_id,
                        'work_process_file_active' => 1,
                        'work_process_file_create' => $this->misc->getdate(),
                        'work_process_file_update' => $this->misc->getdate()
                    );
                    $work_process_file_id = $this->receivelist_model->insert_workprocessfile($data);
                    $datalog = array(
                        'log_type_id' => 2,
                        'work_process_file_id' => $work_process_file_id,
                        'user_id' => $this->session->userdata('user_id'),
                        'log_text' => 'สร้าง File ' . $this->upload->data('file_name'),
                        'log_status_id' => 1,
                        'log_time' => $this->misc->getdate()
                    );
                    $this->systemlog->log_file($datalog);

                    // $work_info_id_pri = $this->receivelist_model->getworkprocess($work_process_id_pri)->row()->work_info_id_pri;
                    // $workinfo = $this->receivelist_model->getworkinfo($work_info_id_pri)->row();
                    // $users = $this->receivelist_model->getuser_dep_off($workinfo->dep_off_id);
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
            'log_type_id' => 2,
            'work_process_file_id' => $id,
            'user_id' => $this->session->userdata('user_id'),
            'log_text' => 'ลบ File ' . $name,
            'log_status_id' => 2,
            'log_time' => $this->misc->getdate()
        );
        $this->systemlog->log_file($datalog);
        // $work_process_id_pri = $this->receivelist_model->get_workprocessfofileid($id)->work_process_id_pri;
        // $work_info_id_pri = $this->receivelist_model->getworkprocess($work_process_id_pri)->row()->work_info_id_pri;
        // $workinfo = $this->receivelist_model->getworkinfo($work_info_id_pri)->row();
        // $users = $this->receivelist_model->getuser_dep_off($workinfo->dep_off_id);
        // $message = "\n" . 'หนังสือเลขที่ ' . $workinfo->work_info_no . $workinfo->work_info_no_2 . $workinfo->work_info_no_3 . ' มีการ "ลบ" ไฟล์เอกสาร';
        // if ($users->num_rows() > 0) {
        //     foreach ($users->result() as $user) {
        //         $this->send_line($user->user_line_token, $message);
        //     }
        // }
        $this->receivelist_model->delete_workprocessfile($id);
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
