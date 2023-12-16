<style>
#tbl-karyawan th {
    text-align: center;
    font-size: 12px !important;
}

.inptd {
    width: 100%;
}

#tbl-karyawan td {
    font-size: 12px !important;
}
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-danger card-outline">
            <div class="card-header">
                <h5>Proses Penggajian Karyawan</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="nama_dept">Bagian</label>
                            <select name="nama_dept" id="nama_dept" class="form-control form-control-sm">
                                <option value="">-- Pilih Bagian --</option>
                                <?php foreach($dept as $d){ ?>
                                <option value="<?= $d->nama_dept ?>"><?= $d->nama_dept ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">

                            <label for="periode">Tanggal Absensi</label>
                            <div class="input-group input-group-sm" id="periode">
                                <input type="date" class="form-control" id="xBegin" />
                                <input type="date" class="form-control" id="xEnd" />
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-success btn-flat" id="btn-qry">Cari</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm mb-2 border-1 border-success" width="100%"
                                id="tbl-karyawan">
                                <thead class="bg-gradient-danger">
                                    <tr>
                                        <th rowspan="3">NIK</th>
                                        <th rowspan="3">Nama</th>
                                        <th rowspan="3">Jabatan</th>
                                        <th rowspan="3">Bagian</th>
                                        <th colspan="5">Gaji</th>
                                        <th colspan="5">Potongan</th>
                                        <th rowspan="3">Total<br />Gaji<br>di Terima</th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2">Jenis</th>
                                        <th rowspan="2">Pokok</th>
                                        <th rowspan="2">Jml<br />Hadir</th>
                                        <th rowspan="2">Bonus</th>
                                        <th rowspan="2">Total<br />Gaji</th>

                                        <th colspan="2">Tidak Hadir</th>
                                        <th colspan="2">Telat Masuk</th>
                                        <th rowspan="2">Total<br />Potongan</th>
                                    </tr>
                                    <tr>
                                        <th>Jml</th>
                                        <th>Denda</th>
                                        <th>Jml</th>
                                        <th>Denda</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 ml-auto">
                        <button class="btn btn-primary btn-sm btn-block " id="btn-simpan-gk">
                            Simpan Gaji Karyawan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// function rmv_koma(stringDenganKoma) {
//     var stringTanpaKoma = stringDenganKoma.replace(/,/g, '');
//     return parseInt(stringTanpaKoma);
// }

$(function() {

    $('#btn-simpan-gk').hide();

    $(document).on('click', '#btn-qry', function() {
        $('input, select').removeClass('border-danger');

        if ($('#nama_dept').val() == '') {
            $('#nama_dept').addClass('border-danger');
            return false;
        }
        if ($('#xBegin').val() == '') {
            $('#xBegin').addClass('border-danger');
            return false;
        }
        if ($('#xEnd').val() == '') {
            $('#xEnd').addClass('border-danger');
            return false;
        }

        var startDate = new Date($('#xBegin').val());
        var endDate = new Date($('#xEnd').val());

        // Menghitung selisih dalam milidetik, lalu mengonversi ke dalam hari
        var differenceInTime = endDate.getTime() - startDate.getTime();
        var differenceInDays = differenceInTime / (1000 * 3600 * 24);

        // Memeriksa jika selisih harinya lebih dari 30 hari
        if (differenceInDays > 30) {
            $('#xBegin, #xEnd').addClass('border-danger');
            toastr.error('Tidak Dapat Menghitung Gaji Lebih dari 30 Hari');
            return false;
        }

        $.ajax({
            url: '<?= base_url('json') ?>/get_hitung_gaji_karyawan',
            type: 'POST',
            data: {
                xBegin: $('#xBegin').val(),
                xEnd: $('#xEnd').val(),
                dept: $('#nama_dept').val()
            },
            dataType: 'json',
            success: function(res) {
                $('#tbl-karyawan tbody').empty();

                if (res.status == 0) {
                    toastr.error('Data Tidak Ditemukan');
                } else {
                    toastr.success('Data Ditemukan');
                    let isi_tabel = [];
                    let no = 1;
                    $.each(res.data_karyawan, function(i, row) {

                        isi_tabel[i] = `
                        <tr>
                            <td>
                                <input type="text" class="inptd nik text-center" value="` + row.nik +
                            `"  data-index="` + i + `" data-id="` + row.id + `"  disabled />
                            </td>
                            <td>` + row.nama + `</td>
                            <td>` + row.nama_jabatan + `</td>
                            <td>` + row.nama_dept + `</td>
                            <td class="text-right">
                                <input type="text" class="inptd hitungan_kerja text-center" value="` + row
                            .hitungan_kerja +
                            `" data-index="` + i + `" disabled />
                            </td>
                            <td class="text-right">
                                <input type="text" class="inptd gaji_pokok text-center" value="` + row.gaji_pokok +
                            `" data-index="` + i + `" data-idgaji="` + row
                            .id_gaji + `" disabled />
                            </td>
                            <td class="text-right">
                                <input type="text" class="inptd jml_hadir text-center" value="` + row.jml_hadir +
                            `" data-index="` + i + `" disabled />
                            </td>
                            <td class="text-right">
                                <input type="text" class="inptd bonus text-center" value="0" data-index="` + i + `" />
                            </td>
                            <td class="text-right">
                                <input type="text" class="inptd total_gaji text-center" value="` + row.total_gaji +
                            `"  data-index="` + i + `" disabled />
                            </td>
                            <td class="text-right">
                                <input type="text" class="inptd jml_tidak_hadir text-center" value="` + row
                            .jml_tidak_hadir +
                            `" data-index="` + i + `" disabled />
                            </td>
                            <td class="text-right">
                                <input type="text" class="inptd tidak_hadir text-center" value="` + row.tidak_hadir +
                            `" data-index="` + i + `" disabled />
                            </td>
                            <td class="text-right">
                                <input type="text" class="inptd jml_telat_masuk text-center" value="` + row
                            .jml_telat_masuk + `" data-index="` + i + `"  disabled />
                            </td>
                            <td class="text-right">
                                <input type="text" class="inptd telat_masuk text-center" value="` + row.telat_masuk +
                            `" data-index="` + i + `"  disabled />
                            </td>
                            <td class="text-right">
                                <input type="text" class="inptd total_potongan text-center" value="` + row
                            .total_potongan + `" disabled />
                            </td>
                            <td class="text-right">
                                <input type="text" class="inptd total_terima text-center" value="` + row.terima_gaji +
                            `"  data-index="` + i + `" disabled />
                            </td>
                        </tr>
                    `;
                        no++;
                    });

                    $('#tbl-karyawan tbody').html(isi_tabel.join(''));

                    $('#btn-simpan-gk').show();

                }
            }
        });
    });

    $(document).on('change', '.bonus', function() {
        let index = $(this).data('index');
        let bonus = parseInt($(this).val());
        let total_gaji = parseInt($(document).find('.total_gaji[data-index="' + index + '"]').val());
        let total_terima = parseInt($(document).find('.total_terima[data-index="' + index + '"]')
            .val());

        total_gaji = total_gaji + bonus;
        total_terima = total_terima + bonus;
        $(document).find('.total_gaji[data-index="' + index + '"]').val(total_gaji);
        $(document).find('.total_terima[data-index="' + index + '"]').val(total_terima);
    });

    $(document).on('click', '#btn-simpan-gk', function() {

        let id_gaji = [];
        let id_karyawan = [];
        let jml_hadir = [];
        let jml_tdk_hadir = [];
        let jml_telat_masuk = [];
        let hitungan_kerja = [];
        let gaji_pokok = [];
        let bonus = [];
        let tidak_hadir = [];
        let telat_masuk = [];
        let total_terima = [];

        $(document).find('#tbl-karyawan tbody tr').each(function(i) {
            id_karyawan[i] = $(this).find('.nik[data-index="' + i + '"]').data('id');
            hitungan_kerja[i] = $(this).find('.hitungan_kerja[data-index="' + i + '"]').val();
            id_gaji[i] = $(this).find('.gaji_pokok[data-index="' + i + '"]').data('idgaji');
            gaji_pokok[i] = parseInt($(this).find('.gaji_pokok[data-index="' + i + '"]').val());
            jml_hadir[i] = parseInt($(this).find('.jml_hadir[data-index="' + i + '"]').val());
            bonus[i] = parseInt($(this).find('.bonus[data-index="' + i + '"]').val());
            jml_tdk_hadir[i] = parseInt($(this).find('.jml_tidak_hadir[data-index="' + i + '"]')
                .val());
            tidak_hadir[i] = parseInt($(this).find('.tidak_hadir[data-index="' + i + '"]')
                .val());
            jml_telat_masuk[i] = parseInt($(this).find('.jml_telat_masuk[data-index="' + i +
                '"]').val());
            telat_masuk[i] = parseInt($(this).find('.telat_masuk[data-index="' + i + '"]')
                .val());
            total_terima[i] = parseInt($(this).find('.total_terima[data-index="' + i + '"]')
                .val());
        });

        $.ajax({
            url: '<?= base_url('gaji_karyawan/insert') ?>',
            type: 'POST',
            data: {
                xBegin: $('#xBegin').val(),
                xEnd: $('#xEnd').val(),
                id_gaji: id_gaji,
                id_karyawan: id_karyawan,
                hitungan_kerja: hitungan_kerja,
                gaji_pokok: gaji_pokok,
                jml_hadir: jml_hadir,
                bonus: bonus,
                jml_tdk_hadir: jml_tdk_hadir,
                tidak_hadir: tidak_hadir,
                jml_telat_masuk: jml_telat_masuk,
                telat_masuk: telat_masuk,
                total_terima: total_terima,
            },
            dataType: 'json',
            success: function(res) {
                toastr.success('Data Gaji Karyawan Berhasil Disimpan');
            }
        });
    });
});
</script>