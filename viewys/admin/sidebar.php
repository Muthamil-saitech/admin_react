<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<ul class="nav">
		<li class="nav-item <?php if($page_name=='dashboard') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/dashboard'); ?>">
	      		<i class="mdi mdi-home menu-icon"></i>
    	  		<span class="menu-title">Dashboard</span>
    		</a>
  		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="collapse" href="#ui-cx-bn" aria-expanded="false" aria-controls="ui-cx-basic-bn">
				<i class="mdi mdi-application menu-icon"></i>
				<span class="menu-title">Banners</span><i class="menu-arrow"></i>
			</a>
			<div class="collapse <?php if($page_name=='banners_with_fil' || $page_name=='add_banner' || $page_name=='edit_banner') echo 'show'; ?>" id="ui-cx-bn">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link <?php if($page_name=='banners_with_fil' || ($this->uri->segment(2)=='banners_with_fil' && $page_name=='add_banner') || ($this->uri->segment(2)=='banners_with_fil' && $page_name=='edit_banner')) echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/banners_with_fil'); ?>">With Filter</a></li>
					<li class="nav-item"><a class="nav-link <?php if($page_name=='banners_wo_fil' || ($this->uri->segment(2)=='banners_wo_fil' && $page_name=='add_banner') || ($this->uri->segment(2)=='banners_wo_fil' && $page_name=='edit_banner')) echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/banners_wo_fil'); ?>">Without Filter</a></li>
				</ul>
			</div>
		</li>
		<li class="nav-item">
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
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="collapse" href="#ui-cx-test" aria-expanded="false" aria-controls="ui-cx-basic-test">
				<i class="mdi mdi-application menu-icon"></i>
				<span class="menu-title">Testimonials</span><i class="menu-arrow"></i>
			</a>
			<div class="collapse <?php if($page_name=='testimonials_wo_fil' || $page_name=='testimonials_with_fil' || $page_name=='add_testimonial' || $page_name=='edit_testimonial') echo 'show'; ?>" id="ui-cx-test">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link <?php if($page_name=='testimonials_with_fil' || ($this->uri->segment(2)=='testimonials_with_fil' && $page_name=='add_testimonial') || ($this->uri->segment(2)=='testimonials_with_fil' && $page_name=='edit_testimonial')) echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/testimonials_with_fil'); ?>">With Filter</a></li>
					<li class="nav-item"><a class="nav-link <?php if($page_name=='testimonials_wo_fil' || ($this->uri->segment(2)=='testimonials_wo_fil' && $page_name=='add_testimonial') || ($this->uri->segment(2)=='testimonials_wo_fil' && $page_name=='edit_testimonial')) echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/testimonials_wo_fil'); ?>">Without Filter</a></li>
				</ul>
			</div>
		</li>
		<li class="nav-item <?php if($page_name=='services' || $page_name=='edit_service' || $page_name=='add_service') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/services'); ?>">
	      		<i class="mdi mdi mdi-passport menu-icon"></i>
    	  		<span class="menu-title">Services</span>
    		</a>
  		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="collapse" href="#ui-cx-bg" aria-expanded="false" aria-controls="ui-cx-basic-bg">
				<i class="mdi mdi-application menu-icon"></i>
				<span class="menu-title">Blogs</span><i class="menu-arrow"></i>
			</a>
			<div class="collapse <?php if($page_name=='blogs_with_fil' || $page_name=='blogs_wo_fil' || $page_name=='add_blog' || $page_name=='edit_blog') echo 'show'; ?>" id="ui-cx-bg">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link <?php if($page_name=='blogs_with_fil' || ($this->uri->segment(2)=='blogs_with_fil' && $page_name=='add_blog') || ($this->uri->segment(2)=='blogs_with_fil' && $page_name=='edit_blog')) echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/blogs_with_fil'); ?>">With Filter</a></li>
					<li class="nav-item"><a class="nav-link <?php if($page_name=='blogs_wo_fil' || ($this->uri->segment(2)=='blogs_wo_fil' && $page_name=='add_blog') || ($this->uri->segment(2)=='blogs_wo_fil' && $page_name=='edit_blog')) echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/blogs_wo_fil'); ?>">Without Filter</a></li>
				</ul>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="collapse" href="#ui-cx-grp" aria-expanded="false" aria-controls="ui-cx-basic-grp">
				<i class="mdi mdi-circle-outline menu-icon"></i>
				<span class="menu-title">Enquiries</span><i class="menu-arrow"></i>
			</a>
			<div class="collapse <?php if($page_name=='contact_enquiries' ) echo 'show'; ?>" id="ui-cx-grp">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link <?php if($page_name=='contact_enquiries') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/contact_enquiries'); ?>">Contact Enquiries</a></li>
				</ul>
			</div>
		</li>
		<li class="nav-item <?php if($page_name=='newsletter_subscription') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/newsletter_subscription'); ?>">
	      		<i class="mdi mdi-youtube-subscription menu-icon"></i>
    	  		<span class="menu-title">Newsletter Subscription</span>
    		</a>
  		</li>  
		<li class="nav-item <?php if($page_name=='seo_content' || $page_name=='edit_seo' || $page_name=='add_seo') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/seo_content'); ?>">
	      		<i class="mdi mdi-search-web menu-icon"></i>
    	  		<span class="menu-title">SEO Content</span>
    		</a>
  		</li> 
		<li class="nav-item <?php if($page_name=='email_configuration') echo 'active'; ?>">
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
  		</li>
		<li class="nav-item <?php if($page_name=='admin_setting') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/admin_setting'); ?>">
	      		<i class="mdi mdi mdi-cogs menu-icon"></i>
    	  		<span class="menu-title">Admin Setting</span>
    		</a>
  		</li>
		<?php /* <li class="nav-item <?php if($page_name=='banners' || $page_name === 'add_banner' || $page_name === 'edit_banner') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/banners'); ?>">
	      		<i class="mdi mdi-image-area menu-icon"></i>
    	  		<span class="menu-title">Banners</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name=='about_us') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/about_us'); ?>">
	      		<i class="mdi mdi-information menu-icon"></i>
    	  		<span class="menu-title">About Us</span>
    		</a>
  		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="collapse" href="#ui-cx-basicm" aria-expanded="false" aria-controls="ui-cx-basicm">
				<i class="mdi mdi-circle-outline menu-icon"></i>
				<span class="menu-title">Master</span><i class="menu-arrow"></i>
			</a>
			<div class="collapse <?php if($page_name=='roles' || $page_name=='add_role' ||  $page_name=='edit_role' || $page_name=='staffs' || $page_name=='add_staff' || $page_name=='edit_staff' || $page_name=='permissions' || $page_name=='add_permission' || $page_name=='edit_permission') echo 'show'; ?>" id="ui-cx-basicm">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link <?php if($page_name=='roles' || $page_name=='add_role' ||  $page_name=='edit_role') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/roles'); ?>">Roles</a></li>
					<li class="nav-item"><a class="nav-link <?php if($page_name=='staffs' || $page_name=='add_staff' || $page_name=='edit_staff') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/staffs'); ?>">Staffs</a></li>
					<li class="nav-item"><a class="nav-link <?php if($page_name=='permissions' || $page_name=='add_permission' || $page_name=='edit_permission') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/permissions'); ?>">Permissions</a></li>
				</ul>
			</div>
		</li>
		<li class="nav-item <?php if($page_name == 'agents' || $page_name == 'add_agent' || $page_name == 'edit_agent') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/agents'); ?>">
	      		<i class="mdi mdi mdi-account-tie menu-icon"></i>
    	  		<span class="menu-title">Agents</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name == 'lead_management' || $page_name == 'add_lead' || $page_name == 'edit_lead') echo 'active';?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/lead_management'); ?>">
	      		<i class="mdi mdi mdi-account menu-icon"></i>
    	  		<span class="menu-title">Leads</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name=='customers' || $page_name == 'add_customer' || $page_name == 'edit_customer') echo 'active'; ?>">
			<a class="nav-link" href="<?php echo site_url(ADMIN.'/customers'); ?>">
				<i class="mdi mdi mdi-account-multiple menu-icon"></i>
				<span class="menu-title">Customers</span>
			</a>
		</li>
		<li class="nav-item <?php if($page_name=='confirmed_customers') echo 'active'; else echo ''; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/confirmed_customers'); ?>">
	      		<i class="mdi mdi mdi-account-multiple-check menu-icon"></i>
    	  		<span class="menu-title">Confirmed Customers</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name=='customer_trip_request_enquiries') echo 'active'; ?>">
			<a class="nav-link" href="<?php echo site_url(ADMIN.'/customer_trip_request_enquiries'); ?>">
				<i class="mdi mdi-format-list-bulleted menu-icon"></i>
				<span class="menu-title">Customer Trip Request</span>
			</a>
		</li>
		<li class="nav-item <?php if($page_name == 'trips' || $page_name == 'add_trip' || $page_name == 'edit_trip') echo 'active';?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/trips'); ?>">
	      		<i class="mdi mdi mdi-bus menu-icon"></i>
    	  		<span class="menu-title">Trips</span>
    		</a>
  		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="collapse" href="#ui-cx-basiced" aria-expanded="false" aria-controls="ui-cx-basiced">
				<i class="mdi mdi-circle-outline menu-icon"></i>
				<span class="menu-title">Careers</span><i class="menu-arrow"></i>
			</a>
			<div class="collapse <?php if($page_name=='career_categories' || $page_name=='location' || $page_name=='add_career' || $page_name=='edit_career') echo 'show'; ?>" id="ui-cx-basiced">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link <?php if($page_name=='career_categories') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/career_categories'); ?>">Categories</a></li>
					<li class="nav-item"><a class="nav-link <?php if($page_name == 'careers' || $page_name == 'add_career' || $page_name =='edit_career') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/careers'); ?>">Careers</a></li>
				</ul>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="collapse" href="#ui-cx-basicx" aria-expanded="false" aria-controls="ui-cx-basicx">
				<i class="mdi mdi-circle-outline menu-icon"></i>
				<span class="menu-title">Packages</span><i class="menu-arrow"></i>
			</a>
			<div class="collapse <?php if($page_name=='package_categories' || $page_name=='package_sub_categories' || $page_name=='add_package_sub_category' || $page_name=='edit_package_sub_category' || $page_name=='packages' || $page_name=='add_package' || $page_name=='edit_package') echo 'show'; ?>" id="ui-cx-basicx">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link <?php if($page_name=='package_categories') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/package_categories'); ?>">Categories</a></li>
					<li class="nav-item"><a class="nav-link <?php if($page_name=='package_sub_categories' || $page_name=='add_package_sub_category' || $page_name=='edit_package_sub_category') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/package_sub_categories'); ?>">Sub Categories</a></li>
					<li class="nav-item"><a class="nav-link <?php if($page_name == 'packages' || $page_name == 'add_package' || $page_name == 'edit_package') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/packages'); ?>">Packages</a></li>
				</ul>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="collapse" href="#ui-cx-basic" aria-expanded="false" aria-controls="ui-cx-basic">
				<i class="mdi mdi-circle-outline menu-icon"></i>
				<span class="menu-title">Honeymoon</span><i class="menu-arrow"></i>
			</a>
			<div class="collapse <?php if($page_name=='honeymoon_categories' || $page_name=='honeymoon_package_sub_categories' || $page_name=='add_honey_pack_sub_category' || $page_name=='edit_honey_pack_sub_category' || $page_name=='honeymoon' || $page_name=='add_honeymoon_package' || $page_name=='edit_honeymoon_package') echo 'show'; ?>" id="ui-cx-basic">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link <?php if($page_name=='honeymoon_categories') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/honeymoon_categories'); ?>">Categories</a></li>
					<li class="nav-item"><a class="nav-link <?php if($page_name=='honeymoon_sub_categories' || $page_name=='add_honey_pack_sub_category' || $page_name=='edit_honey_pack_sub_category') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/honeymoon_sub_categories'); ?>">Sub Categories</a></li>
					<li class="nav-item"><a class="nav-link <?php if($page_name == 'honeymoon' || $page_name == 'add_honeymoon_package' || $page_name == 'edit_honeymoon_package') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/honeymoon'); ?>">Packages</a></li>
				</ul>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="collapse" href="#ui-cx-basicsx" aria-expanded="false" aria-controls="ui-cx-basicsx">
				<i class="mdi mdi-circle-outline menu-icon"></i>
				<span class="menu-title">Cruises</span><i class="menu-arrow"></i>
			</a>
			<div class="collapse <?php if($page_name=='cruise_categories' || $page_name=='cruise_sub_categories' || $page_name=='add_cruise_sub_category' || $page_name=='edit_cruise_sub_category' || $page_name=='cruises' || $page_name=='add_cruise' || $page_name=='edit_cruise') echo 'show'; ?>" id="ui-cx-basicsx">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link <?php if($page_name=='cruise_categories') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/cruise_categories'); ?>">Categories</a></li>
					<li class="nav-item"><a class="nav-link <?php if($page_name=='cruise_sub_categories' || $page_name=='add_cruise_sub_category' || $page_name=='edit_cruise_sub_category') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/cruise_sub_categories'); ?>">Sub Categories</a></li>
					<li class="nav-item"><a class="nav-link <?php if($page_name == 'cruises' || $page_name == 'add_cruise' || $page_name == 'edit_cruise') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/cruises'); ?>">Cruises</a></li>
				</ul>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="collapse" href="#ui-cx-grp" aria-expanded="false" aria-controls="ui-cx-basic-grp">
				<i class="mdi mdi-circle-outline menu-icon"></i>
				<span class="menu-title">Group Tours</span><i class="menu-arrow"></i>
			</a>
			<div class="collapse <?php if($page_name=='group_categories' || $page_name=='group_tours' || $page_name == 'add_group_tour' ) echo 'show'; ?>" id="ui-cx-grp">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link <?php if($page_name=='group_categories') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/group_categories'); ?>">Categories</a></li>
					<li class="nav-item"><a class="nav-link <?php if($page_name == 'group_tours' || $page_name == 'add_group_tour' || $page_name == 'edit_group_tour') echo 'active'; ?>" href="<?php echo site_url(ADMIN.'/group_tours'); ?>">Group Tours</a></li>
				</ul>
			</div>
		</li>
		<li class="nav-item <?php if($this->router->fetch_class()=='weddings' || $this->router->fetch_class()=='wedding_faqs') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/weddings'); ?>">
	      		<i class="mdi mdi mdi-ring menu-icon"></i>
    	  		<span class="menu-title">Wedding</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name=='testimonials' || $page_name === 'add_testimonial' || $page_name === 'edit_testimonial') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/testimonials'); ?>">
	      		<i class="mdi mdi mdi-account menu-icon"></i>
    	  		<span class="menu-title">Testimonials</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name=='visa' || $page_name == 'add_visa' || $page_name == 'edit_visa') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/visa'); ?>">
	      		<i class="mdi mdi mdi-ticket menu-icon"></i>
    	  		<span class="menu-title">Visa</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name=='services' || $page_name === 'add_service' || $page_name === 'edit_service') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/services'); ?>">
	      		<i class="mdi mdi mdi-passport menu-icon"></i>
    	  		<span class="menu-title">Services</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name=='career_enquiries') echo 'active'; ?>">
			<a class="nav-link" href="<?php echo site_url(ADMIN.'/career_enquiries'); ?>">
				<i class="mdi mdi-school menu-icon"></i>
				<span class="menu-title">Career Enquiries</span>
			</a>
		</li>
		<li class="nav-item <?php if($page_name=='package_enquiries') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/package_enquiries'); ?>">
	      		<i class="mdi mdi-format-list-bulleted menu-icon"></i>
    	  		<span class="menu-title">Package Enquiries</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name=='honeymoon_package_enquiries') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/honeymoon_pack_enquiries'); ?>">
	      		<i class="mdi mdi-menu menu-icon"></i>
    	  		<span class="menu-title">Honeymoon Package Enquiries</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name=='cruise_enquiries') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/cruise_enquiries'); ?>">
	      		<i class="mdi mdi-ferry menu-icon"></i>
    	  		<span class="menu-title">Cruise Enquiries</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name=='group_tour_enquiries') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/group_tour_enquiries'); ?>">
	      		<i class="mdi mdi-menu menu-icon"></i>
    	  		<span class="menu-title">Group Tour Enquiries</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name=='itinerary_enquiries') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/itinerary_enquiries'); ?>">
	      		<i class="mdi mdi-file menu-icon"></i>
    	  		<span class="menu-title">Itinerary Enquiries</span>
    		</a>
  		</li> 
		<li class="nav-item <?php if($page_name =='visa_enquiries') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/visa_enquiries'); ?>">
	      		<i class="mdi mdi-card-outline menu-icon"></i>
    	  		<span class="menu-title">Visa Enquiries</span>
    		</a>
  		</li> 
		<li class="nav-item <?php if($page_name=='wedding_enquiries') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/wedding_enquiries'); ?>">
	      		<i class="mdi mdi-ring menu-icon"></i>
    	  		<span class="menu-title">Wedding Enquiries</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name=='contact_enquiries') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/contact_enquiries'); ?>">
	      		<i class="mdi mdi-account-box-outline menu-icon"></i>
    	  		<span class="menu-title">Contact Enquiries</span>
    		</a>
  		</li>
		<li class="nav-item <?php if($page_name=='web_settings') echo 'active'; ?>">
    		<a class="nav-link" href="<?php echo site_url(ADMIN.'/web_settings'); ?>">
	      		<i class="mdi mdi mdi-cogs menu-icon"></i>
    	  		<span class="menu-title">Web Settings</span>
    		</a>
  		</li> */ ?>
	</ul>
</nav>
<!-- main-panel starts -->
<div class="main-panel">