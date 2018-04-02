<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tmp_user_has_role extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'setting/Tmp_user_has_role');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'login');exit;
        }
        /*load model*/
        $this->load->model('Tmp_user_has_role_model', 'Tmp_user_has_role');

        /*load library*/
        $this->load->library('bcrypt');
        /*enable profiler*/
        $this->output->enable_profiler(false);

    }

    public function index() { 
        //echo '<pre>';print_r($this->session->all_userdata());
        /*define variable data*/
        $data = array(
            'title' => 'User Group',
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        /*load view index*/
        $this->load->view('Tmp_user_has_role/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit user group', 'Tmp_user_has_role/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Tmp_user_has_role->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add user group', 'Tmp_user_has_role/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = 'User Group';
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['role'] = $this->db->where(array('is_active' => 'Y'))->get('tmp_mst_role')->result();
        /*load form view*/
        $this->load->view('Tmp_user_has_role/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View user group', 'Tmp_user_has_role/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Tmp_user_has_role->get_by_id($id);
        $data['title'] = 'User Group';
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Tmp_user_has_role/form', $data);
    }


    public function get_data()
    {
        /*get data from model*/
        $list = $this->Tmp_user_has_role->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" name="selected_id[]" value="'.$row_list->user_id.'"/>
                            <span class="lbl"></span>
                        </label>
                      </div>';
            $row[] = '<div class="center">
                        '.$this->authuser->show_button('setting/Tmp_user_has_role','U',$row_list->user_id,2).'
                      </div>'; 
            $row[] = '<div class="center">'.$row_list->user_id.'</div>';
            $row[] = strtoupper($row_list->fullname);
            $row[] = $row_list->email;
            $row[] = $row_list->username;
            $row[] = $row_list->role_name;
            $row[] = ($row_list->is_active == 'Y') ? '<div class="center"><span class="label label-sm label-success">Active</span></div>' : '<div class="center"><span class="label label-sm label-danger">Not active</span></div>';
                   
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Tmp_user_has_role->count_all(),
                        "recordsFiltered" => $this->Tmp_user_has_role->count_filtered(),
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
        $val->set_rules('id', 'ID', 'trim|required');

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
            $user_role = $this->input->post('user_role');
            $this->db->delete('Tmp_user_has_role', array('user_id' => $id));
            foreach ($user_role as $key => $value) {
                $dataexc = array('user_id' => $id, 'role_id' =>$value);
                $this->db->insert('tmp_user_has_role', $dataexc);
                $this->logs->save('tmp_user_has_role', $id, 'insert new record', json_encode($dataexc));
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
        $id = $this->input->post('ID') ? $this->regex->_genRegex($this->input->post('ID',TRUE),'RGXINT') : null;
        $toArray = explode(',',$id);
        if($id!=null){
            if($this->Tmp_user_has_role->delete_by_id($toArray)){
                $this->logs->save('tmp_user_has_role', $id, 'delete record', '');
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
