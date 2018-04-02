<?php
/*
 * To change this template, choose Tools | templates
 * and open the template in the editor.
 */

final Class Api {

    // ================================= DASHBOARD =================================== //
     public function getApiData($params) {
//print_r($params);
        $url = $params['link'];
        $data = $params['data'];

        $field_string = http_build_query($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (!empty($data)) :
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);
        endif;
        // execute!
        $response = curl_exec($ch);
        // close the connection, release resources used

        curl_close($ch);

        // do anything you want with your response
        return json_decode($response);
    }

    public function send_notification($params){

        $CI =&get_instance();
        $db = $CI->load->database('default', TRUE);

        /*detail pegawai*/
        $pegawai = $db->get_where('tr_pegawai', array('pg_id'=>$params['to']))->row();

        if(!empty($pegawai)){
            $data = [
                    'ref_id'      => $params['ref_id'],
                    'ref_table'   => $params['ref_table'],
                    'link'        => $params['link'],
                    'from'        => $CI->session->userdata('user')->pg_id,
                    'to'          => $pegawai->pg_id,
                    'email'       => $pegawai->email,
                    'phone'       => $pegawai->no_telp,
                    'subject'     => 'BPKAD',
                    'message'     => $this->get_message($params),
                ];
            //
            $this->nexmo_send_sms($data);
            $this->send_user_notification($data);
        }
        

        return true;
    }

    public function get_message($params){

        switch ($params['type']) {

            case 'surat_masuk':
                $message = 'Anda mendapatkan 1 (satu) surat masuk Dari : '.strtoupper($params['data']->surat_dari_atas_nama).' Perihal : '.$params['data']->surat_perihal.'';
                break;

            case 'disposisi':
                $message = 'Anda mendapatkan 1 (satu) disposisi Dari : '.strtoupper($params['data']->disposisi_dari_atas_nama).', Perihal : '.$params['data']->disposisi_perihal.', Catatan : '.$params['data']->disposisi_keterangan.'';
                break;
            case 'surat_keluar':
                $message = 'Anda mendapatkan 1 (satu) pemberitahuan untuk persetujuan surat Dari : '.strtoupper($params['data']->surat_dari_atas_nama).', Perihal : '.$params['data']->surat_perihal.'';
                break;

            
            default:
                # code...
            $message = '';
                break;
        }

        return $message;

    }

    public function nexmo_send_sms($data) {

        if($data['phone']!=''){
            $phone = (substr($data['phone'], 0,1) == '0')?"62".substr($data['phone'],1)."":"".$data['phone']."";

            $url = 'https://rest.nexmo.com/sms/json?' . http_build_query(
                [
                  'api_key' =>  '497fe30a',
                  'api_secret' => '6b596a4e3de436a9',
                  'to' => '', //$phone,
                  'from' => 'BPKAD',
                  'text' => $data['message'],
                ]
            );

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            /*print_r(json_decode($url));die;*/
            return json_decode($response);
        }else{
            return false;
        }
        

    }

    public function send_user_notification($data) {

        $CI =&get_instance();
        $db = $CI->load->database('default', TRUE);
        $data = 
            [
              'from' => $data['from'],
              'to' => $data['to'],
              'ref_id' => $data['ref_id'],
              'ref_table' => $data['ref_table'],
              'link' => $data['link'],
              'message' => $data['message'],
              'created_date' => date('Y-m-d H:i:s'),
            ];

        return $db->insert('notification', $data);
    }

    public function update_notification_has_read($params) {

        $CI =&get_instance();
        $db = $CI->load->database('default', TRUE);
        $db->update('notification', array('is_read' => 'Y'), array('ref_id'=>$params['ref_id'], 'ref_table' => $params['ref_table'], 'to' => $CI->session->userdata('user')->pg_id));
        return  true;
    }


}

?> 