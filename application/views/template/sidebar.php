<!-- Main Sidebar Container -->
<aside class="main-sidebar bg-navy elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= base_url() ?>images/logo/cptn.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3  bg-white" style="opacity: 0.8" />
        <span class="brand-text font-weight-light">SINAPEKA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url() ?>AdminLTE_3/dist/img/user.png" class="img-circle elevation-2"
                    alt="User Image" />
            </div>
            <div class="info">
                <a href="<?= base_url('dashboard/profil') ?>" class="d-block text-white">
                    <?= $_SESSION['nama'] ?></a>

            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <?php
                    $role = $_SESSION['level'];
                    if ($role == 1) { //MENU ADMIN
                        $menu = $this->menu_model->menu_admin();
                    }elseif($role==2){
                        $menu = $this->menu_model->menu_bendahara();
                    }else{
                        $menu = $this->menu_model->menu_user();
                    }

                    $active = '';
                    foreach ($menu as $r) {
                        if ($r['has-sub'] == TRUE) {
                            $active = ($this->router->fetch_class() == $r['menu_child'][0]['menu_link']) ? 'menu-is-opening menu-open' : '';
                 ?>

                <li class="nav-item <?= $active ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon <?= $r['menu_icon'] ?>"></i>
                        <p><?= $r['menu_text'] ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <?php
                        $active2 = '';
                        foreach ($r['menu_child'] as $c) {
                            $active2 = ($this->router->fetch_class() == $c['menu_link'] or strpos($c['menu_link'], $this->router->method)) ? 'active' : '';
                        ?>

                        <li class="nav-item">
                            <a href="<?= base_url($c['menu_link']) ?>" class="nav-link <?= $active2 ?> ">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?= $c['menu_text'] ?></p>
                            </a>
                        </li>
                        <?php } ?>

                    </ul>
                </li>

                <?php }else{ 
                    $active = ($this->router->fetch_class() == $r['menu_link']) ? 'active' : '';
                    ?>

                <li class="nav-item ">
                    <a href="<?= base_url($r['menu_link']) ?>" class="nav-link <?= $active ?>">
                        <i class="nav-icon <?= $r['menu_icon'] ?>"></i>
                        <p><?= $r['menu_text'] ?></p>
                    </a>
                </li>

                <?php } 
                    } 
                ?>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>