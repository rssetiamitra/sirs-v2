<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templates extends MX_Controller {

	/**
	 *
	 * This is the Modular Template controller. Pass a data object here and it loads the data into view templates.
	 * This controller is called from the templates.php library.
	 *
	 * It can also be loaded as a module using:
	 * $this->load->module('templates');
	 * making the method and its functions available:
	 * $this->templates->index($data);
	 * *note: requires index function explicitly
	 *
	 * It can also be run as a module using:
	 * echo Modules::run('templates', $data);
	 * *note: requires data['body'] be defined.
 	 */

	function __construct() {
        parent::__construct();
        $this->load->model('templates_model', 'templates_model');
        $this->load->model('casemix/Csm_billing_pasien_model', 'Csm_billing_pasien');
    }


	public function index($data, $template_name = null)
	{
        $this->load->library('master');
        $this->load->library('lib_menus');
        //echo '<pre>';print_r($this->session->all_userdata());die;
		/*
		|
		| If $data['body'] is null then we will get the content from the
		| module's default view file, which is <module_name>_view.php
		| within the application/modules/<module_name>/views directory
		|
		*/

		if ( ! array_key_exists('body', $data) )
		{		
      // We get the name of the class that called this method so we
      // can get its view file.
			$caller = debug_backtrace();
			$caller_module = $caller[1]['class'];

			// Get the default view file for the module and return as a string.
    	$data['body'] = $this->load->view(ucfirst($caller_module).'/'.strtolower($caller_module).'_view', $data, TRUE);
		}
		
		if ( ! isset($template_name) )
		{
      // If there is no template name parameter passed, we just use the default.
			$template_name = 'default';
		}
		
	    // With the $data['body'] we now can load the template views.
	    // Note that currently there is no value included to specify any
	    // header or footer file other than default.

	    /*get menu by session role user*/
		$data['menu'] = $this->lib_menus->get_menus($this->session->userdata('user')->user_id, $_GET['mod']);
		$data['app'] = $this->db->get_where('tmp_profile_app', array('id' => 1))->row();
		$data['module'] = $this->db->get_where('tmp_mst_modul', array('modul_id' => $_GET['mod']))->row();
		//$data['graph'] = $this->master->get_graph_data();
		//$data['graph_polling'] = $this->master->get_graph_polling();
		//print_r($data['graph']);die;
		$this->load->view('templates/content_view', $data);

	}

	public function setGlobalHeaderTemplate(){
		$html = '';
		$html .= '<table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr><td align ="left" colspan="2"><b>RS Setia Mitra</b>&nbsp;</td></tr>
                    <tr><td align ="left" colspan="2">Jl. RS. Fatmawati No. 80 - 82&nbsp;Jakarta Selatan&nbsp;</td></tr>
                    <tr><td align ="left" colspan="2">Telp:&nbsp;(021) 7656000&nbsp;(Hunting)&nbsp;Fax:&nbsp;(021) 7656875&nbsp;</td></tr>
                    <tr><td align ="left" colspan="2">&nbsp;</td></tr>
                  </table>';
        return $html;
	}

	public function setGlobalProfilePasienTemplate($data, $flag='', $pm=''){
		$html = '';
		$html .= '<table class="table table-striped" width="100%" cellpadding="0" cellspacing="0" border="0">
		 			 
                    <tr>
	                    <td colspan="2" align="center" width="300px"><b>RINCIAN BIAYA PASIEN</b><br></td>
                    </tr> 
                    <tr>
                    	<td width="100px">Tanggal</td>
                    	<td align="left" width="200px">: '.$this->tanggal->formatDate($data->reg_data->tgl_jam_masuk).'</td>
                    </tr>
                    <tr>
                    	<td width="100px">No. RM</td>
                    	<td width="200px">: '.$data->reg_data->no_mr.'</td>
                    </tr>
                    <tr>
                    	<td width="100px" align="left">Nama Pasien</td>
                    	<td width="200px">: '.$data->reg_data->nama_pasien.'</td>
                    </tr>
                    <tr>
	                    <td width="100px">Nama Dokter</td>
	                    <td width="200px">: '.$data->reg_data->nama_pegawai.'</td>
                    </tr> 
                   
                  </table>';
        return $html;
	}

    public function setGlobalProfilePasienTemplateRI($data, $flag='', $pm=''){
        $html = '';
        $jk = ($data->reg_data->jk == 'L')?'Pria':'Wanita';
        $html .= '<table align="left" cellpadding="0" cellspacing="0" border="0">
                     <tr>
                        <td width="100px">No. RM</td>
                        <td width="300px">: '.$data->reg_data->no_mr.'</td>
                        <td width="120px">No. Registrasi</td>
                        <td width="300px">: '.$data->reg_data->no_registrasi.'</td>
                    </tr>
                    <tr>
                        <td width="100px" align="left">Nama Pasien</td>
                        <td width="300px">: '.$data->reg_data->nama_pasien.'</td>
                        <td width="120px">Dokter Pengirim</td>
                        <td width="300px">: '.$data->reg_data->nama_pegawai.'</td>
                    </tr>
                    <tr>
                        <td width="100px">Umur</td>
                        <td width="300px">: '.$data->reg_data->umur.' Tahun</td>
                        <td width="120px">Tanggal Masuk</td>
                        <td align="left" width="300px">: '.$this->tanggal->formatDate($data->reg_data->tgl_jam_masuk).'</td>
                        
                    </tr>

                    <tr>
                        <td width="100px">Jenis Kelamin</td>
                        <td width="300px">: '.$jk.'</td>
                        <td width="120px">Tanggal Keluar</td>
                        <td width="300px">: '.$this->tanggal->formatDate($data->reg_data->tgl_jam_keluar).'</td>
                    </tr>                    
                  </table>';
        return $html;
    }

	public function setGlobalContentBilling($html){
        return $html;
	}

    public function TemplateBillingRJ($no_registrasi, $tipe, $data){
        /*html data untuk tampilan*/
        $html = '';
        $html .= '<table class="table table-striped">';
        $html .= '<tr>';
            $html .= '<th coslpan="2" align="center">&nbsp;</th>';
        $html .= '</tr>'; 
        $html .= '<tr>';
            $html .= '<th width="200px" align="center"><b>URAIAN</b></th>';
            $html .= '<th width="100px" align="right"><b>SUBTOTAL (Rp.)</b></th>';
        $html .= '</tr>'; 
        $html .= '<tr>';
            $html .= '<th coslpan="2" align="center"><hr></th>';
            $html .= '<th coslpan="2" align="center"><hr></th>';
        $html .= '</tr>'; 
        $sum_subtotal = array();
        $no=1;
        foreach ($data->group as $k => $val) {
            $html .= '<tr>';
            $html .= '<td><b>'.$k.'</b></td>';
            $html .= '<td align="right"></td>';
            $html .= '</tr>';
            $no++; 

            foreach ($val as $value_data) {
                $subtotal = (double)$value_data->bill_rs + (double)$value_data->bill_dr1 + (double)$value_data->bill_dr2 + (double)$value_data->lain_lain;
                $html .= '<tr>';
                $html .= '<td>'.$value_data->nama_tindakan.'</td>';
                $html .= '<td align="right">Rp. '.number_format($subtotal).',-</td>';
                $html .= '</tr>';
                /*total*/
                $sum_subtotal[] = $subtotal;
                /*resume billing*/
                $resume_billing[] = $this->Csm_billing_pasien->resumeBillingRJ($value_data->jenis_tindakan, $value_data->kode_bagian, $subtotal);
            }        
        }
        $html .= '<tr>';
            $html .= '<td colspan="1" align="right"><b>TOTAL</b></td>';
            $html .= '<td width="100px" align="right"><b>Rp. '.number_format(array_sum($sum_subtotal)).',-</b></td>';
        $html .= '</tr>';   
        $html .= '</table>';


        return $html;
    }

    public function TemplateRincianRI($noreg, $tipe, $field){
        $title_name = $this->Csm_billing_pasien->getTitleNameBilling($field);
        $rincian_detail_billing = $this->Csm_billing_pasien->getDetailData($noreg, $tipe, $field);
        $data = json_decode($rincian_detail_billing);
        $needle = array('bill_tindakan_inap','bill_tindakan_oksigen','bill_tindakan_bedah','bill_tindakan_vk','bill_obat','bill_dokter','bill_apotik','bill_lain_lain','bill_ugd','bill_rad','bill_lab','bill_fisio','bill_klinik','bill_pemakaian_alat',
            );
        if(in_array($field, $needle)){
            $html_dokter = '<th width="20%">Dokter</th>';
            $colspan = 4;
            $percent = 30;
        }else{
            $html_dokter = '';
            $colspan = 3;
            $percent = 50;
        }

        $html = '';
        $html .= '<br><div align="center" width="100%"><p><b>RINCIAN BIAYA '.strtoupper($title_name).'</b></p></div>';
        $html .= '<table class="table table-striped" width="100%">';
        $html .= '<tr>';
            $html .= '<th width="5%" align="center">No</th>';
            $html .= '<th width="20%">Tanggal</th>';
            $html .= '<th width="'.$percent.'%">Keterangan</th>';
            $html .= $html_dokter;
            $html .= '<th width="25%" class="center">Biaya (Rp.)</th>';
        $html .= '</tr>'; 
        $no = 0;
        $arr_subtotal = array();
        foreach ($data->group as $k => $val) {
            foreach ($val as $value_data) {
                
                /*check resume*/
                $resume = $this->Csm_billing_pasien->getKodeTransPelayanan($val, $field);
                /*array search kode tc_trans_pelayanan*/
                $array_search = $this->Csm_billing_pasien->arraySearchResume($resume, $field);
                //echo '<pre>';print_r($array_search);die;
                if(in_array($value_data->kode_trans_pelayanan, $array_search)){
                    $no++;
                    $subtotal = (double)$value_data->bill_rs + (double)$value_data->bill_dr1 + (double)$value_data->bill_dr2 + (double)$value_data->lain_lain;
                    $html .= '<tr>';
                    $html .= '<td width="5%" align="center">'.$no.'</td>';
                    $html .= '<td width="20%">'.$this->tanggal->formatDate($value_data->tgl_transaksi).'</td>';
                    $html .= '<td width="'.$percent.'%">'.$value_data->nama_tindakan.'</td>';
                    if(in_array($field, $needle)){
                        $html .= '<td width="20%">'.$value_data->nama_dokter.'</td>';
                    }
                    $html .= '<td width="20%" align="right">'.number_format($subtotal).',-</td>';
                    $html .= '</tr>';
                    $arr_subtotal[] = $subtotal;
                }
            }        
        }
                    $html .= '<tr>';
                    $html .= '<td colspan="'.$colspan.'" align="right"><b>Total Biaya (Rp.)</b></td>';
                    $html .= '<td align="right"><b>Rp. '.number_format(array_sum($arr_subtotal)).',-</b></td>';
                    $html .= '</tr>';
        $html .= '</table>'; 

       
        return $html;
    }

     public function TemplateRincianRIData($noreg, $tipe, $field){
        $title_name = $this->Csm_billing_pasien->getTitleNameBilling($field);
        $rincian_detail_billing = $this->Csm_billing_pasien->getDetailData($noreg, $tipe, $field);
        $data = json_decode($rincian_detail_billing);
        $needle = array('bill_tindakan_inap','bill_tindakan_oksigen','bill_tindakan_bedah','bill_tindakan_vk','bill_obat','bill_dokter','bill_apotik','bill_lain_lain','bill_ugd','bill_rad','bill_lab','bill_fisio','bill_klinik','bill_pemakaian_alat',
            );
        if(in_array($field, $needle)){
            $html_dokter = '<th width="20%">Dokter</th>';
            $colspan = 4;
            $percent = 30;
        }else{
            $html_dokter = '';
            $colspan = 3;
            $percent = 50;
        }

        $html = '';
        $no = 0;
        $arr_subtotal = array();
        foreach ($data->group as $k => $val) {
            foreach ($val as $value_data) {
                
                /*check resume*/
                $resume = $this->Csm_billing_pasien->getKodeTransPelayanan($val, $field);
                /*array search kode tc_trans_pelayanan*/
                $array_search = $this->Csm_billing_pasien->arraySearchResume($resume, $field);
                //echo '<pre>';print_r($array_search);die;
                if(in_array($value_data->kode_trans_pelayanan, $array_search)){
                    $no++;
                    $subtotal = (double)$value_data->bill_rs + (double)$value_data->bill_dr1 + (double)$value_data->bill_dr2 + (double)$value_data->lain_lain;
                    $getData[] = array('tanggal' => $this->tanggal->formatDate($value_data->tgl_transaksi), 'tindakan' => $value_data->nama_tindakan, 'dokter' => $value_data->nama_dokter, 'subtotal' => $subtotal);
                }
            }        
        }
                
       
        return $getData;
    }
    public function TemplateBillingRI( $no_registrasi, $tipe, $data, $rb='' ){
        $csm_bp = new Csm_billing_pasien_model;
        /*html data untuk tampilan*/
        $dataRI = $this->Csm_billing_pasien->getDataRI($no_registrasi);
        
        $no=1;
        foreach ($data->group as $k => $val) {
            foreach ($val as $value_data) {
                $subtotal = (double)$value_data->bill_rs + (double)$value_data->bill_dr1 + (double)$value_data->bill_dr2 + (double)$value_data->lain_lain;
                $resume_billing[] = $this->Csm_billing_pasien->resumeBillingRI($value_data);
            }        
        }
        /*split resume billing*/
        $split_billing = $this->Csm_billing_pasien->splitResumeBillingRI($resume_billing);

        $html = '';
        if( $rb == '') :

        /*html data untuk tampilan*/
        $html .= '<div align="center"><b>RINCIAN BIAYA KESELURUHAN PASIEN RAWAT INAP</b></div>';
        $html .= '<table class="table table-striped">';
        $html .= '<hr>';
        $html .= '<tr>';
            $html .= '<th width="7%" align="center"><b>NO</b></th>';
            $html .= '<th width="78%"><b>URAIAN</b></th>';
            $html .= '<th width="15%" align="center"><b>SUBTOTAL (Rp.)</b></th>';
        $html .= '</tr>'; 
        //echo '<pre>';print_r($split_billing);die;
        foreach ($split_billing as $k => $val) {
            /*total*/
            if((int)$val['subtotal'] > 0){
                $sum_subtotal[] = $val['subtotal'];
                $html .= '<tr>';
                $html .= '<td width="7%" align="center"><b>'.$no.'</b></td>';
                $html .= '<td width="63%"><b>'.strtoupper($val['title']).'</b></td>';
                $html .= '<td width="30%" align="right">&nbsp;</td>';
                $html .= '<td width="20%" align="right">&nbsp;</td>';
                $html .= '</tr>';
                $no++;
                /*rincian biaya*/
                $rincian_billing_ri =  $this->TemplateRincianRIData($no_registrasi, $tipe, $val['field']);
                //echo '<pre>';print_r($rincian);die;
                foreach ($rincian_billing_ri as $key_rincian_billing_ri => $value_rincian_billing_ri) {
                    $html .= '<tr>';
                    $html .= '<td width="7%" align="center"></td>';
                    $html .= '<td width="33%">'.$value_rincian_billing_ri['tindakan'].'</td>';
                    $html .= '<td width="10%">'.$value_rincian_billing_ri['tanggal'].'</td>';
                    $html .= '<td width="30%">'.$value_rincian_billing_ri['dokter'].'</td>';
                    $html .= '<td width="20%" align="right">'.number_format($value_rincian_billing_ri['subtotal']).'</td>';
                    $html .= '<td width="30%" align="right">&nbsp;</td>';
                    $html .= '</tr>';
                    $subtotal_rincian[] = $value_rincian_billing_ri['subtotal'];
                }
                /*subtotal rincian*/
                    $html .= '<tr>';
                    $html .= '<td width="7%" align="center"></td>';
                    $html .= '<td width="33%">&nbsp;</td>';
                    $html .= '<td width="15%">&nbsp;</td>';
                    $html .= '<td width="15%">&nbsp;</td>';
                    $html .= '<td width="30%" align="right"><b><i>Subtotal</i>&nbsp;&nbsp;&nbsp;'.number_format(array_sum($subtotal_rincian)).' </b></td>';
                    $html .= '<td width="30%" align="right">&nbsp;</td>';
                    $html .= '</tr>';

               

            }
        }
        /*biaya materai*/
        $html .= '<tr>';
                $html .= '<td width="7%" align="center"><b>'.$no.'</b></td>';
                $html .= '<td width="83%"><b>MATERAI</b></td>';
                $html .= '<td width="10% " align="right"><b>6,000</b></td>';
                $html .= '</tr>';
        $html .= '<hr>';

        $total_plus_materai = array_sum($sum_subtotal) + 6000;
        $html .= '<tr>';
            $html .= '<td colspan="2" width="79%" align="right"><b>TOTAL</b></td>';
            $html .= '<td width="21%" align="right"><b>Rp. '.number_format($total_plus_materai).'</b></td>';
        $html .= '</tr>';   
        $html .= '</table>';

        else :
            $content_rincian = $csm_bp->getRincianBillingData($no_registrasi, $tipe, $rb);
            $decode = json_decode($content_rincian);
            $content_html = $decode->html;
            $html .= $content_html;
        endif;
        //print_r($html);die;
        return $html;
    }

    public function TemplateHasilPM($no_registrasi, $tipe, $data, $pm){
        /*html data untuk tampilan*/
        /*get data hasil penunjang medis*/
        $pm_data = $this->Csm_billing_pasien->getHasilLab($data->reg_data, $pm);
        //echo '<pre>';print_r($pm_data);die;
        $html = '';
        if($tipe=='RAD'){
            $html .= '<br><table class="table table-striped table-bordered" cellpadding="2" cellspacing="2" border="0">
                    <tr>
                        <td colspan="4" align="center"><b>HASIL PEMERIKSAAN RADIOLOGI</b></td>
                    </tr> 
                    <hr>
                    <tr>
                        <th width="30px" align="center"><b>NO</b></th>
                        <th><b>JENIS PEMERIKSAAN</b></th>
                        <th><b>HASIL</b></th>
                        <th><b>KESAN</b></th>
                        <th><b>KETERANGAN</b></th>
                    </tr>
                    <hr>';
                    $no=0;
                    foreach ($pm_data as $key => $value) {
                        $no++;
                        $html .= '<tr>
                                    <td width="30px" align="center">'.$no.'</td>
                                    <td>'.$value->nama_pemeriksaan.'</td>
                                    <td><p style="text-align:justify">'.nl2br($value->hasil).'</p></td>
                                    <td><p style="text-align:justify">'.nl2br($value->keterangan).'</p></td>
                                    <td></td>
                                  </tr>';
                    }
            
            $html .= '</table><br><br>';

            $html .= '<b>Catatan : </b><br><br>';
        }elseif ($tipe=='LAB') {
           
            //echo '<pre>';print_r($pm_data);die;
            $html .= '<br><table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td colspan="5" align="center"><b>HASIL PEMERIKSAAN LABORATORIUM</b></td>
                    </tr> 
                    <hr>
                    <tr>
                        <th width="30px" align="center"><b>No</b></th>
                        <th width="230px"><b>JENIS TEST</b></th>
                        <th align="center" width="80px"><b>HASIL</b></th>
                        <th align="center" width="100px"><b>NILAI STANDAR</b></th>
                        <th align="center" width="80px"><b>SATUAN</b></th>
                        <th width="100px"><b>KETERANGAN</b></th>
                    </tr>
                    <hr>';
            $no=0;
            if(count($pm_data) > 0){
                foreach ($pm_data as $key => $value) {
                    $no++;
                    $standar = ($data->reg_data->jk == 'L') ? $value->standar_hasil_pria : $value->standar_hasil_wanita;
                    $html .= '<tr>
                                <td align="center">'.$no.'</td>
                                <td>'.$value->nama_pemeriksaan.' - '.$value->nama_tindakan.'</td>
                                <td align="center">'.$value->hasil.'</td>
                                <td align="center">'.str_replace(array('>','<'), array('&rsaquo;','&lsaquo;'), $standar).'</td>
                                <td align="center">'.$value->satuan.'</td>
                                <td><br>'.$value->keterangan.'</td>
                             </tr>';
                }
            }
            
            
            $html .= '</table><br><br>';
            $html .= '<br><br><b>Catatan : </b><br><br>';
        }
        

        return $html;
    }

    public function setGlobalFooterBillingPM($nama_dokter, $flag='', $pm=''){
        $html = '';
        if($flag=='RAD'){
            $html .= '<table border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td align="right" width="70%"></td>
                        <td align="center" width="30%">
                        <br><br>
                        Nama Dokter Radiologi<br>
                        Rumah Sakit Setia Mitra
                        <br/><br/><br/> 
                        <br/> 
                        ( '.$this->Csm_billing_pasien->getNamaDokter($flag, $pm).' )<br>
                        Generated by averin system ('.date('d/M/Y').')
                        </td>   
                    </tr>
                </table>';
            }elseif ($flag=='LAB') {
                $html .= '<table border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                        <td align="center" width="30%">
                        <br><br>
                        Penanggung Jawab<br>
                        <br/><br/><br/> 
                        <br/> 
                        ( '.$nama_dokter.' )
                        </td>
                        <td align="center" width="40%">&nbsp;</td>
                        <td align="center" width="30%">
                        <br><br>
                        Petugas Laboratorium<br>
                        Rumah Sakit Setia Mitra
                        <br/><br/><br/> 
                        <br/> 
                        ______________________________<br><br>
                        Generated by averin system ('.date('d/M/Y').')
                        </td>   
                    </tr>
                </table>';
            }
        
        return $html;
    }   

    public function setGlobalFooterBilling($data){
        $html = '';
        $html .= '<table width="100%" border="1" cellspacing="0" cellpadding="0" border="0">
                    <tr> 
                        <td align="right" width="300px">
                        <br><br>
                        Jakarta,&nbsp;'.$this->tanggal->formatDate($data->reg_data->tgl_jam_masuk).'<br>
                        Rumah Sakit Setia Mitra
                        <br/><br/><br/><br/> 
                        <br/> 
                        ( _____________________ )<br>
                        Generated by averin system ('.date('d/M/Y').')
                        
                        </td>   
                    </tr>
                </table>';
        return $html;
    }

    public function setGlobalFooterBillingRI(){
        $html = '';
        $html .= '<br><br><br><table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr> 
                        <td align="center" width="30%">&nbsp;</td>
                        <td align="center" width="30%">&nbsp;</td>
                        <td align="center" width="40%">
                        <br><br>
                        Jakarta,&nbsp;'.$this->tanggal->formatDate(date('Y-m-d')).'<br>
                        Rumah Sakit Setia Mitra
                        <br/><br/><br/><br/> 
                        <br/> 
                        ( ______________________________ )<br>
                        Generated by averin system ('.date('d/M/Y').')
                        
                        </td>   
                    </tr>
                </table>';
        return $html;
    }

    public function setGlobalProfilePasienTemplatePM($data, $flag, $pm){
        $html = '';
        $jk = ($data->reg_data->jk == 'L')?'Pria':'Wanita';
        $html .= '<table align="left" cellpadding="0" cellspacing="0" border="0">
                     <tr>
                        <td width="100px">No. RM</td>
                        <td width="200px">: '.$data->reg_data->no_mr.'</td>
                        <td width="120px">No. Penunjang</td>
                        <td width="200px">: '.$pm.'</td>
                    </tr>
                    <tr>
                        <td width="100px" align="left">Nama Pasien</td>
                        <td width="200px">: '.$data->reg_data->nama_pasien.'</td>
                        <td width="120px">Dokter Pengirim</td>
                        <td width="200px">: '.$data->reg_data->nama_pegawai.'</td>
                    </tr>
                    <tr>
                        <td width="100px">Umur</td>
                        <td width="200px">: '.$data->reg_data->umur.' Tahun</td>
                        <td width="120px">Tanggal Pendaftaran</td>
                        <td align="left" width="200px">: '.$this->tanggal->formatDate($data->reg_data->tgl_jam_masuk).'</td>
                        
                    </tr>

                    <tr>
                        <td width="100px">Jenis Kelamin</td>
                        <td width="200px">: '.$jk.'</td>
                        <td width="120px">Tanggal Pemeriksaan</td>
                        <td width="200px">: '.$this->tanggal->formatDate($data->reg_data->tgl_jam_masuk).'</td>
                    </tr>                    
                  </table>';
        
        return $html;
    }

    public function export_tp_pdf($exp_no_registrasi, $tipe, $unique_code, $act_code){
        
        $this->Export_data->getContentPDF($exp_no_registrasi, $tipe, $unique_code, $act_code);
        return true;
    }


}

/* End of file templates.php */
/* Location: ./application/modules/templates/controllers/templates.php */