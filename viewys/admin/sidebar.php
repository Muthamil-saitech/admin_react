<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<ul class="nav">
		<li class="nav-item <?php if($page_name=='dashboard') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/dashboard'); ?>">
	      		<i class="mdi mdi-home menu-icon"></i>
    	  		<span class="menu-title">Dashboard</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name=='banners_with_fil' || ($this->uri->segment(2)=='banners_with_fil' && $page_name=='add_banner') || ($this->uri->segment(2)=='banners_with_fil' && $page_name=='edit_banner')) echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/banners_with_fil'); ?>">
	      		<i class="mdi mdi-application menu-icon"></i>
    	  		<span class="menu-title">Banners</span>
    		</a>
  		</li>
		<!-- <li class="nav-item">
			<a class="nav-link" data-toggle="collapse" href="#ui-cx-img" aria-expanded="false" aria-controls="ui-cx-basic-img">
				<i class="mdi mdi-image-plus menu-icon"></i>
				<span class="menu-title">Gallery</span><i class="menu-arrow"></i>
			</a>
			<div class="collapse <?php if($page_name=='gallery' || $page_name=='add_gallery' || $page_name=='album' || $page_name=='add_album') echo 'show'; ?>" id="ui-cx-img">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link <?php if($page_name=='album' || $page_name=='add_album') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/album'); ?>">Album</a></li>
					<li class="nav-item"><a class="nav-link <?php if($page_name=='gallery' || $page_name=='add_gallery') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/gallery'); ?>">Gallery</a></li>
				</ul>
			</div>
		</li> -->
		<li class="nav-item <?php if($page_name=='testimonials_with_fil' || ($this->uri->segment(2)=='testimonials_with_fil' && $page_name=='add_testimonial') || ($this->uri->segment(2)=='testimonials_with_fil' && $page_name=='edit_testimonial')) echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/testimonials_with_fil'); ?>">
	      		<i class="mdi mdi-application menu-icon"></i>
    	  		<span class="menu-title">Testimonials</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name=='services' || $page_name=='edit_service' || $page_name=='add_service') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/services'); ?>">
	      		<i class="mdi mdi mdi-passport menu-icon"></i>
    	  		<span class="menu-title">Services</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name=='blogs_wo_fil' || ($this->uri->segment(2)=='blogs_wo_fil' && $page_name=='add_blog') || ($this->uri->segment(2)=='blogs_wo_fil' && $page_name=='edit_blog')) echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/blogs_wo_fil'); ?>">
	      		<i class="mdi mdi-application menu-icon"></i>
    	  		<span class="menu-title">Blogs</span>
    		</a>
  		</li>
		<!-- <li class="nav-item">
			<a class="nav-link" data-toggle="collapse" href="#ui-cx-grp" aria-expanded="false" aria-controls="ui-cx-basic-grp">
				<i class="mdi mdi-circle-outline menu-icon"></i>
				<span class="menu-title">Enquiries</span><i class="menu-arrow"></i>
			</a>
			<div class="collapse <?php if($page_name=='contact_enquiries' ) echo 'show'; ?>" id="ui-cx-grp">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link <?php if($page_name=='contact_enquiries') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/contact_enquiries'); ?>">Contact Enquiries</a></li>
				</ul>
			</div>
		</li> -->
		<!-- <li class="nav-item <?php if($page_name=='newsletter_subscription') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/newsletter_subscription'); ?>">
	      		<i class="mdi mdi-youtube-subscription menu-icon"></i>
    	  		<span class="menu-title">Newsletter Subscription</span>
    		</a>
  		</li>   -->
		<li class="nav-item <?php if($page_name=='seo_content' || $page_name=='edit_seo' || $page_name=='add_seo') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/seo_content'); ?>">
	      		<i class="mdi mdi-search-web menu-icon"></i>
    	  		<span class="menu-title">SEO Content</span>
    		</a>
  		</li> 
		<!-- <li class="nav-item <?php if($page_name=='email_configuration') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/email_configuration'); ?>">
	      		<i class="mdi mdi mdi-email menu-icon"></i>
    	  		<span class="menu-title">Email Configuration</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name=='payment_gateway_setting') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/payment_gateway_setting'); ?>">
	      		<i class="mdi mdi-cash menu-icon"></i>
    	  		<span class="menu-title">Payment Gateway Setting</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name=='web_setting') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/web_setting'); ?>">
	      		<i class="mdi mdi mdi-cogs menu-icon"></i>
    	  		<span class="menu-title">Web Setting</span>
    		</a>
  		</li> -->
		<li class="nav-item <?php if($page_name=='admin_setting') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/admin_setting'); ?>">
	      		<i class="mdi mdi mdi-cogs menu-icon"></i>
    	  		<span class="menu-title">Admin Setting</span>
    		</a>
  		</li>
	</ul>
</nav>
<!-- main-panel starts -->
<div class="main-panel">