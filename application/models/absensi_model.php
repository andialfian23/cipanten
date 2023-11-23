<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class absensi_model extends CI_Model {
    
    public function get_absensi($id=null,$order='DESC',$start=null,$end=null){
        $this->db->select('id_absensi, tanggal, shift, waktu_masuk, waktu_pulang,
                    k.*, nama_jabatan, nama_dept')
                ->from('t_absensi a')
                ->join('t_karyawan k', 'a.id_karyawan=k.id_karyawan', 'LEFT')
                ->join('t_jabatan j','k.id_jabatan=j.id_jabatan','LEFT')
                ->join('t_dept d','k.id_dept=d.id_dept','LEFT');
        if($id!=null){
            $this->db->where(['id_absensi'=>$id]);
        }
        if($start !=null){
            $this->db->where('tanggal >=',$start);
        }
        if($end !=null){
            $this->db->where('tanggal <=',$end);
        }

        $order = ($order=='DESC')??'ASC';

        $this->db->order_by('tanggal',$order);
        $this->db->order_by('shift',$order);
        $this->db->order_by('waktu_masuk',$order);
        $this->db->order_by('waktu_pulang',$order);
        
        return $this->db->get();
    }
}

?>