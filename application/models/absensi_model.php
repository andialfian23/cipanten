<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class absensi_model extends CI_Model {
    
    public function get_absensi($id=null,$order='DESC',$start=null,$end=null){
        
        $this->db->select('k.nama, a.id_karyawan as nik, a.tanggal, 
                    waktu_masuk, waktu_pulang, TIMEDIFF(waktu_pulang,waktu_masuk) as waktu_kerja,
                    nama_jabatan, nama_dept')
                ->from('(SELECT id_karyawan,tanggal, min(waktu) as waktu_masuk, max(waktu) as waktu_pulang FROM t_absensi GROUP BY tanggal,id_karyawan) a');
               
        $this->db->join('t_karyawan k', 'a.id_karyawan=k.id_karyawan', 'LEFT')
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

    public function get_absensi_karyawan($xBegin,$xEnd,$dept){

        return $this->db->query("SELECT k.id_karyawan as nik, nama, 
                    nama_jabatan, nama_dept, 
                    count(tanggal)as jml_hadir, absen, jam_kerja,
                    gaji_pokok, hitungan_kerja, telat_masuk, tidak_hadir
                FROM (SELECT tanggal, 
                        ab.id_karyawan, 
                        min(waktu) as waktu_masuk, max(waktu) as waktu_pulang, 
                        CASE WHEN TIMEDIFF(max(waktu), min(waktu)) >= jam_kerja THEN 'OK' ELSE 'NOT OK' END as absen
                        FROM t_absensi ab
                        INNER JOIN t_karyawan ak ON ab.id_karyawan = ak.id_karyawan
                        INNER JOIN t_gaji kg ON ak.id_dept = kg.id_dept and ak.id_jabatan = kg.id_jabatan
                        WHERE tanggal BETWEEN '$xBegin' AND '$xEnd'
                        GROUP BY tanggal,id_karyawan) a
                RIGHT JOIN t_karyawan k ON a.id_karyawan = k.id_karyawan 
                INNER JOIN t_jabatan j ON k.id_jabatan = j.id_jabatan 
                INNER JOIN t_dept d ON k.id_dept = d.id_dept
                INNER JOIN t_gaji g ON k.id_jabatan = g.id_jabatan AND k.id_dept = g.id_dept
                WHERE absen = 'OK' 
                    AND nama_dept = '$dept'
                GROUP BY a.id_karyawan
                ORDER BY k.id_karyawan ASC");
    }
}

?>