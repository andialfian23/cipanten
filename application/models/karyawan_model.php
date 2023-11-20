<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class karyawan_model extends CI_Model {
    
    public function get_karyawan($id=null){
        if($id==null){
            return $this->db->get('t_karyawan');
        }else{
            return $this->db->get_where('t_karyawan',['id_karyawan'=>$id]);
        }
    }
}

?>