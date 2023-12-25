<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Gaji Karyawan</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>images/logo/cptn.png">
    <script src="<?= base_url('AdminLTE_3/') ?>plugins/jquery/jquery.min.js"></script>
    <style>
    * {
        font-family: Arial, Helvetica, sans-serif;
    }

    body {
        margin: 10px;
    }

    @media print {

        @page {
            size: A4 landscape;
        }

        table {
            border-collapse: collapse;
        }

        th,
        thead td {
            text-align: center;
        }

        th,
        td {
            font-size: 10px;
            vertical-align: middle;
        }

    }

    table,
    th,
    td {
        border: 1px solid #000;
    }

    th {
        background-color: silver;
    }

    th,
    td {
        white-space: nowrap;
        border: 1px solid #000;
        white-space: nowrap;
        padding: 2.5px;
        font-size: 12px;
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
    <div style="position: relative; text-align: center;">
        <div class="position:absolute; left: 0; right: 0; margin: auto;">
            <h3 id="judul">Laporan Gaji Karyawan <br>Wisata Situ Cipanten</h3>
        </div>
        <div style="position:absolute;left:0px;top:10px;">
            <p id="periode"></p>
        </div>
        <div style="position:absolute;right:0px;top:0px;">
            <p>Waktu Cetak : <?= date('Y-m-d H:i:s') ?></p>
        </div>
    </div>
    <hr>
    <div id="body">
        <table width="100%" cellspacing="0" id="tbl-gaji-karyawan">
            <thead>
                <tr>
                    <th rowspan="3">Tgl</th>
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
                    <th>Total</th>
                    <th>Jml</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th colspan="15">TOTAL</th>
                    <th id="total_terima" class="text-right"></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <script>
    $(function() {
        let LocalStorage = window.localStorage;

        function load_data() {
            let xBegin = LocalStorage.getItem('xBegin');
            let xEnd = LocalStorage.getItem('xEnd');
            let dept = LocalStorage.getItem('dept');

            $.ajax({
                url: '<?= base_url('gaji_karyawan/get_data_print') ?>',
                type: 'POST',
                data: {
                    xBegin: xBegin,
                    xEnd: xEnd,
                    dept: dept,
                },
                dataType: 'json',
                success: function(res) {
                    $(document).find('#tbl-gaji-karyawan tbody').html(res.isi_tabel);
                    $(document).find('#periode').html('Periode : ' + res.periode);
                    $(document).find('#total_terima').html(res.total_terima);
                    $(decument).find('#tbl-gaji-karyawan tbody').append($(
                        '#tbl-gaji-karyawan tfoot').html());
                },
                complete: function() {
                    // window.print();
                }
            });
        }

        load_data();
    });
    </script>

</body>

</html>