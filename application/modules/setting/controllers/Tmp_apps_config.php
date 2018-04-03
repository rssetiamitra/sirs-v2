<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tmp_apps_config extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'setting/Tmp_apps_config');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'login');exit;
        }
        /*load model*/
        $this->load->model('Tmp_apps_config_model', 'Tmp_apps_config');
        /*enable profiler*/
        $this->output->enable_profiler(false);

    }

    public function index() { 
        //echo '<pre>';print_r($this->session->all_userdata());
        /*define variable data*/
        $data = array(
            'title' => 'Apps Config',
            'flag' => 'Create',
            'breadcrumbs' => $this->breadcrumbs->show(),
            'value' => $this->Tmp_apps_config->get_by_id(1)
        );
        /*load view index*/
        $this->load->view('Tmp_apps_config/form', $data);
    }

    
    public function process()
    {
       
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('id', 'ID', 'trim|required');
        $val->set_rules('app_name', 'Nama Aplikasi', 'trim|required');
        $val->set_rules('header_title', 'Judul Header Aplikasi', 'trim|required');
        $val->set_rules('footer', 'Teks Footer', 'trim|xss_clean');
        $val->set_rules('running_text', 'Teks Berjalan', 'trim|xss_clean');
        $val->set_rules('author', 'Author', 'trim|xss_clean');
        $val->set_rules('developer_name', 'Nama Developer', 'trim|xss_clean');
        $val->set_rules('db_name', 'DB Name', 'trim|xss_clean');
        $val->set_rules('company_name', 'Nama Perusahaan', 'trim|xss_clean');
        $val->set_rules('icon', 'Icon', 'trim|xss_clean');
        $val->set_rules('app_logo', 'Logo Aplikasi', 'trim|xss_clean');
        $val->set_rules('app_description', 'Description', 'trim|xss_clean');
        $val->set_rules('style_header_color', 'Warna Header', 'trim|xss_clean');

        $val->set_message('required', "Silahkan isi field \"%s\"");

        if ($val->run() == FALSE)
        {
            $val->set_error_delimiters('<div style="color:white">', '</div>');
            echo json_encode(array('status' => 301, 'message' => validation_errors()));
        }
        else
        {                       
            $this->db->trans_begin();
            $id = ($this->input->post('id'))?$this->regex->_genRegex($this->input->post('id'),'RGXINT'):0;

            $dataexc = array(
                'app_name' => $this->regex->_genRegex($val->set_value('app_name'),'RGXQSL'),
                'header_title' => $this->regex->_genRegex($val->set_value('header_title'),'RGXQSL'),
                'footer' => $this->regex->_genRegex($val->set_value('footer'),'RGXQSL'),
                'running_text' => $this->regex->_genRegex($val->set_value('running_text'),'RGXQSL'),
                'author' => $this->regex->_genRegex($val->set_value('author'),'RGXQSL'),
                'developer_name' => $this->regex->_genRegex($val->set_value('developer_name'),'RGXQSL'),
                'db_name' => $this->regex->_genRegex($val->set_value('db_name'),'RGXQSL'),
                'company_name' => $this->regex->_genRegex($val->set_value('company_name'),'RGXQSL'),
                'icon' => $this->regex->_genRegex($val->set_value('icon'),'RGXQSL'),
                'app_logo' => $this->regex->_genRegex($val->set_value('app_logo'),'RGXQSL'),
                'app_description' => $this->regex->_genRegex($val->set_value('app_description'),'RGXQSL'),
                'style_header_color' => $this->regex->_genRegex($val->set_value('style_header_color'),'RGXQSL'),
                'is_active' => 'Y',
            );
            //print_r($dataexc);die;
            $dataexc['updated_date'] = date('Y-m-d H:i:s');
            $dataexc['updated_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
            $this->db->update('tmp_profile_app', $dataexc, array('id' => $id));
                $newId = $id;
            $this->logs->save('tmp_profile_app', $newId, 'update record', json_encode($dataexc));

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                echo json_encode(array('status' => 301, 'message' => 'Maaf Proses Gagal Dilakukan'));
            }
            else
            {
                $this->db->trans_commit();
                echo json_encode(array('status' => 200, 'message' => 'Proses Berhasil Dilakukan'));
            }
        }
    }

}


/* End of file example.php */
/* Location: ./application/modules/example/controllers/example.php */
