<link rel="stylesheet" href="<?php echo assets(); ?>css/parsley.css">
<script src="<?php echo assets(); ?>js/parsley.js" type="text/javascript"></script>
<div class="content-wrapper">	<div class="row">		<div class="col-lg-12"><?php if($this->session->flashdata('error')) admin_flash_error(); if($this->session->flashdata('success')) admin_flash_success();  $posted = $this->session->flashdata('posted'); ?>	</div></div>
	<div class="row">
		<div class="col-md-8 offset-md-2 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><?php if(isset($row)) { echo 'Edit'; } else {echo 'Add'; } ?> SEO</h4>
					<?php echo form_open(ADMIN.'/seo_content/edit', array('class' => 'forms-sample', 'data-parsley-validate' => 'true')); ?>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Page Name <span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="hidden" name="id" readonly class="form-control" value="<?php if(isset($row)) echo $row['id']; ?>" />
							<input type="text" name="page_name" id="page_name" class="form-control" value="<?php if(isset($posted)){ echo $posted['page_name']; } elseif(isset($row)) { echo $row['page_name']; } ?>" maxlength="50" required />						
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Page Link <span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="text" name="page_link" id="page_link" class="form-control" value="<?php if(isset($posted)){ echo $posted['page_link']; } elseif(isset($row)) { echo $row['page_link']; } ?>" required />
							<div class="mt-2 card bg-light border-0">
								<div class="card-body">
									<b class="badge badge-dark text-white mb-2">Notes:</b><br>
									<p class="text-info mt-2">Page Link should only allow lowercase letters and hyphens.</p>
									<p class="text-info mt-2">Enter the last segment of the link.</p>
									<p class="text-secondary"><b>Eg:</b> happy-tours/domestic-tour-packages</p>
									<b class="text-secondary">Here <u>domestic-tour-packages</u> is the last segment of the link.</b>
								</div>
							</div>						
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Meta Title <span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<textarea name="meta_title" id="meta_title" class="form-control" rows="4" maxlength="50" required><?php if(isset($posted)){ echo $posted['meta_title']; } elseif(isset($row)) { echo $row['meta_title']; } ?></textarea>
						</div>
					</div>	
					<div class="form-group row">	
						<label class="col-sm-3 col-form-label">Meta Description <span class="text-danger">*</span></label>	
						<div class="col-sm-9">						
						<textarea name="meta_description" id="meta_description" rows="8" class="form-control" required><?php if(isset($posted)){ echo $posted['meta_description']; } elseif(isset($row)) { echo $row['meta_description']; } ?></textarea>		
						</div>			
					</div>	
					<div class="d-flex justify-content-end">
						<button type="submit" class="btn btn-primary mr-2">Submit</button>
						<a href="javascript:;" onclick="cancel_page('seo_content');" class="btn btn-light">Cancel</a>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>