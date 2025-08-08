<link rel="stylesheet" href="<?php echo assets(); ?>css/parsley.css">
<script src="<?php echo assets(); ?>js/parsley.js" type="text/javascript"></script>
<div class="content-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<?php if($this->session->flashdata('error')) admin_flash_error(); if($this->session->flashdata('success')) admin_flash_success();  $posted = $this->session->flashdata('posted'); ?>
		</div>
		<div class="col-md-8 offset-md-2 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Update About Us</h4>
					<?php echo form_open_multipart(ADMIN.'/about_us/update', array('class' => 'forms-sample','data-parsley-validate' => 'true')); ?>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Short Title </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="short_title" placeholder="Short Title" value="<?php if(isset($posted['email'])) { echo $posted['short_title']; } else { if(isset($row['short_title'])) { echo $row['short_title']; } } ?>" maxlength="50"  />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Title <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="title" placeholder="Title" value="<?php if(isset($posted['email'])) { echo $posted['title']; } else { if(isset($row['title'])) { echo $row['title']; } } ?>" maxlength="50" required />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Description </label>
						<div class="col-sm-10">
							<textarea name="description" class="form-control" placeholder="Description" rows="4" ><?php if(isset($posted['description'])) { echo $posted['description']; } else { if(isset($row['description'])) { echo $row['description']; }}?></textarea>
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
									<p class="text-info mt-2 font-weight-bold">Recommended Size : 531 X 343 px</p>
									<p class="text-info mt-2">Allowed types = jpeg, jpg, png<br>MaxFile Size = 1 MB</p>
								</div>
							</div>
						</div>	
						<div class="col-sm-4">
							<?php if(isset($row) && $row['image'] != '') { ?>
								<input type="hidden" name="old_image" readonly value="<?php  echo $row['image'];  ?>" />									
								<img src="<?php  echo base_url('uploads/about_us/'.$row['image']);  ?>" class="img-fluid" alt="Image">
							<?php } ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Mission </label>
						<div class="col-sm-10">
							<textarea name="mission" class="form-control" placeholder="Mission" rows="4"><?php if(isset($posted['mission'])) { echo $posted['mission']; } else { if(isset($row['mission'])) { echo $row['mission']; }} ?></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Vision </label>
						<div class="col-sm-10">
							<textarea name="vision" class="form-control" placeholder="Vision" rows="4" ><?php if(isset($posted['vision'])) { echo $posted['vision']; } else { if(isset($row['vision'])) { echo $row['vision']; }} ?></textarea>
						</div>
					</div>
					<button type="submit" class="btn btn-primary mr-2">Submit</button>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>