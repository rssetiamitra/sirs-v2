<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Structure_org extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'master_data/structure_org');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'login');exit;
        }
        /*load model*/
        $this->load->model('structure_org_model', 'structure_org');
        /*load library*/
        $this->load->library('lib_menus');
        /*enable profiler*/
        $this->output->enable_profiler(false);

    }

    public function index() {
        /*define variable data*/
        $data = array(
            'menu' => $this->lib_menus->get_module_by_class(strtolower(get_class($this))), 
            'title' => 'Struktur Organisasi',
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        /*load view index*/
        $this->load->view('structure_org/index', $data);
    }

}


/* End of file Jabatan.php */
/* Location: ./application/modules/structure_org/controllers/structure_org.php */
