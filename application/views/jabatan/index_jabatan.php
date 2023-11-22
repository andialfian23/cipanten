<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header pb-2 bg-success">
                <h6 class="text-dark">Data jabatan</h6>
            </div>
            <div class="card-body px-3 py-3 pb-2">
                <a href="<?= base_url('jabatan/create') ?>" class="btn btn-primary">Tambah Data jabatan</a>
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
                                        class="btn btn-info btn-sm py-2">Edit</a>
                                    <a href="<?= base_url('jabatan/delete/'.$row->id_jabatan) ?>"
                                        class="btn btn-danger btn-sm py-2">Delete</a>
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
    $('#tbl-jabatan').DataTable();
});
</script>