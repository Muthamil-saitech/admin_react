<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo WEBSITE_NAME; ?></title>
	<!-- plugins:css -->
	<link rel="stylesheet" href="<?php echo assets(); ?>vendors/mdi/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="<?php echo assets(); ?>vendors/base/vendor.bundle.base.css">
	<link rel="stylesheet" href="<?php echo assets(); ?>css/style.css">
	<!-- endinject -->
	<link rel="shortcut icon" href="" />
</head>
<body>
<?php $admin_setting = $this->db->query('select * from admin_setting where adm_set_id = 1')->row_array(); ?>
<?php $cok_email = $cok_password = '';
if(isset($_COOKIE["DefAdmin"])) {
	$cookie = base64_decode($_COOKIE['DefAdmin']);
	$cookie = decode($cookie); 
	$cook = json_decode($cookie); 
	if (is_object($cook) && isset($cook->email) && isset($cook->password)) {
        $cok_email = $cook->email;
        $cok_password = $cook->password;
    }
} ?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
		<div class="content-wrapper d-flex align-items-center auth px-0">
			<div class="row w-100 mx-0">
				<div class="col-lg-4 mx-auto">
					<div class="auth-form-light text-left py-5 px-4 px-sm-5">
						<?php if(isset($admin_setting)) { ?>
						<div class="brand-logo text-center"><a href="javascript:;"><img src="<?php echo site_url('uploads/admin-setting/'.$admin_setting['admin_logo']); ?>" alt="logo"></a></div>
						<?php } else { ?>
						<div class="brand-logo text-center"><a href="javascript:;"><img src="<?php echo frontend_assets(); ?>img/cropped-happy-logo-1.svg" alt="logo"></a></div>
						<?php } ?>
						<h4>Hello! let's get started</h4>
						<h6 class="font-weight-light">Sign in to continue.</h6>
						<?php if($this->session->flashdata('error')) admin_flash_error(); if($this->session->flashdata('success')) admin_flash_success(); $posted = $this->session->flashdata('posted'); ?>
                        <?php echo form_open(ADMIN.'/login/authentication', array('class' => 'authentication-form pt-3')); ?>
							<div class="form-group">
								<input type="email" name="email" class="form-control form-control-lg" placeholder="Email" value="<?php if(isset($posted)) echo $posted['email']; else echo $cok_email; ?>" />
							</div>
							<div class="form-group mx-auto input-group">
								<input type="password" name="password" class="form-control form-control-lg" placeholder="Password" id="password" value="<?php if(isset($posted)) echo $posted['password']; else echo $cok_password; ?>" />
								<span style="cursor:pointer;" class="input-group-text" id="toggle_password"><i class="mdi mdi-eye-off"></i></span>
							</div>	
							<div class="mt-3">
								<button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
							</div>
							<div class="my-2 d-flex justify-content-between align-items-center">
								<div class="form-check">
									<label class="form-check-label text-muted">
										<input type="checkbox" name="remember" value="1" class="form-check-input">Remember me
									</label>
								</div>
							</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="<?php echo assets(); ?>vendors/base/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="<?php echo assets(); ?>js/template.js"></script>
<!-- endinject -->
<script>
	$(document).ready(function() {
		$('#toggle_password').click(function() {
			var password = $('#password');
			if (password.attr('type') === 'password') {
				password.attr('type', 'text');
				$(this).html('<i class=" mdi mdi-eye"></i>');
			} else {
				password.attr('type', 'password');
				$(this).html('<i class="mdi mdi-eye-off"></i>');
			}
		});
	});
</script>
</body>
</html>