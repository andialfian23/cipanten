<div class="row">
    <div class="col-lg-12">
        <div class="card card-success card-outline mb-4">
            <div class="card-header d-flex justify-content-between">
                <div class="">
                    <h5>Data Gaji</h5>
                </div>
                <div class="ml-auto">
                    <a href="#modal-add" data-toggle="modal" class="btn btn-primary" id="btn-create">Tambah Data
                        Gaji</a>
                </div>
            </div>
            <div class="card-body px-3 py-3 pb-2">
                <div class="table-responsive p-2">
                    <table class="table table-bordered table-striped table-hover table-sm" border="2" id="tbl-gaji">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th class="font-weight-bolder">No</th>
                                <th class="font-weight-bolder">Bagian</th>
                                <th class="font-weight-bolder">Jabatan</th>
                                <th class="font-weight-bolder">Nama Gaji</th>
                                <th class="font-weight-bolder">Gaji Pokok</th>
                                <th class="font-weight-bolder">Keterangan</th>
                                <th>--</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($gaji as $row){ ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td><?= $row->nama_dept ?></td>
                                <td><?= $row->nama_jabatan ?></td>
                                <td><?= $row->nama_gaji ?></td>
                                <td><?= number_format($row->gaji_pokok) ?></td>
                                <td><?= $row->keterangan ?></td>
                                <td class="text-center align-middle">
                                    <!-- <a href="#modal-add" class="btn btn-info btn-sm btn-edit"
                                        data-id="<?= $row->id_gaji ?>">
                                        <i class="fas fa-edit"></i></a> -->
                                    <a href="<?= base_url('gaji/delete/'.$row->id_gaji) ?>"
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
                        <option value="">-- Pilih Bagian --</option>
                        <?php foreach($dept as $d){ ?>
                        <option value="<?= $d->id_dept ?>"><?= $d->nama_dept ?></option>
                        <?php } ?>
                    </select>
                    <small id="notif_nama_dept" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="nama_jabatan">Jabatan</label>
                    <select name="nama_jabatan" id="nama_jabatan" class="form-control form-control-sm">
                        <option value="">-- Pilih Jabatan --</option>
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
                    <label for="potongan">Potongan</label>
                    <div class="input-group input-group-sm">
                        <input type="number" class="form-control form-control-sm" id="potongan" name="potongan">
                        <span class="input-group-append">
                            <select name="potongan_per" id="potongan_per" class="form-control form-control-sm">
                                <option value="jam">Per Jam</option>
                                <option value="hari">Per Hari</option>
                            </select>
                        </span>
                    </div>
                    <small id="notif_potongan" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan">
                    <small id="notif_keterangan" class="text-danger"></small>
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


<script>
$(function() {
    $('#tbl-gaji').DataTable();

    $(document).on('click', '#btn-create', function() {
        $(document).find('#btn-save-edit').hide();
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
                potongan: $('#potongan').val(),
                potongan_per: $('#potongan_per').val(),
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
                        if (res.form_error.potongan != '') {
                            $('#potongan').addClass('is-invalid');
                            $('#potongan').val(res.set_value.potongan);
                            $('#notif_potongan').html(res.form_error.potongan);
                        }
                        return false;
                    }
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