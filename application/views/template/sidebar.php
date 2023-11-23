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
                     <a href="<?= base_url() ?>" class="nav-link text-white">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>Dashboard</p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="<?= base_url('karyawan') ?>" class="nav-link text-white">
                         <i class="nav-icon fas fa-users"></i>
                         <p>Data Karyawan</p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="<?= base_url('absensi') ?>" class="nav-link text-white">
                         <i class="nav-icon fas fa-users"></i>
                         <p>Data Absensi</p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="<?= base_url('users') ?>" class="nav-link text-white">
                         <i class="nav-icon fas fa-users"></i>
                         <p>Users</p>
                     </a>
                 </li>

             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>