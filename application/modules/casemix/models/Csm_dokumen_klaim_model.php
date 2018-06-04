<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csm_dokumen_klaim_model extends CI_Model {


	var $table = 'csm_dokumen_klaim';
	var $column = array('csm_dokumen_klaim.no_registrasi');
	var $select = 'csm_dokumen_klaim.no_registrasi,csm_dokumen_klaim.no_sep,csm_dokumen_klaim.tgl_transaksi_kasir,csm_dokumen_klaim.csm_dk_filename,csm_dokumen_klaim.csm_dk_fullpath,csm_dokumen_klaim.csm_dk_total_klaim,csm_dokumen_klaim.csm_dk_tipe, csm_reg_pasien.csm_rp_no_sep, csm_reg_pasien.csm_rp_no_mr, csm_reg_pasien.csm_rp_nama_pasien, csm_reg_pasien.csm_rp_tgl_masuk, csm_reg_pasien.csm_rp_tgl_keluar, csm_reg_pasien.csm_rp_nama_dokter, csm_reg_pasien.csm_rp_bagian, csm_reg_pasien.csm_rp_tipe, csm_reg_pasien.is_submitted, csm_reg_pasien.csm_rp_kode_bagian';
	var $order = array('csm_reg_pasien.csm_rp_no_sep' => 'ASC');
	

	public function __construct()
	{
		parent::__construct();
		$this->load->database('default', TRUE);
	}

	private function _main_query(){
		
		$this->db->select($this->select);
		$this->db->from($this->table);
		$this->db->join('csm_reg_pasien', 'csm_reg_pasien.no_registrasi='.$this->table.'.no_registrasi', 'left');

		if (isset($_GET['month']) AND $_GET['month'] != '' ) {
			$this->db->where("MONTH(csm_reg_pasien.csm_rp_tgl_masuk) = '".$_GET['month']."' " );
		}
		if (isset($_GET['year']) AND $_GET['year'] != '' ) {
			$this->db->where("YEAR(csm_reg_pasien.csm_rp_tgl_masuk) = '".$_GET['year']."' " );
		}
		if (isset($_GET['tipe']) AND $_GET['tipe'] != '' ) {
			if( $_GET['tipe']!='all' ){
				$this->db->where("csm_dk_tipe = '".$_GET['tipe']."' " );
			}
		}


	}

	private function _get_datatables_query()
	{
		
		$this->_main_query();

		$i = 0;
	
		foreach ($this->column as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
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
		//print_r($this->db->last_query());die;
		return $query->result();
	}

	function get_data()
	{
		$this->_main_query();
		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		//print_r($query);die;
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
			$this->db->where_in(''.$this->table.'.no_registrasi',$id);
			$query = $this->db->get();
			return $query->result();
		}else{
			$this->db->where(''.$this->table.'.no_registrasi',$id);
			$query = $this->db->get();
			//echo '<pre>';print_r($this->db->last_query());die;
			return $query->row();
		}
		
	}

	
}
