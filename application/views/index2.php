<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scan QR-Code</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url() ?>AdminLTE_3/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>AdminLTE_3/dist/css/adminlte.min.css">

    <!-- jQuery -->
    <script src="<?= base_url() ?>AdminLTE_3/plugins/jquery/jquery.min.js"></script>
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() ?>AdminLTE_3/plugins/toastr/toastr.min.css">
    <script src="<?= base_url() ?>AdminLTE_3/plugins/toastr/toastr.min.js"></script>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light  bg-navy">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <img src="<?= base_url() ?>images/logo/cptn.png" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text text-white font-weight-light font-weight-bold">SINAPEKA</span>
                </a>


                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt text-white"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white" data-toggle="dropdown" href="#">
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right text-dark">
                            <a class="dropdown-item text-dark" href="<?= base_url('dashboard/ubah_password') ?>">
                                <i class="fas fa-key"></i>&nbsp; Ubah Password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-dark" href="<?= base_url('auth/logout') ?>">
                                <i class="fas fa-power-off"></i>&nbsp; Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper bg-grey">


            <!-- Main content -->
            <div class="content">
                <div class="container">

                    <?php $this->load->view($view) ?>

                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?php $this->load->view('template/footer'); ?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>AdminLTE_3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>AdminLTE_3/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>AdminLTE_3/dist/js/demo.js"></script>
</body>

</html>