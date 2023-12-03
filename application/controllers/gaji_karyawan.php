<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class gaji_karyawan extends CI_Controller {

    public function __construct(){
        parent::__construct();

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

    
}