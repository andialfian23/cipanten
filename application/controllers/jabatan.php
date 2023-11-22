<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jabatan extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }
    
	public function index()
	{
        $data['judul'] = 'Data Jabatan';
        $data['jabatan'] = $this->db->get('t_jabatan')->result();
        $data['view'] = 'jabatan/index_jabatan';
		$this->load->view('index',$data);
	}
}