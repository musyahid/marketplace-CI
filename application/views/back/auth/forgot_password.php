
<!DOCTYPE html>
<html lang="en">
	<head>
    <title>Lupa Password - Ace Admin</title>
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
								<div id="login-box" class="forgot-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger"><i class="ace-icon fa fa-key"></i>Lupa Password</h4>

											<?php echo form_open("admin/auth/forgot_password");?>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input class="form-control" name="identity" type="text" id="identity" placeholder="username" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<div class="clearfix">
														<button type="submit" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="ace-icon fa fa-lightbulb-o"></i>
															<span class="bigger-110">Reset</span>
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->

										<div class="toolbar center">
											<a href="<?php echo base_url('admin/auth/login') ?>" data-target="#login-box" class="back-to-login-link">
												Kembali ke Login
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.forgot-box -->
							</div><!-- /.position-relative -->

						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->
		<!-- basic scripts -->

	</body>
</html>
