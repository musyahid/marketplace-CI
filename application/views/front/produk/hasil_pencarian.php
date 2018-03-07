<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
	<div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
    	  <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a></li>
			  <li><a href="#">Hasil Pencarian</a></li>
			  <li class="active"><?php echo $this->input->post('cari_produk') ?></li>
    	</ol>
    </div>
		<?php $this->load->view('front/form_cari'); ?>
		<br>
    <h5>Hasil Pencarian: <?php echo $this->input->post('cari_produk') ?></h5>
		<div class="row">
			<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>

		  <?php
		  if(count($hasil_pencarian) == 0){echo "<p align='center'>Produk yang Anda cari tidak ditemukan</p>";}
			elseif(empty($this->input->post('cari_produk'))){echo "<p align='center'>Form pencarian Anda masih kosong</p>";}
			else
			{
			  foreach ($hasil_pencarian as $hasil)
				{
		  ?>
				<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
			    <div class="thumbnail">
			      <?php
			      if(empty($hasil->foto)) {echo "<img src='".base_url()."assets/images/no_image_thumb.png'>";}
			      else { echo " <img src='".base_url()."assets/images/produk/".$hasil->foto.'_thumb'.$hasil->foto_type."'> ";}
			      ?>
			      <div class="caption">
			        <h6><a href="<?php echo base_url("produk/read/$hasil->username/"."$hasil->slug_produk ") ?>"><?php echo character_limiter($hasil->judul_produk,35) ?></a></h6>
			        <p>Rp <?php echo number_format($hasil->harga) ?></p>
			      </div>
			    </div>
			  </div>
		  <?php } }?>
		</div>
  </div>

  <?php $this->load->view('front/footer'); ?>
