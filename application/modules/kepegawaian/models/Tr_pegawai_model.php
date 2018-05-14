<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tr_pegawai_model extends CI_Model {

	var $table = 'tr_pegawai';
	var $column = array('tr_pegawai.fullname','tr_pegawai.uk_id','mst_jabatan.jbtn_name','tr_pegawai.jbtn_id','tr_pegawai.nip','tr_pegawai.email','tr_pegawai.rank','tr_pegawai.photo','tr_pegawai.active_date','tr_pegawai.is_active','tr_pegawai.updated_date','tr_pegawai.created_date');
	var $select = 'tr_pegawai.*, mst_jabatan.jbtn_name, mst_unit_kerja.uk_name';

	var $order = array('tr_pegawai.pg_id' => 'DESC');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _main_query(){
		$this->db->select($this->select);
		$this->db->from($this->table);
		$this->db->join('mst_jabatan', 'mst_jabatan.jbtn_id='.$this->table.'.jbtn_id','left');
		$this->db->join('mst_unit_kerja', 'mst_unit_kerja.uk_id='.$this->table.'.uk_id','left');
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
		$query = $this->db->get(); //print_r($this->db->last_query());die;
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
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
			$this->db->where_in(''.$this->table.'.pg_id',$id);
			$query = $this->db->get();
			return $query->result();
		}else{
			$this->db->where(''.$this->table.'.pg_id',$id);
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
		foreach ($get_data as $key => $value) {
			# code...
			$fullpath = 'uploaded/photo/'.$value->photo.'';
			if (file_exists($fullpath)) {
				unlink($fullpath);
			}
		}
		
		$this->db->where_in(''.$this->table.'.pg_id', $id);
		return $this->db->delete($this->table);
	}


}
