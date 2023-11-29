<div class="row">
    <div class="col-lg-12">
        <div class="card card-success card-outline mb-4">
            <div class="card-header d-flex justify-content-between">
                <div class="">
                    <h5>Data Slip Gaji</h5>
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
                                <td>
                                    <a href="#preview" data-id="<?= $row->id_gaji ?>" data-toggle="modal"
                                        class="btn-view">
                                        <?= $row->nama_gaji ?>
                                    </a>
                                </td>
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
                    <label for="nama_gaji">Nama Gaji</label>
                    <input type="text" class="form-control" id="nama_gaji" name="nama_gaji">
                    <small id="notif_nama_gaji" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="gaji_pokok">Gaji Pokok</label>
                    <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok">
                    <small id="notif_gaji_pokok" class="text-danger"></small>
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

<div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-navy">
                <h5 class="modal-title" id="exampleModalLabel">Detail Slip Gaji</h5>
                <button type="button" class="btn btn-close text-white" aria-label="Close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">

                        <p id="nama_gj" class="text-center"></p>

                        <table class="table table-bordered table-sm" width="100%">
                            <tr>
                                <td colspan="1" width="50%">GAJI POKOK</td>
                                <th id="gj_pokok" width="50%"></th>
                            </tr>
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
                <button type="button" class="btn bg-gradient-danger" data-dismiss="modal">Keluar</button>
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
        $('#modal-add input').removeClass('is-invalid');
        $('#modal-add small').html('');

        $.ajax({
            url: '<?= base_url('gaji/create') ?>',
            type: 'POST',
            data: {
                nama_gaji: $('#nama_gaji').val(),
                gaji_pokok: $('#gaji_pokok').val(),
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

    $(document).on('click', '.btn-view', function() {
        $.ajax({
            url: '<?= base_url('gaji/get_slip_gaji') ?>',
            type: 'POST',
            data: {
                id: $(this).data('id'),
            },
            dataType: 'json',
            success: function(res) {
                $('#nama_gj').html(res.gaji.nama_gaji);
                $('#gj_pokok').html(res.gaji.gaji_pokok);
                $('#ket').html(res.gaji.keterangan);
            }
        });
    });
})
</script>