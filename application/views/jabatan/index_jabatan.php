<div class="row">
    <div class="col-lg-12">
        <div class="card card-success card-outline mb-4">
            <div class="card-header d-flex justify-content-between">
                <div class="">
                    <h5>Data Jabatan</h5>
                </div>
                <div class="ml-auto">
                    <a href="#modal-add" data-toggle="modal" class="btn btn-primary" id="btn-create">Tambah Data
                        jabatan</a>
                </div>
            </div>
            <div class="card-body px-3 py-3 pb-2">

                <div class="table-responsive p-2">
                    <table class="table table-bordered table-striped table-hover table-sm" border="2" id="tbl-jabatan">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th class="font-weight-bolder">
                                    No
                                </th>
                                <th class="font-weight-bolder">
                                    ID Jabatan
                                </th>
                                <th class="font-weight-bolder">Nama Jabatan</th>
                                <th>--</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($jabatan as $row){ ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td class="text-center"><?= $row->id_jabatan ?></td>
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
</div>

<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
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
                <button type="submit" class="btn bg-gradient-primary" id="btn-save">Simpan</button>
                <button type="submit" class="btn bg-gradient-primary" id="btn-save-edit">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    $('#tbl-jabatan').DataTable();

    $(document).on('click', '#btn-create', function() {
        $(document).find('#btn-save-edit').hide();
    });

    $(document).on('click', '#btn-save', function() {
        $('#modal-add input').removeClass('is-invalid');
        $('#modal-add small').html('');

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
});
</script>