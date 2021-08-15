<?php

class Store extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('store_model');
    }

    public function user($file_name = null) {
        if ($file_name == NULL) {
            redirect(base_url());
        }

        $file = 'assets/upload/user/' . $file_name;

        header('Content-Type:image/jpeg');
        header('Content-Length: ' . filesize($file));
        //readfile($file);
        ob_clean();
        ob_end_flush();
        $handle = fopen($file, "rb");
        while (!feof($handle)) {
            echo fread($handle, 1000);
        }
        exit;
    }

    public function file($file_id) {
        $check = $this->checkfile($file_id);
        if ($check == 1) {
            $file = $this->store_model->get_work_info_file($file_id);
            $data = array(
                'log_type_id' => 1,
                'work_info_file_id' => $file->work_info_file_id,
                'user_id' => $this->session->userdata('user_id'),
                'log_text' => 'เปิด File ' . $file->work_info_file_name,
                'log_status_id' => 3,
                'log_time' => $this->misc->getdate()
            );
            $this->systemlog->log_file($data);
            $ctype = $this->filelastname($file->work_info_file_name);
            header('Content-Type: ' . $ctype);
            header('Content-Length: ' . filesize($file->work_info_file_path));
            header('Content-Disposition: inline; filename="' . $file->work_info_file_oldname . '"');
            //readfile($file->work_info_file_path);
            ob_clean();
            ob_end_flush();
            $handle = fopen($file->work_info_file_path, "rb");
            while (!feof($handle)) {
                echo fread($handle, 1000);
            }
            exit;
        } else {
            $this->load->view('filenotfound_view');
        }
    }

    public function workprocessfile($file_id = null) {
        if ($this->session->userdata('islogin') == 1) {
            $file = $this->store_model->get_work_process_file($file_id);
            $data = array(
                'log_type_id' => 2,
                'work_process_file_id' => $file->work_process_file_id,
                'user_id' => $this->session->userdata('user_id'),
                'log_text' => 'เปิด File ' . $file->work_process_file_name,
                'log_status_id' => 3,
                'log_time' => $this->misc->getdate()
            );
            $this->systemlog->log_file($data);
            $ctype = $this->filelastname($file->work_process_file_name);
            header('Content-Type: ' . $ctype);
            header('Content-Length: ' . filesize($file->work_process_file_path));
            header('Content-Disposition: inline; filename="' . $file->work_process_file_oldname . '"');
            //readfile($file->work_process_file_path);
            ob_clean();
            ob_end_flush();
            $handle = fopen($file->work_process_file_path, "rb");
            while (!feof($handle)) {
                echo fread($handle, 1000);
            }
            exit;
        } else {
            $this->load->view('filenotfound_view');
        }
    }

    public function workuserfile($file_id = null) {
        if ($this->session->userdata('islogin') == 1) {
            $file = $this->store_model->get_work_user_file($file_id);
            $data = array(
                'log_type_id' => 3,
                'work_user_file_id' => $file->work_user_file_id,
                'user_id' => $this->session->userdata('user_id'),
                'log_text' => 'เปิด File ' . $file->work_user_file_name,
                'log_status_id' => 3,
                'log_time' => $this->misc->getdate()
            );
            $this->systemlog->log_file($data);
            $ctype = $this->filelastname($file->work_user_file_name);
            header('Content-Type: ' . $ctype);
            header('Content-Length: ' . filesize($file->work_user_file_path));
            header('Content-Disposition: inline; filename="' . $file->work_user_file_oldname . '"');
            //readfile($file->work_user_file_path);
            ob_clean();
            ob_end_flush();
            $handle = fopen($file->work_user_file_path, "rb");
            while (!feof($handle)) {
                echo fread($handle, 1000);
            }
            exit;
        } else {
            $this->load->view('filenotfound_view');
        }
    }

    public function checkfile($file_id) {
        $check = 0;
        $file = $this->store_model->get_work_info_file($file_id);
        if ($this->session->userdata('islogin') == 1) {
            $work_info = $this->store_model->check_work_info($file->work_info_id_pri);
            if ($work_info > 0) {
                $check = 1;
            } else {
                $work_process = $this->store_model->check_work_process($file->work_info_id_pri);
                if ($work_process > 0) {
                    $work_process_sendtype1 = $this->store_model->check_work_process_sendtype1($file->work_info_id_pri);
                    if ($work_process_sendtype1 > 0) {
                        $check = 1;
                    } else {
                        $work_process_sendtype2 = $this->store_model->check_work_process_sendtype2($file->work_info_id_pri);
                        if ($work_process_sendtype2 > 0) {
                            $check = 1;
                        }
                    }
                } else {
                    $work_user = $this->store_model->check_work_user($file->work_info_id_pri);
                    if ($work_user > 0) {
                        $check = 1;
                    }
                }
            }
        }
        return $check;
    }

    public function signature($id = null) {
        $file = $this->store_model->get_work_info_signature($id);
        $ctype = $this->filelastname($file->work_info_signature);
        header('Content-Type: ' . $ctype);
        header('Content-Length: ' . filesize($file->work_info_signature));
        //readfile($file->work_info_signature);
        ob_clean();
        ob_end_flush();
        $handle = fopen($file->work_info_signature, "rb");
        while (!feof($handle)) {
            echo fread($handle, 1000);
        }
        exit;
    }

    public function filelastname($filename) {
        $tmp = explode(".", $filename);
        switch ($tmp[count($tmp) - 1]) {
            case "pdf": $ctype = "application/pdf";
                break;
            case "doc": $ctype = "application/msword";
                break;
            case "docx": $ctype = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
                break;
            case "xls": $ctype = "application/vnd.ms-excel";
                break;
            case "xlsx": $ctype = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
                break;
            case "ppt": $ctype = "application/vnd.ms-powerpoint";
                break;
            case "pptx": $ctype = "application/vnd.openxmlformats-officedocument.presentationml.presentation";
                break;
            case "txt": $ctype = "text/plain";
                break;
            case "zip": $ctype = "application/zip";
                break;
            case "rar": $ctype = "application/x-rar-compressed";
                break;
            case "jpg": $ctype = "image/jpg";
                break;
            case "jpeg": $ctype = "image/jpeg";
                break;
            case "png": $ctype = "image/png";
                break;
            case "gif": $ctype = "image/gif";
                break;
            case "csv": $ctype = "text/csv";
                break;
            case "psd": $ctype = "image/psd";
                break;
            case "bmp": $ctype = "image/bmp";
                break;
            case "ico": $ctype = "image/x-icon";
                break;
            default: $ctype = "application/force-download";
        }
        return $ctype;
    }

    public function icon($icon = null) {
        $file = 'assets/images/icon/' . $icon;
        $ctype = $this->filelastname($file);
        header('Content-Type: ' . $ctype);
        header('Content-Length: ' . filesize($file));
        ob_clean();
        ob_end_flush();
        $handle = fopen($file, "rb");
        while (!feof($handle)) {
            echo fread($handle, 1000);
        }
        exit;
    }

}
