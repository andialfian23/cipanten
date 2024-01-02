<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        if(!isset($_SESSION['level'])){
            redirect(base_url('auth'));
        }
        
        if($_SESSION['level'] != 1){
            redirect(base_url('dashboard'));
        }
        
        $this->load->model('karyawan_model','karyawan');
    }

    public function index(){
        $data['judul'] = 'Manajemen User';
        $data['view'] = 'user/index_user';
        $data['user'] = $this->karyawan->get_users()->result();
        $this->load->view('index',$data);
    }

    public function ubah_level(){
        $id_user = $this->input->post('id_user',TRUE);
        $level = $this->input->post('level',TRUE);
        $where = ['id_user'=>$id_user];
        $set = ['level'=> $level];
        $this->global_model->update_data('t_user',$set,$where);
        $output = ['status'=> 1,'pesan'=>'Berhasil Mengubah Level'];
        echo json_encode($output);
    }
}

?>