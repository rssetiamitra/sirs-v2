<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tr_putusan extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'website/Tr_putusan');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'login');exit;
        }
        /*load model*/
        $this->load->model('Tr_putusan_model', 'Tr_putusan');
        /*enable profiler*/
        $this->output->enable_profiler(false);

    }

    public function index() { 
        //echo '<pre>';print_r($this->session->all_userdata());
        /*define variable data*/
        $data = array(
            'title' => 'Putusan/Maklumat',
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        /*load view index*/
        $this->load->view('Tr_putusan/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit putusan/maklumat', 'Tr_putusan/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Tr_putusan->get_by_id($id);
            $data['attachment'] = $this->upload_file->getUploadedFile($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add putusan/maklumat', 'Tr_putusan/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = 'Putusan/Maklumat';
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Tr_putusan/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View putusan/maklumat', 'Tr_putusan/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Tr_putusan->get_by_id($id);
        $data['title'] = 'Putusan/Maklumat';
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['attachment'] = $this->upload_file->getUploadedFile($id);
        /*load form view*/
        $this->load->view('Tr_putusan/form', $data);
    }


    public function get_data()
    {
        /*get data from model*/
        $list = $this->Tr_putusan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" name="selected_id[]" value="'.$row_list->wps_id.'"/>
                            <span class="lbl"></span>
                        </label>
                      </div>';
            $row[] = '<div class="center">
                        '.$this->authuser->show_button('website/Tr_putusan','R',$row_list->wps_id,2).'
                        '.$this->authuser->show_button('website/Tr_putusan','U',$row_list->wps_id,2).'
                        '.$this->authuser->show_button('website/Tr_putusan','D',$row_list->wps_id,2).'
                      </div>'; 
            $row[] = '<div class="center">'.$row_list->wps_id.'</div>';
            $row[] = $row_list->wps_title;
            $row[] = $row_list->wps_subtitle;
            $row[] = $row_list->wps_tanggal;
            $row[] = $row_list->wps_deskripsi;
            $row[] = '<div class="center"><a href="templates/attachment/download_attachment?fname=uploaded/website/images/'.$row_list->wps_lampiran.'" style="color:red">Download</a></div>';
            $row[] = ($row_list->is_active == 'Y') ? '<div class="center"><span class="label label-sm label-success">Active</span></div>' : '<div class="center"><span class="label label-sm label-danger">Not active</span></div>';
                   
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Tr_putusan->count_all(),
                        "recordsFiltered" => $this->Tr_putusan->count_filtered(),
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
        $val->set_rules('wps_title', 'Judul', 'trim|required');
        $val->set_rules('wps_subtitle', 'Sub Judul', 'trim|xss_clean');
        $val->set_rules('wps_tanggal', 'Tanggal', 'trim|required');
        $val->set_rules('wps_kategori', 'Kategori', 'trim|required');
        $val->set_rules('wps_deskripsi', 'Deskripsi', 'trim|xss_clean');

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
                'wps_title' => $this->regex->_genRegex($val->set_value('wps_title'),'RGXQSL'),
                'wps_subtitle' => $this->regex->_genRegex($val->set_value('wps_subtitle'),'RGXQSL'),
                'wps_tanggal' => $this->regex->_genRegex($val->set_value('wps_tanggal'),'RGXQSL'),
                'wps_kategori' => $this->regex->_genRegex($val->set_value('wps_kategori'),'RGXINT'),
                'wps_deskripsi' => $this->regex->_genRegex($val->set_value('wps_deskripsi'),'RGXQSL'),
                'is_active' => 'Y',
                'is_publish' => 'Y',
            );

            if($_FILES['images']['name'] != ''){
                /*hapus dulu file yang lama*/
                if( $id != 0 ){
                    $tr_album = $this->Tr_album->get_by_id($id);
                    if (file_exists('uploaded/website/images/'.$tr_album->wp_images.'')) {
                        unlink('uploaded/website/images/'.$tr_album->wp_images.'');
                    }
                }

                $dataexc['wps_lampiran'] = $this->upload_file->doUpload('images', 'uploaded/website/images/');
            }

            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
                $this->db->insert('web_putusan', $dataexc);
                $last_id = $this->db->insert_id();
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
                $this->db->update('web_putusan', $dataexc, array('wps_id' => $id));
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
            if($this->Tr_putusan->delete_by_id($toArray)){
                $this->logs->save('tr_putusan', $id, 'delete record', '');
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
