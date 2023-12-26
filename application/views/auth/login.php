<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>AdminLTE_3/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>AdminLTE_3/dist/css/adminlte.min.css">
    <!-- jQuery -->
    <script src="<?= base_url() ?>AdminLTE_3/plugins/jquery/jquery.min.js"></script>
</head>

<body class="hold-transition login-page bg-navy">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-success">
            <div class="card-header text-center">
                <img src="<?= base_url() ?>images/logo/cptn.png" alt="Cipanten Logo" class="] bg-white w-50 my-2"
                    style="opacity: 0.8" />
            </div>
            <div class="card-body">
                <div class="notif"></div>

                <!-- <form> -->
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="NIK" id="username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <small class="text-danger mb-3" id="notif_username"></small>
                <div class="input-group mt-2">
                    <input type="password" class="form-control" placeholder="Password" id="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <small class="text-danger mb-3" id="notif_password"></small>
                <div class="row my-2">
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block" id="btn-login">LOGIN</button>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- </form> -->

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <script>
    $(function() {

        $(document).on('keydown', '#username,#password', function() {
            if (event.keyCode == 13) {
                login();
            }
        });

        $(document).on('click', '#btn-login', function() {
            login();
        });

        function login() {
            $('.notif, small').empty();
            $('input').removeClass('border-danger');

            $.ajax({
                url: '<?= base_url('auth/login') ?>',
                type: 'POST',
                data: {
                    username: $('#username').val(),
                    password: $('#password').val(),
                },
                dataType: 'json',
                success: function(res) {


                    if (res.status == 0) {
                        $('.notif').html(`<div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                ` + res.pesan + `
                            </div>`);

                        if (res.form_error.username != '') {
                            $('#username').addClass('border-danger');
                            $('#notif_username').html(res.form_error.username);
                        }

                        if (res.form_error.password != '') {
                            $('#password').addClass('border-danger');
                            $('#notif_password').html(res.form_error.password);
                        }

                    } else {
                        $('.notif').html(`<div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                ` + res.pesan + `
                            </div>`);
                        setTimeout(() => {
                            window.location.replace('<?= base_url('dashboard') ?>');
                        }, 1000);
                    }
                }
            });
        }
    });
    </script>

    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>AdminLTE_3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>AdminLTE_3/dist/js/adminlte.min.js"></script>
</body>

</html>