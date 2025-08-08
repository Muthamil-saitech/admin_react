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
					<h4 class="card-title"><?php if(isset($row)) { echo 'Edit'; } else  { echo 'Add'; } ?> Gallery</h4>
					<?php echo form_open_multipart(ADMIN.'/gallery/add', array('class' => 'forms-sample', 'data-parsley-validate' => 'true')); ?>
					<input type="hidden" name="gallery_id" readonly class="form-control" value="<?php if(isset($row['gallery_id'])) echo $row['gallery_id']; ?>" />
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Image <span class="text-danger">*</span></label>
						<div class="col-sm-6">
							<div class="btn btn-secondary">
								<input type="file" name="gallery_image" id="gallery_image" accept=".jpg,.png,.jpeg" <?php if(isset($row['gallery_image'])) { if($row['gallery_image'] == '') { echo 'required'; } } else { echo 'required'; } ?> />
							</div><br>
							<div class="mt-2 card bg-light border-0">
								<div class="card-body">
									<b class="badge badge-dark text-white">Notes:</b>
									<p class="text-info mt-2 font-weight-bold">Recommended Size : 788 X 500 px</p>
									<p class="text-info mt-2">Note: Allowed types = jpeg, jpg, png<br>MaxFile Size = 1 MB</p>
								</div>
							</div>
						</div>	
						<div class="col-sm-4">
							<?php if(isset($row) && $row['gallery_image'] != '') { ?>
								<input type="hidden" name="old_image" readonly value="<?php echo $row['gallery_image'];  ?>" />									
								<img src="<?php  echo base_url('uploads/gallery/'.$row['gallery_image']);  ?>" class="img-fluid" alt="Image">
							<?php } ?>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<button type="submit" class="btn btn-primary mr-2">Submit</button>
						<a href="javascript:;" onclick="cancel_page('gallery');" class="btn btn-light">Cancel</a>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>