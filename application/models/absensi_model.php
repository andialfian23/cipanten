<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class absensi_model extends CI_Model {
    
    public function get_absensi($id=null,$order='DESC',$start=null,$end=null,$id_dept=null){
        
        $this->db->select("k.nama, a.id_karyawan as nik, a.tanggal, 
                    waktu_masuk, 
                    TIMEDIFF(waktu_masuk,'07:00:00') as telat_masuk,
                    waktu_pulang, 
                    TIMEDIFF(waktu_pulang,waktu_masuk) as waktu_kerja,
                    nama_jabatan, nama_dept")
                ->from('(SELECT id_karyawan,tanggal, min(waktu) as waktu_masuk, max(waktu) as waktu_pulang 
                    FROM t_absensi GROUP BY tanggal,id_karyawan) a');
               
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
        if($id_dept !=null){
            $this->db->where('d.id_dept',$id_dept);
        }

        $order = ($order=='DESC')??'ASC';

        $this->db->order_by('a.tanggal',$order);
        $this->db->order_by('waktu_masuk',$order);
        $this->db->order_by('waktu_pulang',$order);
        
        return $this->db->get();
    }

    public function get_absensi_karyawan($xBegin,$xEnd,$dept){

        return $this->db->query("SELECT id, k.id_karyawan as nik, nama, 
                    nama_jabatan, nama_dept, 
                    count(tanggal)as jml_hadir, absen, jam_kerja, sum(telat) as jml_telat, 
                    g.id_gaji, gaji_pokok, hitungan_kerja, telat_masuk, tidak_hadir
                FROM (SELECT ab.id_karyawan, 
                        tanggal,
                        min(waktu) as waktu_masuk, 
                        max(waktu) as waktu_pulang, 
                        TIMESTAMPDIFF(SECOND,CONCAT(tanggal,' 07:00:00'),CONCAT(tanggal,' ',min(waktu))) as telat,
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

    public function get_1data($id,$tgl){
        return $this->db->select('a.*, nama, nama_dept, nama_jabatan')
                ->from('t_absensi a')
                ->join('t_karyawan k', 'a.id_karyawan=k.id_karyawan', 'LEFT')
                ->join('t_jabatan j','k.id_jabatan=j.id_jabatan','LEFT')
                ->join('t_dept d','k.id_dept=d.id_dept','LEFT')
                ->where(['a.id_karyawan'=>$id,'tanggal'=>$tgl])
                ->order_by('waktu','ASC')
                ->get();
    }
    

    //DATATABLE ABSENSI
    public function get_datatables($column_order, $xBegin = null, $xEnd = null, $id_dept=null, $nik=null)
    {
        $column_search = $column_order;
        
        $this->db->select("k.nama, k.id_karyawan as nik, a.tanggal, 
                    waktu_masuk, 
                    TIMEDIFF(waktu_masuk,'07:00:00') as telat_masuk, 
                    waktu_pulang,
                    TIMEDIFF(waktu_pulang,waktu_masuk) as waktu_kerja, 
                    nama_jabatan, nama_dept")
                ->from("(SELECT id_karyawan, tanggal, min(waktu) as waktu_masuk, 
                    max(waktu) as waktu_pulang
                    FROM t_absensi GROUP BY tanggal,id_karyawan) a");    
        $this->db->join('t_karyawan k', 'a.id_karyawan=k.id_karyawan', 'LEFT')
                ->join('t_jabatan j','k.id_jabatan=j.id_jabatan','LEFT')
                ->join('t_dept d','k.id_dept=d.id_dept','LEFT');
                
        if($xBegin !=null){
            $this->db->where('a.tanggal >=',$xBegin);
        }
        
        if($xEnd !=null){
            $this->db->where('a.tanggal <=',$xEnd);
        }
        
        if($id_dept !=null){
            $this->db->where('d.id_dept',$id_dept);
        }
        
        if($nik !=null){
            $this->db->where('a.id_karyawan',$nik);
        }
 
        $i = 0;
        foreach ($column_search as $item) 
        {
            if ($_POST['search']['value']) 
            {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        
        if (isset($_POST['order'])) {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('a.tanggal','ASC');
            $this->db->order_by('waktu_masuk','ASC');
            $this->db->order_by('waktu_pulang','ASC');
        }
        
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        
        $query = $this->db->get();
        if ($query) {
            return $query;
        }
    }
    public function total_entri($xBegin = null, $xEnd = null, $nik=null)
    {
        $this->db->select('tanggal')->from('t_absensi');
                
        if($xBegin !=null){
            $this->db->where('tanggal >=',$xBegin);
        }
        
        if($xEnd !=null){
            $this->db->where('tanggal <=',$xEnd);
        }
        if($nik != null){
            $this->db->where('id_karyawan',$nik);
        }

        $this->db->group_by(['tanggal','id_karyawan']);
        // $this->db->group_by('id_karyawan');
        
        return $this->db->get()->num_rows();
    }
    
}

?>