<?php

class Worktype extends CI_Controller {

    public $group_id = 11;
    public $menu_id = 26;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('worktype_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'data' => $this->worktype_model->getWorkType()
        );
        $this->renderView('worktype_view', $data);
    }

}
