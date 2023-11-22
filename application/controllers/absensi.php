<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class absensi extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }
	public function index()
	{
        $data['judul'] = 'Data Absensi';
        $data['absensi'] = $this->db->get('t_absensi')->result();
        $data['view'] = 'absensi/index_absensi';
		$this->load->view('index',$data);
	}

    public function update($id_absensi){
        //
    }
}