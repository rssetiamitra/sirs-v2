<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends MX_Controller {

    function __construct() {
        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Home', 'main');
    }

    public function index() {
        
        $this->output->enable_profiler(false);
        /*breadcrumb*/
        $this->breadcrumbs->push('Welcome', 'main/'.strtolower(get_class($this)));
        $data = array(
            'title' => 'Home',
            'subtitle' => 'Welcome '.$this->session->userdata('user')->username,
            'breadcrumbs' => $this->breadcrumbs->show(),
        );
        //echo '<pre>';
        //print_r($this->session->all_userdata());die;
        $this->load->view('index', $data);
    }

}

/* End of file empty_module.php */
/* Location: ./application/modules/empty_module/controllers/empty_module.php */

