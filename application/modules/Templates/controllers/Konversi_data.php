<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Konversi_data extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'Templates/konversi_data');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'login');exit;
        }
        /*load model*/
        $this->load->model('konversi_data_model', 'konversi_data');

        /*load module*/
        //$this->load->module('Reference/Regional/provinces');
        $this->load->model('Reference/regional/provinces_model');

       //$this->load->module('Reference/regional/Districts');
        $this->load->model('Reference/regional/districts_model');

        //$this->load->module('Reference/regional/Regencies');
        $this->load->model('Reference/regional/regencies_model');

        //$this->load->module('Reference/regional/Villages');
        $this->load->model('Reference/regional/villages_model');

        /*enable profiler*/
        $this->output->enable_profiler(false);

    }

    public function index() {
        /*define variable data*/
        $data = array(
            'title' => 'Konversi Data',
            'breadcrumbs' => $this->breadcrumbs->show(),
            'graph' => $this->konversi_data->get_graph_data()
        );

        /*load view index*/
        $this->load->view('Konversi_data/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit Konversi Data', 'Templates/konversi_data/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->konversi_data->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add Konversi Data', 'Templates/konversi_data/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = "Konversi Data";
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/

        /*load module attachment*/
        $this->load->module('Templates/attachment');
        /*load attachment*/
        $data['attachment'] = $this->attachment->get_attachment(array('ref_id'=>$id, 'ref_table'=>'mc_pengaduan'));

        $this->load->view('Konversi_data/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*load module attachment*/
        $this->load->module('Templates/attachment');
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View Konversi Data', 'Templates/konversi_data/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->konversi_data->get_by_id($id);
        $data['attachment'] = $this->attachment->get_attachment(array('ref_id'=>$id, 'ref_table'=>'mc_pengaduan'));
        $data['title'] = "Konversi Data";
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        /*echo '<pre>';print_r($this->db->last_query());die;*/
        $this->load->view('Konversi_data/form', $data);
    }

    public function formulir($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('Formulir Pengaduan', 'Templates/konversi_data/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->konversi_data->get_by_id($id);
        /*print_r($this->db->last_query());die;*/
        $data['title'] = "Konversi Data";
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/

        //echo '<pre>';print_r($data['value']);die;
        $this->load->view('Konversi_data/formulir', $data);
    }

    public function get_data()
    {
        /*get data from model*/
        $list = $this->konversi_data->get_datatables();
        $data = array();
        $no = $_POST['start'];
        //echo '<pre>';print_r($list);die;
        foreach ($list as $row_list) {
            
            $btn_u_d = ''.$this->authuser->show_button('Templates/konversi_data','U',$row_list->pgd_id,2).'
                    '.$this->authuser->show_button('Templates/konversi_data','D',$row_list->pgd_id,2).'';
            $form_checkbox = '<div class="center"><label class="pos-rel">
                    <input type="checkbox" class="ace" name="selected_id[]" value="'.$row_list->pgd_id.'"/>
                    <span class="lbl"></span>
                </label></div>';
            
            $no++;
            $row = array();

            $row[] = $form_checkbox;
            $row[] = 'REG.ID '.$row_list->pgd_id.' Tanggal '.$this->tanggal->formatDateForm($row_list->pgd_tanggal).'';

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

            /*pengadu*/
            $html_pls = '';
            if ($row_list->pl_kuasa != NULL) {
                $exp_psk = explode('#', $row_list->pl_kuasa);
                $html_pls .= '<ol>';
                foreach ($exp_psk as $pls => $val_pls) {
                    if($val_pls != ''){
                        $html_pls .= '<li>'.$val_pls.'</li>';
                    }
                }
                $html_pls .= '</ol>';
            }

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

            $row[] = $html_plp.'<br>Kuasa : <br>'.$html_pls;
            $row[] = $html_plt;
            $row[] = '<div class="left">'.$row_list->pl_asal_pengaduan.'</div>';
            $row[] = $row_list->tp_name;
            $row[] = $row_list->kp_name;
            
            $row[] = $row_list->ap_name;
            $row[] = $row_list->pgd_tempat;
            $row[] = '<div class="center"><button class="btn btn-xs btn-yellow" onclick="getMenu('."'Templates/konversi_data/formulir/".$row_list->pgd_id.''."'".')"><i class="ace-icon fa fa-folder-open bigger-50"></i>Formulir </button></div>';
            $row[] = '<div class="center"><div class="hidden-sm hidden-xs action-buttons">
                        '.$this->authuser->show_button('Templates/konversi_data','R',$row_list->pgd_id,2).'
                        '.$btn_u_d.'
                      </div>
                      <div class="hidden-md hidden-lg">
                        <div class="inline pos-rel">
                            <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto"><i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                            </button>
                            <ul class="dropdown-mst_education dropdown-only-icon dropdown-yellow dropdown-mst_education-right dropdown-caret dropdown-close">
                                <li>'.$this->authuser->show_button('Templates/konversi_data','R','',4).'</li>
                                <li>'.$this->authuser->show_button('Templates/konversi_data','U','',4).'</li>
                                <li>'.$this->authuser->show_button('Templates/konversi_data','D','',4).'</li>
                            </ul>
                        </div>
                    </div></div>';        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->konversi_data->count_all(),
                        "recordsFiltered" => $this->konversi_data->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {
        /*print_r($_POST);die;*/
        $this->load->library('form_validation');
        $val = $this->form_validation;

        /*modul registrasi pegnaduan*/
        $val->set_rules('pgd_tanggal', 'Tanggal Pengaduan', 'trim|required');
        $val->set_rules('kp_id', 'Kategori Pemilu', 'trim|required');
        $val->set_rules('tp_id', 'Tipe Pengaduan', 'trim|required');
        $val->set_rules('pgd_tempat', 'Alamat/Tempat Pengaduan', 'trim');
        $val->set_rules('provinceId', 'Provinsi', 'trim|required');
        $val->set_rules('regencyId', 'Kab/Kota', 'trim');
        $val->set_rules('districtId', 'Kecamatan', 'trim');
        $val->set_rules('villageId', 'Kelurahan', 'trim');
        /*end modul registrasi pegnaduan*/

        /*modul verifikasi adm*/
        $val->set_rules('pgdhpa_tanggal_penelitian', 'Tanggal Penelitian Adm', 'trim|required');
        $val->set_rules('pgd_no', 'No Pengaduan', 'trim|required');
        $val->set_rules('pgd_format_no', 'Format No Pengaduan', 'trim|required');
        $val->set_rules('pgdhpa_tanggal_penelitian', 'Tanggal Penelitian', 'trim');
        $val->set_rules('pgdhpa_penerima_pg_id', 'Penerima Pengaduan', 'trim');
        $val->set_rules('verifikator_id', 'Verifikator', 'trim|required');
        $val->set_rules('pgdhpa_kesimpulan', 'Kesimpulan Penelitian Adm', 'trim|required');
        $val->set_rules('content', 'Pokok Pengaduan', 'trim|required');
        $val->set_rules('pgdhpa_keterangan', 'Keterangan', 'trim');

        /*modul pengkajian berkas*/
        $val->set_rules('pengkaji_id', 'Pilih Pengkaji', 'trim');
        $val->set_rules('sv_id', 'Rekomendasi Pengkaji', 'trim');
        $val->set_rules('pokok_perkara', 'Pokok Perkara', 'trim');
        $val->set_rules('pgdpkj_keterangan', 'Keterangan', 'trim');
        $val->set_rules('pgdpkj_tanggal', 'Tanggal Pengkajian', 'trim');

        /*modul verifikasi materil*/
        $val->set_rules('phv_tanggal', 'Tanggal Vermat', 'trim');
        $val->set_rules('phv_hasil_vermat', 'Hasil Verifikasi Materil', 'trim');
        $val->set_rules('phv_tindak_lanjut', 'Tindak Lanjut Vermat', 'trim');
        $val->set_rules('phv_modus', 'Dugaan Pelanggaran Asas/Modus', 'trim');
        $val->set_rules('phv_keterangan', 'Keterangan', 'trim');





        $val->set_message('required', "Silahkan isi field \"%s\"");

        if ($val->run() == FALSE)
        {
            $val->set_error_delimiters('<div style="color:white">', '</div>');
            echo json_encode(array('status' => 301, 'message' => validation_errors()));
        }
        else
        {                       
            $this->db->trans_begin();
            $id = ($this->input->post('id'))?$this->input->post('id'):0;
            $pgdhpa_id = ($this->input->post('pgdhpa_id'))?$this->input->post('pgdhpa_id'):0;
            $pgdpkj_id = ($this->input->post('pgdpkj_id'))?$this->input->post('pgdpkj_id'):0;
            $phv_id = ($this->input->post('phv_id'))?$this->input->post('phv_id'):0;

            /*modul registrasi pengaduan*/
            $dataexc = array(
                'pgd_tempat' => $val->set_value('pgd_tempat'),
                'pgd_tanggal' => $val->set_value('pgd_tanggal'),
                'tp_id' => $val->set_value('tp_id'),
                'kp_id' => $val->set_value('kp_id'),
                'province_id' => $val->set_value('provinceId'),
                'city_id' => $val->set_value('regencyId'),
                'district_id' => $val->set_value('districtId'),
                'subdistrict_id' => $val->set_value('villageId'),
                'province_name' => $this->provinces_model->get_by_id($val->set_value('provinceId'))->name,
                'city_name' => ($val->set_value('regencyId'))?$this->regencies_model->get_by_id($val->set_value('regencyId'))->name:'',
                'district_name' => ($val->set_value('districtId')) ? $this->districts_model->get_by_id($val->set_value('districtId'))->name:'',
                'subdistrict_name' => ($val->set_value('villageId')) ? $this->villages_model->get_by_id($val->set_value('villageId'))->name : '',
                'ap_id' => 1,
                'pgd_status' => 'ON PROGRESS',
                'pg_id' => $this->session->userdata('user')->pg_id,
            );

            if($id==0){
                $this->db->insert('mc_pengaduan', $dataexc);
                $new_pgd_id= $this->db->insert_id();
                /*insert mc pengadan proses*/
                $this->db->insert('mc_pengaduan_proses', array('pgd_id'=>$new_pgd_id,'ap_id' => 1,'created_date' => date('Y-m-d H:i:s'), 'created_by' => $this->session->userdata('user')->fullname, 'pg_id' => $this->session->userdata('user')->pg_id) );
            }else{
                $this->db->update('mc_pengaduan', $dataexc, array('pgd_id' => $id));
                $new_pgd_id = $id;
            }
            /*end modul registrasi pengaduan*/

            /*modul para pihak*/
            /*pengadu*/
            $pengadu = $this->input->post('pengadu');
            $nik_pengadu = $this->input->post('nik_pengadu');
            $unsur_pengadu = $this->input->post('kpd_id_pengadu');
            if(is_array($pengadu)){
                if( $pengadu[0] != '' ) :
                foreach ($pengadu as $kpd => $vpd) {
                    $nik = ($nik_pengadu[$kpd])?$nik_pengadu[$kpd]: $this->generateNik('ktp');
                    /*check nik existing*/
                    $dataktp = array(
                        'ktp_nik'           => $nik,
                        'ktp_nama_lengkap'  => $vpd,
                    );
                    if( $this->konversi_data->check_nik($nik) > 0 ){
                        $this->db->update('ktp', $dataktp, array('ktp_nik' => $nik) );
                    }else{
                        $this->db->insert('ktp',$dataktp);
                    }

                    $data_tr_pp[] = array(
                        'pgd_id' => $new_pgd_id,
                        'ktp_nik' => $nik,
                        'kpd_id' => ($unsur_pengadu[$kpd])?$unsur_pengadu[$kpd]:'',
                        'flag' => 'pengadu',
                        );
                }
                $this->db->insert_batch('tr_para_pihak',$data_tr_pp);
                endif;
            }

            /*kuasa*/
            $kuasa = $this->input->post('kuasa');
            $nik_kuasa = $this->input->post('nik_kuasa');
            if(is_array($kuasa)){
                if( $kuasa[0] != '' ) :
                foreach ($kuasa as $kps => $vps) {
                    $nik = ($nik_kuasa[$kps])?$nik_kuasa[$kps]: $this->generateNik('ktp');
                    /*check nik existing*/
                    $dataktp = array(
                        'ktp_nik'           => $nik,
                        'ktp_nama_lengkap'  => $vps,
                    );
                    if( $this->konversi_data->check_nik($nik) > 0 ){
                        $this->db->update('ktp', $dataktp, array('ktp_nik' => $nik) );
                    }else{
                        $this->db->insert('ktp',$dataktp);
                    }

                    $data_tr_ps[] = array(
                        'pgd_id' => $new_pgd_id,
                        'ktp_nik' => $nik,
                        'flag' => 'kuasa',
                        );
                }
                $this->db->insert_batch('tr_para_pihak',$data_tr_ps);
                endif;
            }
            
            /*teradu*/
            $teradu = $this->input->post('teradu');
            $nik_teradu = $this->input->post('nik_teradu');
            $lembaga_teradu = $this->input->post('pp_id_teradu');
            $jabatan_teradu = $this->input->post('jbp_id_teradu');

            if(is_array($teradu)){
                if( $teradu[0] != '' ) :
                foreach ($teradu as $ktr => $vtr) {
                    $nik = ($nik_teradu[$ktr])?$nik_teradu[$ktr]: $this->generateNik('ktp');
                    

                    $dataktp_pt = array(
                        'ktp_nik'           => $nik,
                        'ktp_nama_lengkap'  => $vtr,
                    );
                    if( $this->konversi_data->check_nik($nik) > 0 ){
                        $this->db->update('ktp', $dataktp_pt, array('ktp_nik' => $nik) );
                    }else{
                        $this->db->insert('ktp',$dataktp_pt);
                    }

                    $data_tr_pt[] = array(
                        'pgd_id' => $new_pgd_id,
                        'ktp_nik' => $nik,
                        'pp_id' => ($lembaga_teradu[$ktr])?$lembaga_teradu[$ktr]:'',
                        'pp_jbp_id' => ($jabatan_teradu[$ktr])?$jabatan_teradu[$ktr]:'',
                        'flag' => 'teradu',
                        );
                }
                $this->db->insert_batch('tr_para_pihak',$data_tr_pt);
                endif;
            }

            /*mc_pengaduan_log*/
            $this->konversi_data->update_log($new_pgd_id);

            

            /*modul penelitan administrasi*/
            $data_adm = array(
                'pgd_id' => $new_pgd_id,
                'pgdhpa_penerima_pg_id' => $val->set_value('pgdhpa_penerima_pg_id'),
                'pgdhpa_kelengkapan_form' => $val->set_value('pgdhpa_kelengkapan_form'),
                'pgdhpa_tanggal_penelitian' => $val->set_value('pgdhpa_tanggal_penelitian'),
                'pgdhpa_status_kuasa' => $val->set_value('pgdhpa_status_kuasa'),
                'pgdhpa_alat_bukti' => $val->set_value('provinceId'),
                'pgdhpa_verifikator_pg_id' => $val->set_value('verifikator_id'),
                'pgdhpa_kesimpulan' => $val->set_value('pgdhpa_kesimpulan'),
                'pgdhpa_pokok_pengaduan' => $val->set_value('content'),
                'pgdhpa_keterangan' => $val->set_value('pgdhpa_keterangan'),
                'pg_id' => $this->session->userdata('user')->pg_id,
            );
            if($pgdhpa_id==0){
                $this->db->insert('mc_pengaduan_hasil_penelitian_adm', $data_adm);
            }else{
                $this->db->update('mc_pengaduan_hasil_penelitian_adm', $data_adm, array('pgdhpa_id' => $pgdhpa_id));
            }
            $this->db->update('mc_pengaduan', array('pgd_no' => $val->set_value('pgd_no'), 'pgd_format_no' => $val->set_value('pgd_format_no') ), array('pgd_id' => $new_pgd_id));
            /*end modul penelitan administrasi*/

            /*modul pengkajian berkas*/
            $data_pengkajian_berkas = array(
                'pgd_id' => $new_pgd_id,
                'sv_id' => $val->set_value('sv_id'),
                'pgdpkj_pokok_perkara' => $val->set_value('pokok_perkara'),
                'pgdpkj_keterangan' => $val->set_value('pgdpkj_keterangan'),
                'pengkaji_id' => $val->set_value('pengkaji_id'),
                'pgdpkj_tanggal' => $val->set_value('pgdpkj_tanggal'),
                'pg_id' => $this->session->userdata('user')->pg_id,
            );
            if($id==0){
                $this->db->insert('mc_pengaduan_pengkajian', $data_pengkajian_berkas);
            }else{
                $this->db->update('mc_pengaduan_pengkajian', $data_pengkajian_berkas, array('pgdpkj_id' => $pgdpkj_id));
            }
            /*end modul pengakajian berkas*/

            /*modul verifikasi materil*/
            $data_verifikasi_materil = array(
                'pgd_id' => $new_pgd_id,
                'phv_tanggal' => $val->set_value('phv_tanggal'),
                'phv_hasil_vermat' => $val->set_value('phv_hasil_vermat'),
                'phv_tindak_lanjut' => $val->set_value('phv_tindak_lanjut'),
                'phv_modus' => $val->set_value('phv_modus'),
                'phv_keterangan' => $val->set_value('phv_keterangan'),
                'pg_id' => $this->session->userdata('user')->pg_id,
            );
            if($phv_id==0){
                $this->db->insert('mc_pengaduan_hasil_vermat', $data_verifikasi_materil);
            }else{
                $this->db->update('mc_pengaduan_hasil_vermat', $data_verifikasi_materil, array('phv_id' => $phv_id));
            }

            
            /*end modul verifikasi materil*/


            
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

    public function generateNik($tabel)
    {

        $count_row = $this->db->get($tabel)->num_rows();
        $random = mt_rand(1,99999);
        $new_count_field = $count_row + 1;
        $new_id = '99'.$new_count_field.$random;

        return $new_id;
    }

    public function delete()
    {
        $id=$this->input->post('ID')?$this->input->post('ID',TRUE):null;
        $toArray = explode(',',$id);
        if($id!=null){
            if($this->konversi_data->delete_by_id($toArray)){
                echo json_encode(array('status' => 200, 'message' => 'Proses Hapus Data Berhasil Dilakukan'));
            }else{
                echo json_encode(array('status' => 301, 'message' => 'Maaf Proses Hapus Data Gagal Dilakukan'));
            }
        }else{
            echo json_encode(array('status' => 301, 'message' => 'Tidak ada item yang dipilih'));
        }
        
    }


    public function find_data()
    {   
        $output = array(
                        "recordsTotal" => $this->konversi_data->count_all(),
                        "recordsFiltered" => $this->konversi_data->count_filtered_data(),
                        "data" => $_POST,
                );
        echo json_encode($output);
    }

}


/* End of file Registrasi_adm.php */
/* Location: ./application/modules/Templates/konversi_data.php */
