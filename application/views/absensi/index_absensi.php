<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Data Absensi
            </div>
            <div class="card-body">
                <a href="<?= base_url('scan_qr') ?>" class="btn btn-primary">Scan QR-Code</a>
                <div class="table-responsive p-2">
                    <table class="table table-bordered table-striped table-hover table-sm" border="2" id="tbl-karyawan">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th class="font-weight-bolder">
                                    No
                                </th>
                                <th class="font-weight-bolder">NIK</th>
                                <th class="font-weight-bolder">Nama</th>
                                <th class="font-weight-bolder">Jabatan</th>
                                <th class="font-weight-bolder">Masuk</th>
                                <th class="font-weight-bolder">Pulang</th>
                                <th class="font-weight-bolder">Lama Kerja</th>
                                <th>--</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($absensi as $row){ ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td class="text-center"><?= $row->id_karyawan ?></td>
                                <td>
                                    <a href="#preview" data-id="<?= $row->id_karyawan ?>" class="btn-view"
                                        data-toggle="modal">
                                        <b><?= $row->nama ?></b>
                                    </a>
                                </td>
                                <td><?= $row->nama_jabatan ?></td>
                                <td><?= $row->waktu_masuk ?></td>
                                <td><?= $row->waktu_pulang ?></td>
                                <td></td>
                                <td class="text-center align-middle">
                                    <a href="<?= base_url('absensi/update/'.$row->id_karyawan) ?>"
                                        class="btn btn-info btn-sm py-2">Edit</a>
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