<link rel="stylesheet" href="<?php echo assets(); ?>css/parsley.css">
<script src="<?php echo assets(); ?>js/parsley.js" type="text/javascript"></script>
<div class="content-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<?php if($this->session->flashdata('error')) admin_flash_error(); if($this->session->flashdata('success')) admin_flash_success();  $posted = $this->session->flashdata('posted'); ?>
		</div>
		<div class="col-md-6 offset-md-3 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Update My Account</h4>
					<?php echo form_open(ADMIN.'/settings/update', array('class' => 'forms-sample','data-parsley-validate' => 'true', 'id'=>'setting-form')); ?>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Name <span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="hidden" name="user_id" readonly class="form-control" value="<?php if(isset($row)) echo $row['user_id']; ?>" />
							<input type="text" class="form-control" name="name" placeholder="Name" value="<?php if(isset($posted)) {echo $posted['name']; } else { if(isset($row)) { echo $row['name']; } }?>"  maxlength="50" required />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
						<div class="col-sm-9">
							<input type="email" class="form-control" name="email" placeholder="Email" value="<?php if(isset($posted)) {echo $posted['email']; } else { if(isset($row)) { echo $row['email']; } } ?>" maxlength="128" required />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Password <span class="text-danger">*</span></label>
						<div class="col-sm-9 mx-auto">
							<div class="input-group">
								<input type="password" class="form-control" name="password" placeholder="Password" id="password" maxlength="32" value="<?php if(isset($posted)) {echo $posted['password']; } else { if(isset($row)) { echo decode($row['password']); } } ?>" />
								<button type="button" style="cursor:pointer;" class="input-group-text" id="toggle_password"><i class="mdi mdi-eye-off"></i></button>
							</div>
							<div id="password_error" style="color:red; display:none;"><small>This field is required</small></div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary mr-2">Submit</button>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$('form').submit(function(e) {
	if (!validatePassword()) {
		e.preventDefault();
	}
});
function validatePassword() {
	var password = $('#password').val();
	var errorMessage = $('#password_error');
	if (password.length < 6) {
		errorMessage.show();
		return false;
	} else {
		errorMessage.hide();
		return true;
	}
}
</script>