<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }
    
	public function index()
	{
        $this->load->view('auth/login');
	}

    public function login(){
        $output = [];

        $status = 0;
        $pesan = 'Login Gagal';
        
        $output = [
            'pesan' => $pesan,
            'status' => $status
        ];

        echo json_encode($output);
    }
}