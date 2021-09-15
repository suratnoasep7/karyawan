<!-- Sidebar Menu -->
      <nav class="mt-2" style="border-bottom: 1px solid #4f5962">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url() ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('mahasiswa/index') ?>" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Mahasiswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('pegawai/index') ?>" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Pegawai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('kategori_asrama/index') ?>" class="nav-link">
                  <i class="fas fa-database nav-icon"></i>
                  <p>Kategori Asrama</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('asrama/index') ?>" class="nav-link">
                  <i class="fas fa-database nav-icon"></i>
                  <p>Asrama</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('siswa/index') ?>" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Siswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('jabatan/index') ?>" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Jabatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('assign_mahasiswa_asrama/index') ?>" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Assign Mahasiswa Asrama</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('assign_siswa_asrama/index') ?>" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Assign Siswa Asrama</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('assign_jabatan_pegawai/index') ?>" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Assign Jabatan Pegawai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('assign_kepala_asrama/index') ?>" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Assign Kepala Asrama</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('users/index') ?>" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Master Users</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('pelanggaran/index') ?>" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Master Pelanggaran</p>
                </a>
              </li>

            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->