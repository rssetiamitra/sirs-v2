<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Structure_org_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_module_by_class($class)
	{
		$this->db->from('menu');
		$this->db->where("menu_module = (SELECT menu_id FROM menu WHERE class = '$class')");
		return $this->db->get()->result();
	}


}
