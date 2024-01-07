<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Edit Data Karyawan Baru
            </div>
            <div class="card-body">

                <form action="<?= base_url('karyawan/update/'.$karyawan->id_karyawan) ?>" method="POST"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6 p-4 border">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id_karyawan" class="form-control-label">ID Karyawan</label>
                                        <input class="form-control form-control-sm" type="text"
                                            value="<?= $karyawan->id_karyawan ?>" name="id_karyawan" id="id_karyawan"
                                            placeholder="010101">
                                        <?= form_error('id_karyawan', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="nama" class="form-control-label">Nama Karyawan</label>
                                        <input class="form-control form-control-sm" type="text"
                                            value="<?= $karyawan->nama ?>" name="nama" id="nama">
                                        <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="jk" class="form-control-label">Jenis Kelamin</label>
                                        <select class="form-control form-control-sm" name="jk" id="jk">
                                            <option value="<?= $karyawan->jk ?>" hidden>
                                                <?= ($karyawan->jk=='L')?'Laki-laki':'Perempuan' ?></option>
                                            <option value="L">Laki Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        <?= form_error('jk', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="tgl_lahir" class="form-control-label">Tanggal Lahir</label>
                                        <input class="form-control form-control-sm" type="date"
                                            value="<?= $karyawan->tgl_lahir ?>" name="tgl_lahir" id="tgl_lahir">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="alamat" class="form-control-label">Alamat</label>
                                        <input class="form-control form-control-sm" type="text"
                                            value="<?= $karyawan->alamat ?>" name="alamat" id="alamat"
                                            placeholder="Desa .... Kec ... Kab ....">
                                        <?= form_error('alamat', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="no_hp" class="form-control-label">No. HP</label>
                                        <input class="form-control form-control-sm" type="text"
                                            value="<?= $karyawan->no_hp ?>" name="no_hp" id="no_hp"
                                            placeholder="085XXXXXXXXX">
                                        <?= form_error('no_hp', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 border p-4">


                            <div class="form-group">
                                <label for="foto" class="form-control-label">Foto</label>
                                <input class="form-control form-control-sm" type="file" name="foto" id="foto" />
                            </div>

                            <div class="form-group">
                                <label for="jabatan" class="form-control-label">Jabatan</label>
                                <select class="form-control form-control-sm" name="jabatan" id="jabatan">
                                    <option value="<?= $karyawan->id_jabatan ?>" hidden>
                                        <?= $karyawan->nama_jabatan ?></option>
                                    <?php foreach($jabatan as $jb): ?>
                                    <option value="<?= $jb->id_jabatan ?>"><?= $jb->nama_jabatan ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('jabatan', '<small class="text-danger">', '</small>') ?>
                            </div>

                            <div class="form-group">
                                <label for="departemen" class="form-control-label">Departemen</label>
                                <select class="form-control form-control-sm" name="departemen" id="departemen">
                                    <option value="<?= $karyawan->id_dept ?>" hidden><?= $karyawan->nama_dept ?>
                                    </option>
                                    <?php foreach($dept as $dp): ?>
                                    <option value="<?= $dp->id_dept ?>"><?= $dp->nama_dept ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('departemen', '<small class="text-danger">', '</small>') ?>
                            </div>

                            <div class="form-group">
                                <label for="join_at" class="form-control-label">Gabung Sejak</label>
                                <input class="form-control form-control-sm" type="date"
                                    value="<?= $karyawan->join_at ?>" name="join_at" id="join_at">
                                <?= form_error('join_at', '<small class="text-danger">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="status" class="form-control-label">Status</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="<?= $karyawan->status; ?>" hidden><?= $karyawan->status; ?></option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-block">SIMPAN DATA</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>