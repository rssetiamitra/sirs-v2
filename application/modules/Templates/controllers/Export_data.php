<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export_data extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		/*load model*/
    $this->load->model('Export_data_model', 'export_data_model');
	}

	public function export()
	{
		$type = $this->input->get('type');
		switch ($type) {
			case 'pdf':
				$this->exportPdf();
				break;

			case 'word':
				$this->exportWord();
				break;
			
			default:
				# code...
				break;
		}
	}

	public function get_html_data(){

    $list = $this->export_data_model->get_data();
    //echo '<pre>';print_r($list);die;
		$html  = '<table border="1" class="table table-striped table-bordered table-hover">';
    $html .= '<thead>';
    $html .= '<tr>';  
    $html .= '<th align="center" width="30px"> No </th>';
    $html .= '<th align="center"> Tanggal dan Nomor Registrasi</th>';
    $html .= '<th> Pengadu</th>';
    $html .= '<th> Teradu</th>';
    $html .= '<th> Nomor dan Tanggal Pengaduan</th>';
    $html .= '<th> Nama Pengkaji <br>dan Tanggal Pengkajian</th>';
    $html .= '<th> Pokok Pengaduan</th>';
    $html .= '<th> Alat Bukti</th>';
    $html .= '<th> Rekomendasi Pengkaji</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    
    /*loop data*/
    $no = 1; 
    foreach ($list as $key => $row_list) {
      # code...
      $html .= '<tr>';
      $html .= '<td align="center" width="30px">'.$no.'</td>';
      $html .= '<td>REG.ID '.$row_list->pgd_id.' Tanggal '.$this->tanggal->formatDateForm($row_list->pgd_tanggal).'</td>';
      /*pengadu*/
      $html_plp = '';
      if ($row_list->pl_pengadu != NULL) {
          $exp_png = explode('#', $row_list->pl_pengadu);
          $html_plp .= '<ol>';
          foreach ($exp_png as $plp => $val_plp) {
              if($val_plp != ''){
                  $html_plp .= '<li>'.$val_plp.'</li>';
              }
          }
          $html_plp .= '</ol>';
      }

      $html .= '<td>'.$html_plp.'</td>';

      /*teradu*/
            $html_plt = '';
            if ($row_list->pl_teradu != NULL) {
                $exp_png = explode('#', $row_list->pl_teradu);
                $html_plt .= '<ol>';
                foreach ($exp_png as $plp => $val_plt) {
                    if($val_plt != ''){
                        $html_plt .= '<li>'.$val_plt.'</li>';
                    }
                }
                $html_plt .= '</ol>';
            }

      $html .= '<td>'.$html_plt.'</td>';
      $html .= '<td>Nomor pengaduan '.$row_list->pgd_no.' Tanggal '.$row_list->pgd_tanggal.'</td>';
      $html .= '<td>'.$no.'</td>';
      $html .= '<td>'.$no.'</td>';

      /*bukti*/
            $html_plb = '';
            if ($row_list->pl_bukti != NULL) {
                $exp_bkt = explode('#', $row_list->pl_bukti);
                $html_plb .= '<ol>';
                foreach ($exp_bkt as $plb => $val_plb) {
                    if($val_plb != ''){
                        $html_plb .= '<li>'.$val_plb.'</li>';
                    }
                }
                $html_plb .= '</ol>';
            }

      $html .= '<td>'.$html_plb.'</td>';
      $html .= '<td>'.$no.'</td>';
      $html .= '</tr>';
      $no++; 
    }
    /*end loop data*/
    
    $html .= '</tbody>';
    $html .= '</table>';

    return $html;
	}

	public function exportPdf($data) { 
        
        $this->load->library('pdf');
        $tanggal = new Tanggal();
        $pdf = new TCPDF('L', PDF_UNIT, array(320,230), true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        
        $pdf->SetAuthor('DKPP RI');
        $pdf->SetTitle('Title');

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
        
        $pdf->SetFont('helvetica', '', 10);
        $pdf->ln();

        //kotak form
        $pdf->AddPage('L', 'Legal');
        //$pdf->setY(10);
        $pdf->setXY(5,20,5,5);
        $pdf->SetMargins(10, 10, 10, 10); 
        /* $pdf->Cell(150,42,'',1);*/
        $html = <<<EOD
		<link rel="stylesheet" href="'.file_get_contents(_BASE_PATH_.'/assets/css/bootstrap.css)'" />
EOD;
        $html .= $this->get_html_data();

        $result = $html;

        // output the HTML content
        $pdf->writeHTML($result, true, false, true, false, '');
            
        ob_end_clean();
        $pdf->Output('EXPORT_PDF.pdf', 'I'); 
        

  }

  public function get_html_data_sidasimadu(){

    $list = $this->export_data_model->get_data_sidasimadu();
    //echo '<pre>';print_r($list);die;
    $html = '<center><h4>Hasil Verifikasi Materil Pengaduan</h4></center>';
    $html  .= '<table border="1" class="table table-striped table-bordered table-hover">';
    $html .= '<thead>';
    $html .= '<tr style="background-color:#9ca0a2; font-weight:bold">';  
    $html .= '<th align="center" width="50px"> No </th>';
    $html .= '<th> Teradu</th>';
    $html .= '<th> Pengadu</th>';
    $html .= '<th align="center"> Nomor dan Tanggal Pengaduan</th>';
    $html .= '<th align="center"> Pokok Perkara</th>';
    $html .= '<th> Pengkaji </th>';
    $html .= '<th> Alat Bukti</th>';
    $html .= '<th align="center"> Rekomendasi Pengkaji </th>';
    $html .= '<th> Keterangan </th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    
    /*loop data*/
    $no = 1; 
    foreach ($list as $key => $row_list) {
      # code...
      $html .= '<tr>';
      $html .= '<td align="center" width="30px" style="text-align:top">'.$no.'</td>';
      /*teradu*/
            $html_plt = '';
            if ($row_list->sdmd_teradu != NULL) {
                $exp_png = explode('#', $row_list->sdmd_teradu);
                $html_plt .= '<ol>';
                foreach ($exp_png as $plp => $val_plt) {
                    if($val_plt != ''){
                        $html_plt .= '<li style="padding-left:-10px">'.$val_plt.'</li>';
                    }
                }
                $html_plt .= '</ol>';
            }

      $html .= '<td style="text-align:top">'.$html_plt.'</td>';

       /*pengadu*/
      $html_plp = '';
      if ($row_list->sdmd_pengadu != NULL) {
          $exp_png = explode('#', $row_list->sdmd_pengadu);
          $html_plp .= '<ol>';
          foreach ($exp_png as $plp => $val_plp) {
              if($val_plp != ''){
                  $html_plp .= '<li style="padding-left:-10px">'.$val_plp.'</li>';
              }
          }
          $html_plp .= '</ol>';
      }

      $html .= '<td style="text-align:top">'.$html_plp.'</td>';


      
      $html .= '<td style="text-align:top">Nomor pengaduan '.$row_list->sdmd_format_nomor.' Tanggal '.$row_list->sdmd_tanggal_pengaduan.'</td>';
      
      $html .= '<td style="text-align:top; align:center"> <p align="justify">'.$row_list->sdmd_pokok_pengaduan.'</p></td>';
      $html .= '<td align="center">'.$row_list->sdmd_pengkaji_name.'</td>';


      /*bukti*/
      $html_plb = '';
      if ($row_list->sdmd_bukti != NULL) {
          $exp_bkt = explode('#', $row_list->sdmd_bukti);
          $html_plb .= '<ol>';
          foreach ($exp_bkt as $plb => $val_plb) {
              if($val_plb != ''){
                  $html_plb .= '<li style="padding-left:-10px">'.$val_plb.'</li>';
              }
          }
          $html_plb .= '</ol>';
      }

      $html .= '<td style="text-align:top">'.$html_plb.'</td>';

      $html .= '<td style="text-align:top">'.$row_list->rekomendasi_pengkaji.'</td>';
      $html .= '<td style="text-align:top">'.$row_list->jp_name.'</td>';
      
      $html .= '</tr>';
      $no++; 
    }
    /*end loop data*/
    
    $html .= '</tbody>';
    $html .= '</table>';

    return $html;
  }


	public function exportWord(){
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=EXPORT_DATA_".date('d-m-Y').".doc");    
    echo "<html>";
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
    echo "<link rel='stylesheet' href='".base_url()."assets/css/bootstrap.css' />";
    echo "<body>";

    if($_GET['module']=='sidasimadu'){
      echo $this->get_html_data_sidasimadu();
    }else{
      echo $this->get_html_data();
    }

    echo "</body>";
    echo "</html>";
  }

}
