<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_jenis_surat extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'master_data/mst_jenis_surat');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'login');exit;
        }
        /*load model*/
        $this->load->model('mst_jenis_surat_model', 'mst_jenis_surat');
        /*enable profiler*/
        $this->output->enable_profiler(false);

    }

    public function index() {
        /*define variable data*/
        $data = array(
            'title' => 'Jenis Surat',
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        /*load view index*/
        $this->load->view('mst_jenis_surat/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit Jenis Surat', 'master_data/mst_jenis_surat/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->mst_jenis_surat->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add Jenis Surat', 'master_data/mst_jenis_surat/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = "Jenis Surat";
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('mst_jenis_surat/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View Jenis Surat', 'master_data/mst_jenis_surat/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->mst_jenis_surat->get_by_id($id);
        $data['title'] = "Jenis Surat";
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('mst_jenis_surat/form', $data);
    }


    public function get_data()
    {
        /*get data from model*/
        $list = $this->mst_jenis_surat->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div class="center"><label class="pos-rel">
                        <input type="checkbox" class="ace" name="selected_id[]" value="'.$row_list->js_id.'"/>
                        <span class="lbl"></span>
                    </label></div>';
            $row[] = $row_list->js_id;
            $row[] = strtoupper($row_list->js_nama);
            $row[] = ($row_list->is_active == 'Y') ? '<div class="center"><span class="label label-sm label-success">Active</span></div>' : '<div class="center"><span class="label label-sm label-danger">Not active</span></div>';
            $row[] = $row_list->updated_date?'<div class="center">'.$this->tanggal->formatDateTime($row_list->updated_date).'</div>':'<div class="center">'.$this->tanggal->formatDateTime($row_list->created_date).'</div>';
            $row[] = '<div class="center"><div class="hidden-sm hidden-xs action-buttons">
                        '.$this->authuser->show_button('master_data/mst_jenis_surat','R',$row_list->js_id,2).'
                        '.$this->authuser->show_button('master_data/mst_jenis_surat','U',$row_list->js_id,2).'
                        '.$this->authuser->show_button('master_data/mst_jenis_surat','D',$row_list->js_id,2).'
                      </div>
                      <div class="hidden-md hidden-lg">
                        <div class="inline pos-rel">
                            <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto"><i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                            </button>
                            <ul class="dropdown-mst_jenis_surat dropdown-only-icon dropdown-yellow dropdown-mst_jenis_surat-right dropdown-caret dropdown-close">
                                <li>'.$this->authuser->show_button('master_data/mst_jenis_surat','R','',4).'</li>
                                <li>'.$this->authuser->show_button('master_data/mst_jenis_surat','U','',4).'</li>
                                <li>'.$this->authuser->show_button('master_data/mst_jenis_surat','D','',4).'</li>
                            </ul>
                        </div>
                    </div></div>';        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->mst_jenis_surat->count_all(),
                        "recordsFiltered" => $this->mst_jenis_surat->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('js_nama', 'Nama Jenis Surat', 'trim|required');

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

            $dataexc = array(
                'js_nama' => $val->set_value('js_nama'),
                'is_active' => $this->input->post('is_active'),
            );
            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = $this->session->userdata('user')->fullname;
                $this->db->insert('mst_jenis_surat', $dataexc);
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = $this->session->userdata('user')->fullname;
                $this->db->update('mst_jenis_surat', $dataexc, array('js_id' => $id));
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
            if($this->mst_jenis_surat->delete_by_id($toArray)){
                echo json_encode(array('status' => 200, 'message' => 'Proses Hapus Data Berhasil Dilakukan'));
            }else{
                echo json_encode(array('status' => 301, 'message' => 'Maaf Proses Hapus Data Gagal Dilakukan'));
            }
        }else{
            echo json_encode(array('status' => 301, 'message' => 'Tidak ada item yang dipilih'));
        }
        
    }


}


/* End of file Jenis Surat.php */
/* Location: ./application/modules/mst_jenis_surat/controllers/mst_jenis_surat.php */
