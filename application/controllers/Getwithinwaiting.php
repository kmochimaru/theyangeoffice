<?php

class Getwithinwaiting extends CI_Controller {

    public $group_id = 10;
    public $menu_id = 50;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('getwithinwaiting_model');
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
        $this->renderView('getwithinwaiting_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'year_id' => $this->input->post('year_id'),
            'state_info_id' => $this->input->post('state_info_id'),
            'book_group_id' => $this->input->post('book_group_id'),
            'searchtext' => $this->input->post('searchtext'),
        );
        $count = $this->getwithinwaiting_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('getwithinwaiting/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "', 'year_id' : '" . $this->input->post('year_id') . "', 'state_info_id' : '" . $this->input->post('state_info_id') . "', 'book_group_id' : '" . $this->input->post('book_group_id') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->getwithinwaiting_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/getwithinwaiting_pagination', $data);
    }

    public function edit($work_info_id_pri = null) {
        if ($work_info_id_pri != null) {
            $workinfo = $this->getwithinwaiting_model->getworkinfo($work_info_id_pri);
            if ($workinfo->num_rows() > 0) {
                $data = array(
                    'group_id' => $this->group_id,
                    'menu_id' => $this->menu_id,
                    'icon' => $this->accesscontrol->getIcon($this->group_id),
                    'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                    'css_full' => array('plugin/select2/dist/css/select2.min.css', 'plugin/datepicker/datepicker.css', 'plugin/fancybox/dist/jquery.fancybox.css'),
                    'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/select2/dist/js/select2.full.min.js', 'plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js'),
                    'work_info_id_pri' => $work_info_id_pri,
                    'data' => $workinfo->row(),
                );
                $this->renderView('getwithinedit_view', $data);
            } else {
                $this->session->set_flashdata('flash_message', 'error,??????????????????????????????????????????,????????????????????????????????????????????????????????????');
                redirect(base_url('getwithinwaiting'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,??????????????????????????????????????????,????????????????????????????????????????????????????????????');
            redirect(base_url('getwithinwaiting'));
        }
    }

    //???????????????
    public function editwithin() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        if ($work_info_id_pri != null || $work_info_id_pri != '') {
            $workinfo = $this->getwithinwaiting_model->getworkinfo($work_info_id_pri);
            if ($workinfo->num_rows() > 0) {
                $data = array(
                    // 'work_type_id' => $this->input->post('work_type_id'),
                    'work_info_no' => $this->input->post('work_info_no'),
                    // 'work_info_no_2' => $this->input->post('work_info_no_2'),
                    'work_info_date' => $this->input->post('work_info_date'),
                    // 'work_info_from_position' => $this->input->post('work_info_from_position'),
                    'work_info_from' => $this->input->post('work_info_from'),
                    // 'work_info_to_position' => $this->input->post('work_info_to_position'),
                    'work_info_to' => $this->input->post('work_info_to'),
                    'work_info_subject' => $this->input->post('work_info_subject'),
                    'work_info_detail' => $this->input->post('work_info_detail'),
                    'work_info_comment' => $this->input->post('work_info_comment'),
                    'work_info_follow' => ($this->input->post('work_info_follow') == 1) ? 1 : 0,
                    'secret_level_id' => $this->input->post('secret_level_id'),
                    'priority_info_id' => $this->input->post('priority_info_id'),
                    'action_info_id' => $this->input->post('action_info_id'),
                    'book_group_id' => $this->input->post('book_group_id'),
                    'attach_original' => $this->input->post('attach_original'),
                    'work_info_update' => $this->misc->getdate()
                );
                $this->getwithinwaiting_model->update_workinfo($work_info_id_pri, $data);
                $text = '???????????????????????????????????????????????????????????????';
                $this->systemlog->log_work_info($text, $work_info_id_pri);
                $getworkinfo = $this->accesscontrol->getworkinfo($work_info_id_pri);
                $workinfo = $getworkinfo->row();
                $datalog = array(
                    'work_info_id_pri' => $workinfo->work_info_id_pri,
                    'work_info_code' => $workinfo->work_info_code,
                    'work_info_id' => $workinfo->work_info_id,
                    'work_info_no' => $workinfo->work_info_no,
                    'work_info_no_2' => $workinfo->work_info_no_2,
                    'work_info_no_3' => $workinfo->work_info_no_3,
                    'year_id' => $workinfo->year_id,
                    'work_type_id' => $workinfo->work_type_id,
                    'user_id' => $workinfo->user_id,
                    'dep_id_pri' => $workinfo->dep_id_pri,
                    'dep_off_id' => $workinfo->dep_off_id,
                    'work_info_date' => $workinfo->work_info_date,
                    'work_info_from_position' => $workinfo->work_info_from_position,
                    'work_info_from' => $workinfo->work_info_from,
                    'work_info_to_position' => $workinfo->work_info_to_position,
                    'work_info_to' => $workinfo->work_info_to,
                    'work_info_subject' => $workinfo->work_info_subject,
                    'work_info_detail' => $workinfo->work_info_detail,
                    'work_info_comment' => $workinfo->work_info_comment,
                    'work_info_refer' => $workinfo->work_info_refer,
                    'work_info_other_attach' => $workinfo->work_info_other_attach,
                    'work_info_complete' => $workinfo->work_info_complete,
                    'work_info_expire' => $workinfo->work_info_expire,
                    'work_info_follow' => $workinfo->work_info_follow,
                    'work_info_store' => $workinfo->work_info_store,
                    'secret_level_id' => $workinfo->secret_level_id,
                    'priority_info_id' => $workinfo->priority_info_id,
                    'action_info_id' => $workinfo->action_info_id,
                    'state_info_id' => $workinfo->state_info_id,
                    'doc_type_id' => $workinfo->doc_type_id,
                    'book_group_id' => $workinfo->book_group_id,
                    'internal_action_id' => $workinfo->internal_action_id,
                    'internal_action_name' => $workinfo->internal_action_name,
                    'attach_original' => $workinfo->attach_original,
                    'work_info_signature' => $workinfo->work_info_signature,
                    'log_user_id' => $this->session->userdata('user_id'),
                    'log_text' => '???????????????',
                    'log_time' => $this->misc->getdate()
                );
                $this->systemlog->log_work_info_edit($datalog);
                $this->session->set_flashdata('flash_message', 'success,???????????????????????????????????????????????????,????????????????????????????????????????????????????????????????????????');
                redirect(base_url('getwithinwaiting/edit/' . $work_info_id_pri));
            } else {
                $this->session->set_flashdata('flash_message', 'error,??????????????????????????????????????????,????????????????????????????????????????????????????????????');
                redirect(base_url('getwithinwaiting'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,??????????????????????????????????????????,????????????????????????????????????????????????????????????');
            redirect(base_url('getwithinwaiting'));
        }
    }

    public function attach($work_info_id_pri) {
        if ($work_info_id_pri != null) {
            $workinfo = $this->getwithinwaiting_model->getworkinfo($work_info_id_pri);
            if ($workinfo->num_rows() > 0) {
                $data = array(
                    'group_id' => $this->group_id,
                    'menu_id' => $this->menu_id,
                    'icon' => $this->accesscontrol->getIcon($this->group_id),
                    'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                    'css_full' => array('plugin/select2/dist/css/select2.min.css', 'plugin/datepicker/datepicker.css', 'plugin/fancybox/dist/jquery.fancybox.css'),
                    'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/select2/dist/js/select2.full.min.js', 'plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js'),
                    'work_info_id_pri' => $work_info_id_pri,
                    'data' => $workinfo->row(),
                );
                $this->renderView('getwithinattach_view', $data);
            } else {
                $this->session->set_flashdata('flash_message', 'error,??????????????????????????????????????????,????????????????????????????????????????????????????????????');
                redirect(base_url('getwithinwaiting'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,??????????????????????????????????????????,????????????????????????????????????????????????????????????');
            redirect(base_url('getwithinwaiting'));
        }
    }

    public function from_modal() {
        $this->load->view('modal/getwithinwaiting_from_modal');
    }

    public function to_modal() {
        $this->load->view('modal/getwithinwaiting_to_modal');
    }

    public function ajax_page() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $workinfo = $this->getwithinwaiting_model->getworkinfo($work_info_id_pri);
        $data = array(
            'datas' => $this->getwithinwaiting_model->get_workinfofile($work_info_id_pri),
            'state_info_id' => $workinfo->row()->state_info_id,
        );
        $this->load->view('ajax/getwithinwaiting_page', $data);
    }

    //??????????????????????????????????????????????????????
    public function upload_attach($work_info_id_pri) {
        $input_name = 'upload_attach[]';
        $this->load->library('upload');
        $this->load->library('managefolder');
        $genName = $this->generateRandomString();
        $file_name = 'I' . $work_info_id_pri . '_' . date('YmdHis') . '_' . $genName;
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
                    $file_type_id = $this->getwithinwaiting_model->ref_file_type($name_type)->row()->file_type_id;
                    $data = array(
                        'work_info_id_pri' => $work_info_id_pri,
                        'user_id' => $this->session->userdata('user_id'),
                        'work_info_file_path' => $path,
                        'work_info_file_oldname' => $key['name'],
                        'work_info_file_name' => $this->upload->data('file_name'),
                        'file_type_id' => $file_type_id,
                        'work_info_file_active' => 1,
                        'work_info_file_create' => $this->misc->getdate(),
                        'work_info_file_update' => $this->misc->getdate()
                    );
                    $work_info_file_id = $this->getwithinwaiting_model->insert_workinfofile($data);
                    $datalog = array(
                        'log_type_id' => 1,
                        'work_info_file_id' => $work_info_file_id,
                        'user_id' => $this->session->userdata('user_id'),
                        'log_text' => '??????????????? File ' . $this->upload->data('file_name'),
                        'log_status_id' => 1,
                        'log_time' => $this->misc->getdate()
                    );
                    $this->systemlog->log_file($datalog);
                    $this->getwithinwaiting_model->update_workinfo($work_info_id_pri, array('state_info_id' => 3, 'work_info_update' => $this->misc->getdate()));
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

    //?????????????????????????????????????????????????????????
    public function notupload_attach($work_info_id_pri) {
        $workinfo = $this->getwithinwaiting_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() == 1) {
            $row = $workinfo->row();
            $files = $this->getwithinwaiting_model->get_workinfofile($work_info_id_pri);
            if ($files->num_rows() == 0) {
                if ($row->state_info_id == 2) {
                    $this->getwithinwaiting_model->update_workinfo($work_info_id_pri, array('state_info_id' => 3, 'work_info_update' => $this->misc->getdate()));
                }
                $this->session->set_flashdata('flash_message', 'success,??????????????????,??????????????????????????????????????????????????????');
                redirect(base_url('getwithinwaiting/attach/' . $work_info_id_pri));
            } else {
                $this->session->set_flashdata('flash_message', 'error,???????????????????????????,????????????????????????????????????????????????????????????????????????');
                redirect(base_url('getwithinwaiting/attach/' . $work_info_id_pri));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,???????????????????????????,??????????????????????????????????????????!');
            redirect(base_url());
        }
    }

    //??????????????????
    public function delete_file() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $workinfofile = $this->getwithinwaiting_model->get_workinfofileid($id)->row();
        //$patch_file = './' . $workinfofile->work_info_file_path;
        //@unlink($patch_file);
        //log_delete_workinfofile();
        $datalog = array(
            'log_type_id' => 1,
            'work_info_file_id' => $id,
            'user_id' => $this->session->userdata('user_id'),
            'log_text' => '?????? File ' . $name,
            'log_status_id' => 2,
            'log_time' => $this->misc->getdate()
        );
        $this->systemlog->log_file($datalog);
        $this->getwithinwaiting_model->delete_workinfofile($id);
        if ($this->getwithinwaiting_model->get_workinfofile($workinfofile->work_info_id_pri)->num_rows() == 0) {
            $this->getwithinwaiting_model->update_workinfo($workinfofile->work_info_id_pri, array('state_info_id' => 2, 'work_info_update' => $this->misc->getdate()));
        }
    }

    //??????????????? (??????????????????)
    //    public function sign($work_info_id_pri) {
    //        $workinfo = $this->getwithinwaiting_model->getworkinfo($work_info_id_pri);
    //        if ($workinfo->num_rows() > 0) {
    //            $data = array(
    //                'group_id' => $this->group_id,
    //                'menu_id' => $this->menu_id,
    //                'icon' => $this->accesscontrol->getIcon($this->group_id),
    //                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
    //                'css_full' => array('plugin/select2/dist/css/select2.min.css', 'plugin/datepicker/datepicker.css', 'plugin/fancybox/dist/jquery.fancybox.css'),
    //                'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/select2/dist/js/select2.full.min.js', 'plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js'),
    //                'work_info_id_pri' => $work_info_id_pri,
    //                'data' => $workinfo->row(),
    //            );
    //            $this->renderView('withinsign_view', $data);
    //        } else {
    //            $this->session->set_flashdata('flash_message', 'error,??????????????????????????????????????????,????????????????????????????????????????????????????????????');
    //            redirect(base_url('getwithinwaiting'));
    //        }
    //    }
    //
    //    public function ajax_page_sign() {
    //        $work_info_id_pri = $this->input->post('work_info_id_pri');
    //        $data = array(
    //            'data' => $this->getwithinwaiting_model->getworkinfo($work_info_id_pri)->row(),
    //        );
    //        $this->load->view('ajax/withinsign_page', $data);
    //    }
    //
    //    public function signature($work_info_id_pri) {
    //        $workinfo = $this->getwithinwaiting_model->getworkinfo($work_info_id_pri);
    //        if ($workinfo->num_rows() > 0) {
    //            $data = array(
    //                'state_info_id' => 2,
    //                'work_info_update' => $this->misc->getdate(),
    //            );
    //            $this->getwithinwaiting_model->update_workinfo($work_info_id_pri, $data);
    //            $this->session->set_flashdata('flash_message', 'success,???????????????????????????????????????????????????,????????????????????????????????????????????????????????????????????????');
    ////            redirect(base_url('getwithinwaiting/attach/' . $work_info_id_pri));
    //            redirect(base_url('getwithinwaiting'));
    //        } else {
    //            $this->session->set_flashdata('flash_message', 'error,??????????????????????????????????????????,????????????????????????????????????????????????????????????');
    //            redirect(base_url('getwithinwaiting'));
    //        }
    //    }

    public function send($work_info_id_pri) {
        $workinfo = $this->getwithinwaiting_model->getworkinfo($work_info_id_pri);
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
            );
            $this->renderView('sendgetwithin_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,??????????????????????????????????????????,????????????????????????????????????????????????????????????');
            redirect(base_url('getwithinwaiting'));
        }
    }

    public function sendsort($work_info_id_pri) {
        $workinfo = $this->getwithinwaiting_model->getworkinfo($work_info_id_pri);
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
            );
            $this->renderView('sendsortgetwithin_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,??????????????????????????????????????????,????????????????????????????????????????????????????????????');
            redirect(base_url('getwithinwaiting'));
        }
    }

    //?????????
    public function sendto() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $select_checkbox = $this->input->post('def_id_pri_select');
        $workinfo = $this->getwithinwaiting_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() == 1) {
            $row = $workinfo->row();
            if (count($select_checkbox) != 0) {
                $i = 1;
                foreach ($select_checkbox as $dep_off_id) {
                    $data = array(
                        'work_info_id_pri' => $row->work_info_id_pri,
                        'work_process_id' => $row->work_info_id,
                        'work_process_no' => $row->work_info_no,
                        'work_process_no_2' => $row->work_info_no_2,
                        'work_process_no_3' => $row->work_info_no_3,
                        'year_id' => $row->year_id,
                        'dep_id_pri' => $this->session->userdata('dep_id_pri'),
                        'dep_off_id' => $dep_off_id,
                        'user_id' => $this->session->userdata('user_id'),
                        'work_process_receive' => 0,
                        'work_process_date' => $row->work_info_date,
                        'work_process_sendtype' => 1,
                        'work_process_sort' => $i,
                        'work_process_sendstatus' => 0,
                        'work_process_create' => $this->misc->getdate(),
                        'work_process_update' => $this->misc->getdate(),
                    );
                    $work_process_id_pri = $this->getwithinwaiting_model->insert_workprocess($data);
                    $text = '??????????????? ?????????????????????????????????????????????????????????????????????';
                    $this->systemlog->log_work_process($text, $work_process_id_pri);
                    //print_r($data);
                    $users = $this->getwithinwaiting_model->getuser_dep_off($dep_off_id);
                    $message = "\n" . "??????????????????????????????????????? " . $row->work_info_no . $row->work_info_no_2 . $row->work_info_no_3 . " ?????????????????? " . $row->work_info_subject . " ?????????????????????????????? ";
                    if ($users->num_rows() > 0) {
                        foreach ($users->result() as $user) {
                            $this->send_line($user->user_line_token, $message);
                        }
                    }
                    $i++;
                }
                $text = '?????????????????????????????????????????????????????????';
                $this->systemlog->log_work_info($text, $work_info_id_pri);
                $this->getwithinwaiting_model->update_workinfo($row->work_info_id_pri, array('state_info_id' => 4, 'work_info_update' => $this->misc->getdate()));
                $this->session->set_flashdata('flash_message', 'success,??????????????????,??????????????????????????????????????????????????????');
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    public function modal_changestatus() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $workinfo = $this->getwithinwaiting_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() == 1) {
            if ($workinfo->row()->state_info_id < 4) {
                $data = array(
                    'row' => $workinfo->row(),
                );
                $this->load->view('modal/withinchangestatus_modal', $data);
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    public function changestatus() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $workinfo = $this->getwithinwaiting_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() == 1) {
            if ($workinfo->row()->state_info_id < 4) {
                $data = array(
                    'state_info_id' => 9,
                    'work_info_comment' => $this->input->post('work_info_comment'),
                    'work_info_update' => $this->misc->getdate(),
                );
                $this->getwithinwaiting_model->update_workinfo($work_info_id_pri, $data);
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    //??????????????????????????????
    public function sendtosort() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $select_checkbox = $this->input->post('def_id_pri_select');
        //print_r($select_checkbox);
        $workinfo = $this->getwithinwaiting_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() == 1) {
            $row = $workinfo->row();
            if (count($select_checkbox) != 0) {
                $i = 1;
                foreach ($select_checkbox as $dep_off_id) {
                    $data = array(
                        'work_info_id_pri' => $row->work_info_id_pri,
                        'work_process_id' => $row->work_info_id,
                        'work_process_no' => $row->work_info_no,
                        'work_process_no_2' => $row->work_info_no_2,
                        'work_process_no_3' => $row->work_info_no_3,
                        'year_id' => $row->year_id,
                        'dep_id_pri' => $this->session->userdata('dep_id_pri'),
                        'dep_off_id' => $dep_off_id,
                        'user_id' => $this->session->userdata('user_id'),
                        'work_process_receive' => 0,
                        'work_process_date' => $row->work_info_date,
                        'work_process_sendtype' => 2,
                        'work_process_sort' => $i,
                        'work_process_sendstatus' => ($i == 1) ? 0 : 2,
                        'work_process_create' => $this->misc->getdate(),
                        'work_process_update' => $this->misc->getdate(),
                    );
                    $work_process_id_pri = $this->getwithinwaiting_model->insert_workprocess($data);
                    $text = '??????????????? ?????????????????????????????????????????????????????????????????????';
                    $this->systemlog->log_work_process($text, $work_process_id_pri);
                    //print_r($data);
                    if ($i == 1) {
                        $users = $this->getwithinwaiting_model->getuser_dep_off($dep_off_id);
                        $message = "\n" . "??????????????????????????????????????? " . $row->work_info_no . $row->work_info_no_2 . $row->work_info_no_3 . " ?????????????????? " . $row->work_info_subject . " ?????????????????????????????? ";
                        if ($users->num_rows() > 0) {
                            foreach ($users->result() as $user) {
                                $this->send_line($user->user_line_token, $message);
                            }
                        }
                    }
                    $i++;
                }
                $text = '?????????????????????????????????????????????????????????';
                $this->systemlog->log_work_info($text, $work_info_id_pri);
                $this->getwithinwaiting_model->update_workinfo($row->work_info_id_pri, array('state_info_id' => 4, 'work_info_update' => $this->misc->getdate()));
                $this->session->set_flashdata('flash_message', 'success,??????????????????,??????????????????????????????????????????????????????');
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    //??????????????????
    public function follow() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $workinfo = $this->getwithinwaiting_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() == 1) {
            $this->getwithinwaiting_model->update_workinfo($this->input->post('work_info_id_pri'), array('work_info_follow' => $this->input->post('work_info_follow'), 'work_info_update' => $this->misc->getdate()));
            echo 1;
        } else {
            echo 0;
        }
    }

    //?????????????????????
    public function attach_original() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $workinfo = $this->getwithinwaiting_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() == 1) {
            $this->getwithinwaiting_model->update_workinfo($this->input->post('work_info_id_pri'), array('attach_original' => $this->input->post('attach_original'), 'work_info_update' => $this->misc->getdate()));
            echo 1;
        } else {
            echo 0;
        }
    }


    //??????????????????????????? (???????????????)
    // public function modal_regisnumber() {
    //     $work_info_id_pri = $this->input->post('work_info_id_pri');
    //     $workinfo = $this->getwithinwaiting_model->getworkinfo($work_info_id_pri);
    //     if ($workinfo->num_rows() == 1) {
    //         if ($workinfo->row()->state_info_id == 2) {
    //             $data = array(
    //                 'row' => $workinfo->row(),
    //             );
    //             $this->load->view('modal/getwithinregisnumber_modal', $data);
    //         } else if ($workinfo->row()->state_info_id == 1) {
    //             echo 1;
    //         } else {
    //             echo 0;
    //         }
    //     } else {
    //         echo 0;
    //     }
    // }

    // public function regisnumber() {
    //     $work_info_id_pri = $this->input->post('work_info_id_pri');
    //     $workinfo = $this->getwithinwaiting_model->getworkinfo($work_info_id_pri);
    //     if ($workinfo->num_rows() == 1) {
    //         if ($workinfo->row()->state_info_id == 2) {
    //             $dep_years = $this->getwithinwaiting_model->getDepartmentyear($this->session->userdata('dep_id_pri'));
    //             if ($dep_years->num_rows() > 0) {
    //                 $dep_year = $dep_years->row();
    //                 $data = array(
    //                     'work_info_id' => $dep_year->dep_year_send_last,
    //                     'state_info_id' => 3,
    //                     'work_info_update' => $this->misc->getdate(),
    //                 );
    //                 $this->getwithinwaiting_model->update_workinfo($work_info_id_pri, $data);
    //                 $this->getwithinwaiting_model->update_departmentyear(array('dep_year_send_last' => $dep_year->dep_year_send_last += 1, 'dep_year_update' => $this->misc->getdate()));
    //                 $text = '???????????????????????????????????????????????????????????????????????????';
    //                 $this->systemlog->log_work_info($text, $work_info_id_pri);
    //                 echo 1;
    //             } else {
    //                 echo 0;
    //             }
    //         } else {
    //             echo 0;
    //         }
    //     } else {
    //         echo 0;
    //     }
    // }

    // send line
    public function send_line($line_token, $message) {
        if ($line_token != null && $line_token != '') {
            $line = $this->line->line_notification($line_token, $message);
            if ($line == 1) {
                $this->systemlog->log_send_line($message, $this->session->userdata('user_id'), $line_token);
            }
        }
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

}
