<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hdesk_contact extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'help_desk/Hdesk_contact');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'login');exit;
        }
        /*load model*/
        $this->load->model('Hdesk_contact_model', 'Hdesk_contact');
        /*enable profiler*/
        $this->output->enable_profiler(false);

    }

    public function index() { 
        //echo '<pre>';print_r($this->session->all_userdata());
        /*define variable data*/
        $data = array(
            'title' => 'Contact Center ('.$_GET['flag'].')',
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        /*load view index*/
        $this->load->view('Hdesk_contact/index', $data);
    }

    public function form()
    {
        $id = isset($_GET['id'])?$_GET['id']:'';
        
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();

        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*title header*/
            $data['title'] = 'Contact Center ('.$_GET['flag'].')';
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit function', 'Hdesk_contact/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Hdesk_contact->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
            /*load form view*/
            $this->load->view('Hdesk_contact/form_edit', $data);
        }else{
            /*title header*/
            $data['title'] = 'Contact Center';
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add function', 'Hdesk_contact/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
            /*load form view*/
            $this->load->view('Hdesk_contact/form', $data);
        }
        
        
    }

    /*function for view data only*/
    public function show()
    {
        $id = $_GET['id'];
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View function', 'Hdesk_contact/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Hdesk_contact->get_by_id($id);
        $data['title'] = 'Contact Center ('.$_GET['flag'].')';
        $data['flag'] = "read";
        $data['flag_data'] = $_GET['flag'];
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Hdesk_contact/form_edit', $data);
    }


    public function get_data()
    {
        /*get data from model*/
        $list = $this->Hdesk_contact->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" name="selected_id[]" value="'.$row_list->hpdesk_contact_id.'"/>
                            <span class="lbl"></span>
                        </label>
                      </div>';
            $row[] = '<div class="center">
                        '.$this->authuser->show_button('help_desk/Hdesk_contact?flag='.$_GET['flag'].'','R',$row_list->hpdesk_contact_id,'C1/'.$_GET['flag'].'').'
                        '.$this->authuser->show_button('help_desk/Hdesk_contact?flag='.$_GET['flag'].'','U',$row_list->hpdesk_contact_id,'C1/'.$_GET['flag'].'').'
                        '.$this->authuser->show_button('help_desk/Hdesk_contact?flag='.$_GET['flag'].'','D',$row_list->hpdesk_contact_id,'C1/'.$_GET['flag'].'').'
                      </div>'; 
            $row[] = '<div class="center">'.$row_list->hpdesk_contact_id.'</div>';
            $row[] = strtoupper($row_list->hpdesk_contact_name);
            $row[] = $row_list->hpdesk_contact_address;
            $row[] = $row_list->hpdesk_contact_home;
            $row[] = $row_list->hpdesk_contact_hp_1.' / '.$row_list->hpdesk_contact_hp_2.' / '.$row_list->hpdesk_contact_hp_3;
            $row[] = $row_list->hpdesk_contact_note;
            $row[] = ($row_list->is_active == 'Y') ? '<div class="center"><span class="label label-sm label-success">Active</span></div>' : '<div class="center"><span class="label label-sm label-danger">Not active</span></div>';
                   
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Hdesk_contact->count_all(),
                        "recordsFiltered" => $this->Hdesk_contact->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {
       
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('hpdesk_contact_name', 'Nama', 'trim|required');
        $val->set_rules('hpdesk_contact_address', 'Alamat', 'trim|xss_clean');
        $val->set_rules('hpdesk_contact_home', 'No Telp Rumah', 'trim|xss_clean');
        $val->set_rules('hpdesk_contact_hp_1', 'No HP 1', 'trim|required');
        $val->set_rules('hpdesk_contact_hp_2', 'No HP 2', 'trim|xss_clean');
        $val->set_rules('hpdesk_contact_hp_3', 'No HP 3', 'trim|xss_clean');
        $val->set_rules('hpdesk_contact_note', 'Ketarangan', 'trim|xss_clean');
        $val->set_rules('flag', 'Flag', 'trim|required');

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
                'hpdesk_contact_name' => $this->regex->_genRegex($val->set_value('hpdesk_contact_name'), 'RGXQSL'),
                'hpdesk_contact_address' => $this->regex->_genRegex($val->set_value('hpdesk_contact_address'), 'RGXQSL'),
                'hpdesk_contact_home' => $this->regex->_genRegex($val->set_value('hpdesk_contact_home'), 'RGXQSL'),
                'hpdesk_contact_hp_1' => $this->regex->_genRegex($val->set_value('hpdesk_contact_hp_1'), 'RGXQSL'),
                'hpdesk_contact_hp_2' => $this->regex->_genRegex($val->set_value('hpdesk_contact_hp_2'), 'RGXQSL'),
                'hpdesk_contact_hp_3' => $this->regex->_genRegex($val->set_value('hpdesk_contact_hp_3'), 'RGXQSL'),
                'hpdesk_contact_note' => $this->regex->_genRegex($val->set_value('hpdesk_contact_note'), 'RGXQSL'),
                'flag' => $this->regex->_genRegex($val->set_value('flag'), 'RGXQSL'),
                'is_active' => $this->input->post('is_active'),
            );
            //print_r($dataexc);die;
            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
                $this->db->insert('hpdesk_mst_contact', $dataexc);
                $newId = $this->db->insert_id();
                $this->logs->save('hpdesk_mst_contact', $newId, 'insert new record', json_encode($dataexc));
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
                $this->db->update('hpdesk_mst_contact', $dataexc, array('hpdesk_contact_id' => $id));
                $newId = $id;
                $this->logs->save('hpdesk_mst_contact', $newId, 'update record', json_encode($dataexc));
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
            if($this->Hdesk_contact->delete_by_id($toArray)){
                $this->logs->save('hpdesk_mst_contact', $id, 'delete record', '');
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
