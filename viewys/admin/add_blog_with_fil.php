<!--Parsley-->
<link rel="stylesheet" href="<?php echo assets(); ?>css/parsley.css">
<script src="<?php echo assets(); ?>js/parsley.js" type="text/javascript"></script>
<!-- Summernote -->
<link rel="stylesheet" href="<?php echo assets(); ?>plugins/summernote/dist/summernote-bs4.css">
<script src="<?php echo assets(); ?>plugins/summernote/dist/summernote-bs4.js" type="text/javascript"></script>
<!-- datetimepicker -->
<link href="<?php echo assets(); ?>css/datetimepicker.css" rel="stylesheet" />
<script src="<?php echo assets(); ?>js/moment.min.js"></script>
<script src="<?php echo assets(); ?>js/bootstrap-datetimepicker.min.js"></script>
<div class="content-wrapper">
	<div class="row">
		<div class="col-lg-12"><?php if($this->session->flashdata('error')) admin_flash_error(); if($this->session->flashdata('success')) admin_flash_success();  $posted = $this->session->flashdata('posted'); ?>	</div></div>
	<div class="row">
		<div class="col-md-8 offset-md-2 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><?php if(isset($row)) { echo 'Edit'; } else  { echo 'Add'; } ?> Blog</h4>
					<?php echo form_open_multipart(ADMIN.'/blogs_with_fil/add', array('class' => 'forms-sample', 'data-parsley-validate' => 'true')); ?>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Title <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<input type="hidden" name="blog_id" readonly class="form-control" value="<?php if(isset($row['blog_id'])) echo $row['blog_id']; ?>" />
							<input type="text" name="title" id="title" class="form-control" value="<?php if(isset($posted['title'])) { echo $posted['title']; } else { if(isset($row['title'])) { echo $row['title']; } } ?>"  maxlength="255" required />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Short Description <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<input type="text" name="short_description" id="short_description" class="form-control" value="<?php if(isset($posted['short_description'])) { echo $posted['short_description']; } else { if(isset($row)) { echo $row['short_description']; } } ?>"  maxlength="255" required />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<textarea name="description" id="description" class="form-control-sm summernote" rows="4" required ><?php  if(isset($posted['description'])){ echo $posted['description']; }  else { if(isset($row['description'])) { echo $row['description']; } } ?></textarea>
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
									<b class="badge badge-dark text-white mb-2">Notes:</b><br>
									<b class="text-info mt-2">Recommended Size : 850 X 500 px</b>
									<p class="text-info mt-2">Allowed types = jpeg, jpg, png<br>MaxFile Size = 1 MB</p>
									<p class="text-info mt-2">Max Width: 850 px<br>Max Height: 500 px</p>
								</div>
							</div>
						</div>	
						<div class="col-sm-4">
							<?php if(isset($row) && $row['image'] != '') { ?>
								<input type="hidden" name="old_image" readonly value="<?php echo $row['image'];  ?>" />									
								<img src="<?php  echo base_url('uploads/blogs/'.$row['image']);  ?>" class="img-fluid" alt="Image">
							<?php } ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Publish Date<span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<input type="text" name="published_date" id="published_date" class="form-control datepicker" placeholder="DD-MM-YYYY" required value="<?php if(isset($posted)) { echo date_dmy($posted['published_date']); } elseif(isset($row)) { echo date_dmy($row['published_date']); } ?>" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<select class="form-control" name="blog_status" id="blog_status" required>
							<option value="">----Select----</option>
							<option value="Active" <?php if ((isset($posted['blog_status']) && $posted['blog_status'] == 'Active') || (isset($row['blog_status']) && $row['blog_status'] == 'Active')) { echo 'selected'; } ?>>Active</option>
							<option value="Inactive" <?php if ((isset($posted['blog_status']) && $posted['blog_status'] == 'Inactive') || (isset($row['blog_status']) && $row['blog_status'] == 'Inactive')) { echo 'selected'; }  ?>>Inactive</option>
						</select>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<button type="submit" class="btn btn-primary mr-2">Submit</button>
						<a href="javascript:;" onclick="cancel_page('blogs_with_fil');" class="btn btn-light">Cancel</a>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	<?php if(isset($row) && !empty($row)) { ?>
	$('#published_date').datetimepicker({
		format: 'DD-MM-YYYY',
		icons: {
			next: 'mdi mdi-arrow-right',
			previous: 'mdi mdi-arrow-left'
		},
		// minDate: moment(),
		minDate: moment('<?php echo date_dmy($row['published_date']); ?>', 'DD-MM-YYYY'),
		maxDate: moment().add(1, 'year') 
	});
	<?php } else if($posted){ ?>
	$('#published_date').datetimepicker({
		format: 'DD-MM-YYYY',
		icons: {
			next: 'mdi mdi-arrow-right',
			previous: 'mdi mdi-arrow-left'
		},
		minDate: moment('<?php echo $posted['published_date']; ?>', 'DD-MM-YYYY'),
		maxDate: moment().add(1, 'year') 
	});
	<?php } else { ?>
	$('#published_date').datetimepicker({
		format: 'DD-MM-YYYY',
		icons: {
			next: 'mdi mdi-arrow-right',
			previous: 'mdi mdi-arrow-left'
		},
		minDate: moment(),
		maxDate: moment().add(1, 'year') 
	});
	<?php } ?>
});
</script>