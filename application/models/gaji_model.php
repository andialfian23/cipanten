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

    public function get_gaji_karyawan($id=null,$xBegin=null,$xEnd=null,$id_dept=null){ 
        $this->db->select('k.id_karyawan as nik, nama, nama_jabatan, nama_dept, 
            gk.*, DATE_FORMAT(tgl_gajian,"%d %M %Y") as tgl_gaji, tgl_awal, tgl_akhir,
            nama_gaji, gaji_pokok, hitungan_kerja, telat_masuk, tidak_hadir, keterangan')
            ->from('t_gaji_karyawan gk')
            ->join('t_gaji g','gk.id_gaji=g.id_gaji','LEFT')
            ->join('t_karyawan k','gk.id_karyawan=k.id','LEFT')
            ->join('t_jabatan j','k.id_jabatan=j.id_jabatan','LEFT')
            ->join('t_dept d','k.id_dept=d.id_dept','LEFT');

        if($id!=null){
            $this->db->where('id_gk',$id);
        }
        
        if($xBegin !=null){
            $this->db->where('gk.tgl_gajian >=',$xBegin.' 00:00:00');
        }
        
        if($xEnd !=null){
            $this->db->where('gk.tgl_gajian <=',$xEnd.' 23:59:59');
        }
        
        if($id_dept !=null){
            $this->db->where('d.id_dept',$id_dept);
        }

        $this->db->order_by('tgl_gajian','ASC');
        $this->db->order_by('k.id_karyawan','ASC');
        return $this->db->get();
    }

    public function pengeluaran($start=null,$end){
        $this->db->select('sum(total_terima) as jml')->from('t_gaji_karyawan');
        if($start !=null){
            $this->db->where('tgl_gajian >=',$start);
        }
        $this->db->where('tgl_gajian <=',$end);
        return $this->db->get();
    }

    //DATATABLE GAJI KARYAWAN
    public function get_datatables($column_order, $xBegin = null, $xEnd = null,$id_dept=null,$id_k=null)
    {
        $column_search = $column_order;
        
        $this->db->select('k.id_karyawan as nik, nama, nama_jabatan, nama_dept, 
                gk.*, DATE_FORMAT(tgl_gajian,"%d %M %Y") as tgl_gaji, tgl_awal, tgl_akhir,
                nama_gaji, gaji_pokok, hitungan_kerja, telat_masuk, tidak_hadir, keterangan')
                ->from('t_gaji_karyawan gk')
                ->join('t_gaji g','gk.id_gaji=g.id_gaji','LEFT')
                ->join('t_karyawan k','gk.id_karyawan=k.id','LEFT')
                ->join('t_jabatan j','k.id_jabatan=j.id_jabatan','LEFT')
                ->join('t_dept d','k.id_dept=d.id_dept','LEFT');
        

        if($xBegin !=null){
            $this->db->where('gk.tgl_gajian >=', $xBegin.' 00:00:00');
        }
        
        if($xEnd !=null){
            $this->db->where('gk.tgl_gajian <=', $xEnd.' 23:59:59');
        }
        
        if($id_dept !=null){
            $this->db->where('d.id_dept',$id_dept);
        }
        if($id_k !=null){
            $this->db->where('gk.id_karyawan',$id_k);
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
            $this->db->order_by('gk.tgl_gajian','ASC');
            $this->db->order_by('nama_dept','ASC');
            $this->db->order_by('k.id_karyawan','ASC');
        }
        
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        } 

        $query = $this->db->get();
        if ($query) {
            return $query;
        }else{
            return false;
        }
    }
    
    public function total_entri($xBegin = null, $xEnd = null,$id_k=null)
    {
        $this->db->from('t_gaji_karyawan');
                
        if($xBegin !=null){
            $this->db->where('tgl_gajian >=',$xBegin.' 00:00:00');
        }
        
        if($xEnd !=null){
            $this->db->where('tgl_gajian <=',$xEnd.' 23:59:59');
        }

        if($id_k !=null){
            $this->db->where('id_karyawan',$id_k);
        }
        
        return $this->db->count_all_results();
    }
    
}