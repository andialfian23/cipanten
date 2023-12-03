<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class json extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('absensi_model','absensi');
        $this->load->model('gaji_model','gaji');
    }
    
	public function absensi()
	{
        $output = [];
        $date = date('Y-m-d');
        $absensi = $this->absensi->get_absensi(null,'DESC',$date,$date);
        $output = [
            'status' => 1,
            'data'=> $absensi->result()
        ];
        echo json_encode($output);
	}

    public function get_slip_gaji(){
        $id_gk =  $this->input->post('id',TRUE);
        $gaji_karyawan = $this->gaji->get_gaji_karyawan($id_gk);
        if($gaji_karyawan->num_rows() > 0){
            $key = $gaji_karyawan->row();
            $data = [
                'nik'           => $key->nik,
                'nama'          => $key->nama,
                'nama_jabatan'  => $key->nama_jabatan,
                'nama_dept'     => $key->nama_dept,
                
                'tgl_gaji'      => $key->tgl_gaji,
                'nama_gaji'     => $key->nama_gaji,
                'gaji_pokok'    => number_format($key->gaji_pokok),
                'telat_masuk'   => $key->telat_masuk != 0 ? number_format($key->telat_masuk) : '',
                'tidak_hadir'   => $key->tidak_hadir != 0 ? number_format($key->tidak_hadir) : '',
                
                'jml_hadir'       => ($key->jml_hadir!= 0)?'x '.$key->jml_hadir : '',
                'jml_tidak_hadir' => ($key->jml_tidak_hadir != 0)?'x '.$key->jml_tidak_hadir : '',
                'jml_telat_masuk' => ($key->jml_telat_masuk != 0)?'x '.$key->jml_telat_masuk : '',

                'ttl_gaji_pokok'    => number_format($key->ttl_gaji_pokok),
                'ttl_bonus'         => number_format($key->ttl_bonus),
                'ttl_telat_masuk'   => number_format($key->ttl_telat_masuk),
                'ttl_tidak_hadir'   => number_format($key->ttl_tidak_hadir),
                'ttl_gaji'          => number_format($key->ttl_gaji_pokok + $key->ttl_bonus),
                'ttl_potongan'      => number_format($key->ttl_telat_masuk + $key->ttl_tidak_hadir),
                'total_terima'      => number_format($key->total_terima),
            ];
            $output = [
                'status'=> 1,
                'data' => $data,
            ];
        }else{
            $output = [
                'status'=> 0,
                'pesan' => 'Data Tidak Ditemukan'
            ];
        }
        echo json_encode($output);
    }
}