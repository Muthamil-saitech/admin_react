<!--Parsley-->
<link rel="stylesheet" href="<?php echo assets(); ?>css/parsley.css">
<script src="<?php echo assets(); ?>js/parsley.js" type="text/javascript"></script>
<!-- Summernote -->
<link rel="stylesheet" href="<?php echo assets(); ?>plugins/summernote/dist/summernote-bs4.css">
<script src="<?php echo assets(); ?>plugins/summernote/dist/summernote-bs4.js" type="text/javascript"></script>
<div class="content-wrapper">
	<div class="row">
	<div class="col-lg-12"><?php if($this->session->flashdata('error')) admin_flash_error(); if($this->session->flashdata('success')) admin_flash_success();  $posted = $this->session->flashdata('posted'); ?>	</div></div>
	<div class="row">
		<div class="col-md-8 offset-md-2 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><?php if(isset($row)) { echo 'Edit'; } else  { echo 'Add'; } ?> Service</h4>
					<?php echo form_open_multipart(ADMIN.'/services/add', array('class' => 'forms-sample', 'data-parsley-validate' => 'true')); ?>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Title <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<input type="hidden" name="service_id" readonly class="form-control" value="<?php if(isset($row['service_id'])) echo $row['service_id']; ?>" />
							<input type="text" name="title" id="title" class="form-control" value="<?php if(isset($posted['title'])) { echo $posted['title']; } else { if(isset($row['title'])) { echo $row['title']; } } ?>"  maxlength="50" required />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label"> Description</label>
						<div class="col-sm-10">
							<textarea name="description" id="description" class="form-control-sm summernote" rows="4" ><?php  if(isset($posted['description'])){ echo $posted['description']; }  else { if(isset($row['description'])) { echo $row['description']; } } ?></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Image <span class="text-danger">*</span></label>
						<div class="col-sm-6">
							<div class="btn btn-secondary">
								<input type="file" name="image" id="image" accept=".jpg,.png,.jpeg" <?php if(isset($row['image'])) { if($row['image'] == '') { echo 'required'; } } else { echo 'required'; } ?> />
							</div><br>
							<div class="mt-2 card bg-light border-0">
								<div class="card-body">
									<b class="badge badge-dark text-white">Notes:</b>
									<p class="text-info mt-2 font-weight-bold">Recommended Size : 370 X 255 px</p>
									<p class="text-info mt-2">Note: Allowed types = jpeg, jpg, png<br>MaxFile Size = 1 MB</p>
								</div>
							</div>
						</div>	
						<div class="col-sm-4">
							<?php if(isset($row) && $row['image'] != '') { ?>
								<input type="hidden" name="old_image" readonly value="<?php echo $row['image'];  ?>" />									
								<img src="<?php  echo base_url('uploads/service_detail/thumbpath/'.$row['image']);  ?>" class="img-fluid" alt="Image">
							<?php } ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<select class="form-control" name="service_status" id="service_status" required>
							<option value="">----Select----</option>
							<option value="Active" <?php if ((isset($posted['service_status']) && $posted['service_status'] == 'Active') || (isset($row['service_status']) && $row['service_status'] == 'Active')) { echo 'selected'; } elseif(!isset($posted) && !isset($row)) { echo 'selected'; } ?>>Active</option>
							<option value="Inactive" <?php if ((isset($posted['service_status']) && $posted['service_status'] == 'Inactive') || (isset($row['service_status']) && $row['service_status'] == 'Inactive')) { echo 'selected'; }  ?>>Inactive</option>
						</select>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<button type="submit" class="btn btn-primary mr-2">Submit</button>
						<a href="javascript:;" onclick="cancel_page('services');" class="btn btn-light">Cancel</a>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
