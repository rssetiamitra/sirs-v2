<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tr_polling extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'website/Tr_polling');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'login');exit;
        }
        /*load model*/
        $this->load->model('Tr_polling_model', 'Tr_polling');
        /*enable profiler*/
        $this->output->enable_profiler(false);

    }

    public function index() { 
        //echo '<pre>';print_r($this->session->all_userdata());
        /*define variable data*/
        $data = array(
            'title' => 'Polling Masyarakat',
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        /*load view index*/
        $this->load->view('Tr_polling/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit polling', 'Tr_polling/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Tr_polling->get_by_id($id);
            $data['attachment'] = $this->upload_file->getUploadedFile($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add polling', 'Tr_polling/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = 'Polling Masyarakat';
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Tr_polling/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View polling', 'Tr_polling/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Tr_polling->get_by_id($id);
        $data['title'] = 'Polling Masyarakat';
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['attachment'] = $this->upload_file->getUploadedFile($id);
        /*load form view*/
        $this->load->view('Tr_polling/form', $data);
    }


    public function get_data()
    {
        /*get data from model*/
        $list = $this->Tr_polling->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" name="selected_id[]" value="'.$row_list->wpl_id.'"/>
                            <span class="lbl"></span>
                        </label>
                      </div>';
            $row[] = '<div class="center">
                        '.$this->authuser->show_button('website/Tr_polling','R',$row_list->wpl_id,2).'
                        '.$this->authuser->show_button('website/Tr_polling','U',$row_list->wpl_id,2).'
                        '.$this->authuser->show_button('website/Tr_polling','D',$row_list->wpl_id,2).'
                      </div>'; 
            $row[] = '<div class="center">'.$row_list->wpl_id.'</div>';
            $row[] = $row_list->wpl_title;
            $row[] = $row_list->wpl_tanggal;
            $row[] = $row_list->wpl_question;
            /*polling answer*/
            $html_answer = '<ul>';
            $exp_ans = explode(',', $row_list->polling_answer);
            foreach ($exp_ans as $kea => $vea) {
                # code...
                $html_answer .= '<li>'.$vea.'</li>';
            }
            $html_answer .= '</ul>';
            $row[] = $html_answer;
            $row[] = ($row_list->is_active == 'Y') ? '<div class="center"><span class="label label-sm label-success">Active</span></div>' : '<div class="center"><span class="label label-sm label-danger">Not active</span></div>';
                   
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Tr_polling->count_all(),
                        "recordsFiltered" => $this->Tr_polling->count_filtered(),
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
        $val->set_rules('wpl_title', 'Judul', 'trim|required');
        $val->set_rules('wpl_tanggal', 'Tanggal', 'trim|required');
        $val->set_rules('wpl_question', 'Pengadu', 'trim|xss_clean|required');
        $val->set_rules('wpl_ans_option', 'Pengadu', 'trim|xss_clean|required');
        $val->set_rules('is_active', 'Aktif', 'trim|xss_clean');

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
                'wpl_title' => $this->regex->_genRegex($val->set_value('wpl_title'),'RGXQSL'),
                'wpl_tanggal' => $this->regex->_genRegex($val->set_value('wpl_tanggal'),'RGXQSL'),
                'wpl_question' => $this->regex->_genRegex($val->set_value('wpl_question'),'RGXQSL'),
                'wpl_ans_option' => $this->regex->_genRegex($val->set_value('wpl_ans_option'),'RGXQSL'),
                'is_active' => $this->regex->_genRegex($val->set_value('is_active'),'RGXAZ'),
            );

            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
                $this->db->insert('web_polling', $dataexc);
                $last_id = $this->db->insert_id();
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
                $this->db->update('web_polling', $dataexc, array('wpl_id' => $id));
                $last_id = $id;
            }

            if($last_id){
                $arr_opt_ans = explode(',', $this->input->post('wpl_ans_option'));
                $this->db->delete('web_polling_answer', array('wpl_id' => $last_id));
                foreach($arr_opt_ans as $k=>$v){
                    $this->db->insert('web_polling_answer', array('wpl_id' => $last_id, 'wpl_option' => $v, 'counter' => 1));
                }
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
            if($this->Tr_polling->delete_by_id($toArray)){
                $this->logs->save('tr_polling', $id, 'delete record', '');
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
