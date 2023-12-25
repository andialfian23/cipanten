<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['level'])){
            redirect(base_url('auth'));
        }
        $this->load->model('gaji_model','gaji');
        $this->load->model('karyawan_model','karyawan');
    }
    
	public function index()
	{
        $data['judul'] = 'Dashboard';
        $data['jml_karyawan'] = $this->karyawan->jml_karyawan();
        $data['jml_bulan_ini'] = $this->gaji->pengeluaran(date('Y-m-01'),date('Y-m-d'))->row()->jml;
        $data['jml_tahun_ini'] = $this->gaji->pengeluaran(date('Y-01-01'),date('Y-m-d'))->row()->jml;
        $data['jml_selama_ini'] = $this->gaji->pengeluaran(null,date('Y-m-d'))->row()->jml;
        $data['view'] = 'dashboard/home';
		$this->load->view('index',$data);
	}

    public function absensi(){
        $data['view'] = 'dashboard/absensi';
		$this->load->view('index',$data);
    }
    
    public function gaji(){
        $data['view'] = 'dashboard/gaji';
		$this->load->view('index',$data);
    }
}