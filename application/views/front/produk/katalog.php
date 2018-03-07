<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
	<div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
    	  <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a></li>
    	  <li class="active">Katalog Produk</li>
    	</ol>
    </div>
    <?php $this->load->view('front/form_cari'); ?>
		<br>
		<h5>Katalog Produk</h5>
		<hr>
    <div class="row">
      <?php
      foreach ($katalog as $katalog_data)
      {
      ?>
      <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
        <div class="thumbnail">
          <?php
          if(empty($katalog_data->foto)) {echo "<img src='".base_url()."assets/images/no_image_thumb.png'>";}
          else { echo " <img src='".base_url()."assets/images/produk/".$katalog_data->foto.'_thumb'.$katalog_data->foto_type."'> ";}
          ?>
          <div class="caption">
            <h6><a href="<?php echo base_url("produk/read/$katalog_data->username/"."$katalog_data->slug_produk ") ?>"><?php echo character_limiter($katalog_data->judul_produk,35) ?></a></h6>
            <p>Rp <?php echo number_format($katalog_data->harga) ?></p>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>

		<hr>

	  <div align="center"><?php echo $this->pagination->create_links() ?></div>

	  <?php $this->load->view('front/footer'); ?>
