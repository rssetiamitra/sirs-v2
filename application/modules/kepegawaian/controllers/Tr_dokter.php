<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tr_dokter extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'kepegawaian/tr_dokter');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'login');exit;
        }
        /*load model*/
        $this->load->model('kepegawaian/tr_dokter_model', 'tr_dokter');
        /*enable profiler*/
        $this->output->enable_profiler(false);

    }

    public function index() {
        /*define variable data*/
        $data = array(
            'title' => 'Data Pegawai',
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        /*load view index*/
        $this->load->view('tr_dokter/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit Data Pegawai', 'tr_dokter/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->tr_dokter->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add Data Pegawai', 'tr_dokter/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = "Data Pegawai";
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('tr_dokter/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View Data Pegawai', 'tr_dokter/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->tr_dokter->get_by_id($id);
        $data['title'] = "Tr_dokter";
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('tr_dokter/form', $data);
    }


    public function get_data()
    {
        /*get data from model*/
        $list = $this->tr_dokter->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div class="center "><label class="pos-rel">
                        <input type="checkbox" class="ace" name="selected_id[]" value="'.$row_list->pg_id.'"/>
                        <span class="lbl"></span>
                    </label></div>';
            $row[] = '<div class="center">'.$row_list->pg_id.'</div>';
            /*avatar*/
            $avatar_link = ($row_list->photo != NULL)?base_url().'uploaded/photo/'.$row_list->photo:base_url().'assets/img/avatar.png'; 
            $row[] = '<div class="center"><a href="'.$avatar_link.'" target="_blank"><img width="60px" src="'.$avatar_link.'"></div>';
            $row[] = 'NIP : '.$row_list->nip.'<br>'.strtoupper($row_list->fullname);
            $jbtn_name = ($row_list->jbtn_id != 0) ? $row_list->jbtn_name : 'Staf '.$row_list->uk_name ;
            $row[] = '<div class="">'.$jbtn_name.'</div>';
            $row[] = '<div class="">'.$row_list->email.'</div>';
            $row[] = '<div class="">'.$row_list->no_telp.'</div>';
            $row[] = '<div class="">'.$this->tanggal->formatDate($row_list->active_date).'<div>';
            $row[] = ($row_list->is_active == 'Y') ? '<div class="center "><span class="label label-sm label-success">Active</span></div>' : '<div class="center"><span class="label label-sm label-danger">Not active</span></div>';
            /*$row[] = $row_list->updated_date?'<div class="center">'.$this->tanggal->formatDateTime($row_list->updated_date).'</div>':'<div class="center">'.$this->tanggal->formatDateTime($row_list->created_date).'</div>';*/
            $row[] = '<div class="center"><div class="hidden-sm hidden-xs action-buttons">
                        '.$this->authuser->show_button('kepegawaian/tr_dokter','R',$row_list->pg_id,2).'
                        '.$this->authuser->show_button('kepegawaian/tr_dokter','U',$row_list->pg_id,2).'
                        '.$this->authuser->show_button('kepegawaian/tr_dokter','D',$row_list->pg_id,2).'
                      </div>
                      <div class="hidden-md hidden-lg">
                        <div class="inline pos-rel">
                            <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto"><i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                <li>'.$this->authuser->show_button('kepegawaian/tr_dokter','R',$row_list->pg_id,4).'</li>
                                <li>'.$this->authuser->show_button('kepegawaian/tr_dokter','U',$row_list->pg_id,4).'</li>
                                <li>'.$this->authuser->show_button('kepegawaian/tr_dokter','D',$row_list->pg_id,4).'</li>
                            </ul>
                        </div>
                    </div></div>';        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->tr_dokter->count_all(),
                        "recordsFiltered" => $this->tr_dokter->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {
        //print_r($_FILES['file']);die;
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('fullname', 'Nama Lengkap', 'trim|required');
        $val->set_rules('nip', 'NIP', 'trim|required|xss_clean');
        $val->set_rules('email', 'Email', 'trim|valid_email|xss_clean');
        $val->set_rules('no_telp', 'No Telp', 'trim|xss_clean');
        $val->set_rules('uk_id', 'Unit Kerja', 'trim|required');
        $val->set_rules('jbtn_id', 'Jabatan', 'trim');

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
            if(isset($_FILES['file'])){
                $path_file    = $_FILES['file']['tmp_name'];
                $type_file      = $_FILES['file']['type'];
                $name_file     = $_FILES['file']['name'];
                $random_number = rand(1,999999);
                $unique_file_name = $random_number.'-'.$name_file;
            }
            
            $dataexc = array(
                'fullname' => strtoupper($val->set_value('fullname')),
                'nip' => $val->set_value('nip'),
                'email' => $val->set_value('email'),
                'no_telp' => $val->set_value('no_telp'),
                'uk_id' => $val->set_value('uk_id'),
                'jbtn_id' => $val->set_value('jbtn_id'),
                
                'active_date' => $this->input->post('active_date'),
                'is_active' => $this->input->post('is_active'),
            );
            if(isset($_FILES['file'])){
                $dataexc['photo'] = ($this->upload_file->process(array('name'=>$unique_file_name,'path'=>'uploaded/photo/','inputname'=>'file')))?$unique_file_name:'';
            }
            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = $this->session->userdata('user')->fullname;
                $this->db->insert('tr_dokter', $dataexc);
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = $this->session->userdata('user')->fullname;
                $this->db->update('tr_dokter', $dataexc, array('pg_id' => $id));
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
            if($this->tr_dokter->delete_by_id($toArray)){
                echo json_encode(array('status' => 200, 'message' => 'Proses Hapus Data Berhasil Dilakukan'));
            }else{
                echo json_encode(array('status' => 301, 'message' => 'Maaf Proses Hapus Data Gagal Dilakukan'));
            }
        }else{
            echo json_encode(array('status' => 301, 'message' => 'Tidak ada item yang dipilih'));
        }
        
    }


}


/* End of file Data Pegawai.php */
/* Location: ./application/modules/tr_dokter/controllers/tr_dokter.php */
