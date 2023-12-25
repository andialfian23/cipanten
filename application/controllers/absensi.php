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

    public function update($id=null){
        if($id==null){
            redirect(base_url('absensi'));
        }
    }

    public function delete($id=null,$tgl=null){
        if($id==null || $tgl==null){
            redirect(base_url('absensi'));
        }
        $where = ['id_karyawan'=>$id,'tanggal'=>$tgl];
        $this->global_model->delete_data('t_absensi',$where);
        
        redirect(base_url('absensi'));
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
        foreach ($list as $key) {
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
            "recordsFiltered"   => $this->absensi->total_terfilter($column_order, $xBegin, $xEnd),
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
}