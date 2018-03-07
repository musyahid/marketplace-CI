<!-- Navbar static top -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url() ?>">ANDROMEDAPRO</a>
    </div>
    <div class="navbar-collapse collapse">
      <!-- Left nav -->
      <ul class="nav navbar-nav">
        <li><a href="#">Kategori <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url('produk/katalog') ?>">Semua Barang</a></li>
          <?php
          $sql = $this->db->query("SELECT * FROM kategori ORDER BY judul_kategori"); // Memanggil kategori/ top kategori
          $data = $sql->result();
          foreach($data as $row)
          {
            $id_kat = $row->id_kategori;
            echo '
            <li><a href="'.base_url('produk/p/').$row->slug_kat.'">'.$row->judul_kategori.' <span class="caret"></span></a>
              <ul class="dropdown-menu">';

            $sql2 =  $this->db->query("SELECT * FROM subkategori WHERE id_kat = '$id_kat' ORDER BY judul_subkategori "); // Memanggil subkategori/ middle kategori
            $data2 = $sql2->result();
            foreach($data2 as $row2)
            {
              $id_sub = $row2->id_subkategori;
              echo '
                <li><a href="'.base_url('produk/p/').$row->slug_kat.'/'.$row2->slug_subkat.'">'.$row2->judul_subkategori.' <span class="caret"></span></a>
                  <ul class="dropdown-menu">';

              $sql3 =  $this->db->query("SELECT * FROM supersubkategori WHERE id_subkat = '$id_sub' ORDER BY judul_supersubkategori "); // Memanggil subkategori/ middle kategori
              $data3 = $sql3->result();
              foreach($data3 as $row3)
              {
                $id_supersub = $row3->id_supersubkategori;
                echo '<li><a href="'.base_url('produk/p/').$row->slug_kat.'/'.$row2->slug_subkat.'/'.$row3->slug_supersubkat.'">'.$row3->judul_supersubkategori.'</a></li>';
              }
              echo '
                  </ul>
                </li>';
            }
            echo '
            </ul>';
          }
          echo '
          </li>';
          ?>
          </ul>
        </li>
      </ul>

      <!-- Right nav -->
      <ul class="nav navbar-nav navbar-right">
        <?php if(isset($_SESSION['username']) && $_SESSION['usertype'] == '3'){ ?>
          <li><a href="#">Hi, <?php echo $this->session->userdata('nama') ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url('user/edit_profil/').$this->session->userdata('user_id') ?>">Edit Profil</a></li>
              <li><a href="<?php echo base_url('iklan') ?>">Iklan Saya</a></li>
              <li><a href="<?php echo base_url('user/logout') ?>">Logout</a></li>
            </ul>
          </li>
        <?php } else { ?>
        <li><a href="<?php echo base_url('user/login') ?>">Login</a></li>
        <li><a href="<?php echo base_url('user/register') ?>">Register</a></li>
        <?php } ?>
      </ul>

    </div><!--/.nav-collapse -->

</div>
