<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

final Class Authuser {

    function check_level_pegawai($pg_id){

        $CI =&get_instance();
        $db = $CI->load->database('default', TRUE);
        $CI->load->library('session');
        $data_pegawai = $db->join('mst_unit_kerja','mst_unit_kerja.uk_id=tr_pegawai.uk_id','left')->get_where('tr_pegawai', array('pg_id'=>$pg_id))->row();
        if(empty($data_pegawai)){
            return false;
        }else{
            return $data_pegawai->uk_level;
        }
    }

    function show_button_disposisi(){

        $CI =&get_instance();
        $db = $CI->load->database('default', TRUE);
        $CI->load->library('session');
        if(in_array($CI->session->userdata('user')->role_id, array('3'))){
            if(isset($CI->session->userdata('user')->pg_id)){
                $db->join('mst_unit_kerja','mst_unit_kerja.uk_id=tr_pegawai.pg_id','left')
                   ->where('pg_id', $CI->session->userdata('user')->pg_id)
                   ->from('tr_pegawai');
                $qry = $db->get()->row();
                if($qry->uk_level < 4){
                    return true;
                }else{
                    return false;
                }
            }
        }else{
            return true;
        }

    }

    function show_button($link, $code, $id='', $style=''){

        $CI =&get_instance();
        $db = $CI->load->database('default', TRUE);
        $CI->load->library('session');

        /*check existing*/
        $query = "SELECT action_code
                    FROM tmp_role_has_menu
                    WHERE menu_id = (SELECT menu_id FROM tmp_mst_menu WHERE link='$link') AND role_id IN (SELECT role_id FROM tmp_user_has_role WHERE user_id=".$CI->session->userdata('user')->user_id.")";
        $result = $db->query($query);
        if($result->num_rows() > 0){
            $action_code = $result->row()->action_code;
            $str_to_array = explode(',', $action_code); 
            /*switch code to get button*/
            return $this->switch_to_get_btn($str_to_array, $link, $code, $id, $style);
        }else{
            return false;
        }

    }

    function switch_to_get_btn($array, $link, $code, $id, $style=''){
        if(in_array($code, $array)){
            /*get button action*/
            return $this->get_button_action($link, $id, $code.$style);
        }
    }

    function get_button_action($link, $id, $code){
        switch ($code) {

            /*style for create*/
            case 'C':
                # code...
                $btn = '<button class="btn btn-white btn-xs btn-info btn-bold" onclick="getMenu('."'".$link.'/form'."'".')"><i class="ace-icon glyphicon glyphicon-plus bigger-50 blue"></i>Create New</button>';
                break;
            case 'C1':
                # code...
                $btn = '<a href="#" class="btn btn-xs btn-primary" onclick="getMenu('."'".$link.'/form'."'".')"><i class="ace-icon glyphicon glyphicon-plus bigger-50"></i>Create New</a>';
                break;

            case 'C11':
                # code...
                $btn = '<button class="btn btn-xs btn-primary" onclick="getMenuTabs('."'".$link.'/form?pgd_id='.$id.''."'".')"><i class="ace-icon glyphicon glyphicon-plus bigger-50"></i>Create New</button>';
                break;

            case 'C2':
                # code...
                $btn = '<button class="btn btn-xs btn-primary" onclick="getMenu('."'".$link.'/form'."'".')"><i class="ace-icon glyphicon glyphicon-plus bigger-50"></i></button>';
                break;
            case 'C3':
                # code...
                $btn = '<button class="btn btn-white btn-xs btn-info btn-bold" onclick="getMenu('."'".$link.'/form'."'".')"><i class="ace-icon glyphicon glyphicon-plus bigger-50 blue"></i></button>';
                break;

            case 'C4':
                # code...
                $btn = '<a href="#" onclick="getMenu('."'".$link.'/form'."'".')" class="tooltip-success" data-rel="tooltip" title="Add">
                                        <span class="blue">
                                            <i class="ace-icon glyphicon glyphicon-plus bigger-120"></i>
                                        </span>
                                    </a>';
                break;

            case 'C6':
                # code...
                $btn = '<a href="#" onclick="getMenu('."'".$link.'/form'."'".')"title="Add">Add</a>';
                break;

            /*style button for read action*/
            case 'R':
                # code...
                $btn = '<button class="btn btn-white btn-xs btn-info btn-bold" onclick="getMenu('."'".$link.'/show/'.$id.''."'".')"><i class="ace-icon fa fa-eye bigger-50 blue"></i>View</button>';
                break;

            case 'R1':
                # code...
                $btn = '<button class="btn btn-xs btn-info" onclick="getMenu('."'".$link.'/show/'.$id.''."'".')"><i class="ace-icon fa fa-eye bigger-50"></i>View</button>';
                break;
            case 'R2':
                # code...
                $btn = '<button class="btn btn-xs btn-info" onclick="getMenu('."'".$link.'/show/'.$id.''."'".')"><i class="ace-icon fa fa-eye bigger-50"></i></button>';
                break;
            case 'R21':
                # code...
                $btn = '<button class="btn btn-xs btn-info" onclick="getMenuTabs('."'".$link.'/show/'.$id.''."'".')"><i class="ace-icon fa fa-eye bigger-50"></i></button>';
                break;
            case 'R3':
                # code...
                $btn = '<button class="btn btn-white btn-xs btn-info btn-bold" onclick="getMenu('."'".$link.'/show/'.$id.''."'".')"><i class="ace-icon fa fa-eye bigger-50 blue"></i></button>';
                break;

            case 'R4':
                # code...
                $btn = '<a href="#" onclick="getMenu('."'".$link.'/form/'.$id.''."'".')" class="tooltip-success" data-rel="tooltip" title="View">
                                        <span class="info">
                                            <i class="ace-icon fa fa-eye bigger-120"></i>
                                        </span>
                                    </a>';
                break;

            case 'R6':
                # code...
                $btn = '<a href="#" onclick="getMenu('."'".$link.'/show/'.$id.''."'".')">Read</a>';
                break;

            /*style button for read action*/
            case 'U':
                # code...
                $btn = '<button class="btn btn-white btn-xs btn-success btn-bold" onclick="getMenu('."'".$link.'/form/'.$id.''."'".')"><i class="ace-icon fa fa-pencil bigger-50 blue"></i>Edit</button>';
                break;

            case 'U1':
                # code...
                $btn = '<button class="btn btn-xs btn-success" onclick="getMenu('."'".$link.'/form/'.$id.''."'".')"><i class="ace-icon fa fa-pencil bigger-50"></i>Edit</button>';
                break;
            case 'U2':
                # code...
                $btn = '<button class="btn btn-xs btn-success" onclick="getMenu('."'".$link.'/form/'.$id.''."'".')"><i class="ace-icon fa fa-edit bigger-50"></i></button>';
                break;
            case 'U21':
                # code...
                $btn = '<button class="btn btn-xs btn-success" onclick="getMenuTabs('."'".$link.'/form/'.$id.''."'".')"><i class="ace-icon fa fa-pencil bigger-50"></i></button>';
                break;
            case 'U3':
                # code...
                $btn = '<button class="btn btn-white btn-xs btn-success btn-bold" onclick="getMenu('."'".$link.'/form/'.$id.''."'".')"><i class="ace-icon fa fa-pencil bigger-50 blue"></i></button>';
                break;

             case 'U4':
                # code...
                $btn = '<a href="#" onclick="getMenu('."'".$link.'/form/'.$id.''."'".')" class="tooltip-success" data-rel="tooltip" title="Update">
                                        <span class="green">
                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                        </span>
                                    </a>';
                break;

            case 'U6':
                # code...
                $btn = '<a href="#" onclick="getMenu('."'".$link.'/form/'.$id.''."'".')" title="Update">Update</a>';
                break;



            /*style button for delete action*/
            case 'D':
                # code...
                $btn = '<a href="#" class="btn btn-white btn-xs btn-danger btn-bold" onclick="delete_data('.$id.')"><i class="ace-icon fa fa-trash-o bigger-50 blue"></i>Delete</a>';
                break;

            case 'D1':
                # code...
                $btn = '<a href="#" class="btn btn-xs btn-danger" onclick="delete_data('.$id.')"><i class="ace-icon fa fa-trash-o bigger-50"></i>Delete</a>';
                break;
            case 'D2':
                # code...
                $btn = '<button class="btn btn-xs btn-danger" onclick="delete_data('.$id.')"><i class="ace-icon fa fa-times bigger-50"></i></button>';
                break;

            case 'D3':
                # code...
                $btn = '<a href="#" class="btn btn-white btn-xs btn-danger btn-bold" onclick="delete_data('.$id.')"><i class="ace-icon fa fa-trash-o bigger-50 blue"></i></a>';
                break;
            
            case 'D4':
                # code...
                $btn = '<a href="#" onclick="delete_data('.$id.')" class="tooltip-success" data-rel="tooltip" title="Delete">
                                        <span class="red">
                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                        </span>
                                    </a>';
                break;

            case 'D5':
                # code...
                $btn = '<a href="#" class="btn btn-xs btn-danger" id="button_delete"><i class="ace-icon fa fa-trash-o bigger-50"></i>Delete selected items</a>';
                break;


            case 'D6':
                # code...
                $btn = '<a href="#" onclick="delete_data('.$id.')">Delete</a>';
                break;


            default:
                # code...
                $btn = '';
                break;
        }
        return $btn;
    }


    function get_user_description(){

        $this->db->from('m_user');
        $this->db->join('m_role', 'm_role.id_role=m_user.id_role','left');
        $this->db->where(array('id_user'=>$this->session->userdata('data_user')->id_user));
        $value = $this->db->get()->row();
        
        $field = 'Anda login sebagai, ';
        if( $this->session->userdata('data_user')->id_role == 5 ){
            $field .= '<strong><i> Puskesmas : '.ucwords($value->nama_puskesmas_kab).' || Kab/Kota : '.ucwords($value->nama_kabupaten).' || Provinsi : '.ucwords($value->nama_provinsi).'</strong></i>';
        }elseif( $this->session->userdata('data_user')->id_role == 4 ){
            $field .= '<strong><i> Kab/Kota : '.ucwords($value->nama_kabupaten).' || Provinsi : '.ucwords($value->nama_provinsi).'</strong></i>';
        }elseif( $this->session->userdata('data_user')->id_role == 3 ){
            $field .= '<strong><i> Provinsi : '.ucwords($value->nama_provinsi).'</strong></i>';
        }else{
            $field .= '<strong><i> '.ucwords($value->role_name).'</strong></i>';
        }

        return $field;
    }

	function write_log($params='')
    {
        
        $CI =&get_instance();
        $db = $CI->load->database('default', TRUE);
        $sess = $CI->load->library('session');

      // Check message
      // Get IP address
      if( ($remote_addr = $_SERVER['REMOTE_ADDR']) == '') {
        $remote_addr = "REMOTE_ADDR_UNKNOWN";
      }
     
      // Get requested script
      if( ($request_uri = $_SERVER['REQUEST_URI']) == '') {
        $request_uri = "REQUEST_URI_UNKNOWN";
      }
     
      // Escape values
      $log = array(
        'id_user' => $sess->userdata('data_user')->id_user,
        'time' => date('Y-m-d H:i:s'),
        'status' => isset($params['status'])?$params['status']:'TRUE',
        'remote_addr' => $remote_addr,
        'request_uri' => $request_uri,
        'message' => isset($params['message'])?$params['message']:'Message is empty',
        'last_query' => isset($params['last_query'])?$params['last_query']:'No query executed',
        );
     
      // Construct query
     
      // Execute query and save data
      $result = $db->insert('activities_history', $log);
     
      if($result) {
        return array('status' => true);  
      }
      else {
        return array('status' => false, 'message' => 'Unable to write to the database');
      }
    }

}

?> 