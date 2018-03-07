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
						<div class="page-header"><h1><?php echo $title ?></h1></div>

						<div class="row">
							<div class="col-xs-12">
                <?php echo form_open_multipart(uri_string());?>
									<?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');} ?>
                  <?php echo validation_errors() ?>
                  <div class="row">
                    <div class="col-xs-6"><label>Nama</label>
                      <?php echo form_input($nama);?>
                    </div>
                    <div class="col-xs-6"><label>Username</label>
                      <?php echo form_input($username);?>
                    </div>
                  </div><br>
                  <div class="row">
                    <div class="col-xs-6"><label>Email</label>
                      <?php echo form_input($email);?>
                    </div>
                    <div class="col-xs-6"><label>No. HP</label>
                      <?php echo form_input($phone);?>
                    </div>
                  </div><br>
                  <div class="form-group"><label>Alamat</label>
                    <?php echo form_textarea($alamat);?>
                  </div>
                  <?php if ($this->ion_auth->is_superadmin()): ?>
                  <div class="form-group"><label>Tipe user</label>
                  <?php echo form_dropdown('',$get_all_users_group,$user->usertype,$usertype);?>
                  </div>
                  <?php endif ?>
                  <div class="row">
                    <div class="col-xs-6"><label>Password</label>
                      <?php echo form_input($password);?>
                    </div>
                    <div class="col-xs-6"><label>Konfirmasi Password</label>
                      <?php echo form_input($password_confirm);?>
                    </div>
                  </div><br>
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
                  <hr>
                  <button type="submit" name="submit" class="btn btn-success">Submit</button>
                  <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                <?php echo form_close() ?>
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php $this->load->view('back/footer') ?>
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
	</body>
</html>
