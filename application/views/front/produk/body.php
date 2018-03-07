<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
	<div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
    	  <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a></li>
    	  <li><a href="<?php echo base_url('produk/p/').$produk->slug_kat ?>"><?php echo $produk->judul_kategori ?></a></li>
        <li><a href="<?php echo base_url('produk/p/').$produk->slug_kat."/".$produk->slug_subkat ?>"><?php echo $produk->judul_subkategori ?></a></li>
        <li><a href="<?php echo base_url('produk/p/').$produk->slug_kat."/".$produk->slug_subkat."/".$produk->slug_supersubkat ?>"><?php echo $produk->judul_supersubkategori ?></a></li>
    	  <li class="active"><?php echo $produk->judul_produk ?></li>
    	</ol>
			<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
    </div>
		<div class="col-lg-9">
      <h5><?php echo $produk->judul_produk ?></h5><hr>
			<div class="row">
			  <div class="col-sm-5">
		    	<?php
		      if(empty($produk->foto)) {echo "<img src='".base_url()."assets/images/no_image_thumb.png' width='400' height='400'>";}
		      else { echo " <img src='".base_url()."assets/images/produk/".$produk->foto.$produk->foto_type."' class='img-responsive' title='$produk->judul_produk' alt='$produk->judul_produk' id='myImg' width='400' height='400'> ";}
		      ?>
					<br>
				</div>
				<div class="col-sm-7">
					<p><b>Spesifikasi</b></p>
					<p>Kondisi: <?php echo $produk->kondisi ?></p>
					<p>Berat: <?php echo $produk->berat ?> kg</p>
					<p>Harga: Rp <?php echo number_format($produk->harga) ?></p>
					<p>Kategori:
						<a href="<?php echo base_url('produk/p/').$produk->slug_kat ?>">
							<?php echo $produk->judul_kategori ?>
						</a> /
						<a href="<?php echo base_url('produk/p/').$produk->slug_kat."/".$produk->slug_subkat ?>">
							<?php echo $produk->judul_subkategori ?>
						</a> /
						<a href="<?php echo base_url('produk/p/').$produk->slug_kat."/".$produk->slug_subkat."/".$produk->slug_supersubkat ?>">
							<?php echo $produk->judul_supersubkategori ?>
						</a>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<b>Deskripsi Produk</b>
					<p><?php echo $produk->deskripsi ?></p>
				</div>
			</div>

			<hr>

			<h4>Diskusi Produk</h4>
			<div class="row">
				<div class="col-md-12">
					<p><?php echo validation_errors(); ?></p>
					<?php
					if(!isset($_SESSION['username'])){
						echo "Silahkan login terlebih dahulu, klik <a href='".base_url()."user/login'>disini</a> untuk login.";
					}
					else{
					?>
						<?php echo form_open("produk/komen/".$produk->username.'/'.$produk->slug_produk."");?>
						<input type="hidden" name="produk_id" value="<?php echo $produk->id_produk ?>">
							<div class="form-group">
								<textarea class="form-control" name="isi_komentar" placeholder="Isikan pertanyaan Anda disini" required></textarea>
							</div>
							<div class="form-group">
								<?php echo $cap_img; ?><br><br>
								<input type="text" class="form-control" name="kode_captcha" placeholder="isikan captcha diatas" required>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Submit</button>
								<button type="reset" class="btn btn-default">Cancel</button>
							</div>
						<?php echo form_close(); ?>
					<?php } ?>

					<hr>

					<?php
				  if($get_komentar == NULL){
				  	echo "Belum ada komentar";
				  }
				  else
				  {
					  foreach ($get_komentar as $komen)
					  {
					  ?>
					  <b><?php echo $komen->nama ?></b>, berkata:
					  <p>" <?php echo $komen->isi_komentar ?> "</p>
					  <p align="right">pada <?php echo $komen->created ?></p>
				  <?php }} ?>
			  </div>
			</div>

		</div>
		<hr>

		<?php $this->load->view('front/sidebar'); ?>

  <?php $this->load->view('front/footer'); ?>

	<div id="myModal" class="modal">
	  <!-- The Close Button -->
	  <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>

	  <!-- Modal Content (The Image) -->
		<?php echo "<img src='".base_url()."assets/images/produk/".$produk->foto.$produk->foto_type."' class='modal-content' title='$produk->judul_produk' id='img'>" ?>

	  <!-- Modal Caption (Image Text) -->
	  <div id="caption">Tes</div>

		<script type="text/javascript">
		// Get the modal
		var modal = document.getElementById('myModal');

		// Get the image and insert it inside the modal - use its "alt" text as a caption
		var img = document.getElementById('myImg');
		var modalImg = document.getElementById("img");
		var captionText = document.getElementById("caption");
		img.onclick = function(){
			modal.style.display = "block";
			modalImg.src = this.src;
			captionText.innerHTML = this.alt;
		}

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		modal.style.display = "none";
		}
		</script>
	</div>
