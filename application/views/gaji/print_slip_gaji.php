<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>images/logo/cptn.png">
    <!-- jQuery -->
    <script src="<?= base_url() ?>AdminLTE_3/plugins/jquery/jquery.min.js"></script>

    <style>
    * {
        margin: 0px;
        padding: 2px;
        font-family: arial;
    }

    .luar {
        /* min-width: 500px; */
        /* background-color: #ddd; */
        border: 2px solid #000;

        padding: 15px;
    }

    table {
        border-collapse: collapse;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    table th,
    table td {
        border: 1px solid #000;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }
    </style>
</head>

<body>
    <div class="luar">
        <p class="text-center">
            <b id="nama_gaji">NAMA GAJI</b> - <b id="bagian">DEPT</b><br />
            <b id="period_gj"></b>
        </p>



        <table width="100%">
            <tbody>
                <tr>
                    <td class="text-center">NIK</td>
                    <td class="text-center">Nama Karyawan</td>
                    <td class="text-center">Jabatan</td>
                </tr>
                <tr>
                    <th class="text-center" id="nik">000000</th>
                    <th class="text-center" id="nama">.......</th>
                    <th class="text-center" id="jabatan">.......</th>
                </tr>
            </tbody>
        </table>



        <table width="100%" id="tbl-item-gaji">
            <tbody>
                <tr>
                    <th colspan="4">Gaji</td>
                </tr>
                <tr>
                    <td colspan="1" width="50%">Gaji Pokok</td>
                    <td id="gaji_pokok" class="text-right"></td>
                    <td id="jml_hadir" class="text-center"></td>
                    <td id="ttl_gaji_pokok" class="text-right"></td>
                </tr>
                <tr>
                    <td colspan="3" width="50%">Bonus</td>
                    <td id="ttl_bonus" class="text-right"></td>
                </tr>
                <tr>
                    <th colspan="3" class="text-center">Total Gaji</th>
                    <th id="ttl_gaji" class="text-right"></th>
                </tr>
                <tr>
                    <th colspan="4">Potongan</td>
                </tr>
                <tr>
                    <td colspan="1" width="50%">Tidak Hadir</td>
                    <td id="tidak_hadir" class="text-right"></td>
                    <td id="jml_tidak_hadir" class="text-center"></td>
                    <td id="ttl_tidak_hadir" class="text-right"></td>
                </tr>
                <tr>
                    <td colspan="1" width="50%">Telat Masuk</td>
                    <td id="telat_masuk" class="text-right"></td>
                    <td id="jml_telat_masuk" class="text-center"></td>
                    <td id="ttl_telat_masuk" class="text-right"></td>
                </tr>
                <tr>
                    <th colspan="3" class="text-center">Total Potongan</th>
                    <th id="ttl_potongan" class="text-right"></th>
                </tr>
                <tr>
                    <th colspan="3" class="text-center">Total Terima</th>
                    <th id="ttl_terima" class="text-right"></th>
                </tr>
            </tbody>
        </table>

        Tanggal Penggajian : <b id="tgl_gaji">02 Des 2023</b>

    </div>

    <script>
    $(function() {
        function load_data() {
            $.ajax({
                url: '<?= base_url('json/get_slip_gaji') ?>',
                type: 'POST',
                data: {
                    id: <?= $id ?>
                },
                dataType: 'json',
                success: function(res) {

                    $('#period_gj').html(res.data.period_gj);
                    $('#nama_gaji').html(res.data.nama_gaji);
                    $('#nik').html(res.data.nik);
                    $('#nama').html(res.data.nama);
                    $('#jabatan').html(res.data.nama_jabatan);
                    $('#bagian').html(res.data.nama_dept);

                    $('#gaji_pokok').html(res.data.gaji_pokok);
                    $('#telat_masuk').html(res.data.telat_masuk);
                    $('#tidak_hadir').html(res.data.tidak_hadir);

                    $('#jml_hadir').html(res.data.jml_hadir);
                    $('#jml_tidak_hadir').html(res.data.jml_tidak_hadir);
                    $('#jml_telat_masuk').html(res.data.jml_telat_masuk);

                    $('#ttl_gaji_pokok').html(res.data.ttl_gaji_pokok);
                    $('#ttl_bonus').html(res.data.ttl_bonus);
                    $('#ttl_gaji').html(res.data.ttl_gaji);
                    $('#ttl_tidak_hadir').html(res.data.ttl_tidak_hadir);
                    $('#ttl_telat_masuk').html(res.data.ttl_telat_masuk);
                    $('#ttl_potongan').html(res.data.ttl_potongan);
                    $('#ttl_terima').html(res.data.total_terima);

                    $('#tgl_gaji').html(res.data.tgl_gaji);

                    window.print();
                }
            });
        }

        load_data();
    })
    </script>
</body>

</html>