<div class="row">
    <div class="col-lg-12">
        <div class="card card-info card-outline">
            <div class="card-header d-flex justify-content-between">
                <div class="">
                    <h5>Data Absensi</h5>
                </div>
                <div class="ml-auto">
                    <a href="<?= base_url('scan_qr') ?>" class="btn bg-gradient-success">Scan QR-Code</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive p-2">
                    <table class="table table-bordered table-striped table-hover table-sm" border="2" id="tbl-absensi">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>
                                    No
                                </th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Dept</th>
                                <th>Tanggal</th>
                                <th>Masuk</th>
                                <th>Pulang</th>
                                <th>Kerja</th>
                                <th>--</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($absensi as $row){ ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td><?= $row->nik ?></td>
                                <td><?= $row->nama ?></td>
                                <td><?= $row->nama_jabatan ?></td>
                                <td><?= $row->nama_dept ?></td>
                                <td><?= $row->tanggal ?></td>
                                <td><?= date('H:i:s',strtotime($row->tanggal.' '.$row->waktu_masuk)) ?></td>
                                <td><?= date('H:i:s',strtotime($row->tanggal.' '.$row->waktu_pulang)) ?></td>
                                <td><?= date('H:i:s',strtotime($row->tanggal.' '.$row->waktu_kerja)) ?></td>
                                <td class="text-center align-middle">
                                    <a href="#" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url('absensi/delete/'.$row->nik.'/'.$row->tanggal) ?>"
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

<script>
$(function() {
    $('#tbl-absensi').DataTable();
});
</script>