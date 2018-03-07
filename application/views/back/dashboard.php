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
					</ul><!-- /.breadcrumb -->
				</div>

				<div class="page-content">
					<div class="page-header">
						<h1>Dashboard</h1>
					</div><!-- /.page-header -->

					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
								<i class="ace-icon fa fa-bullhorn green"></i> Selamat Datang di halaman system, <?php echo $this->session->userdata('nama') ?>.
							</div>
						</div><!-- /.col -->
						<div class="col-xs-12 infobox-container">
		          <div class="infobox infobox-green">
		            <div class="infobox-icon"><i class="ace-icon fa fa-shopping-cart"></i></div>
		            <div class="infobox-data"><span class="infobox-data-number">32</span>
		              <div class="infobox-content">Produk</div>
		            </div>
		          </div>

		          <div class="infobox infobox-blue">
		            <div class="infobox-icon"><i class="ace-icon fa fa-credit-card"></i></div>
		            <div class="infobox-data"><span class="infobox-data-number">11</span>
		              <div class="infobox-content">Slider</div>
		            </div>
		          </div>

		          <div class="infobox infobox-pink">
		            <div class="infobox-icon"><i class="ace-icon fa fa-tags"></i></div>
		            <div class="infobox-data"><span class="infobox-data-number">8</span>
		              <div class="infobox-content">Kategori</div>
		            </div>
		          </div>

							<div class="infobox infobox-red">
		            <div class="infobox-icon"><i class="ace-icon fa fa-tags"></i></div>
		            <div class="infobox-data"><span class="infobox-data-number">8</span>
		              <div class="infobox-content">SubKategori</div>
		            </div>
		          </div>

							<div class="infobox infobox-orange">
		            <div class="infobox-icon"><i class="ace-icon fa fa-tags"></i></div>
		            <div class="infobox-data"><span class="infobox-data-number">8</span>
		              <div class="infobox-content">SuperSubKategori</div>
		            </div>
		          </div>
						</div>
					</div><!-- /.row -->
				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->

		<?php $this->load->view('back/footer') ?>
	</body>
</html>
