<div id="sidebar" class="sidebar responsive ace-save-state">
  <ul class="nav nav-list">
    <li <?php if($this->uri->segment(2)=="dashboard"){echo "class='active'";} ?>>
      <a href="<?php echo base_url('admin/dashboard') ?>">
        <i class="menu-icon fa fa-home"></i>
        <span class="menu-text"> Dashboard </span>
      </a>

      <b class="arrow"></b>
    </li>

    <li><a href='<?php echo base_url() ?>' target="_blank"><i class="menu-icon fa fa-globe"></i><span class="menu-text"> Lihat Website </span></a>
      <b class="arrow"></b>
    </li>
        
    <!-- produk -->
    <li <?php if($this->uri->segment(2) == "produk"){echo "class='active open'";} ?>>
      <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-shopping-cart"></i>
        <span class="menu-text"> Produk </span>
        <b class="arrow fa fa-angle-down"></b>
      </a>
      <b class="arrow"></b>
      <ul class="submenu">
        <li <?php if($this->uri->segment(2) == "produk" && $this->uri->segment(3) == ""){echo "class='active'";} ?>>
          <a href="<?php echo base_url('admin/produk') ?>"><i class="menu-icon fa fa-caret-right"></i>Semua Data</a>
          <b class="arrow"></b>
        </li>
        <li <?php if($this->uri->segment(2) =="produk" && $this->uri->segment(3) == "create"){echo "class='active'";} ?>>
          <a href="<?php echo base_url('admin/produk/create') ?>"><i class="menu-icon fa fa-caret-right"></i>Tambah Data</a>
          <b class="arrow"></b>
        </li>
      </ul>
    </li>

    <!-- slider -->
    <li <?php if($this->uri->segment(2) == "slider"){echo "class='active open'";} ?>>
      <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-credit-card"></i>
        <span class="menu-text"> Slider </span>
        <b class="arrow fa fa-angle-down"></b>
      </a>
      <b class="arrow"></b>
      <ul class="submenu">
        <li <?php if($this->uri->segment(2) == "slider" && $this->uri->segment(3) == ""){echo "class='active'";} ?>>
          <a href="<?php echo base_url('admin/slider') ?>"><i class="menu-icon fa fa-caret-right"></i>Semua Data</a>
          <b class="arrow"></b>
        </li>
        <li <?php if($this->uri->segment(2) =="slider" && $this->uri->segment(3) == "create"){echo "class='active'";} ?>>
          <a href="<?php echo base_url('admin/slider/create') ?>"><i class="menu-icon fa fa-caret-right"></i>Tambah Data</a>
          <b class="arrow"></b>
        </li>
      </ul>
    </li>

    <!-- kategori -->
    <li <?php if($this->uri->segment(2) == "kategori"){echo "class='active open'";} ?>>
      <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-tags"></i>
        <span class="menu-text"> Kategori </span>
        <b class="arrow fa fa-angle-down"></b>
      </a>
      <b class="arrow"></b>
      <ul class="submenu">
        <li <?php if($this->uri->segment(2) == "kategori" && $this->uri->segment(3) == ""){echo "class='active'";} ?>>
          <a href="<?php echo base_url('admin/kategori') ?>"><i class="menu-icon fa fa-caret-right"></i>Semua Data</a>
          <b class="arrow"></b>
        </li>
        <li <?php if($this->uri->segment(2) =="kategori" && $this->uri->segment(3) == "create"){echo "class='active'";} ?>>
          <a href="<?php echo base_url('admin/kategori/create') ?>"><i class="menu-icon fa fa-caret-right"></i>Tambah Data</a>
          <b class="arrow"></b>
        </li>
      </ul>
    </li>

    <!-- subkategori -->
    <li <?php if($this->uri->segment(2) == "subkategori"){echo "class='active open'";} ?>>
      <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-tags"></i>
        <span class="menu-text"> SubKategori </span>
        <b class="arrow fa fa-angle-down"></b>
      </a>
      <b class="arrow"></b>
      <ul class="submenu">
        <li <?php if($this->uri->segment(2) == "subkategori" && $this->uri->segment(3) == ""){echo "class='active'";} ?>>
          <a href="<?php echo base_url('admin/subkategori') ?>"><i class="menu-icon fa fa-caret-right"></i>Semua Data</a>
          <b class="arrow"></b>
        </li>
        <li <?php if($this->uri->segment(2) =="subkategori" && $this->uri->segment(3) == "create"){echo "class='active'";} ?>>
          <a href="<?php echo base_url('admin/subkategori/create') ?>"><i class="menu-icon fa fa-caret-right"></i>Tambah Data</a>
          <b class="arrow"></b>
        </li>
      </ul>
    </li>

    <!-- supersubkategori -->
    <li <?php if($this->uri->segment(2) == "supersubkategori"){echo "class='active open'";} ?>>
      <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-tags"></i>
        <span class="menu-text"> SuperSubKategori </span>
        <b class="arrow fa fa-angle-down"></b>
      </a>
      <b class="arrow"></b>
      <ul class="submenu">
        <li <?php if($this->uri->segment(2) == "supersubkategori" && $this->uri->segment(3) == ""){echo "class='active'";} ?>>
          <a href="<?php echo base_url('admin/supersubkategori') ?>"><i class="menu-icon fa fa-caret-right"></i>Semua Data</a>
          <b class="arrow"></b>
        </li>
        <li <?php if($this->uri->segment(2) =="supersubkategori" && $this->uri->segment(3) == "create"){echo "class='active'";} ?>>
          <a href="<?php echo base_url('admin/supersubkategori/create') ?>"><i class="menu-icon fa fa-caret-right"></i>Tambah Data</a>
          <b class="arrow"></b>
        </li>
      </ul>
    </li>

    <!-- user -->
    <?php if ($this->ion_auth->is_superadmin()): ?>
    <li <?php if($this->uri->segment(2) == "auth"){echo "class='active open'";} ?>>
      <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-user"></i>
        <span class="menu-text"> User </span>
        <b class="arrow fa fa-angle-down"></b>
      </a>
      <b class="arrow"></b>
      <ul class="submenu">
        <li <?php if($this->uri->segment(2) == "auth" && $this->uri->segment(3) == "user"){echo "class='active'";} ?>>
          <a href="<?php echo base_url('admin/auth/user') ?>"><i class="menu-icon fa fa-caret-right"></i>Semua Data</a>
          <b class="arrow"></b>
        </li>
        <li <?php if($this->uri->segment(2) =="auth" && $this->uri->segment(3) == "create_user"){echo "class='active'";} ?>>
          <a href="<?php echo base_url('admin/auth/create_user') ?>"><i class="menu-icon fa fa-caret-right"></i>Tambah Data</a>
          <b class="arrow"></b>
        </li>
      </ul>
    </li>
    <?php endif ?>

    <!-- logout -->
    <li>
      <a href="<?php echo base_url('admin/auth/logout') ?>">
        <i class="menu-icon fa fa-power-off"></i>
        <span class="menu-text"> Logout </span>
      </a>

      <b class="arrow"></b>
    </li>
  </ul><!-- /.nav-list -->

  <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
    <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
  </div>
</div>
