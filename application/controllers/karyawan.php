<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class karyawan extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }
    
	public function index()
	{
        $data['judul'] = 'Data Karyawan';
        $data['view'] = 'karyawan/index_karyawan';
		$this->load->view('index',$data);
	}
}