<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class global_model extends CI_model {

    public function insert_data($table, $values){
        $this->db->insert($table, $values);
    }

    public function update_data($table, $set, $where){
        $this->db->where($where);
        $this->db->update($table, $set);
    }

    public function delete_data($table, $where){
        $this->db->delete($table, $where);
    }

    // login
    public function auth($username,$password){
        return $this->db->select('username,level,k.nama,id_dept,id,id_karyawan')
        ->from('t_user u')->join('t_karyawan k','u.username=k.id_karyawan','LEFT')
        ->where('username',$username)->where('password',md5($password))->get();
    }

    //BUAT QRCODE
    public function buat_qrcode($nilai_qr)
    {
        $tgl_saat_ini = strtotime(date('Y-m-d H:i:s'));
        $expired = $tgl_saat_ini + 86400;
        
        //CONFIGURASI QRCODE
        $this->load->library('ciqrcode');
        $config['cacheable'] = true;
        $config['cachedir'] = './images/';
        $config['errorlog'] = './images/';
        $config['imagedir'] = './images/qrcode/';
        $config['quality'] = true;
        $config['size'] = '1024';
        $config['black'] = array(0, 0, 255);
        $config['white'] = array(70, 130, 180);
        $this->ciqrcode->initialize($config);

        //BUAT FILE QRCODE
        // $nama_file = random_string('alnum', 40);
        $file_qr = $nilai_qr . '.png';     //nama file image qrcode
        $params['data'] = $nilai_qr;  //nilai qrcode
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $file_qr;
        $this->ciqrcode->generate($params);

        //INPUT DATA QRCODE
        $data_input = [
            'qrcode' =>  $file_qr,
            'nilai' => $nilai_qr,
            'expired' => $expired
        ];
        $this->insert_data('t_qrcode',$data_input);

        $qrcode = $file_qr;
      
        return $qrcode;
    }

    public function cek_qrcode($nik){
        return $this->db->get_where('t_qrcode',['nilai'=>$nik]);
    }
}

?>