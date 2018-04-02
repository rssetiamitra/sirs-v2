<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tr_penerbitan extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'website/Tr_penerbitan');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'login');exit;
        }
        /*load model*/
        $this->load->model('Tr_penerbitan_model', 'Tr_penerbitan');
        /*enable profiler*/
        $this->output->enable_profiler(false);

    }

    public function index() { 
        //echo '<pre>';print_r($this->session->all_userdata());
        /*define variable data*/
        $data = array(
            'title' => 'Penerbitan',
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        /*load view index*/
        $this->load->view('Tr_penerbitan/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit Penerbitan', 'Tr_penerbitan/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Tr_penerbitan->get_by_id($id);
            $data['attachment'] = $this->upload_file->getUploadedFile($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add Penerbitan', 'Tr_penerbitan/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = 'Penerbitan';
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Tr_penerbitan/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View Penerbitan', 'Tr_penerbitan/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Tr_penerbitan->get_by_id($id);
        $data['title'] = 'Penerbitan';
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['attachment'] = $this->upload_file->getUploadedFile($id);
        /*load form view*/
        $this->load->view('Tr_penerbitan/form', $data);
    }


    public function get_data()
    {
        /*get data from model*/
        $list = $this->Tr_penerbitan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" name="selected_id[]" value="'.$row_list->wp_id.'"/>
                            <span class="lbl"></span>
                        </label>
                      </div>';
            $row[] = '<div class="center">
                        '.$this->authuser->show_button('website/Tr_penerbitan','R',$row_list->wp_id,2).'
                        '.$this->authuser->show_button('website/Tr_penerbitan','U',$row_list->wp_id,2).'
                        '.$this->authuser->show_button('website/Tr_penerbitan','D',$row_list->wp_id,2).'
                      </div>'; 
            $row[] = '<div class="center">'.$row_list->wp_id.'</div>';
            $row[] = ucfirst($row_list->wp_title);
            $row[] = $row_list->wp_author;
            $row[] = $row_list->wp_date;
            $row[] = '<p style="text-align:ustify">'.substr(strip_tags($row_list->wp_content), 0, 300).'</p>';
            $row[] = ($row_list->is_active == 'Y') ? '<div class="center"><span class="label label-sm label-success">Active</span></div>' : '<div class="center"><span class="label label-sm label-danger">Not active</span></div>';
                   
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Tr_penerbitan->count_all(),
                        "recordsFiltered" => $this->Tr_penerbitan->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {
        
        /*print_r($_FILES);die;*/

        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('wp_title', 'Judul', 'trim|required');
        $val->set_rules('wp_date', 'Tanggal', 'trim|required');
        $val->set_rules('wp_subtitle', 'Subtitle', 'trim|xss_clean');
        $val->set_rules('wp_author', 'Author', 'trim|xss_clean');
        $val->set_rules('wp_source', 'Source', 'trim|xss_clean');
        $val->set_rules('wm_id', 'Modul', 'trim|integer');
        $val->set_rules('wp_category', 'Kategori', 'trim|integer');
        $val->set_rules('is_active', 'Is Active', 'trim|xss_clean');
        $val->set_rules('content', 'Content', 'trim');

        $val->set_message('required', "Silahkan isi field \"%s\"");

        if ($val->run() == FALSE)
        {
            $val->set_error_delimiters('<div style="color:white">', '</div>');
            echo json_encode(array('status' => 301, 'message' => validation_errors()));
        }
        else
        {                       
            $this->db->trans_begin();
            $id=$this->input->post('id')?$this->regex->_genRegex($this->input->post('id'),'RGXINT'):0;

            $dataexc = array(
                'wp_title' => $this->regex->_genRegex($val->set_value('wp_title'),'RGXQSL'),
                'wp_date' => $this->regex->_genRegex($val->set_value('wp_date'),'RGXQSL'),
                'wp_author' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL'),
                'wm_id' => $this->regex->_genRegex($val->set_value('wm_id'),'RGXQSL'),
                'wp_category' => $this->regex->_genRegex($val->set_value('wp_category'),'RGXQSL'),
                'is_publish' => 'N',
                'wp_content' => $this->regex->_genRegex($val->set_value('content'),'RGXQSL'),
                'is_active' => $this->regex->_genRegex($val->set_value('is_active'),'RGXAZ'),
            );

            if($_FILES['images']['name'] != ''){
                /*hapus dulu file yang lama*/
                if( $id != 0 ){
                    $tr_penerbitan = $this->Tr_penerbitan->get_by_id($id);
                    if (file_exists('uploaded/website/images/'.$tr_penerbitan->wp_images.'')) {
                        unlink('uploaded/website/images/'.$tr_penerbitan->wp_images.'');
                    }
                }

                $dataexc['wp_images'] = $this->upload_file->doUpload('images', 'uploaded/website/images/');
            }
            
            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
                $this->db->insert('web_posting', $dataexc);
                $last_id = $this->db->insert_id();
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
                $this->db->update('web_posting', $dataexc, array('wp_id' => $id));
                $last_id = $id;
            }

            /*excecute upload*/
            if($last_id){
                $params['id'] = $last_id;
                $this->upload_file->doUploadMultiple(array(
                    'id' => $last_id,
                    'name' => 'pf_file',
                    'table' => 'wp_posting',
                    'path' => 'uploaded/website/',
                ));
            }
            

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

    public function delete()
    {
        $id=$this->input->post('ID')?$this->input->post('ID',TRUE):null;
        $toArray = explode(',',$id);
        if($id!=null){
            if($this->Tr_penerbitan->delete_by_id($toArray)){
                $this->logs->save('tr_penerbitan', $id, 'delete record', '');
                echo json_encode(array('status' => 200, 'message' => 'Proses Hapus Data Berhasil Dilakukan'));

            }else{
                echo json_encode(array('status' => 301, 'message' => 'Maaf Proses Hapus Data Gagal Dilakukan'));
            }
        }else{
            echo json_encode(array('status' => 301, 'message' => 'Tidak ada item yang dipilih'));
        }
        
    }


}


/* End of file example.php */
/* Location: ./application/functiones/example/controllers/example.php */
