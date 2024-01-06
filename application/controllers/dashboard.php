<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['level'])){
            redirect(base_url('auth'));
        }
        $this->load->model('gaji_model','gaji');
        $this->load->model('karyawan_model','karyawan');
    }
    
	public function index()
	{
        $data['judul'] = 'Dashboard';
        $data['jml_karyawan'] = $this->karyawan->jml_karyawan();
        $data['jml_bulan_ini'] = $this->gaji->pengeluaran(date('Y-m-01'),date('Y-m-d'))->row()->jml;
        $data['jml_tahun_ini'] = $this->gaji->pengeluaran(date('Y-01-01'),date('Y-m-d'))->row()->jml;
        $data['jml_selama_ini'] = $this->gaji->pengeluaran(null,date('Y-m-d'))->row()->jml;
        $data['view'] = 'dashboard/home';
		$this->load->view('index',$data);
	}

    public function absensi(){
        $data['judul'] = 'Absensi Harian';
        $data['view'] = 'dashboard/absensi_harian';
		$this->load->view('index',$data);
    }
    
    public function gaji(){
        $data['judul'] = 'Data Slip Gaji';
        $data['view'] = 'dashboard/slip_gaji';
		$this->load->view('index',$data);
    }

    public function ubah_password(){
        $notif = ['required'=> "{field} Harus di isi",
        'min_length'=>"{field} minimal 8 digit",
        'matches'=>"{field} tidak sama dengan Password Baru"];
        
        $this->form_validation->set_rules('password_old', 'Password Lama', 'trim|required|min_length[8]|alpha_numeric', $notif);
        $this->form_validation->set_rules('password_new', 'Password Baru', 'trim|required|min_length[8]|alpha_numeric', $notif);
        $this->form_validation->set_rules('password_conf', 'Password Konfirmasi', 'trim|required|min_length[8]|matches[password_new]|alpha_numeric', $notif);
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['judul'] = 'Ubah Password';
            $data['view'] = 'user/ubah_password';
            $this->load->view('index',$data);
        }else{
            $password_lama = $this->input->post('password_old',TRUE);
            $password_new = $this->input->post('password_new',TRUE);
            $user = $this->db->get_where('t_user',['username'=>$_SESSION['username'],'password'=>$password_lama]);
            if($user->num_rows() > 0){
                $set = ['password' => $password_new];
                $this->global_model->update_data('t_user',$set,$where);
                notifikasi(true,'Berhasil Mengubah Password');
            }else{
                notifikasi(false,'Password Lama Salah');
            }
            redirect(base_url('dashboard/ubah_password'));
        }
    }

    public function profil(){
        $karyawan = $this->karyawan->get_karyawan($_SESSION['username']);
        if($karyawan->num_rows() > 0){
            $cek_qr = $this->global_model->cek_qrcode($_SESSION['username']);
            if($cek_qr->num_rows() > 0){
                $qrcode = $cek_qr->row()->qrcode;
            }else{
                $qrcode = $this->global_model->buat_qrcode($_SESSION['username']);
            }
            
            $data['judul'] = 'Dashboard';
            $data['karyawan'] = $karyawan->row();
            $data['qrcode'] = $qrcode;
            $data['view'] = 'dashboard/profil';
            $this->load->view('index',$data);
        }else{
            notifikasi(false,'Admin tidak boleh membuka halaman profil !!!');
            redirect(base_url('dashboard'));
        }
    }
}