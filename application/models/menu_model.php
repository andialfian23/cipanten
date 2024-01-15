<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class menu_model extends CI_Model {
    
    public function menu_admin(){
        return [
            [
				'has-sub' => FALSE,
				'menu_link' => 'dashboard',
				'menu_text' => 'Dashboard',
				'menu_color' => '',
				'menu_icon' => 'fas fa-tachometer-alt'
			],[
				'has-sub' => FALSE,
				'menu_link' => 'karyawan',
				'menu_text' => 'Data Karyawan',
				'menu_color' => '',
				'menu_icon' => 'fas fa-users'
			],[
				'has-sub' => FALSE,
				'menu_link' => 'user',
				'menu_text' => 'Data User',
				'menu_color' => '',
				'menu_icon' => 'fas fa-users'
			],[
                'has-sub' => FALSE,
                'menu_link' => 'absensi',
                'menu_text' => 'Data Absensi',
                'menu_color' => '',
                'menu_icon' => 'fas fa-calendar-check'
			],[
				'has-sub' => FALSE,
				'menu_link' => 'jabatan',
				'menu_text' => 'Data Jabatan',
				'menu_color' => '',
				'menu_icon' => 'fas fa-crown'
            ],[
				'has-sub' => TRUE,
				'menu_text' => 'Data Penggajian',
				'menu_icon' => 'fas fa-book',
				'menu_child' =>	[
					[
						'menu_link' => 'gaji',
						'menu_text' => 'Data Gaji',
					], [
						'menu_link' => 'gaji_karyawan',
						'menu_text' => 'Gaji Karyawan',
					],
				],
			],
        ];
    }

    public function menu_bendahara(){
        return [
            [
				'has-sub' => FALSE,
				'menu_link' => 'dashboard',
				'menu_text' => 'Dashboard',
				'menu_color' => '',
				'menu_icon' => 'fas fa-tachometer-alt'
			],[
				'has-sub' => FALSE,
				'menu_link' => 'karyawan',
				'menu_text' => 'Data Karyawan',
				'menu_color' => '',
				'menu_icon' => 'fas fa-users'
			],[
                'has-sub' => FALSE,
                'menu_link' => 'absensi',
                'menu_text' => 'Data Absensi',
                'menu_color' => '',
                'menu_icon' => 'fas fa-calendar-check'
			],[
				'has-sub' => TRUE,
				'menu_text' => 'Data Penggajian',
				'menu_icon' => 'fas fa-book',
				'menu_child' =>	[
					[
						'menu_link' => 'gaji',
						'menu_text' => 'Data Gaji',
					], [
						'menu_link' => 'gaji_karyawan',
						'menu_text' => 'Gaji Karyawan',
					],
				],
			],
        ];
    }
	
    public function menu_ketua(){
        return [
            [
				'has-sub' => FALSE,
				'menu_link' => 'dashboard',
				'menu_text' => 'Dashboard',
				'menu_color' => '',
				'menu_icon' => 'fas fa-tachometer-alt'
			],[
                'has-sub' => FALSE,
                'menu_link' => 'absensi',
                'menu_text' => 'Data Absensi',
                'menu_color' => '',
                'menu_icon' => 'fas fa-calendar-check'
			],[
                'has-sub' => FALSE,
                'menu_link' => 'gaji_karyawan',
				'menu_text' => 'Data Penggajian',
                'menu_color' => '',
                'menu_icon' => 'fas fa-calendar-check'
			],
        ];
    }

    public function menu_user(){
		return [
            [
				'has-sub' => FALSE,
				'menu_link' => 'dashboard',
				'menu_text' => 'Dashboard',
				'menu_color' => '',
				'menu_icon' => 'fas fa-tachometer-alt'
			],[
                'has-sub' => FALSE,
                'menu_link' => 'dashboard/absensi',
                'menu_text' => 'Absensi Harian',
                'menu_color' => '',
                'menu_icon' => 'fas fa-calendar-check'
			],[
				'has-sub' => FALSE,
				'menu_link' => 'dashboard/gaji',
				'menu_text' => 'Data Slip Gaji',
				'menu_color' => '',
				'menu_icon' => 'fas fa-book'
			],
        ];
    }
    
}

?>