<!DOCTYPE html>
<html lang="en">
	<head>
    <title>Reset Password</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url('assets/template/backend') ?>/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url('assets/template/backend') ?>/font-awesome/4.5.0/css/font-awesome.min.css" />
		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url('assets/template/backend') ?>/css/fonts.googleapis.com.css" />
		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url('assets/template/backend') ?>/css/ace.min.css" />
		<link rel="stylesheet" href="<?php echo base_url('assets/template/backend') ?>/css/ace-rtl.min.css" />
		<!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/favicon.png" />
	</head>

	<body class="login-layout light-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="ace-icon fa fa-user"></i>
									<span class="red">System</span>
									<span class="white" id="id-text2">Panel</span>
								</h1>
								<h4 class="blue" id="id-company-text">&copy; Marketplace</h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger"><i class="ace-icon fa fa-user green"></i> Reset Password</h4>

											<?php echo $message ?>
											<fieldset>
												<?php echo form_open('admin/auth/reset_password/'.$code);?>
													<label>Password Baru (min. <?php echo $min_password_length ?> huruf)</label>
													<span class="block input-icon input-icon-right">
							            	<?php echo form_input($new_password);?>
														<i class="ace-icon fa fa-asterisk"></i>
													</span>
													<br>
													<label>Konfirmasi Password Baru Anda</label>
													<span class="block input-icon input-icon-right">
							            	<?php echo form_input($new_password_confirm);?>
														<i class="ace-icon fa fa-asterisk"></i>
													</span>
													<br>
													<?php echo form_input($user_id);?>
													<?php echo form_hidden($csrf); ?>
													<button type="submit" name="reset" class="btn btn-primary">Reset Password</button>
							          <?php echo form_close();?>
											</fieldset>
										</div><!-- /.widget-main -->
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->
							</div><!-- /.position-relative -->

						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

    <script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url('assets/template/backend') ?>/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
		</script>

	</body>
</html>
