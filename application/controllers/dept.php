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

    public function update(){
        $id_dept = $this->input->post('id_dept'); 
        $nama_dept = $this->input->post('nama_dept');
        $status = 0;
        $pesan = 'Gagal Mengedit Data Bagian';

        $where = ['id_dept'=>$id_dept];
        $cek_dept = $this->db->get_where('t_dept',$where);
        if($cek_dept->num_rows() > 0){
            $set = ['nama_dept' => $nama_dept];
            $this->global_model->update_data('t_dept',$set,$where);
            $status = 1;
            $pesan='Berhasil Mengubah Data Bagian';
        }

        $output = [
            'status' => $status,
            'pesan' => $pesan,
        ];
        echo json_encode($output);
    }

    public function get_dept(){
        $id_dept = $this->input->post('id_dept',TRUE);
        $status = 0;
        $data = [];
        $dept = $this->db->get_where('t_dept',['id_dept'=>$id_dept]);
        if($dept->num_rows() > 0){
            $data = $dept->row();
            $status = 1;
        }
        $output = [
            'status' => $status,
            'data' => $data,
        ];
        echo json_encode($output);
    }
}