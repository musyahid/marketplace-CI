<h5>Produk Terbaru</h5>
<hr>

<div class="row">
  <?php
  foreach ($produk_new_data as $produk_new)
  {
  ?>
  <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
    <div class="thumbnail">
      <?php
      if(empty($produk_new->foto)) {echo "<img src='".base_url()."assets/images/no_image_thumb.png'>";}
      else { echo " <img src='".base_url()."assets/images/produk/".$produk_new->foto.'_thumb'.$produk_new->foto_type."'> ";}
      ?>
      <div class="caption">
        <h6><a href="<?php echo base_url("produk/read/$produk_new->username/"."$produk_new->slug_produk ") ?>"><?php echo character_limiter($produk_new->judul_produk,35) ?></a></h6>
        <p>Rp <?php echo number_format($produk_new->harga) ?></p>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
<h4 align="right"><button type="submit" name="selengkapnya" class="btn btn-primary" formaction="<?php echo base_url('produk/katalog') ?>">Selengkapnya</button></h4>

<h5>Produk Terbaru</h5>
<hr>

<div class="row">
  <?php
  foreach ($produk_new_data as $produk_new)
  {
  ?>
  <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
    <div class="thumbnail">
      <?php
      if(empty($produk_new->foto)) {echo "<img src='".base_url()."assets/images/no_image_thumb.png'>";}
      else { echo " <img src='".base_url()."assets/images/produk/".$produk_new->foto.'_thumb'.$produk_new->foto_type."'> ";}
      ?>
      <div class="caption">
        <h6><a href="<?php echo base_url("produk/read/$produk_new->username/"."$produk_new->slug_produk ") ?>"><?php echo character_limiter($produk_new->judul_produk,35) ?></a></h6>
        <p>Rp <?php echo number_format($produk_new->harga) ?></p>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
<h4 align="right"><button type="submit" name="selengkapnya" class="btn btn-primary" formaction="<?php echo base_url('produk/katalog') ?>">Selengkapnya</button></h4>