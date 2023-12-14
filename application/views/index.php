<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('template/head'); ?>

<body class="hold-transition layout-fixed">

    <div class="wrapper">
        <!-- Preloader -->
        <?php // $this->load->view('template/loader'); ?>

        <!-- Navbar -->
        <?php $this->load->view('template/navbar'); ?>
        <!-- /.navbar -->

        <?php $this->load->view('template/sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid pt-3">

                    <?= $this->session->flashdata('message'); ?>

                    <?php $this->load->view($view); ?>

                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php $this->load->view('template/footer'); ?>


    </div>
    <!-- ./wrapper -->

    <?php $this->load->view('template/js'); ?>

</body>

</html>