<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dept extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }
    
	public function index()
	{
        $data['judul'] = 'Data Bagian / Job';
        $data['dept'] = $this->db->get('t_dept')->result();
        $data['view'] = 'departemen/index_dept';
		$this->load->view('index',$data);
	}
}