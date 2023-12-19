<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class scan_qr extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['level'])){
            redirect(base_url('auth'));
        }
    }
    
	public function index()
	{
        $data['judul'] = 'Scan QR-Code';
        $data['view'] = 'scan_qr/index_scan';
		$this->load->view('index',$data);
	}

    public function proses_scan(){
        $output = [];
        $nilai_qr = $this->input->post('no_qr', TRUE);

        //configurasi waktu
        $waktu = date("Y-m-d");
        //Mengecek anggota tersebut terdaftar atau tidak
        $cek = $this->db->get_where('t_karyawan', ['id_karyawan' => $nilai_qr,'status'=>'Aktif']);
        if ($cek->num_rows() > 0) {  //Jika terdaftar, maka :
            //Mengecek member pada tabel absen berdasarkan id_member dan tgl_absen
            $karyawan = $cek->row();
          
            //Melakukan input data pada tabel absensi
            $values = [
                'id_karyawan' => $karyawan->id_karyawan,
                'tanggal' => $waktu,
                'waktu' => date('H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $this->global_model->insert_data('t_absensi', $values);
            
            $status =1;
            $pesan = 'Absensi Masuk Berhasil';
            
        } else { //member Tidak Terdaftar
            $status =0;
            $pesan = 'ID Karyawan Tidak Terdaftar';
        }
        
        $output = [
            'nilai_qr' => $nilai_qr,
            'status' => $status,
            'pesan' => $pesan,
        ];

        echo json_encode($output);
    }
}