<!--Parsley-->
<link rel="stylesheet" href="<?php echo assets(); ?>css/parsley.css">
<script src="<?php echo assets(); ?>js/parsley.js" type="text/javascript"></script>
<div class="content-wrapper">
	<div class="row">
	<div class="col-lg-12"><?php if($this->session->flashdata('error')) admin_flash_error(); if($this->session->flashdata('success')) admin_flash_success();  $posted = $this->session->flashdata('posted'); ?>	</div></div>
	<div class="row">
		<div class="col-md-8 offset-md-2 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><?php if(isset($row)) { echo 'Edit'; } else  { echo 'Add'; } ?> Testimonial</h4>
					<?php echo form_open_multipart(ADMIN.'/testimonials_wo_fil/add', array('class' => 'forms-sample', 'data-parsley-validate' => 'true')); ?>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<input type="hidden" name="testimonial_id" readonly class="form-control" value="<?php if(isset($row['testimonial_id'])) echo $row['testimonial_id']; ?>" />
							<input type="text" name="name" id="name" class="form-control" value="<?php if(isset($posted['name'])) { echo $posted['name']; } else { if(isset($row['name'])) { echo $row['name']; } } ?>"  maxlength="50" required />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Designation </label>
						<div class="col-sm-10">
							<input type="text" name="designation" id="designation" class="form-control" value="<?php if(isset($posted['designation'])) { echo $posted['designation']; } else { if(isset($row['designation'])) { echo $row['designation']; } } ?>"  maxlength="50" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<textarea name="description" id="description" class="form-control" rows="10" required ><?php  if(isset($posted['description'])){ echo $posted['description']; }  else { if(isset($row['description'])) { echo $row['description']; } } ?></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Image </label>
						<div class="col-sm-6">
							<div class="btn btn-secondary">
								<input type="file" name="image" id="image" accept=".jpg,.png,.jpeg" />
							</div><br>
							<div class="mt-2 card bg-light border-0">
								<div class="card-body">
									<b class="badge badge-dark text-white">Notes:</b>
									<p class="text-info mt-2 font-weight-bold">Recommended Size : 100 X 100 px</p>
									<p class="text-info mt-2">Allowed types = jpeg, jpg, png<br>MaxFile Size = 1 MB</p>
								</div>
							</div>
						</div>	
						<div class="col-sm-4">
							<?php if(isset($row) && $row['image'] != '') { ?>
								<input type="hidden" name="old_image" readonly value="<?php  echo $row['image'];  ?>" />									
								<img src="<?php  echo base_url('uploads/testimonials/'.$row['image']);  ?>" class="img-fluid" alt="Image">
							<?php } ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Ratings <span class="text-danger">*</span>&nbsp;(out of 5)</label>
						<div class="col-sm-10">
							<input type="text" name="ratings" id="ratings" class="form-control" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46"  value="<?php if(isset($posted['ratings'])) { echo $posted['ratings']; } else { if(isset($row['ratings'])) { echo $row['ratings']; } } ?>" maxlength="3" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<select class="form-control" name="testimonial_status" id="testimonial_status" required>
							<option value="">----Select----</option>
							<option value="Active" <?php if ((isset($posted['testimonial_status']) && $posted['testimonial_status'] == 'Active') || (isset($row['testimonial_status']) && $row['testimonial_status'] == 'Active')) { echo 'selected'; } elseif(!isset($posted) && !isset($row)) { echo 'selected'; } ?>>Active</option>
							<option value="Inactive" <?php if ((isset($posted['testimonial_status']) && $posted['testimonial_status'] == 'Inactive') || (isset($row['testimonial_status']) && $row['testimonial_status'] == 'Inactive')) { echo 'selected'; }  ?>>Inactive</option>
						</select>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<button type="submit" class="btn btn-primary mr-2">Submit</button>
						<a href="javascript:;" onclick="cancel_page('testimonials_wo_fil');" class="btn btn-light">Cancel</a>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
