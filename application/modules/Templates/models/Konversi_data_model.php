<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konversi_data_model extends CI_Model {

	var $table = 'mc_pengaduan';
	var $column = array('mc_pengaduan.pgd_id','mc_pengaduan.pgd_no','mc_pengaduan.pgd_format_no', 'mc_pengaduan.pgd_tempat','mc_pengaduan.pgd_tanggal', 'mst_tipe_pengaduan.tp_name','mst_kategori_pemilu.kp_name','mst_alur_pengaduan.ap_name','mc_pengaduan_log.pl_pengadu','mc_pengaduan_log.pl_kuasa','mc_pengaduan_log.pl_teradu');
	var $select = 'mc_pengaduan.*, mst_tipe_pengaduan.tp_name, mst_kategori_pemilu.kp_name, mst_alur_pengaduan.ap_name, mc_pengaduan_log.pl_pengadu, pl_teradu, pl_bukti, pl_peristiwa, pl_asal_pengaduan, pl_kuasa, v_pengaduan_hasil_penelitian_adm.*, mc_pengaduan_pengkajian.*, mc_pengaduan_hasil_vermat.*';

	var $order = array('mc_pengaduan.pgd_id' => 'DESC','mc_pengaduan.pgd_tanggal' => 'DESC');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _main_query(){

		$this->db->select($this->select);
		$this->db->from($this->table);
		$this->db->join('mc_pengaduan_log','mc_pengaduan_log.pgd_id='.$this->table.'.pgd_id','left');
		$this->db->join('v_pengaduan_hasil_penelitian_adm','v_pengaduan_hasil_penelitian_adm.pgd_id='.$this->table.'.pgd_id','left');
		$this->db->join('mc_pengaduan_pengkajian','mc_pengaduan_pengkajian.pgd_id='.$this->table.'.pgd_id','left');
		$this->db->join('mc_pengaduan_hasil_vermat','mc_pengaduan_hasil_vermat.pgd_id='.$this->table.'.pgd_id','left');
		$this->db->join('mst_tipe_pengaduan','mst_tipe_pengaduan.tp_id='.$this->table.'.tp_id','left');
		$this->db->join('mst_kategori_pemilu','mst_kategori_pemilu.kp_id='.$this->table.'.kp_id','left');
		$this->db->join('mst_alur_pengaduan','mst_alur_pengaduan.ap_id='.$this->table.'.ap_id','left');

		if(isset($_GET['year'])){
			if($_GET['year'] != 0){
				$this->db->where('YEAR(pgd_tanggal)', $_GET['year']);
			}
		}

		if(isset($_GET['tp_id']) and $_GET['tp_id'] != NULL){
			$this->db->where('mc_pengaduan.tp_id', $_GET['tp_id']);
		}

		if(isset($_GET['kp_id']) and $_GET['kp_id'] != NULL){
			$this->db->where('mc_pengaduan.kp_id', $_GET['kp_id']);
		}

		if(isset($_GET['ap_id']) and $_GET['ap_id'] != NULL){
			$this->db->where('mc_pengaduan.ap_id', $_GET['ap_id']);
		}

		if(isset($_GET['noreg']) and $_GET['noreg'] != NULL){
			$this->db->where('mc_pengaduan.pgd_id', $_GET['noreg']);
		}

		if(isset($_GET['prov']) and $_GET['prov'] != NULL and $_GET['prov'] != 0){
			$this->db->where('mc_pengaduan.province_id', $_GET['prov']);
		}

		if(isset($_GET['city']) and $_GET['city'] != NULL and $_GET['city'] != 0){
			$this->db->where('mc_pengaduan.city_id', $_GET['city']);
		}

		if(isset($_GET['frmdt']) and $_GET['frmdt'] != NULL and isset($_GET['todt']) and $_GET['todt']){
		$this->db->where('mc_pengaduan.pgd_tanggal BETWEEN '."'".$_GET['frmdt']."'".' AND '."'".$_GET['todt']."'".'');
		}

		/*just for admin*/
		if( !in_array($this->session->userdata('user')->role_id, array(1,4)) ){
			$this->db->where('mc_pengaduan.pg_id', $this->session->userdata('user')->pg_id);
		}

		
	}

	private function _get_datatables_query()
	{
		
		$this->_main_query();

		$i = 0;
	
		foreach ($this->column as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? 
					$this->db->like($item, $_POST['search']['value']) 
				:
					$this->db->or_like($item, $_POST['search']['value'])
				;
			$column[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	
	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		/*print_r($this->db->last_query());die;*/
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		/*print_r($this->db->last_query());die;*/
		return $query->num_rows();
	}

	function count_filtered_data()
	{
		$this->_main_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->_main_query();
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->_main_query();
		if(is_array($id)){
			$this->db->where_in(''.$this->table.'.pgd_id',$id);
			$query = $this->db->get();
			return $query->result();
		}else{
			$this->db->where(''.$this->table.'.pgd_id',$id);
			$query = $this->db->get();
			return $query->row();
		}
		
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{

		$get_data = $this->get_by_id($id);
		$get_attachment = $this->get_attachment_by_id($id);
		foreach ($get_attachment as $key => $value) {
			# code...
			$this->delete_attachment_by_id($value->attc_id);
		}

		$this->db->where_in(''.$this->table.'.pgd_id', $id);
		return $this->db->delete($this->table);
	}

	public function delete_attachment_by_id($id)
	{
		$get_data = $this->db->get_where('tr_attachment', array('attc_id'=>$id))->row();
		//print_r($get_data->fullpath);die;
		if (file_exists($get_data->attc_fullpath)) {
			if(unlink($get_data->attc_fullpath)){
				$this->db->where('tr_attachment.attc_id', $id);
				return $this->db->delete('tr_attachment');
			}
		}else{
			return false;
		}
		
	}

	public function get_attachment_by_id($id)
	{
		$this->db->from('tr_attachment');
		$this->db->where('tr_attachment.ref_table', 'mc_pengaduan');
		$this->db->where_in('tr_attachment.ref_id', $id);
		return $this->db->get()->result();		
	}

	public function submitToNextProcess($id)
	{
		return $this->db->insert('mc_pengaduan_proses', array('pgd_id' => $id, 'ap_id' => 2,'created_date' => date('Y-m-d H:i:s'), 'created_by' => $this->session->userdata('user')->fullname));
	}

	public function checkFormulir($id)
	{
		/*check pengadu*/
		$issetPengadu = $this->db->get_where('tr_para_pihak', array('pgd_id' => $id, 'flag' => 'pengadu'))->num_rows();

		$issetTeradu = $this->db->get_where('tr_para_pihak', array('pgd_id' => $id, 'flag' => 'teradu'))->num_rows();

		//$issetBukti = $this->db->get_where('mc_pengaduan_bukti', array('pgd_id' => $id))->num_rows();
		$issetUraian = $this->db->get_where('mc_pengaduan_uraian', array('pgd_id' => $id))->num_rows();

		if($issetPengadu > 0 and $issetTeradu > 0 and $issetUraian > 0 ){
			return true;
		}else{
			return false;
		}

	}

	public function get_graph_data()
	{
		$query_1 = "SELECT COUNT(pgd_id) AS total_pengaduan, MIN(pgd_tanggal) AS min_date, MAX(pgd_tanggal) AS max_date 
			FROM mc_pengaduan 
			WHERE pgd_tanggal != '0000-00-00'";

		$query_asal_pengaduan = "SELECT province_id, provinces.name, COUNT(pgd_id) AS total_pengaduan
								FROM mc_pengaduan 
								LEFT JOIN provinces ON provinces.`id`=mc_pengaduan.province_id
								GROUP BY province_id ORDER BY total_pengaduan DESC";

		$query_tipe_pengaduan = "SELECT mst_tipe_pengaduan.tp_name, COUNT(pgd_id) AS total_pengaduan
								FROM mc_pengaduan 
								LEFT JOIN mst_tipe_pengaduan ON mst_tipe_pengaduan.`tp_id`=mc_pengaduan.tp_id
								GROUP BY mc_pengaduan.tp_id
								ORDER BY total_pengaduan DESC";
		$query_kategori_pemilu = "SELECT mst_kategori_pemilu.kp_name, COUNT(pgd_id) AS total_pengaduan
								FROM mc_pengaduan 
								LEFT JOIN mst_kategori_pemilu ON mst_kategori_pemilu.`kp_id`=mc_pengaduan.kp_id
								GROUP BY mc_pengaduan.kp_id
								ORDER BY total_pengaduan DESC";

		$data = array(
			'registrasi' => $this->db->query($query_1)->row(),
			'asal_pengaduan' => $this->db->query($query_asal_pengaduan)->result(),
			'tipe_pengaduan' => $this->db->query($query_tipe_pengaduan)->result(),
			'kategori_pemilu' => $this->db->query($query_kategori_pemilu)->result(),
			);
		return $data;
	}

	function update_log($pgd_id)
	  {
	  	$query = "UPDATE mc_pengaduan_log 
					SET 
						mc_pengaduan_log.pl_pengadu= (SELECT REPLACE(GROUP_CONCAT(CONCAT('#', ktp_nama_lengkap, ' (', kpd_name, ') ')SEPARATOR '#'), '##', '#') AS pl_pengadu
							FROM v_para_pihak
							WHERE flag='pengadu' AND pgd_id=".$pgd_id."), 
						mc_pengaduan_log.pl_teradu= (SELECT REPLACE(GROUP_CONCAT(CONCAT('#', ktp_nama_lengkap, ' ( ',jbp_name,' ',pp_name,' ) ')SEPARATOR '#'), '##', '#') AS pl_teradu
							FROM v_para_pihak
							WHERE flag='teradu' AND pgd_id=".$pgd_id."),
						mc_pengaduan_log.pl_kuasa= (SELECT REPLACE(GROUP_CONCAT(CONCAT('#', ktp_nama_lengkap)SEPARATOR '#'), '##', '#') AS pl_kuasa
							FROM v_para_pihak
							WHERE flag='kuasa' AND pgd_id=".$pgd_id.") , 
						mc_pengaduan_log.pl_saksi= (SELECT REPLACE(GROUP_CONCAT(CONCAT('#', ktp_nama_lengkap)SEPARATOR '#'), '##', '#') AS pl_saksi
							FROM v_para_pihak
							WHERE flag='saksi' AND pgd_id=".$pgd_id.") 
					WHERE pgd_id = ".$pgd_id."";

	    return $this->db->query($query);
	  }

	function check_nik($nik)
	  {
	  	return $this->db->get_where('ktp', array('ktp_nik' => $nik))->num_rows();
	  }





}
