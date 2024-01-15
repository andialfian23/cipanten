<?php if($_SESSION['level']<4): ?>

<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <p>Jumlah Semua Karyawan</p>
                <h4 class="text-center"><?= number_format($jml_karyawan) ?></h4>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="<?= base_url('karyawan') ?>" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <p>Jml Pengeluaran Gaji Bulan Ini</p>
                <h4 class="text-center">Rp <?= number_format($jml_bulan_ini) ?></h4>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="<?= base_url('gaji_karyawan') ?>" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <p>Jml Pengeluaran Gaji Tahun Ini</p>
                <h4 class="text-center">Rp <?= number_format($jml_tahun_ini) ?></h4>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="<?= base_url('gaji_karyawan') ?>" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <p>Total Pengeluaran Gaji Selama Ini</p>
                <h4 class="text-center">Rp <?= number_format($jml_selama_ini) ?></h4>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="<?= base_url('gaji_karyawan') ?>" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>


</div>

<?php endif; ?>

<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card card-primary card-outline">
            <div class="card-body p-3">
                <h3 class="text-center">SELAMAT DATANG DI SISTEM MANAJEMEN PENGGAJIAN KARYAWAN</h3>
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
            </div>
        </div>
    </div>
</div>