<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a></li>
        <li>Iklan</li>
        <li><a href="<?php echo current_url() ?>">Iklan Saya</a></li>
      </ol>

      <div class="row">
        <div class="col-lg-2">
        <h5>Daftar Iklan Saya</h5>
        </div>
        <div class="col-lg-6">

        <a href="<?php echo base_url('iklan/create') ?>">
          <button class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Data</button>
        </a>
      </div>
      </div>
    </div>
  </div>
<hr>
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-primary">
        <div class="box-body table-responsive padding">
          <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
          <table id="datatable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="text-align: center">No.</th>
                <th style="text-align: center">Judul produk</th>
                <th style="text-align: center">Kategori</th>
                <th style="text-align: center">SubKategori</th>
                <th style="text-align: center">SuperSubKategori</th>
                <th style="text-align: center">Upload</th>
                <th style="text-align: center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach ($iklan_data as $iklan):?>
              <tr>
                <td style="text-align:center"><?php echo $no++ ?></td>
                <td style="text-align:left"><?php echo $iklan->judul_produk ?></td>
                <td style="text-align:center"><?php echo $iklan->judul_kategori ?></td>
                <td style="text-align:center"><?php echo $iklan->judul_subkategori ?></td>
                <td style="text-align:center"><?php echo $iklan->judul_supersubkategori ?></td>
                <td style="text-align:center"><?php echo $iklan->created ?></td>
                <td style="text-align:center">
                <?php
                echo anchor(site_url('produk/read/'.$iklan->username."/".$iklan->slug_produk),'<i class="glyphicon glyphicon-zoom-in"></i>','title="Lihat Iklan", class="btn btn-sm btn-primary"'); echo ' ';
                echo anchor(site_url('iklan/update/'.$iklan->id_produk),'<i class="glyphicon glyphicon-pencil"></i>','title="Edit", class="btn btn-sm btn-warning"'); echo ' ';
                echo anchor(site_url('iklan/delete/'.$iklan->id_produk),'<i class="glyphicon glyphicon-trash"></i>','title="Hapus", class="btn btn-sm btn-danger", onclick="javasciprt: return confirm(\'Apakah Anda yakin ?\')"');
                ?>
                </td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <?php $this->load->view('front/footer'); ?>

    <!-- DATA TABLES SCRIPT -->
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>" type="text/javascript"></script>
    <script type="text/javascript">
    function confirmDialog() {
     return confirm('Apakah anda yakin?')
    }
      $('#datatable').dataTable({
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Semua"]]
      });
    </script>
