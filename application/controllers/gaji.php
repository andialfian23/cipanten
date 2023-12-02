<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class gaji extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->model('karyawan_model','karyawan');
        $this->load->model('gaji_model','gaji');
    }
    
	public function index()
	{
        $data['judul'] = 'Data Gaji';
        $data['gaji'] = $this->gaji->get_gaji()->result();
        $data['jabatan'] = $this->karyawan->get_jabatan()->result();
        $data['dept'] = $this->karyawan->get_dept()->result();
        $data['view'] = 'gaji/index_gaji';
		$this->load->view('index',$data);
	}

    public function create(){
        $notif = [
            'required'=> "{field} Harus di isi",
            'numeric'=> "{field} hanya berupa angka",
        ];
        $this->form_validation->set_rules('nama_gaji', 'Nama Gaji', 'trim|required', $notif);
        $this->form_validation->set_rules('gaji_pokok', 'Gaji Pokok', 'trim|required|numeric', $notif);
        $this->form_validation->set_rules('potongan', 'Potongan', 'trim|required|numeric', $notif);
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim',$notif);
        
        if ($this->form_validation->run() == FALSE){
            $output = [
                'status'=> 0,
                'pesan' => 'Gagal menyimpan data gaji',
                'form_error' => [
                    'nama_gaji' => form_error('nama_gaji'),
                    'gaji_pokok' => form_error('gaji_pokok'),
                    'potongan' => form_error('potongan'),
                    'keterangan' => form_error('keterangan'),
                ],
                'set_value' => [
                    'nama_gaji' => set_value('nama_gaji'),
                    'gaji_pokok' => set_value('gaji_pokok'),
                    'potongan' => set_value('potongan'),
                    'keterangan' => set_value('keterangan'),
                ],
            ];
        }else{
            $values = [
                'id_dept' => $this->input->post('nama_dept',true),
                'id_jabatan' => $this->input->post('nama_jabatan',true),
                'nama_gaji' => $this->input->post('nama_gaji',true),
                'gaji_pokok' => $this->input->post('gaji_pokok',true),
                'potongan' => $this->input->post('potongan',true),
                'potongan_per' => $this->input->post('potongan_per',true),
                'keterangan' => $this->input->post('keterangan',true),
                ];
            $this->global_model->insert_data('t_gaji',$values);
            $output = [
                'status'=> 1,
                'pesan' => 'Berhasil menyimpan data gaji'
            ];
        }
        echo json_encode($output);
    }

    public function delete($id=null){
        if($id==null){
            redirect(base_url('gaji'));
        }

        $where = ['id_gaji'=>$id];
        $this->global_model->delete_data('t_gaji',$where);
        redirect(base_url('gaji'));
    }

    public function get_slip_gaji(){
        $id = $this->input->post('id',TRUE);

        $gaji = $this->gaji->get_gaji($id)->row();

        $item = [];
        $item_gaji = $this->gaji->get_item_gaji($gaji->id_gaji)->result();
        foreach($item_gaji as $i){
            $row = [];
            $row = [
                'id_igj'    => $i->id_igj,
                'jenis'     => $i->jenis,
                'nama_item' => $i->nama_item,
                'nominal'   => $i->nominal
            ];
            $item[] = $row;
        }

        $output = [];
        $output = [
            'gaji' => [
                'nama_gaji' => $gaji->nama_gaji,
                'gaji_pokok' => $gaji->gaji_pokok,
                'keterangan' => $gaji->keterangan,
            ],
            'item' => $item
        ];
        echo json_encode($output);
    }
}