<?php
class Backup extends CI_Controller
{

  public $group_id = 8;
  public $menu_id = 76;

  public function __construct()
  {
    parent::__construct();
    $this->auth->isLoginNull();
    $this->load->library('zip');
  }

  public function index()
  {
    $this->zipexpire();
    $data = array(
      'group_id' => $this->group_id,
      'menu_id' => $this->menu_id,
      'icon' => $this->accesscontrol->getIcon($this->group_id),
      'title' => $this->accesscontrol->getNameTitle($this->menu_id),
    );
    $this->renderView('backup_view', $data);
  }

  public function getfilezip()
  {
    header('Content-Type: application/json');
    $result = [];
    if ($this->input->post('search')) {
      $search = $this->input->post('search');
    } else {
      $search = "";
    }
    $dir = 'assets/backup/';
    $files = glob($dir . "*" . $search . "*");
    $now = time();
    foreach ($files as $file) {
      if (is_file($file)) {
        $result[] = array("filename" => str_replace($dir, "", $file), "path" => base_url() . $file, "datetime" => $this->misc->date2Thai(date('Y-m-d H:i:s', filemtime($file)), '%d %m %y %h:%i:%s'));
      }
    }
    echo json_encode($result);
  }

  public function delzip($filename)
  {
    if ($this->delete_filezip($filename) == true) {
      $this->session->set_flashdata('flash_message', 'success,สำเร็จ,ลบข้อมูล ' . $filename . ' เรียบร้อย');
      redirect(base_url('backup'));
    } else {
      $this->session->set_flashdata('flash_message', 'error,ไม่สำเร็จ,ไม่สามารถลบข้อมูลได้');
      redirect(base_url('backup'));
    }
  }

  private function recurse_copy($src, $dst)
  {
    $dir = opendir($src);
    @mkdir($dst);
    while (false !== ($file = readdir($dir))) {
      if (($file != '.') && ($file != '..')) {
        if (is_dir($src . '/' . $file)) {
          $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
        } else {
          copy($src . '/' . $file, $dst . '/' . $file);
        }
      }
    }
    closedir($dir);
    return true;
  }

  private function delete_directory($folderName)
  {
    $this->load->helper('file'); // Load codeigniter file helper

    $dir_path  = 'assets/' . $folderName;  // For check folder exists
    $del_path  = './assets/' . $folderName . '/'; // For Delete folder

    if (is_dir($dir_path)) {
      $this->delete_files($dir_path, true); // Delete files into the folder
      @rmdir($del_path); // Delete the folder

      return true;
    }
    return false;
  }

  private function delete_files($target)
  {
    if (is_dir($target)) {
      $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned
      foreach ($files as $file) {
        $this->delete_files($file);
      }
      @rmdir($target);
    } elseif (is_file($target)) {
      @unlink($target);
    }
    return true;
  }

  private function delete_filezip($filename)
  {
    $dir = 'assets/backup/';
    $files = glob($dir . $filename);
    foreach ($files as $file) {
      if (is_file($file)) {
        unlink($file);
        return true;
      } else {
        return false;
      }
    }
  }

  private function zipexpire()
  {
    $dir = 'assets/backup/';
    $files = glob($dir . "*");
    $now = time();
    foreach ($files as $file) {
      if (is_file($file)) {
        if ($now - filemtime($file) >= 3600 * 2160) { // 30 day (1 day = 24 hour and 1 hour = 3600 seconds)
          unlink($file);
        }
      }
    }
  }

  public function process()
  {
    header('Content-Type: application/json');
    $sourcePath = 'assets/upload';
    $targetPath = 'assets/uploads';
    if (file_exists($sourcePath)) {
      if (!$this->recurse_copy($sourcePath, $targetPath)) { //Copy file source to destination directory
        return ['status' => false, 'msg' => 'File missing'];
      }
    }

    if (file_exists($targetPath)) { // check target directory
      $this->zip->read_dir($targetPath, False); // read target directory
      $file_name = 'assets/backup/backup_' . date('Y_m_d_H_i_s') . '.zip';
      $name = 'backup_' . date('Y_m_d_H_i_s') . '.zip';
      if (!$this->zip->archive($file_name)) { // zip target directory
        $this->delete_directory('uploads');
        echo json_encode(['status' => false, 'msg' => 'ไม่สามารถสำรองข้อมูลได้ ' . $file_name]);
      } else {
        $this->delete_directory('uploads');
        // $this->zip->download($name);
        echo json_encode(['status' => true, 'msg' => 'สำรองข้อมูลเรียบร้อย', "name" => $name, "url" => base_url() . $file_name]);
      }
    }
  }

  public function backupsuccess()
  {
    $this->session->set_flashdata('flash_message', 'success,สำเร็จ,สำรองข้อมูลเรียบร้อย');
    redirect(base_url('backup'));
  }

  public function backupfail()
  {
    $this->session->set_flashdata('flash_message', 'error,ไม่สำเร็จ, ไม่สามารถสำรองข้อมูลได้');
    redirect(base_url('backup'));
  }

  public function download()
  {
    $file = $_GET['url'];
    // Quick check to verify that the file exists
    // if (!file_exists($file)) die("File not found");

    // Force the download
    header("Content-Disposition: attachment; filename=" . basename($file));
    header("Content-Length: " . filesize($file));
    header("Content-Type: application/octet-stream;");
    readfile($file);
  }
}
