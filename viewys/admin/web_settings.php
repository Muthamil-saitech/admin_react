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
					<h4 class="card-title">Update Web Setting</h4>
					<?php echo form_open_multipart(ADMIN.'/web_setting/update', array('class' => 'forms-sample', 'id' => 'web-form', 'data-parsley-validate' => 'true')); ?>
					<div class="form-group row mt-4">
						<div class="col-sm-6">
							<label>Contact Person <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="contact_person" value="<?php if(isset($posted['contact_person'])) { echo $posted['contact_person']; } else { if(isset($row['contact_person'])) { echo $row['contact_person']; } } ?>" required />
						</div>
						<div class="col-sm-6">
							<label>Contact Email <span class="text-danger">* (for sending mail notification)</span></label>
							<input type="email" class="form-control" name="email" value="<?php if(isset($posted['email'])) { echo $posted['email']; } else { if(isset($row['email'])) { echo $row['email']; } } ?>" maxlength="128" required />
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-6">
							<label>Contact Number <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="mobile_no" value="<?php if(isset($posted['mobile_no'])) { echo $posted['mobile_no']; } else { if(isset($row['mobile_no'])) { echo $row['mobile_no']; } } ?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 43" maxlength="10" required />
						</div>
						<div class="col-sm-6">
							<label>Hotline Number <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="hotline_no" value="<?php if(isset($posted['hotline_no'])) { echo $posted['hotline_no']; } else { if(isset($row['hotline_no'])) { echo $row['hotline_no']; } } ?>" maxlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 43" required />
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-6">
							<label>Sales Email </label>
							<input type="email" class="form-control" name="sales_email" value="<?php if(isset($posted['sales_email'])) { echo $posted['sales_email']; } else { if(isset($row['sales_email'])) { echo $row['sales_email']; } } ?>" maxlength="128" />
						</div>
						<div class="col-sm-6">
							<label>Address <span class="text-danger">*</span></label>
							<textarea name="address" class="form-control" rows="4" required><?php if(isset($posted['address'])) { echo $posted['address']; } else { if(isset($row['address'])) { echo $row['address']; }}?></textarea>
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