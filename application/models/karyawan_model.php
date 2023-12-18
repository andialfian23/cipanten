<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class karyawan_model extends CI_Model {
    
    public function get_karyawan($id=null){
        $this->db->select('k.*, nama_jabatan, nama_dept')
                ->from('t_karyawan k')
                ->join('t_jabatan j','k.id_jabatan=j.id_jabatan','LEFT')
                ->join('t_dept d','k.id_dept=d.id_dept','LEFT');
        if($id!=null){
            $this->db->where(['id_karyawan'=>$id]);
        }
        
        return $this->db->get();
    }

    public function get_jabatan(){
        return $this->db->order_by('nama_jabatan','ASC')->get('t_jabatan');
    }
    public function get_dept(){
        return $this->db->order_by('nama_dept','ASC')->get('t_dept');
    }

    //BUAT DI HOME
    public function jml_karyawan(){
        return $this->db->select('count(id) as jml')->from('t_karyawan')->where('Status','Aktif')->get()->row()->jml;
    }
}

?>