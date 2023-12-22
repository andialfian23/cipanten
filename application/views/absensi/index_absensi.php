<style>
#tbl-absensi th {
    text-align: center;
    font-size: 12px !important;
}

.inptd {
    width: 100%;
}

#tbl-absensi td {
    font-size: 12px !important;
}
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class=" row d-flex justify-content-between">

                    <div class="col-md-5 d-flex">
                        <span class="mx-2">Data Absensi</span>
                    </div>
                    <div class="text-right ml-auto pr-3">
                        <div class="input-group input-group-sm">
                            <a href="<?= base_url('scan_qr') ?>" class="btn btn-sm bg-gradient-success mr-3">Scan
                                QR-Code</a>

                            <div class="input-group-prepend">
                                <span class="input-group-text border-warning">Date</span>
                            </div>
                            <input type="date" class="form-control form-control-sm" id="xBegin"
                                value="<?= date('Y-m-01') ?>" />
                            <input type="date" class="form-control form-control-sm" id="xEnd"
                                value="<?= date('Y-m-d') ?>" />
                            <div class="input-group-prepend">
                                <button id="cari" type="button"
                                    class="btn bg-gradient-success btn-sm border-warning"><b>Cari</b></button>
                                <!-- <button id="pdf-prod3" class="btn btn-primary btn-sm border-warning"><b><i
                                            class="fa-solid fa-print"></i> Print</b></button> -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive p-2">
                    <table class="table table-bordered table-striped table-hover table-sm" border="2" id="tbl-absensi">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Dept</th>
                                <th>Tanggal</th>
                                <th>Masuk</th>
                                <th>Telat Masuk</th>
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
                                <td class="text-center"><?= $row->tanggal ?></td>
                                <td class="text-center">
                                    <?= date('H:i:s',strtotime($row->tanggal.' '.$row->waktu_masuk)) ?></td>
                                <td class="text-center">
                                    <?= date('H:i:s',strtotime($row->tanggal.' '.$row->telat_masuk)) ?></td>
                                <td class="text-center">
                                    <?= date('H:i:s',strtotime($row->tanggal.' '.$row->waktu_pulang)) ?></td>
                                <td class="text-center">
                                    <?= date('H:i:s',strtotime($row->tanggal.' '.$row->waktu_kerja)) ?></td>
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