<?php $this->load->view('back/head'); ?>
<?php $this->load->view('back/header'); ?>
<?php $this->load->view('back/leftbar'); ?>

<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $title ?></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><?php echo $module ?></li>
      <li class="active"><a href="<?php echo current_url() ?>"><?php echo $title ?></a></li>
    </ol>
  </section>
  <section class='content'>
    <div class='row'>
      <?php echo form_open_multipart($action);?>
        <div class="col-md-12"> <?php echo validation_errors() ?> </div>
        <!-- kolom kiri -->
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group"><label>Isi Berita</label>
                <?php echo form_input($isi_berita, $berita->isi_berita);?>
              </div>
            </div>
            <?php echo form_input($id_berita,$berita->id_berita);?>
            <div class="box-footer">
              <button type="submit" name="submit" class="btn btn-success"><?php echo $button_submit ?></button>
              <button type="reset" name="reset" class="btn btn-danger"><?php echo $button_reset ?></button>
            </div>
          </div>
        </div>

      <?php echo form_close(); ?>
    </div>
  </section>
</div>

<?php $this->load->view('back/footer'); ?>
