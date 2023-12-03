<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class gaji_model extends CI_Model {
    
    public function get_gaji($id=null){
        $this->db->select('g.*, nama_jabatan, nama_dept')
        ->from('t_gaji g')
        ->join('t_jabatan j','g.id_jabatan=j.id_jabatan','LEFT')
        ->join('t_dept d','g.id_dept=d.id_dept','LEFT');
        
        if($id!=null){
            $this->db->where('id_gaji',$id);
        }else{
            $this->db->order_by('nama_dept','ASC');
            $this->db->order_by('nama_jabatan','ASC');
            $this->db->order_by('nama_gaji','ASC');
        }
        return $this->db->get();
    }

    public function get_gaji_karyawan($id=null){
        $this->db->select('k.id_karyawan as nik, nama, nama_jabatan, nama_dept, gk.*, DATE_FORMAT(tanggal,"%d %M %Y") as tgl_gaji, 
            nama_gaji, gaji_pokok, hitungan_kerja, telat_masuk, tidak_hadir, keterangan')
            ->from('t_gaji_karyawan gk')
            ->join('t_gaji g','gk.id_gaji=g.id_gaji','LEFT')
            ->join('t_karyawan k','gk.id_karyawan=k.id','LEFT')
            ->join('t_jabatan j','k.id_jabatan=j.id_jabatan','LEFT')
            ->join('t_dept d','k.id_dept=d.id_dept','LEFT');

        if($id==null){
            $this->db->order_by('id_karyawan','ASC');
        }else{
            $this->db->where('id_gk',$id);
        }
        return $this->db->get();
    }
}