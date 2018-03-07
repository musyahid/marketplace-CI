<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
	<div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
    	  <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a></li>
    	  <li class="active">Register</li>
    	</ol>
    </div>
		<div class="col-lg-12">
      <h5>Daftar Member di <?php echo $title ?></h5>
			<hr>
			Sudah punya akun? Silahkan Login <a href="<?php echo base_url('user/login') ?>">disini</a>
			<hr>
			<div class="row">
			  <div class="col-lg-12">
          <?php echo form_open("user/register");?>
          <div class="box-body">
            <?php echo $message;?>
						<div class="row">
	            <div class="col-xs-6"><label>Nama</label>
	              <?php echo form_input($nama);?>
	            </div>
							<div class="col-xs-6"><labe>Username</label>
								<?php echo form_input($username);?>
							</div>
						</div><br>
						<div class="row">
							<div class="col-xs-6"><label>Password</label>
								<?php echo form_password($password);?>
							</div>
							<div class="col-xs-6"><label>Konfirmasi Password</label>
								<?php echo form_password($password_confirm);?>
							</div>
						</div><br>
						<div class="row">
							<div class="col-xs-6"><label>No. Hp</label>
								<?php echo form_input($email);?>
							</div>
							<div class="col-xs-6"><label>Email</label>
								<?php echo form_input($email);?>
							</div>
						</div><br>
						<div class="form-group"><label>Alamat</label>
							<?php echo form_textarea($alamat);?>
						</div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-default">Cancel</button>
            </div>
          </div>
          <?php echo form_close(); ?>
			  </div>
			</div>
		</div>
  	<?php $this->load->view('front/footer'); ?>
