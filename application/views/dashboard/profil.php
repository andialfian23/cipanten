<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">Profil</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 text-center">
                        <img src="<?= base_url('images/qrcode/'.$qrcode) ?>" alt="" class="img-thumbnail"
                            id="img-preview" width="250px" />
                    </div>
                    <div class="col-lg-8">
                        <table class="table table-bordered table-sm" width="100%">
                            <tr>
                                <td>NIK</td>
                                <th><?= $karyawan->id_karyawan ?></th>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <th><?= $karyawan->nama ?></th>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <th><?= date('d M Y',strtotime($karyawan->tgl_lahir)) ?></th>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <th><?= $karyawan->alamat ?></th>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <th><?= $karyawan->no_hp ?></th>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <th><?= $karyawan->nama_jabatan ?></th>
                            </tr>
                            <tr>
                                <td>Bagian</td>
                                <th><?= $karyawan->nama_dept ?></th>
                            </tr>
                            <tr>
                                <td>Gabung Sejak</td>
                                <th><?= date('d M Y',strtotime($karyawan->join_at)) ?></th>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <th><?= $karyawan->status ?></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>