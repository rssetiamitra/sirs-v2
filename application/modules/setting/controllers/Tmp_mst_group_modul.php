<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tmp_mst_group_modul extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'setting/Tmp_mst_group_modul');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'login');exit;
        }
        /*load model*/
        $this->load->model('Tmp_mst_group_modul_model', 'Tmp_mst_group_modul');
        /*enable profiler*/
        $this->output->enable_profiler(false);

    }

    public function index() { 
        //echo '<pre>';print_r($this->session->all_userdata());
        /*define variable data*/
        $data = array(
            'title' => 'Master Group Modul',
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        /*load view index*/
        $this->load->view('Tmp_mst_group_modul/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit group modul', 'Tmp_mst_group_modul/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Tmp_mst_group_modul->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add group modul', 'Tmp_mst_group_modul/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = 'Master Group Modul';
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Tmp_mst_group_modul/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View group modul', 'Tmp_mst_group_modul/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Tmp_mst_group_modul->get_by_id($id);
        $data['title'] = 'Master Group Modul';
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Tmp_mst_group_modul/form', $data);
    }


    public function get_data()
    {
        /*get data from model*/
        $list = $this->Tmp_mst_group_modul->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" name="selected_id[]" value="'.$row_list->group_modul_id.'"/>
                            <span class="lbl"></span>
                        </label>
                      </div>';
            $row[] = '<div class="center">
                        '.$this->authuser->show_button('setting/Tmp_mst_group_modul','R',$row_list->group_modul_id,2).'
                        '.$this->authuser->show_button('setting/Tmp_mst_group_modul','U',$row_list->group_modul_id,2).'
                        '.$this->authuser->show_button('setting/Tmp_mst_group_modul','D',$row_list->group_modul_id,2).'
                      </div>'; 
            $row[] = '<div class="center">'.$row_list->group_modul_id.'</div>';
            $row[] = strtoupper($row_list->group_modul_name);
            $row[] = $row_list->group_modul_description;
            $row[] = ($row_list->is_active == 'Y') ? '<div class="center"><span class="label label-sm label-success">Active</span></div>' : '<div class="center"><span class="label label-sm label-danger">Not active</span></div>';
                   
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Tmp_mst_group_modul->count_all(),
                        "recordsFiltered" => $this->Tmp_mst_group_modul->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {
       
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('group_modul_name', 'Group Modul Name', 'trim|required');
        $val->set_rules('group_modul_description', 'Description', 'trim|xss_clean');
        $val->set_rules('is_active', 'Is Active?', 'trim|xss_clean');

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
                'group_modul_name' => $this->regex->_genRegex($val->set_value('group_modul_name'),'RGXQSL'),
                'group_modul_description' => $this->regex->_genRegex($val->set_value('group_modul_description'),'RGXQSL'),
                'is_active' => $this->regex->_genRegex($val->set_value('is_active'),'RGXQSL'),
            );
            //print_r($dataexc);die;
            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
                $this->db->insert('tmp_mst_group_modul', $dataexc);
                $newId = $this->db->insert_id();
                $this->logs->save('tmp_mst_group_modul', $newId, 'insert new record', json_encode($dataexc));
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
                $this->db->update('tmp_mst_group_modul', $dataexc, array('group_modul_id' => $id));
                $newId = $id;
                $this->logs->save('tmp_mst_group_modul', $newId, 'update record', json_encode($dataexc));
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
            if($this->Tmp_mst_group_modul->delete_by_id($toArray)){
                $this->logs->save('tmp_mst_group_modul', $id, 'delete record', '');
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
