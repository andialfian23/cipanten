<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">Manajemen User
            </div>
            <div class="card-body px-3 py-3 pb-2">

                <div class="table-responsive p-2">
                    <table class="table table-bordered table-striped table-hover table-sm" border="2" id="tbl-user"
                        width="100%">
                        <thead class="bg-gradient-dark text-white">
                            <tr>
                                <th class="font-weight-bolder">No</th>
                                <th class="font-weight-bolder">Username / NIK</th>
                                <th class="font-weight-bolder">Nama</th>
                                <th class="font-weight-bolder">Jabatan</th>
                                <th class="font-weight-bolder">Bagian</th>
                                <th class="font-weight-bolder">Level</th>
                                <th>--</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($user as $row){ ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $row->username ?></td>
                                <td class="nwrap"><?= $row->nama ?></td>
                                <td><?= $row->nama_jabatan ?></td>
                                <td><?= $row->nama_dept ?></td>
                                <td><?= $row->level ?></td>
                                <td class="text-center">
                                    <a href="#modal-edit" data-toggle="modal" data-id="<?= $row->id_user ?>"
                                        data-level="<?= $row->level ?>" class="btn btn-sm btn-info btn-edit">Ubah
                                        Level</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Ubah Level User</h5>
                <button type="button" class="btn btn-close bg-gradient-danger " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="level">Level Lama</label>
                    <input type="text" class="form-control form-control-sm" value="" id="level_lama" disabled />
                </div>
                <div class="form-group">
                    <label for="level">Level Baru</label>
                    <select name="level" id="level" class="form-control form-control-sm">
                        <option value="" hidden>-- Pilih Level --</option>
                        <option value="1">1 | Admin</option>
                        <option value="2">2 | Bendahara</option>
                        <option value="3">3 | User Biasa</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="hidden" name="id_user" id="id_user">
                    <button type="submit" class="btn btn-block bg-gradient-primary" id="btn-save-edit">Simpan</button>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    $('#tbl-user').DataTable({
        language: {
            url: "<?= base_url('extra-libs/ID.json') ?>",
        },
    });

    $(document).on('click', '.btn-edit', function() {
        let level = $(this).data('level');
        let id_user = $(this).data('id');
        $('#level_lama').val(level);
        $('#id_user').val(id_user);
    });

    $(document).on('click', '#btn-save-edit', function() {
        $.ajax({
            url: '<?= base_url('user/ubah_level') ?>',
            type: 'POST',
            data: {
                id_user: $('#id_user').val(),
                level: $('#level').val(),
            },
            dataType: 'json',
            success: function(res) {
                toastr.success(res.pesan);
                setTimeout(() => {
                    window.location.replace('<?= base_url('user') ?>');
                }, 1000);
            }
        });
    });
});
</script>