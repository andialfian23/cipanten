<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class karyawan extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->model('karyawan_model','karyawan');
    }
    
	public function index()
	{
        $data['judul'] = 'Data Karyawan';
        $data['karyawan'] = $this->karyawan->get_karyawan()->result();
        $data['view'] = 'karyawan/index_karyawan';
		$this->load->view('index',$data);
	}

    public function create(){
        $notif = ['required'=> "{field} Harus di isi"];
        $this->form_validation->set_rules('id_karyawan', 'ID Karyawan', 'trim|required', $notif);
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', $notif);
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required',$notif);
        $this->form_validation->set_rules('foto', 'Foto', 'trim');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', $notif);
        $this->form_validation->set_rules('no_hp', 'No HP', 'trim|required', $notif);
        $this->form_validation->set_rules('join_at', 'Bergabung Sejak', 'trim|required', $notif);
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required', $notif);
        $this->form_validation->set_rules('departemen', 'Departemen', 'trim|required', $notif);
       
        if ($this->form_validation->run() == FALSE)
        {
            $data['judul'] = 'Tambah Data Karyawan';
            $data['view'] = 'karyawan/tambah_karyawan';
            $this->load->view('index',$data);
        }else{
            $values = [
                'id_karyawan' => $this->input->post('id_karyawan',true),
                'nama' => $this->input->post('nama',true),
                'jk' => $this->input->post('jk',true),
                'tgl_lahir' => $this->input->post('tgl_lahir',true),
                'alamat' => $this->input->post('alamat',true),
                'no_hp' => $this->input->post('no_hp',true),
                'foto' => null,
                'join_at' => $this->input->post('join_at',true),
                'id_jabatan' => $this->input->post('jabatan',true),
                'id_dept' => $this->input->post('departemen',true),
                'status' => 'Aktif',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ];
            $this->global_model->insert_data('t_karyawan',$values);
            redirect(base_url('karyawan'));
        }
    }

    public function update($id=null){
        if($id==null){
            redirect(base_url('karyawan'));
        }
        
        $notif = ['required'=> "{field} Harus di isi"];
        $this->form_validation->set_rules('id_karyawan', 'ID Karyawan', 'trim|required', $notif);
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', $notif);
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required',$notif);
        $this->form_validation->set_rules('foto', 'Foto', 'trim');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', $notif);
        $this->form_validation->set_rules('no_hp', 'No HP', 'trim|required', $notif);
        $this->form_validation->set_rules('join_at', 'Bergabung Sejak', 'trim|required', $notif);
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required', $notif);
        $this->form_validation->set_rules('departemen', 'Departemen', 'trim|required', $notif);
       
        if ($this->form_validation->run() == FALSE)
        {
            $data['judul'] = 'Edit Data Karyawan';
            $data['karyawan'] = $this->karyawan->get_karyawan($id)->row();
            $data['view'] = 'karyawan/edit_karyawan';
            $this->load->view('index',$data);
        }else{
            $set = [
                'id_karyawan' => $this->input->post('id_karyawan',true),
                'nama' => $this->input->post('nama',true),
                'jk' => $this->input->post('jk',true),
                'tgl_lahir' => $this->input->post('tgl_lahir',true),
                'alamat' => $this->input->post('alamat',true),
                'no_hp' => $this->input->post('no_hp',true),
                'join_at' => $this->input->post('join_at',true),
                'id_jabatan' => $this->input->post('jabatan',true),
                'id_dept' => $this->input->post('departemen',true),
                'status' => 'Aktif',
                'updated_at' => date('Y-m-d'),
            ];
            $where = ['id_karyawan'=>$id];
            $this->global_model->update_data('t_karyawan',$set,$where);
            redirect(base_url('karyawan'));
        }
        
    }

    public function delete($id=null){
        if($id==null){
            redirect(base_url('karyawan'));
        }
        $where = ['id_karyawan'=>$id];
        $this->global_model->delete_data('t_karyawan',$where);
        redirect(base_url('karyawan'));
    }
}