<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jabatan extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['level'])){
            redirect(base_url('auth'));
        }
        if($_SESSION['level'] != 1){
            redirect(base_url('dashboard'));
        }
    }
    
	public function index()
	{
        $data['judul'] = 'Data Jabatan';
        $data['jabatan'] = $this->db->get('t_jabatan')->result();
        $data['dept'] = $this->db->get('t_dept')->result();
        $data['view'] = 'jabatan/index_jabatan';
		$this->load->view('index',$data);
	}

    public function create(){
        $this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 
        'trim|required|is_unique[t_jabatan.nama_jabatan]', 
        ['required'=> "{field} Harus di isi",'is_unique'=> '{field} sudah ada.']);
       
        if ($this->form_validation->run() == FALSE)
        {
            $output = [
                'status'=> 0,
                'pesan' => 'Gagal menyimpan data jabatan',
                'form_error' => form_error('nama_jabatan'),
                'set_value' => set_value('nama_jabatan')
            ];
        }else{
            $values = [
                'nama_jabatan' => strtoupper($this->input->post('nama_jabatan',true)),
                ];
            $this->global_model->insert_data('t_jabatan',$values);
            $output = [
                'status'=> 1,
                'pesan' => 'Berhasil Menyimpan Data Jabatan'
            ];
        }

        echo json_encode($output);
    }

    public function update(){
        $id_jabatan = $this->input->post('id_jabatan'); 
        $nama_jabatan = $this->input->post('nama_jabatan');
        $status = 0;
        $pesan = 'Gagal Mengedit Data Jabatan';

        $where = ['id_jabatan'=>$id_jabatan];
        $cek_jabatan = $this->db->get_where('t_jabatan',$where);
        if($cek_jabatan->num_rows() > 0){
            $set = ['nama_jabatan' => $nama_jabatan];
            $this->global_model->update_data('t_jabatan',$set,$where);
            $status = 1;
            $pesan='Berhasil Mengubah Data Jabatan';
        }

        $output = [
            'status' => $status,
            'pesan' => $pesan,
        ];
        echo json_encode($output);
    }

    public function delete($id){
        if($id==null){
            redirect(base_url('jabatan'));
        }
        $where = ['id_jabatan'=>$id];
        $this->global_model->delete_data('t_jabatan',$where);
        notifikasi(true,'Berhasil Menghapus Data Jabatan');
        redirect(base_url('jabatan'));
    }

    public function get_jabatan(){
        $id_jabatan = $this->input->post('id_jabatan',TRUE);
        $status = 0;
        $data = [];
        $jabatan = $this->db->get_where('t_jabatan',['id_jabatan'=>$id_jabatan]);
        if($jabatan->num_rows() > 0){
            $data = $jabatan->row();
            $status = 1;
        }
        $output = [
            'status' => $status,
            'data' => $data,
        ];
        echo json_encode($output);
    }
}