<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class json extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('absensi_model','absensi');
    }
    
	public function absensi()
	{
        $output = [];
        $date = date('Y-m-d');
        $absensi = $this->absensi->get_absensi(null,'DESC',$date,$date);
        $output = [
            'status' => 1,
            'data'=> $absensi->result()
        ];
        echo json_encode($output);
	}
}