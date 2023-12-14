<?php  

function notifikasi($type, $pesan){
    $ini = get_instance();
    $warna =  ($type == true) ? 'success' : 'danger';
    $ini->session->set_flashdata('message', '<div class="alert alert-'.$warna.' alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    '.$pesan.'
  </div>');
}

?>