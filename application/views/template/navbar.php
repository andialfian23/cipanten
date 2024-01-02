<nav class="main-header navbar navbar-expand bg-navy navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt text-white"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu text-dark">
                <a class="dropdown-item text-dark" href="<?= base_url('dashboard/ubah_password') ?>">
                    Ubah Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-dark" href="<?= base_url('auth/logout') ?>">
                    Logout</a>
            </div>
        </li>
    </ul>
</nav>