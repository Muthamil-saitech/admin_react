<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo ucwords(str_replace('_',' ',$page_name)).' - '.WEBSITE_NAME; ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo assets(); ?>vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo assets(); ?>vendors/base/vendor.bundle.base.css">
	<link rel="stylesheet" href="<?php echo assets(); ?>css/bootstrap.min.css">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo assets(); ?>css/style.css">
	<!--datetime picker-->
    <!-- endinject -->
	<?php if(isset($admin_setting)) { ?>
    <link rel="shortcut icon" href="<?php echo site_url('uploads/admin-setting/'.$admin_setting['admin_fav_icon']); ?>" />
	<?php } else { ?>	
    <link rel="shortcut icon" href="<?php echo frontend_assets(); ?>img/fav-icon.png" />
	<?php } ?>	
    <script src="<?php echo assets(); ?>vendors/base/vendor.bundle.base.js"></script>
	<script src="<?php echo assets(); ?>js/bootstrap.bundle.min.js" type="text/javascript"></script>
</head>
<style>
#snackbar {
	visibility: hidden;
	min-width: 250px;
	margin-left: -125px;
	background-color: #333;
	color: #fff;
	text-align: center;
	border-radius: 2px;
	padding: 16px;
	position: fixed;
	z-index: 1;
	left: 50%;
	bottom: 30px;
	font-size: 17px;
}
#snackbar.show {
	visibility: visible;
	-webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
	animation: fadein 0.5s, fadeout 0.5s 2.5s;
}
</style>
<body>
<div class="container-scroller">