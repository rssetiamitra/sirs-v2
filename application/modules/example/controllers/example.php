<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Example extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'example');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'login');exit;
        }
        /*load model*/
        $this->load->model('example_model', 'example');
        /*enable profiler*/
        $this->output->enable_profiler(false);

    }

    public function index() {
        /*define variable data*/
        $data = array(
            'title' => 'Example',
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        /*load view index*/
        $this->load->view('index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit example', 'example/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->example->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add example', 'example/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = "Example";
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View example', 'example/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->example->get_by_id($id);
        $data['title'] = "Example";
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('form', $data);
    }


    public function get_data()
    {
        /*get data from model*/
        $list = $this->example->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div class="center"><label class="pos-rel">
                        <input type="checkbox" class="ace" name="selected_id[]" value="'.$row_list->example_id.'"/>
                        <span class="lbl"></span>
                    </label></div>';
            $row[] = $row_list->example_id;
            $row[] = strtoupper($row_list->name);
            $row[] = $row_list->type;
            $row[] = '<div class="center"><a href="'.base_url().'uploaded/files/'.$row_list->file.'" target="_blank"><img width="100px" src="'.base_url().'uploaded/files/'.$row_list->file.'"></div>';
            $row[] = $this->tanggal->formatDate($row_list->date);
            $row[] = ($row_list->is_active == 'Y') ? '<div class="center"><span class="label label-sm label-success">Active</span></div>' : '<div class="center"><span class="label label-sm label-danger">Not active</span></div>';
            $row[] = $row_list->updated_date?'<div class="center">'.$this->tanggal->formatDateTime($row_list->updated_date).'</div>':'<div class="center">'.$this->tanggal->formatDateTime($row_list->created_date).'</div>';
            $row[] = '<div class="center"><div class="hidden-sm hidden-xs action-buttons">
                        '.$this->authuser->show_button('example','R',$row_list->example_id,2).'
                        '.$this->authuser->show_button('example','U',$row_list->example_id,2).'
                        '.$this->authuser->show_button('example','D',$row_list->example_id,2).'
                      </div>
                      <div class="hidden-md hidden-lg">
                        <div class="inline pos-rel">
                            <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto"><i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                <li>'.$this->authuser->show_button('example','R','',4).'</li>
                                <li>'.$this->authuser->show_button('example','U','',4).'</li>
                                <li>'.$this->authuser->show_button('example','D','',4).'</li>
                            </ul>
                        </div>
                    </div></div>';        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->example->count_all(),
                        "recordsFiltered" => $this->example->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('name', 'Name', 'trim|required');
        $val->set_rules('type', 'Type', 'trim|required|xss_clean');
        $val->set_rules('date', 'Date', 'trim|required|xss_clean');
        $val->set_rules('select', 'Select your', 'trim|required');

        $val->set_message('required', "Silahkan isi field \"%s\"");

        if ($val->run() == FALSE)
        {
            $val->set_error_delimiters('<div style="color:white">', '</div>');
            echo json_encode(array('status' => 301, 'message' => validation_errors()));
        }
        else
        {                       
            $this->db->trans_begin();
            $id = ($this->input->post('id'))?$this->input->post('id'):0;

            $path_file    = $_FILES['file']['tmp_name'];
            $type_file      = $_FILES['file']['type'];
            $name_file     = $_FILES['file']['name'];
            $random_number = rand(1,999999);
            $unique_file_name = $random_number.'-'.$name_file;
            $dataexc = array(
                'name' => $val->set_value('name'),
                'type' => $val->set_value('type'),
                'file' => ($this->upload_file->process(array('name'=>$unique_file_name,'inputname'=>'file')))?$unique_file_name:'',
                'date' => $val->set_value('date'),
                'is_active' => $this->input->post('is_active'),
            );
            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = $this->session->userdata('user')->fullname;
                $this->db->insert('example', $dataexc);
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = $this->session->userdata('user')->fullname;
                $this->db->update('example', $dataexc, array('example_id' => $id));
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
            if($this->example->delete_by_id($toArray)){
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
/* Location: ./application/modules/example/controllers/example.php */
