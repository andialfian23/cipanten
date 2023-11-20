<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }
    
	public function index()
	{
        $data['judul'] = 'Dashboard';
        $data['view'] = 'dashboard/home';
		$this->load->view('index',$data);
	}
}