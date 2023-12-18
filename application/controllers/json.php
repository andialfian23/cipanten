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
            $total_gaji = $key->ttl_gaji_pokok + $key->ttl_bonus;
            $total_potongan = $key->ttl_telat_masuk + $key->ttl_tidak_hadir;
            $data = [
                'nik'           => $key->nik,
                'nama'          => $key->nama,
                'nama_jabatan'  => $key->nama_jabatan,
                'nama_dept'     => $key->nama_dept,
                
                'period_gj'      => date('d M Y',strtotime($key->tgl_awal)).' - '.date('d M Y',strtotime($key->tgl_akhir)),
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
                'ttl_gaji'          => number_format($total_gaji),
                'ttl_potongan'      => number_format($total_potongan),
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

    public function get_hitung_gaji_karyawan(){
        $xBegin = $this->input->post('xBegin',TRUE);
        $xEnd = $this->input->post('xEnd',TRUE);
        $id_dept = $this->input->post('dept',TRUE);

        $timestamp1 = strtotime($xBegin);
        $timestamp2 = strtotime($xEnd);
        // Menghitung selisih waktu dalam detik
        $selisih_detik = $timestamp2 - $timestamp1;
        // Menghitung jumlah hari dari selisih waktu
        $jumlah_hari = $selisih_detik / (60 * 60 * 24);
        
        $total_row = 0;
        $array_karyawan = [];
        $data = $this->absensi->get_absensi_karyawan($xBegin,$xEnd,$id_dept);
        $status =0;
        if($data){
            $total_row = $data->num_rows();
            $array_karyawan = [];
            if($total_row > 0){
                foreach($data->result() as $key){
                    if($key->hitungan_kerja =='Harian'){
                        $total_gaji = ($key->gaji_pokok * $key->jml_hadir);
                    }else{
                        $total_gaji = $key->gaji_pokok;
                    }
    
                    $tidak_hadir = $jumlah_hari - $key->jml_hadir;
    
                    $pot_tidak_hadir = $tidak_hadir * $key->tidak_hadir;

                    $pot_telat_masuk = ($key->jml_telat / 3600) * $key->telat_masuk; 
    
                    $total_potongan = $pot_tidak_hadir + $pot_telat_masuk;

                    $terima_gaji = $total_gaji - $total_potongan;
    
                    //jika kehadiran 0  maka terima_gaji 0
                    if($key->jml_hadir == 0){
                        $terima_gaji = 0;
                    }else{
                        $terima_gaji = $terima_gaji;
                    }
    
                    $jml_telat_masuk = ($key->jml_telat / 3600);
    
                    $array_karyawan[] = [
                        'id' => $key->id,
                        'nik' => $key->nik,
                        'nama' => $key->nama,
                        'nama_jabatan' => $key->nama_jabatan,
                        'nama_dept' => $key->nama_dept,
                        'jml_hadir' => $key->jml_hadir,
                        'jml_tidak_hadir' => $tidak_hadir,
                        'jml_telat_masuk' => $jml_telat_masuk,
                        'hitungan_kerja' => $key->hitungan_kerja,
                        'id_gaji' => $key->id_gaji,
                        'gaji_pokok' => intval($key->gaji_pokok),
                        'tidak_hadir' => ($key->tidak_hadir)?intval($key->tidak_hadir):0,
                        'telat_masuk' => ($key->telat_masuk)?intval($key->telat_masuk):0,
                        'total_gaji' => intval($total_gaji),
                        'total_potongan' => $total_potongan,
                        'terima_gaji' => $terima_gaji
                    ]; 
                }
                $status = 1;
            }
        }
        
        $output = [
            'status'=>$status,
            'total_data' => $total_row,
            'data_karyawan' => $array_karyawan,
            'xBegin' =>  $xBegin,
            'xEnd' => $xEnd,
            'jumlah_hari' => $jumlah_hari
        ];
        
        echo json_encode($output);
    }
}