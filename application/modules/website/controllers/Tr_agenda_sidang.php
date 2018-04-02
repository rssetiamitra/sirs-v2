<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tr_agenda_sidang extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'website/Tr_agenda_sidang');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'login');exit;
        }
        /*load model*/
        $this->load->model('Tr_agenda_sidang_model', 'Tr_agenda_sidang');
        /*enable profiler*/
        $this->output->enable_profiler(false);

    }

    public function index() { 
        //echo '<pre>';print_r($this->session->all_userdata());
        /*define variable data*/
        $data = array(
            'title' => 'Agenda Sidang',
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        /*load view index*/
        $this->load->view('Tr_agenda_sidang/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit agenda sidang', 'Tr_agenda_sidang/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Tr_agenda_sidang->get_by_id($id);
            $data['attachment'] = $this->upload_file->getUploadedFile($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add agenda sidang', 'Tr_agenda_sidang/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = 'Agenda Sidang';
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Tr_agenda_sidang/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View agenda sidang', 'Tr_agenda_sidang/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Tr_agenda_sidang->get_by_id($id);
        $data['title'] = 'Agenda Sidang';
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['attachment'] = $this->upload_file->getUploadedFile($id);
        /*load form view*/
        $this->load->view('Tr_agenda_sidang/form', $data);
    }


    public function get_data()
    {
        /*get data from model*/
        $list = $this->Tr_agenda_sidang->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" name="selected_id[]" value="'.$row_list->was_id.'"/>
                            <span class="lbl"></span>
                        </label>
                      </div>';
            $row[] = '<div class="center">
                        '.$this->authuser->show_button('website/Tr_agenda_sidang','R',$row_list->was_id,2).'
                        '.$this->authuser->show_button('website/Tr_agenda_sidang','U',$row_list->was_id,2).'
                        '.$this->authuser->show_button('website/Tr_agenda_sidang','D',$row_list->was_id,2).'
                      </div>'; 
            $row[] = '<div class="center">'.$row_list->was_id.'</div>';
            $row[] = $row_list->was_nama_agenda;
            $row[] = $row_list->was_tanggal_sidang;
            $row[] = $row_list->was_no_perkara;
            /*pengadu*/
            $exp_pengadu = explode(',', $row_list->was_pengadu);
            $html_pengadu = '<ol>';
            foreach ($exp_pengadu as $key_p => $value_p) {
                $html_pengadu .= '<li>'.$value_p.'</li>';
            }
            $html_pengadu .= '</ol>';
            $row[] = $html_pengadu;

            /*teradu*/
            $exp_teradu = explode(',', $row_list->was_teradu);
            $html_teradu = '<ol>';
            foreach ($exp_teradu as $key_t => $value_t) {
                $html_teradu .= '<li>'.$value_t.'</li>';
            }
            $html_teradu .= '</ol>';

            $row[] = $html_teradu;
            
            $row[] = ($row_list->was_type==1)?'Agenda Sidang':'Agenda Umum';
            $row[] = ($row_list->is_active == 'Y') ? '<div class="center"><span class="label label-sm label-success">Active</span></div>' : '<div class="center"><span class="label label-sm label-danger">Not active</span></div>';
                   
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Tr_agenda_sidang->count_all(),
                        "recordsFiltered" => $this->Tr_agenda_sidang->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {
        
        //print_r($_POST);die;

        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('was_nama_agenda', 'Nomor Agenda Sidang', 'trim|required');
        $val->set_rules('was_tanggal_sidang', 'Tanggal', 'trim|required');
        $val->set_rules('was_no_perkara', 'Pengadu', 'trim|xss_clean|required');
        $val->set_rules('was_pengadu', 'Pengadu', 'trim|xss_clean|required');
        $val->set_rules('was_teradu', 'Alat Bukti', 'trim|xss_clean');
        $val->set_rules('was_type', 'Jenis Agenda', 'trim|xss_clean|required');
        $val->set_rules('content', 'Pokok Perkara', 'trim|xss_clean');
        $val->set_rules('is_active', 'Is Active', 'trim|xss_clean');

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
                'was_nama_agenda' => $this->regex->_genRegex($val->set_value('was_nama_agenda'),'RGXQSL'),
                'was_tanggal_sidang' => $this->regex->_genRegex($val->set_value('was_tanggal_sidang'),'RGXQSL'),
                'was_no_perkara' => $this->regex->_genRegex($val->set_value('was_no_perkara'),'RGXQSL'),
                'was_pengadu' => $this->regex->_genRegex($val->set_value('was_pengadu'),'RGXQSL'),
                'was_teradu' => $this->regex->_genRegex($val->set_value('was_teradu'),'RGXQSL'),
                'was_pokok_perkara' => $this->regex->_genRegex($val->set_value('content'),'RGXQSL'),
                'was_type' => $this->regex->_genRegex($val->set_value('was_type'),'RGXINT'),
                'is_active' => $this->regex->_genRegex($val->set_value('is_active'),'RGXAZ'),
            );

            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
                $this->db->insert('web_agenda_sidang', $dataexc);
                $last_id = $this->db->insert_id();
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
                $this->db->update('web_agenda_sidang', $dataexc, array('was_id' => $id));
                $last_id = $id;
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
            if($this->Tr_agenda_sidang->delete_by_id($toArray)){
                $this->logs->save('tr_agenda_sidang', $id, 'delete record', '');
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
