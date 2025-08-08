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
					<h4 class="card-title">Email Configuration</h4>
					<?php if(isset($config)) {  ?>
						<?php echo form_open_multipart(ADMIN.'/email_configuration/update', array('class' => 'forms-sample', 'id' => 'web-form', 'data-parsley-validate' => 'true')); ?>
							<div class="form-group row mt-4">
								<label class="col-sm-2 col-form-label">Protocol <span class="text-danger">*</span></label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="protocol" value="<?php if(isset($posted['protocol'])) { echo $posted['protocol']; } else { if(isset($config['protocol'])) { echo $config['protocol']; } } ?>" required />
								</div>
								<div class="col-sm-4">
									<p class="text-danger mt-2"> e.g. smtp </p>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Mailtype <span class="text-danger">*</span></label>
								<div class="col-sm-6">
									<select class="form-control" name="mailtype" required>
										<option value="html" <?php if($config['mailtype']=='html'){ echo "selected"; } ?>>html</option>
										<option value="text" <?php if($config['mailtype']=='text'){ echo "selected"; }?>>text</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">SMTP Host <span class="text-danger">*</span></label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="smtp_host" value="<?php if(isset($posted['smtp_host'])) { echo $posted['smtp_host']; } else { if(isset($config['smtp_host'])) { echo $config['smtp_host']; } } ?>" required />
								</div>
								<div class="col-sm-4">
									<p class="text-danger mt-2"> e.g. mail.yourdomain.com </p>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">SMTP Port <span class="text-danger">*</span></label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="smtp_port" value="<?php if(isset($posted['smtp_port'])) { echo $posted['smtp_port']; } else { if(isset($config['smtp_port'])) { echo $config['smtp_port']; } } ?>" required />
								</div>
								<div class="col-sm-4">
									<p class="text-danger mt-2"> e.g. 25 | 465 | 587 | 2525  </p>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Sender Email <span class="text-danger">*</span></label>
								<div class="col-sm-6">
									<input type="email" class="form-control" name="sender_email" value="<?php if(isset($posted['sender_email'])) { echo $posted['sender_email']; } else { if(isset($config['sender_email'])) { echo $config['sender_email']; } } ?>" required />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Password <span class="text-danger">*</span></label>
								<div class="col-sm-6">
									<input type="password" class="form-control" name="password" value="<?php if(isset($posted['password'])) { echo $posted['password']; } else { if(isset($config['password'])) { echo $config['password']; } } ?>" required />
								</div>
							</div>
							<div class="d-flex justify-content-end mt-3">
								<button type="submit" class="btn btn-primary mr-2">Submit</button>
							</div>
						<?php echo form_close(); ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>