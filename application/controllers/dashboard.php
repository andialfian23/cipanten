<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('karyawan_model','karyawan');
    }
    
	public function index()
	{
        $data['judul'] = 'Dashboard';
        $data['jml_karyawan'] = $this->karyawan->jml_karyawan();
        $data['view'] = 'dashboard/home';
		$this->load->view('index',$data);
	}
}