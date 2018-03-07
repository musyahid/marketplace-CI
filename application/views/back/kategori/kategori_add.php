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
                <?php echo form_open($action);?>
                  <?php echo validation_errors() ?>
                  <div class="form-group"><label>Judul Kategori</label>
                    <?php echo form_input($judul_kategori);?>
                  </div>
                  <hr>
                  <button type="submit" name="submit" class="btn btn-success"><?php echo $button_submit ?></button>
                  <button type="reset" name="reset" class="btn btn-danger"><?php echo $button_reset ?></button>
                <?php echo form_close() ?>
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php $this->load->view('back/footer') ?>
	</body>
</html>
