<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID CARD</title>
    <style>
    * {
        margin: 0px;
        padding: 2px;
        font-family: arial;
    }

    .luar {
        width: 250px;
        /* background-color: #ddd; */
        border: 2px solid #000;

        padding: 15px;
    }

    img {
        width: 170px;
        margin-left: auto;
        margin-right: auto;
    }

    .bottom,
    .top {
        margin-top: 5px;
        margin-bottom: 5px;
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="luar">
        <div class="top">
            <!-- <img src="<?= base_url('images/foto/'.$karyawan->foto) ?>" alt="" /> -->
            Kartu Karyawan<br>WISATA SITU CIPANTEN
        </div>
        <div class="bottom">
            <img src="<?= base_url('images/qrcode/'.$karyawan->id_karyawan.'.png') ?>" alt="" />
        </div>
        <div class="mid">
            <table border="0">
                <tr>
                    <td>NIK</td>
                    <td>: <?= $karyawan->id_karyawan ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>: <?= $karyawan->nama ?></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>: <?= $karyawan->nama_jabatan ?></td>
                </tr>
                <tr>
                    <td>Bagian</td>
                    <td>: <?= $karyawan->nama_dept ?></td>
                </tr>
            </table>
        </div>

    </div>

    <script>
    window.print();
    </script>
</body>

</html>