<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=base_url('admin')?>" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light" style="font-family: 'Fredoka One', cursive;"><center>I . K . P</center></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header" style="font-family: 'Fredoka One', cursive;">MENU</li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-edit"></i>
                <p style="font-family: 'Be Vietnam', sans-serif;">Master Data
                  <i class="fas fa-caret-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="<?= base_url('admin/ikp')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Input Data IKP</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-list-ul"></i>
                <p style="font-family: 'Be Vietnam', sans-serif;">List Data
                  <i class="fas fa-caret-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="<?= base_url('admin/tabel_ikp')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data IKP</p>
                  </a>
                </li>
                <!-- <li class="nav-item">
                <a href="<?= base_url('admin/tabel_barangmasuk') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Barang Masuk</p>
                </a>
            </li> -->
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file-upload"></i>
                <p style="font-family: 'Be Vietnam', sans-serif;">Berkas
                  <i class="fas fa-caret-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('upload') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lampirkan File</p>
                  </a>
                </li>
              </ul>
            <li class="nav-header" style="font-family: 'Fredoka One', cursive;">SETTING</li>
            <!-- <li class="nav-item">
              <a href="<?= base_url('admin/profile')?>" class="nav-link">
                <i class="nav-icon fa fa-cogs"></i>
                <p style="font-family: 'Be Vietnam', sans-serif;">Profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/users')?>" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p style="font-family: 'Be Vietnam', sans-serif;">Users</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="<?= base_url('admin/signout'); ?>" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p style="font-family: 'Be Vietnam', sans-serif;">Sign Out</p>
              </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>