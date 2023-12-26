<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $judul ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>images/logo/cptn.png">
    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" /> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>AdminLTE_3/plugins/fontawesome-free/css/all.min.css" />
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url() ?>AdminLTE_3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?= base_url() ?>AdminLTE_3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>AdminLTE_3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>AdminLTE_3/dist/css/adminlte.min.css" />
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url() ?>AdminLTE_3/plugins/daterangepicker/daterangepicker.css" />

    <!-- jQuery -->
    <script src="<?= base_url() ?>AdminLTE_3/plugins/jquery/jquery.min.js"></script>

    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() ?>AdminLTE_3/plugins/toastr/toastr.min.css">
    <script src="<?= base_url() ?>AdminLTE_3/plugins/toastr/toastr.min.js"></script>

    <!-- daterange picker -->
    <script src="<?= base_url() ?>AdminLTE_3/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url() ?>AdminLTE_3/plugins/daterangepicker/daterangepicker.js"></script>

    <link rel="stylesheet" href="<?= base_url() ?>extra-libs/mystyle.css" />
    <style>
    table th,
    table td {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px !important;
        vertical-align: middle !important;
    }

    .loaderbox {
        display: none;
    }

    .loder {
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #ddd;
        opacity: 0.3;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 10000;
        font-size: 50px;
    }

    .inpdate {
        width: 120px;
        font-size: 14px;
        text-align: center;
        border-radius: none;
        border: 1px solid #ffc107;
    }

    .inpselect {
        font-size: 14px;
        border: 1px solid #ffc107;
    }
    </style>
</head>