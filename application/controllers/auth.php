<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {
    
	public function index()
	{
        $this->load->view('auth/login');
	}

    public function login(){
        $output = [];

        $status = 0;

        $this->form_validation->set_rules('username', 'Username', 'trim|required', ['required'=> "{field} Harus di isi"]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', ['required'=> "{field} Harus di isi"]);

        if ($this->form_validation->run() == FALSE){
            $output = [
                'status' => $status,
                'pesan' => 'Login Gagal',
                'form_error' => [
                    'username' => form_error('username'),
                    'password' => form_error('password'),
                ],
            ];
        }else{
            $username = $this->input->post('username',TRUE);
            $password = $this->input->post('password',TRUE);
    
            $cek_login = $this->global_model->auth($username,$password);
            if($cek_login->num_rows() > 0){
                $user = $cek_login->row();
                $url = 'dashboard';
                $_SESSION['username'] = $username;
                $_SESSION['level'] = $user->level;
                if($user->level == 1){
                    $_SESSION['nama'] = 'Administrator';
                }else if($user->level == 5){
                    $_SESSION['nama'] = 'Scan QR-Code';
                    $url = 'dashboard2';
                }else{
                    $_SESSION['nama'] = $user->nama;
                    $_SESSION['id_karyawan'] = $user->id;
                    $_SESSION['nik'] = $user->id_karyawan;
                    $_SESSION['id_dept'] = $user->id_dept;
                }
                
                $output = [
                    'status' => 1,
                    'pesan' => 'Login Berhasil',
                    'base_url' => $url, 
                ];
            }else{
                $output = [
                    'status' => 0,
                    'pesan' => 'Username atau Password Salah',
                    'form_error' => [
                        'username' => '',
                        'password' => '',
                    ],
                ];
            }
        }

        echo json_encode($output);
    }

    public function logout(){
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('id_karyawan');
        $this->session->unset_userdata('nik');
        $this->session->unset_userdata('id_dept');
        
        notifikasi(true,'Berhasil Logout !!!');
        redirect(base_url('auth'));
    }
}