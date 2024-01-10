<div class="row">
    <div class="col-lg-12">
        <div class="card card-success card-outline mb-4">
            <div class="card-header d-flex justify-content-between">
                <div class="">
                    <h5>Data Gaji</h5>
                </div>
                <div class="ml-auto">
                    <a href="#modal-add" data-toggle="modal" class="btn btn-primary btn-sm" id="btn-create">Tambah Data
                        Gaji</a>
                </div>
            </div>
            <div class="card-body px-3 py-3 pb-2">
                <div class="table-responsive p-2">
                    <table class="table table-bordered table-striped table-hover table-sm w-100" border="2"
                        id="tbl-gaji">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th class="font-weight-bolder text-center" rowspan="2">No</th>
                                <th class="font-weight-bolder text-center" rowspan="2">Bagian</th>
                                <th class="font-weight-bolder text-center" rowspan="2">Jabatan</th>
                                <th class="font-weight-bolder text-center" rowspan="2">Nama Gaji</th>
                                <th class="font-weight-bolder text-center" rowspan="2">Gaji Pokok</th>
                                <th class="font-weight-bolder text-center" rowspan="2">Hitungan<br />Kerja</th>
                                <th class="font-weight-bolder text-center" colspan="2">Potongan Gaji</th>
                                <th class="font-weight-bolder text-center" rowspan="2">--</th>
                            </tr>
                            <tr>
                                <th class="font-weight-bolder text-center">Telat<br />Masuk</th>
                                <th class="font-weight-bolder text-center">Tidak<br />Hadir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($gaji as $row){ ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td><?= $row->nama_dept ?></td>
                                <td><?= $row->nama_jabatan ?></td>
                                <td><?= $row->nama_gaji ?></td>
                                <td class="text-right"><?= number_format($row->gaji_pokok) ?></td>
                                <td><?= $row->hitungan_kerja ?></td>
                                <td class="text-right"><?= number_format($row->telat_masuk) ?></td>
                                <td class="text-right"><?= number_format($row->tidak_hadir) ?></td>
                                <td class="text-center align-middle">
                                    <a href="#modal-add" data-toggle="modal" class="badge badge-info p-1 btn-edit"
                                        data-id="<?= $row->id_gaji ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= base_url('gaji/delete/'.$row->id_gaji) ?>"
                                        class="badge badge-danger p-1"
                                        onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i
                                            class="fas fa-trash-alt"></i> Hapus</a>
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

<script>
$(function() {
    $('#tbl-gaji').DataTable({
        responsive: true,
        language: {
            url: "<?= base_url('extra-libs/ID.json') ?>",
        },
    });

    $(document).on('click', '#btn-create', function() {
        $('#btn-save-edit').hide();
        $('#btn-save').show();
        $('#title-modal').html('Tambah Data Gaji');
    });

    $(document).on('click', '#btn-save', function() {
        $('#modal-add input, #modal-add select').removeClass('is-invalid');
        $('#modal-add small').html('');

        if ($('#nama_dept').val() == '') {
            $('#nama_dept').addClass('is-invalid');
            $('#notif_nama_dept').html('Bagian Masih belum Dipilih');
            return false;
        }
        if ($('#nama_jabatan').val() == '') {
            $('#nama_jabatan').addClass('is-invalid');
            $('#notif_nama_jabatan').html('Jabatan Masih belum Dipilih');
            return false;
        }

        $.ajax({
            url: '<?= base_url('gaji/create') ?>',
            type: 'POST',
            data: {
                nama_jabatan: $('#nama_jabatan').val(),
                nama_dept: $('#nama_dept').val(),
                nama_gaji: $('#nama_gaji').val(),
                gaji_pokok: $('#gaji_pokok').val(),
                hitungan_kerja: $('#hitungan_kerja').val(),
                telat_masuk: $('#telat_masuk').val(),
                tidak_hadir: $('#tidak_hadir').val(),
                keterangan: $('#keterangan').val(),
            },
            dataType: 'json',
            success: function(res) {
                if (res.status == 0) {
                    if (res.form_error != null) {
                        toastr.error(res.pesan);
                        if (res.form_error.nama_gaji != '') {
                            $('#nama_gaji').addClass('is-invalid');
                            $('#nama_gaji').val(res.set_value.nama_gaji);
                            $('#notif_nama_gaji').html(res.form_error.nama_gaji);
                        }
                        if (res.form_error.gaji_pokok != '') {
                            $('#gaji_pokok').addClass('is-invalid');
                            $('#gaji_pokok').val(res.set_value.gaji_pokok);
                            $('#notif_gaji_pokok').html(res.form_error.gaji_pokok);
                        }
                        if (res.form_error.telat_masuk != '') {
                            $('#telat_masuk').addClass('is-invalid');
                            $('#telat_masuk').val(res.set_value.telat_masuk);
                            $('#notif_telat_masuk').html(res.form_error.telat_masuk);
                        }
                        if (res.form_error.tidak_hadir != '') {
                            $('#tidak_hadir').addClass('is-invalid');
                            $('#tidak_hadir').val(res.set_value.tidak_hadir);
                            $('#notif_tidak_hadir').html(res.form_error.tidak_hadir);
                        }
                        return false;
                    }
                } else {
                    toastr.success(res.pesan);
                    setTimeout(() => {
                        window.location.replace('<?= base_url('gaji') ?>');
                    }, 1000);
                }
            }
        });
    });

    $(document).on('click', '.btn-edit', function() {
        $('#btn-save').hide();
        $('#btn-save-edit').show();
        $('#id_gaji').val($(this).data('id'));
        $('#title-modal').html('Edit Data Gaji');
        $.ajax({
            url: '<?= base_url('gaji/get_data') ?>',
            type: 'POST',
            data: {
                id_gaji: $(this).data('id'),
            },
            dataType: 'json',
            success: function(res) {
                $('#nama_dept').val(res.data.id_dept).trigger('change');
                $('#nama_jabatan').val(res.data.id_jabatan).trigger('change');
                $('#hitungan_kerja').val(res.data.hitungan_kerja).trigger('change');
                $('#nama_gaji').val(res.data.nama_gaji);
                $('#gaji_pokok').val(res.data.gaji_pokok);
                $('#telat_masuk').val(res.data.telat_masuk);
                $('#tidak_hadir').val(res.data.tidak_hadir);
            }
        });
    });

    $(document).on('click', '#btn-save-edit', function() {
        $('#modal-add input, #modal-add select').removeClass('is-invalid');
        $('#modal-add small').html('');

        $.ajax({
            url: '<?= base_url('gaji/update') ?>',
            type: 'POST',
            data: {
                nama_jabatan: $('#nama_jabatan').val(),
                nama_dept: $('#nama_dept').val(),
                nama_gaji: $('#nama_gaji').val(),
                gaji_pokok: $('#gaji_pokok').val(),
                hitungan_kerja: $('#hitungan_kerja').val(),
                telat_masuk: $('#telat_masuk').val(),
                tidak_hadir: $('#tidak_hadir').val(),
                id_gaji: $('#id_gaji').val(),
            },
            dataType: 'json',
            success: function(res) {
                if (res.status == 0) {
                    toastr.error(res.pesan);
                } else {
                    toastr.success(res.pesan);
                    setTimeout(() => {
                        window.location.replace('<?= base_url('gaji') ?>');
                    }, 2000);
                }
            }
        });
    });
})
</script>


<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Tambah Data Gaji</h5>
                <button type="button" class="btn btn-close bg-gradient-danger " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_dept">Bagian</label>
                    <select name="nama_dept" id="nama_dept" class="form-control form-control-sm">
                        <option value="" hidden>-- Pilih Bagian --</option>
                        <?php foreach($dept as $d){ ?>
                        <option value="<?= $d->id_dept ?>"><?= $d->nama_dept ?></option>
                        <?php } ?>
                    </select>
                    <small id="notif_nama_dept" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="nama_jabatan">Jabatan</label>
                    <select name="nama_jabatan" id="nama_jabatan" class="form-control form-control-sm">
                        <option value="" hidden>-- Pilih Jabatan --</option>
                        <?php foreach($jabatan as $d){ ?>
                        <option value="<?= $d->id_jabatan ?>"><?= $d->nama_jabatan ?></option>
                        <?php } ?>
                    </select>
                    <small id="notif_nama_jabatan" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="nama_gaji">Nama Gaji</label>
                    <input type="text" class="form-control form-control-sm" id="nama_gaji" name="nama_gaji">
                    <small id="notif_nama_gaji" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="gaji_pokok">Gaji Pokok</label>
                    <div class="input-group input-group-sm">
                        <input type="number" class="form-control form-control-sm" id="gaji_pokok" name="gaji_pokok">
                        <span class="input-group-append">
                            <select name="hitungan_kerja" id="hitungan_kerja" class="form-control form-control-sm">
                                <option value="Harian">Harian</option>
                                <option value="Bulanan">Bulanan</option>
                            </select>
                        </span>
                    </div>
                    <small id="notif_gaji_pokok" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="potongan">Potongan Gaji</label>
                    <div class="d-flex justify-content-between">
                        <div class="input-group input-group-sm mb-3">
                            <input type="number" class="form-control form-control-sm" id="telat_masuk"
                                name="telat_masuk" placeholder="Telat Masuk">
                            <div class="input-group-append">
                                <span class="input-group-text">per jam</span>
                            </div>
                            <small id="notif_telat_masuk" class="text-danger"></small>
                        </div>
                        &nbsp;
                        <div class="input-group input-group-sm mb-3">
                            <input type="number" class="form-control form-control-sm" id="tidak_hadir"
                                name="tidak_hadir" placeholder="Tidak Hadir">
                            <div class="input-group-append">
                                <span class="input-group-text">per hari</span>
                            </div>
                        </div>
                        <small id="notif_tidak_hadir" class="text-danger"></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_gaji" id="id_gaji">
                <button type="submit" class="btn bg-gradient-primary" id="btn-save">Simpan</button>
                <button type="submit" class="btn bg-gradient-primary" id="btn-save-edit">Simpan</button>
            </div>
        </div>
    </div>
</div>