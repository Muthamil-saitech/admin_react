<link rel="stylesheet" href="<?php echo assets(); ?>css/parsley.css">
<script src="<?php echo assets(); ?>js/parsley.js" type="text/javascript"></script>
<!-- Summernote -->
<link rel="stylesheet" href="<?php echo assets(); ?>plugins/summernote/dist/summernote-bs4.css">
<script src="<?php echo assets(); ?>plugins/summernote/dist/summernote-bs4.js" type="text/javascript"></script>
<div class="content-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<?php if($this->session->flashdata('error')) admin_flash_error(); if($this->session->flashdata('success')) admin_flash_success();  $posted = $this->session->flashdata('posted'); ?>
		</div>
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Update Admin Setting</h4>
					<?php echo form_open_multipart(ADMIN.'/admin_setting/update', array('class' => 'forms-sample', 'id' => 'admin-form', 'data-parsley-validate' => 'true')); ?>
					<div class="form-group row mt-4 mb-0">
						<div class="col-sm-6">
							<label>Logo <span class="text-danger">*</span></label>&nbsp;&nbsp;
							<div class="btn btn-secondary">
								<input type="file" name="admin_logo" accept=".jpg,.png,.jpeg" <?php if(isset($row['admin_logo'])) { if($row['admin_logo'] == '') { echo 'required'; } } else { echo 'required'; } ?> />
							</div>
						</div>	
						<div class="col-sm-6">
							<label>Fav Icon <span class="text-danger">*</span></label>&nbsp;&nbsp;
							<div class="btn btn-secondary">
								<input type="file" name="admin_fav_icon" accept=".jpg,.png,.jpeg" <?php if(isset($row['admin_fav_icon'])) { if($row['admin_fav_icon'] == '') { echo 'required'; } } else { echo 'required'; } ?> />
							</div>
						</div>	
					</div>
					<div class="form-group row">
						<div class="col-sm-6">
							<?php if(isset($row) && $row['admin_logo'] != '') { ?>
								<input type="hidden" name="old_adm_logo" readonly value="<?php echo $row['admin_logo'];  ?>" />									
								<img src="<?php  echo base_url('uploads/admin-setting/'.$row['admin_logo']);  ?>" class="img-fluid" alt="Image">
							<?php } ?>
						</div>
						<div class="col-sm-6">
							<?php if(isset($row) && $row['admin_fav_icon'] != '') { ?>
								<input type="hidden" name="old_adm_fav_logo" readonly value="<?php echo $row['admin_fav_icon'];  ?>" />									
								<img src="<?php  echo base_url('uploads/admin-setting/'.$row['admin_fav_icon']);  ?>" class="img-fluid" alt="Image">
							<?php } ?>
						</div>
					</div>
					<div class="d-flex justify-content-end mt-3">
						<button type="submit" class="btn btn-primary mr-2">Submit</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>