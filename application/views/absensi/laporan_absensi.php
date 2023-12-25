<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Absensi</title>
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
            <h3 id="judul">Laporan Absensi Karyawan</h3>
            <p id="periode"></p>
        </div>
        <div style="position:absolute;left:0px;top:10px;">
            <p>Wisata Situ Cipanten</p>
        </div>
        <div style="position:absolute;right:0px;top:10px;">
            <p>Waktu Cetak : <?= date('Y-m-d H:i:s') ?></p>
        </div>
    </div>
    <hr>
    <div id="body">
        <table width="100%" cellspacing="0" id="tbl-absensi">
            <thead>
                <th>No.</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Bagian</th>
                <th>Tanggal</th>
                <th>Masuk</th>
                <th>Telat Masuk</th>
                <th>Pulang</th>
                <th>Kerja</th>
            </thead>
            <tbody></tbody>
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
                url: '<?= base_url('absensi/get_data_print') ?>',
                type: 'POST',
                data: {
                    xBegin: xBegin,
                    xEnd: xEnd,
                    dept: dept,
                },
                dataType: 'json',
                success: function(res) {
                    $(document).find('#tbl-absensi tbody').html(res.isi_tabel);
                    $(document).find('#periode').html('Periode : ' + res.periode);
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