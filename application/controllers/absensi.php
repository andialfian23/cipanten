<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class absensi extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['level'])){
            redirect(base_url('auth'));
        } 
        if($_SESSION['level'] > 2){
            redirect(base_url('dashboard'));
        }
        $this->load->model('karyawan_model','karyawan');
        $this->load->model('absensi_model','absensi');
    }
    
	public function index()
	{
        $data['judul'] = 'Data Absensi';
        $data['dept'] = $this->karyawan->get_dept()->result();
        $data['view'] = 'absensi/index_absensi';
		$this->load->view('index',$data);
	}

    public function update(){
        $id_absensi = $this->input->post('id',TRUE);
        $waktu = $this->input->post('waktu',TRUE);

        if($id_absensi==null || $waktu==null){
            $output = [
                'status' => 0,
                'pesan' => 'Gagal Edit'
            ];
        }else{
            $where = ['id_absensi'=>$id_absensi];
            $cek_absensi = $this->db->get_where('t_absensi',$where);
            if($cek_absensi->num_rows() > 0){
                $set = [
                    'waktu' => $this->input->post('waktu',true),
                ];
                $this->global_model->update_data('t_absensi',$set,$where);
                $output = [
                    'status' => 1,
                    'pesan' => 'Edit Waktu Absensi Berhasil'
                ];
            }else{
                $output = [
                    'status' => 0,
                    'pesan' => 'Gagal Edit'
                ];
            }
        }
        
        echo json_encode($output);
    }

    public function delete($id_karyawan=null,$tgl=null){
        if($id_karyawan==null || $tgl==null){
            redirect(base_url('absensi'));
        }
        $where = ['id_karyawan'=>$id_karyawan,'tanggal'=>$tgl];
        $this->global_model->delete_data('t_absensi',$where);
        
        redirect(base_url('absensi'));
    }

    public function delete2(){
        $id_absensi = $this->input->post('id',TRUE);
        if($id_absensi==null){
            $output = [
                'status' => 0,
                'pesan' => 'Gagal Menghapus Data'
            ];
        }else{
            $where = ['id_absensi'=>$id_absensi];
            $cek_absensi = $this->db->get_where('t_absensi',$where);
            if($cek_absensi->num_rows() > 0){
                $this->global_model->delete_data('t_absensi',$where);
                $output = [
                    'status' => 1,
                    'pesan' => 'Menghapus Data Waktu Absensi Berhasil'
                ];
            }else{
                $output = [
                    'status' => 0,
                    'pesan' => 'Gagal Menghapus Data'
                ];
            }
        }
        
        echo json_encode($output);
    }

    //DATATABLES
    public function get_data(){
        $xBegin = $this->input->post('xBegin',TRUE);
        $xEnd   = $this->input->post('xEnd',TRUE);
        $id_dept   = $this->input->post('dept',TRUE);

        $id_dept = ($id_dept == 'All') ? nuLL : $id_dept;
        
        $column_order   = array('a.id_karyawan', 'k.nama', 'nama_jabatan', 'nama_dept', 
                    'a.tanggal','waktu_masuk','telat_masuk','waktu_pulang','waktu_kerja');
                    
        $list = $this->absensi->get_datatables($column_order, $xBegin, $xEnd,$id_dept);
       
        $data   = array();
        foreach ($list->result() as $key) {
            $row      = array();

            $row['nik']             = $key->nik;
            $row['nama']   	 	    = $key->nama;
            $row['nama_jabatan']    = $key->nama_jabatan;
            $row['nama_dept']       = $key->nama_dept;
            $row['tanggal']         = $key->tanggal;
            $row['waktu_masuk']     = date('H:i:s',strtotime($key->tanggal.' '.$key->waktu_masuk));
            $row['telat_masuk']     = date('H:i:s',strtotime($key->tanggal.' '.$key->telat_masuk));
            $row['waktu_pulang']    = date('H:i:s',strtotime($key->tanggal.' '.$key->waktu_pulang));
            $row['waktu_kerja']     = date('H:i:s',strtotime($key->tanggal.' '.$key->waktu_kerja));
            
            $data[]   = $row;
        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsFiltered"   => $list->num_rows(),
            "recordsTotal"      => $this->absensi->total_entri($xBegin, $xEnd),
            "data"              => $data,
        );

        echo json_encode($output);
    }

    //REPORT
    public function get_data_print(){
        $output = [];
        $total_row = 0;
        $isi_tabel = '';

        $xBegin = $this->input->post('xBegin',TRUE);
        $xEnd   = $this->input->post('xEnd',TRUE);
        $id_dept = $this->input->post('dept',TRUE);
        $id_dept = ($id_dept == 'All') ? nuLL : $id_dept;

        $absensi = $this->absensi->get_absensi(null,'ASC',$xBegin,$xEnd,$id_dept);

        if($absensi){
            $total_row = $absensi->num_rows();

            $no = 1;
            foreach($absensi->result() as $key){
                $isi_tabel .= '<tr>
                      <td class="text-center">'.$no++.'</td>  
                      <td>'.$key->nik.'</td>  
                      <td>'.$key->nama.'</td>  
                      <td>'.$key->nama_jabatan.'</td>  
                      <td>'.$key->nama_dept.'</td>  
                      <td class="text-center">'.$key->tanggal.'</td>
                      <td class="text-center">'.$key->waktu_masuk.'</td>
                      <td class="text-center">'.$key->telat_masuk.'</td>
                      <td class="text-center">'.$key->waktu_pulang.'</td>
                      <td class="text-center">'.$key->waktu_kerja.'</td>
                <tr>';
            }
        }
        
        $output = [
            'total_data' => $total_row,
            'isi_tabel' => $isi_tabel,
            'periode' => date('d M Y',strtotime($xBegin)).' - '.date('d M Y',strtotime($xEnd)),
        ];
        echo json_encode($output);
    }
    
    public function print(){
        $this->load->view('absensi/laporan_absensi');
    }

    //GET DATA UNTUK EDIT ABSENSI
    public function get_absensi(){
        $input_nik = $this->input->post('nik',TRUE);
        $input_tgl = $this->input->post('tgl',TRUE);
        $nik = null;
        $nama = null;
        $dept = null;
        $jabatan = null;
        $data_waktu = [];
        $absensi = $this->absensi->get_1data($input_nik,$input_tgl);
        foreach($absensi->result() as $key){
            $data_waktu[] = [
                'id'=>$key->id_absensi,
                'waktu'=>$key->waktu,
            ];
            $nik = $key->id_karyawan;
            $nama = $key->nama;
            $dept = $key->nama_dept;
            $jabatan = $key->nama_jabatan;
        }
        $output = [
            'nik' => $nik,
            'nama' => $nama,
            'dept' => $dept,
            'jabatan' => $jabatan,
            'data_waktu' => $data_waktu,
        ];
        echo json_encode($output);
    }
}