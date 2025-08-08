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
					<h4 class="card-title">Payment Gateway Setting</h4>
					<?php if(isset($gateways)) { foreach($gateways as $gateway) { ?>
						<?php echo form_open_multipart(ADMIN.'/payment_gateway_setting/update', array('class' => 'forms-sample', 'id' => 'web-form', 'data-parsley-validate' => 'true')); ?>
							<div class="form-group row mt-4">
								<label class="col-sm-2 col-form-label">Agent <span class="text-danger">*</span></label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="agent" value="<?php if(isset($posted['agent'])) { echo $posted['agent']; } else { if(isset($gateway['agent'])) { echo $gateway['agent']; } } ?>" required />						
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Merchant ID <span class="text-danger">*</span></label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="r_pay_marchantid" value="<?php if(isset($posted['r_pay_marchantid'])) { echo $posted['r_pay_marchantid']; } else { if(isset($gateway['r_pay_marchantid'])) { echo $gateway['r_pay_marchantid']; } } ?>" required />						
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">API Key <span class="text-danger">*</span></label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="r_pay_password" value="<?php if(isset($posted['r_pay_password'])) { echo $posted['r_pay_password']; } else { if(isset($gateway['r_pay_password'])) { echo $gateway['r_pay_password']; } } ?>" required />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
								<div class="col-sm-6">
									<select class="form-control" name="is_live" required>
										<option value="1" <?php if($gateway['is_live']==1){echo "selected";} ?>>Live</option>
										<option value="2" <?php if($gateway['is_live']==2){echo "selected";}?>>Test</option>
									</select>
								</div>
							</div>
							<div class="d-flex justify-content-end mt-3">
								<button type="submit" class="btn btn-primary mr-2">Submit</button>
							</div>
						<?php echo form_close(); ?>
					<?php } } ?>
				</div>
			</div>
		</div>
	</div>
</div>