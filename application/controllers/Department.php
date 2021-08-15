<?php

class Department extends CI_Controller {

   public $group_id = 8;
   public $menu_id = 21;

   public function __construct() {
      parent::__construct();
      $this->auth->isLogin($this->menu_id);
      $this->load->model('department_model');
   }

   public function index() {
      $data = array(
         'group_id' => $this->group_id,
         'menu_id' => $this->menu_id,
         'icon' => $this->accesscontrol->getIcon($this->group_id),
         'title' => $this->accesscontrol->getNameTitle($this->menu_id),
         'css_full' => array('plugin/select2/dist/css/select2.min.css'),
         'js_full' => array('plugin/select2/dist/js/select2.full.min.js'),
      );
      $this->renderView('department_view', $data);
   }

   public function data() {
      $group1 = $this->input->post('group1');
      $group2 = $this->input->post('group2');
      $data = array(
         'orgs' => $this->department_model->getOrganization($group1),
         'group2' => $group2,
      );
      $this->load->view('ajax/department_page', $data);
   }

   public function add_department_modal() {
      $data = array(
         'org_id_pri' => $this->input->post('org_id_pri'),
      );
      $this->load->view('modal/department_add_modal', $data);
   }

   public function adddepartment() {
      $data = array(
         'dep_id' => $this->input->post('dep_id'),
         'dep_name' => $this->input->post('dep_name'),
         'dep_name_short' => $this->input->post('dep_name_short'),
         'dep_description' => $this->input->post('dep_description'),
         'dep_tel' => $this->input->post('dep_tel'),
         'dep_prefix_within' => $this->input->post('dep_prefix_within'),
         'dep_prefix_without' => $this->input->post('dep_prefix_without'),
         'dep_without_active_id' => ($this->input->post('dep_without_active_id') == 1) ? 1 : 0,
         'org_id_pri' => $this->input->post('org_id_pri'),
         'place_id' => $this->input->post('place_id'),
         'dep_status_id' => 1,
         'dep_create' => $this->misc->getdate(),
         'dep_update' => $this->misc->getdate(),
      );
      $this->department_model->insertDepartment($data);
      echo true;
   }

   public function add_dep_off_modal() {
      $data = array(
         'dep_id_pri' => $this->input->post('dep_id_pri'),
      );
      $this->load->view('modal/dep_off_add_modal', $data);
   }

   public function adddepoff() {
      $data = array(
         'dep_id_pri' => $this->input->post('dep_id_pri'),
         'officer_id' => $this->input->post('officer_id'),
      );
      $this->department_model->insertDepOff($data);
      echo true;
   }

   public function edit_department_modal() {
      $data = array(
         'org_id_pri' => $this->input->post('org_id_pri'),
         'dep_id_pri' => $this->input->post('dep_id_pri'),
      );
      $this->load->view('modal/department_edit_modal', $data);
   }

   public function editdepartment() {
      $data = array(
         'dep_id' => $this->input->post('dep_id'),
         'dep_name' => $this->input->post('dep_name'),
         'dep_name_short' => $this->input->post('dep_name_short'),
         'dep_description' => $this->input->post('dep_description'),
         'dep_tel' => $this->input->post('dep_tel'),
         'dep_prefix_within' => $this->input->post('dep_prefix_within'),
         'dep_prefix_without' => $this->input->post('dep_prefix_without'),
         'dep_without_active_id' => ($this->input->post('dep_without_active_id') == 1) ? 1 : 0,
         'org_id_pri' => $this->input->post('org_id_pri'),
         'place_id' => $this->input->post('place_id'),
         'dep_status_id' => 1,
         'dep_update' => $this->misc->getdate(),
      );
      $this->department_model->updateDepartment($data, $this->input->post('dep_id_pri'));
      echo true;
   }

   public function status_department_modal() {
      $data = array(
         'data' => $this->department_model->getDepartment($this->input->post('dep_id_pri'))->row()
      );
      $this->load->view('modal/department_status_modal', $data);
   }

   public function status_department() {
      $data = array(
         'dep_status_id' => $this->input->post('dep_status_id'),
      );
      $this->department_model->updateDepartment($data, $this->input->post('dep_id_pri'));
      $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขข้อมูลเรียบร้อยแล้ว');
      redirect(base_url('department'));
   }

   public function status_dep_off_modal() {
      $data = array(
         'data' => $this->department_model->getDepOff($this->input->post('dep_off_id'))->row()
      );
      $this->load->view('modal/dep_off_status_modal', $data);
   }

   public function status_dep_off() {
      $data = array(
         'dep_off_status_id' => $this->input->post('dep_off_status_id'),
      );
      $this->department_model->updateDepOff($data, $this->input->post('dep_off_id'));
      $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขข้อมูลเรียบร้อยแล้ว');
      redirect(base_url('department'));
   }

   public function delete_dep_off_modal() {
      $data = array(
         'dep_off_id' => $this->input->post('dep_off_id'),
      );
      $this->load->view('modal/dep_off_delete_modal', $data);
   }

   public function delete_dep_off() {
      if ($this->department_model->getuser_dep_off($this->input->post('dep_off_id'))->num_rows() > 0) {
         $this->session->set_flashdata('flash_message', 'error,ผิดพลาด,ไม่สามารถลบข้อมูลได้');
      } else {
         $this->department_model->deleteDepOff($this->input->post('dep_off_id'));
         $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขข้อมูลเรียบร้อยแล้ว');
      }
      redirect(base_url('department'));
   }

   public function view_dep_off_modal() {
      $data = array(
         'data' => $this->department_model->getuser_dep_off($this->input->post('dep_off_id')),
         'dep_off_id' => $this->input->post('dep_off_id')
      );
      $this->load->view('modal/dep_off_view_modal', $data);
   }

   public function selected_org() {
      $deps = $this->department_model->getOrgDepartment($this->input->post('org_id_pri'))->result();
      $dep_id_pri = array();
      $dep_name = array();
      $i = 0;
      foreach ($deps as $dep) {
         $dep_id_pri[$i] = $dep->dep_id_pri;
         $dep_name[$i] = $dep->dep_name;
         $i++;
      }
      $return["dep_id_pri"] = $dep_id_pri;
      $return["dep_name"] = $dep_name;
      print json_encode($return);
   }

   // year number
   public function year_number_modal() {
      $data = array(
         'dep_id_pri' => $this->input->post('dep_id_pri')
         // 'data' => $this->department_model->getDepartmentYear($this->input->post('dep_id_pri'))
      );
      $this->load->view('modal/department_year_number_modal', $data);
   }

   public function get_year_number() {
      $get_year_number = $this->department_model->getDepartmentYearById($this->input->post('dep_year_id'));
      $response = array(
         'status' => '0',
         'data' => array()
      );
      if ($get_year_number->num_rows() == 1) {
         $response['status'] = 1;
         $response['data'] = $get_year_number->row();
         echo json_encode($response);
      } else {
         echo json_encode($response);
      }
   }

   public function update_year_number() {
      $data = array(
         'dep_year_number_last' => $this->input->post('dep_year_number_last'),
         'dep_year_send_last' => $this->input->post('dep_year_send_last'),
         'dep_year_receive_last' => $this->input->post('dep_year_receive_last'),
         'dep_year_send_out_last' => $this->input->post('dep_year_send_out_last'),
         'dep_year_send_command_last' => $this->input->post('dep_year_send_command_last'),
         'dep_year_send_publish_last' => $this->input->post('dep_year_send_publish_last'),
         'dep_year_update' => $this->misc->getdate(),
      );
      $this->department_model->updateDepartmentYear($this->input->post('dep_year_id'), $data);
      echo '1';
   }

   public function status1() {
      $this->department_model->update_user_dep_off($this->input->post('user_dep_off_id'), array('user_dep_off_status_id' => 1));
      echo '1';
   }

   public function status2() {
      $this->department_model->update_user_dep_off($this->input->post('user_dep_off_id'), array('user_dep_off_status_id' => 2));
      echo '1';
   }
}
