<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class gaji_karyawan extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['level'])){
            redirect(base_url('auth'));
        }
        
        if($_SESSION['level'] >2 || $_SESSION['level'] ==0 ){
            redirect(base_url('dashboard'));
        }
        $this->load->model('karyawan_model','karyawan');
        $this->load->model('gaji_model','gaji');
    }
    
	public function index()
	{
        $data['judul'] = 'Data Gaji Karyawan';
        $data['gaji_karyawan'] = $this->gaji->get_gaji_karyawan()->result();
        $data['view'] = 'gaji/index_gaji_karyawan';
        $this->load->view('index',$data);
    }

    public function proses_penggajian(){
        $data['judul'] = 'Proses Penggajian Karyawan';
        $data['dept'] = $this->karyawan->get_dept()->result();
        $data['view'] = 'gaji/proses_penggajian';
        $this->load->view('index',$data);
    }

    public function insert(){
        $xBegin = $this->input->post('xBegin');
        $xEnd = $this->input->post('xEnd');
        $id_gaji = $this->input->post('id_gaji');
        $id_karyawan = $this->input->post('id_karyawan');
        $hitungan_kerja = $this->input->post('hitungan_kerja');
        $gaji_pokok = $this->input->post('gaji_pokok');
        $jml_hadir = $this->input->post('jml_hadir');
        $bonus = $this->input->post('bonus');
        $jml_tdk_hadir = $this->input->post('jml_tdk_hadir');
        $tidak_hadir = $this->input->post('tidak_hadir');
        $jml_telat_masuk = $this->input->post('jml_telat_masuk');
        $telat_masuk = $this->input->post('telat_masuk');
        $total_terima = $this->input->post('total_terima');
        $total_row = count($id_karyawan);

        for($i=0;$i<$total_row;$i++){
            $ttl_gaji_pokok = 0;
            $ttl_gaji_pokok = ($hitungan_kerja[$i]=='Bulanan') ? $gaji_pokok[$i] : $gaji_pokok[$i] * $jml_hadir[$i];
            $ttl_tidak_hadir = 0;
            $ttl_tidak_hadir = $tidak_hadir[$i] * $jml_tdk_hadir[$i];
            $ttl_telat_masuk = 0;
            $ttl_telat_masuk = $telat_masuk[$i] * $jml_telat_masuk[$i];

            $values = [
                'tgl_gajian' => date('Y-m-d'),
                'tgl_awal' => $xBegin,
                'tgl_akhir' => $xEnd,
                'id_gaji' => $id_gaji[$i], 
                'id_karyawan' => $id_karyawan[$i], 
                'jml_hadir' => $jml_hadir[$i], 
                'jml_tidak_hadir' => $jml_tdk_hadir[$i], 
                'jml_telat_masuk' => $jml_telat_masuk[$i], 
                'ttl_gaji_pokok' => $ttl_gaji_pokok, 
                'ttl_bonus' => $bonus[$i], 
                'ttl_tidak_hadir' => $ttl_tidak_hadir, 
                'ttl_telat_masuk' => $ttl_telat_masuk, 
                'total_terima' => $total_terima[$i], 
            ];
            $this->global_model->insert_data('t_gaji_karyawan',$values);
        }
        $output = [
            'status' => 1,
            'pesan' => 'Berhasil Menyimpan Data Gaji Karyawan',
            'post' => $_POST,
            'values' => $values
        ];
        echo json_encode($output);
    }

    public function delete($id=null){
        if($id==null){
            notifikasi(true,'Gagal Menggapus data gaji karyawan !!!');
            redirect(base_url('gaji_karyawan'));
        }
        
        $where = ['id_gk'=>$id];
        $this->global_model->delete_data('t_gaji_karyawan',$where);
        notifikasi(true,'Data Gaji Karyawan Berhasil di Hapus !!!');
        redirect(base_url('gaji_karyawan'));
    }

}