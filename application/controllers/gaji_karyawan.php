<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class gaji_karyawan extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['level'])){
            redirect(base_url('auth'));
        }
        
        if($_SESSION['level'] >2 || $_SESSION['level'] ==0 ){
            redirect(base_url('dashboard'));
        }
        $this->load->model('karyawan_model','karyawan');
        $this->load->model('gaji_model','gaji');
    }
    
	public function index()
	{
        $data['judul'] = 'Data Gaji Karyawan';
        $data['dept'] = $this->karyawan->get_dept()->result();
        $data['view'] = 'gaji/index_gaji_karyawan';
        $this->load->view('index',$data);
    }

    public function proses_penggajian(){
        $data['judul'] = 'Proses Penggajian Karyawan';
        $data['dept'] = $this->karyawan->get_dept()->result();
        $data['view'] = 'gaji/proses_penggajian';
        $this->load->view('index',$data);
    }

    public function insert(){
        $xBegin = $this->input->post('xBegin');
        $xEnd = $this->input->post('xEnd');
        $id_gaji = $this->input->post('id_gaji');
        $id_karyawan = $this->input->post('id_karyawan');
        $hitungan_kerja = $this->input->post('hitungan_kerja');
        $gaji_pokok = $this->input->post('gaji_pokok');
        $jml_hadir = $this->input->post('jml_hadir');
        $bonus = $this->input->post('bonus');
        $jml_tdk_hadir = $this->input->post('jml_tdk_hadir');
        $tidak_hadir = $this->input->post('tidak_hadir');
        $jml_telat_masuk = $this->input->post('jml_telat_masuk');
        $telat_masuk = $this->input->post('telat_masuk');
        $total_terima = $this->input->post('total_terima');
        $total_row = count($id_karyawan);

        for($i=0;$i<$total_row;$i++){
            $ttl_gaji_pokok = 0;
            $ttl_gaji_pokok = ($hitungan_kerja[$i]=='Bulanan') ? $gaji_pokok[$i] : $gaji_pokok[$i] * $jml_hadir[$i];
            $ttl_tidak_hadir = 0;
            $ttl_tidak_hadir = $tidak_hadir[$i] * $jml_tdk_hadir[$i];
            $ttl_telat_masuk = 0;
            $ttl_telat_masuk = $telat_masuk[$i] * $jml_telat_masuk[$i];

            $values = [
                'tgl_gajian' => date('Y-m-d'),
                'tgl_awal' => $xBegin,
                'tgl_akhir' => $xEnd,
                'id_gaji' => $id_gaji[$i], 
                'id_karyawan' => $id_karyawan[$i], 
                'jml_hadir' => $jml_hadir[$i], 
                'jml_tidak_hadir' => $jml_tdk_hadir[$i], 
                'jml_telat_masuk' => $jml_telat_masuk[$i], 
                'ttl_gaji_pokok' => $ttl_gaji_pokok, 
                'ttl_bonus' => $bonus[$i], 
                'ttl_tidak_hadir' => $ttl_tidak_hadir, 
                'ttl_telat_masuk' => $ttl_telat_masuk, 
                'total_terima' => $total_terima[$i], 
            ];
            $this->global_model->insert_data('t_gaji_karyawan',$values);
        }
        $output = [
            'status' => 1,
            'pesan' => 'Berhasil Menyimpan Data Gaji Karyawan',
            'post' => $_POST,
            'values' => $values
        ];
        echo json_encode($output);
    }

    public function delete($id=null){
        if($id==null){
            notifikasi(true,'Gagal Menggapus data gaji karyawan !!!');
            redirect(base_url('gaji_karyawan'));
        }
        
        $where = ['id_gk'=>$id];
        $this->global_model->delete_data('t_gaji_karyawan',$where);
        notifikasi(true,'Data Gaji Karyawan Berhasil di Hapus !!!');
        redirect(base_url('gaji_karyawan'));
    }

    //DATATABLES GAJI KARYAWAN
    public function get_data(){
        $xBegin = $this->input->post('xBegin',TRUE);
        $xEnd   = $this->input->post('xEnd',TRUE);
        $id_dept   = $this->input->post('dept',TRUE);
        $id_dept = ($id_dept == 'All') ? nuLL : $id_dept;
        
        $column_order = array('k.id_karyawan', 'k.nama', 'nama_jabatan', 'nama_dept', 'gaji_pokok','hitungan_kerja','tgl_gajian');
                    
        $list = $this->gaji->get_datatables($column_order, $xBegin, $xEnd,$id_dept);
        
        $data   = array();
        foreach ($list->result() as $key) {
            $row      = array();

            $row['id']              = $key->id_gk;
            $row['nik']             = $key->nik;
            $row['nama']   	 	    = $key->nama;
            $row['nama_jabatan']    = $key->nama_jabatan;
            $row['nama_dept']       = $key->nama_dept;
            $row['gaji_pokok']    = number_format($key->gaji_pokok);
            $row['hitungan_kerja']    = $key->hitungan_kerja;
            $row['total_terima']    = number_format($key->total_terima);
            $row['tgl_gaji']        = $key->tgl_gaji;
            
            $data[]   = $row;
        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsFiltered"   => $list->num_rows(),
            "recordsTotal"      => $this->gaji->total_entri($xBegin, $xEnd),
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

        $gaji_karyawan = $this->gaji->get_gaji_karyawan(null,$xBegin,$xEnd,$id_dept);

        $total_terima = 0;
        if($gaji_karyawan){
            $total_row = $gaji_karyawan->num_rows();

            $no = 1;
            foreach($gaji_karyawan->result() as $key){
                // <td class="text-center">'.$no++.'</td>  
                $isi_tabel .= '<tr>
                        <td class="text-center">'.$key->tgl_gaji.'</td>  
                      <td>'.$key->nik.'</td>  
                      <td>'.$key->nama.'</td>  
                      <td>'.$key->nama_jabatan.'</td>  
                      <td>'.$key->nama_dept.'</td>  
                      <td class="text-center">'.$key->hitungan_kerja.'</td>  
                      <td class="text-right">'.number_format($key->gaji_pokok).'</td>  
                      <td class="text-right">'.number_format($key->jml_hadir).'</td>  
                      <td class="text-right">'.number_format($key->ttl_bonus).'</td>  
                      <td class="text-right">'.number_format($key->ttl_gaji_pokok).'</td>  
                      <td class="text-right">'.number_format($key->jml_tidak_hadir).'</td>  
                      <td class="text-right">'.number_format($key->ttl_tidak_hadir).'</td>  
                      <td class="text-right">'.number_format($key->jml_telat_masuk).'</td>  
                      <td class="text-right">'.number_format($key->ttl_telat_masuk).'</td>  
                      <td class="text-right">'.number_format($key->ttl_tidak_hadir + $key->ttl_telat_masuk).'</td>  
                      <td class="text-right">'.number_format($key->total_terima).'</td>  
                <tr>';
                $total_terima += $key->total_terima;
            }
        }
        
        $output = [
            'total_data' => $total_row,
            'isi_tabel' => $isi_tabel,
            'periode' => date('d M Y',strtotime($xBegin)).' - '.date('d M Y',strtotime($xEnd)),
            'total_terima' => number_format($total_terima),
        ];
        echo json_encode($output);
    }
    
    public function print(){
        $this->load->view('gaji/laporan_gaji_karyawan');
    }

}