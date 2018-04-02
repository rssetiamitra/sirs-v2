<?php

/*
 * To change this template, choose Tools | templates
 * and open the template in the editor.
 */

final Class Logs {

    public function save($ref_table='',$ref_id='', $content='', $value='') {
        
        //print_r($data);die;
        $CI =& get_instance();
        $CI->load->library('session');       	
        $CI->load->database('default', TRUE);  
        $data = array();
    	$data['ref_table'] = $ref_table;
    	$data['ref_id'] = $ref_id;
        $data['content'] = $content;
        $data['data'] = $value;
        $data['modul_id'] = $CI->input->get('mod');
        $data['query_executed'] = $CI->db->last_query();
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['user_id'] = $CI->session->userdata('user')->user_id;
        $CI->db->insert('log', $data);
        return true;
    }

}
    
    
    ?>