 <!-- Main Sidebar Container -->
 <aside class="main-sidebar bg-navy elevation-4">
     <!-- Brand Logo -->
     <a href="#" class="brand-link">
         <img src="<?= base_url() ?>AdminLTE_3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3  bg-white" style="opacity: 0.8" />
         <span class="brand-text font-weight-light">Cipanten AppV1</span>
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
                 <a href="<?= base_url() ?>" class="d-block text-white">Andi Alfian</a>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <li class="nav-item">
                     <a href="<?= base_url() ?>" class="nav-link ">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>Dashboard</p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="<?= base_url('karyawan') ?>" class="nav-link ">
                         <i class="nav-icon fas fa-users"></i>
                         <p>Data Karyawan</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('jabatan') ?>" class="nav-link ">
                         <i class="nav-icon fas fa-crown"></i>
                         <p>Data Jabatan</p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="<?= base_url('absensi') ?>" class="nav-link ">
                         <i class="nav-icon fas fa-calendar-check"></i>
                         <p>Data Absensi</p>
                     </a>
                 </li>
                 <li class="nav-item menu-open">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-book"></i>
                         <p>
                             Data Penggajian
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="<?= base_url('gaji') ?>" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Slip Gaji</p>
                             </a>
                         </li>
                         <!-- <li class="nav-item">
                             <a href="<?= base_url('histori_gaji') ?>" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Histori Penggajian</p>
                             </a>
                         </li> -->
                     </ul>
                 </li>

             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>