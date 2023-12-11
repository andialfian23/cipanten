<div class="row">
    <div class="col-lg-6">

        <div class="card card-success card-outline mb-4">
            <div class="card-header d-flex justify-content-between">
                <div class="">
                    <h5>Data Jabatan</h5>
                </div>
                <div class="ml-auto">
                    <a href="#modal-add-jabatan" data-toggle="modal" class="btn btn-primary btn-sm"
                        id="btn-create-jabatan">Tambah Data
                        jabatan</a>
                </div>
            </div>
            <div class="card-body px-3 py-3 pb-2">

                <div class="table-responsive p-2">
                    <table class="table table-bordered table-striped table-hover table-sm" border="2" id="tbl-jabatan">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th class="font-weight-bolder">Nama Jabatan</th>
                                <th>--</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($jabatan as $row){ ?>
                            <tr>
                                <td><?= $row->nama_jabatan ?></td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('jabatan/update/'.$row->id_jabatan) ?>"
                                        class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url('jabatan/delete/'.$row->id_jabatan) ?>"
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
    <div class="col-lg-6">

        <div class="card  card-success card-outline mb-4">
            <div class="card-header d-flex justify-content-between">
                <div class="">
                    <h5>Data Bagian / Departemen</h5>
                </div>
                <div class="ml-auto">
                    <a href="#modal-add-dept" data-toggle="modal" class="btn btn-primary btn-sm"
                        id="btn-create-dept">Tambah
                        Data
                        Dept</a>
                </div>
            </div>
            <div class="card-body px-3 py-3 pb-2">

                <div class="table-responsive p-2">
                    <table class="table table-bordered table-striped table-hover table-sm" border="2"
                        id="tbl-departemen">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th class="font-weight-bolder">Nama Departemen</th>
                                <th>--</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($dept as $row){ ?>
                            <tr>
                                <td><?= $row->nama_dept ?></td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('dept/update/'.$row->id_dept) ?>"
                                        class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url('dept/delete/'.$row->id_dept) ?>"
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

<div class="modal fade" id="modal-add-jabatan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Tambah Data Jabatan</h5>
                <button type="button" class="btn btn-close bg-gradient-danger " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_jabatan">Nama Jabatan</label>
                    <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan">
                    <small id="notif_nama_jabatan" class="text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_jabatan" id="id_jabatan">
                <button type="submit" class="btn bg-gradient-primary" id="btn-save-jabatan">Simpan</button>
                <button type="submit" class="btn bg-gradient-primary" id="btn-save-edit-jabatan">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-dept" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Tambah Data</h5>
                <button type="button" class="btn btn-close bg-gradient-danger " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_dept">Nama Bagian / Dept</label>
                    <input type="text" class="form-control" id="nama_dept" name="nama_dept">
                    <small id="notif_nama_dept" class="text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_jabatan" id="id_jabatan">
                <button type="submit" class="btn bg-gradient-primary" id="btn-save-dept">Simpan</button>
                <button type="submit" class="btn bg-gradient-primary" id="btn-save-edit-dept">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    $('#tbl-jabatan').DataTable();
    $('#tbl-departemen').DataTable();

    $(document).on('click', '#btn-create-jabatan', function() {
        $(document).find('#btn-save-edit').hide();
    });

    $(document).on('click', '#btn-save-jabatan', function() {
        $('#modal-add-jabatan input').removeClass('is-invalid');
        $('#modal-add-jabatan small').html('');

        $.ajax({
            url: '<?= base_url('jabatan/create') ?>',
            type: 'POST',
            data: {
                nama_jabatan: $('#nama_jabatan').val(),
            },
            dataType: 'json',
            success: function(res) {
                if (res.status == 0) {
                    if (res.form_error != null) {
                        toastr.error(res.pesan);
                        $('#nama_jabatan').addClass('is-invalid');
                        $('#nama_jabatan').val(res.set_value);
                        $('#notif_nama_jabatan').html(res.form_error);
                        return false;
                    }
                } else {
                    toastr.success(res.pesan);
                    setTimeout(() => {
                        window.location.replace('<?= base_url('jabatan') ?>');
                    }, 2000);
                }
            }
        });
    });



    $(document).on('click', '#btn-create-dept', function() {
        $(document).find('#btn-save-edit-dept').hide();
    });

    $(document).on('click', '#btn-save-dept', function() {
        $('#modal-add-dept input').removeClass('is-invalid');
        $('#modal-add-dept small').html('');

        $.ajax({
            url: '<?= base_url('dept/create') ?>',
            type: 'POST',
            data: {
                nama_dept: $('#nama_dept').val(),
            },
            dataType: 'json',
            success: function(res) {
                if (res.status == 0) {
                    if (res.form_error != null) {
                        toastr.error(res.pesan);
                        $('#nama_dept').addClass('is-invalid');
                        $('#nama_dept').val(res.set_value);
                        $('#notif_nama_dept').html(res.form_error);
                        return false;
                    }
                } else {
                    toastr.success(res.pesan);
                    setTimeout(() => {
                        window.location.replace('<?= base_url('dept') ?>');
                    }, 2000);
                }
            }
        });
    });
});
</script>