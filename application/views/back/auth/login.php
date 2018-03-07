<!DOCTYPE html>
<html lang="en">
	<head>
    <title>Login Page - Ace Admin</title>
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
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-user green"></i>
												Silahkan isi ID Anda
											</h4>

											<div class="space-6"></div>

											<?php echo $message ?>

											<?php echo form_open("admin/auth/login");?>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<?php echo form_input(array('name' => 'username', 'value' => set_value('username'), 'placeholder' => 'Username', 'class' => 'form-control')); ?>
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<?php echo form_password(array('name' => 'password', 'value' => set_value('password'), 'placeholder' => 'Password', 'class' => 'form-control')); ?>
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
                              <?php echo form_checkbox('remember', '1', FALSE, array('id'=>'remember', 'class'=>"ace"));?>
															<span class="lbl"> Remember Me</span>
														</label>

														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a href="<?php echo base_url('admin/auth/forgot_password') ?>" class="forgot-password-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													Lupa Password ?
												</a>
											</div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->
							</div><!-- /.position-relative -->

						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?php echo base_url('assets/template/backend') ?>/js/jquery-2.1.4.min.js"></script>

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
