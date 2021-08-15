<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Publicnewslist
 *
 * @author nut
 */
class Publicnewslist extends CI_Controller {

    //put your code here
    public $group_id = 16;
    public $menu_id = 55;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('publicnewslist_model');
        $this->load->library('ajax_pagination');
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
        $this->renderView('publicnewslist_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'year_id' => $this->input->post('year_id'),
            'state_info_id' => $this->input->post('state_info_id'),
            'book_group_id' => $this->input->post('book_group_id'),
            'searchtext' => $this->input->post('searchtext'),
        );
        $count = $this->publicnewslist_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('publicnewslist/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "', 'year_id' : '" . $this->input->post('year_id') . "', 'state_info_id' : '" . $this->input->post('state_info_id') . "', 'book_group_id' : '" . $this->input->post('book_group_id') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->publicnewslist_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/publicnewslist_pagination', $data);
    }

    public function detail($work_info_code) {
        $workinfo = $this->publicnewslist_model->getworkinfocode($work_info_code);
        if ($workinfo->num_rows() > 0) {
            $row = $workinfo->row();
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
                'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js'),
                'work_info_id_pri' => $row->work_info_id_pri,
                'data' => $row,
            );
            $this->renderView('publicnewslistdetail_view', $data);
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('publicnewslist'));
        }
    }

    public function attach($work_info_id_pri) {
        if ($work_info_id_pri != null) {
            $workinfo = $this->publicnewslist_model->getworkinfo($work_info_id_pri);
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
                $this->renderView('publicnewsattach_view', $data);
            } else {
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
                redirect(base_url('publicnewslist'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('publicnewslist'));
        }
    }

    public function ajax_page() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $data = array(
            'datas' => $this->publicnewslist_model->get_workinfofile($work_info_id_pri),
        );
        $this->load->view('ajax/publicnewslist_page', $data);
    }

    public function upload_attach($work_info_id_pri) {
        $input_name = 'upload_attach[]';
        $this->load->library('upload');
        $this->load->library('managefolder');
        $genName = $this->generateRandomString();
        $file_name = 'P' . $work_info_id_pri . '_' . date('YmdHis') . '_' . $genName;
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
                    $file_type_id = $this->publicnewslist_model->ref_file_type($name_type)->row()->file_type_id;
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
                    $work_info_file_id = $this->publicnewslist_model->insert_workinfofile($data);
                    $datalog = array(
                        'log_type_id' => 1,
                        'work_info_file_id' => $work_info_file_id,
                        'user_id' => $this->session->userdata('user_id'),
                        'log_text' => 'สร้าง File ' . $this->upload->data('file_name'),
                        'log_status_id' => 1,
                        'log_time' => $this->misc->getdate()
                    );
                    $this->systemlog->log_file($datalog);
                    $this->publicnewslist_model->update_workinfo($work_info_id_pri, array('state_info_id' => 2, 'work_info_update' => $this->misc->getdate()));
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
        $workinfofile = $this->publicnewslist_model->get_workinfofileid($id)->row();
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
        $this->publicnewslist_model->delete_workinfofile($id);
        if ($this->publicnewslist_model->get_workinfofile($workinfofile->work_info_id_pri)->num_rows() == 0) {
            $this->publicnewslist_model->update_workinfo($workinfofile->work_info_id_pri, array('state_info_id' => 1, 'work_info_update' => $this->misc->getdate()));
        }
    }

    public function modal_regisnumber() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $workinfo = $this->publicnewslist_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() == 1) {
            if ($workinfo->row()->state_info_id == 2) {
                $data = array(
                    'row' => $workinfo->row(),
                );
                $this->load->view('modal/publicnewsregisnumber_modal', $data);
            } else if ($workinfo->row()->state_info_id == 1) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    public function regisnumber() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $workinfo = $this->publicnewslist_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() == 1) {
            if ($workinfo->row()->state_info_id == 2) {
                $dep_years = $this->publicnewslist_model->getDepartmentyear($this->session->userdata('dep_id_pri'));
                if ($dep_years->num_rows() > 0) {
                    $dep_year = $dep_years->row();
                    $data = array(
                        'state_info_id' => 6,
                        'work_info_update' => $this->misc->getdate(),
                    );
                    $this->publicnewslist_model->update_workinfo($work_info_id_pri, $data);
                    $text = 'ประกาศหนังสือประชาสัมพันธ์';
                    $this->systemlog->log_work_info($text, $work_info_id_pri);
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
    }

    public function modal_changestatus() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $workinfo = $this->publicnewslist_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() == 1) {
            if ($workinfo->row()->state_info_id <= 6) {
                $data = array(
                    'row' => $workinfo->row(),
                );
                $this->load->view('modal/publicnewschangestatus_modal', $data);
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    public function changestatus() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        $workinfo = $this->publicnewslist_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() == 1) {
            if ($workinfo->row()->state_info_id <= 5) {
                $data = array(
                    'state_info_id' => 9,
                    'work_info_comment' => $this->input->post('work_info_comment'),
                    'work_info_update' => $this->misc->getdate(),
                );
                $this->publicnewslist_model->update_workinfo($work_info_id_pri, $data);
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    public function notupload_attach($work_info_id_pri) {
        $workinfo = $this->publicnewslist_model->getworkinfo($work_info_id_pri);
        if ($workinfo->num_rows() == 1) {
            $row = $workinfo->row();
            $files = $this->publicnewslist_model->get_workinfofile($work_info_id_pri);
            if ($files->num_rows() == 0) {
                if ($row->state_info_id == 1) {
                    $this->publicnewslist_model->update_workinfo($work_info_id_pri, array('state_info_id' => 2, 'work_info_update' => $this->misc->getdate()));
                }
                $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ทำรายการสำเร็จแล้ว');
                redirect(base_url('publicnewslist'));
            } else {
                $this->session->set_flashdata('flash_message', 'error,ไม่สำเร็จ,ท่านได้แนบไฟล์เอกสารแล้ว');
                redirect(base_url('publicnewslist/attach/' . $work_info_id_pri));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,ไม่สำเร็จ,เกิดข้อผิดพลาด!');
            redirect(base_url());
        }
    }

    public function edit($work_info_id_pri = null) {
        if ($work_info_id_pri != null) {
            $workinfo = $this->publicnewslist_model->getworkinfo($work_info_id_pri);
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
                $this->renderView('publicnewsedit_view', $data);
            } else {
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
                redirect(base_url('publicnewslist'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('publicnewslist'));
        }
    }

    public function editpublicnews() {
        $work_info_id_pri = $this->input->post('work_info_id_pri');
        if ($work_info_id_pri != null || $work_info_id_pri != '') {
            $workinfo = $this->publicnewslist_model->getworkinfo($work_info_id_pri);
            if ($workinfo->num_rows() > 0) {
                $data = array(
                    'work_info_no' => $this->input->post('work_info_no'),
                    'work_info_no_2' => $this->input->post('work_info_no_2'),
                    'work_info_date' => $this->input->post('work_info_date'),
                    'work_info_from_position' => $this->input->post('work_info_from_position'),
                    'work_info_from' => $this->input->post('work_info_from'),
                    'work_info_to_position' => $this->input->post('work_info_to_position'),
                    'work_info_to' => $this->input->post('work_info_to'),
                    'work_info_subject' => $this->input->post('work_info_subject'),
                    'work_info_detail' => $this->input->post('work_info_detail'),
                    'work_info_comment' => $this->input->post('work_info_comment'),
                    'work_info_follow' => ($this->input->post('work_info_follow') == 1) ? 1 : 0,
                    'secret_level_id' => 6,
                    'priority_info_id' => $this->input->post('priority_info_id'),
                    'action_info_id' => $this->input->post('action_info_id'),
                    'book_group_id' => $this->input->post('book_group_id'),
                    'attach_original' => $this->input->post('attach_original'),
                    'work_info_update' => $this->misc->getdate()
                );
                $this->publicnewslist_model->update_workinfo($work_info_id_pri, $data);
                $text = 'แก้ไขหนังสือประชาสัมพันธ์';
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
                    'log_text' => 'แก้ไข',
                    'log_time' => $this->misc->getdate()
                );
                $this->systemlog->log_work_info_edit($datalog);
                $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขข้อมูลเรียบร้อยแล้ว');
                redirect(base_url('publicnewslist/edit/' . $work_info_id_pri));
            } else {
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
                redirect(base_url('publicnewslist'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดผลาด,ไม่สามารถทำรายการได้');
            redirect(base_url('publicnewslist'));
        }
    }

}
