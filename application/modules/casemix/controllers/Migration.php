<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Migration extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'casemix/Migration');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'login');exit;
        }
        /*load model*/
        $this->load->model('Migration_model', 'Migration');
        $this->load->model('Csm_billing_pasien_model', 'Csm_billing_pasien');
        /*load module*/
        $this->load->module('Templates/Templates.php');
        $this->load->module('Templates/Export_data.php');
        /*enable profiler*/
        $this->output->enable_profiler(false);

    }

    public function index() { 
        /*define variable data*/
        $data = array(
            'title' => 'Migration',
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        /*load view index*/
        $this->load->view('Migration/index', $data);
    }

    public function get_data()
    {
        //print_r($_GET);die;
        /*get data from model*/
            $list = $this->Migration->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $row_list) {
                $kode_bag = ($row_list->kode_bagian_keluar!=null)?$row_list->kode_bagian_keluar:$row_list->kode_bagian_masuk;
                /*get tipe RI/RJ*/
                $str_type = $this->Csm_billing_pasien->getTipeRegistrasi($kode_bag);

                $no++;
                $row = array();
                $link = 'casemix/Migration';

                $status_reg = $this->Migration->cekIfExist($row_list->no_registrasi);

                $row[] = '<div class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" name="selected_id[]" value="'.$row_list->no_registrasi.'"/>
                                <span class="lbl"></span>
                            </label>
                          </div>';
                $row[] = $row_list->no_registrasi;
                $row[] = $str_type;
                $row[] = '';
                $row[] = '<a href="#" onclick="getMenu('."'".$link.'/editBilling/'.$row_list->no_registrasi.''."/".$str_type."'".')">'.$row_list->no_registrasi.'</a>';
                if ( $status_reg->num_rows() > 0 ) {
                    $reg_data = $status_reg->row();
                    $row[] = '<div class="center"><input type="hidden" id="'.$row_list->no_registrasi.'" class="form-control" name="no_sep['.$row_list->no_registrasi.']" value="'.$reg_data->csm_rp_no_sep.'"> '.$reg_data->csm_rp_no_sep.'  </div>';
                }else{
                    if( $row_list->no_sep == NULL || $row_list->no_sep == '' ){
                        $row[] = '<div class="center"><input type="text" id="'.$row_list->no_registrasi.'" class="form-control" name="no_sep['.$row_list->no_registrasi.']"></div>';
                    }else{
                        $row[] = '<div class="center">'.$row_list->no_sep.' <input type="hidden" id="'.$row_list->no_registrasi.'" class="form-control" name="no_sep['.$row_list->no_registrasi.']" value="'.$row_list->no_sep.'"> </div>';
                    }
                }

                
                $row[] = $row_list->no_mr;
                $row[] = strtoupper($row_list->nama_pasien);
                $row[] = '<i class="fa fa-angle-double-right green"></i> '.$this->tanggal->formatDate($row_list->tgl_jam_masuk).'<br><i class="fa fa-angle-double-left red"></i> '.$this->tanggal->formatDate($row_list->tgl_jam_keluar);
                $row[] = $row_list->nama_pegawai.'<br><span style="font-size:11px"><b>('.$row_list->nama_bagian.')</b></span>';
                
                $row[] = '<div class="center"><input type="hidden" id="type_'.$row_list->no_registrasi.'" class="form-control" name="form_type['.$row_list->no_registrasi.']" value="'.$str_type.'">'.$str_type.'</div>';
                
                $row[] = ($status_reg->num_rows() > 0)?'<div class="center"><i class="fa fa-check bigger-200 green"></i></div>':'';
                $row[] = '<div class="center"><a href="#" class="btn btn-xs btn-primary" onclick="submit('.$row_list->no_registrasi.')"><i class="ace-icon fa fa-saves bigger-50"></i>Submit</a></div>';

                if ( $status_reg->num_rows() > 0 ) {
                    $row[] = '<div class="center" id="merge_'.$row_list->no_registrasi.'""><a href="'.base_url().'casemix/Csm_billing_pasien/mergePDFFiles/'.$row_list->no_registrasi.'/'.$str_type.'" target="_blank" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-pdf-file bigger-50"></i>Merge</a></div>';
                }else{
                    $row[] = '<div class="center" style="color:red" id="merge_'.$row_list->no_registrasi.'"">Waiting..</div>';
                }
                
                       
                $data[] = $row;
            }
            
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Migration->count_all(),
                        "recordsFiltered" => $this->Migration->count_filtered(),
                        "data" => $data,
                );
        //print_r($output);die;
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {

        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('no_sep', 'No.SEP', 'trim|required');
        $val->set_rules('csm_rp_tgl_masuk', 'Tanggal Masuk', 'trim');
        $val->set_rules('csm_rp_tgl_keluar', 'Tanggal Keluar', 'trim');

        $val->set_message('required', "Silahkan isi field \"%s\"");

        if ($val->run() == FALSE)
        {
            $val->set_error_delimiters('<div style="color:white">', '</div>');
            echo json_encode(array('status' => 301, 'message' => validation_errors()));
        }
        else
        {                       
            $this->db->trans_begin();
            $no_registrasi = ($this->input->post('no_registrasi'))?$this->regex->_genRegex($this->input->post('no_registrasi'),'RGXINT'):0;

            /*get data trans pelayanan by no registrasi from sirs*/
            $sirs_data = json_decode($this->Csm_billing_pasien->getDetailData($no_registrasi));
            //echo '<pre>';print_r($sirs_data);die;
            /*cek apakah data sudah pernah diinsert ke database atau blm*/
            if( $this->Csm_billing_pasien->checkExistingData($no_registrasi) ){
                /*no action if data exist, continue to view data*/
            }else{
            /*jika data belum ada atau belum pernah diinsert, maka insert ke table*/
                /*insert data untuk pertama kali*/
                if( $sirs_data->group && $sirs_data->kasir_data && $sirs_data->trans_data )
                $this->Csm_billing_pasien->insertDataFirstTime($sirs_data, $no_registrasi);
            }

            if( $this->input->post('no_sep') ){
                /*csm_reg_pasien*/
                $dataexc = array(
                    'csm_rp_no_sep' => $this->regex->_genRegex($val->set_value('no_sep'), 'RGXQSL'),
                    'is_submitted' => $this->regex->_genRegex('Y', 'RGXQSL'),
                );
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
                $exc_qry = $this->db->update('csm_reg_pasien', $dataexc, array('no_registrasi' => $no_registrasi));
                $newId = $no_registrasi;
                $this->logs->save('csm_reg_pasien', $newId, 'update record', json_encode($dataexc));
            }
            
            $type = $this->input->post('form_type');
            $this->db->delete('csm_dokumen_export', array('no_registrasi' => $no_registrasi));
            /*created document name*/
            $createDocument = $this->Csm_billing_pasien->createDocument($no_registrasi, $type);
            //print_r($createDocument);die;
            foreach ($createDocument as $k_cd => $v_cd) {
                # code...
                $explode = explode('-', $v_cd);
                /*explode result*/
                $named = str_replace('BILL','',$explode[0]);
                $no_mr = $explode[1];
                $exp_no_registrasi = $explode[2];
                $unique_code = $explode[3];

                /*create and save download file pdf*/
                if( $this->getContentPDF($exp_no_registrasi, $named, $unique_code, 'F') ) :
                /*save document to database*/
                /*csm_reg_pasien*/
                $filename = $named.'-'.$no_mr.$exp_no_registrasi.$unique_code.'.pdf';
                
                $doc_save = array(
                    'no_registrasi' => $this->regex->_genRegex($exp_no_registrasi, 'RGXQSL'),
                    'csm_dex_nama_dok' => $this->regex->_genRegex($filename, 'RGXQSL'),
                    'csm_dex_jenis_dok' => $this->regex->_genRegex($v_cd, 'RGXQSL'),
                    'csm_dex_fullpath' => $this->regex->_genRegex('uploaded/casemix/'.$filename.'', 'RGXQSL'),
                );
                $doc_save['created_date'] = date('Y-m-d H:i:s');
                $doc_save['created_by'] = $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL');
                /*check if exist*/
                if ( $this->Csm_billing_pasien->checkIfDokExist($exp_no_registrasi, $filename) == FALSE ) {
                    $this->db->insert('csm_dokumen_export', $doc_save);
                }
                endif;
                /*insert database*/
            }
            
            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                echo json_encode(array('status' => 301, 'message' => 'Maaf Proses Gagal Dilakukan'));
            }
            else
            {
                $this->db->trans_commit();
                echo json_encode(array('status' => 200, 'message' => 'Proses Berhasil Dilakukan', 'redirect' => 'casemix/Csm_billing_pasien/mergePDFFiles/'.$no_registrasi.'/'.$type.''));
            }
        }
    }

    /*function for view data only*/
    public function editBilling($no_registrasi, $tipe)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('Edit function', 'Migration/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$no_registrasi);
        /*define data variabel*/
        /*load form view*/
        $view_name = ($tipe=='RJ')?'form_edit':'form_edit_ri';
        $title_name = ($tipe=='RJ')?'Rawat Jalan':'Rawat Inap';
        $data['form_type'] = $tipe;
        $data['value'] = $this->Csm_billing_pasien->get_by_id($no_registrasi);
        $data['title'] = 'Migration '.$title_name.'';
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        //echo '<pre>';print_r($data);die;
        /*get data trans pelayanan by no registrasi from sirs*/
        $sirs_data = json_decode($this->Csm_billing_pasien->getDetailData($no_registrasi));
        //echo '<pre>';print_r($sirs_data);die;
        /*cek apakah data sudah pernah diinsert ke database atau blm*/
        if( $this->Csm_billing_pasien->checkExistingData($no_registrasi) ){
            /*no action if data exist, continue to view data*/
        }else{
        /*jika data belum ada atau belum pernah diinsert, maka insert ke table*/
            /*insert data untuk pertama kali*/
            if( $sirs_data->group && $sirs_data->kasir_data && $sirs_data->trans_data )
            $this->Csm_billing_pasien->insertDataFirstTime($sirs_data, $no_registrasi);
        }

        $dataBilling = $this->getBillingLocal($no_registrasi, $tipe);
       //echo '<pre>';print_r($dataBilling);die;
        $data['reg'] = (count($dataBilling['reg_data']) > 0) ? $dataBilling['reg_data'] : [] ;

        if( $tipe=='RJ' ){
            $group = array();
            foreach ($dataBilling['billing'] as $value) {
                /*group berdasarkan nama jenis tindakan*/
                $group[$value->csm_bp_nama_jenis_tindakan][] = $value;
            }
            $data['group'] = $group;
            $data['resume'] = $dataBilling['resume'];
        }else{
            $data['content_view'] = $this->Csm_billing_pasien->getDetailBillingRI($no_registrasi, $tipe, $sirs_data);
        }
        
        //echo '<pre>';print_r($data);die;
        $this->load->view('Migration/'.$view_name.'', $data);
    }

    public function getBillingLocal($no_registrasi, $tipe){
        return $this->Csm_billing_pasien->getBillingDataLocal($no_registrasi, $tipe);
    }

    
    

    

    public function getDetail($no_registrasi, $tipe){
        
        /*get detail data billing*/
        $data = json_decode($this->Migration->getDetailData($no_registrasi));
        
        /*cek apakah data sudah pernah diinsert ke database atau blm*/
        if( $this->Migration->checkExistingData($no_registrasi) ){
            /*no action if data exist, continue to view data*/
        }else{
        /*jika data belum ada atau belum pernah diinsert, maka insert ke table*/
            /*insert data untuk pertama kali*/
            if( $data->group && $data->kasir_data && $data->trans_data )
            $this->Migration->insertDataFirstTime($data, $no_registrasi);
        }
        //print_r($data);die;
        if($tipe=='RJ'){
            $html = $this->Migration->getDetailBillingRJ($no_registrasi, $tipe, $data);
        }else{
            $html = $this->Migration->getDetailBillingRI($no_registrasi, $tipe, $data);
        }

        echo json_encode(array('html' => $html));
    }

    public function find_data()
    {   
        $output = array(
                        "recordsTotal" => $this->Migration->count_all(),
                        "data" => $_POST,
                );
        echo json_encode($output);
    }

    public function getHtmlData($params, $no_registrasi, $flag, $pm, $rb=''){

        $temp = new Templates;
        /*header html*/
        /*get detail data billing*/
        $data = json_decode($this->Csm_billing_pasien->getDetailData($no_registrasi));
        //echo '<pre>';print_r($data);die;
        $html = '';

        switch ($flag) {
            case 'RJ':
                $html .= $temp->setGlobalHeaderTemplate();
                $html .= $temp->setGlobalProfilePasienTemplate($data);
                $html .= $temp->setGlobalContentBilling($temp->TemplateBillingRJ($no_registrasi, $flag, $data));
                $html .= $temp->setGlobalFooterBilling($data);
                break;
            case 'RI':
                $html .= $temp->setGlobalHeaderTemplate();
                $html .= $temp->setGlobalProfilePasienTemplateRI($data);
                $html .= $temp->setGlobalContentBilling($temp->TemplateBillingRI($no_registrasi, $flag, $data, $rb));
                $html .= $temp->setGlobalFooterBillingRI();

                break;
            case 'RAD':
                $html .= $temp->setGlobalHeaderTemplate();
                $html .= $temp->setGlobalProfilePasienTemplatePM($data, $flag, $pm);
                $html .= $temp->setGlobalContentBilling($temp->TemplateHasilPM($no_registrasi, $flag, $data, $pm));
                $html .= $temp->setGlobalFooterBillingPM($data->reg_data->nama_pegawai, $flag, $pm);
                break;
            case 'LAB':
                $html .= $temp->setGlobalHeaderTemplate();
                $html .= $temp->setGlobalProfilePasienTemplatePM($data, $flag, $pm);
                $html .= $temp->setGlobalContentBilling($temp->TemplateHasilPM($no_registrasi, $flag, $data, $pm));
                $html .= $temp->setGlobalFooterBillingPM($data->reg_data->nama_pegawai, $flag, $pm);
                break;
            
            default:
                # code...
                break;
        }
        
        return json_encode( array('html' => $html, 'data' => $params) );
    }

    public function getRincianBilling($noreg, $tipe, $field){
        $temp = new Templates;
        /*header html*/
        $html = '';
        $html .= $temp->TemplateRincianRI($noreg, $tipe, $field);
        
        echo json_encode(array('html' => $html));
    }

    public function getRincianBillingData($noreg, $tipe, $field){
        $temp = new Templates;
        /*header html*/
        $html = '';
        $html .= $temp->TemplateRincianRI($noreg, $tipe, $field);
         
        return json_encode(array('html' => $html));
    }

    public function getContentPDF($no_registrasi, $flag, $pm, $act_code=''){

      /*get content data*/
      $data = $this->getBillingLocal($no_registrasi, $flag); 
      //echo '<pre>';print_r($data);die;
      /*get content html*/
      $html = json_decode( $this->getHtmlData($data, $no_registrasi, $flag, $pm) );
      
      /*generate pdf*/
      $this->exportPdf($html, $flag, $pm, $act_code); 
      
      return true;

    }

    public function exportPdf($data, $flag, $pm, $act_code='') { 
        //echo '<pre>';print_r($data);die;
        $this->load->library('pdf');
        $reg_data = $data->data->reg_data;

        /*default*/
        $action = ($act_code=='')?'I':$act_code;
        /*filename and title*/
        $filename = $flag.'-'.$reg_data->csm_rp_no_mr.$reg_data->no_registrasi.$pm;

        $tanggal = new Tanggal();
        $pdf = new TCPDF('P', PDF_UNIT, array(470,280), true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        
        $pdf->SetAuthor('Rumah Sakit Setia Mitra');
        $pdf->SetTitle(''.$filename.'');

    // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

    // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT,PDF_MARGIN_BOTTOM);

    // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
    // auto page break //
        $pdf->SetAutoPageBreak(TRUE, 30);

        //set page orientation
        
    // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        
        $pdf->SetFont('helvetica', '', 9);
        $pdf->ln();

        //kotak form
        $pdf->AddPage('P', 'A4');
        //$pdf->setY(10);
        $pdf->setXY(5,20,5,5);
        $pdf->SetMargins(10, 10, 10, 10); 
        /* $pdf->Cell(150,42,'',1);*/
        $html = <<<EOD
        <link rel="stylesheet" href="'.file_get_contents(_BASE_PATH_.'/assets/css/bootstrap.css)'" />
EOD;
        $html .= $data->html;
        $result = $html;

        // output the HTML content
        $pdf->writeHTML($result, true, false, true, false, '');

        /*save to folder*/
        $pdf->Output('uploaded/casemix/'.$filename.'.pdf', ''.$action.''); 

        /*show pdf*/
        //$pdf->Output(''.$reg_data->no_registrasi.'.pdf', 'I'); 
        /*download*/
        //$pdf->Output(''.$reg_data->no_registrasi.'.pdf', 'D'); 
        
    }

    public function mergePDFFiles($no_registrasi, $tipe){
        /*get doc*/

        $reg_data = $this->Csm_billing_pasien->getRegDataLocal($no_registrasi);
        $doc_pdf = $this->Csm_billing_pasien->getDocumentPDF($no_registrasi);
        //echo '<pre>';print_r($doc_pdf);die;
        /*save merged file*/
        $datasaved = array(
            'no_registrasi' => $no_registrasi,
            'tgl_transaksi_kasir' => $reg_data->csm_rp_tgl_keluar,
            'no_sep' => $reg_data->csm_rp_no_sep,
            'csm_dk_filename' => $reg_data->csm_rp_no_sep.'.pdf',
            'csm_dk_fullpath' => 'uploaded/casemix/merge-'.date('M-Y').'/'.$reg_data->csm_rp_no_sep.'.pdf',
            'csm_dk_total_klaim' => $this->Csm_billing_pasien->getTotalBilling($no_registrasi, $tipe),
            'csm_dk_tipe' => $tipe,
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->regex->_genRegex($this->session->userdata('user')->fullname,'RGXQSL')
            );
        print_r($datasaved);die;
        /*check if exist*/
        if( $this->db->get_where('csm_dokumen_klaim', array('no_sep' => $reg_data->csm_rp_no_sep))->num_rows() > 0){
            $this->db->update('csm_dokumen_klaim', $datasaved, array('no_sep' => $reg_data->csm_rp_no_sep));
        }else{
            $this->db->insert('csm_dokumen_klaim', $datasaved);
        }


        $fields_string = "";
        foreach($doc_pdf as $key=>$value) {
            $fields_string .= $value->csm_dex_id.'='.$value->csm_dex_nama_dok.'&sep='.$value->csm_rp_no_sep.'&';
        }

        rtrim($fields_string,'&');
        $url = base_url().'ApiMerge/index.php?action=download&noreg='.$no_registrasi.'&'.$fields_string;
        header("Location:".$url);
    }

}
/* End of file example.php */
/* Location: ./application/functiones/example/controllers/example.php */
