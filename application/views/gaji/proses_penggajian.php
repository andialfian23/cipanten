<style>
#tbl-karyawan th {
    text-align: center;
}
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-danger card-outline">
            <div class="card-header">
                <h3>Proses Penggajian Karyawan</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="nama_dept">Bagian</label>
                            <select name="nama_dept" id="nama_dept" class="form-control form-control-sm">
                                <option value="">-- Pilih Bagian --</option>
                                <?php foreach($dept as $d){ ?>
                                <option value="<?= $d->id_dept ?>"><?= $d->nama_dept ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">

                            <label for="periode">Tanggal Absensi</label>
                            <div class="input-group input-group-sm" id="periode">
                                <input type="date" class="form-control" id="xbegin" />
                                <input type="date" class="form-control" id="xend" />
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-success btn-flat" id="btn-qry">Cari</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-sm mb-2 border-1 border-success" width="100%"
                            id="tbl-karyawan">
                            <thead class="bg-gradient-danger">
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">NIK</th>
                                    <th rowspan="2">Nama</th>
                                    <th rowspan="2">Jabatan</th>
                                    <th rowspan="2">Bagian</th>
                                    <th colspan="3">Absensi</th>
                                    <th colspan="2">Gaji</th>
                                    <th colspan="2">Potongan</th>
                                    <th rowspan="2">Total Gaji<br>di Terima</th>
                                </tr>
                                <tr>
                                    <th>Hadir</th>
                                    <th>Tidak Hadir</th>
                                    <th>Telat Masuk</th>
                                    <th>Pokok</th>
                                    <th>Bonus</th>
                                    <th>Tidak Hadir</th>
                                    <th>Telat Masuk</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    $(document).on('click', 'btn-qry', function() {
        $.ajax({
            url: '<?= base_url('json') ?>/get_hitung_gaji_karyawan',
            type: 'POST',
            data: {
                xBegin: $('#xbegin').val(),
                xEnd: $('#xend').val(),
                dept: $('#nama_dept').val()
            },
            dataType: 'json',
            success: function(res) {
                $('#tbl-karyawan tbody').empty();
                let isi_tabel = [];
                $.each(res.data_karyawan, function(i, row) {
                    isi_tabel[i] = `
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    `;
                });
            }
        });
    });
});
</script>