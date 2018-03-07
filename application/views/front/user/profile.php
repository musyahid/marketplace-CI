<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
	<div class="row">
    <div class="col-lg-3" align="center">
			<?php
      if(empty($profil_data->userfile)) {echo "<img src='".base_url()."assets/images/no_image_thumb.png' class='img-circle' width='200px'>";}
      else { echo " <img src='".base_url()."assets/images/user/".$profil_data->userfile.$profil_data->userfile_type."' class='img-circle' width='200px'> ";}
      ?>
    </div><br>
    <div class="col-lg-6">
      <p><b>Nama Toko</b>: <?php echo $profil_data->nama ?></p>
      <p><b>Email</b>: <?php echo $profil_data->email ?></p>
      <p><b>Telp</b>: +<?php echo $profil_data->phone ?></p>
      <p>
        <a href="https://api.whatsapp.com/send?phone=+<?php echo $profil_data->phone ?>&text=Hi%20Gan,%20Saya%20minat%20dengan%20barangnya%20yang%20di%20website">
          <button type="submit" name="button" class="btn btn-success">Kontak Seller via Whatsapp</button>
        </a>
      </p>
    </div>
    <div class="col-lg-12">
      <hr>
  		<h5>Produk</h5>
  		<hr>
  		<div class="row">
        <?php foreach ($profil as $profil_new){ ?>
  	      <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
  	        <div class="thumbnail">
  	          <?php
  	          if(empty($profil_new->foto)) {echo "<img src='".base_url()."assets/images/no_image_thumb.png'>";}
  	          else { echo " <img src='".base_url()."assets/images/produk/".$profil_new->foto.'_thumb'.$profil_new->foto_type."'> ";}
  	          ?>
  	          <div class="caption">
  	            <h6><a href="<?php echo base_url("produk/read/"."$profil_new->username"."/".$profil_new->slug_produk) ?>"><?php echo character_limiter($profil_new->judul_produk,35) ?></a></h6>
  	            <p>Rp <?php echo number_format($profil_new->harga) ?></p>
  	          </div>
  	        </div>
  	      </div>
        <?php } ?>
      </div>
	  </div>

	  <?php $this->load->view('front/footer'); ?>
