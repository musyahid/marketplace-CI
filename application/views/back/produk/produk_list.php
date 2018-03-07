<?php $this->load->view('back/head') ?>

		<?php $this->load->view('back/navbar') ?>

		<div class="main-container ace-save-state" id="main-container">
			<?php $this->load->view('back/leftbar') ?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Dashboard</a>
							</li>
              <li><?php echo $module ?></li>
							<li><?php echo $title ?></li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1><?php echo $title ?>
								<a href="<?php echo base_url('admin/produk/create') ?>">
              		<button class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Data</button>
            		</a>
							</h1>
						</div>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
                  <div class="box box-primary">
                    <div class="box-body table-responsive padding">
                      <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                      <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th style="text-align: center">No.</th>
                            <th style="text-align: center">Judul produk</th>
                            <th style="text-align: center">Kategori</th>
                            <th style="text-align: center">SubKategori</th>
                            <th style="text-align: center">SuperSubKategori</th>
                            <th style="text-align: center">Harga Jual</th>
                            <th style="text-align: center">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no=1; foreach ($produk_data as $produk):?>
                          <tr>
                            <td style="text-align:center"><?php echo $no++ ?></td>
                            <td style="text-align:left"><?php echo $produk->judul_produk ?></td>
                            <td style="text-align:center"><?php echo $produk->judul_kategori ?></td>
                            <td style="text-align:center"><?php echo $produk->judul_subkategori ?></td>
                            <td style="text-align:center"><?php echo $produk->judul_supersubkategori ?></td>
                            <td style="text-align:center"><?php echo number_format($produk->harga) ?></td>
                            <td style="text-align:center">
                            <?php
                            echo anchor(site_url('admin/produk/update/'.$produk->id_produk),'<i class="glyphicon glyphicon-pencil"></i>','title="Edit", class="btn btn-sm btn-warning"'); echo ' ';
                            echo anchor(site_url('admin/produk/delete/'.$produk->id_produk),'<i class="glyphicon glyphicon-trash"></i>','title="Hapus", class="btn btn-sm btn-danger", onclick="javasciprt: return confirm(\'Apakah Anda yakin ?\')"');
                            ?>
                            </td>
                          </tr>
                          <?php endforeach;?>
                        </tbody>
                      </table>
                    </div>
                  </div>
								</div><!-- /.row -->
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php $this->load->view('back/footer') ?>
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
	</body>
</html>
