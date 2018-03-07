<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
	<div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
    	  <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a></li>
    	  <li>Profil</li>
        <li class="active"><b><a href="<?php echo current_url() ?>">Edit Profil</a></b></li>
    	</ol>
    </div>
		<div class="col-lg-12">
      <h5>Ubah Profil Anda</h5>
      <hr>
			<div class="row">
			  <div class="col-lg-12">
          <?php echo $message ?>
          <?php echo validation_errors() ?>
          <?php echo form_open_multipart(uri_string());?>
            <div class="row">
              <div class="col-xs-6"><label>Nama</label>
                <?php echo form_input($nama);?>
              </div>
              <div class="col-xs-6"><label>Username</label>
                <?php echo form_input($username);?>
              </div>
            </div><br>
            <div class="row">
              <div class="col-xs-6"><label>Password</label>
                <?php echo form_input($password);?>
              </div>
              <div class="col-xs-6"><label>Konfirmasi Password</label>
                <?php echo form_input($password_confirm);?>
              </div>
            </div><br>
            <div class="row">
              <div class="col-xs-6"><label>No. HP</label>
                <?php echo form_input($phone);?>
              </div>
              <div class="col-xs-6"><label>Email</label>
                <?php echo form_input($email);?>
              </div>
            </div><br>
            <div class="form-group"><label>Alamat</label>
              <?php echo form_textarea($alamat);?>
            </div>
            <div class="form-group"><label>Gambar Sebelumnya</label><br>
              <img src="<?php echo base_url('assets/images/user/'.$user->userfile.$user->userfile_type.'') ?>" width="200px"/>
            </div>
            <div class="form-group"><label>Gambar</label>
              <input type="file" class="form-control" name="userfile" id="userfile" onchange="tampilkanPreview(this,'preview')"/>
              <br><p><b>Preview Gambar</b><br>
              <img id="preview" src="" alt="" width="350px"/>
            </div>
            <?php echo form_hidden('id', $user->id);?>
            <?php echo form_hidden($csrf); ?>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <button type="reset" name="reset" class="btn btn-danger">Reset</button>
          <?php echo form_close() ?>
        </div><!-- /.col -->
			</div>
		</div>

  	<?php $this->load->view('front/footer'); ?>

	  <script type="text/javascript">
	  function tampilkanPreview(userfile,idpreview)
	  { //membuat objek gambar
	    var gb = userfile.files;
	    //loop untuk merender gambar
	    for (var i = 0; i < gb.length; i++)
	    { //bikin variabel
	      var gbPreview = gb[i];
	      var imageType = /image.*/;
	      var preview=document.getElementById(idpreview);
	      var reader = new FileReader();
	      if (gbPreview.type.match(imageType))
	      { //jika tipe data sesuai
	        preview.file = gbPreview;
	        reader.onload = (function(element)
	        {
	          return function(e)
	          {
	            element.src = e.target.result;
	          };
	        })(preview);
	        //membaca data URL gambar
	        reader.readAsDataURL(gbPreview);
	      }
	        else
	        { //jika tipe data tidak sesuai
	          alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
	        }
	    }
	  }
	  </script>
