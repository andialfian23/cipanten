<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard2 extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['level'])){
            redirect(base_url('auth'));
        }
        $this->load->model('karyawan_model','karyawan');
    }
    
	public function index()
	{
        $data['judul'] = 'Scan QR-Code';
        $data['view'] = 'scan_qr/index_scan2';
		$this->load->view('index2',$data);
	}

    public function proses_scan(){
        $nilai_qr = $this->input->post('no_qr', TRUE);
        $output   = [];
        $data     = [];
        $waktu    = date("Y-m-d");
        
        //Mengecek nilai qrcode / id_karyawan tersebut terdaftar atau tidak
        $cek = $this->karyawan->get_karyawan($nilai_qr,'Aktif');
        if ($cek->num_rows() > 0) {  //Jika terdaftar, maka :
            $karyawan = $cek->row();
            $data = [
                'nik' => $karyawan->id_karyawan,
                'nama' => $karyawan->nama,
                'jabatan' => $karyawan->nama_jabatan,
                'dept' => $karyawan->nama_dept,
            ];
                
            $values = [
                'id_karyawan' => $karyawan->id_karyawan,
                'tanggal' => $waktu,
                'waktu' => date('H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $this->global_model->insert_data('t_absensi', $values);
            
            $status =1;
            $pesan = 'Absensi Berhasil';
        } else { //member Tidak Terdaftar
            $status =0;
            $pesan = 'ID Karyawan Tidak Terdaftar';
        }
        
        $output = [
            'status' => $status,
            'pesan' => $pesan,
            'data' => $data,
        ];

        echo json_encode($output);
    }
}