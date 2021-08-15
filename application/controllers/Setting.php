<?php

class Setting extends CI_Controller {

   public $group_id = 7;
   public $menu_id = 18;

   public function __construct() {
      parent::__construct();
      $this->auth->isLogin($this->menu_id);
      $this->load->model('setting_model');
   }

   public function index() {
      $data = array(
         'group_id' => $this->group_id,
         'menu_id' => $this->menu_id,
         'icon' => $this->accesscontrol->getIcon($this->group_id),
         'title' => $this->accesscontrol->getNameTitle($this->menu_id),
         'css' => array('parsley.min.css'),
         'js' => array('parsley.min.js')
      );
      $this->renderView('setting_view', $data);
   }

   public function edit() {
      $data = array(
         'dep_name' => $this->input->post('dep_name'),
         'dep_name_short' => $this->input->post('dep_name_short'),
         'dep_description' => $this->input->post('dep_description'),
         'dep_tel' => $this->input->post('dep_tel'),
         'dep_prefix_within' => $this->input->post('dep_prefix_within'),
         'dep_prefix_without' => $this->input->post('dep_prefix_without'),
         'place_id' => $this->input->post('place_id'),
         'dep_update' => $this->misc->getdate(),
      );
      $this->setting_model->updateDepartment($data, $this->input->post('dep_id_pri'));
      redirect(base_url() . 'setting');
   }
}
