<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                Ubah Password
            </div>
            <div class="card-body">
                <form action="<?= base_url('dashboard/ubah_password') ?>" method="POST" class="form-horizontal">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="password_old" class="col-sm-5 col-form-label">Password Lama</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control form-control-sm" id="password_old"
                                        name="password_old" />
                                    <small class="text-danger"><?= form_error('password_old') ?></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_new" class="col-sm-5 col-form-label">Password Baru</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control form-control-sm" id="password_new"
                                        name="password_new" />
                                    <small class="text-danger"><?= form_error('password_new') ?></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_conf" class="col-sm-5 col-form-label">Konfirmasi</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control form-control-sm" id="password_conf"
                                        name="password_conf" />
                                    <small class="text-danger"><?= form_error('password_conf') ?></small>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary btn-sm">SIMPAN</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>