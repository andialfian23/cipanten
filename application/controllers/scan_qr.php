<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class scan_qr extends CI_Controller {

    public function __construct(){
        parent::__construct();
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
            $where = ['id_karyawan' => $karyawan->id_karyawan, 'tanggal' => $waktu];
            $cek_absen = $this->db->get_where('t_absensi', $where);
            if ($cek_absen->num_rows() > 0) {  //data member ditemukan, maka :
                $absen = $cek_absen->row();
                if($absen->waktu_masuk == null){
                    $set = [
                        'waktu_pulang' => date('H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                    $where2 = ['id_absensi'=> $absen->id_absensi];
                    $this->global_model->update_data('t_absensi',$set,$where2);
                    $status =1;
                    $pesan = "Absensi Pulang berhasil";
                }else{
                    $status =0;
                    $pesan = "Absensi sudah dilakukan sebelumnya";
                }
            } else { //data absen tidak ditemukan, maka :
                //Melakukan input data pada tabel member
                $values = [
                    'id_karyawan' => $karyawan->id_karyawan,
                    'tanggal' => $waktu,
                    'waktu_masuk' => date('H:i:s'),
                    'waktu_pulang' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $this->global_model->insert_data('t_absen', $values);
                
                $status =1;
                $pesan = 'Absensi Masuk Berhasil';
            }
        } else { //member Tidak Terdaftar
            $status =0;
            $pesan = 'ID Karyawan Tidak Terdaftar';
        }
        
        $output = [
            'pesan' => $pesan,
            'status' => $status
        ];

        echo json_encode($output);
    }
}