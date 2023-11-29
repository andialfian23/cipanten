<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class gaji_model extends CI_Model {
    
    public function get_gaji($id=null){
        if($id!=null){
            return $this->db->get_where('t_gaji',['id_gaji'=>$id]);
        }else{
            return $this->db->order_by('nama_gaji','ASC')->get('t_gaji');
        }
    }
}