<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_asal_pasien extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'reference/Patient_needs/Mst_asal_pasien');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'login');exit;
        }
        /*load model*/
        $this->load->model('Patient_needs/Mst_asal_pasien_model', 'Mst_asal_pasien');
        /*enable profiler*/
        $this->output->enable_profiler(false);

    }

    public function index() { 
        //echo '<pre>';print_r($this->session->all_userdata());
        /*define variable data*/
        $data = array(
            'title' => 'Asal Pasien',
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        /*load view index*/
        $this->load->view('Patient_needs/Mst_asal_pasien/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit jenis pasien', 'Mst_asal_pasien/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Mst_asal_pasien->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add jenis pasien', 'Mst_asal_pasien/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = 'Asal Pasien';
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Patient_needs/Mst_asal_pasien/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View jenis pasien', 'Mst_asal_pasien/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Mst_asal_pasien->get_by_id($id);
        $data['title'] = 'Asal Pasien';
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Patient_needs/Mst_asal_pasien/form', $data);
    }


    public function get_data()
    {
        /*get data from model*/
        $list = $this->Mst_asal_pasien->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" name="selected_id[]" value="'.$row_list->asal_pasien_id.'"/>
                            <span class="lbl"></span>
                        </label>
                      </div>';
            $row[] = '<div class="center">
                        '.$this->authuser->show_button('reference/Patient_needs/Mst_asal_pasien','R',$row_list->asal_pasien_id,2).'
                        '.$this->authuser->show_button('reference/Patient_needs/Mst_asal_pasien','U',$row_list->asal_pasien_id,2).'
                        '.$this->authuser->show_button('reference/Patient_needs/Mst_asal_pasien','D',$row_list->asal_pasien_id,2).'
                      </div>'; 
            $row[] = '<div class="center">'.$row_list->asal_pasien_id.'</div>';
            $row[] = '<div class="center">'.$row_list->asal_pasien_kode.'</div>';
            $row[] = strtoupper($row_list->asal_pasien_nama);
            $row[] = ($row_list->is_active == 'Y') ? '<div class="center"><span class="label label-sm label-success">Active</span></div>' : '<div class="center"><span class="label label-sm label-danger">Not active</span></div>';
                   
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Mst_asal_pasien->count_all(),
                        "recordsFiltered" => $this->Mst_asal_pasien->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {
       
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('asal_pasien_kode', 'Kode', 'trim|required');
        $val->set_rules('asal_pasien_nama', 'Asal Pasien', 'trim|required');

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
                'asal_pasien_nama' => $this->regex->_genRegex($val->set_value('asal_pasien_nama'), 'RGXQSL'),
                'asal_pasien_kode' => $this->regex->_genRegex($val->set_value('asal_pasien_kode'), 'RGXQSL'),
                'is_active' => $this->input->post('is_active'),
            );
            //print_r($dataexc);die;
            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
                $this->db->insert('mst_asal_pasien', $dataexc);
                $newId = $this->db->insert_id();
                $this->logs->save('mst_asal_pasien', $newId, 'insert new record', json_encode($dataexc));
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
                $this->db->update('mst_asal_pasien', $dataexc, array('asal_pasien_id' => $id));
                $newId = $id;
                $this->logs->save('mst_asal_pasien', $newId, 'update record', json_encode($dataexc));
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
            if($this->Mst_asal_pasien->delete_by_id($toArray)){
                $this->logs->save('mst_asal_pasien', $id, 'delete record', '');
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
