<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between">
                <div class="">
                    <h5>Data Gaji Karyawan</h5>
                </div>
                <div class="ml-auto">
                    <a href="#" class="btn bg-gradient-primary">Tambah Gaji
                        Karyawan</a>
                </div>
            </div>
            <div class="card-body px-3 py-3 pb-2">

                <div class="table-responsive p-2">
                    <table class="table table-bordered table-striped table-hover table-sm" border="2"
                        id="tbl-gaji-karyawan" width="100%">
                        <thead class="bg-gradient-dark text-white">
                            <tr>
                                <th class="font-weight-bolder">No</th>
                                <th class="font-weight-bolder">NIK</th>
                                <th class="font-weight-bolder">Nama</th>
                                <th class="font-weight-bolder">Jabatan</th>
                                <th class="font-weight-bolder">Bagian</th>
                                <th class="font-weight-bolder">Gaji</th>
                                <th>--</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($gaji_karyawan as $row){ ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td class="text-center"><?= $row->nik ?></td>
                                <td>
                                    <a href="#preview" data-id="<?= $row->id_gk ?>" class="btn-view"
                                        data-toggle="modal">
                                        <b><?= $row->nama ?></b>
                                    </a>
                                </td>
                                <td><?= $row->nama_jabatan ?></td>
                                <td><?= $row->nama_dept ?></td>
                                <td><?= number_format($row->total) ?></td>
                                <td class="text-center align-middle d-flex">
                                    <!-- <a href="<?= base_url('gaji_karyawan/update/'.$row->id_gk) ?>"
                                        class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a> -->
                                    <a href="<?= base_url('gaji_karyawan/delete/'.$row->id_gk) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i
                                            class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            <?php $no++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-navy">
                <b class="modal-title" id="exampleModalLabel">
                    Slip Gaji Karyawan Wisata Situ Cipanten
                </b>
                <button type="button" class="btn btn-close text-white" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">


                        <p class="text-center mb-3">
                            <b id="nama_gj">Gaji Bulanan</b> - <b id="bagian">IT</b><br />
                            <b id="tgl_gaji">02 Des 2023</b>
                        </p>

                        <hr />

                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td class="text-center">NIK</td>
                                    <td class="text-center">Nama Karyawan</td>
                                    <td class="text-center">Jabatan</td>
                                </tr>
                                <tr>
                                    <th class="text-center" id="nik">160099</th>
                                    <th class="text-center" id="nama">Andi Alfian</th>
                                    <th class="text-center" id="jabatan">STAFF</th>
                                </tr>
                            </tbody>
                        </table>


                        <hr />

                        <table class="table table-bordered table-sm mb-2 border-1" width="100%" id="tbl-item-gaji">
                            <tbody>
                                <tr>
                                    <th colspan="4">Gaji</td>
                                </tr>
                                <tr>
                                    <td colspan="1" width="50%">Gaji Pokok</td>
                                    <td id="gaji_pokok" class="text-right">2,600,000</td>
                                    <td id="jml_hadir" class="text-center">x 1</td>
                                    <td id="ttl_gaji" class="text-right">2,600,000</td>
                                </tr>
                                <tr>
                                    <td colspan="3" width="50%">Bonus</td>
                                    <td id="ttl_bonus" class="text-right">190,000</td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-center">Total Gaji</th>
                                    <th id="total_gaji" class="text-right">2,790,000</th>
                                </tr>
                                <tr>
                                    <th colspan="4">Potongan</td>
                                </tr>
                                <tr>
                                    <td colspan="1" width="50%">Tidak Hadir</td>
                                    <td id="potongan" class="text-right">86,667</td>
                                    <td class="text-center">x 4</td>
                                    <td id="ttl_potongan" class="text-right">346,668</td>
                                </tr>
                                <tr>
                                    <td colspan="1" width="50%">Telat Masuk</td>
                                    <td id="telat_masuk" class="text-right">5,000</td>
                                    <td class="text-center"></td>
                                    <td id="ttl_telat_masuk" class="text-right">0</td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-center">Total Potongan</th>
                                    <th id="ttl" class="text-right">346,668</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-center">Total Terima</th>
                                    <th id="total_gaji" class="text-right">2,443,332</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p id="ket"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer  bg-gradient-navy">
                <button type="button" class="btn btn-sm bg-gradient-primary" data-dismiss="modal">Print</button>
                <button type="button" class="btn btn-sm bg-gradient-danger" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>


<script>
$(function() {
    $('#tbl-gaji-karyawan').DataTable();
});
</script>