<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export_data extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		/*load model*/
        $this->load->model('Export_data_model', 'export_data_model');
        /*load module*/
        $this->load->module('casemix/Csm_billing_pasien');
        $this->load->module('casemix/Csm_resume_billing');
        $this->load->module('casemix/Csm_resume_billing_ri');
        $this->load->module('casemix/Csm_dokumen_klaim');
	}

	public function export()
	{
    $type               = $this->input->get('type');
    $flag               = $this->input->get('flag');
    $no_registrasi      = $this->input->get('noreg');
    $pm                 = $this->input->get('pm');
    $act_code           = $this->input->get('act');
    $rincian            = $this->input->get('rb');
    //print_r($no_registrasi);die;
		switch ($type) {
			case 'pdf':
				$this->getContentPDF($no_registrasi, $flag, $pm, $act_code);
				break;

			case 'word':
				$this->exportWord();
				break;
			
			default:
				# code...
				break;
		}
	}

    public function getContentPDF($no_registrasi, $flag, $pm, $act_code=''){

      /*load class*/
      $csm_bp = new Csm_billing_pasien;
      /*get content data*/
      $data = $csm_bp->getBillingLocal($no_registrasi, $flag); 
      /*get content html*/
      $html = json_decode($csm_bp->getHtmlData($data, $no_registrasi, $flag, $pm));

       /*generate pdf*/
      $this->exportPdf($html, $flag, $pm, $act_code); 
      

    }

	public function exportPdf($data, $flag, $pm, $act_code='') { 
        
        $this->load->library('pdf');
        
        
        $reg_data = $data->data->reg_data;
        /*default*/
        $action = ($act_code=='')?'I':$act_code;
        /*filename and title*/
        $filename = $reg_data->no_registrasi.'-'.$flag.'-'.$pm;
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
        ob_end_clean();
        /*save to folder*/
        $pdf->Output('uploaded/casemix/'.$filename.'.pdf', ''.$action.''); 

        /*show pdf*/
        //$pdf->Output(''.$reg_data->no_registrasi.'.pdf', 'I'); 
        /*download*/
        //$pdf->Output(''.$reg_data->no_registrasi.'.pdf', 'D'); 
        
    }

    public function exportContent()
    {
        $this->getHtmlDataFromClass($_GET['mod'], $_GET['type']);
    }

    public function getHtmlDataFromClass($class, $type_doc){
        $obj = new $class;
        $data = $obj->get_content_data();
        $html_content = $obj->html_content($data);
        
        switch ($type_doc) {
            case 'pdf':
                # code...
                $this->exportPdfContent($html_content,'L');
                break;
            case 'excel':
                # code...
                $this->exportExcelContent($html_content);
                break;
            
            default:
                # code...
                break;
        }
        

    }


    public function exportPdfContent($html_content, $paper_type) { 
        
        $this->load->library('pdf');
        $pdf = new TCPDF($paper_type, PDF_UNIT, array(470,280), true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        
        $pdf->SetAuthor('Rumah Sakit Setia Mitra');
        $pdf->SetTitle('Content');

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
        $pdf->AddPage($paper_type, 'A4');
        //$pdf->setY(10);
        $pdf->setXY(5,20,5,5);
        $pdf->SetMargins(10, 10, 10, 10); 
        /* $pdf->Cell(150,42,'',1);*/
        $html = <<<EOD
        <link rel="stylesheet" href="'.file_get_contents(_BASE_PATH_.'/assets/css/bootstrap.css)'" />
EOD;
        $html .= $html_content;
        $result = $html;

        // output the HTML content
        $pdf->writeHTML($result, true, false, true, false, '');
        ob_end_clean();

        /*show pdf*/
        $pdf->Output('test.pdf', 'I'); 
        /*download*/
        //$pdf->Output(''.$reg_data->no_registrasi.'.pdf', 'D'); 
        
    }


	public function exportExcelContent($html_content){

        $random = rand(1,9999);
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment;Filename=Export-".date('dMY').'-'.$random.".xls");

        echo "<html>";
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
        echo "<link rel='stylesheet' href='".base_url()."assets/css/bootstrap.css' />";
        echo "<body>";
        echo '<p style="font-size:11px"><b>Exported by system '.date('d/m/Y').'</b></p>';
        echo '<br>';
        echo $html_content;
        
        echo "</body>";
        echo "</html>";
    }

}
