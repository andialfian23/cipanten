<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class absensi extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('absensi_model','absensi');
    }
    
	public function index()
	{
        $data['judul'] = 'Data Absensi';
        $data['absensi'] = $this->absensi->get_absensi(null,'ASC')->result();
        $data['view'] = 'absensi/index_absensi';
		$this->load->view('index',$data);
	}

    public function update($id=null){
        if($id==null){
            redirect(base_url('absensi'));
        }
    }

    public function delete($id=null,$tgl=null){
        if($id==null || $tgl==null){
            redirect(base_url('absensi'));
        }
        $where = ['id_karyawan'=>$id,'tanggal'=>$tgl];
        $this->global_model->delete_data('t_absensi',$where);
        
        redirect(base_url('absensi'));
    }
}