<?php

/*
 * Class Name : Main
 * Author : Sakchai Kantada
 * Email : sakchaiwebmaster@gmail.com
 */

class Main extends CI_Controller {

    public $menu_id = 44;
    public $group_id = 12;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginNull();
        $this->load->model('main_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'css' => array(),
            'css_full' => array(),
            'js' => array(),
            'js_full' => array()
        );
        $this->renderView('main_view', $data);
    }

    public function version() {
        echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '';
    }

}
