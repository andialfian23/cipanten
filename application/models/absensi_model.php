<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class absensi_model extends CI_Model {
    
    public function get_absensi($id=null,$order='DESC',$start=null,$end=null){

        $this->db->select('k.nama, a.id_karyawan as nik, a.tanggal, waktu_masuk, waktu_pulang,
                   nama_jabatan, nama_dept')
                ->from('(SELECT id_karyawan, tanggal, MIN(waktu) as waktu_masuk 
                    FROM t_absensi GROUP BY id_karyawan,tanggal ORDER BY waktu ASC) a')
                ->join('(SELECT id_karyawan, tanggal, MAX(waktu) as waktu_pulang 
                    FROM t_absensi GROUP BY id_karyawan,tanggal ORDER BY waktu DESC) b', 'a.id_karyawan =b.id_karyawan and a.tanggal = b.tanggal', 'INNER')
                ->join('t_karyawan k', 'a.id_karyawan=k.id_karyawan', 'LEFT')
                ->join('t_jabatan j','k.id_jabatan=j.id_jabatan','LEFT')
                ->join('t_dept d','k.id_dept=d.id_dept','LEFT');
        if($id!=null){
            $this->db->where(['a.id_absensi'=>$id]);
        }
        if($start !=null){
            $this->db->where('a.tanggal >=',$start);
        }
        if($end !=null){
            $this->db->where('a.tanggal <=',$end);
        }

        $order = ($order=='DESC')??'ASC';

        $this->db->order_by('a.tanggal',$order);
        $this->db->order_by('waktu_masuk',$order);
        $this->db->order_by('waktu_pulang',$order);
        
        return $this->db->get();
    }
}

?>