<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5>Data Karyawan</h5>
            </div>
            <div class="card-body px-3 py-3 pb-2">
                <a href="<?= base_url('karyawan/create') ?>" class="btn btn-primary">Tambah Data Karyawan</a>
                <div class="table-responsive p-2">
                    <table class="table table-bordered table-striped table-hover table-sm" border="2" id="tbl-karyawan">
                        <thead class="bg-gradient-dark text-white">
                            <tr>
                                <th class="font-weight-bolder">
                                    No
                                </th>
                                <th class="font-weight-bolder">
                                    NIK
                                </th>
                                <th class="font-weight-bolder">Nama</th>
                                <th class="font-weight-bolder">Jabatan</th>
                                <th class="font-weight-bolder">Dept</th>
                                <th class="font-weight-bolder">No HP</th>
                                <th class="font-weight-bolder">Alamat</th>
                                <th>--</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($karyawan as $row){ ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td class="text-center"><?= $row->id_karyawan ?></td>
                                <td>
                                    <a href="#preview" data-id="<?= $row->id_karyawan ?>" class="btn-view"
                                        data-toggle="modal">
                                        <b><?= $row->nama ?></b>
                                    </a>
                                </td>
                                <td><?= $row->nama_jabatan ?></td>
                                <td><?= $row->nama_dept ?></td>
                                <td><?= $row->no_hp ?></td>
                                <td><?= $row->alamat ?></td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('karyawan/update/'.$row->id_karyawan) ?>"
                                        class="btn btn-info btn-sm">Edit</a>
                                    <a href="<?= base_url('karyawan/delete/'.$row->id_karyawan) ?>"
                                        class="btn btn-danger btn-sm">Delete</a>
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
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-navy">
                <h5 class="modal-title" id="exampleModalLabel">Detail Karyawan</h5>
                <button type="button" class="btn btn-close text-white" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <img src="#" alt="" class="img-thumbnail" id="img-preview" />
                    </div>
                    <div class="col-lg-8">
                        <table class="table table-bordered table-sm" width="100%">
                            <tr>
                                <td>NIK</td>
                                <th id="nik"></th>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <th id="nama"></th>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <th id="tgl_lahir"></th>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <th id="alamat"></th>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <th id="no_hp"></th>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <th id="jabatan"></th>
                            </tr>
                            <tr>
                                <td>Gabung Sejak</td>
                                <th id="join_at"></th>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <th id="status"></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer  bg-gradient-navy">
                <button type="submit" class="btn bg-gradient-primary" id="create-qr">Buat QRCode</button>
                <a href="#" class="btn bg-gradient-success" id="btn-print-card">Cetak
                    Kartu</a>
                <button type="button" class="btn bg-gradient-danger" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    $('#tbl-karyawan').DataTable();

    $(document).on('click', '.btn-view', function() {
        let id = $(this).data('id');
        $.ajax({
            url: '<?= base_url('karyawan/detail') ?>',
            type: 'POST',
            data: {
                nik: id
            },
            dataType: 'json',
            success: function(res) {
                $('#img-preview').removeAttr('src');
                $('#img-preview').attr('src', '<?= base_url('images/foto/') ?>' + res
                    .data.foto);
                $('#nik').html(res.data.nik);
                $('#nama').html(res.data.nama);
                $('#jk').html(res.data.jk);
                $('#tgl_lahir').html(res.data.tgl_lahir);
                $('#alamat').html(res.data.alamat);
                $('#no_hp').html(res.data.no_hp);
                $('#jabatan').html(res.data.jabatan);
                $('#join_at').html(res.data.join_at);
                $('#status').html(res.data.status);

                $('#btn-print-card').removeAttr('href');
                $('#btn-print-card').attr('href',
                    '<?= base_url('karyawan/id_card/') ?>' + res.data.nik);
            }
        });
    });

    $(document).on('click', '#create-qr', function() {
        $.ajax({
            url: '<?= base_url('karyawan/buat_qr') ?>',
            type: 'POST',
            data: {
                nik: $('#nik').text(),
            },
            dataType: 'json',
            success: function(res) {
                $('#img-preview').attr('src', '<?= base_url('images/qrcode/') ?>' + res);
            }
        });
    });
});
</script>