<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header pb-2 bg-danger">
                <h6 class="text-white">Data Karyawan</h6>
            </div>
            <div class="card-body px-3 py-3 pb-2">
                <a href="<?= base_url('karyawan/create') ?>" class="btn btn-primary">Tambah Data Karyawan</a>
                <div class="table-responsive p-2">
                    <table class="table table-bordered table-striped table-hover" border="2" id="tbl-karyawan">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th class="font-weight-bolder">
                                    No
                                </th>
                                <th class="font-weight-bolder">
                                    NIK
                                </th>
                                <th class="font-weight-bolder">
                                    Nama</th>
                                <th class="font-weight-bolder">
                                    Alamat</th>
                                <th class="font-weight-bolder">
                                    No HP</th>
                                <th>--</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($karyawan as $row){ ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td class="text-center"><?= $row->id_karyawan ?></td>
                                <td><?= $row->nama ?></td>
                                <td><?= $row->alamat ?></td>
                                <td><?= $row->no_hp ?></td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('karyawan/update/'.$row->id_karyawan) ?>"
                                        class="btn btn-info btn-sm py-2">Edit</a>
                                    <a href="<?= base_url('karyawan/delete/'.$row->id_karyawan) ?>"
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
    $('#tbl-karyawan').DataTable();
});
</script>