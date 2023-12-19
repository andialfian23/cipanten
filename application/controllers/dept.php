<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dept extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['level'])){
            redirect(base_url('auth'));
        }
        if($_SESSION['level'] != 1){
            redirect(base_url('dashboard'));
        }
    }

    public function create(){
        $this->form_validation->set_rules('nama_dept', 'Nama Departemen', 
        'trim|required|is_unique[t_dept.nama_dept]', 
        ['required'=> "{field} Harus di isi",'is_unique'=> '{field} sudah ada.']);
       
        if ($this->form_validation->run() == FALSE)
        {
            $output = [
                'status'=> 0,
                'pesan' => 'Gagal menyimpan data Dept',
                'form_error' => form_error('nama_dept'),
                'set_value' => set_value('nama_dept')
            ];
        }else{
            $values = [
                'nama_dept' => strtoupper($this->input->post('nama_dept',true)),
                ];
            $this->global_model->insert_data('t_dept',$values);
            $output = [
                'status'=> 1,
                'pesan' => 'Berhasil Menyimpan Data Dept'
            ];
        }

        echo json_encode($output);
    }

    public function delete($id){
        if($id==null){
            redirect(base_url('dept'));
        }
        $where = ['id_dept'=>$id];
        $this->global_model->delete_data('t_dept',$where);
        notifikasi(true,'Berhasil Menghapus Data Departemen');
        redirect(base_url('jabatan'));
    }
}