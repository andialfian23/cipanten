<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header pb-2 bg-success">
                <h6 class="text-dark">Data Departemen</h6>
            </div>
            <div class="card-body px-3 py-3 pb-2">
                <a href="<?= base_url('departemen/create') ?>" class="btn btn-primary">Tambah Data Departemen</a>
                <div class="table-responsive p-2">
                    <table class="table table-bordered table-striped table-hover table-sm" border="2"
                        id="tbl-departemen">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th class="font-weight-bolder">
                                    No
                                </th>
                                <th class="font-weight-bolder">
                                    ID Dept
                                </th>
                                <th class="font-weight-bolder">Nama Departemen</th>
                                <th>--</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($dept as $row){ ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td class="text-center"><?= $row->id_dept ?></td>
                                <td><?= $row->nama_dept ?></td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('departemen/update/'.$row->id_dept) ?>"
                                        class="btn btn-info btn-sm py-2">Edit</a>
                                    <a href="<?= base_url('departemen/delete/'.$row->id_dept) ?>"
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
    $('#tbl-departemen').DataTable();
});
</script>