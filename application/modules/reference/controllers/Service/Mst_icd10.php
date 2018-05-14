<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_icd10 extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'reference/Service/Mst_icd10');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'login');exit;
        }
        /*load model*/
        $this->load->model('Service/Mst_icd10_model', 'Mst_icd10');
        /*enable profiler*/
        $this->output->enable_profiler(false);

    }

    public function index() { 
        //echo '<pre>';print_r($this->session->all_userdata());
        /*define variable data*/
        $data = array(
            'title' => 'ICD 10',
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        /*load view index*/
        $this->load->view('Service/Mst_icd10/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit ICD 10', 'Mst_icd10/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Mst_icd10->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add ICD 10', 'Mst_icd10/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = 'ICD 10';
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Service/Mst_icd10/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View ICD 10', 'Mst_icd10/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Mst_icd10->get_by_id($id);
        $data['title'] = 'ICD 10';
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Service/Mst_icd10/form', $data);
    }


    public function get_data()
    {
        /*get data from model*/
        $list = $this->Mst_icd10->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" name="selected_id[]" value="'.$row_list->icd10_id.'"/>
                            <span class="lbl"></span>
                        </label>
                      </div>';
            $row[] = '<div class="center">
                        '.$this->authuser->show_button('reference/Service/Mst_icd10','R',$row_list->icd10_id,2).'
                        '.$this->authuser->show_button('reference/Service/Mst_icd10','U',$row_list->icd10_id,2).'
                        '.$this->authuser->show_button('reference/Service/Mst_icd10','D',$row_list->icd10_id,2).'
                      </div>'; 
            $row[] = '<div class="center">'.$row_list->icd10_id.'</div>';
            $row[] = strtoupper($row_list->icd10_kode);
            $row[] = strtoupper($row_list->icd10_induk_kode);
            $row[] = strtoupper($row_list->icd10_nama);
            $row[] = ($row_list->is_active == 'Y') ? '<div class="center"><span class="label label-sm label-success">Active</span></div>' : '<div class="center"><span class="label label-sm label-danger">Not active</span></div>';
                   
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mst_icd10->count_all(),
                        "recordsFiltered" => $this->Mst_icd10->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {
       
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('icd10_kode', 'Kode ICD 10', 'trim|required');
        $val->set_rules('icd10_nama', 'Nama ICD 10', 'trim|required');
        $val->set_rules('icd10_induk_kode', 'Kode ICD 10 Induk', 'trim|required');
        $val->set_rules('includes', 'Includes', 'trim|xss_clean');
        $val->set_rules('excludes', 'Excludes', 'trim|xss_clean');
        $val->set_rules('note', 'Note', 'trim|xss_clean');
        $val->set_rules('description', 'Deskripsi', 'trim|xss_clean');
        $val->set_rules('status_app', 'Status App', 'trim|xss_clean');
        $val->set_rules('is_default', 'Is Default', 'trim|xss_clean');

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
                'icd10_kode' => $this->regex->_genRegex($val->set_value('icd10_kode'), 'RGXQSL'),
                'icd10_nama' => $this->regex->_genRegex($val->set_value('icd10_nama'), 'RGXQSL'),
                'icd10_induk_kode' => $this->regex->_genRegex($val->set_value('icd10_induk_kode'), 'RGXQSL'),
                'includes' => $this->regex->_genRegex($val->set_value('includes'), 'RGXQSL'),
                'excludes' => $this->regex->_genRegex($val->set_value('excludes'), 'RGXQSL'),
                'note' => $this->regex->_genRegex($val->set_value('note'), 'RGXQSL'),
                'description' => $this->regex->_genRegex($val->set_value('description'), 'RGXQSL'),
                'status_app' => $this->regex->_genRegex($val->set_value('status_app'), 'RGXQSL'),
                'is_default' => $this->regex->_genRegex($val->set_value('is_default'), 'RGXQSL'),
                'is_active' => $this->input->post('is_active'),
            );
            //print_r($dataexc);die;
            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
                $this->db->insert('mst_icd10', $dataexc);
                $newId = $this->db->insert_id();
                $this->logs->save('mst_icd10', $newId, 'insert new record', json_encode($dataexc));
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
                $this->db->update('mst_icd10', $dataexc, array('icd10_id' => $id));
                $newId = $id;
                $this->logs->save('mst_icd10', $newId, 'update record', json_encode($dataexc));
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
        $id=$this->input->post('ID')?$this->regex->_genRegex($this->input->post('ID',TRUE),'RGXQSL'):null;
        $toArray = explode(',',$id);
        if($id!=null){
            if($this->Mst_icd10->delete_by_id($toArray)){
                $this->logs->save('mst_icd10', $id, 'delete record', '');
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
