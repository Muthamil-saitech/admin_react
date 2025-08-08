<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  	<div class="navbar-brand-wrapper d-flex justify-content-center">
    	<div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100"> 
			<?php if(isset($admin_setting)) { ?>
      		<a class="navbar-brand brand-logo" href="javascript:;"><img src="<?php echo site_url('uploads/admin-setting/'.$admin_setting['admin_logo']); ?>" alt="logo"/></a>
			<a class="navbar-brand brand-logo-mini" href="javascript:;"><img src="<?php echo site_url('uploads/admin-setting/'.$admin_setting['admin_logo']); ?>" alt="logo"/></a>
			<?php } else { ?>
			<a class="navbar-brand brand-logo" href="javascript:;"><img src="<?php echo frontend_assets(); ?>img/cropped-happy-logo-1.svg>" alt="logo"/></a>
			<a class="navbar-brand brand-logo-mini" href="javascript:;"><img src="<?php echo frontend_assets(); ?>img/cropped-happy-logo-1.svg" alt="logo"/></a>
			<?php } ?>
      		<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
				<span class="mdi mdi-sort-variant"></span>
			</button>
		</div>  
	</div>
	<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
		<ul class="navbar-nav navbar">
			<li class="nav-item nav-profile dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
					<?php /* <img src="<?php echo frontend_assets(); ?>img/favicon.svg" alt="profile"/>  */?>
					<span class="nav-profile-name"><?php if(isset($session_data->name)) echo $session_data->name; else if(isset($session_data->staff_name)) echo $session_data->staff_name; else echo 'Admin';  ?></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
					<a href="<?php echo site_url(ADMIN.'/settings'); ?>" class="dropdown-item"><i class="mdi mdi-settings"></i>Settings</a>
					<a href="<?php echo site_url(); ?>" class="dropdown-item" target="_blank"><i class="mdi mdi-home"></i>Go to Website</a>
					<a href="<?php echo site_url(ADMIN.'/login/logout'); ?>" class="dropdown-item"><i class="mdi mdi-logout"></i>Logout</a>
				</div>
			</li>
		</ul>
		<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas"><span class="mdi mdi-menu"></span></button>
	</div>
</nav>
<div class="container-fluid page-body-wrapper">