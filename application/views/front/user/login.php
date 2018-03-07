<?php $this->load->view('front/header'); ?>
<?php echo $script_captcha; // javascript recaptcha ?>

<?php $this->load->view('front/navbar'); ?>

<div class="container">
<ol class="breadcrumb">
  <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a></li>
  <li class="active">Login</li>
</ol>
  <div class="row">
    <div class="col-lg-12">
      <h5>Login</h5>
      <hr>
      <div class="box box-primary">
        <?php echo form_open("user/login");?>
        <div class="box-body">
          <?php echo validation_errors() ?>
          <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
          <div class="form-group"><label>Username</label>
            <?php echo form_input($username);?>
          </div>
          <div class="form-group"><label>Password</label>
            <?php echo form_password($password);?>
          </div>
          <p><?php echo $captcha ?></p>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-default">Cancel</button>
          </div>
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>
    <?php $this->load->view('front/footer'); ?>
