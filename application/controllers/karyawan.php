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
            $data['jabatan'] = $this->karyawan->get_jabatan()->result();
            $data['dept'] = $this->karyawan->get_dept()->result();
            $data['view'] = 'karyawan/tambah_karyawan';
            $this->load->view('index',$data);
        }else{
            $values = [
                'id_karyawan' => $this->input->post('id_karyawan',true),
                'nama' => strtoupper($this->input->post('nama',true)),
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
            notifikasi(true,'Berhasil Menambah Data Karyawan');
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
            $data['jabatan'] = $this->karyawan->get_jabatan()->result();
            $data['view'] = 'karyawan/edit_karyawan';
            $this->load->view('index',$data);
        }else{
            $set = [
                'id_karyawan' => $this->input->post('id_karyawan',true),
                'nama' => strtoupper($this->input->post('nama',true)),
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
            notifikasi(true,'Berhasil Memperbarui Data Karyawan');
            redirect(base_url('karyawan'));
        }
        
    }

    public function delete($id=null){
        if($id==null){
            redirect(base_url('karyawan'));
        }
        $where = ['id_karyawan'=>$id];
        $this->global_model->delete_data('t_karyawan',$where);
        notifikasi(true,'Berhasil Menghapus Data Karyawan');
        redirect(base_url('karyawan'));
    }

    public function detail(){
        $id_karyawan = $_POST['nik'];
        $karyawan = $this->karyawan->get_karyawan($id_karyawan)->row();
        $output = [];
        $detail = [
            'nik' => $karyawan->id_karyawan,
            'nama' => $karyawan->nama,
            'foto' => $karyawan->foto,
            'jk' => ($karyawan->jk=='L')?'Laki - laki':'Perempuan',
            'tgl_lahir' => date('d M Y',strtotime($karyawan->tgl_lahir)),
            'alamat' => $karyawan->alamat,
            'no_hp' => $karyawan->no_hp,
            'jabatan' => $karyawan->nama_jabatan,
            'join_at' => date('d M Y',strtotime($karyawan->join_at)),
            'status' => $karyawan->status,
        ];
        
        $output = [
            'status' =>1,
            'data' => $detail
        ];
        echo json_encode($output);
    }

    public function buat_qr(){
        $nik = $_POST['nik'];
        $cek_qr = $this->global_model->cek_qrcode($nik);
        if($cek_qr->num_rows() > 0){
            $qrcode = $cek_qr->row()->qrcode;
        }else{
            $qrcode = $this->global_model->buat_qrcode($nik);
        }
        echo json_encode($qrcode);
    }

    public function id_card($nik=null){ //print
        if($nik==null){
            redirect(base_url('karyawan'));
        }

        $data['karyawan'] = $this->karyawan->get_karyawan($nik)->row();
        $this->load->view('karyawan/id_card',$data);
    }
}